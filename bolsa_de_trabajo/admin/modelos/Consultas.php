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
	public function totalempleos()
	{
		$sql="SELECT IFNULL(count(idempleo),0) as idempleo FROM empleos";
		return ejecutarConsulta($sql);
	}

//total de usuarios
	public function totalpersonal()
	{
		$sql="SELECT IFNULL(count(idpersonal),0) as idpersonal FROM personal";
		return ejecutarConsulta($sql);
    }

}
?>