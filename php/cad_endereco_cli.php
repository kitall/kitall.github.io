<?php
    function cadastrar_endereco($id, $endereco, $numero, $complemento, $bairro, $cep, $cidade, $estado, $pais, $tem_complemento, $onde)
    {
        include "connect.php";
        include "email/email.php";
        
        if($tem_complemento)
        {
            $sql = "INSERT INTO c_endereco(id_endereco, id_usuario, endereco, numero, complemento, bairro, cep, cidade, estado, pais, excluido)
                VALUES(DEFAULT, '$id', '$endereco', '$numero', '$complemento', '$bairro', '$cep', '$cidade', '$estado', '$pais', 'n');";
        }
        else
        {
            $sql = "INSERT INTO c_endereco(id_endereco, id_usuario, endereco, numero, bairro, cep, cidade, estado, pais, excluido)
                VALUES(DEFAULT, '$id', '$endereco', '$numero', '$bairro', '$cep', '$cidade', '$estado', '$pais', 'n');";
        }
        
        $res = pg_query($conectar, $sql);
        $qtd = pg_affected_rows($res);

        if ($qtd <= 0) 
        {
            if($onde == 1) //veio do cadastro
            {
                ?> 
                    <script>
                        alert("Algo deu errado ao tentar cadastrar as Informações de Entrega!\n\nVocê pode tentar novamente ao finalizar a compra!");
                    </script>
                <?php
            }
            else
            {
                ?> 
                    <script>
                        alert("Algo deu errado ao tentar cadastrar as Informações de Entrega!");
                    </script>
                <?php
            }

            pg_close($conectar);

            header("Location: ../");

            exit;
        }

        mandaEmail($email, $nome, 2); //MANDA EMAIL DE CONFIRMAÇÃO DO CADASTRO DO ENDEREÇO
    }
?>