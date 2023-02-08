<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

	//Obtenemos la fecha actual
	
Class Listadocentes
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	//Incluyendo los detalles del ingreso
	public function insertar($idpersonal,$fecha_hora,$cod_matricula,$idparticipante,$idcurso1,$fecha_inicio2,$qr,$accesoaula,$voucher,$compromiso)
	{
		$sql="INSERT INTO matricula_docentes (idpersonal,fecha_hora,cod_matricula,idparticipante,idcurso,fecha_inicio,qr,accesoaula,observaciones_envio,estadoenvio,estadoventa,comprobante,observaciones,condicion,voucher,compromiso) 		
		VALUES ('$idpersonal','$fecha_hora','$cod_matricula','$idparticipante','$idcurso1','$fecha_inicio2','$qr','$accesoaula','$voucher,$compromiso)";
		return ejecutarConsulta($sql);		

	}

	public function editar($idmatricula,$idpersonal,$fecha_hora,$cod_matricula,$idparticipante,$idcurso1,$fecha_inicio2,$qr,$horas,$contexto,$nota,$año,$imagen,$imagenposterior,$idplantilla,$categoria)
	{
		$sql="UPDATE matricula_docentes SET idpersonal ='$idpersonal',fecha_hora='$fecha_hora',cod_matricula ='$cod_matricula',idparticipante='$idparticipante',idcurso='$idcurso1',fecha_inicio='$fecha_inicio2',qr='$qr',
		horas='$horas',contexto='$contexto',nota='$nota',año='$año', imagen='$imagen',imagenposterior='$imagenposterior',idplantilla='$idplantilla',categoria='$categoria' WHERE idmatricula='$idmatricula'" ;
	 	return ejecutarConsulta($sql);
		
	}

	//Implementamos un método para anular categorías
	public function enviar($idmatricula)
	{
		$sql="UPDATE matricula_docentes SET enviodigital='ENTREGADO' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular categorías
	public function noenviar($idmatricula)
	{
		$sql="UPDATE matricula_docentes SET enviodigital='PENDIENTE' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}




	

	//Implementamos un método para habilitar certificados
	public function habilitar($idmatricula)
	{
		$sql="UPDATE matricula_docentes SET certificado='SI' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular habilitacion de certificados
	public function nohabilitar($idmatricula)
	{
		$sql="UPDATE matricula_docentes SET certificado='NO' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular categorías
	public function anular($idmatricula)
	{
		$sql="UPDATE matricula_docentes SET estado='Anulado' WHERE idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Eliminar FUNCION DE PENDIENTE*************+
	//************************
	public function eliminarRegistro($idmatricula)
	{
		$sql="DELETE FROM matricula_docentes WHERE idmatricula='$idmatricula'";
		
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro 
	public function mostrar($idmatricula)
	{	
		$sql="SELECT m.idmatricula,m.fecha_hora as fecha,p.email, per.nombre as nombrepersonal, pa.nombre as pais,p.departamento,p.ciudad,p.direccion,p.fecha_cumple,p.telefono,p.telefono2,m.horas AS horas, p.nombre as participante,m.cod_matricula, c.nombre,categoria.nombre as categoria,c.n_horas,td.nombre as tipo_documento,p.num_documento,m.qr, m.año,c.contexto,m.nota, m.idcurso,m.idparticipante,m.idpersonal,m.idplantilla,m.imagen,m.imagenposterior,m.categoria FROM matricula_docentes m 
		INNER JOIN docente p ON m.idparticipante=p.idpersona 
		INNER JOIN personal per ON per.idpersonal=m.idpersonal 
		INNER JOIN cursos c ON m.idcurso=c.idcurso 
		INNER JOIN pais pa ON pa.idpais =p.idpais 
		INNER JOIN tipo_documento td ON td.idtipo_documento =p.idtipo_documento 
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		WHERE m.idmatricula='$idmatricula';";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idmatricula)
	{
		$sql="SELECT m.idmatricula,m.idcurso,c.cod_curso,c.nombre as curso ,categoria.nombre as categoria, c.n_horas, m.fecha_inicio 
		FROM matricula_docentes m INNER JOIN cursos c ON m.idcurso= c.idcurso 
		INNER JOIN categoria categoria ON categoria.idcategoria=c.idcategoria
		WHERE m.idmatricula='$idmatricula'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT m.idmatricula,m.fecha_hora as fecha, p.email, pe.nombre as personal, p.nombre as participante, p.telefono,p.departamento,p.ciudad, m.cod_matricula, c.nombre,categoria.nombre as categoria,c.n_horas,m.fecha_inicio, td.nombre as tipo_documento, p.num_documento, m.certificado, m.qr,m.condicion,idplantilla 
		FROM matricula_docentes m 
		INNER JOIN docente p ON m.idparticipante=p.idpersona 
		INNER JOIN tipo_documento td ON td.idtipo_documento =p.idtipo_documento 
		INNER JOIN personal pe ON pe.idpersonal =m.idpersonal 
		INNER JOIN cursos c ON m.idcurso=c.idcurso 
		INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria 
		ORDER BY m.idmatricula DESC;";
		return ejecutarConsulta($sql);		
	}

	public function listarCategoria()
	{
		
		$sql="SELECT * FROM certificados
		WHERE idcategoria='9'";
		return ejecutarConsulta($sql);
	}
}

?>