<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

//  ----------------------   **   VISTA INICIO ** SISTEMA PAGINA ESCRITORIO **   ------------------------ //
//===========================================================================================================

//total de matriculas
	public function totalmatriculas()
	{
		$sql="SELECT IFNULL(count(idmatricula),0) as idmatricula FROM matricula";
		return ejecutarConsulta($sql);
	}
//total de cursos 
	public function totalcursos()
	{
		$sql="SELECT IFNULL(count(idcurso),0) as idcurso FROM cursos";
		return ejecutarConsulta($sql);
	}
//total de envios
	public function totalenvios()
	{
		$sql="SELECT IFNULL(count(idenvio),0) as idenvio FROM gestionenvios";
		return ejecutarConsulta($sql);
	}
//total de usuarios
	public function totalusuariosr()
	{
		$sql="SELECT IFNULL(count(idpersonal),0) as idpersonal FROM personal";
		return ejecutarConsulta($sql);
	}
//total de participantes
	public function totalparticipantes()
	{
		$sql="SELECT IFNULL(count(idpersona),0) as idpersona FROM persona WHERE tipo_persona='Participantes'";
		return ejecutarConsulta($sql);
	}

//total de categorias
	public function cantidadcategorias(){
		$sql="SELECT COUNT(*) totalca FROM categoria WHERE condicion=1";
		return ejecutarConsulta($sql);
	}
 
//------------------------------ ***  SESSION GENERAL   *** -------------------------------------------------
//lista cumpleaños actual dia 
	public function listarcumpleaños($fecha)
	{
		$sql="SELECT u.nombre as personal, p.nombre, p.num_documento,p.telefono,p.telefono2,p.fecha_cumple 
		FROM matricula m INNER JOIN personal u ON m.idpersonal=u.idpersonal 
		INNER JOIN persona p ON p.idpersona = m.idparticipante 
		WHERE substring(p.fecha_cumple,-10,5) LIKE '$fecha' GROUP BY p.num_documento";
		return ejecutarConsulta($sql);
	}

// Lista de matriculas pendiente digital
	public function listadpendienteenviodigitalgeneral()
	{
		$sql="SELECT u.nombre as personal, CONCAT(m.fecha_hora,' ',m.hora) as fecha, m.cod_matricula, p.nombre as participante, p.num_documento,
		p.telefono,c.nombre,categoria.nombre as categoria,c.fecha_inicio,m.accesoaula,m.formato,m.enviodigital,m.estadoenvio,m.prioridad,m.observaciones
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal u ON m.idpersonal=u.idpersonal  
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.estadoventa ='ACTIVADO' AND m.enviodigital='PENDIENTE'
		ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);
	}

// cantidad de matriculas pendiente digital
	public function cantidadpendienteenviodigitalgeneral()
	{
		$sql="SELECT COUNT(m.idmatricula) as cantidad
		FROM matricula m INNER JOIN personal u ON m.idpersonal=u.idpersonal  
		WHERE m.estadoventa ='ACTIVADO' AND m.enviodigital='PENDIENTE'
		ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);
	}

// Lista de envios en proceso de envio 
	public function listapendienteenviosfisicosgeneral()
	{
		$sql="SELECT ge.idenvio, per.nombre as personal, CONCAT(m.fecha_hora,' ',m.hora)  as fecha,m.cod_matricula, p.nombre as participante,p.num_documento,
		p.telefono,c.nombre,categoria.nombre as categoria,ge.lugarenvio,ge.estado,m.fecha_inicio,m.observaciones_envio as observaciones
		FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula 
		INNER JOIN persona p ON p.idpersona = m.idparticipante
		INNER JOIN personal per ON per.idpersonal = m.idpersonal
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria = categoria.idcategoria
		WHERE  ge.estado ='ENVÍO EN PROCESO' AND m.estadoventa ='ACTIVADO'";
		return ejecutarConsulta($sql);
	}

//cantidad de envios en proceso de envio
	public function cantidadpendienteenviofisigeneral()
	{
		$sql="SELECT COUNT(ge.idenvio) as cantidad
		FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula 
		INNER JOIN personal per ON per.idpersonal = m.idpersonal
		WHERE  ge.estado ='ENVÍO EN PROCESO' AND m.estadoventa ='ACTIVADO'";
		return ejecutarConsulta($sql);
	}

// Lista de reclamos en estado pendiente 
public function listareclamospendientesgeneral()
{
	$sql="SELECT gr.fecha,u.nombre as personal, m.cod_matricula, p.nombre as participante, p.num_documento,p.telefono,
	m.fecha_inicio,c.nombre, categoria.nombre as categoria, a.nombre as asunto, gr.descripcion,gr.estado,gr.observaciones
	FROM gestionreclamos gr INNER JOIN matricula m ON m.idmatricula = gr.idmatricula
	INNER JOIN asunto a ON a.idasunto = gr.idasunto
	INNER JOIN persona p ON m.idparticipante=p.idpersona 
	INNER JOIN personal u ON u.idpersonal = gr.idpersonal 
	INNER JOIN cursos c ON m.idcurso=c.idcurso
	INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
	WHERE gr.estado='POR RESOLVER' ORDER BY gr.idreclamo DESC";
	return ejecutarConsulta($sql);
}

// cantidad de reclamos en estado pendiente 
public function cantidadreclamospendientesgeneral()
{
	$sql="SELECT COUNT(gr.idreclamo) as cantidad
	FROM gestionreclamos gr	INNER JOIN personal u ON u.idpersonal = gr.idpersonal 
	WHERE gr.estado='POR RESOLVER'";
	return ejecutarConsulta($sql);
}

