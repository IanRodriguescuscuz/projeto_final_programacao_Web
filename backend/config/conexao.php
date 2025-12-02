<?php
$host = 'localhost';
$user = 'root';
$senha = '';
$db = 'banco_de_dados_peixe';

$mysqli = new mysqli($host, $user, $senha, $db);

if ($mysqli->connect_error) {
    die("Erro durante a conexão. {$mysqli->connect_error}");
};
?>