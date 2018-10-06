<?php
    $data = date("d-m-Y");

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

    //Cadastrar
    $sql = "INSERT INTO p_produtos VALUES
        (DEFAULT, '$nome', '$qtd', '$preco', '$custo', '$descr', '$link_img', 'FALSE');";

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if($qtd <= 0)
    {
        pg_close($conectar);
        
        echo "Erro no cadastro do produto!";
        exit;
    }

    //Pegar o ID
    $sql = "SELECT id_prod FROM p_produtos
        WHERE descricao='$descr' AND nome='$nome';";

    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if($qtd <= 0)
    {
        pg_close($conectar);
        
        echo "Erro no select do produto!";
        exit;
    }

    while($prod = pg_fetch_array($res))
    {
        $id = $prod['id_prod'];
    }

    //--------------------------------------
    //Cadastrar no fluxo de estoque
    $sql = "INSERT INTO f_fluxoestoque VALUES
        (DEFAULT, '$data', 'Novo', '$id', '0', '$qtd', '0', '$qtd');";

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if($qtd <= 0)
    {
        pg_close($conectar);
        
        echo "Erro no cadastro do fluxo de estoque!";
        exit;
    }
    else
    {
        pg_close($conectar);

        echo "Cadastro efetuado com sucesso!<br><br>";
        echo "<a href='../admin/index.html'>Voltar</a>";
    }
?>