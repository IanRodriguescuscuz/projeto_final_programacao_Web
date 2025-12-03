<?php
// Inicia a sessão
if (!isset($_SESSION)) {
    session_start();
}

// Inclui a conexão com o banco de dados
include_once "../config/conexao.php";

// Define para qual página redirecionar após processamento.
// Se o formulário enviar um campo hidden `redirect` ele terá prioridade,
// senão tentamos usar HTTP_REFERER, em último caso volta para `suporte.php`.
$redirect = 'suporte.php';
if (!empty($_POST['redirect'])) {
    $redirect = basename(parse_url($_POST['redirect'], PHP_URL_PATH));
} elseif (!empty($_SERVER['HTTP_REFERER'])) {
    $ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    $redirect = basename($ref) ?: 'suporte.php';
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nome = htmlspecialchars($_POST['nome'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $telefone = htmlspecialchars($_POST['telefone'] ?? '');
    $assunto = htmlspecialchars($_POST['assunto'] ?? '');
    $mensagem = htmlspecialchars($_POST['mensagem'] ?? '');
    
    // Valida os campos obrigatórios
    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        $_SESSION['erro'] = "Por favor, preencha todos os campos obrigatórios!";
        header("Location: $redirect");
        exit;
    }
    
    // Valida o email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erro'] = "Email inválido!";
        header("Location: $redirect");
        exit;
    }
    
    try {
        // Insere a mensagem no banco de dados
        $sql = "INSERT INTO mensagens_suporte (nome, email, telefone, assunto, mensagem, data_envio, status) 
                VALUES (?, ?, ?, ?, ?, NOW(), 'novo')";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssss", $nome, $email, $telefone, $assunto, $mensagem);
        
        if ($stmt->execute()) {
            // Sucesso - envia email de confirmação (opcional)
            $destinatario = $email;
            $assunto_email = "Recebemos sua mensagem - Pesca.com";
            $corpo_email = "Olá $nome,\n\n";
            $corpo_email .= "Recebemos sua mensagem com sucesso!\n";
            $corpo_email .= "Nosso time de suporte entrará em contato em breve.\n\n";
            $corpo_email .= "Detalhes da sua mensagem:\n";
            $corpo_email .= "Assunto: $assunto\n";
            $corpo_email .= "Data: " . date('d/m/Y H:i') . "\n\n";
            $corpo_email .= "Obrigado por entrar em contato!\n";
            $corpo_email .= "Equipe de Suporte";
            
            $headers = "From: suporte@pesca.com.br\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            mail($destinatario, $assunto_email, $corpo_email, $headers);
            
            $_SESSION['sucesso'] = "Mensagem enviada com sucesso! Entraremos em contato em breve.";
        } else {
            $_SESSION['erro'] = "Erro ao enviar a mensagem. Tente novamente mais tarde.";
        }
        
        $stmt->close();
    } catch (Exception $e) {
        $_SESSION['erro'] = "Erro ao processar a mensagem: " . $e->getMessage();
    }
    
    header("Location: $redirect");
    exit;
} else {
    // Se não foi POST, redireciona para a página de suporte
    header("Location: $redirect");
    exit;
}
?>
