<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Tipodocumento
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO tipo_documento (nombre,condicion)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idtipo_documento,$nombre)
	{
		$sql="UPDATE tipo_documento SET nombre='$nombre' WHERE idtipo_documento='$idtipo_documento'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idtipo_documento)
	{
		$sql="UPDATE tipo_documento SET condicion='0' WHERE idtipo_documento='$idtipo_documento'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idtipo_documento)
	{
		$sql="UPDATE tipo_documento SET condicion='1' WHERE idtipo_documento='$idtipo_documento'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtipo_documento)
	{
		$sql="SELECT * FROM tipo_documento WHERE idtipo_documento='$idtipo_documento'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idtipo_documento)
	{
		$sql="DELETE FROM tipo_documento WHERE idtipo_documento='$idtipo_documento'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipo_documento";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM tipo_documento where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>