<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";
	
Class Compra
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function insertar($idmatricula,$idpersonal,$idasunto,$idsubasunto,$fecha,$hora_reclamo,$descripcion,$prioridad,$observaciones)
	{
		$sql="INSERT INTO gestionreclamos (idmatricula,idpersonal,idasunto,idsubasunto,fecha,hora_reclamo,descripcion,fechaatencion,hora,solucion,prioridad,estado,observaciones,condicion) 		
		VALUES ('$idmatricula','$idpersonal','$idasunto','$idsubasunto','$fecha','$hora_reclamo','$descripcion','','','','$prioridad','POR RESOLVER','$observaciones','1')";
		return ejecutarConsulta($sql);
	}
	
	public function estadoreclamo($idmatricula)
	{
		$sql="UPDATE matricula SET estadoreclamo = 'POR RESOLVER' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para activar registros
	public function okimpresion($idmatricula)
	{
		$sql="UPDATE matricula SET impresion='SI'  WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}
	
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmatricula)
	{	
		$sql="SELECT m.idmatricula, per.nombre as personal, DATE(m.fecha_hora) as fecha,p.email,pa.nombre as pais,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,p.telefono,p.telefono2,
		p.nombre as participante,m.cod_matricula, c.nombre,categoria.nombre as categoria,c.n_horas,c.fecha_inicio,td.nombre as tipo_documento,
		td.nombre as tipo_documento,p.num_documento,m.qr, me.nombre AS mediopago, fr.nombre as formarecaudacion,m.formato,m.monto,m.prioridad,m.enviodigital,m.accesoaula,m.condicion,m.idforma_recaudacion,m.idmediospagos,m.idcurso,
		m.idparticipante,m.idpersonal,m.noperacion,m.lugar_confirmacion,m.observaciones_envio
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN tipo_documento td ON td.idtipo_documento =p.idtipo_documento
		INNER JOIN personal per ON per.idpersonal=m.idpersonal
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN pais pa ON pa.idpais = p.idpais
		INNER JOIN mediospagos me ON me.idmediospagos=m.idmediospagos
		INNER JOIN forma_recaudacion fr ON fr.idforma_recaudacion=m.idforma_recaudacion
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idmatricula='$idmatricula'";
		return ejecutarConsultaSimpleFila($sql);
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
		$sql="SELECT m.idmatricula, concat(DATE(m.fecha_hora),' ',m.hora) as fecha, p.email,p.telefono2,p.nombre as participante, 
		td.nombre as tipo_documento, p.num_documento,p.telefono,m.cod_matricula, c.nombre,categoria.nombre as categoria,m.fecha_inicio,
		m.monto,m.formato,m.prioridad,tra.nombre as trafico, m.enviodigital,m.estadoenvio,m.accesoaula,m.estadoreclamo
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal u ON m.idpersonal=u.idpersonal 
		INNER JOIN tipo_documento td ON td.idtipo_documento=p.idtipo_documento
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN trafico tra ON tra.idtrafico=m.idtrafico
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		WHERE m.estadoventa ='ACTIVADO' 
		ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);		
	}
	

}

?>