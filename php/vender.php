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

    $id_prod = $_SESSION['id_venda'];
    $id_usr = $_SESSION['user_id'];

    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];
    $compra = $qtd * $preco;

    $data = date("d-m-Y");

    //--------------------------------------------
    include "connect.php";

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
        
        $saldoatual = $saldoanterior + $compra;
    }
    else
    {
        echo "Erro no saldo anterior!";
        exit;
    }

    //Montar as strings de adição
    $sql = "INSERT INTO p_vendas VALUES
        (DEFAULT, '$id_usr', '$id_prod', '$qtd', '$preco', '$data', 'FALSE'); ";

    $sql .= "INSERT INTO f_lancamento VALUES
        (DEFAULT, '$data', 'Venda de produtos', 'E', '$compra');";

    $sql .= "INSERT INTO f_fluxocaixa VALUES
        (DEFAULT, '$data', 'Venda de produtos', '$saldoanterior', '$compra', '0.00', '$saldoatual');";
    
    $qtd--;
    $sql .= "UPDATE p_produtos SET
        qtd = '$qtd'
        WHERE id_prod = $id_prod;";
    unset($_SESSION['id_venda']);

    //Adicionar
    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if ($qtd > 0) 
    {
        echo "Compra efetuada com sucesso!";
        echo "<br><a href='../index.php'>Home</a>";
    }
    else
    {
        $erro = pg_last_error($conectar);
        echo "Erro na execucao do comando!<br><br>";
        echo "Erro: ".$erro;
    }
?>