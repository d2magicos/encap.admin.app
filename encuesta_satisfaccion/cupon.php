<?php require "../configuraciones/Conexion.php"; ?>

<?php
    $doc = $_GET["id"];
                          
    $resultadop = mysqli_query($conexion, "SELECT p.nombre, m.cod_matricula, m.fechainfo
                                           FROM gestionsatisfaccion gs 
                                           INNER JOIN matricula m ON gs.idmatricula = m.idmatricula 
                                           INNER JOIN persona p ON m.idparticipante = p.idpersona
                                           WHERE m.idmatricula = '".$doc."'");

    $consulta = mysqli_fetch_array($resultadop);

    $date = strtotime($consulta["fechainfo"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta Enviada</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style1.css">
</head>
<body class="body__pagdos">
    <div class="enviando">
        <div class="header__imagen">
            <img class="header__imagen__pagdos" src="img/ENCAP.png" alt="Logo Encap">
        </div>
        <div class="enviando__contenido">
            <div class="enviando__textos"> 
                <p class="enviando_texto" >Felicitaciones!!!</p>
                <!-- <p>DANIEL LOVERA</p> -->
                <p class="enviando_texto" >GANASTE UN CUPÓN DE DESCUENTO (S/.20)<br> PARA TU PRÓXIMO CURSO.<br><mark>(válido solo hasta mañana 7:00 PM)</mark></p>
                <div class="enviando__datos">
                    <?php
                        echo 
                        "<ul>".
                            "<li><p>CUPÓN: <span>'ENCAP2030'</span></p></li>".
                            "<li><p>NOMBRE: <span>".$consulta["nombre"]."</span></p></li>".
                            "<li><p>CÓDIGO DE MATRÍCULA: <span>".$consulta["cod_matricula"]."</span></p></li>".
                            "<li><p>FECHA: <span>".date('d-m-Y', $date)."</span></p></li>".
                        "</ul>";
                    ?>
                    <div class="imagen-gif">
                        <img src="img/flechas-gif.webp" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="enviando__contacto">
            <div class="contacto__texto">
                <p><mark>Nota:  Para hacer efectivo este cupón, <br> envia una captura de pantalla a nuestros asesores:</mark></p>
            </div>
            <div class="contacto__whatsap">
                <div class="contacto__joseph">
                    <span>Jhosep:</span>
                    <a target="_blank" href="https://wa.link/eha8aw"><img src="img/icons8-whatsapp-64.png" ></img>930 627 791</a>
                </div>
                <div class="contacto__mycol">
                    <span>Maycol:</span>
                    <a target="_blank" href="https://wa.link/a0hur9"><img src="img/icons8-whatsapp-64.png" ></img>951 428 884</a>
                </div>
            </div>
            <br>
        </div>
        <!-- <div class="btn_pagdos">
            <a target="_blank" class="volver__inicio" class="btn_encuesta_enviada" href="https://encap.edu.pe/cursos/">Revisa nuestros cursos, CLICK AQUÍ</a>
        </div> -->
    </div>
</body>
</html>