<?php
include_once "topo.php";
include_once "../backend/config/conexao.php";

// 1. Proteção de Login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id'];

// 2. Lógica de "Pescar" (Salvar no banco)
if (isset($_POST['btn_pescar'])) {
    $id_peixe = $_POST['id_peixe_selecionado'];
    
    $sql_insert = "INSERT INTO inventario (id_usuario, id_peixe) VALUES ('$id_usuario', '$id_peixe')";
    
    if ($mysqli->query($sql_insert)) {
        echo "<p>Pesca realizada com sucesso!</p>";
    } else {
        echo "<p>Erro ao pescar.</p>";
    }
}

// 3. Consultas ao Banco
// Vitrine (Todos os peixes)
$resultado_vitrine = $mysqli->query("SELECT * FROM peixes");

// Cesto (O que eu já tenho - usando INNER JOIN)
$sql_cesto = "SELECT p.nome, p.foto, p.preco, i.data_aquisicao 
              FROM inventario i 
              JOIN peixes p ON i.id_peixe = p.id 
              WHERE i.id_usuario = '$id_usuario' 
              ORDER BY i.data_aquisicao DESC";
$resultado_cesto = $mysqli->query($sql_cesto);
?>

<h2>Área de Pesca</h2>
<p>Bem-vindo, <?php echo $_SESSION['nome']; ?></p>

<hr>

<h3>Disponíveis no Lago</h3>

<?php while($peixe = $resultado_vitrine->fetch_assoc()): ?>
    <div>
        <img src="<?php echo $peixe['foto']; ?>" width="100"><br>
        
        <strong><?php echo $peixe['nome']; ?></strong> <br>
        Preço: R$ <?php echo $peixe['preco']; ?> <br>
        Desc: <?php echo $peixe['descricao']; ?> <br>

        <form method="POST" action="">
            <input type="hidden" name="id_peixe_selecionado" value="<?php echo $peixe['id']; ?>">
            <button type="submit" name="btn_pescar">Pescar este</button>
        </form>
    </div>
    <br><hr><br>
<?php endwhile; ?>

<h3>Meus Pescados (Cesto)</h3>

<table border="1">
    <tr>
        <th>Foto</th>
        <th>Nome</th>
        <th>Valor</th>
        <th>Data</th>
    </tr>
    <?php while($item = $resultado_cesto->fetch_assoc()): ?>
    <tr>
        <td><img src="<?php echo $item['foto']; ?>" width="50"></td>
        <td><?php echo $item['nome']; ?></td>
        <td><?php echo $item['preco']; ?></td>
        <td><?php echo $item['data_aquisicao']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>