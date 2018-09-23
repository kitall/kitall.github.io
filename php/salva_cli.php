<?php
    //Dados do cadastro obrigatório
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $sexo = $_POST['sexo'];
    $data_nasc = $_POST['data_nasc'];
    $celular = $_POST['celular'];

    $login = $_POST['login'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //Dados do endereço de entrega
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];

    //--------------------------------------------------//

    include "conect_cad.php";
    
    $senha = md5($senha);
    
    $sql = "INSERT INTO usuario(id_usuario, login, email, senha, excluido) 
        VALUES(DEFAULT, '$login', '$email', '$senha', 'n'); 
        SELECT id_usuario FROM usuario WHERE email='$email';";
        
    $res = pg_query($conectar, $sql);
    $qtd = pg_num_rows($res);
    if($qtd > 0)
    {
        //Pega o id cadastrado anteriormente
        $prod = pg_fetch_array($res);
        $id = $prod['id_usuario'];
        
        //Cadastro do cliente
        $sql = "INSERT INTO cliente(id_usuario, nome, sobrenome, sexo, data_nasc, celular, excluido)
        VALUES('$id', '$nome', '$sobrenome', '$sexo', '$data_nasc', '$celular', 'n');";
        
        //Cadastro do endereço
        if($endereco != NULL && $numero != NULL && $bairro != NULL && $cidade != NULL && $cep != NULL && $estado != NULL && $pais != NULL)
        {
            if($complemento != NULL) //complemento?
            {
                $sql = $sql."INSERT INTO endereco(id_endereco, id_usuario, endereco, numero, complemento, bairro, cep, cidade, estado, pais, excluido)
                VALUES(DEFAULT, '$id', '$endereco', '$numero', '$complemento', '$bairro', '$cep', '$cidade', '$estado', '$pais', 'n');";
            }
            else
            {
                $sql = $sql."INSERT INTO endereco(id_endereco, id_usuario, endereco, numero, bairro, cep, cidade, estado, pais, excluido)
                VALUES(DEFAULT, '$id', '$endereco', '$numero', '$bairro', '$cep', '$cidade', '$estado', '$pais', 'n');";
            }
        }
        else
        {
            echo "n entrou no if do endereco";
            pg_close($conectar);
        }
        
        $res = pg_query($conectar, $sql);
        $qtd = pg_affected_rows($res);
        
        if($qtd > 0)
        {
           //eviar um email 
        }
        else
        {
            echo "<br<br>erro na inclusão do endereço e cliente no banco";
        }
        
        pg_close($conectar);
    }
    else
    {
        echo "Erro no cadastro de tudo!";
        pg_close($conectar);
    }
?>