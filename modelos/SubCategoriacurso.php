<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class SubCategoriacurso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$etiqueta)
	{
		$sql="INSERT INTO subcategoria (nombre,etiqueta,condicion)
		VALUES ('$nombre','$etiqueta','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idsubcategoria,$nombre,$etiqueta)
	{
		$sql="UPDATE subcategoria SET nombre='$nombre',etiqueta='$etiqueta' WHERE id='$idsubcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idsubcategoria)
	{
		$sql="UPDATE subcategoria SET condicion='0' WHERE id='$idsubcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idsubcategoria)
	{
		$sql="UPDATE subcategoria SET condicion='1' WHERE id='$idsubcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idsubcategoria)
	{
		$sql="DELETE FROM subcategoria WHERE id='$idsubcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsubcategoria)
	{
		$sql="SELECT * FROM subcategoria WHERE id='$idsubcategoria'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM subcategoria order by id asc";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM subcategoria where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>