// Lista de reclamos en estado pendiente 
public function listasatisfaccionclientegeneral()
{
	$sql="SELECT CONCAT(m.fecha_hora,' ',m.hora)  as fecha, m.cod_matricula, p.nombre as participante, p.num_documento,p.telefono,
	c.nombre, categoria.nombre as categoria, m.fecha_inicio, concat(m.satisfacion,' PENDIENTE') AS satisfacion, m.observaciones_satisfacion as observaciones
	FROM matricula m INNER JOIN personal u ON u.idpersonal = m.idpersonal 
	INNER JOIN persona p ON m.idparticipante = p.idpersona 
	INNER JOIN cursos c ON m.idcurso=c.idcurso
	INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
	WHERE m.estadosatisfacion='' ORDER BY m.idmatricula DESC";
	return ejecutarConsulta($sql);
}

// cantidad de reclamos en estado pendiente 
public function cantidadsatisfaccionclientegeneral()
{
$sql="SELECT COUNT(m.idmatricula) as cantidad
FROM matricula m INNER JOIN personal u ON u.idpersonal = m.idpersonal 
WHERE m.estadosatisfacion=''";
return ejecutarConsulta($sql);
}


//------------------------------ ***  SESSION MATRICULA   *** -------------------------------------------------

//Notificacion cumpleaños actual dia 
public function notificacioncumplehoy($fecha,$idpersonal)
{
	$sql="SELECT  COUNT(p.idpersona)  as cantidad
	FROM matricula m INNER JOIN personal u ON m.idpersonal=u.idpersonal 
	INNER JOIN persona p ON p.idpersona = m.idparticipante 
	WHERE substring(p.fecha_cumple,-10,5) LIKE '$fecha'  AND m.idpersonal = '$idpersonal'";
	return ejecutarConsulta($sql);
}


//lista cumpleaños actual dia 
public function listadocumpleañospersonal($fecha,$idpersonal)
{
	$sql="SELECT p.nombre, p.num_documento,p.telefono,p.telefono2,p.fecha_cumple 
	FROM matricula m INNER JOIN personal u ON m.idpersonal=u.idpersonal 
	INNER JOIN persona p ON p.idpersona = m.idparticipante 
	WHERE substring(p.fecha_cumple,-10,5) LIKE '$fecha' AND m.idpersonal = '$idpersonal' GROUP BY p.num_documento";
	return ejecutarConsulta($sql);
}

//lista cumpleaños actual dia 
public function listadocumpleañospersonalwasap($fecha,$idpersonal)
{
	$sql="SELECT p.nombre, p.num_documento,p.telefono,p.telefono2,p.fecha_cumple,m.condicion
	FROM matricula m INNER JOIN personal u ON m.idpersonal=u.idpersonal 
	INNER JOIN persona p ON p.idpersona = m.idparticipante 
	WHERE substring(p.fecha_cumple,-10,5) LIKE '$fecha' AND m.idpersonal = '$idpersonal' GROUP BY p.num_documento";
	return ejecutarConsulta($sql);
}

// cantidad de matriculas pendiente digital
	public function cantidadpendienteenviodigitalpersonal($idpersonal)
	{
		$sql="SELECT COUNT(m.idmatricula) as cantidad
		FROM matricula m INNER JOIN personal u ON m.idpersonal=u.idpersonal  
		WHERE m.idpersonal = '$idpersonal' AND m.estadoventa ='ACTIVADO' AND m.enviodigital='PENDIENTE'
		ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);
	}
// Lista de matriculas pendiente digital
	public function listadpendienteenviodigitalpersonal($idpersonal)
	{
		$sql="SELECT u.nombre as personal, CONCAT(m.fecha_hora,' ',m.hora)  as fecha,m.cod_matricula, p.nombre as participante,p.num_documento,
		p.telefono,c.nombre,categoria.nombre as categoria,c.fecha_inicio,m.accesoaula,m.formato,m.enviodigital,m.estadoenvio,m.prioridad,m.observaciones
		FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal u ON m.idpersonal=u.idpersonal  
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idpersonal = '$idpersonal' AND m.estadoventa ='ACTIVADO' AND m.enviodigital='PENDIENTE'
		ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);
	}

//cantidad de envios en proceso de envio
	public function cantidadpendienteenviofisicopersonal($idpersonal)
	{
		$sql="SELECT COUNT(ge.idenvio) as cantidad
		FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula 
		INNER JOIN personal per ON per.idpersonal = m.idpersonal
		WHERE  ge.estado ='ENVÍO EN PROCESO' AND m.estadoventa ='ACTIVADO' AND m.idpersonal = '$idpersonal'";
		return ejecutarConsulta($sql);
	}

// Lista de envios en proceso de envio 
	public function listapendienteenviosfisicospersonal($idpersonal)
	{
		$sql="SELECT ge.idenvio,CONCAT(m.fecha_hora,' ',m.hora)  as fecha,m.cod_matricula, p.nombre as participante,p.num_documento,
		p.telefono,c.nombre,categoria.nombre as categoria,ge.lugarenvio,ge.estado,m.fecha_inicio,m.observaciones_envio as observaciones
		FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula 
		INNER JOIN persona p ON p.idpersona = m.idparticipante
		INNER JOIN personal per ON per.idpersonal = m.idpersonal
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria = categoria.idcategoria
		WHERE  ge.estado ='ENVÍO EN PROCESO' AND m.estadoventa ='ACTIVADO' AND m.idpersonal = '$idpersonal'";
		return ejecutarConsulta($sql);
	}

