<?php
   
   //cadena conexion
   require_once  "../modelos/encuesta.php";

    $estado="CONFIRMADO";

  $encuesta= new Encuesta();


   $Date = date('Y-m-d', time());
 

   $comentario=$_POST['comentario'];


    $calificacion=$_POST["calificacion"];


    $idmatricula=$_POST["codMatricula"];
    // $idmatricula="5316-42573134";
    

    $rspta=$encuesta->actualizar($idmatricula,$estado,$calificacion,$comentario,$Date);
	echo $rspta ? "Comentario registrado" : "Comentario no se pudo registrar";
	echo mysqli_error($conexion);
?>