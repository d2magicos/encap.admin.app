<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Empleado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idpersonal,$login,$clavehash)
	{
		$sql="INSERT INTO usuario(idpersonal,login,clave,condicion)
		VALUES('$idpersonal','$login','$clavehash','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$idpersonal,$login,$clavehash)
	{
		$sql="UPDATE usuario SET idpersonal='$idpersonal',login='$login',clave='$clavehash' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);
	}

}
?>