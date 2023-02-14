<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Tipo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion,$url)
	{
		try {
			$sql="INSERT INTO tipos (nombre,url,descripcion,condicion)
			VALUES ('$nombre','$url','$descripcion','1')";
			return ejecutarConsulta($sql);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	//Implementamos un método para editar registros
	public function editar($id,$nombre,$etiqueta)
	{
		$sql="UPDATE tipos SET nombre='$nombre',descripcion='$etiqueta' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id)
	{
		$sql="UPDATE tipos SET condicion='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id)
	{
		$sql="UPDATE tipos SET condicion='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($id)
	{
		$sql="DELETE FROM tipos WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT * FROM tipos WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipos order by id asc";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM tipos where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>