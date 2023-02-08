<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Subasunto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$idasunto)
	{
		$sql="INSERT INTO subasunto (nombre,idasunto,condicion)
		VALUES ('$nombre','$idasunto','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idsubasunto,$nombre,$idasunto)
	{
		$sql="UPDATE subasunto SET nombre='$nombre',idasunto='$idasunto' WHERE idsubasunto='$idsubasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idsubasunto)
	{
		$sql="UPDATE subasunto SET condicion='0' WHERE idsubasunto='$idsubasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idsubasunto)
	{
		$sql="UPDATE subasunto SET condicion='1' WHERE idsubasunto='$idsubasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idsubasunto)
	{
		$sql="DELETE FROM subasunto WHERE idsubasunto='$idsubasunto'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsubasunto)
	{
		$sql="SELECT * FROM subasunto WHERE idsubasunto='$idsubasunto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarc()
	{
		$sql="SELECT sb.idsubasunto, sb.nombre, a.nombre AS asunto, sb.condicion 
		FROM subasunto sb INNER JOIN asunto a ON a.idasunto=sb.idasunto";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método sub categoria
	public function selectSubasunto($idasunto)
	{
		$sql="SELECT sb.idsubasunto, sb.nombre, a.nombre AS asunto
		FROM subasunto sb INNER JOIN asunto a ON a.idasunto=sb.idasunto
		WHERE a.idasunto = '$idasunto'";
		return ejecutarConsulta($sql);		
	}

	

}
?>