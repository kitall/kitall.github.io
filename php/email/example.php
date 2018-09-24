<?php
	include "email.php"; //Incluindo esse arquivo "email.php", já é possível utilizar a função abaixo, sendEmail()
	try
	{
		$recipient = "tevo.pr@gmail.com";
		$name = "Estevão Rolim";
		$subject = "Just an example.";
		$msg = "<h1>Hello!</h1>";
		sendEmail($recipient, $name, $subject, $msg);
		
		echo "Email enviado com sucesso para $recipient!";
	} catch(Exception $e){
		echo "\nAlgo deu errado!".$e.getMessage();
	}
?>