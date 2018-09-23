<?php
    $conectar = pg_connect("host=localhost port=5432 dbname=2018_72a_Kitall
                            user=kitall password=kitallEComm2018");
    if(!$conectar)
    {
        throw new Exception("Não foi possível conectar ao banco de dados!");
        exit;
    }
?>