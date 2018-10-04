<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carrinho - teste</title>
</head>
<body>
    <?php
        include "../connect.php";

        $sql = "SELECT * FROM p_produtos WHERE excluido=FALSE 
            ORDER BY id_prod;";
        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);
        if($qtd > 0)
        {
            while ($prod = pg_fetch_array($res)) 
            {
                //Salva as propriedades do produto
                $id = $prod['id_prod'];
                $nome = $prod['nome'];
                $preco = $prod['preco'];
                $qtd = $prod['qtd'];
                $descricao = $prod['descricao'];
                $link_img = $prod['link_img'];

                //Mostra o produto
                echo "<img src='".$link_img."' width='250' height='250'>";
                echo "<br>Nome = ".$nome;
                echo "<br>Preco = ".$preco;
                echo "<br>Descrição = <b>".$descricao."</b>";
                
                if($qtd > 0)
                    echo "<br><a href='add_carrinho.php?id=$id'>Adicionar produto ao carrinho</a>";
                else
                    echo "<br>Produto indisponivel no estoque!";
                
                echo "<br>----------------------------------------------------------------------<br>";
            }
        }
        else
        {
            echo "Nao foi encontrado nenhum produto! :(";
            exit;
        }
    ?>
</body>
</html>