// Lista de reclamos en estado pendiente 
	public function listareclamospendientespersonal($idpersonal)
	{
		$sql="SELECT gr.fecha, m.cod_matricula, p.nombre as participante, p.num_documento,p.telefono,gr.observaciones,
		m.fecha_inicio,c.nombre, categoria.nombre as categoria, a.nombre as asunto, gr.descripcion,gr.estado
		FROM gestionreclamos gr INNER JOIN matricula m ON m.idmatricula = gr.idmatricula
		INNER JOIN asunto a ON a.idasunto = gr.idasunto
		INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal u ON u.idpersonal = gr.idpersonal 
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE gr.idpersonal = '$idpersonal' AND gr.estado='POR RESOLVER' 
		ORDER BY gr.idreclamo DESC";
		return ejecutarConsulta($sql);
	}

// cantidad de reclamos en estado pendiente 
	public function cantidadreclamospendientespersonal($idpersonal)
	{
		$sql="SELECT COUNT(gr.idreclamo) as cantidad
		FROM gestionreclamos gr	INNER JOIN personal u ON u.idpersonal = gr.idpersonal 
		WHERE gr.idpersonal = '$idpersonal' AND gr.estado='POR RESOLVER'";
		return ejecutarConsulta($sql);
	}

// Lista de reclamos en estado pendiente 
	public function listasatisfaccionclientepersonal($idpersonal)
	{
		$sql="SELECT CONCAT(m.fecha_hora,' ',m.hora)  as fecha, m.cod_matricula, p.nombre as participante, p.num_documento,p.telefono,
		c.nombre, categoria.nombre as categoria, m.fecha_inicio, concat(m.satisfacion,' PENDIENTE') AS satisfacion,m.observaciones_satisfacion as observaciones
		FROM matricula m INNER JOIN personal u ON u.idpersonal = m.idpersonal 
		INNER JOIN persona p ON m.idparticipante = p.idpersona 
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE m.idpersonal = '$idpersonal' AND m.estadosatisfacion='' 
		ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);
	}

// cantidad de reclamos en estado pendiente 
	public function cantidadsatisfaccionclientepersonal($idpersonal)
	{
	$sql="SELECT COUNT(m.idmatricula) as cantidad
	FROM matricula m INNER JOIN personal u ON u.idpersonal = m.idpersonal 
	WHERE m.idpersonal = '$idpersonal' AND m.estadosatisfacion=''";
	return ejecutarConsulta($sql);
	}



//------------------------------ ***  SESSSION ENVIO    *** -------------------------------------------------
// Lista de envios pendientes 
	public function listapendienteenviosgeneral()
	{
		$sql="SELECT ge.idenvio,CONCAT(m.fecha_hora,' ',m.hora)  as fecha,m.cod_matricula, p.nombre as participante,p.num_documento,
		p.telefono,c.nombre,categoria.nombre as categoria,ge.lugarenvio,ge.estado,m.fecha_inicio,ge.observaciones
		FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula=ge.idmatricula 
		INNER JOIN persona p ON p.idpersona =m.idparticipante
		INNER JOIN cursos c ON m.idcurso=c.idcurso
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE  ge.estado='ENVÍO EN PROCESO' AND m.estadoventa='ACTIVADO'";
		return ejecutarConsulta($sql);
	}

// cantidad de envios pendientes 
	public function cantidadpendienteenvios()
	{
		$sql="SELECT COUNT(1) as cantidad
		FROM gestionenvios ge WHERE ge.estado ='ENVÍO EN PROCESO'
		ORDER BY ge.idenvio ASC";
		return ejecutarConsulta($sql);
	}

	
//  --------------------------   **   VISTA VENTAS DEL DIA PERSONAL   **   -----------------------  //

	//venta total
	public function totalventahoy($idpersonal)
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM matricula WHERE idpersonal = '$idpersonal' and DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}
	//monto curso corto
	public function totalmontocorto($idpersonal)
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.idpersonal='$idpersonal' AND ca.nombre = 'CURSO CORTO' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}
	//monto diplomas
	public function totalmontodiploma($idpersonal)
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.idpersonal='$idpersonal' AND ca.nombre = 'DIPLOMA' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}
	 // monto diplomas especializacion
	public function totalmontodiplomaespecializacion($idpersonal)
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.idpersonal='$idpersonal' AND ca.nombre = 'DIPLOMA DE ESPECIALIZACIÓN' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}

	//cantidad vendidos curso corto
	public function totalcantidadcorto($idpersonal)
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE  m.idpersonal='$idpersonal' AND ca.nombre = 'CURSO CORTO' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}

	//cantidad vendidos diploma
	public function totalcantidaddiploma($idpersonal)
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE  m.idpersonal='$idpersonal' AND ca.nombre = 'DIPLOMA' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}
	//cantidad vendidos diploma de especializacion
	public function totalcantidaddiplomaespecializacion($idpersonal)
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE  m.idpersonal='$idpersonal' AND ca.nombre = 'DIPLOMA DE ESPECIALIZACIÓN' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}




//  ------------------------------------------   **   VISTA REPORTE GENERAL ENCAP **   -------------------------------------------- //
//===================================================================================================================================

// ventas x cada mes
	public function listaventatotalencap()
	{
		//Date format -> convertir fecha y hora en un formato de mes
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha, IFNULL(concat('S/. ',SUM(monto)),0) as total 
		FROM matricula WHERE estadoventa='ACTIVADO' GROUP by MONTH(fecha_hora) ORDER BY fecha_hora DESC limit 0,12";
		return ejecutarConsulta($sql);
	}

