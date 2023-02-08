<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Mediopagos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO mediospagos (nombre,condicion)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idmediospagos,$nombre)
	{
		$sql="UPDATE mediospagos SET nombre='$nombre' WHERE idmediospagos='$idmediospagos'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idmediospagos)
	{
		$sql="UPDATE mediospagos SET condicion='0' WHERE idmediospagos='$idmediospagos'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idmediospagos)
	{
		$sql="UPDATE mediospagos SET condicion='1' WHERE idmediospagos='$idmediospagos'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idmediospagos)
	{
		$sql="DELETE FROM mediospagos WHERE idmediospagos='$idmediospagos'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmediospagos)
	{
		$sql="SELECT * FROM mediospagos WHERE idmediospagos='$idmediospagos'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM mediospagos";
		return ejecutarConsulta($sql);		
	}
	
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM mediospagos where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>