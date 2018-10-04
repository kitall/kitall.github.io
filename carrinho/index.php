<?php
    /*FALTA FINALIZARRR A COMRPRA*/

    session_start();

    $logado = false;
    if (empty($_SESSION['user'])) //Teste de sessão
    {
        header("Location: ../login/index.php");
        exit;
    }
        
    $qtd_comprada = $_POST['qtd'];
    
    //Esta recebendo produtos para serem adicionados
    if($qtd_comprada > 0)
    {
        if(!empty($_SESSION['carrinho']))
        {
            array_push($_SESSION['carrinho_id'], $_SESSION['id_venda']);

            array_push($_SESSION['carrinho_qtd'], $qtd_comprada);

            array_push($_SESSION['carrinho_preco'], $_SESSION['preco_venda']);

            $_SESSION['carrinho'] += 1;
        }
        else
        {
            $_SESSION['carrinho_id'] = array($_SESSION['id_venda']);

            $_SESSION['carrinho_qtd'] = $qtd_comprada;

            $_SESSION['carrinho_preco'] = array($_SESSION['preco_venda']);

            $_SESSION['carrinho'] = 1;
        }

        $_SESSION['id_venda'] = NULL;
        $_SESSION['qtd_venda'] = NULL;
        $_SESSION['preco_venda'] = NULL;
    }
?>
    
    
<!--    aqui vai o site     -->
    
    
    
<?php
    //Mostra o carrinho

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
?>

<br>
<br>
<h3><a href="../php/vender.php">Finalizar compra</a></h3>
<br>
<br>
<a href="../index.php">Voltar p/ home</a>