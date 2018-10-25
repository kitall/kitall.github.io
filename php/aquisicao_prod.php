<?php
    $valor_gasto = $_POST['val'];

    $data = date("d-m-Y");

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
        
        $saldoatual = $saldoanterior - $valor_gasto;
    }
    else
    {
        echo "Erro no saldo anterior!";
        exit;
    }

    //Montar as strings de adição
    $sql = "INSERT INTO f_fluxocaixa VALUES
        (DEFAULT, '$data', 'Aquisicao de produtos', '$saldoanterior', '0.00', '$valor_gasto', '$saldoatual')";

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if ($qtd > 0) 
    {
        pg_close($conectar);
        
        header("Location: ../admin/");
    }
    else
    {
        pg_close($conectar);
        
        echo "Erro na execucao do comando!";
    }
?>