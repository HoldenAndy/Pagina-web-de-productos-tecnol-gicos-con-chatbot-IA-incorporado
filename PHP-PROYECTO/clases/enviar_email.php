<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\ProyectoFinalTallerWeb\PHP-PROYECTO\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\ProyectoFinalTallerWeb\PHP-PROYECTO\phpmailer\src\SMTP.php';
require 'C:\xampp\htdocs\ProyectoFinalTallerWeb\PHP-PROYECTO\phpmailer\src\Exception.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP(); // Send using SMTP
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = 'dannyzara775@gmail.com'; // SMTP username
    $mail->Password   = 'rvac xxvb jjlg lyjq'; // App-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
    $mail->Port       = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('dannyzara775@gmail.com', 'Danny');
    $mail->addAddress('dannyzapataramos9@gmail.com', 'Danny');     //Add a recipient
     /*$mail->addAddress('ellen@example.com');               //Name is optional
   $mail->addReplyTo('info@example.com', 'Information');*/
  
   //Content
   $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = 'Prueba desde GMAIL';
   $cuerpo = '<h4>Gracias por su compra</h4>';
   $cuerpo .= '<p> El ID de su compra es <b>'.$id_transaccion . '</b></p>';
   $mail->Body    = $cuerpo;
   $mail->AltBody= 'enviamos los detalles de su compra';

   $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

   $mail->send();
   echo 'correo enviado';
} catch (Exception $e) {
   echo "Error al enviar el correo de su compra: {$mail->ErrorInfo}";
   exit;
}