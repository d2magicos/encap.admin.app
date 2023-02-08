<?php
 
    require_once "../modelos/encuesta.php";
     $encuesta= new Encuesta();


 $id_matricula=$_GET["id"];

     if($id_matricula!=null){
        $rspta=$encuesta->obtenerEstado($id_matricula);

        $reg=$rspta->fetch_object();
   
   
   
        $conf= $reg->estadosatisfacion;
   
       
        if($conf=="CONFIRMADO" ){
           header("Location: https://sistemas.encap.edu.pe/encuesta_satisfaccion/encuesta_realizada.html");
           die();
        
        }
   
        echo mysqli_error($conexion);

     }else{
        header("Location: https://sistemas.encap.edu.pe/404.html");
       die();

     }
    
     
 ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
    <link rel="stylesheet" href="../encuesta_satisfaccion/css/normalize.css">
    <link rel="stylesheet" href="../encuesta_satisfaccion/css/style1.css">
    <link rel="stylesheet" href="../public/css/sweetalert.min.css" />
</head>
<body class="body">
    <div class="encuesta">
        <div class="encuesta__contenedor">
            <header class="header">
                <div class="header__contenedor">
                    <div class="header__imagen">
                        <img src="img/ENCAP.png" alt="Logo Encap">
                    </div>
                    <p class="header__texto">
                        Porque tu opinión nos importa, califica nuestros servicios en la escala del 1 al 5.
                    </p>

                    <div class="botones" id="botones">
                        <div class="botones__boton">
                            <img src="img/cara1.PNG" alt="">
                            <button cal="1" id="boton1" type="submit">
                                1
                            </button>
                            <span class="calificacion calificacion_uno">Muy  insatisfecho</span>
                        </div>
                        <div class="botones__boton">
                            <img src="img/cara2.PNG" alt="">
                            <button cal="2" id="boton2" type="submit">
                                2
                            </button>
                            <span class="calificacion calificacion_dos">Insatisfecho</span>
                        </div>
                        <div class="botones__boton">
                            <img src="img/cara3.PNG" alt="">
                            <button cal="3" id="boton3" type="submit">
                                3
                            </button>
                            <span class="calificacion calificacion_tres">Regular</span>
                        </div>
                        <div class="botones__boton">
                            <img src="img/cara4.PNG" alt="">
                            <button  cal="4" id="boton4" type="submit">
                                4
                            </button>
                            <span class="calificacion calificacion_cuatro">Satisfecho</span>
                        </div>
                        <div class="botones__boton">
                            <img src="img/cara5.PNG" alt="">
                            <button cal="5" id="boton5" type="submit">
                                5
                            </button>
                            <span class="calificacion calificacion_cinco">Muy satisfecho</span>
                        </div>
    
                    </div>
                    <div class="contenedor__form">
                        <form id="formulario" class="formulario">
                            <?php
                               // $id_matricula=$_GET["id"];
                                echo '<input name="codMatricula" id="codMatricula" type="hidden" value="'.$id_matricula.'">';
                             ?>
                            <textarea  name="comentario" id="comentario" cols="30" rows="10" oninput="Blank()" placeholder="Porque tu opinión nos importa, déjanos un comentario aquí sobre tu experiencia de compra con nosotros (ENCAP)."></textarea>

                            <input name="calificacion" id="campo" type="hidden" value="">
                            
                            <button id="btn_enviar" class="btn__enviar" type="button" onclick="guardaryeditar()">Enviar</button>
                        </form>
                        
                    </div>
                    
                </div >
            </header>
        </div>
        
    </div>
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <script src="../public/js/sweetalert.min.js"></script>
    <script src="js/encuesta.js"></script>
</body>
</html>