<?php
    $op = $_POST['id'];

    if($op == NULL) //Cadastro do Produto
    {
        //valores vindos do form
        $nome = $_POST['nome'];
        $qtd = $_POST['qtd'];
        $preco = $_POST['preco'];

        //outas variaveis importantes
        $link_img = "http://200.145.153.175/andrecreppe/kitall/produtos/".$nome.".jpg";

        //Programa
        include "conect_prod.php";

        $sql = "INSERT INTO produtos VALUES
            (DEFAULT, '".$nome."', '".$qtd."', '".$preco."', '".$link_img."', 'FALSE')";
        
        $res = pg_query($conectar, $sql);
    
        if(pg_affected_rows($res) <= 0)
        {
            echo "Erro no cadastro do produto!";
            exit;
        }
        else
        {
            pg_close($conectar);

            echo "Cadastro efetuado com sucesso!<br><br>";
            echo "<input type='button' value='Clique aqui para retornar'
                onclick='location.replace(document.referrer);'>";
        }
    }
    else //Salvamento da alteração do produto
    {
        //Campos vindos da página de alteração
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $qtd = $_POST['qtd'];
        $preco = $_POST['preco'];
        $excluido = $_POST['exclusao'];    
        
        
        //Programa
        include "conect_prod.php";
        
        $sql = "UPDATE produtos SET
            nome = '$nome',
            qtd = '$qtd',
            preco = '$preco',
            link_img = 'http://200.145.153.175/andrecreppe/kitall/produtos/$nome.jpg',
            excluido = '$excluido'
                WHERE id = $id;";
        
        $res = pg_query($conectar, $sql);
        $qtd = pg_affected_rows($res);
        
        if($qtd <= 0)
        {
            pg_close($conectar);
            
            echo "Erro na alteracao do produto!";
            exit;
        }
        else
        {
            pg_close($conectar);

            echo "Produto alterado com sucesso!<br><br>";
            echo "<a href='../home_adm.php'>Voltar</a>";
        }
    }
?>