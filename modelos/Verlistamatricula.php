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

		//Implementar un método para listar los registros
	public function listar($idpersonal)
	{
		$sql="SELECT m.idmatricula,u.nombre as personal, concat(m.fecha_hora,' ',m.hora) as fecha,
		m.cod_matricula, p.nombre as participante, td.nombre as tipo_documento ,p.num_documento,p.email,
		p.telefono,c.nombre,categoria.nombre as categoria,c.n_horas,c.fecha_inicio,m.accesoaula,me.nombre as mediospagos,
		m.monto,m.formato,m.prioridad,tra.nombre as trafico, m.enviodigital,m.estadoenvio,m.observaciones,m.observaciones_envio
				FROM matricula m INNER JOIN persona p ON m.idparticipante=p.idpersona 
				INNER JOIN trafico tra ON tra.idtrafico=m.idtrafico
				INNER JOIN tipo_documento td ON td.idtipo_documento = p.idtipo_documento 
				INNER JOIN personal u ON m.idpersonal=u.idpersonal  
				INNER JOIN cursos c ON m.idcurso=c.idcurso
				INNER JOIN mediospagos me ON me.idmediospagos=m.idmediospagos
				INNER JOIN categoria categoria ON c.idcategoria=categoria.idcategoria
				WHERE m.idpersonal = '$idpersonal' AND m.estadoventa ='ACTIVADO'
				ORDER BY m.idmatricula DESC";
		return ejecutarConsulta($sql);		
	}

}


?>