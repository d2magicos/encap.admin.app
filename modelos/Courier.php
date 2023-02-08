<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Courier
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO courier (nombre,condicion)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcourier,$nombre)
	{
		$sql="UPDATE courier SET nombre='$nombre' WHERE idcourier='$idcourier'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idcourier)
	{
		$sql="DELETE FROM courier WHERE idcourier='$idcourier'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcourier)
	{
		$sql="UPDATE courier SET condicion='0' WHERE idcourier='$idcourier'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcourier)
	{
		$sql="UPDATE courier SET condicion='1' WHERE idcourier='$idcourier'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcourier)
	{
		$sql="SELECT * FROM courier WHERE idcourier='$idcourier'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM courier";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM courier where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>