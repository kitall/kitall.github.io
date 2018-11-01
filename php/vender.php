<?php
    session_start();

    //LOGIN é necessário
    if(empty($_SESSION['user_id']))
    {
        header("Location: ../login/");
        
        exit;
    }

    $id_usr = $_SESSION['user_id'];
    $email_user = $_SESSION['email'];
    $nome_user = $_SESSION['user'];

    //Variáveis de compra - em sessão
    $carrinho_id = $_SESSION['carrinho_id'];
    $carrinho_qtd = $_SESSION['carrinho_qtd'];
    $carrinho_preco = $_SESSION['carrinho_preco'];
    $carrinho_estoque = $_SESSION['carrinho_estoque'];


    $data = date("d-m-Y");

    $comprado_total = 0;
    $comprado_nome = array();
    $comprado_qtd = array();

    //--------------------------------------------
    include "connect.php";

    $qtd_de_prod = $_SESSION['carrinho'];
    for($i=0; $i<$qtd_de_prod; $i++)
    {
        //Pegar o saldo atual para fazer as contas
        $sql = "SELECT saldoatual FROM f_fluxocaixa 
            ORDER BY id_fluxocaixa DESC LIMIT 1";
        $res = pg_query($conectar, $sql);
        $qtd_sql = pg_num_rows($res);
        if ($qtd_sql > 0) 
        {
            while ($fluxocaixa = pg_fetch_array($res)) 
            {
                $saldoanterior = $fluxocaixa['saldoatual'];
            }        }
        else
        {
            echo "Erro no saldo anterior!";
            exit;
        }

        //-----------------------------------------------
        //Parametros de adição        
        $id_prod = $carrinho_id[$i];
        $qtd = $carrinho_qtd[$i];
        $preco = $carrinho_preco[$i];
        $estoque = $carrinho_estoque[$i];
        
        $compra = $qtd * $preco;
        $saldoatual = $saldoanterior + $compra;
        $qtd_final = $estoque - $qtd;
        
        //Tabela vendas
        $sql = "INSERT INTO p_vendas VALUES
        (DEFAULT, '$id_usr', '$id_prod', '$qtd', '$preco', '$data', 'FALSE'); ";

        //Tabela fluxo de caixa
        $sql .= "INSERT INTO f_fluxocaixa VALUES
            (DEFAULT, '$data', 'Venda de produtos', '$saldoanterior', '$compra', '0.00', '$saldoatual'); ";
        
        //Tabela fluxo de estoque
        $sql .= "INSERT INTO f_fluxoestoque VALUES
            (DEFAULT, '$data', 'Venda', '$id_prod', '$estoque', '0', '$qtd', '$qtd_final'); ";

        //Nova quantidade do produto
        $sql .= "UPDATE p_produtos SET
            qtd = '$qtd_final'
            WHERE id_prod = $id_prod; ";
       
        //Executar SQL
        $res = pg_query($conectar, $sql);
        $qtd_sql = pg_affected_rows($res);
        if ($qtd_sql <= 0) 
        {
            break;
            
            $erro = pg_last_error($conectar);
            
            echo "Erro na execucao do SQ - vendaL!<br><br>";
            echo "Erro: ".$erro;
            
            pg_close($conectar);
        }
        
        $sql = "SELECT nome FROM p_produtos 
            WHERE id_prod='$id_prod';";
        $res = pg_query($conectar, $sql);
        $qtd_sql = pg_affected_rows($res);
        if ($qtd_sql > 0) 
        {
            while($prod = pg_fetch_array($res))
            {
                if($comprado_total == 0)
                {
                    $comprado_nome = array(htmlentities($prod['nome'], 0, "UTF-8"));
                    $comprado_qtd = array(htmlentities($qtd, 0, "UTF-8"));
                    $comprado_total = $compra;
                }
                else
                {
                    array_push($comprado_nome, $prod['nome']);
                    array_push($comprado_qtd, $qtd);
                    $comprado_total += $compra;
                }
            }
        }
        else
        {
            break;
            
            $erro = pg_last_error($conectar);
            
            echo "Erro na execucao do SQL - email!<br><br>";
            echo "Erro: ".$erro;
            
            pg_close($conectar);
        }
    }

    //Enviar Email de confirmação da Compra
    include "email/email.php";
        $_SESSION['compra_nome'] = $comprado_nome;
        $_SESSION['compra_qtd'] = $comprado_qtd;
        $_SESSION['compra_total'] = $comprado_total;
        //
        mandaEmail($email_user, $nome_user, 3);
        //
        unset($_SESSION['compra_nome']);
        unset($_SESSION['compra_qtd']);
        unset($_SESSION['compra_total']);


    //Limpar o carrinho
    unset($_SESSION['carrinho_id']);
    unset($_SESSION['carrinho_qtd']);
    unset($_SESSION['carrinho_preco']);
    unset($_SESSION['carrinho_estoque']);
    $_SESSION['carrinho'] = 0;

    pg_close($conectar);

exit;
?>
<script>
	alert("Compre efetuada com sucesso!");
	window.location.href="../";
</script>