// ventas x cada mes x formato
	public function listadoventasformatosmonto()
	{
		//Date format -> convertir fecha y hora en un formato de mes
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha, formato, concat('S/. ',SUM(monto)) as total 
		FROM matricula WHERE estadoventa='ACTIVADO' GROUP by MONTH(fecha_hora),formato ORDER BY fecha_hora,formato DESC limit 0,12";
		return ejecutarConsulta($sql);
	}
// ventas x cada mes x formato
	public function listadoventasformatoscantidad()
	{
		//Date format -> convertir fecha y hora en un formato de mes
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha, formato, SUM(1) AS cantidad 
		FROM matricula WHERE estadoventa='ACTIVADO' GROUP by MONTH(fecha_hora),formato ORDER BY fecha_hora,formato DESC limit 0,12";
		return ejecutarConsulta($sql);
	}
	
//ventas ultimos 10 dias 
	public function ventasultimos_10dias()
	{
		$sql="SELECT CONCAT(DATE_FORMAT(fecha_hora,'%M'), ' -', DAY(fecha_hora))  as fecha, SUM(monto) as total 
		FROM matricula WHERE estadoventa='ACTIVADO' GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,14";
		return ejecutarConsulta($sql);
	}

//ventas ultimos 10 dias 
public function listaventasultimos_10dias()
{
	$sql="SELECT CONCAT(DATE_FORMAT(fecha_hora,'%M'), ' -', DAY(fecha_hora)) as fecha, CONCAT('S/. ',SUM(monto)) as total 
	FROM matricula WHERE estadoventa='ACTIVADO' GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,14";
	return ejecutarConsulta($sql);
}

// ventas x cada mes
 	public function ventasultimos_12meses()
	{
		//Date format -> convertir fecha y hora en un formato de mes
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha,SUM(monto) as total 
		FROM matricula WHERE estadoventa='ACTIVADO' GROUP by MONTH(fecha_hora) ORDER BY fecha_hora DESC limit 0,12";
		return ejecutarConsulta($sql);
	}

	// ventas x cada mes x formato
	public function ventasultimos_12mesesformato()
	{
		//Date format -> convertir fecha y hora en un formato de mes
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha, formato, SUM(1) AS cantidad 
		FROM matricula WHERE estadoventa='ACTIVADO' GROUP by MONTH(fecha_hora),formato ORDER BY fecha_hora,formato DESC limit 0,12";
		return ejecutarConsulta($sql);
	}

		// ventas x cada mes x formato
	public function ventasultimos_12mesesformatomonto()
	{
	//Date format -> convertir fecha y hora en un formato de mes
	$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha, formato, SUM(monto) as total 
	FROM matricula WHERE estadoventa='ACTIVADO' GROUP by MONTH(fecha_hora),formato ORDER BY fecha_hora,formato DESC limit 0,12";
	return ejecutarConsulta($sql);
	}

//medios de pagos total
	public function mediosdepagos()
	{
		$sql="SELECT me.nombre as nombre, COUNT(m.idmediospagos) AS cantidad
		FROM matricula m inner JOIN mediospagos me on me.idmediospagos = m.idmediospagos
         WHERE m.estadoventa='ACTIVADO'	GROUP BY m.idmediospagos 
		ORDER BY COUNT(m.idmediospagos) DESC";
		return ejecutarConsulta($sql);
	}

//medios de pagos total
	public function listadomediospagos()
	{
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha, me.nombre as nombre, COUNT(m.idmediospagos) AS cantidad
		FROM matricula m inner JOIN mediospagos me on me.idmediospagos = m.idmediospagos
		WHERE m.estadoventa='ACTIVADO' 
		GROUP BY  MONTH(fecha_hora), m.idmediospagos  	
		ORDER BY fecha_hora, COUNT(m.idmediospagos) DESC";
		return ejecutarConsulta($sql);
	}

//forma de recaudacionSELECT fr.nombre as nombre, COUNT(m.idforma_recaudacion) AS cantidad
	public function formarecaudacion()
	{
		$sql="SELECT fr.nombre as nombre, COUNT(m.idforma_recaudacion) AS cantidad
		FROM matricula m inner JOIN forma_recaudacion fr 	ON fr.idforma_recaudacion = m.idforma_recaudacion
		WHERE m.estadoventa='ACTIVADO' AND m.idforma_recaudacion !=3
		GROUP BY m.idforma_recaudacion 	ORDER BY COUNT(m.idforma_recaudacion) DESC";
		return ejecutarConsulta($sql);
	}
	
// ventas monto por categoria
	public function montoventascategoria()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto, ca.nombre as categoria 
		FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso 
		INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.estadoventa='ACTIVADO' GROUP BY ca.idcategoria 
		ORDER BY COUNT(ca.idcategoria) DESC";
		return ejecutarConsulta($sql);
	}

//cantidad total vendidos curso corto hoy
	public function totalcantidadcortohoy()
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE ca.nombre = 'CURSO CORTO' AND m.estadoventa ='ACTIVADO'  AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

//monto curso corto
	public function totalmontocortohoy()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE  ca.nombre = 'CURSO CORTO' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}

	//cantidad total vendidos curso corto hoy
	public function totalcantidiplomahoy()
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE ca.nombre = 'DIPLOMA' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

//monto curso corto
	public function totalmontodiplomahoy()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE  ca.nombre = 'DIPLOMA' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}

	//cantidad total vendidos curso corto hoy
	public function totalcantidaddiplomaeshoy()
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE ca.nombre = 'DIPLOMA DE ESPECIALIZACIÓN' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

