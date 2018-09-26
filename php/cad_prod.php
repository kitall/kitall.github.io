<?php
    //valores vindos do form
    $nome = $_POST['nome'];
    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];
    $descr = $_POST['descr'];

    //outas variaveis importantes
    $link_img = "http://200.145.153.175/andrecreppe/kitall/produtos/".$nome.".jpg";

    //Programa
    include "connect_prod.php";

    $sql = "INSERT INTO produtos VALUES
        (DEFAULT, '$nome', '$qtd', '$preco', '$link_img', 'FALSE', '$descr')";

    echo $sql;

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if($qtd <= 0)
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
?>