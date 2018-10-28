<?php
    session_start();

    $index = $_GET['remove'];

    $id = $_SESSION['carrinho_id'];
        unset($id[$index]);
        array_splice($id, $index, 0);
    $qtd = $_SESSION['carrinho_qtd'];
        unset($qtd[$index]);
        array_splice($qtd, $index, 0);    
    $preco = $_SESSION['carrinho_preco'];
        unset($preco[$index]);
        array_splice($preco, $index, 0);
    $estoque = $_SESSION['carrinho_estoque'];
        unset($estoque[$index]);
        array_splice($estoque, $index, 0);
    $nome = $_SESSION['carrinho_nome'];
        unset($nome[$index]);
        array_splice($nome, $index, 0);
    $link = $_SESSION['carrinho_link'];
        unset($link[$index]);
        array_splice($link, $index, 0);

    $_SESSION['carrinho_id'] = $id;
    $_SESSION['carrinho_qtd'] = $qtd;
    $_SESSION['carrinho_preco'] = $preco;
    $_SESSION['carrinho_estoque'] = $estoque;
    $_SESSION['carrinho_nome'] = $nome;
    $_SESSION['carrinho_link'] = $link;
    $_SESSION['carrinho'] -= 1;

    if($_SESSION['carrinho'] == 0)
    {
//        unset($_SESSION['carrinho_id']);
//        unset($_SESSION['carrinho_qtd']);
//        unset($_SESSION['carrinho_preco']);
//        unset($_SESSION['carrinho_estoque']);
//        unset($_SESSION['carrinho_nome']);
//        unset($_SESSION['carrinho_link']);
//        unset($_SESSION['carrinho']);
        
        $_SESSION['carrinho_id'] = array();
        $_SESSION['carrinho_qtd'] = array();
        $_SESSION['carrinho_preco'] = array();
        $_SESSION['carrinho_estoque'] = array();
        $_SESSION['carrinho_nome'] = array();
        $_SESSION['carrinho_link'] = array();
        
        $_SESSION['carrinho'] = 0;
    }

    header("Location: ../carrinho/index.php");
?>