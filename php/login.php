<?php
    //session_start();
    include "conect_cad.php";

    $usr_ou_email = $_POST['user'];
    $passwd = $_POST['senha'];

    if($usr_ou_email == "kitall" && $passwd == "kitallEComm2018")
    {
        header("Location: ../admin/");
        exit;
    }
    else if(strpos($usr_ou_email, '@')) //email
    {
        $sql = "SELECT * FROM usuario 
            WHERE email = '$usr_ou_email';";
    }
    else //user
    {
        $sql = "SELECT * FROM usuario 
            WHERE login = '$usr_ou_email';";
    }

    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if($qtd > 0)
    {
        $usr = pg_fetch_array($res);
        $senha = $usr['senha'];
        
        if($senha == md5($passwd))
        {
            echo "Conectado com sucesso!";
            echo "<br>Bem vindo senhor ".$usr['login'];
        }
        else
        {
            echo "Senha incorreta!";
        }
    }
    else
    {
        pg_close($conectar);
        echo "Usuario nao encontrado!!!";
    }
?>