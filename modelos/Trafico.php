<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Trafico
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO trafico (nombre,condicion)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idtrafico,$nombre)
	{
		$sql="UPDATE trafico SET nombre='$nombre' WHERE idtrafico='$idtrafico'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idtrafico)
	{
		$sql="UPDATE trafico SET condicion='0' WHERE idtrafico='$idtrafico'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idtrafico)
	{
		$sql="UPDATE trafico SET condicion='1' WHERE idtrafico='$idtrafico'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtrafico)
	{
		$sql="SELECT * FROM trafico WHERE idtrafico='$idtrafico'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idtrafico)
	{
		$sql="DELETE FROM trafico WHERE idtrafico='$idtrafico'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM trafico";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM trafico where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>