//monto curso corto
	public function totalmontodiplomaeshoy()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto,ca.nombre as categoria FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE  ca.nombre = 'DIPLOMA DE ESPECIALIZACIÓN' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate() ";
		return ejecutarConsulta($sql);
	}

	//cantidad total vendidos curso corto hoy
	public function ventatotalcantidadhoy()
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad FROM matricula m 
		WHERE m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}
	
	//monto curso corto
	public function ventatotalmontohoy()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM matricula m 
		WHERE m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

//cantidad total vendidos curso corto hoy
	public function totalcantidadfisicohoy()
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,m.formato FROM matricula m 
		WHERE m.formato = 'FISICO' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

//monto curso corto
	public function totalmontofisicohoy()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto	FROM matricula m 
		WHERE m.formato = 'FISICO' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

	//cantidad total vendidos curso corto hoy
	public function totalcantidaddigitalhoy()
	{
		$sql="SELECT IFNULL (count(idmatricula),0) as cantidad,m.formato FROM matricula m 
		WHERE m.formato = 'DIGITAL' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

//monto curso corto
	public function totalmontodigitalhoy()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto	FROM matricula m 
		WHERE m.formato = 'DIGITAL' AND m.estadoventa ='ACTIVADO' AND DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

//ventas del personal 
	public function ventaspersonal()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto, pe.nombre AS personal
		FROM matricula m INNER JOIN personal pe ON pe.idpersonal =m.idpersonal 
		WHERE m.estadoventa='ACTIVADO' GROUP BY pe.idpersonal
		ORDER BY monto desc";
		return ejecutarConsulta($sql);
	}

	//MEDIOS DE TRAFICOS 
	public function ventasmediostrafico()
	{
		$sql="SELECT t.nombre as nombre, COUNT(m.idtrafico) AS cantidad
		FROM matricula m inner JOIN trafico t ON t.idtrafico = m.idtrafico
		WHERE m.estadoventa='ACTIVADO' 
		GROUP BY m.idtrafico 
		ORDER BY COUNT(m.idtrafico) DESC";
		return ejecutarConsulta($sql);
	}

	//ANULADOS Y ACTIVADOS
	public function ventasanulados()
	{	
		$sql="SELECT m.estadoventa as nombre, COUNT(m.estadoventa) AS cantidad
		FROM matricula m GROUP BY m.estadoventa 
		ORDER BY COUNT(m.estadoventa) DESC";
		return ejecutarConsulta($sql);
	}



//  ------------------------------------------   **   VENTAS FECHAS DETALLADOS ENCAP **   -------------------------------------------- //
//=======================================================================================================================================
//*- VENTAS POR MES Y ASESOR - LISTA
	public function ventamontototal($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT IFNULL(concat('S/. ',SUM(monto)),0) as monto FROM matricula m 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin' ";
		return ejecutarConsulta($sql);
	}
	
//*- VENTAS POR ASESOR Y CATEGORIA - LISTA
	public function listacategoriaventasasesor($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT substring(pe.nombre,1,15) as personal, ca.nombre as categoria, SUM(1) AS cantidad, IFNULL(concat('S/. ',SUM(monto)),0) as monto 
		FROM matricula m INNER JOIN personal pe ON pe.idpersonal = m.idpersonal 
		INNER JOIN cursos c ON c.idcurso=m.idcurso 
		INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.idpersonal,c.idcategoria ORDER BY categoria DESC";
		return ejecutarConsulta($sql);
	}

//*- VENTAS POR ASESOR Y CATEGORIA - GRAFICO
	public function categoriaventasasesor($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT substring(pe.nombre,1,15) as personal, ca.nombre as categoria, SUM(1) AS cantidad, IFNULL(concat('S/. ',SUM(monto)),0) as monto 
		FROM matricula m INNER JOIN personal pe ON pe.idpersonal = m.idpersonal 
		INNER JOIN cursos c ON c.idcurso=m.idcurso 
		INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY pe.idpersonal,categoria ORDER BY pe.idpersonal,categoria,cantidad DESC";
		return ejecutarConsulta($sql);
	}

//*- VENTAS POR MES Y ASESOR - LISTA
	public function listamontoventaspormes($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT pe.nombre AS personal, m.formato, SUM(1) AS cantidad, IFNULL(concat('S/. ',SUM(monto)),0) as monto 
		FROM matricula m INNER JOIN personal pe ON pe.idpersonal = m.idpersonal 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin' 
		GROUP BY pe.idpersonal,m.formato 
		ORDER BY pe.idpersonal DESC";
		return ejecutarConsulta($sql);
	}

//*- VENTAS MONTO TOTAL POR MES Y ASESOR - LISTA
	public function listamontototalventaspormes($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT pe.nombre AS personal,  IFNULL(concat('S/. ',SUM(monto)),0) as monto 
		FROM matricula m INNER JOIN personal pe ON pe.idpersonal =m.idpersonal 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY pe.idpersonal";
		return ejecutarConsulta($sql);
	}

//*- VENTAS POR MES Y ASESOR - GRAFICO
	public function montoventaspormes($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT pe.nombre AS personal, IFNULL(SUM(monto),0) as monto 
		FROM matricula m INNER JOIN personal pe ON pe.idpersonal =m.idpersonal 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY pe.idpersonal
		ORDER BY monto DESC";
		return ejecutarConsulta($sql);
	}

