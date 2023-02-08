<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Procedimiento
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO forma_recaudacion (nombre,condicion)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idforma_recaudacion,$nombre)
	{
		$sql="UPDATE forma_recaudacion SET nombre='$nombre' WHERE idforma_recaudacion='$idforma_recaudacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idforma_recaudacion)
	{
		$sql="UPDATE forma_recaudacion SET condicion='0' WHERE idforma_recaudacion='$idforma_recaudacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idforma_recaudacion)
	{
		$sql="DELETE FROM forma_recaudacion WHERE idforma_recaudacion='$idforma_recaudacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idforma_recaudacion)
	{
		$sql="UPDATE forma_recaudacion SET condicion='1' WHERE idforma_recaudacion='$idforma_recaudacion'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idforma_recaudacion)
	{
		$sql="SELECT * FROM forma_recaudacion WHERE idforma_recaudacion='$idforma_recaudacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM forma_recaudacion";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM forma_recaudacion where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>