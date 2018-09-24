<?php
    $conectar = pg_connect("host=localhost port=5432 dbname=2018_72_Compartilhado
                            user=alunocti password=alunocti");
    if(!$conectar)
    {
        throw new Exception("Não foi possível conectar ao banco de dados!");
        exit;
    }
?>