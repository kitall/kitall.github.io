<?php
    $id_prod = $_GET['id'];

    echo "ID da vez: $id_prod<br><br>";

    session_start();

    //esta correto?
    if(!empty($_SESSION['carrinho_prod']))
    {
        $carrinho = $_SESSION['carrinho_prod'];
        $_SESSION['carrinho_prod'] = 
            array_merge($carrinho, array($id_prod));
        
        $_SESSION['carrinho'] += 1;
    }
    else
    {
        $_SESSION['carrinho_prod'] = array($id_prod);
        $_SESSION['carrinho'] = 1;
    }

    //------------------------------------------------

    $carrinho = $_SESSION['carrinho_prod'];

    $qtd = count($carrinho);  
    echo "Quantidade no carrinho atual= $qtd"; 

    if($qtd > 0)
    {
        echo "<br>Produtos do carrinho:"; 
        
        for($i = 0; $i < $qtd; $i++)
        { 
            echo "<br>$i:".$carrinho[$i]; 
        }    
    }
?>