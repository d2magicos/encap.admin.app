<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Videotutorial
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion1)
	{
		$sql="INSERT INTO videostutorial (nombre,descripcion,condicion)
		VALUES ('$nombre','$descripcion1','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idvtutorial,$nombre,$descripcion1)
	{
		$sql="UPDATE videostutorial SET nombre='$nombre', descripcion='$descripcion1' WHERE idvtutorial='$idvtutorial'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idvtutorial)
	{
		$sql="UPDATE videostutorial SET condicion='0' WHERE idvtutorial='$idvtutorial'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idvtutorial)
	{
		$sql="UPDATE videostutorial SET condicion='1' WHERE idvtutorial='$idvtutorial'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idvtutorial)
	{
		$sql="SELECT * FROM videostutorial WHERE idvtutorial='$idvtutorial'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idvtutorial)
	{
		$sql="DELETE FROM videostutorial WHERE idvtutorial='$idvtutorial'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM videostutorial";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM videostutorial where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>
