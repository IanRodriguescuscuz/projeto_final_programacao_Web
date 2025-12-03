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
        $_SESSION['msg'] = "<div class='baby2'><p style='color: white;justify-content: center'>Peixe adicionado!</p></div>";
    
        header("Location: pescados.php");
        exit;
    
    }
}


if (isset($_POST['btn_remover'])) {
    $id_peixe_para_remover = $_POST['id_peixe_remover'];

    
    $sql_delete = "DELETE FROM inventario 
                   WHERE id_usuario = '$id_usuario' 
                   AND id_peixe = '$id_peixe_para_remover' 
                   LIMIT 1";
    
    if ($mysqli->query($sql_delete)) {
        $_SESSION['msg'] = "<div class='baby2'><p style='color: orange'>Uma unidade devolvida ao lago.</p></div>";
        header("Location: pescados.php");
        exit;
    } else {
        $_SESSION['msg'] = "<div class='baby2'><p style='color: red'>Erro ao remover.</p></div>";
        header("Location: pescados.php");
        exit;
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

<div class="parent">

<?php
    if(isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']); 
    }
    ?>

<h2 class="titulo">Cesta de Pesca</h2>
<p class="paragraf">Usuário: <strong><?php echo $_SESSION['nome']; ?></strong></p>
<hr>

<h3 class="paragraf"> Disponíveis para Pescar</h3>

<?php while($peixe = $vitrine->fetch_assoc()): ?>
    <div style="border: 0px solid #ccc; padding: 10px; display: inline-block; margin: 5px; text-align: center;">
        <img src="<?php echo $peixe['foto']; ?>" width="80"><br>
        <b><?php echo $peixe['nome']; ?></b><br>
        
        
        <form method="POST" action="">
            <input type="hidden" name="id_peixe_selecionado" value="<?php echo $peixe['id']; ?>">
            <button type="submit" name="btn_pescar">➕ Adicionar</button>
        </form>
    </div>
<?php endwhile; ?>

<hr>

<h3 class="paragraf">Meus Peixes Pescados</h3>

<?php if($cesto->num_rows > 0): ?>
    <table 
    border="1" 
    style="
        width:100%;
        text-align:center;
        color:#FFFD8F;
        background-color:#4C763B;
        border-collapse:collapse;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 2px 10px rgba(0,0,0,0.25);
    "
>
    <tr style="background:rgba(0,0,0,0.15); font-weight:bold;">
        <th style="padding:12px;">Foto</th>
        <th style="padding:12px;">Espécie</th>
        <th style="padding:12px;">Qtd.</th>
        <th style="padding:12px;">Ação</th>
    </tr>

    <?php while ($item = $cesto->fetch_assoc()): ?>
        <tr style="border-top:1px solid rgba(0,0,0,0.25);">
            <td style="padding:10px;">
                <img src="<?php echo $item['foto']; ?>" width="50">
            </td>

            <td style="padding:10px;">
                <?php echo $item['nome']; ?>
            </td>

            <td style="padding:10px;">
                <strong><?php echo $item['quantidade']; ?></strong>
            </td>

            <td style="padding:10px;">
                <form method="POST" action="" style="display:inline;">
                    <input type="hidden" name="id_peixe_remover" value="<?php echo $item['id_peixe']; ?>">
                    <button 
                        type="submit" 
                        name="btn_remover" 
                        style="
                            color:red; 
                            font-weight:bold; 
                            background:transparent; 
                            border:none; 
                            cursor:pointer;
                        "
                    >
                        ➖ Remover 1
                    </button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>

</table>
<?php else: ?>
    <p class="paragraf">Seu cesto está vazio.</p>
<?php endif; ?>

</div>