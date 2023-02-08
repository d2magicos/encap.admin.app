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
	public function insertar($idmatricula,$lugarenvio,$monto,$idcourier,$fechaenvio,$clave,$factura_envio,$fecha_info,$observaciones)
	{
		$sql="INSERT INTO gestionenvios (idmatricula,lugarenvio,monto,idcourier,fechaenvio,clave,factura_envio,fecha_info,observaciones,estado,condicion) 		
		VALUES ('$idmatricula','$lugarenvio','$monto','$idcourier','$fechaenvio','$clave','$factura_envio','$fecha_info','$observaciones','ENVIO COMPLETADO','1')";
		return ejecutarConsulta($sql);
	}

	public function actualizado($idmatricula)
	{
		$sql="UPDATE matricula SET estadoenvio='ENVIO COMPLETADO' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	// //Implementamos un método para editar registros
	// public function editar($idenvio,$idmatricula,$lugarenvio,$monto,$idcourier,$fechaenvio,$clave,$factura_envio,$fecha_info,$observaciones)
	// {
	// 	$sql="UPDATE gestionenvios SET idmatricula='$idmatricula',lugarenvio='$lugarenvio',monto='$monto',idcourier='$idcourier',fechaenvio='$fechaenvio',clave='$clave',factura_envio='$factura_envio',fecha_info='$fecha_info',observaciones='$observaciones',estado='ENVIO COMPLETADO',condicion='1' WHERE idenvio='$idenvio'";
	// 	return ejecutarConsulta($sql);
	// }
	
	//Implementamos un método para anular registros
	public function eliminar($idenvio)
	{
		$sql="DELETE FROM gestionenvios WHERE idenvio='$idenvio'";
		return ejecutarConsulta($sql);
	}
	
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmatricula)
	{	
		$sql="SELECT m.idmatricula,m.impresion, m.fecha_hora, p.email,p.nombre as participante,p.num_documento, p.telefono,p.telefono2,
		pa.nombre as pais,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,
		m.cod_matricula,c.nombre, categoria.nombre as categoria,m.fecha_inicio,
		m.lugar_confirmacion,m.observaciones_envio,m.estadoenvio,m.observaciones
			   FROM matricula m  INNER JOIN persona p ON m.idparticipante=p.idpersona 
			   INNER JOIN pais pa ON p.idpais=pa.idpais
			   INNER JOIN tipo_documento td ON td.idtipo_documento=p.idtipo_documento 
			   INNER JOIN personal u ON m.idpersonal=u.idpersonal 
			   INNER JOIN cursos c ON m.idcurso=c.idcurso 
			   INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 

		WHERE m.idmatricula ='$idmatricula'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idmatricula)
	{
		$sql="SELECT m.idmatricula,m.idcurso,c.cod_curso,c.nombre as curso,categoria.nombre as categoria,c.n_horas,m.fecha_inicio 
		FROM matricula m INNER JOIN cursos c ON m.idcurso= c.idcurso 
		INNER JOIN categoria categoria ON categoria.idcategoria=c.idcategoria		
		where m.idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT m.idmatricula,m.impresion, m.fecha_hora, p.email,p.nombre as participante,p.num_documento, p.telefono,p.telefono2, m.cod_matricula,c.nombre, categoria.nombre as categoria,m.fecha_inicio,
		m.lugar_confirmacion,m.observaciones_envio,m.estadoenvio,m.observaciones
		FROM matricula m  INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN tipo_documento td ON td.idtipo_documento=p.idtipo_documento 
		INNER JOIN personal u ON m.idpersonal=u.idpersonal 
		INNER JOIN cursos c ON m.idcurso=c.idcurso 
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		WHERE m.impresion = 'SI'
		ORDER BY m.fecha_hora desc";
		return ejecutarConsulta($sql);		
	}
}

?>