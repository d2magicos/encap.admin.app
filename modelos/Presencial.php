<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Presencial
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($fecha,$codigo,$asesor,$nombres,$dni,$celular,$correo,$cumpleaños,$ciudad,$departamento,
	$n_operacion,$curso,$fecha_certificado,$horas,$codigo_curso,$monto,$forma_pago,$observacion)
	{
		$sql="INSERT INTO presenciales (fecha,codigo,asesor,nombres,dni,celular,correo,cumpleaños,ciudad,departamento,n_operacion
		curso,fecha_certificado,horas,codigo_curso,monto,forma_pago,observacion,condicion)
		VALUES ('$fecha','$codigo','$nombres','$dni','$celular','$correo','$cumpleaños','$ciudad','$departamento',
				'$curso','$fecha_certificado','$horas','$codigo_curso','$n_operacion','$monto','$forma_pago','$asesor','$observacion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpresencial,$fecha,$codigo,$asesor,$nombres,$dni,$celular,$correo,$cumpleaños,$ciudad,$departamento,
	$n_operacion,$curso,$fecha_certificado,$horas,$codigo_curso,$monto,$forma_pago,$observacion)
	{
		$sql="UPDATE presenciales SET fecha='$fecha',codigo='$codigo',asesor='$asesor',nombres='$nombres',dni='$dni',celular='$celular',correo='$correo',cumpleaños='$cumpleaños',ciudad='$ciudad', departamento='$departamento', n_operacion='$n_operacion',
		curso='$curso',fecha_certificado='$fecha_certificado',horas='$horas',codigo_curso='$codigo_curso',monto='$monto',forma_pago='$forma_pago',observacion='$observacion' WHERE idpresencial='$idpresencial'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idpresencial)
	{
		$sql="UPDATE presenciales SET condicion='0' WHERE idpresencial='$idpresencial'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idpresencial)
	{
		$sql="UPDATE presenciales SET condicion='1' WHERE idpresencial='$idpresencial'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idpresencial)
	{
		$sql="DELETE FROM presenciales WHERE idpresencial='$idpresencial'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpresencial)
	{
		$sql="SELECT * FROM presenciales WHERE idpresencial='$idpresencial'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarc()
	{
		$sql="SELECT * FROM presenciales";
		return ejecutarConsulta($sql);		
	}
}

?>