<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";
	
Class Compra
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	//Implementamos un método para insertar registros
	//Incluyendo los detalles del ingreso
	public function insertar($idmatricula,$lugarenvio,$monto,$idcourier,$direccion_envio,$fechaenvio,$clave,$observacion_cliente,$factura_envio,$fecha_info,$observaciones)
	{
		$sql="INSERT INTO gestionenvios (idmatricula,lugarenvio,monto,idcourier,direccion_envio,fechaenvio,clave,observaciones_cliente,factura_envio,fecha_info,observaciones,estado,condicion) 		
		VALUES ('$idmatricula','$lugarenvio','$monto','$idcourier','$direccion_envio','$fechaenvio','$clave','$observacion_cliente','$factura_envio','$fecha_info','$observaciones','ENVÍO REALIZADO','1')";
		return ejecutarConsulta($sql);
	}

	// //Implementamos un método para editar registros
	public function editar($idenvio, $idmatricula, $lugarenvio, $monto, $idcourier, $direccion_envio, $fechaenvio, $clave, $observacion_cliente, $factura_envio, $fecha_info, $observaciones, $info_seguimiento) {
	 	$sql="UPDATE gestionenvios 
			  SET idmatricula = '$idmatricula', lugarenvio = '$lugarenvio', monto = '$monto', idcourier = '$idcourier', info_seguimiento = '$info_seguimiento', direccion_envio = '$direccion_envio', fechaenvio = '$fechaenvio', clave = '$clave', observacion_cliente = '$observacion_cliente', factura_envio = '$factura_envio', fecha_info = '$fecha_info', observaciones = '$observaciones', estado = 'ENVÍO REALIZADO', condicion = '1' 
			  WHERE idenvio = '$idenvio'";
	 	return ejecutarConsulta($sql);
	}

	public function estadoenvio($idmatricula)
	{
		$sql="UPDATE matricula SET  estadoenvio= 'ENVÍO REALIZADO' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}
	
	//Implementamos un método para anular registros
	public function eliminar($idenvio)
	{
		$sql="DELETE FROM gestionenvios WHERE idenvio='$idenvio'";
		return ejecutarConsulta($sql);
	}
	
		//Implementamos un método para desactivar categorías
		public function desactivar($idenvio)
		{
			$sql="UPDATE gestionenvios SET condicion='0' WHERE idenvio='$idenvio'";
			return ejecutarConsulta($sql);
		}
	
		//Implementamos un método para activar categorías
		public function activar($idenvio)
		{
			$sql="UPDATE gestionenvios SET condicion='1' WHERE idenvio='$idenvio'";
			return ejecutarConsulta($sql);
		}


		//Actualizacion fecha de envio de gestion de envios
		public function estadogestionenvio($idmatricula)
	{
		$sql="UPDATE matricula SET  fecha_envio=NOW() WHERE idmatricula='$idmatricula'";
		
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idenvio)
	{	
		$sql="SELECT ge.idenvio,m.idmatricula,per.nombre as nombrepersonal, m.fecha_hora,m.cod_matricula,td.nombre as tipo_documento ,p.email,p.nombre as participante,
		p.num_documento, p.telefono,p.telefono2,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,pais.nombre AS pais,ge.idcourier,courier.idcourier,
		ge.monto,ge.lugarenvio, courier.nombre as courier,ge.fechaenvio,ge.clave,ge.factura_envio,ge.fecha_info,ge.observaciones,ge.observacion_cliente,ge.direccion_envio
		FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula
		INNER JOIN personal per ON per.idpersonal=m.idpersonal
		INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN courier courier ON courier.idcourier = ge.idcourier 
		INNER JOIN tipo_documento td ON td.idtipo_documento=p.idtipo_documento 
		INNER JOIN personal u ON m.idpersonal=u.idpersonal 
		INNER JOIN cursos c ON m.idcurso=c.idcurso 
		INNER JOIN pais pais ON pais.idpais =p.idpais 
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		WHERE ge.idenvio ='$idenvio'";
		return ejecutarConsultaSimpleFila($sql);
	}
	

	public function listarDetalle($idenvio)
	{
		$sql="SELECT ge.idenvio,m.idmatricula,c.cod_curso,c.nombre as curso,categoria.nombre as categoria,c.n_horas,m.fecha_inicio 
		FROM matricula m INNER JOIN cursos c ON m.idcurso= c.idcurso
		INNER JOIN gestionenvios ge ON ge.idmatricula = m.idmatricula
		INNER JOIN categoria categoria ON categoria.idcategoria=c.idcategoria		
		where ge.idenvio='$idenvio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT ge.idenvio,m.idmatricula, m.fecha_hora, p.email,p.nombre as participante,p.num_documento, p.telefono,p.telefono2,p.ciudad,
		m.cod_matricula,c.nombre, categoria.nombre as categoria,m.fecha_inicio,ge.condicion, ge.monto,ge.lugarenvio, ge.idcourier,
		courier.nombre as courier,ge.fechaenvio,ge.clave,ge.factura_envio,ge.fecha_info,ge.observaciones,ge.estado,ge.observacion_cliente,ge.direccion_envio,
		ge.info_seguimiento
		FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula
		INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN courier courier ON courier.idcourier = ge.idcourier 
		INNER JOIN tipo_documento td ON td.idtipo_documento=p.idtipo_documento 
		INNER JOIN personal u ON m.idpersonal=u.idpersonal 
		INNER JOIN cursos c ON m.idcurso=c.idcurso 
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		ORDER BY ge.idenvio desc";
		return ejecutarConsulta($sql);		
	}
}

?>
