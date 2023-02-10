<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Usuario
{

//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Función para verificar el acceso al sistema
	public function verificar($consultar)
    {
    	$sql="SELECT p.idpersona, p.num_documento,m.idmatricula,p.nombre,p.ciudad,p.departamento,m.cod_matricula, m.qr
        FROM persona p INNER JOIN matricula m ON m.idparticipante =p.idpersona
        WHERE m.cod_matricula = '$consultar' OR m.qr ='$consultar' OR p.num_documento='$consultar'
		AND m.estadoventa='ACTIVADO'"; 
    	return ejecutarConsulta($sql);
    }
    
    	//Funci��n para verificar el acceso al sistema
	public function verificarDocente($consultar)
    {
    	$sql="SELECT p.idpersona, p.num_documento,m.idmatricula,p.nombre,p.ciudad,p.departamento,m.cod_matricula, m.qr
        FROM docente p INNER JOIN matricula_docentes m ON m.idparticipante =p.idpersona
        WHERE m.cod_matricula = '$consultar' OR m.qr ='$consultar' OR p.num_documento='$consultar'"; 
    	return ejecutarConsulta($sql);
    }	

	public function login($user)
    {
    	$sql="SELECT idpersona,num_documento FROM persona WHERE num_documento = '$user' "; 
    	return ejecutarConsulta($sql);
    }
	
	public function logindocente($user)
    {
    	$sql="SELECT num_documento FROM docente WHERE num_documento = '$user' "; 
    	return ejecutarConsulta($sql);
    }

		//Función para verificar el acceso al sistema
	public function verificarIntranet($consultar)
	{
			$sql="SELECT p.idpersona, p.num_documento,m.idmatricula,p.nombre,p.ciudad,p.departamento,m.cod_matricula, m.qr
			FROM persona p INNER JOIN matricula m ON m.idparticipante =p.idpersona
			WHERE p.num_documento = '$consultar' OR m.cod_matricula = '$consultar' OR m.qr ='$consultar'
			AND m.estadoventa='ACTIVADO'"; 
			return ejecutarConsulta($sql);
	}

	public function verificarseguimiento($consultar)
    {
    	$sql="SELECT p.idpersona, p.num_documento,m.idmatricula,p.nombre		
		FROM  matricula m INNER JOIN persona p ON p.idpersona = m.idparticipante 
		WHERE p.num_documento = '$consultar'
		AND m.estadoventa='ACTIVADO'"; 
    	return ejecutarConsulta($sql);
    }
	
	public function verificarseguimientofisico($consultar)
    {
    	$sql = "SELECT p.idpersona, p.num_documento, m.idmatricula, p.nombre		
				FROM  matricula m 
				INNER JOIN persona p ON p.idpersona = m.idparticipante 
				WHERE p.num_documento = '$consultar' AND m.estadoventa = 'ACTIVADO' AND m.formato = 'FISICO'"; 
				
		return ejecutarConsulta($sql);
    }

	public function verificarpresencial($consultar)
    {
    	$sql="SELECT p.idpresencial,p.fecha,p.codigo,p.nombres,p.dni,p.departamento,p.ciudad,p.curso,p.fecha_certificado,p.horas
		FROM  presenciales p WHERE p.dni = '$consultar' AND p.condicion=1"; 
    	return ejecutarConsulta($sql);
    }
}

?>