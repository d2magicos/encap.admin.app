<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Subtipo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion,$url,$tipo)
	{
		try {
			$sql="INSERT INTO subtipos (nombre,url,descripcion,condicion,tipo_id)
			VALUES ('$nombre','$url','$descripcion','1',$tipo)";
			return ejecutarConsulta($sql);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	//Implementamos un método para editar registros
	public function editar($id,$nombre,$etiqueta, $tipo)
	{
		$sql="UPDATE subtipos SET nombre='$nombre',descripcion='$etiqueta',tipo_id='$tipo' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id)
	{
		$sql="UPDATE subtipos SET condicion='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id)
	{
		$sql="UPDATE subtipos SET condicion='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($id)
	{
		$sql="DELETE FROM subtipos WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT * FROM subtipos WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		/*$sql="SELECT * FROM subtipos order by id asc";
		return ejecutarConsulta($sql);*/	

		$sql="SELECT  s.*,t.nombre as nombre_tipo FROM subtipos s INNER JOIN tipos t ON s.tipo_id = t.id";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM subtipos where condicion=1";
		return ejecutarConsulta($sql);		
	}

	public function getByTipo($tipo)
	{
		$sql="SELECT * FROM subtipos where condicion=1 AND tipo_id = ". $tipo ;
		return ejecutarConsulta($sql);		
	}
}

?>