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

    //Programa
    include "connect.php";

    $sql = "UPDATE p_produtos SET
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
    else
    {
        pg_close($conectar);

        echo "Produto alterado com sucesso!<br><br>";
        echo "<a href='../admin/estoque/'>Voltar</a>";
    }
?>