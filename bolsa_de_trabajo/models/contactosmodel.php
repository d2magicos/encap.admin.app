<?php
date_default_timezone_set("America/Lima");

class ContactosModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function send_email($data)
    {
        // datos
        $docu = $data["num_docu"];
        $name = $data["nombre"];
        $cel = $data["celular"];
        $email = $data["email"];
        $sms = $data["mensaje"];
        // enviar correo
        $to = EMAIL;
        $subject = "ENCAP-BOLSA DE TRABAJO-CONTACTO";
        $mensaje   = `
        Un cliente quiere comunicarse con ENCAP
        --------------------------------------------------
        DATOS DEL CLIENTE:
        
        Documento: $docu
        Nombre: $name
        Celular: $cel
        Correo electrónico: $email
        Mensaje:
        $sms
        `;
        $headers = 'From: ' . $email . "\r\n";
        $reply = mail($to, $subject, $mensaje, $headers);

        if ($reply) {
            return array("success" => true, "success" => "Mensaje enviado con éxito");
        } else {
            return array("success" => false, "message" => "El mensaje no se pudo enviar, intentalo más tarde.");
        }
    }
}
