<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/PHPMailer/Exception.php';
require __DIR__.'/PHPMailer/PHPMailer.php';
require __DIR__.'/PHPMailer/SMTP.php';


function sendEmail($email, $subject, $body, $altbody) {
	$mail = new PHPMailer(true);
	try {
		$mail->isSMTP();                                           

		$mail->SMTPAuth   = true;   
		$mail->Host       = 'smtp.gmail.com';  
		$mail->Username   = 'julioaniceto@estudiante.edib.es';                     
		$mail->Password   = 'gueutdqlztzcjzcw';                               

		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
                                  

		$mail->setFrom('julioaniceto@estudiante.edib.es', 'Administrador de la web'); //quien lo manda
		$mail->addReplyTo('julioaniceto@estudiante.edib.es', 'Administrador de la web'); //quien lo manda

		$mail->addAddress($email); //quien lo recibe

		//Content
		$mail->isHTML(true);                                 
		$mail->Subject = $subject;

		$mail->Body    = $body;
		$mail->AltBody = $altbody;

		if($mail->send()) {
			return true;
		} else {
			return false;
		}

	} catch (Exception $e) {
		return false;
	}
}
?>