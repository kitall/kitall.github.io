<?php
    //valores vindos do form
    $nome = $_POST['nome'];
    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];
    $custo = $_POST['custo'];
    $descr = $_POST['descricao'];
    $nome_link = $_POST['nome_link'];

    //outas variaveis importantes
    $link_img = "http://200.145.153.175/andrecreppe/kitall/imgs/produtos/$nome_link.png";

    //Programa
    include "connect.php";

    $sql = "INSERT INTO p_produtos VALUES
        (DEFAULT, '$nome', '$qtd', '$preco', '$custo', '$descr', '$link_img', 'FALSE')";

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