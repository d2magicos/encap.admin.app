<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
// datos SMTP-SERVER

//permitir conexiones de fuera
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

//include "vendor/phpmailer/phpmailer/src/PHPMailer.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\POP3;
//Load composer's autoloader
require 'vendor/autoload.php';

$dni=$_POST["dni"];
$curso=$_POST["curso"];
$email=$_POST["email"];
$nombre=$_POST["nombre"];

/*$dni="15646123";
$curso="CURSO DE OFIMÁTICA BÁSICA";
$email="admin@encap.edu.pe";
$nombre="Jesús";*/

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
   // $pop = new POP3();
	//$pop->Authorise("jahh19channel.xyz", 465, 30, "admin@jahh19channel.xyz", "3Pk+z7PP?nz%", 1);
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'encap.edu.pe';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'notificaciones@encap.edu.pe';                // SMTP username
    $mail->Password = 'oPTV3+Zf}!60';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 587
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('admin@encap.edu.pe', utf8_decode('ENCAP - Escuela Nacional de Capacitación y Actualización Profesional'));
    $mail->addAddress($email, $nombre);     // Add a recipient
    //$mail->addAddress('contact@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //  $mail->addAttachment('pdf/6806-72686258-SANCHEZ LARREA, LAURA KATERINE.pdf');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'FELICIDADES!!! YA PUEDES ACCEDER A TU CURSO';
    $mail->Body    = utf8_decode('
<body style="width: 800px; margin: auto; border-style: solid; border: solid 2px #192441 ; border-color: #192441; border-radius: 10px;">
    <div style="width: 800px; height: 90px; background-color: #192441; margin: auto; border-radius: 7px 7px 0px 0px;">
      <div style="vertical-align: top;">
        <img src="https://encap.edu.pe/cursos/wp-content/uploads/2021/01/LOGO-PNGRecurso-6.png" alt="" style="width: 253px; height: 53px; margin-left: 25px; margin-top: 15px;">
        <div style="vertical-align: top; float: right; padding: 0px 15px 0px 0px;">
          <ul style="color: #ffffff;">
            <li>Mejora tu CV o portafolio.</li>
            <li>Mayor empleabilidad.</li>
            <li>Avanza a tu ritmo.</li>
          </ul>
        </div>
      </div>
    </div>
    <div>
         <h2 style="font-weight: bold;font-family: Arial, Helvetica, sans-serif; color: red; font-size: 24px; margin-left: 5px;text-align:center"> FELICIDADES!!! </h2>
      <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> Hola: '.$nombre.' </p>
      <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> Gracias por confiar en ENCAP.</p>
      <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> Tu acceso al curso "<strong style="color: #2332AD;">
          '.$curso.'.
        </strong>" se ha generado con éxito.
      </p>
    </div>
    <div style="border: 2px solid #2332AD; padding-bottom: 10px; width: 500px; margin: auto; border-radius: 10px; " ;>
      <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> <strong>Para acceder a tu curso y descargar tu certificado:</strong>  </p>
      <p style="margin-left: 15px; font-weight: bold;">
        <a style="text-decoration: none; color:#2332AD ;" href="https://sistemas.encap.edu.pe/intranet/" target="_blank">INGRESA AQUI: &#128073;https://sistemas.encap.edu.pe/intranet/&#128072;</a>
            </p>
            <p style=" margin-left: 15px; font-weight: bold;">Usuario: '.$dni.'
      </p>
     
      
    </div>
     <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> Si tienes alguna duda o consulta ponte en contacto con nosotros:</p>
     
    <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;font-weight: bold;"> Área de VENTAS:</p>
 <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> Cel. 951 428 884<br>
    Cel. 930 627 791</p>
    
    <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;font-weight: bold;"> Área de SOPORTE:</p>
 <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> Cel. 925 248 166<br><br>
      <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"><strong> Web:</strong> <a href="https://encap.edu.pe/cursos/" target="_blank">https://encap.edu.pe/cursos/</a></p> 
         <p style="font-family: Arial, Helvetica, sans-serif; margin-left: 5px;"> <strong>Correo:</strong> admin@encap.edu.pe</p>
   
    <div style="text-align: center;">
      <br>
      
      <div></div>
      <div style="width: 800px; height: 200px; background-color: #192441; margin: auto; margin-top: 10px 10px; color: white;">
        <p>&nbsp;</p>
        <div style="vertical-align: top; float: left; border-style: solid; border-width: 0px 2px 0px 0px; padding-bottom: 0px; width: 380px; margin: auto; border-radius: 0px;">
          <br />
          <br />
          <img style="width: 250px; height: 53px; margin-left: 15px; margin-top: 10px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/LOGOENCAPBLANCO.png" alt="" />
          <br />
          <br />
        </div>
        <div style="vertical-align: top; float: right; padding-bottom: 0px; width: 350px; margin: auto;">
          <p style="padding-top: 10px; margin-left: 5px; text-align: left;">
            <strong>CURSOS - DIPLOMAS - DIPLOMAS DE ESPECIALIZACIÓN</strong>
            <br />
            <img style="width: 17px; height: 20px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/icono-movil.png" alt="" />&nbsp; <strong>930 627 791 / 951 428 884</strong>
            <br />
            <img style="width: 20px; height: 20px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/icono-web.png" alt="" />&nbsp; <a style="color: white;" href="https://encap.edu.pe/cursos/">www.encap.edu.pe</a>
            <br />
            <img style="width: 17px; height: 20px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/icono-ubicacion.png" alt="" />&nbsp; Perú
          </p>
        </div>
      </div>
      <div style="width: 800px; height: 48px; background-color: #192441; color: #FAFAFA; border-style: solid; border-width: 1px 0px 0px 0px; text-align: center;">
        <a href="https://www.facebook.com/www.encap.edu.pe" target="_blank">
          <img style="width: 28px; height: 28px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/iconoface.png" alt="" />
        </a>&nbsp;&nbsp; <a href="https://www.instagram.com/encap_capacitaciones/" target="_blank" rel="noopener">
          <img style="width: 28px; height: 28px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/iconoinstagram.png" alt="" />
        </a>&nbsp; &nbsp; <a href="https://www.linkedin.com/company/encap-capacitaciones" target="_blank" rel="noopener">
          <img style="width: 28px; height: 28px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/iconolinkeding.png" alt="" />
        </a>&nbsp; &nbsp; <a href="https://www.youtube.com/channel/UCoykMqF0vtwGq7Tk53qklRw" target="_blank" rel="noopener">
          <img style="width: 28px; height: 28px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/iconoyoutube.png" alt="" />
        </a>&nbsp; &nbsp; <a href=https://chat.whatsapp.com/IUoPULRX3QLLJEWQezWspi target="_blank" rel="noopener">
          <img style="width: 28px; height: 28px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/iconowasap.png" alt="" />
        </a>&nbsp; &nbsp; <a href="https://t.me/Encap_capacitaciones" target="_blank" rel="noopener">
          <img style="width: 28px; height: 28px; margin-left: 1px; margin-top: 8px;" src="https://encap.edu.pe/cursos/wp-content/uploads/2021/10/iconotelegram.png" alt="" />
        </a>
      </div>
      </div>
  </body>');
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Se envío el mensaje correctamente.';
} catch (Exception $e) {
    echo 'Ocurrio un error al enviar el mensaje.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>