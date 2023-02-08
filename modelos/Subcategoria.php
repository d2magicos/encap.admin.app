<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Subcategoria
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO pais (nombre,condicion)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpais,$nombre)
	{
		$sql="UPDATE pais SET nombre='$nombre' WHERE idpais='$idpais'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idpais)
	{
		$sql="UPDATE pais SET condicion='0' WHERE idpais='$idpais'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idpais)
	{
		$sql="UPDATE pais SET condicion='1' WHERE idpais='$idpais'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpais)
	{
		$sql="SELECT * FROM pais WHERE idpais='$idpais'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idpais)
	{
		$sql="DELETE FROM pais WHERE idpais='$idpais'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar($idcat)
	{
		$sql="SELECT * FROM certificados where idcategoria='$idcat'";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select($idcat)
	{
		$sql="SELECT * FROM certificados 
		WHERE idcategoria=(SELECT idcategoria FROM cursos where idcurso='$idcat')";
		return ejecutarConsulta($sql);		
	}

	public function selectDocente()
	{
		$sql="SELECT * FROM certificados 
		WHERE idcategoria='9'";
		return ejecutarConsulta($sql);		
	}
}

?>