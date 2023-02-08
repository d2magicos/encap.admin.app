<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

	//Obtenemos la fecha actual
	
Class Compra
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	//Incluyendo los detalles del ingreso
	public function insertar($idpersonal,$fecha_hora,$cod_matricula,$idparticipante,$idcurso1,$fecha_inicio2,$qr,$monto,$formato,$idforma_recaudacion,$idmediospagos,$noperacion,$prioridad,$accesoaula,$estadoventa,$comprobante,$observaciones)
	{
		$sql="INSERT INTO matricula (idpersonal,fecha_hora,cod_matricula,idparticipante,idcurso,fecha_inicio,qr,monto,formato,idforma_recaudacion,idmediospagos,noperacion,prioridad,enviodigital,accesoaula,estadoenvio,estadoventa,comprobante,observaciones,condicion) 		
		VALUES ('$idpersonal','$fecha_hora','$cod_matricula','$idparticipante','$idcurso1','$fecha_inicio2','$qr','$monto','$formato','$idforma_recaudacion','$idmediospagos','$noperacion','$prioridad','ENTREGADO','$accesoaula','POR ENVIAR','$estadoventa','$comprobante','$observaciones','1')";
		return ejecutarConsulta($sql);		
	}

	public function editar($idmatricula,$satisfacion,$estadosatisfacion,$observaciones_satisfacion,$fechainfo)
	{
		$sql="UPDATE matricula SET satisfacion='$satisfacion', estadosatisfacion='$estadosatisfacion',observaciones_satisfacion='$observaciones_satisfacion',fechainfo='$fechainfo' WHERE idmatricula='$idmatricula'" ;
	 	return ejecutarConsulta($sql);		
	}
	
	//Implementar un método para mostrar los datos de un registro 
	public function mostrar($idmatricula) {	
		$sql = "SELECT m.idmatricula,per.nombre as nombrepersonal, DATE(m.fecha_hora) as fecha, p.email,pa.nombre as pais, p.departamento, p.ciudad, p.direccion, p.fecha_cumple, p.telefono, p.telefono2,
					p.nombre as participante, m.cod_matricula, c.nombre, categoria.nombre as categoria,c.n_horas, m.fecha_inicio, m.observaciones_satisfacion, m.satisfacion, m.fechainfo,
					td.nombre as tipo_documento, p.num_documento, m.qr, me.nombre AS mediopago, m.condicion, m.idforma_recaudacion, m.idmediospagos, m.idcurso, m.idparticipante, m.idpersonal, m.estadosatisfacion,
					gs.valoracion1, gs.comentario1, gs.valoracion2, gs.comentario2, gs.valoracion3, gs.comentario3, gs.valoracion4, gs.comentario4, gs.estado
				FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
				INNER JOIN personal per ON per.idpersonal=m.idpersonal
				INNER JOIN cursos c ON m.idcurso = c.idcurso
				INNER JOIN pais pa  ON pa.idpais = p.idpais
				INNER JOIN tipo_documento td  ON td.idtipo_documento = p.idtipo_documento
				INNER JOIN mediospagos me ON me.idmediospagos = m.idmediospagos
				INNER JOIN forma_recaudacion fr ON fr.idforma_recaudacion = m.idforma_recaudacion
				INNER JOIN categoria categoria ON c.idcategoria = categoria.idcategoria		
				LEFT JOIN gestionsatisfaccion gs ON m.idmatricula = gs.idmatricula
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
	//MODIFICADO 24/06/22
	public function listar()
	{
		$sql = "SELECT m.idmatricula, u.nombre as personal, concat(m.fecha_hora,' ',m.hora) as fecha, p.email, p.telefono, p.telefono2, p.nombre as participante, m.cod_matricula, 
        			c.nombre, categoria.nombre as categoria, c.n_horas,m.formato,m.monto, m.fecha_inicio, td.nombre as tipo_documento, p.num_documento,
        			m.condicion, m.satisfacion, m.observaciones_satisfacion, m.fechainfo, m.estadosatisfacion, 
					gs.valoracion1, gs.comentario1, gs.valoracion2, gs.comentario2, gs.valoracion3, gs.comentario3, gs.valoracion4, gs.comentario4, gs.estado, gs.fecha as fechaSatisfaccion2,
					gs.bono_estado, gs.bono_caducidad
        		FROM matricula m 
				INNER JOIN persona p ON m.idparticipante = p.idpersona 
        		INNER JOIN tipo_documento td ON td.idtipo_documento = p.idtipo_documento 
        		INNER JOIN cursos c ON m.idcurso = c.idcurso
				INNER JOIN personal u ON m.idpersonal = u.idpersonal  
        		INNER JOIN categoria categoria ON c.idcategoria = categoria.idcategoria 
				LEFT JOIN gestionsatisfaccion gs ON m.idmatricula = gs.idmatricula
        		ORDER BY m.fecha_hora DESC ";

		return ejecutarConsulta($sql);		
	}

	/* nuevo */

	public function verificarSatisfaccion02($idmatricula) {
		$sql = "SELECT gs.idmatricula FROM gestionsatisfaccion gs
				WHERE gs.idmatricula = '$idmatricula'";

		return ejecutarConsulta($sql);
	}

	public function agregarSatisfaccion02($idmatricula, $val1, $com1, $val2, $com2, $val3, $com3, $val4, $com4, $fecha) {
		$sql = "INSERT INTO gestionsatisfaccion (idmatricula, valoracion1, comentario1, valoracion2, comentario2, valoracion3, comentario3, valoracion4, comentario4, estado, fecha, bono, bono_estado, bono_caducidad)
				VALUES ('$idmatricula', '$val1', '$com1', '$val2', '$com2', '$val3', '$com3', '$val4', '$com4', 'CONFIRMADO', '$fecha', '', 'POR SOLICITAR', '')";

		/* $sql = "INSERT INTO gestionsatisfaccion (idmatricula, valoracion1, comentario1, valoracion2, comentario2, valoracion3, comentario3, valoracion4, comentario3, estado, fecha)
				VALUES ('$idmatricula', '', '', '', '', '', '', '', '', '1', '')"; */

		/*  */
		return ejecutarConsulta($sql);
	}

	public function actualizarSatisfaccion02($idmatricula, $val1, $com1, $val2, $com2, $val3, $com3, $val4, $com4, $fecha) {
		$sql = "UPDATE gestionsatisfaccion SET valoracion1 = '$val1', comentario1 = '$com1', valoracion2 = '$val2', comentario2 = '$com2', valoracion3 = '$val3', comentario3 = '$com3', valoracion4 = '$val4', comentario4 = '$com4', fecha = '$fecha'
				WHERE idmatricula = '$idmatricula'";

		return ejecutarConsulta($sql);
	}

	public function habilitarBono($idmatricula, $fecha) {
		$sql = "UPDATE gestionsatisfaccion SET bono_estado = 'ACTIVO', bono_caducidad = '$fecha'
				WHERE idmatricula = '$idmatricula'";

		return ejecutarConsulta($sql);
	}
}

?>