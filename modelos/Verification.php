<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

date_default_timezone_set("America/Lima");

//Load Composer's autoloader
require '../vendor/autoload.php';

class Verification {
    public function __construct() { }

    public function sendCode($nombre, $email, $code) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'mail.buscatuempleo.pe'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'developer@buscatuempleo.pe'; //SMTP username
            $mail->Password = 'QP=R6(^?xW8h'; //SMTP password
            $mail->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('developer@buscatuempleo.pe', 'Sistemas ENCAP');
            $mail->addAddress($email, $nombre); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Código de verificación';
            $mail->Body = '
                <div>
                    <p>El usuario '. $nombre .' está intentando acceder al sistema</p>
                    <p>Hora de solicitud: '. date('d/m/Y H:i:s') .'</p>
                    <b>Código de verificación: </b>'. $code .'
                </div>';
                
            // Activo condificacción utf-8
            $mail->CharSet = 'UTF-8';

            $mail->send();
            echo 'Enviado correctamente..';
        } catch (Exception $e) {
            echo "Error al enviar: {$mail->ErrorInfo}";
        }
    }
}