//*- CATEGORIAS MONTO - LISTA
	public function listamontoCategoria($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT ca.nombre as categoria, IFNULL(concat('S/. ',SUM(monto)),0) as monto 
			FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso 
			INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
			WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
			GROUP BY ca.idcategoria 
			ORDER BY COUNT(ca.idcategoria) DESC";
		return ejecutarConsulta($sql);
	}

//*- CATEGORIAS MONTO - GRAFICO
	public function categoriasmonto($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT ca.nombre as categoria, IFNULL(SUM(monto),0) as monto 
			FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso 
			INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
			WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
			GROUP BY ca.idcategoria 
			ORDER BY COUNT(ca.idcategoria) DESC";
		return ejecutarConsulta($sql);
	}

//*- LISTA CATEGORIAS MONTO - GRAFICO
	public function listacantidadCategoria($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT ca.nombre as categoria, m.formato, COUNT(m.idcurso) AS cantidad 
		FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso 
		INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY ca.idcategoria,m.formato
		ORDER BY ca.idcategoria DESC";
		return ejecutarConsulta($sql);
	}

//*- GRAFICO CATEGORIAS MONTO - GRAFICO
	public function categoriascantidad($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT ca.nombre as categoria, m.formato, COUNT(m.idcurso) AS cantidad 
		FROM matricula m INNER JOIN cursos c ON c.idcurso=m.idcurso 
		INNER JOIN categoria ca ON ca.idcategoria =c.idcategoria 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY ca.idcategoria,m.formato
		ORDER BY ca.idcategoria DESC";
		return ejecutarConsulta($sql);
	}

//*- MEDIOS DE PAGOS - LISTA
	public function listamediosdepagos($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT me.nombre as nombre, COUNT(m.idmediospagos) AS cantidad
		FROM matricula m inner JOIN mediospagos me on me.idmediospagos = m.idmediospagos
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.idmediospagos 
		ORDER BY COUNT(m.idmediospagos) DESC";
		return ejecutarConsulta($sql);
	}

//*- MEDIOS DE PAGOS - GRAFICO
	public function mediospagosfechas($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT me.nombre as nombre, COUNT(m.idmediospagos) AS cantidad
		FROM matricula m inner JOIN mediospagos me on me.idmediospagos = m.idmediospagos
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.idmediospagos 
		ORDER BY COUNT(m.idmediospagos) DESC";
		return ejecutarConsulta($sql);
	}

//*- FORMA DE RECAUDACION - LISTA Y GRAFICO
	public function formaderecaudacion($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT fr.nombre as nombre, COUNT(m.idforma_recaudacion) AS cantidad
		FROM matricula m inner JOIN forma_recaudacion fr 	ON fr.idforma_recaudacion = m.idforma_recaudacion
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.idforma_recaudacion 
		ORDER BY COUNT(m.idforma_recaudacion) DESC";
		return ejecutarConsulta($sql);
	}

	//*- ESTADO VENTAS - LISTA Y GRAFICO
	public function estadoventas($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT m.estadoventa as nombre, COUNT(m.estadoventa) AS cantidad
		FROM matricula m 
		WHERE DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.estadoventa ORDER BY COUNT(m.estadoventa) DESC";
		return ejecutarConsulta($sql);
	}


//total de ciudades mas vendido - lista 
	public function listaciudadesmasvendi($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT p.departamento as departamento, COUNT(p.departamento) AS n 
		FROM matricula m inner join persona p on p.idpersona = m.idparticipante 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY p.departamento ORDER BY COUNT(p.departamento) DESC";
		return ejecutarConsulta($sql);
	}


//total de ciudades mas vendido - grafico 
	public function ciudadesmasvendidos($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT p.departamento as departamento, COUNT(p.departamento) AS n 
		FROM matricula m inner join persona p on p.idpersona = m.idparticipante 
		WHERE m.estadoventa='ACTIVADO'  AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY p.departamento
		ORDER BY COUNT(p.departamento) DESC";
		return ejecutarConsulta($sql);
	}

//grafico de ventas personal 
	public function personal($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT pe.nombre AS personal, IFNULL(SUM(monto),0) as monto
		FROM matricula m INNER JOIN personal pe ON pe.idpersonal =m.idpersonal 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY pe.idpersonal
		ORDER BY monto DESC";
		return ejecutarConsulta($sql);
	}

//GRAFICO FORMATOS
	public function formatos($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT m.formato as formato, COUNT(m.idmatricula) AS cantidad 
		FROM matricula m WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.formato; ";
		return ejecutarConsulta($sql);
	}

// GRAFICO MEDIOS DE TRAFICO
	public function mediostrafico($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT t.nombre as nombre, COUNT(m.idtrafico) AS cantidad
		FROM matricula m inner JOIN trafico t ON t.idtrafico = m.idtrafico
		WHERE m.estadoventa='ACTIVADO'  AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.idtrafico 
		ORDER BY COUNT(m.idtrafico) DESC";
		return ejecutarConsulta($sql);
	}

//GRAFICO ANULADOS
	public function anulados($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT m.estadoventa as nombre, COUNT(m.estadoventa) AS cantidad
		FROM matricula m WHERE  DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY m.estadoventa 
		ORDER BY COUNT(m.estadoventa) DESC";
		return ejecutarConsulta($sql);
	}

