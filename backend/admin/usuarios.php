<?php
include '../config/conexao.php';


if (isset($_POST['btn_criar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $sql = "INSERT INTO usuarios (nome, email, is_admin) VALUES ('$nome', '$email', '$is_admin')";
    $mysqli->query($sql);
}


$sql_busca = "SELECT * FROM usuarios";
$resultado = $mysqli->query($sql_busca);
?>

<a href="index.php">Voltar</a>
<h1>Gerenciar Usuários</h1>

<div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
    <h3>Novo Usuário</h3>
    <form method="POST" action="">
        Nome: <input type="text" name="nome" required>
        Email: <input type="email" name="email" required>
        
        <label>
            <input type="checkbox" name="is_admin" value="1"> É Admin?
        </label>

        <button type="submit" name="btn_criar">Criar</button>
    </form>
</div>

<hr>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Tipo</th> <th>Ações</th>
    </tr>
    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['email']; ?></td>
        
        <td>
            <?php if($row['is_admin'] == 1): ?>
                <strong style="color: red;">ADMIN (Chefe)</strong>
            <?php else: ?>
                Cliente
            <?php endif; ?>
        </td>

        <td>
            <a href="delete.php?id=<?php echo $row['id']; ?>&tabela=usuarios">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>