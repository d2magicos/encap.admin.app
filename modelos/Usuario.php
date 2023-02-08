<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Usuario
{

//Implementamos nuestro constructor
	public function __construct()
	{
	}

	//Implementamos un método para insertar registros
	public function insertar($idpersonal,$login,$clave,$permisos)
	{
		$sql="INSERT INTO usuario(idpersonal,login,clave,condicion)
		VALUES('$idpersonal','$login','$clave','1')";
		//return ejecutarConsulta($sql);
		//return ejecutarConsulta($sql);
		var_dump("idpersonal",$idpersonal);		
		$idusuarionew=ejecutarConsulta_retornarID($sql);
		var_dump($idusuarionew);		
		var_dump($login);		
		var_dump($clave);		

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			var_dump($sql_detalle);
		}

		return $sw;

	}

	//Implementamos un método para insertar registros
	public function editar($idusuario,$idpersonal,$login,$clave,$permisos)
	{
		$sql="UPDATE usuario SET idpersonal='$idpersonal',login='$login',clave='$clave' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		var_dump("idpersonal",$idpersonal);	

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";

			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			var_dump($sql_detalle);
		}

		return $sw;

	}


	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}
	
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros  

	public function listar()
	{
		$sql="SELECT a.idusuario,a.idpersonal,c.nombre as trabajador,a.login,a.condicion FROM usuario a INNER JOIN personal c ON a.idpersonal=c.idpersonal  ";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clavehash)
    {
    	$sql="SELECT a.idusuario,a.idpersonal,c.imagen,c.nombre as nombre, a.login FROM usuario a INNER JOIN personal c ON a.idpersonal=c.idpersonal WHERE a.login='$login' AND a.clave='$clavehash'AND a.condicion='1'"; 
    	return ejecutarConsulta($sql);
    }

	//Función para verificar el acceso al sistema
	public function listarpermisos()
	{
		$sql="SELECT c.nombre as trabajador,  p.nombre as permiso FROM usuario a INNER JOIN personal c ON a.idpersonal=c.idpersonal 
		INNER JOIN usuario_permiso up ON up.idusuario = a.idusuario INNER JOIN permiso p ON p.idpermiso = up.idpermiso ORDER BY c.nombre,p.nombre asc"; 
		return ejecutarConsulta($sql);
	}
}

?>