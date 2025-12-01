<?php
// Se a sessão ainda não foi iniciada, inicie agora.
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>home</title>
</head>
<body>
    <header>
        <a class="logo" href="sobre.php"><img class="logo" src="assets/ChatGPT Image 26 de nov. de 2025, 13_29_56.png" alt="logo"></a>
        <nav>
            <ul class="nav_links">
                <li><a class="navegacao" href="sobre.php">Sobre</a></li>
                <li><a class="navegacao" href="equipamentos.php">Equipamentos</a></li>
                <li><a class="navegacao" href="como_pescar.php">Como pescar</a></li>
                <li><a class="navegacao" href="login.php">Login</a></li>
            </ul>
        </nav>
        <a class="peixes" href="pescados.php"><button>Pescados</button></a>
    </header>
