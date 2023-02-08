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
	public function insertar($fecha_hora,$nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple,$cargo,$imagen)
	{
		$sql="INSERT INTO personal (fecha_hora,nombre,idtipo_documento,num_documento,telefono,telefono2,email,idpais,departamento,ciudad,direccion,fecha_cumple,cargo,imagen,condicion)
		VALUES ('$fecha_hora','$nombre','$idtipo_documento','$num_documento','$telefono','$telefono2','$email','$idpais','$departamento','$ciudad','$direccion','$fecha_cumple','$cargo','$imagen','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpersonal,$fecha_hora,$nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple,$cargo,$imagen)
	{
		$sql="UPDATE personal SET fecha_hora='$fecha_hora',nombre='$nombre',idtipo_documento='$idtipo_documento',num_documento='$num_documento',telefono='$telefono',telefono2='$telefono2',email='$email',idpais='$idpais',departamento='$departamento',ciudad='$ciudad',direccion='$direccion',fecha_cumple='$fecha_cumple',cargo='$cargo',imagen='$imagen' WHERE idpersonal='$idpersonal'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idpersonal)
	{
		$sql="UPDATE personal SET condicion='0' WHERE idpersonal='$idpersonal'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idpersonal)
	{
		$sql="UPDATE personal SET condicion='1' WHERE idpersonal='$idpersonal'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idpersonal)
	{
		$sql="DELETE FROM personal WHERE idpersonal='$idpersonal'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpersonal)
	{
		$sql="SELECT per.idpersonal,per.fecha_hora,per.nombre, td.nombre as tipo_documento,per.num_documento, per.telefono,per.telefono2,per.email,
		p.nombre as pais,per.departamento,per.ciudad,per.direccion,per.fecha_cumple,per.cargo,per.imagen,per.condicion,per.idpais,per.idtipo_documento
		FROM personal per INNER JOIN tipo_documento td ON td.idtipo_documento = per.idtipo_documento
		INNER JOIN pais p ON p.idpais = per.idpais WHERE idpersonal='$idpersonal'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT per.idpersonal,per.fecha_hora,per.nombre, td.nombre as tipo_documento,per.num_documento, per.telefono,per.telefono2,per.email,
		p.nombre as pais,per.departamento,per.ciudad,per.direccion,per.fecha_cumple,per.cargo,per.imagen,per.cargo,per.condicion
		FROM personal per INNER JOIN tipo_documento td ON td.idtipo_documento = per.idtipo_documento
		INNER JOIN pais p ON p.idpais = per.idpais
		ORDER BY per.idpersonal DESC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT per.idpersonal,per.nombre, td.nombre as tipo_documento,per.num_documento, per.telefono,per.telefono2,per.email,
		p.nombre as pais,per.departamento,per.ciudad,per.direccion,per.fecha_cumple,per.cargo,per.imagen,per.condicion
		FROM personal per INNER JOIN tipo_documento td ON td.idtipo_documento = per.idtipo_documento
		INNER JOIN pais p ON p.idpais = per.idpais WHERE per.condicion=1";
		return ejecutarConsulta($sql);		
	}

}

?>

