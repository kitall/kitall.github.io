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
		$mail->IsHTML(true); 
		$mail->CharSet = 'utf-8'; 
		$mail->Subject  = $subject; // Assunto da mensagem
		$mail->Body .= $message;
		$enviado = $mail->Send();
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
		if (!$enviado) 
		{
			throw new Exception("Não foi possível conectar ao banco de dados!");
       		exit;
		} 
	}
?>