<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";
	
Class Compra
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function insertar($idmatricula,$lugar_confirmacion,$idcourier,$observaciones_envio)
	{
		$sql="INSERT INTO gestionenvios (idmatricula,lugarenvio,monto,idcourier,direccion_envio,fechaenvio,clave,observacion_cliente,factura_envio,fecha_info,observaciones,estado,condicion) 		
		VALUES ('$idmatricula','$lugar_confirmacion','','$idcourier','','','','','','','$observaciones_envio','PENDIENTE CONFIRMADO','1')";
		return ejecutarConsulta($sql);
	}
	
	public function lugarconfirmar($idmatricula,$lugar_confirmacion)
	{
		$sql="UPDATE matricula SET lugar_confirmacion = '$lugar_confirmacion', estadoenvio= 'PENDIENTE POR LLAMAR' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	public function observacionenvio($idmatricula,$observaciones_envio)
	{
		$sql="UPDATE matricula SET observaciones_envio ='$observaciones_envio' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//formulario editar
	public function editar($idenvio,$lugar_confirmacionm,$observaciones_enviom)
	{
		$sql="UPDATE gestionenvios SET lugar_confirmacion = '$lugar_confirmacionm', observaciones_envion= '$observaciones_enviom' WHERE idenvio='$idenvio'";
		return ejecutarConsulta($sql);
	}

	public function lugarconfirmar2($idmatricula,$lugar_confirmacionm)
	{
		$sql="UPDATE matricula SET lugar_confirmacion = '$lugar_confirmacionm', estadoenvio= 'PENDIENTE POR LLAMAR' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	public function observacionenvio2($idmatricula,$observaciones_enviom)
	{
		$sql="UPDATE matricula SET observaciones_envio ='$observaciones_enviom' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para imprimir
	public function okimpresion($idmatricula)
	{
		$sql="UPDATE matricula SET impresion='SI'  WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}
	
	//Implementamos un método para no imprimir
	public function oknoimpresion($idmatricula)
	{
		$sql="UPDATE matricula SET impresion='NO'  WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}
		
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmatricula)
	{	
		$sql="SELECT m.idmatricula,per.nombre as nombrepersonal, DATE(m.fecha_hora) as fecha,p.email,pa.nombre as pais,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,p.telefono,p.telefono2,
		p.nombre as participante,m.cod_matricula, c.nombre,categoria.nombre as categoria,c.n_horas,c.fecha_inicio,td.nombre as tipo_documento, 
		td.nombre as tipo_documento,p.num_documento,m.qr, me.nombre AS mediopago, fr.nombre as formarecaudacion,m.formato,m.monto,m.prioridad,m.enviodigital,m.accesoaula,m.condicion,m.idforma_recaudacion,m.idmediospagos,m.idcurso,
		m.idparticipante,m.idpersonal,m.noperacion,m.lugar_confirmacion,m.observaciones_envio
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal per ON per.idpersonal=m.idpersonal
		INNER JOIN tipo_documento td ON td.idtipo_documento =p.idtipo_documento
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN pais pa ON pa.idpais = p.idpais
		INNER JOIN mediospagos me ON me.idmediospagos=m.idmediospagos
		INNER JOIN forma_recaudacion fr ON fr.idforma_recaudacion=m.idforma_recaudacion
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idmatricula='$idmatricula'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrarContacto($idmatricula)
	{	
		$sql="SELECT m.idmatricula,per.nombre as nombrepersonal, DATE(m.fecha_hora) as fecha,p.email,pa.nombre as pais,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,p.telefono,p.telefono2,
		p.nombre as participante,m.cod_matricula, c.nombre,categoria.nombre as categoria,c.n_horas,c.fecha_inicio,td.nombre as tipo_documento,
		td.nombre as tipo_documento,p.num_documento,m.qr, me.nombre AS mediopago, fr.nombre as formarecaudacion,m.formato,m.monto,m.prioridad,m.enviodigital,m.accesoaula,m.condicion,m.idforma_recaudacion,m.idmediospagos,m.idcurso,
		m.idparticipante,m.idpersonal,m.noperacion,m.lugar_confirmacion,m.observaciones_envio,m.observaciones_contacto,m.cliente_contactado
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal per ON per.idpersonal=m.idpersonal
		INNER JOIN tipo_documento td ON td.idtipo_documento =p.idtipo_documento
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN pais pa ON pa.idpais = p.idpais
		INNER JOIN mediospagos me ON me.idmediospagos=m.idmediospagos
		INNER JOIN forma_recaudacion fr ON fr.idforma_recaudacion=m.idforma_recaudacion
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idmatricula='$idmatricula'";
		return ejecutarConsultaSimpleFila($sql);
	}


	public function updateContacto($idmatricula,$resp,$obs)
	{	
		
		$sql="UPDATE matricula SET cliente_contactado = '$resp', observaciones_contacto= '$obs',fecha_contacto=NOW() WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	public function updateConfirmacion($idmatricula)
	{	
		
		$sql="UPDATE matricula SET fecha_confirmacion=NOW() WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	public function updateEnvio($idmatricula)
	{	
		
		$sql="UPDATE matricula SET fecha_envio=NOW() WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	public function setTiempo($idmatricula)
	{	
		
			$sql="UPDATE matricula SET tiempoenvio='A TIEMPO' WHERE idmatricula='$idmatricula'";
		
		
		return ejecutarConsulta($sql);
	}

	public function setTiempoTarde($idmatricula)
	{	
		
			$sql="UPDATE matricula SET tiempoenvio='TARDE' WHERE idmatricula='$idmatricula'";
		
		
		return ejecutarConsulta($sql);
	}


	public function listarDetalle($idmatricula)
	{
		$sql="SELECT m.idmatricula,m.idcurso,c.cod_curso,c.nombre as curso,categoria.nombre as categoria,c.n_horas,
		m.fecha_inicio FROM matricula m INNER JOIN cursos c ON m.idcurso= c.idcurso 
		INNER JOIN categoria categoria ON categoria.idcategoria=c.idcategoria
		WHERE m.idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT m.idmatricula,DATE(m.fecha_hora) as fecha,m.fecha_contacto,m.fecha_confirmacion,fecha_envio, p.email,p.telefono2,
		p.nombre as participante, td.nombre as tipo_documento,p.num_documento,m.fecha_inicio,m.tiempoenvio,
		p.telefono, m.cod_matricula, c.nombre,categoria.nombre as categoria,m.lugar_confirmacion,m.observaciones_envio, m.idplantilla,
		p.departamento, p.ciudad, p.direccion, m.estadoenvio,m.condicion,m.cliente_contactado,m.observaciones_contacto, 'PENDIENTE' AS estado,m.impresion
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal u ON m.idpersonal=u.idpersonal 
		INNER JOIN tipo_documento td ON td.idtipo_documento=p.idtipo_documento
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		WHERE m.formato = 'FISICO' AND m.estadoventa ='ACTIVADO' 
		ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);		
	}

	public function ventacabecera($idmatricula){
		$sql= "SELECT m.idmatricula,p.nombre as participante,m.cod_matricula,td.nombre as tipo_documento, p.num_documento,m.qr,c.observaciones,
		c.nombre,categoria.nombre as categoria,c.n_horas,m.fecha_inicio,m.idcurso,m.idparticipante,m.fecha_hora,m.contexto,m.nota,m.año,c.docente
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN tipo_documento td ON td.idtipo_documento =p.idtipo_documento
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	public function impdip($idmatricula){
		$sql= "SELECT m.idmatricula,p.nombre as participante,m.cod_matricula,td.nombre as tipo_documento, p.num_documento,m.qr,
		c.nombre,categoria.nombre as categoria,c.n_horas,m.fecha_inicio,m.idcurso,m.idparticipante,m.fecha_hora,m.contexto,  c.observaciones,
		m.nota,m.año,c.docente,categoria.nombre as nombre_categoria,c.temario
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN tipo_documento td ON td.idtipo_documento =p.idtipo_documento
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}
	

}

?>