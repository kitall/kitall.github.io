<?php
    session_start();

    //LOGIN é necessário
    if($_SESSION['user'] == null)
    {
        ?> 
        <script>
            alert("É necessário fazer o login para poder comprar!");
        </script>
        <?php
        header("Location: ../login/index.php");
        exit;
    }

    $id_usr = $_SESSION['user_id'];


    //Variáveis de compra - em sessão
    $carrinho_id = $_SESSION['carrinho_id'];
    $carrinho_qtd = $_SESSION['carrinho_qtd'];
    $carrinho_preco = $_SESSION['carrinho_preco'];
    $carrinho_estoque = $_SESSION['carrinho_estoque'];


    $data = date("d-m-Y");

    //--------------------------------------------
    include "connect.php";

    $qtd_prod = $_SESSION['carrinho'];
    for($i=0; $i<$qtd_prod; $i++)
    {
        //Pegar o saldo atual para fazer as contas
        $sql = "SELECT saldoatual FROM f_fluxocaixa 
            ORDER BY id_fluxocaixa DESC LIMIT 1";
        $res = pg_query($conectar, $sql);
        $qtd = pg_num_rows($res);
        if ($qtd > 0) 
        {
            while ($fluxocaixa = pg_fetch_array($res)) 
            {
                $saldoanterior = $fluxocaixa['saldoatual'];
            }
        }
        else
        {
            echo "Erro no saldo anterior!";
            exit;
        }

        //Parametros de adição        
        $id_prod = $carrinho_id[$i];
        $qtd = $carrinho_qtd[$i];
        $preco = $carrinho_preco[$i];
        $estoque = $carrinho_estoque[$i];
        
        $compra = $qtd * $preco;
        $saldoatual = $saldoanterior + $compra;
        
        
        $sql = "";
        
        
        //Tabela vendas
        $sql .= "INSERT INTO p_vendas VALUES
        (DEFAULT, '$id_usr', '$id_prod', '$qtd', '$preco', '$data', 'FALSE'); ";

        //Tabela lancamento
        $sql .= "INSERT INTO f_lancamento VALUES
            (DEFAULT, '$data', 'Venda de produtos', 'E', '$compra'); ";

        //Tabela fluxo de caixa
        $sql .= "INSERT INTO f_fluxocaixa VALUES
            (DEFAULT, '$data', 'Venda de produtos', '$saldoanterior', '$compra', '0.00', '$saldoatual'); ";

        //Nova quantidade do produto
        $qtd_final = $estoque - $qtd;
        $sql .= "UPDATE p_produtos SET
            qtd = '$qtd_final'
            WHERE id_prod = $id_prod; ";
        
        
        //Executar SQL
        $res = pg_query($conectar, $sql);
        $qtd = pg_affected_rows($res);
        if ($qtd > 0) 
        {
            //Remover as variáveis de carrinho
            unset($_SESSION['carrinho_id']);
            unset($_SESSION['carrinho_qtd']);
            unset($_SESSION['carrinho_preco']);
            unset($_SESSION['carrinho']);
            unset($_SESSION['carrinho_estoque']);

            echo "Compra efetuada com sucesso!";
            echo "<br><a href='../index.php'>Home</a>";
        }
        else
        {
            $erro = pg_last_error($conectar);
            echo "Erro na execucao do comando!<br><br>";
            echo "Erro: ".$erro;
        }
    }
?>