// lista de cursos POR FECHAS
	public function listacursos($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT c.nombre as nombre, cat.nombre as categoria, COUNT(m.idcurso) AS cantidad 
		FROM matricula m inner join cursos c on c.idcurso = m.idcurso 
		inner join categoria cat on cat.idcategoria = c.idcategoria 
		WHERE DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora)<='$fecha_fin'  AND cat.nombre ='CURSO CORTO'
		GROUP BY m.idcurso 
		ORDER BY COUNT(m.idcurso) 
		DESC LIMIT 0 , 40;";
		return ejecutarConsulta($sql);		
	}
	
// lista de diplomas POR FECHAS
	public function listadiplomas($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT c.nombre as nombre, cat.nombre as categoria, COUNT(m.idcurso) AS cantidad 
		FROM matricula m inner join cursos c on c.idcurso = m.idcurso 
		inner join categoria cat on cat.idcategoria = c.idcategoria 
		WHERE DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora)<='$fecha_fin'  AND cat.nombre ='DIPLOMA'
		GROUP BY m.idcurso 
		ORDER BY COUNT(m.idcurso) 
		DESC LIMIT 0 , 40;";
		return ejecutarConsulta($sql);		
	}

// lista de diplomas de especializacion espe POR FECHAS
	public function listadiplomasesp($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT c.nombre as nombre, cat.nombre as categoria, COUNT(m.idcurso) AS cantidad 
		FROM matricula m inner join cursos c on c.idcurso = m.idcurso 
		inner join categoria cat on cat.idcategoria = c.idcategoria 
		WHERE DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora)<='$fecha_fin'  AND cat.nombre ='DIPLOMA DE ESPECIALIZACIÓN'
		GROUP BY m.idcurso 
		ORDER BY COUNT(m.idcurso) 
		DESC LIMIT 0 , 40;";
		return ejecutarConsulta($sql);		
	}


// lista de departamentos mas vendidos POR FECHAS
	public function listadepartamentos($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT p.departamento as departamento, COUNT(p.departamento) AS  cantidad 
		FROM matricula m inner join persona p on p.idpersona = m.idparticipante 
		WHERE m.estadoventa='ACTIVADO' AND DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin'
		GROUP BY p.departamento ORDER BY COUNT(p.departamento) DESC";
		return ejecutarConsulta($sql);		
	}


//   ------------------------------------------   **   REPORTE DETALLADO ENVÍOS ENCAP **   --------------------------------------------  //
//========================================================================================================================================

//*- ENVÍOS SEGUN TIPO - LISTA
public function listanenviosseguntipo($fecha_inicio,$fecha_fin)
{
	$sql="SELECT ca.nombre as nombre, COUNT(ge.idenvio) AS cantidad, IFNULL(concat('S/. ',ROUND(SUM(ge.monto),2)),0) as monto 
	FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula
	INNER JOIN cursos c ON c.idcurso = m.idcurso
	INNER JOIN categoria ca ON ca.idcategoria = c.idcategoria
	WHERE DATE(ge.fechaenvio)>='$fecha_inicio' AND DATE(ge.fechaenvio) <='$fecha_fin'
	GROUP BY ca.nombre	ORDER BY monto DESC";
	return ejecutarConsulta($sql);
}

//*- ENVÍOS SEGUN TIPO  - GRAFICO
public function enviosseguntipo($fecha_inicio,$fecha_fin)
{
	$sql="SELECT ca.nombre as nombre, IFNULL(ROUND(SUM(ge.monto),2),0) as monto 
	FROM gestionenvios ge INNER JOIN matricula m ON m.idmatricula = ge.idmatricula
	INNER JOIN cursos c ON c.idcurso = m.idcurso
	INNER JOIN categoria ca ON ca.idcategoria = c.idcategoria
	WHERE DATE(ge.fechaenvio)>='$fecha_inicio' AND DATE(ge.fechaenvio) <='$fecha_fin'
	GROUP BY ca.nombre	ORDER BY monto DESC";
	return ejecutarConsulta($sql);
}


//*- ENVÍOS POR COURIER  - LISTA
public function listaenvioscourier($fecha_inicio,$fecha_fin)
{
	$sql="SELECT co.nombre as nombre, COUNT(1) AS cantidad, IFNULL(CONCAT ('S/. ',ROUND(SUM(ge.monto),2)),0) as monto 
	FROM gestionenvios ge INNER JOIN courier co ON co.idcourier = ge.idcourier
	WHERE DATE(ge.fechaenvio)>='$fecha_inicio' AND DATE(ge.fechaenvio) <='$fecha_fin'
	GROUP BY co.nombre  ORDER BY ROUND(SUM(ge.monto),2) DESC";
	return ejecutarConsulta($sql);
}

//*- ENVÍOS POR COURIER - GRAFICO
public function envioscourier($fecha_inicio,$fecha_fin)
{
	$sql="SELECT co.nombre as nombre,  IFNULL(ROUND(SUM(ge.monto),2),0) as monto 
	FROM gestionenvios ge INNER JOIN courier co ON co.idcourier = ge.idcourier
	WHERE DATE(ge.fechaenvio)>='$fecha_inicio' AND DATE(ge.fechaenvio) <='$fecha_fin'
	GROUP BY co.nombre  ORDER BY monto DESC";
	return ejecutarConsulta($sql);
}


//*- ENVÍOS POR COURIER - GRAFICO
public function listalu($fecha_inicio,$fecha_fin)
{
	$sql="SELECT co.nombre as nombre,  IFNULL(ROUND(SUM(ge.monto),2),0) as monto 
	FROM gestionenvios ge INNER JOIN courier co ON co.idcourier = ge.idcourier
	WHERE DATE(ge.fechaenvio)>='$fecha_inicio' AND DATE(ge.fechaenvio) <='$fecha_fin'
	GROUP BY co.nombre  ORDER BY monto DESC";
	return ejecutarConsulta($sql);
}

