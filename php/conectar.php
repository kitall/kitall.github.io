<?php
    $conecta = pg_connect("host=localhost port=5432 dbname=???
                            user=???? password=????");
    if(!$conecta)
    {
        echo "Erro na coneção com o Banco de Dados!";
        exit;
    }
?>