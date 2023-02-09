<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

/* $nombre = $_POST['name'];
$email = $_POST['email']; */

$nombre = "Jediael";
$email = "jedyfer21@gmail.com";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       //  Enable verbose debug output
    $mail->isSMTP();                                            //  Send using SMTP
    $mail->Host       = 'mail.encap.edu.pe';                    //  Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //  Enable SMTP authentication
    $mail->Username   = 'support@encap.edu.pe';                 //  SMTP username
    $mail->Password   = 'fL9YZJ[8;1IW';                         //  SMTP password
    $mail->SMTPSecure = 'ssl';                                  //  Enable implicit TLS encryption
    $mail->Port       = 465;                                    //  TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('support@encap.edu.pe', 'Dev. jedyfer');
    $mail->addAddress($email, $nombre);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Asunto: testing';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Enviado correctamente..';
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}