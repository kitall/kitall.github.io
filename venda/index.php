<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venda - BETA</title>
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
                $_SESSION['preco_venda'] = $preco;
                $_SESSION['estoque_venda'] = $qtd;
            }
        } 
    ?>
    <h2>Deseja adicionar "<b><?php echo $nome; ?></b>" ao carrinho?</h2>
    <?php  echo "<img src='$link_img' height='300'>";  ?>
    <br>
    <form action="../carrinho/index.php" method="post">
        Preço (R$):
        <?php echo "<input type='text' name='preco' value='$preco' readonly>"; ?>
        <br>
        Quantidade:
        <?php 
            if($qtd < 1)
            {
                echo "Produto fora de estoque!";
                echo "<h4><a href='../index.php'>Cancelar</a></h4>";
                exit;
            }
            else
                echo "<input type='number' name='qtd' max='$qtd' min='1' size='10' required>"; 
        ?>
        <br>
        <input type="submit" value="Confirmar">
        <br>
        <h4><a href="../index.php">Cancelar</a></h4>
    </form>
</body>
</html>