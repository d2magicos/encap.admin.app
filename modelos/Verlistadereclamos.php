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
	public function insertar($idmatricula,$idpersonal,$idasunto,$idsubasunto,$fecha,$descripcion,$fechaatencion,$hora,$solucion,$prioridad,$estado,$observaciones)
	{
		$sql="INSERT INTO gestionreclamos (idmatricula,idpersonal,idasunto,idsubasunto,fecha,descripcion,fechaatencion,hora,solucion,prioridad,estado,observaciones,condicion) 		
		VALUES ('$idmatricula','$idpersonal','$idasunto','$idsubasunto','$fecha','$descripcion','$fechaatencion','$hora','$solucion','$prioridad','$estado','$observaciones','1')";
		return ejecutarConsulta($sql);
	}

	// //Implementamos un método para editar registros
	public function editar($idreclamo,$fecha, $idasunto,$idsubasunto,$descripcion,$prioridad,$observaciones)
	{
	 	$sql="UPDATE gestionreclamos SET fecha='$fecha',idasunto='$idasunto',idsubasunto= '$idsubasunto',descripcion='$descripcion',prioridad='$prioridad',observaciones='$observaciones',condicion='1' WHERE idreclamo='$idreclamo'";
	 	return ejecutarConsulta($sql);
	}
	
	//Implementamos un método para anular registros
	public function actualizado($idmatricula,$estado)
	{
		$sql="UPDATE matricula SET estadoreclamo='$estado' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular registros
	public function eliminar($idreclamo)
	{
		$sql="DELETE FROM gestionreclamos WHERE idreclamo='$idreclamo'";
		return ejecutarConsulta($sql);
	}
	
	//Implementamos un método para desactivar categorías
	public function desactivar($idreclamo)
	{
		$sql="UPDATE gestionreclamos SET condicion='0' WHERE idreclamo='$idreclamo'";
		return ejecutarConsulta($sql);
	}
	
	//Implementamos un método para activar categorías
	public function activar($idreclamo)
	{
		$sql="UPDATE gestionreclamos SET condicion='1' WHERE idreclamo='$idreclamo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idreclamo)
	{	
		$sql="SELECT gr.idreclamo,m.idmatricula,pe.idpersonal, pe.nombre as personal, m.fecha_hora,m.cod_matricula,td.nombre as tipo_documento ,p.email,p.nombre as participante,
		p.num_documento, p.telefono,p.telefono2,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,pais.nombre AS pais,c.nombre, categoria.nombre as categoria,m.fecha_inicio,gr.hora,
		a.nombre as asunto, gr.fecha,gr.descripcion,gr.solucion,gr.prioridad,gr.observaciones,gr.estado,gr.fechaatencion,sb.nombre as subasunto,sb.idsubasunto,a.nombre as asunto,gr.idasunto,gr.idsubasunto
		FROM gestionreclamos gr INNER JOIN matricula m ON m.idmatricula = gr.idmatricula
		INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN personal pe ON gr.idpersonal=pe.idpersonal 
		INNER JOIN asunto a ON a.idasunto = gr.idasunto
		INNER JOIN subasunto sb ON sb.idasunto = a.idasunto
		INNER JOIN tipo_documento td ON td.idtipo_documento=p.idtipo_documento 
		INNER JOIN cursos c ON m.idcurso=c.idcurso 
		INNER JOIN pais pais ON pais.idpais =p.idpais 
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		WHERE gr.idreclamo='$idreclamo'";
		return ejecutarConsultaSimpleFila($sql);
	}
	

	public function listarDetalle($idreclamo)
	{
		$sql="SELECT ge.idreclamo,m.idmatricula,c.cod_curso,c.nombre as curso,categoria.nombre as categoria,c.n_horas,m.fecha_inicio 
		FROM matricula m INNER JOIN cursos c ON m.idcurso= c.idcurso
		INNER JOIN gestionreclamos ge ON ge.idmatricula = m.idmatricula
		INNER JOIN categoria categoria ON categoria.idcategoria=c.idcategoria		
		where ge.idreclamo='$idreclamo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar($idpersonal)
	{
		$sql="SELECT u.nombre as personal,gr.idreclamo,concat( m.fecha_hora,' ',m.hora) as fecha_hora, p.email,p.nombre as participante,p.num_documento, p.telefono,p.telefono2,p.ciudad,
		m.cod_matricula,c.nombre, categoria.nombre as categoria,m.fecha_inicio,gr.fechaatencion,sb.nombre as subasunto,gr.hora,gr.hora_reclamo,a.idasunto,sb.idsubasunto,
		a.nombre as asunto, gr.fecha,gr.descripcion,gr.solucion,gr.prioridad,gr.observaciones,gr.estado,gr.condicion
		FROM gestionreclamos gr INNER JOIN matricula m ON m.idmatricula = gr.idmatricula
		INNER JOIN persona p ON m.idparticipante=p.idpersona 
		INNER JOIN asunto a ON a.idasunto = gr.idasunto
		INNER JOIN subasunto sb ON sb.idsubasunto = gr.idsubasunto
		INNER JOIN personal u ON gr.idpersonal=u.idpersonal 
		INNER JOIN cursos c ON m.idcurso=c.idcurso 
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
		WHERE u.idpersonal='$idpersonal'
		GROUP BY gr.idreclamo DESC";
		return ejecutarConsulta($sql);		
	}
}

?>
