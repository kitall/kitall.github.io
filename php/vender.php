<?php
    session_start();

    //LOGIN é necessário
    if($_SESSION['user'] == null)
    {
        ?> 
        <script>
            alert("É necessário fazer o login para poder comprar!");
        </script>
        <?php
        
        header("Location: ../login/index.php");
        exit;
    }

    $id_prod = $_SESSION['id_venda'];
        unset($_SESSION['id_venda']);
    $id_usr = $_SESSION['user'];

    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];

    $data = date("d-m-Y");

    //--------------------------------------------
    include "connect.php";

    $sql = "INSERT INTO p_vendas VALUES
        (DEFAULT, '$id_usr', '$id_prod', '$qtd', '$preco', '$data', 'FALSE');";

    echo $sql;

    //Update produto (qtd--)
    //Insert into fluxo de caixa
?>