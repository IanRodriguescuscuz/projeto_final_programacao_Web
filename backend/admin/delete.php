<?php
include '../config/conexao.php';


$id = $_GET['id'];
$tabela = $_GET['tabela'];


if ($tabela == 'peixes') {
    
    
    $busca = $mysqli->query("SELECT foto FROM peixes WHERE id = '$id'");
    $peixe = $busca->fetch_assoc();
    
    
    $arquivo_fisico = "../../frontend/" . $peixe['foto'];
    
    
    if (file_exists($arquivo_fisico)) {
        unlink($arquivo_fisico);
    }

    
    $mysqli->query("DELETE FROM peixes WHERE id = '$id'");
    
    
    header("Location: peixes.php");
}


if ($tabela == 'usuarios') {

    
    $busca = $mysqli->query("SELECT is_admin FROM usuarios WHERE id = '$id'");
    $usuario = $busca->fetch_assoc();

    if ($usuario['is_admin'] == 1) {
        
        die("ERRO: Você não pode deletar um Administrador.");
    }

    
    $mysqli->query("DELETE FROM usuarios WHERE id = '$id'");
    
    
    header("Location: usuarios.php");
}
?>