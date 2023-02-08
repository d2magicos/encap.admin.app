<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Docente
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple)
	{
		$sql="INSERT INTO docente (nombre,idtipo_documento,num_documento,telefono,telefono2,email,idpais,departamento,ciudad,direccion,fecha_cumple,condicion)
		VALUES ('$nombre','$idtipo_documento','$num_documento','$telefono','$telefono2','$email','$idpais','$departamento','$ciudad','$direccion','$fecha_cumple','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($iddocente,$nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple)
	{
		$sql="UPDATE docente SET nombre='$nombre',idtipo_documento='$idtipo_documento',num_documento='$num_documento',telefono='$telefono',telefono2='$telefono2',email='$email',idpais='$idpais',departamento='$departamento',ciudad='$ciudad',direccion='$direccion',fecha_cumple='$fecha_cumple' WHERE idpersona='$iddocente'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($iddocente)
	{
		$sql="UPDATE docente SET condicion='0' WHERE idpersona='$iddocente'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($iddocente)
	{
		$sql="UPDATE docente SET condicion='1' WHERE idpersona='$iddocente'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($iddocente)
	{
		$sql="DELETE FROM docente WHERE idpersona='$iddocente'";
		return ejecutarConsulta($sql);
	}

	
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($iddocente)
	{
		$sql="SELECT p.idpersona,p.tipo_persona,p.nombre, td.nombre as tipo_documento, p.num_documento as documento,p.telefono,p.telefono2,p.email,pa.nombre as pais ,p.departamento,p.ciudad,
		p.direccion,p.fecha_cumple,p.condicion,p.idpais,p.idtipo_documento
		FROM docente p INNER JOIN pais pa ON pa.idpais =p.idpais
		INNER JOIN tipo_documento td ON td.idtipo_documento = p.idtipo_documento WHERE idpersona='$iddocente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarp()
	{
		$sql="SELECT p.idpersona,p.nombre, td.nombre as tipo_documento, p.num_documento as documento,p.telefono,p.telefono2,p.email,pa.nombre as pais ,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,p.condicion FROM docente p 
        INNER JOIN pais pa ON pa.idpais =p.idpais 
        INNER JOIN tipo_documento td ON td.idtipo_documento = p.idtipo_documento 
        ORDER BY p.idpersona DESC";
		return ejecutarConsulta($sql);		
	}


	//Función para verificar el acceso al sistema
	public function verificarp($num_documento)
	{
		$sql="SELECT * FROM docente a WHERE a.num_documento='$num_documento' AND a.condicion='1'"; 
		return ejecutarConsulta($sql);
	}

		
}

?>