//*- ENVÍOS CUIDADES  - LISTA
public function listaciudadesenvios($fecha_inicio,$fecha_fin)
{
	$sql="SELECT ge.lugarenvio as nombre, COUNT(ge.idenvio) AS cantidad, IFNULL(concat('S/. ',ROUND(SUM(ge.monto),2)),0) as monto 
	FROM gestionenvios ge 
	WHERE DATE(ge.fechaenvio)>='$fecha_inicio' AND DATE(ge.fechaenvio) <='$fecha_fin'
	GROUP BY ge.lugarenvio ORDER BY cantidad DESC";
	return ejecutarConsulta($sql);
}

//*- ENVÍOS CUIDADES  - LISTA
public function cuidadesenvios($fecha_inicio,$fecha_fin)
{
	$sql="SELECT ge.lugarenvio as nombre, IFNULL(ROUND(SUM(ge.monto),2),0) as monto  
	FROM gestionenvios ge 
	WHERE DATE(ge.fechaenvio)>='$fecha_inicio' AND DATE(ge.fechaenvio) <='$fecha_fin'
	GROUP BY ge.lugarenvio ORDER BY monto DESC";
	return ejecutarConsulta($sql);
}


//   ------------------------------------------   **   REPORTE DETALLADO RECLAMOS ENCAP **   --------------------------------------------  //
//===========================================================================================================================================

//*- RECLAMOS ASUNTO  - LISTA Y GRAFICO
public function listareclamoporasunto($fecha_inicio,$fecha_fin)
{
	$sql="SELECT a.nombre as nombre, COUNT(gr.idreclamo) AS cantidad
	FROM gestionreclamos gr INNER JOIN asunto a ON a.idasunto = gr.idasunto
	WHERE DATE(gr.fecha)>='$fecha_inicio' AND DATE(gr.fecha) <='$fecha_fin'
	GROUP BY nombre ORDER BY cantidad DESC";
	return ejecutarConsulta($sql);
}

//*- RECLAMOS SUB ASUNTO  - LISTA Y GRAFICO
public function listareclamosubcategoria($fecha_inicio,$fecha_fin)
{
	$sql="SELECT a.nombre as asunto, sa.nombre as nombre, COUNT(gr.idreclamo) AS cantidad
	FROM gestionreclamos gr INNER JOIN subasunto sa ON sa.idsubasunto = gr.idsubasunto
	INNER JOIN asunto a ON a.idasunto = gr.idasunto
	WHERE DATE(gr.fecha)>='$fecha_inicio' AND DATE(gr.fecha) <='$fecha_fin'
	GROUP BY nombre ORDER BY cantidad DESC";
	return ejecutarConsulta($sql);
}

//*- RECLAMOS SUB ASUNTO  -  GRAFICO
public function graficoreclamosubcategoria($fecha_inicio,$fecha_fin)
{
	$sql="SELECT sa.nombre as nombre, COUNT(gr.idreclamo) AS cantidad
	FROM gestionreclamos gr INNER JOIN subasunto sa ON sa.idsubasunto = gr.idsubasunto
	WHERE DATE(gr.fecha)>='$fecha_inicio' AND DATE(gr.fecha) <='$fecha_fin'
	GROUP BY nombre ORDER BY cantidad DESC";
	return ejecutarConsulta($sql);
}


//   ---------------------------------   **   REPORTE DETALLADO SATISFACCION DEL CLIENTE ENCAP **   --------------------------------------  //
//===========================================================================================================================================

//*- SATISFACCION DEL CLIENTE  - LISTA Y GRAFICO
public function listasatisfaccion($fecha_inicio,$fecha_fin)
{
	$sql="SELECT m.satisfacion as nombre , COUNT(1) AS cantidad FROM matricula m 
	WHERE DATE(m.fecha_hora)>='$fecha_inicio' AND DATE(m.fecha_hora) <='$fecha_fin' AND m.satisfacion!=''
	GROUP BY nombre ORDER BY cantidad DESC; ";
	return ejecutarConsulta($sql);
}

//   ---------------------------------   **   REPORTE DETALLADO SATISFACCION DEL CLIENTE ENCAP **   --------------------------------------  //
//===========================================================================================================================================
	public function listaparticipantes($fecha_inicio, $fecha_fin) {
		$sql = "SELECT 
					p.num_documento, 
					p.nombre,
					MAX(m.fecha_hora) as fecha_hora,
					COUNT(case when cat.nombre = 'CURSO CORTO' then 1 end) 'curso_corto',
					COUNT(case when cat.nombre = 'DIPLOMA' then 1 end) 'diploma',
					COUNT(case when cat.nombre = 'DIPLOMA DE ESPECIALIZACIÓN' then 1 end) 'diploma_esp',
					COUNT(case when cat.nombre = 'CURSO IN HOUSE' then 1 end) 'curso_house',
					COUNT(case when cat.nombre = 'CONVENIOS' then 1 end) 'convenios'
				FROM matricula m
				INNER JOIN cursos c on m.idcurso = c.idcurso
				INNER JOIN persona p on m.idparticipante = p.idpersona
				INNER JOIN categoria cat on c.idcategoria = cat.idcategoria
				WHERE DATE(m.fecha_hora) >= '$fecha_inicio' AND DATE(m.fecha_hora) <= '$fecha_fin'
				GROUP BY m.idparticipante  
				ORDER BY m.fecha_hora DESC;";

		return ejecutarConsulta($sql);
	}



}
?>