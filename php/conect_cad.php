<?php
    $conectar = pg_connect("host=localhost port=5432 dbname=2018_72_Compartilhado
                            user=alunocti password=alunocti");
    if(!$conectar)
    {
        echo "Erro na conecao com o Banco de Dados!";
        exit;
    }
?>