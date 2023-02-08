<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Asunto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$observaciones)
	{
		$sql="INSERT INTO asunto (nombre,observaciones,condicion)
		VALUES ('$nombre','$observaciones','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idasunto,$nombre,$observaciones)
	{
		$sql="UPDATE asunto SET nombre='$nombre', observaciones='$observaciones' WHERE idasunto='$idasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idasunto)
	{
		$sql="UPDATE asunto SET condicion='0' WHERE idasunto='$idasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idasunto)
	{
		$sql="UPDATE asunto SET condicion='1' WHERE idasunto='$idasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idasunto)
	{
		$sql="DELETE FROM asunto WHERE idasunto='$idasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idasunto)
	{
		$sql="SELECT * FROM asunto WHERE idasunto='$idasunto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM asunto";
		return ejecutarConsulta($sql);		
	}
	
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM asunto where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>