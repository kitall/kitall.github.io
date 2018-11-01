<?php
	function sendEmail ($email, $nome, $subject, $message){
		require_once("class.phpmailer.php");
		require_once("class.smtp.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0; 
		$mail->SMTPAuth = true;	
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com'; 
		$mail->Port = 465;
		$mail->SMTPAuth = true; 
		$mail->Username = 'kitall.contato@gmail.com';//Configurar pelo link https://support.google.com/accounts/answer/6010255?hl=pt-BR 
		$mail->Password = 'EKTf$%pcDn=z^Frrjg!xK_ex7Yd-f8?xnb8C%ux5fAh6!xq-HHw=4b-Sr+eHtVVvqYXXfNBCZVa*-r*Rv%V3s@gmc_%rKhqL9!N';
		$mail->SetFrom('kitall.contato@gmail.com','Kitall?'); 
		$mail->AddAddress("$email","$nome"); //Muda Aqui para as variaveis que vem do SELECT
        $mail->AddEmbeddedImage('../images/icons/icon-128x128.png', 'kitall_logo', 'kitall_logo.png');
		$mail->IsHTML(true); 
		$mail->CharSet = 'utf-8'; 
		$mail->Subject  = $subject; // Assunto da mensagem
		$mail->Body .= $message;
		$enviado = $mail->Send();
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
		if (!$enviado) 
		{
			throw new Exception("Ocorreu um erro no envio do Email!");
       		exit;
		} 
	}

    function mandaEmail($email, $nome, $op)
    {
        if($op == 1) //Email do cadastro
        {
            sendEmail($email, $nome, "Kitall? - Bem-Vindo!", "
<!DOCTYPE html>
<html lang='pt-br' style='transition-property: border, background, opacity;transition-duration: 0.2s;margin: 0;padding: 0;display: block;background-color: #fafafa;max-width: 100vw;'>
<head style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
    <meta charset='UTF-8' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
    <style type='text/css' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
        @import url('https://fonts.googleapis.com/css?family=Quicksand:300,regular,500,700');

        * {
            font-family: 'Quicksand', sans-serif;
            /* font-family: 'Arial', sans-serif; */
            color: #191919;
        }

        *,
        *::before,
        *::after {
            transition-property: color;
            transition-duration: 0;
            transition-property: border, background, opacity;
            transition-duration: 0.2s;
        }

        *::selection {
            background-color: #1CCE00;
            color: white;
        }
        
        /*--------------------------------------------------*/
        
        body,
        html {
            margin: 0;
            padding: 0;
            display: block;
        }

        html {
            background-color: #fafafa;
            max-width: 100vw;
        }
        
        #email {
            background-color: #eaeaea;
            
            text-align: center;
            
            width: 700px;
        }
        
    </style>
</head>
<body style='transition-property: border, background, opacity;transition-duration: 0.2s;margin: 0;padding: 0;display: block;'>
    <center style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
        <div id='email' style='transition-property: border, background, opacity;transition-duration: 0.2s;background-color: #eaeaea;text-align: center;width: 700px;'>
            <h1 style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Bem-vindo, $nome!</h1>

            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>O cadastro dos seus dados no nosso sistema foi efetuado com sucesso!</p>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Agora você pode usufruir livremente os nossos serviços de compra online.</p>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Obrigado pela preferência!</p>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Att, Equipe 'Kitall?'</p>

            <a href='https://200.145.153.175/andrecreppe/kitall' style='transition-property: border, background, opacity;transition-duration: 0.2s;'><img src='\&quot;cid:kitall_logo\&quot;' style='transition-property: border, background, opacity;transition-duration: 0.2s;'></a>

            <br style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
            <br style='transition-property: border, background, opacity;transition-duration: 0.2s;'>

            <a href='https://200.145.153.175/andrecreppe/kitall' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Bora então comprar um kit? Kitall?</a>
        </div>
    </center>
</body>
</html>
            
");
        }
        else if($op == 2) //Email do cad_endereço
        {
            sendEmail($email, $nome, "Kitall? - Cadastro do Endereço", "
            
<!DOCTYPE html>
<html lang='pt-br' style='transition-property: border, background, opacity;transition-duration: 0.2s;margin: 0;padding: 0;display: block;background-color: #fafafa;max-width: 100vw;'>
<head style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
    <meta charset='UTF-8' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
    <style type='text/css' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
        @import url('https://fonts.googleapis.com/css?family=Quicksand:300,regular,500,700');

        * {
            font-family: 'Quicksand', sans-serif;
            /* font-family: 'Arial', sans-serif; */
            color: #191919;
        }

        *,
        *::before,
        *::after {
            transition-property: color;
            transition-duration: 0;
            transition-property: border, background, opacity;
            transition-duration: 0.2s;
        }

        *::selection {
            background-color: #1CCE00;
            color: white;
        }
        
        /*--------------------------------------------------*/
        
        body,
        html {
            margin: 0;
            padding: 0;
            display: block;
        }

        html {
            background-color: #fafafa;
            max-width: 100vw;
        }
        
        #email {
            background-color: #eaeaea;
            
            text-align: center;
            
            width: 800px;
        }
        
    </style>
</head>
<body style='transition-property: border, background, opacity;transition-duration: 0.2s;margin: 0;padding: 0;display: block;'>
    <center style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
        <div id='email' style='transition-property: border, background, opacity;transition-duration: 0.2s;background-color: #eaeaea;text-align: center;width: 800px;'>
            <h1 style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Endereço cadastrado com sucesso, $nome!</h1>

            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>O cadastro dos seus dados de entrega foi concluido com sucesso!</p>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Agora nós podemos entregar os produtos requisitados na porta da sua casa!</p>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Obrigado por optar os nossos produtos!</p>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Att, Equipe 'Kitall?'</p>

            <a href='200.145.153.175/andrecreppe/kitall' style='transition-property: border, background, opacity;transition-duration: 0.2s;'><img src='../images/icons/icon-128x128.png' alt='' style='transition-property: border, background, opacity;transition-duration: 0.2s;'></a>

            <br style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
            <br style='transition-property: border, background, opacity;transition-duration: 0.2s;'>

            <a href='200.145.153.175/andrecreppe/kitall' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Bora então comprar um kit? Kitall?</a>
        </div>
    </center>
</body>
</html>            
            
");
        }
        else if($op == 3)
        {
            sendEmail($email, $nome, "Kitall? - Compra efetuada", montaVenda());
        }
        else
        {
            echo "Erro na OP!";
            exit;
        }
    }

    function montaVenda()
    {
        session_start();
        
        $total = $_SESSION['compra_total'];
        $produtos_arr = $_SESSION['compra_nome'];
        $qtd_arr = $_SESSION['compra_qtd'];
        
        $string = 
"
<!DOCTYPE html>
<html lang='pt-br' style='transition-property: border, background, opacity;transition-duration: 0.2s;margin: 0;padding: 0;display: block;background-color: #fafafa;max-width: 100vw;'>
<head style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
    <meta charset='UTF-8' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
    <style type='text/css' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
        @import url('https://fonts.googleapis.com/css?family=Quicksand:300,regular,500,700');

        * {
            font-family: 'Quicksand', sans-serif;
            /* font-family: 'Arial', sans-serif; */
            color: #191919;
        }

        *,
        *::before,
        *::after {
            transition-property: color;
            transition-duration: 0;
            transition-property: border, background, opacity;
            transition-duration: 0.2s;
        }

        *::selection {
            background-color: #1CCE00;
            color: white;
        }
        
        /*--------------------------------------------------*/
        
        body,
        html {
            margin: 0;
            padding: 0;
            display: block;
        }

        html {
            background-color: #fafafa;
            max-width: 100vw;
        }
        
        #email {
            background-color: #eaeaea;
            text-align: center;
            width: 800px;
        }
        
        table {
            padding-right: 50px;
            font-weight: 550;
            text-align: left;
        }
        
        #total {
            text-align: center;
            padding-left: 45px;
        }
        
    </style>
