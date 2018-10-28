<?php
    session_start();

    include("connect.php");

    $id = $_SESSION['kit_id'];
    $kit = $_SESSION['kit'];

    $param = "id_prod='".$id[0]."'";

    if($kit > 1)
    {
        for($i=1; $i<$kit; $i++)
            $param .= " OR id_prod='".$id[$i]."'";
    }

    $sql = "SELECT * FROM p_produtos WHERE ";
    $sql .= $param;
    $sql .= " ORDER BY id_prod";

    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if ($qtd > 0) 
    {
        $i = 0;
        while ($prod = pg_fetch_array($res)) 
        {
            if($i == 0)
            {
                $id = array($prod['id_prod']);
                
                $nome = array($prod['nome']);
                
                $qtd = array(1);
                
                $preco = array($prod['preco']);
                
                $descricao = array($prod['descricao']);
                
                $link_img = array($prod['link_img']);
            }
            else
            {
                array_push($id, $prod['id_prod']);
                
                array_push($nome, $prod['nome']);
                
                array_push($qtd, 1);
                
                array_push($preco, $prod['preco']);
                
                array_push($descricao, $prod['descricao']);
                
                array_push($link_img, $prod['link_img']);
            }
            
            $i++;
        }
    }
    else
    {
        echo "Erro no SQL!!";
        
        echo "<br><br>".pg_last_error($res);
        
        pg_close($conectar);
        
        exit;
    }

    //Send to CARRINHO
    $_SESSION['kit_carrinho_id'] = $id;
    $_SESSION['kit_carrinho_qtd'] = $qtd;
    $_SESSION['kit_carrinho_preco'] = $preco;
    $_SESSION['kit_carrinho_estoque'] = $qtd;
    $_SESSION['kit_carrinho_link'] = $link_img;
    $_SESSION['kit_carrinho_nome'] = $nome;
    $_SESSION['kit_carrinho'] = $kit;

    //Remove the Kit
    unset($_SESSION['kit_id']);
    unset($_SESSION['kit_nome']);
    unset($_SESSION['kit_preco']);
    unset($_SESSION['kit']);

    header("Location: ../carrinho/");
?>