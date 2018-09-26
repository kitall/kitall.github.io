<?php
    //Campos vindos da página de alteração
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];
    $excluido = $_POST['exclusao'];    


    //Programa
    include "connect_prod.php";

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
        echo "<a href='../admin/index.html'>Voltar</a>";
    }
?>