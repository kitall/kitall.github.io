<?php
    $data = date("d-m-Y");

    //valores vindos do form
    $nome = $_POST['nome'];
    $qtd_prod = $_POST['qtd'];
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
        (DEFAULT, '$nome', '$qtd_prod', '$preco', '$custo', '$descr', '$link_img', 'FALSE');";

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if($qtd <= 0)
    {
        $erro = pg_last_error($conectar);
            
        echo "Erro na execucao do SQL!<br><br>";
        echo "Erro: ".$erro;

	pg_close($conectar);

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
        (DEFAULT, '$data', 'Novo', '$id', '0', '$qtd_prod', '0', '$qtd_prod');";

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if($qtd <= 0)
    {
        pg_close($conectar);
        
        echo "Erro no cadastro do fluxo de estoque!";
        exit;
    }
    
    pg_close($conectar);

    header("Location: ../admin/");
?>