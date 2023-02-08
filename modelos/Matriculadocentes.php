<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

	//Creamos el Objeto correcto
Class MatriculadoDocentes
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	//Incluyendo los detalles del ingreso
	public function insertar($idmatricula,$idpersonal,$fecha_hora,$cod_matricula,$idparticipante,$idcurso1,$fecha_inicio1,$qr,$fechainfo,$horas,$contexto,$imagen,$imagenposterior,$idplantilla)
	{
		$sql="INSERT INTO matricula_docentes (`idmatricula`, `idpersonal`, `fecha_hora`, `cod_matricula`, `idparticipante`, `idcurso`, `fecha_inicio`, `qr`,  `fechainfo`, `condicion`, `horas`, `contexto`, `nota`, `año`,imagen,imagenposterior,idplantilla,categoria) 		
		VALUES ('$idmatricula','$idpersonal','$fecha_hora','$cod_matricula','$idparticipante','$idcurso1','$fecha_inicio1','$qr','$fechainfo','1','$horas','$contexto','','2022','$imagen','$imagenposterior','$idplantilla','Docente')";
		return ejecutarConsulta($sql);		
	}

	public function id()
	{
		$sql = "SELECT MAX(idmatricula) AS id FROM matricula_docentes";
		return ejecutarConsulta($sql);		
	}

	public function idmatriculaprimary()
	{
		$sql = "SELECT MAX(idmatricula) +1 AS id FROM matricula_docentes";
		return ejecutarConsulta($sql);		
	}

	public function buscarCategoria($categoria,$fecham){
		$sql = "SELECT c.imagen,c.estilo,c.imagenposterior,c.imagenf,c.imagenposteriorf,c.subcategoria FROM certificados c 		
		where c.idcategoria=$categoria AND '$fecham'>=c.fecha_inicio AND '$fecham'<=c.fecha_fin";
		
		return ejecutarConsulta($sql);	
	}
	
	//Implementamos buscar nuevo participante
	public function buscarcliente($num_documento)
	{
		$sql="SELECT p.idpersona,p.tipo_persona,p.nombre, td.nombre as tipo_documento, p.num_documento as documento,p.telefono,p.telefono2,p.email,pa.nombre as pais ,p.departamento,p.ciudad,
		p.direccion,p.fecha_cumple, p.condicion, p.idpais, p.idtipo_documento
		FROM docente p INNER JOIN pais pa ON pa.idpais = p.idpais
		INNER JOIN tipo_documento td ON td.idtipo_documento = p.idtipo_documento
		WHERE p.num_documento LIKE '$num_documento' AND p.condicion='1'";
		return ejecutarConsulta($sql);
	}
	
	//Implementamos agregar nuevo participante
	public function nuevocliente($tipo_persona,$nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple)
	{
		$sql = "INSERT INTO docente (tipo_persona,nombre,idtipo_documento,num_documento,telefono,telefono2,email,idpais,departamento,ciudad,direccion,fecha_cumple,condicion)
		VALUES ('$tipo_persona','$nombre','$idtipo_documento','$num_documento','$telefono','$telefono2','$email','$idpais','$departamento','$ciudad','$direccion','$fecha_cumple','1')";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function listar($idpersonal)
	{
		$sql="SELECT m.idmatricula,u.nombre as personal,concat(m.fecha_hora,' ',m.hora) as fecha,
		m.cod_matricula, p.nombre as participante, td.nombre as tipo_documento ,p.num_documento,
		p.telefono,c.nombre,categoria.nombre as categoria,c.n_horas,c.fecha_inicio,
		m.monto,m.formato,m.prioridad,tra.nombre as trafico, m.enviodigital,m.estadoenvio
				FROM matricula_docentes m INNER JOIN docente p ON m.idparticipante=p.idpersona 
				INNER JOIN trafico tra ON tra.idtrafico=m.idtrafico
				INNER JOIN tipo_documento td ON td.idtipo_documento = p.idtipo_documento 
				INNER JOIN personal u ON m.idpersonal=u.idpersonal  
				INNER JOIN cursos c ON m.idcurso=c.idcurso
				INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
				WHERE m.idpersonal = '$idpersonal' AND DATE(m.fecha_hora)=curdate()
				ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);		
	}
	

}

?>