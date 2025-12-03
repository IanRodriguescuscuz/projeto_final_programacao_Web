<?php
// Inclui a conexão com o banco de dados
include_once "../../config/conexao.php";

// Verifica se o usuário é admin
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../../frontend/login.php");
    exit;
}

// Processa respostas de suporte
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['responder_suporte'])) {
    $id = intval($_POST['id'] ?? 0);
    $resposta = htmlspecialchars($_POST['resposta'] ?? '');
    
    if ($id > 0 && !empty($resposta)) {
        $sql = "UPDATE mensagens_suporte SET resposta_admin = ?, status = 'respondido', data_resposta = NOW() WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("si", $resposta, $id);
        
        if ($stmt->execute()) {
            // Obtém o email do usuário
            $sql_email = "SELECT email FROM mensagens_suporte WHERE id = ?";
            $stmt_email = $conexao->prepare($sql_email);
            $stmt_email->bind_param("i", $id);
            $stmt_email->execute();
            $result = $stmt_email->get_result();
            $row = $result->fetch_assoc();
            
            if ($row) {
                $destinatario = $row['email'];
                $assunto_email = "Resposta da nossa equipe de suporte";
                $corpo_email = "Olá,\n\n";
                $corpo_email .= "Recebemos sua mensagem e analisamos com cuidado.\n\n";
                $corpo_email .= "Resposta:\n";
                $corpo_email .= $resposta . "\n\n";
                $corpo_email .= "Qualquer dúvida adicional, entre em contato!\n";
                $corpo_email .= "Equipe de Suporte";
                
                $headers = "From: suporte@pesca.com.br\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
                
                mail($destinatario, $assunto_email, $corpo_email, $headers);
            }
            
            $_SESSION['mensagem_sucesso'] = "Resposta enviada com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao enviar resposta.";
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Processa exclusão de mensagem
if (isset($_GET['deletar']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM mensagens_suporte WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['mensagem_sucesso'] = "Mensagem deletada com sucesso!";
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao deletar mensagem.";
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Obtém filtro de status
$filtro_status = $_GET['status'] ?? 'novo';
$sql_filtro = $filtro_status !== 'todos' ? "WHERE status = ?" : "";

// Busca as mensagens de suporte
$sql = "SELECT * FROM mensagens_suporte $sql_filtro ORDER BY data_envio DESC LIMIT 50";
$stmt = $conexao->prepare($sql);

if ($filtro_status !== 'todos') {
    $stmt->bind_param("s", $filtro_status);
}

$stmt->execute();
$result = $stmt->get_result();
$mensagens = $result->fetch_all(MYSQLI_ASSOC);

// Conta total de cada status
$sql_count = "SELECT status, COUNT(*) as total FROM mensagens_suporte GROUP BY status";
$result_count = $conexao->query($sql_count);
$status_count = [];
while ($row = $result_count->fetch_assoc()) {
    $status_count[$row['status']] = $row['total'];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Suporte - Admin</title>
    <link rel="stylesheet" href="../../frontend/estilo.css">
    <style>
        .admin-container {
            background-color: #B0CE88;
            margin-top: 40px;
            padding: 20px;
            border-radius: 10px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .admin-title {
            color: #043915;
            font-size: 32px;
            text-align: center;
            margin-bottom: 30px;
        }

        .filtros {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .filtro-btn {
            padding: 10px 20px;
            background-color: #4C763B;
            color: #FFFD8F;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .filtro-btn.ativo {
            background-color: #FFFD8F;
            color: #043915;
            font-weight: bold;
        }

        .filtro-btn:hover {
            background-color: #5a8b4a;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            min-width: 80px;
        }

        .status-novo {
            background-color: #FF6B6B;
            color: white;
        }

        .status-em_atendimento {
            background-color: #FFD93D;
            color: #043915;
        }

        .status-respondido {
            background-color: #6BCB77;
            color: white;
        }

        .status-fechado {
            background-color: #4D96FF;
            color: white;
        }

        .mensagem-card {
            background-color: #4C763B;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            color: #FFFD8F;
        }

        .mensagem-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .mensagem-info {
            font-size: 14px;
            color: #B0CE88;
        }

        .mensagem-assunto {
            font-size: 18px;
            font-weight: bold;
            color: #FFFD8F;
            margin-bottom: 10px;
        }

        .mensagem-corpo {
            background-color: #3d5e2e;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .resposta-existente {
            background-color: #3d5e2e;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 4px solid #6BCB77;
        }

        .resposta-label {
            color: #6BCB77;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .formulario-resposta {
            background-color: #3d5e2e;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .textarea-resposta {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #6BCB77;
            background-color: #043915;
            color: #B0CE88;
            font-family: Arial, sans-serif;
            resize: vertical;
            min-height: 100px;
        }

        .botoes-acao {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .btn-enviar {
            background-color: #6BCB77;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-enviar:hover {
            background-color: #52b788;
        }

        .btn-deletar {
            background-color: #FF6B6B;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-deletar:hover {
            background-color: #ff5252;
        }

        .alerta {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alerta-sucesso {
            background-color: #6BCB77;
            color: white;
        }

        .alerta-erro {
            background-color: #FF6B6B;
            color: white;
        }

        .mensagens-vazias {
            text-align: center;
            color: #043915;
            font-size: 18px;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1 class="admin-title">📧 Gerenciar Mensagens de Suporte</h1>

        <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
            <div class="alerta alerta-sucesso">
                <?php echo $_SESSION['mensagem_sucesso']; unset($_SESSION['mensagem_sucesso']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['mensagem_erro'])): ?>
            <div class="alerta alerta-erro">
                <?php echo $_SESSION['mensagem_erro']; unset($_SESSION['mensagem_erro']); ?>
            </div>
        <?php endif; ?>

        <div class="filtros">
            <a href="?status=todos"><button class="filtro-btn <?php echo $filtro_status === 'todos' ? 'ativo' : ''; ?>">
                Todas (<?php echo array_sum($status_count); ?>)
            </button></a>
            <a href="?status=novo"><button class="filtro-btn <?php echo $filtro_status === 'novo' ? 'ativo' : ''; ?>">
                Novas (<?php echo $status_count['novo'] ?? 0; ?>)
            </button></a>
            <a href="?status=em_atendimento"><button class="filtro-btn <?php echo $filtro_status === 'em_atendimento' ? 'ativo' : ''; ?>">
                Em Atendimento (<?php echo $status_count['em_atendimento'] ?? 0; ?>)
            </button></a>
            <a href="?status=respondido"><button class="filtro-btn <?php echo $filtro_status === 'respondido' ? 'ativo' : ''; ?>">
                Respondidas (<?php echo $status_count['respondido'] ?? 0; ?>)
            </button></a>
            <a href="?status=fechado"><button class="filtro-btn <?php echo $filtro_status === 'fechado' ? 'ativo' : ''; ?>">
                Fechadas (<?php echo $status_count['fechado'] ?? 0; ?>)
            </button></a>
        </div>

        <?php if (empty($mensagens)): ?>
            <div class="mensagens-vazias">
                Nenhuma mensagem encontrada com este filtro.
            </div>
        <?php else: ?>
            <?php foreach ($mensagens as $msg): ?>
                <div class="mensagem-card">
                    <div class="mensagem-header">
                        <div>
                            <div class="mensagem-assunto"><?php echo htmlspecialchars($msg['assunto']); ?></div>
                            <div class="mensagem-info">
                                <strong>De:</strong> <?php echo htmlspecialchars($msg['nome']); ?> (<?php echo htmlspecialchars($msg['email']); ?>)
                                <?php if (!empty($msg['telefone'])): ?>
                                    | <strong>Tel:</strong> <?php echo htmlspecialchars($msg['telefone']); ?>
                                <?php endif; ?>
                                <br>
                                <strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($msg['data_envio'])); ?>
                            </div>
                        </div>
                        <span class="status-badge status-<?php echo $msg['status']; ?>">
                            <?php 
                            $status_label = [
                                'novo' => 'Novo',
                                'em_atendimento' => 'Em Atendimento',
                                'respondido' => 'Respondido',
                                'fechado' => 'Fechado'
                            ];
                            echo $status_label[$msg['status']] ?? $msg['status'];
                            ?>
                        </span>
                    </div>

                    <div class="mensagem-corpo">
                        <?php echo nl2br(htmlspecialchars($msg['mensagem'])); ?>
                    </div>

                    <?php if (!empty($msg['resposta_admin'])): ?>
                        <div class="resposta-existente">
                            <div class="resposta-label">✓ Resposta da Equipe:</div>
                            <?php echo nl2br(htmlspecialchars($msg['resposta_admin'])); ?>
                            <br><small style="color: #B0CE88;">Respondido em: <?php echo date('d/m/Y H:i', strtotime($msg['data_resposta'])); ?></small>
                        </div>
                    <?php else: ?>
                        <form method="POST" class="formulario-resposta">
                            <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                            <textarea name="resposta" class="textarea-resposta" placeholder="Digite sua resposta aqui..." required></textarea>
                            <div class="botoes-acao">
                                <button type="submit" name="responder_suporte" value="1" class="btn-enviar">Enviar Resposta</button>
                                <a href="?deletar=1&id=<?php echo $msg['id']; ?>" class="btn-deletar" onclick="return confirm('Tem certeza que deseja deletar esta mensagem?');">Deletar</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php" style="display: inline-block; padding: 10px 20px; background-color: #4C763B; color: #FFFD8F; text-decoration: none; border-radius: 5px;">
                ← Voltar ao Painel Admin
            </a>
        </div>
    </div>

</body>
</html>

<?php
$stmt->close();
$conexao->close();
?>
