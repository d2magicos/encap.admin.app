<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Curso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

    //    Implementamos un método para insertar registros
	public function insertar($cod_curso, $nombre, $idcategoria, $idsubtipo, $n_horas, $fecha_inicio, $docente, $temario, $contexto, $observaciones, $enlace, $aula)
    {
        $sql = "INSERT INTO cursos (cod_curso, nombre, idcategoria, idsubtipo, n_horas, fecha_inicio, docente, temario, contexto, observaciones, enlace, aula, condicion)
				VALUES ('$cod_curso', '$nombre', '$idcategoria', '$idsubtipo', '$n_horas', '$fecha_inicio', '$docente', '$temario', '$contexto', '$observaciones', '$enlace', '$aula', '1')";
        return ejecutarConsulta($sql);
    }

    //    Implementamos un método para editar registros
    public function editar($idcurso, $cod_curso, $nombre, $idcategoria, $idsubtipo, $n_horas, $fecha_inicio, $docente, $temario, $contexto, $observaciones, $enlace, $aula)
    {
        $sql = "UPDATE cursos SET cod_curso = '$cod_curso', nombre = '$nombre', idcategoria = '$idcategoria', idsubtipo = '$idsubtipo', n_horas = '$n_horas', fecha_inicio = '$fecha_inicio', docente = '$docente', temario = '$temario', contexto = '$contexto', observaciones = '$observaciones', enlace = '$enlace', aula = '$aula'
				WHERE idcurso = '$idcurso'";
        return ejecutarConsulta($sql);
    }

	//Implementamos un método para desactivar registros
	public function desactivar($idcurso)
	{
		$sql="UPDATE cursos SET condicion='0' WHERE idcurso='$idcurso'";
		return ejecutarConsulta($sql);
	}

	public function id()
	{
		$sql = "SELECT MAX(idcurso) AS id FROM cursos";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para activar registros
	public function activar($idcurso)
	{
		$sql="UPDATE cursos SET condicion='1' WHERE idcurso='$idcurso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idcurso)
	{
		$sql="DELETE FROM cursos WHERE idcurso='$idcurso'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcurso)
	{
		$sql="SELECT * FROM cursos WHERE idcurso='$idcurso'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarActivos()
	{
	 	$sql = "SELECT a.idcurso, a.cod_curso, a.nombre, a.idcategoria, c.nombre as tipo_curso, stip.nombre as sub_tipo, a.n_horas, a.fecha_inicio, a.docente, a.temario, a.contexto, a.observaciones, a.condicion
		        FROM cursos a 
                INNER JOIN categoria c ON a.idcategoria = c.idcategoria 
                LEFT JOIN subtipocurso stip ON a.idsubtipo = stip.idsubtipo
                WHERE a.condicion='1'";
	 	return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function listarc()
    {
        $sql = "SELECT a.idcurso, a.cod_curso, a.nombre, a.idcategoria, c.nombre as tipo_curso, stip.nombre as subtipo_curso, a.n_horas, a.fecha_inicio, a.docente, a.temario, a.contexto, a.observaciones, a.condicion, a.enlace, a.aula
				FROM cursos a
				INNER JOIN categoria c ON a.idcategoria = c.idcategoria
				LEFT JOIN subtipocurso stip ON a.idsubtipo = stip.idsubtipo";
        return ejecutarConsulta($sql);
    }
	
	/* PARA PARTICIPANTES */
	public function getCursosPersona($personid) {
		$sql = "SELECT cursos.nombre, ca.nombre as categoria, cursos.n_horas, m.fecha_inicio, m.cod_matricula,
						persona.nombre as participante, persona.num_documento, m.estadoventa, m.idplantilla, m.cod_matricula, m.certificado as certificado, enlace, aula,
						m.estadosatisfacion, m.idplantilla
				FROM cursos 
				INNER JOIN matricula m ON cursos.idcurso = m.idcurso 
				INNER JOIN categoria ca ON ca.idcategoria = cursos.idcategoria
				INNER JOIN persona ON m.idparticipante = persona.idpersona 
				WHERE m.estadoventa = 'ACTIVADO' and (m.cod_matricula = '$personid' or persona.num_documento= '$personid')  
				ORDER BY m.idmatricula DESC";

		return ejecutarConsulta($sql);
	}
	
	public function getDetailsCurso($matricula) {
		$sql = "SELECT m.cod_matricula, c.nombre, cat.nombre AS categoria, c.n_horas, m.fecha_inicio, c.enlace, c.aula, m.certificado,
					   m.estadosatisfacion, m.idplantilla
				FROM cursos c
				INNER JOIN categoria cat ON c.idcategoria = cat.idcategoria
				INNER JOIN matricula m ON c.idcurso = m.idcurso
				WHERE m.cod_matricula = '$matricula'";

		return ejecutarConsulta($sql);
	}
	
	/* PARA DOCENTES */
	public function getCursosDocente($personid) {
		$sql = "SELECT cursos.nombre as curso, ca.nombre as categoria, cursos.n_horas, m.fecha_inicio, m.cod_matricula,
			   		d.nombre as participante, d.num_documento, m.idplantilla, m.cod_matricula, m.certificado as certificado, enlace, aula
			    FROM cursos 
			    INNER JOIN matricula_docentes m ON cursos.idcurso = m.idcurso 
			    INNER JOIN categoria ca ON ca.idcategoria = cursos.idcategoria
			    INNER JOIN docente d ON m.idparticipante = d.idpersona 
			    WHERE d.num_documento = '$personid' 
			    ORDER BY m.idmatricula DESC";

		return ejecutarConsulta($sql);
	}
	
	public function getDetailsCursoDoc($matricula) {
		$sql = "SELECT mdoc.cod_matricula, c.nombre, cat.nombre AS categoria, c.n_horas, c.fecha_inicio, c.enlace, c.aula, mdoc.certificado, mdoc.idplantilla
				FROM cursos c
				INNER JOIN categoria cat ON c.idcategoria = cat.idcategoria
				INNER JOIN matricula_docentes mdoc ON c.idcurso = mdoc.idcurso
				WHERE mdoc.cod_matricula = '$matricula'";

		return ejecutarConsulta($sql);
	}
	
	/* Tracking */
	public function getCursosTracking($doc) {
		//	$doc = '42528005';	//	remplazar a dinámico

		$sql = "SELECT p.num_documento, m.idmatricula, c.nombre 
				FROM cursos c 
				INNER JOIN matricula m ON c.idcurso = m.idcurso
				INNER JOIN persona p ON m.idparticipante = p.idpersona
				WHERE p.num_documento = '$doc' AND m.formato = 'FISICO'";

		return ejecutarConsulta($sql);
	}
	
    public function getTrackingDetails($idmatricula) {
		$sql = "SELECT c.nombre as curso, m.lugar_confirmacion, co.nombre as courier, m.cliente_contactado, ge.fechaenvio, ge.observacion_cliente, ge.clave, cat.nombre as categoria, co.tracking_link, ge.info_seguimiento, ge.direccion_envio
				FROM matricula m
				INNER JOIN cursos c ON m.idcurso = c.idcurso
				INNER JOIN categoria cat ON c.idcategoria = cat.idcategoria
				INNER JOIN gestionenvios ge ON m.idmatricula = ge.idmatricula
				INNER JOIN courier co ON ge.idcourier = co.idcourier
				WHERE m.idmatricula = $idmatricula";

		return ejecutarConsulta($sql);
	}

	public function getTrackingDetails2($idmatricula) {
		$sql = "SELECT c.nombre as curso, m.lugar_confirmacion, m.cliente_contactado, m.fecha_envio, cat.nombre as categoria
				FROM matricula m
				INNER JOIN cursos c ON m.idcurso = c.idcurso
				INNER JOIN categoria cat ON c.idcategoria = cat.idcategoria
				WHERE m.idmatricula = $idmatricula";

		return ejecutarConsulta($sql);
	}
}

?>