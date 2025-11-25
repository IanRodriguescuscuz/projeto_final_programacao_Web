<?php
// Tenta conectar. Se falhar, o script morre aqui mesmo com o die() do conexao.php
include '../config/conexao.php';
?>

<h1>Painel Admin</h1>
<p>Status: <strong>Conectado com sucesso ao banco 'projeto_peixes'.</strong></p>

<hr>

<a href="peixes.php">1. Gerenciar Peixes</a>
<br><br>
<a href="usuarios.php">2. Gerenciar Usuários</a>