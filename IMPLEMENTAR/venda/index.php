<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venda de produtos - BETA</title>
</head>
<body>
    <?php
        $id = $_GET['id_prod'];
    
        include "../../php/connect.php";
    
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
            }
        } 
    ?>
    <h1>Compra de produtos</h1>
    <p>Deseja efetuar a compra de <b><?php echo $nome; ?></b> ?</p>
    <?php  echo "<img src='$link_img' alt='300'>";  ?>
    <br>
    <br>
    <form action="../../vender.php" method="post">
        
    </form>
</body>
</html>