<?php
include '../config/conexao.php';

if (!isset($_GET['id'])) {
    header("Location: peixes.php");
    exit;
}

$id = $_GET['id'];


$sql = "SELECT * FROM peixes WHERE id = '$id'";
$query = $mysqli->query($sql);
$peixe = $query->fetch_assoc();


if (!$peixe) {
    header("Location: peixes.php");
    exit;
}


if (isset($_POST['btn_atualizar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        
        
        $foto_antiga = "../../frontend/" . $peixe['foto'];
        if (file_exists($foto_antiga)) {
            unlink($foto_antiga);
        }

        
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $novo_nome = md5(time()) . "." . $extensao;
        $destino = "../../frontend/assets/" . $novo_nome;
        $caminho_banco = "assets/" . $novo_nome;

        move_uploaded_file($_FILES['foto']['tmp_name'], $destino);

        
        $sql_update = "UPDATE peixes SET nome='$nome', descricao='$descricao', preco='$preco', foto='$caminho_banco' WHERE id='$id'";

    } else {
        
        $sql_update = "UPDATE peixes SET nome='$nome', descricao='$descricao', preco='$preco' WHERE id='$id'";
    }

    if ($mysqli->query($sql_update)) {
        echo "<script>alert('Peixe atualizado!'); window.location.href='peixes.php';</script>";
    } else {
        echo "Erro ao atualizar: " . $mysqli->error;
    }
}
?>

<a href="peixes.php">Voltar</a>
<h1>Editar Peixe: <?php echo $peixe['nome']; ?></h1>

<form method="POST" action="" enctype="multipart/form-data">
    
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?php echo $peixe['nome']; ?>" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"><?php echo $peixe['descricao']; ?></textarea><br><br>

    <label>Preço:</label><br>
    <input type="text" name="preco" value="<?php echo $peixe['preco']; ?>" required><br><br>

    <label>Foto Atual:</label><br>
    <img src="../../frontend/<?php echo $peixe['foto']; ?>" width="100"><br>
    <small>Se não quiser mudar a foto, deixe o campo abaixo vazio.</small><br>
    <input type="file" name="foto"><br><br>

    <button type="submit" name="btn_atualizar">Salvar Alterações</button>

</form>