</head>
<body style='transition-property: border, background, opacity;transition-duration: 0.2s;margin: 0;padding: 0;display: block;'>
    <center style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
        <div id='email' style='transition-property: border, background, opacity;transition-duration: 0.2s;background-color: #eaeaea;text-align: center;width: 800px;'>
            <h1 style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Compra efetuada Sr(a) $nome!!</h1>

            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Você comprou o(s) seguinte(s) produto(s):</p>
            <table border='1' align='center' id='table' style='transition-property: border, background, opacity;transition-duration: 0.2s;padding-right: 50px;font-weight: 550;text-align: left;'>
                <ul style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
";

for($i=0; $i<sizeof($produtos_arr); $i++)
{
    $prod = $produtos_arr[$i];
    $qtd = $qtd_arr[$i];
    
    $string .= "<li style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
        ".$qtd."x $prod
    </li>";
}
                
$string .= "</ul>
                <p id='total' style='transition-property: border, background, opacity;transition-duration: 0.2s;text-align: center;padding-left: 45px;'>Totalizando: R$ $total</p>
            </table>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Obrigado por optar pelos nossos produtos!</p>
            <p style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Att, Equipe 'Kitall?'</p>

            <a href='200.145.153.175/andrecreppe/kitall' style='transition-property: border, background, opacity;transition-duration: 0.2s;'><img src='../images/icons/icon-128x128.png' alt='' style='transition-property: border, background, opacity;transition-duration: 0.2s;'></a>

            <br style='transition-property: border, background, opacity;transition-duration: 0.2s;'>
            <br style='transition-property: border, background, opacity;transition-duration: 0.2s;'>

            <a href='200.145.153.175/andrecreppe/kitall' style='transition-property: border, background, opacity;transition-duration: 0.2s;'>Clique para comprar mais um kit!  Kitall?</a>
        </div>
    </center>
</body>
</html>  
";
            
        return $string;
    }
?>