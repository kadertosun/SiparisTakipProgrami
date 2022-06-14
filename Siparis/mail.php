<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
	$mail->SMTPDebug = 2;									
	$mail->isSMTP(true);	
	$mail->SMTPDebug=SMTP::DEBUG_SERVER;										
	$mail->Host	 = 'smtp-mail.outlook.com';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'Siparisgirisipektaskablo@outlook.com';				
	$mail->Password = 'Siparis.123456';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;
	$mail->CharSet='UTF-8';

	$mail->setFrom('Siparisgirisipektaskablo@outlook.com', 'Yeni Sipariş Girişi');		
	$mail->addAddress('Siparisgirisipektaskablo@outlook.com');

	
	$mail->isHTML(true);								
	$mail->Subject = 'Pektaş Kablo Sipariş Girişi';
	$mail->Body = ' <b>Yeni siparis girisi yapıldı</b> ';

	
    if($mail->send())
	echo "Mail has been sent successfully!";
    else

	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

?>