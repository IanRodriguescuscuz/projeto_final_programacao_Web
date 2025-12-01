<?php
include '../config/conexao.php';


if (isset($_POST['btn_cadastrar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco']; 

    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $novo_nome = md5(time()) . "." . $extensao;
        
        
        $pasta_destino = "../../frontend/assets/"; 
        $caminho_banco = "assets/" . $novo_nome;

        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $pasta_destino . $novo_nome)) {
         
            $sql = "INSERT INTO peixes (nome, descricao, preco, foto) VALUES ('$nome', '$descricao', '$preco', '$caminho_banco')";
            $mysqli->query($sql);
        }
    }
}


$sql_busca = "SELECT * FROM peixes ORDER BY id DESC";
$resultado = $mysqli->query($sql_busca);
?>

<a href="index.php">Voltar</a>

<h1>Gerenciar Peixes</h1>

<form method="POST" action="" enctype="multipart/form-data">
    Nome: <br>
    <input type="text" name="nome" required><br><br>

    Descrição: <br>
    <textarea name="descricao"></textarea><br><br>

    Preço (use ponto): <br>
    <input type="text" name="preco" required><br><br>

    Foto: <br>
    <input type="file" name="foto" required><br><br>

    <button type="submit" name="btn_cadastrar">Salvar Peixe</button>
</form>

<hr>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Foto</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td>
            <img src="../../frontend/<?php echo $row['foto']; ?>" width="50">
        </td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['preco']; ?></td>
        <td>
            <a href="editar_peixe.php?id=<?php echo $row['id']; ?>">Editar</a>
            | 
            <a href="delete.php?id=<?php echo $row['id']; ?>&tabela=peixes">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>