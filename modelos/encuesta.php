<?php

 require "../configuraciones/Conexion.php";


$estado="CONFIRMADO";

class Encuesta{

	//Implementamos nuestro constructor
	public function __construct()
	{
	}

    public function actualizar($idmatricula,$estado,$calificacion,$comentario,$Date)
	{	
		$sql="UPDATE matricula SET satisfacion='$calificacion',estadosatisfacion='$estado',observaciones_satisfacion='$comentario',fechainfo='$Date' WHERE cod_matricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	 public function obtenerEstado($idmatricula)
	 {	
	 	$sql="SELECT estadosatisfacion FROM matricula where cod_matricula='$idmatricula'";
	 	return ejecutarConsulta($sql);
	 }
}
?>