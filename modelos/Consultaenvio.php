<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Ciudades
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($ciudad,$provincia,$departamento,$idcourier,$montoa,$adicional,$direccion)
	{
		$sql="INSERT INTO consultaciudades (ciudad,provincia,departamento,idcourier,montoa,adicional,direccion,condicion)
		VALUES ('$ciudad','$provincia','$departamento','$idcourier','$montoa','$direccion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idciudad,$ciudad,$provincia,$departamento,$idcourier,$montoa,$adicional,$direccion)
	{
		$sql="UPDATE consultaciudades SET ciudad='$ciudad',provincia='$provincia',departamento='$departamento',idcourier='$idcourier',montoa='$montoa',adicional='$adicional',direccion='$direccion' WHERE idciudad='$idciudad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idciudad)
	{
		$sql="UPDATE consultaciudades SET condicion='0' WHERE idciudad='$idciudad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idciudad)
	{
		$sql="UPDATE consultaciudades SET condicion='1' WHERE idciudad='$idciudad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idciudad)
	{
		$sql="DELETE FROM consultaciudades WHERE idciudad='$idciudad'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idciudad)
	{
		$sql="SELECT * FROM consultaciudades WHERE idciudad='$idciudad'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarc()
	{
		$sql="SELECT a.idciudad,a.ciudad,a.provincia,a.departamento,a.idcourier,c.nombre as courier, a.montoa,a.adicional,a.direccion,a.condicion 
		FROM consultaciudades a INNER JOIN courier c ON a.idcourier=c.idcourier ";
		return ejecutarConsulta($sql);		
	}
}

?>