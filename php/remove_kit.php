<?php
    session_start();

    $index = $_GET['remove'];

    $id = $_SESSION['kit_id'];
        unset($id[$index]);
        array_splice($id, $index, 0);
    $nome = $_SESSION['kit_nome'];
        unset($nome[$index]);
        array_splice($nome, $index, 0);    
    $preco = $_SESSION['kit_preco'];
        unset($preco[$index]);
        array_splice($preco, $index, 0);

    $_SESSION['kit_id'] = $id;
    $_SESSION['kit_nome'] = $nome;
    $_SESSION['kit_preco'] = $preco;
    $_SESSION['kit'] -= 1;

    if($_SESSION['kit'] == 0)
    {        
        $_SESSION['kit_id'] = array();
        $_SESSION['kit_nome'] = array();
        $_SESSION['kit_preco'] = array();
        
        $_SESSION['carrinho'] = 0;
    }

    header("Location: ../montar_kit/");
?>