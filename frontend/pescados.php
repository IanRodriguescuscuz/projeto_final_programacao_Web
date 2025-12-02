<?php
include_once "topo.php";
include_once "../backend/config/conexao.php";


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id'];


if (isset($_POST['btn_pescar'])) {
    $id_peixe = $_POST['id_peixe_selecionado'];
    
    $sql_insert = "INSERT INTO inventario (id_usuario, id_peixe) VALUES ('$id_usuario', '$id_peixe')";
    
    if ($mysqli->query($sql_insert)) {
        echo "<p style='color: green'>Peixe adicionado!</p>";
    }
}


if (isset($_POST['btn_remover'])) {
    $id_peixe_para_remover = $_POST['id_peixe_remover'];

    
    $sql_delete = "DELETE FROM inventario 
                   WHERE id_usuario = '$id_usuario' 
                   AND id_peixe = '$id_peixe_para_remover' 
                   LIMIT 1";
    
    if ($mysqli->query($sql_delete)) {
        echo "<p style='color: orange'>Uma unidade devolvida ao lago.</p>";
    } else {
        echo "<p style='color: red'>Erro ao remover.</p>";
    }
}


$vitrine = $mysqli->query("SELECT * FROM peixes");


$sql_cesto = "SELECT p.id as id_peixe, p.nome, p.foto, p.preco, COUNT(i.id) as quantidade
              FROM inventario i 
              JOIN peixes p ON i.id_peixe = p.id 
              WHERE i.id_usuario = '$id_usuario' 
              GROUP BY p.id, p.nome, p.foto, p.preco
              ORDER BY p.nome ASC";

$cesto = $mysqli->query($sql_cesto);
?>

<h2>Área de Pesca</h2>
<p>Usuário: <strong><?php echo $_SESSION['nome']; ?></strong></p>
<hr>

<h3> Disponíveis para Pescar</h3>

<?php while($peixe = $vitrine->fetch_assoc()): ?>
    <div style="border: 1px solid #ccc; padding: 10px; display: inline-block; margin: 5px; text-align: center;">
        <img src="<?php echo $peixe['foto']; ?>" width="80"><br>
        <b><?php echo $peixe['nome']; ?></b><br>
        <small>R$ <?php echo $peixe['preco']; ?></small><br>
        
        <form method="POST" action="">
            <input type="hidden" name="id_peixe_selecionado" value="<?php echo $peixe['id']; ?>">
            <button type="submit" name="btn_pescar">➕ Adicionar</button>
        </form>
    </div>
<?php endwhile; ?>

<hr>

<h3>Meus Peixes Pescados</h3>

<?php if($cesto->num_rows > 0): ?>
    <table border="1" style="width: 100%; text-align: center;">
        <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th>Preço Unit.</th>
            <th>Quantidade</th> <th>Total</th>      <th>Ação</th>
        </tr>

        <?php while($item = $cesto->fetch_assoc()): ?>
        <tr>
            <td><img src="<?php echo $item['foto']; ?>" width="50"></td>
            <td><?php echo $item['nome']; ?></td>
            <td>R$ <?php echo $item['preco']; ?></td>
            
            <td><strong><?php echo $item['quantidade']; ?></strong></td>
            
            <td>R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, '.', ''); ?></td>
            
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="id_peixe_remover" value="<?php echo $item['id_peixe']; ?>">
                    <button type="submit" name="btn_remover" style="color: red;">➖ Remover 1</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Seu cesto está vazio.</p>
<?php endif; ?>