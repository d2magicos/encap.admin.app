<?php
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

class Empleo
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre, $empresa, $ubi_depa, $ubi_provi, $nvacantes, $renumeracion, $fechainicio, $fechafin, $experiencia, $formacion, $especializacion, $conocimiento, $competencia, $detalle, $destacado)
	{
		$sql = "INSERT INTO empleos (nombre,empresa,ubi_depa,ubi_provi,nvacantes,renumeracion,fechainicio,fechafin,experiencia,formacion,especializacion,conocimiento,competencia,detalle,destacado,condicion)
		VALUES ('$nombre','$empresa','$ubi_depa','$ubi_provi','$nvacantes','$renumeracion','$fechainicio','$fechafin','$experiencia','$formacion','$especializacion','$conocimiento','$competencia','$detalle','$destacado','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idempleo, $nombre, $empresa, $ubi_depa, $ubi_provi, $nvacantes, $renumeracion, $fechainicio, $fechafin, $experiencia, $formacion, $especializacion, $conocimiento, $competencia, $detalle, $destacado)
	{
		$sql = "UPDATE empleos SET nombre='$nombre',empresa='$empresa',ubi_depa='$ubi_depa',ubi_provi='$ubi_provi',nvacantes='$nvacantes',renumeracion='$renumeracion',fechainicio='$fechainicio',fechafin='$fechafin',
		experiencia='$experiencia',formacion='$formacion',especializacion='$especializacion',conocimiento='$conocimiento',competencia='$competencia',detalle='$detalle',destacado='$destacado' WHERE idempleo='$idempleo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idempleo)
	{
		$sql = "UPDATE empleos SET condicion='0' WHERE idempleo='$idempleo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idempleo)
	{
		$sql = "UPDATE empleos SET condicion='1' WHERE idempleo='$idempleo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar registros
	public function eliminar($idempleo)
	{
		$sql = "DELETE FROM empleos WHERE idempleo='$idempleo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idempleo)
	{
		$sql = "SELECT * FROM empleos WHERE idempleo='$idempleo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM empleos";
		return ejecutarConsulta($sql);
	}

	//Obtener los departamentos
	public function get_alldepa()
	{
		$sql = "SELECT depa FROM ubigeo GROUP BY depa";
		return ejecutarConsulta($sql);
	}

	public function get_allprovi($depa)
	{
		$sql = "SELECT provi FROM ubigeo WHERE depa='$depa' GROUP BY provi";
		return ejecutarConsulta($sql);
	}
}
