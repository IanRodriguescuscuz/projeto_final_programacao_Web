<?php

session_start();

include_once "topo.php";
include_once "../backend/config/conexao.php";


if (isset($_POST['btn_entrar'])) {
    $email = $_POST['email'];


    $email = $mysqli->real_escape_string($email);


    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $mysqli->query($sql);


    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

    
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['is_admin'] = $usuario['is_admin']; 


        if ($usuario['is_admin'] == 1) {

            header("Location: ../backend/admin/index.php");
        } else {

            header("Location: pescados.php");
        }
        exit;

    } else {
        $erro = "Email não encontrado no sistema!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Pesca</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="tio">
    <div class="primo">
        <h2 class="titulo2">Acesse sua conta</h2>
        <p class="paragrafo2">Digite seu email para entrar</p>

        <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>

        <form class="inputee" method="POST" action="">
            <input class="campo" type="email" name="email" placeholder="seu@email.com" required>
            <br>
            <button class="button2" type="submit" name="btn_entrar">ENTRAR</button>
        </form>
        
        <br>
        <a href="sobre.php">Voltar ao site</a>
    </div>
</div>

</body>
</html>