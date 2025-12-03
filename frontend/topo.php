<?php
// Se a sessão não existir, inicia.
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
                <li><a class="navegacao" href="suporte.php">Suporte</a></li>

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li>
                        <a class="navegacao" href="../backend/admin/index.php" style="color: orange; font-weight: bold;">ADMIN</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['id'])): ?>
                    <li><a class="navegacao" href="logout.php" style="color: red;">Sair</a></li>
                <?php else: ?>
                    <li><a class="navegacao" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <a class="peixes" href="pescados.php"><button>Pescados</button></a>
    </header>
</body>
</html>