<?php
    /*FALTA FINALIZARRR A COMRPRA*/

    session_start();

    $logado = false;
    if (empty($_SESSION['user'])) //Teste de sessão
    {
        header("Location: ../login/index.php");
        exit;
    }

    if(!empty($_SESSION['carrinho']) && $qtd_comprada > 0)
    {
        array_push($_SESSION['carrinho_id'], $_SESSION['id_venda']);

        array_push($_SESSION['carrinho_qtd'], (string)$qtd_comprada);

        array_push($_SESSION['carrinho_preco'], $_SESSION['preco_venda']);
        
        array_push($_SESSION['carrinho_estoque'], $_SESSION['estoque_venda']);

        $_SESSION['carrinho'] += 1;
    }
    else if(empty($_SESSION['carrinho_id']) && $qtd_comprada > 0)
    {
        $_SESSION['carrinho_id'] = array($_SESSION['id_venda']);

        $_SESSION['carrinho_qtd'] = array((string)$qtd_comprada);

        $_SESSION['carrinho_preco'] = array($_SESSION['preco_venda']);
        
        $_SESSION['carrinho_estoque'] = array($_SESSION['estoque_venda']);

        $_SESSION['carrinho'] = 1;
    }
?>
      
    
<?php
    //Mostra o conteúdo carrinho

    $qtd = $_SESSION['carrinho'];
    echo "<h1>Quantidade no carrinho atual = $qtd</h1>"; 

    if($qtd > 0)
    {
        echo "<br><h2>Produtos do carrinho:</h2>"; 
        
        $carrinho_id = $_SESSION['carrinho_id'];
        $carrinho_qtd = $_SESSION['carrinho_qtd'];
        $carrinho_preco = $_SESSION['carrinho_preco'];
            
        for($i = 0; $i < $qtd; $i++)
        { 
            echo "<br>id = ".$carrinho_id[$i];
            echo "<br>qtd = ".$carrinho_qtd[$i];
            echo "<br>preco = ".$carrinho_preco[$i];
            echo "<br><br>---------------------------------<br>";
        }    
    }

    echo "<br><br>";
    if($qtd > 0)
    {
        echo "<h3><a href='../php/vender.php'>Finalizar compra</a></h3>";
        echo "<br><br>"; 
    }
?>
<br>
<br>
<a href="../index.php">Voltar p/ home</a>