<?php
    //Campos vindos da página de alteração
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];
    $custo = $_POST['custo'];
    $descr = $_POST['descricao'];
    $link_img = $_POST['link_img'];
    $excluido = $_POST['exclusao'];

    $sql = "";
    $data = date("d-m-Y");

    //Programa
    include "connect.php";

    //Pega o ID -> para caso de atualização de quantidade
    $sql = "SELECT qtd FROM p_produtos WHERE id_prod='$id';";
    $res = pg_query($conectar, $sql);
    $qtd_select = pg_affected_rows($res);
    if($qtd_select <= 0)
    {
        pg_close($conectar);

        echo "Erro no select do produto!";
        exit;
    }
    while($prod = pg_fetch_array($res))
    {
        $qtd_anterior = $prod['qtd'];
    }

    //
    if($qtd > $qtd_anterior)
    {
        $entrada = $qtd - $qtd_anterior;
        
        $sql = "INSERT INTO f_fluxoestoque VALUES
        (DEFAULT, '$data', 'Reposicao', '$id', '$qtd_anterior', '$entrada', '0', '$qtd');";
    }

    //
    $sql .= "UPDATE p_produtos SET
        nome = '$nome',
        qtd = '$qtd',
        preco = '$preco',
        custo = '$custo',
        descricao = '$descr',
        link_img = '$link_img',
        excluido = '$excluido'
            WHERE id_prod = $id;";

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if($qtd <= 0)
    {
        pg_close($conectar);

        echo "Erro na alteracao do produto!";
        exit;
    }

    pg_close($conectar);

    echo "Produto alterado com sucesso!<br><br>";
    echo "<a href='../admin/estoque/'>Voltar</a>";

?>