<?php
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

class Leccion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertarLeccion($titulo, $idmodulo, $html, $video, $duracion, $material, $examen)
	{
		$sql = "INSERT INTO lecciones (nombre,idmodulo,codigohtml,link_video,duracion,link_material,link_examen)
		VALUES ('$titulo','$idmodulo','$html','$video','$duracion','$material','$examen')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para insertar Modulo
	public function insertarModulo($cod_curso, $nombre)
	{
		$sql = "INSERT INTO lecciones (idcurso,nombre)
			VALUES ('$cod_curso','$nombre')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcurso, $cod_curso, $nombre, $idcategoria, $n_horas, $fecha_inicio, $docente, $temario, $contexto, $observaciones, $enlace, $aula)
	{
		$sql = "UPDATE cursos SET cod_curso='$cod_curso',nombre='$nombre',idcategoria='$idcategoria',n_horas='$n_horas',fecha_inicio='$fecha_inicio', docente='$docente',temario='$temario',contexto='$contexto',observaciones='$observaciones',enlace='$enlace',aula='$aula' WHERE idcurso='$idcurso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idcurso)
	{
		$sql = "UPDATE cursos SET condicion='0' WHERE idcurso='$idcurso'";
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
		$sql = "UPDATE cursos SET condicion='1' WHERE idcurso='$idcurso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idleccion)
	{
		$sql = "DELETE FROM lecciones WHERE idlecciones='$idleccion'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idleccion)
	{
		$sql = "SELECT *,lecciones.nombre as leccion,m.nombre as modulo , c.nombre as curso FROM lecciones 
		INNER JOIN modulos m
		ON m.idmodulo = lecciones.idmodulo
		INNER JOIN cursos c 
		ON c.idcurso = m.idcurso
		WHERE idlecciones='$idleccion'";
		return ejecutarConsultaSimpleFila($sql);
	}




	public function listarActivos()
	{
		$sql = "SELECT a.idcurso,a.cod_curso,a.nombre,a.idcategoria,c.nombre as tipo_curso, a.n_horas,a.fecha_inicio,a.docente,a.temario,a.contexto,a.observaciones,a.condicion 
		 FROM cursos a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT a.idlecciones,a.nombre,a.idmodulo,c.nombre as nombrec,a.codigohtml,b.nombre as curso,d.nombre as categoria, a.link_video,a.link_material,a.link_examen,
		a.duracion 
		FROM lecciones a 
        INNER JOIN modulos c ON a.idmodulo=c.idmodulo
         INNER JOIN cursos b ON b.idcurso=c.idcurso
		 INNER JOIN categoria d ON d.idcategoria=b.idcategoria";
		return ejecutarConsulta($sql);
	}

	public function listarM($idc)
	{
		$sql = "SELECT nombre,idmodulo  
		FROM modulos WHERE idcurso='$idc' ORDER BY idmodulo ASC";
		return ejecutarConsulta($sql);
	}

	public function eliminarM($idcurso)
	{
		$sql = "DELETE  
		FROM lecciones WHERE idmodulo='$idcurso'";
		return ejecutarConsulta($sql);
	}

	public function editarLeccion($idleccion, $titulo, $idmodulo, $html, $video, $duracion, $material, $examen)
	{
		$sql = "UPDATE  lecciones
		SET nombre='$titulo',idmodulo='$idmodulo',codigohtml='$html',link_video='$video',duracion='$duracion',link_material='$material',link_examen='$examen'
		 WHERE idlecciones='$idleccion'";
		return ejecutarConsulta($sql);
	}
	/* PARA PARTICIPANTES */
	public function getCursosPersona($personid)
	{
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

	public function getDetailsCurso($matricula)
	{
		$sql = "SELECT m.cod_matricula, c.nombre, cat.nombre AS categoria, c.n_horas, m.fecha_inicio, c.enlace, c.aula, m.certificado,
					   m.estadosatisfacion, m.idplantilla
				FROM cursos c
				INNER JOIN categoria cat ON c.idcategoria = cat.idcategoria
				INNER JOIN matricula m ON c.idcurso = m.idcurso
				WHERE m.cod_matricula = '$matricula'";

		return ejecutarConsulta($sql);
	}

	/* PARA DOCENTES */
	public function getCursosDocente($personid)
	{
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

	public function getDetailsCursoDoc($matricula)
	{
		$sql = "SELECT mdoc.cod_matricula, c.nombre, cat.nombre AS categoria, c.n_horas, c.fecha_inicio, c.enlace, c.aula, mdoc.certificado, mdoc.idplantilla
				FROM cursos c
				INNER JOIN categoria cat ON c.idcategoria = cat.idcategoria
				INNER JOIN matricula_docentes mdoc ON c.idcurso = mdoc.idcurso
				WHERE mdoc.cod_matricula = '$matricula'";

		return ejecutarConsulta($sql);
	}
}

?>