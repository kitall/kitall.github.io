<!DOCTYPE html>
<?php
    session_start();

    //if logado = false -> redirecionar pq ele tentou acessar manualmente

    $nome = $_SESSION['user'];

    /*NESSA PAGINA PEGAR TODOS OS DADOS DELE
    MONTAR O PERFIL DO USUARIO*/
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Minha conta</title>
</head>
<body>
   <br><br><br><br><br>
    <center>
        <?php
            echo "<h3>Você está logado como: $nome</h3>";
        ?>
        <br>
        <br>
        <br>
        <form action="../php/logout.php">
            <input type="submit" value="Logout">
        </form>
    </center>
</body>
</html>