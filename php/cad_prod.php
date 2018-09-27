<?php
    //valores vindos do form
    $nome = $_POST['nome'];
    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];
    $descr = $_POST['descricao'];

    //outas variaveis importantes
    $link_img = "http://200.145.153.175/andrecreppe/kitall/imgs/produtos/".$nome.".jpg";

    //Programa
    include "connect_prod.php";

    $sql = "INSERT INTO produtos VALUES
        (DEFAULT, '$nome', '$qtd', '$preco', '$link_img', '$descr', 'FALSE')";

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
    ?>
        <button onclick="window.location.href='../admin/'">Voltar</button>
    <?php
    }
?>