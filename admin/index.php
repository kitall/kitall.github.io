<?php
    include "../php/connect_prod.php";
    
    $sql = "SELECT * FROM produtos;";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if($qtd > 0)
    {
        while ($prod = pg_fetch_array($res)) 
        {
            //Salva as propriedades do produto
            $id = $prod['id'];
            $nome = $prod['nome'];
            $preco = $prod['preco'];
            $qtd = $prod['qtd'];
            $link_img = $prod['link_img'];
            $excluido = $prod['excluido'];
                
            //Mostra o produto
            echo "<img src='".$link_img."' width='250' height='250'>";
            echo "<br>Codigo = ".$id;
            echo "<br>Nome = ".$nome;
            echo "<br>Preco = ".$preco;
            echo "<br>Estoque = ".$qtd;
            if($excluido == "t")
                echo "<br>Excluido = Sim";
            else
                echo "<br>Excluido = Nao";
            
            //Salva suas propriedades para enviar para a alteração
            $to_send = "id=$id&nome=$nome&qtd=$qtd&preco=$preco&excluido=$excluido";
                    //não pode tabular porque ele envia os espaços do tab
            
            echo "<br><a href='alt_prod.php?".$to_send."'>Editar Produto</a>";
            echo "<br><br><br>";
        }
    }
    else
    {
        echo "Nao foi encontrado nenhum produto! :(";
        exit;
    }
?>