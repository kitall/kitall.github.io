<?php
    $conectar = pg_connect("host=localhost port=5432 dbname=2018_72a_Kitall
                            user=kitall password=kitallEComm2018");
    if(!$conectar)
    {
        echo "Erro na conecao com o Banco de Dados!";
        exit;
    }
?>