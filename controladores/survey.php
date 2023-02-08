<?php
    //cadena conexion
    require_once  "../modelos/Survey.php";

    $survey = new Survey();
    
    $idmatricula = $_POST["cod_matricula"];
    $estado = "CONFIRMADO";
    //  $calificacion = $_POST["qualification"];
    $comentario = $_POST['comment'];
    $Date = date('Y-m-d', time());
    // $idmatricula="5316-42573134";

    //  $rspta = $survey->actualizar($idmatricula, $estado, $calificacion, $comentario, $Date);
    $rspta = $survey->actualizar($idmatricula, $estado, $comentario, $Date);
	echo $rspta ? "Comentario registrado" : "Comentario no se pudo registrar";
	echo mysqli_error($conexion);
?>