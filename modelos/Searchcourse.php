<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class SearchCourse
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function buscar($nombre)
	{
		$sql="SELECT cursos.idcurso as id,m.idmodulo as idm,cursos.nombre as nombre, categoria.nombre as nombrec FROM cursos INNER JOIN categoria 
        ON categoria.idcategoria= cursos.idcategoria
        INNER JOIN modulos m 
        ON m.idcurso=cursos.idcurso
         WHERE cursos.nombre LIKE '%".$nombre."%' AND cursos.condicion='1'";
		return ejecutarConsulta($sql);
	}
}