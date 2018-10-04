<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venda de produtos - BETA</title>
</head>
<body>
    <?php
        session_start();
    
        $id = $_GET['id_prod'];
    
        include "../php/connect.php";
    
        $sql = "SELECT * FROM p_produtos WHERE id_prod=$id";
        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);
        if ($qtd > 0) 
        {
            while ($prod = pg_fetch_array($res)) 
            {
                $nome = $prod['nome'];
                $descricao = $prod['descricao'];
                $link_img = $prod['link_img'];
                $preco = $prod['preco'];
                $qtd = $prod['qtd'];
                
                $_SESSION['id_venda'] = $prod['id_prod'];
            }
        } 
    ?>
    <h1>Compra de produtos</h1>
    <p>Deseja efetuar a compra de <b><?php echo $nome; ?></b> ?</p>
    <?php  echo "<img src='$link_img' alt='300'>";  ?>
    <br>
    <form action="../php/vender.php" method="post">
        Preço (R$):
        <?php echo "<input type='text' name='preco' value='$preco' readonly>"; ?>
        <br>
        Quantidade:
        <?php echo "<input type='number' name='qtd' max='$qtd' min='1' required>"; ?>
        <br>
        <input type="submit" value="Confirmar">
        <br>
        <a href="../index.php">Cancelar Compra</a>
    </form>
</body>
</html>