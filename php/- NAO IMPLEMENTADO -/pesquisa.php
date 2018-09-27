<?php
$prod_name = $_GET['prod'];

include "php/conect_prod.php";

$sql = "SELECT * FROM produtos WHERE nome = '$prod_name' AND excluido = 'f'";
$res = pg_query($conectar, $sql);
$qtd = pg_num_rows($res);

if ($qtd <= 0) {
    $sql = "SELECT * FROM produtos WHERE nome LIKE '$prod_name%' AND excluido = 'f'";
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);

    if ($qtd <= 0) //erro
    {
        echo "Produto e similares não encontrados :(";
    } else //similares
    {
        echo "<h1>Por acaso voce quis dizer: </h1>";
        while ($prod = pg_fetch_array($res)) {
            $id = $prod['id'];
            $nome = $prod['nome'];
            $preco = $prod['preco'];
            $qtd = $prod['qtd'];
            $link_img = $prod['link_img'];

            echo "<img src='" . $link_img . "' width='250' height='250'>";
            echo "<br>Nome = " . $nome;
            echo "<br>Preco = " . $preco;

            echo "<br><a href='pesquisa.php?prod=" . $nome . "'>Ver</a>";
            echo "<br><br><br>";
        }
    }
} else {
    echo "<h1> Confira agora esse prod especifico! </h1>";
    $prod = pg_fetch_array($res);

    $id = $prod['id'];
    $nome = $prod['nome'];
    $preco = $prod['preco'];
    $qtd = $prod['qtd'];
    $link_img = $prod['link_img'];

    echo "<img src='" . $link_img . "' width='250' height='250'>";
    echo "<br>Nome = " . $nome;
    echo "<br>Preco = " . $preco;
    echo "<br> colocar a info dele aqui <br>";

    echo "<br>Adicionar ao carrinho link aqui";
}
?>