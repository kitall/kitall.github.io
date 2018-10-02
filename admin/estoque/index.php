<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque</title>
</head>
<body>
   <h1><a href="../">Voltar</a></h1>
    <?php
        include "../../php/connect.php";

        $sql = "SELECT * FROM p_produtos;";
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
                $custo = $prod['custo'];
                $qtd = $prod['qtd'];
                $descricao = $prod['descricao'];
                $link_img = $prod['link_img'];
                $excluido = $prod['excluido'];

                //Mostra o produto
                echo "<img src='".$link_img."' width='250' height='250'>";
                echo "<br>Codigo = ".$id;
                echo "<br>Nome = ".$nome;
                echo "<br>Preco = ".$preco;
                echo "<br>Custo = ".$custo;
                echo "<br>Estoque = ".$qtd;
                echo "<br>Descrição = <b>".$descricao."</b>";
                if($excluido == "t")
                    echo "<br>Excluido = Sim";
                else
                    echo "<br>Excluido = Nao";

                //Salva suas propriedades para enviar para a alteração
                $to_send = "id=$id&nome=$nome&qtd=$qtd&preco=$preco&excluido=$excluido&descricao=$descricao&custo=$custo&link_img=$link_img";
                        //não pode tabular porque ele envia os espaços do tab

                echo "<br><a href='../alteracao/index.php?".$to_send."'>Editar Produto</a>";
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