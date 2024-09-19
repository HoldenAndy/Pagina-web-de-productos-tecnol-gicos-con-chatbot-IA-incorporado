<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    function enviarEmail($email, $asunto, $cuerpo)
    {
        require_once '../config/config.php';
        require '../phpmailer/src/PHPMailer.php';
        require '../phpmailer/src/SMTP.php';
        require '../phpmailer/src/Exception.php';
        $mail = new PHPMailer(true); 

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP(); // Send using SMTP
    $mail->Host       = MAIL_HOST; // Set the SMTP server to send through
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = MAIL_USER; // SMTP username
    $mail->Password   = MAIL_PASS; // App-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
    $mail->Port       = MAIL_PORT; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(MAIL_USER, 'Danny');
    $mail->addAddress($email);     //Add a recipient
     /*$mail->addAddress('ellen@example.com');               //Name is optional
   $mail->addReplyTo('info@example.com', 'Information');*/
  
   //Content
   $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = $asunto;
 
   $mail->Body    = $cuerpo;
   $mail->setLanguage('es', 'C:\xampp\htdocs\ProyectoFinalTallerWeb\PHP-PROYECTO\phpmailer\language\phpmailer.lang-es.php');

   if ($mail->send()){
    return true;

   }else{
    return false;
   }
   echo 'correo enviado';
} catch (Exception $e) {
   echo "No se puede enviar el mensaje . Error en el envio: {$mail->ErrorInfo}";
   return false;
}
    }

}
