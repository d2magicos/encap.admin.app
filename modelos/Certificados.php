<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Certificado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre, $fechaini, $fechafin, $idcategoria, $idsubtipocurso, $idestilo, $imagen, $imagenposterior, $imagenf, $imagenposteriorf) {
		$sql = "INSERT INTO certificados (`subcategoria`, `fecha_inicio`, `fecha_fin`, `idcategoria`, `idsubtipo`, `estilo`, `imagen`, `imagenposterior`,`imagenf`, `imagenposteriorf`, `condicion`)
				VALUES ('$nombre', '$fechaini', '$fechafin', '$idcategoria', '$idsubtipocurso', '$idestilo', '$imagen', '$imagenposterior', '$imagenf', '$imagenposteriorf', '1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id, $nombre, $fechaini, $fechafin, $idcategoria, $idsubtipocurso, $idestilo, $imagen, $imagenposterior, $imagenf, $imagenposteriorf) {
		$sql = "UPDATE certificados 
				SET subcategoria = '$nombre', fecha_inicio = '$fechaini', fecha_fin = '$fechafin', idcategoria = '$idcategoria', idsubtipo = '$idsubtipocurso', estilo = '$idestilo', imagen = '$imagen', imagenposterior = '$imagenposterior', imagenf = '$imagenf', imagenposteriorf = '$imagenposteriorf' 
				WHERE id = '$id'";
		return ejecutarConsulta($sql);
	}

	public function actualizar($id,$estilo)
	{
		$sql="UPDATE matricula SET idplantilla='$estilo' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($id)
	{
		$sql="UPDATE certificados SET condicion='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	public function id()
	{
		$sql = "SELECT MAX(id) AS id FROM certificados";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para activar registros
	public function activar($id)
	{
		$sql = "UPDATE certificados SET condicion='1' 
		        WHERE id = '$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($id)
	{
		$sql = "DELETE FROM certificados 
		        WHERE id = '$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id) {
		$sql = "SELECT * FROM certificados 
		        WHERE id = '$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarActivos()
	{
	 	$sql = "SELECT a.id, a.subcategoria, a.fecha_inicio, a.fecha_fin, c.nombre as categoria, a.imagen as imagen,
			            a.estilo as estilo  
		        FROM certificados a 
		        INNER JOIN categoria c ON a.idcategoria = c.idcategoria 
		        WHERE a.condicion='1'";
	 	return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function listarc()
	{
		$sql = "SELECT cer.id, cer.subcategoria, cer.fecha_inicio, cer.fecha_fin, cat.nombre as categoria, scat.nombre as subtipo,
					cer.imagen as imagen, cer.imagenposterior as imagenposterior, cer.imagenf as imagenf,
					cer.imagenposteriorf as imagenposteriorf, cer.estilo as estilo 
				FROM certificados cer 
				INNER JOIN categoria cat ON cer.idcategoria = cat.idcategoria
				LEFT JOIN subtipocurso scat ON cer.idsubtipo = scat.idsubtipo";
		return ejecutarConsulta($sql);		
	}
}
