<?php
    session_start();

    $id_usr = $_SESSION['user_id'];

    //Dados do cadastro obrigatório
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $sexo = $_POST['sexo'];
    $data_nasc = $_POST['data_nasc'];
    $celular = $_POST['celular'];

    //Dados do endereço de entrega
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];

    //----------------------------------------------------

    include "connect.php";

    $sql = "UPDATE c_cliente SET
        nome='$nome',
        sobrenome='$sobrenome',
        sexo='$sexo',
        data_nasc='$data_nasc',
        celular='$celular'
            WHERE id_usuario='$id_usr';";
    
    $sql .= "UPDATE c_endereco SET
        endereco='$endereco',
        numero='$numero',
        complemento='$complemento',
        bairro='$bairro',
        cidade='$cidade',
        cep='$cep',
        estado='$estado',
        pais='$pais'
            WHERE id_usuario='$id_usr';";

    $res = pg_query($conectar, $sql);
    $qtd = pg_affected_rows($res);
    if($qtd > 0)
    {
        header("Location: ../minha_conta");

        pg_close($conectar);

        exit;
    }
    else
    {
        echo "Erro no salvamento com o banco de dados!!";

        echo "<br><br>Error: ".pg_last_error($conectar);

        pg_close($conectar);

        exit;
    }
?>