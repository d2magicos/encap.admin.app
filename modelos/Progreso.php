<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../configuraciones/Conexion.php";

Class Progreso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function actualizarprogreso($idmatricula,$idlecciones,$idcurso)
	{
        $consulta="SELECT idmatricula FROM progreso WHERE idmatricula=$idmatricula AND idcurso=$idcurso AND idlecciones=$idlecciones";
        $result=ejecutarConsulta($consulta);
        $num_rows = mysqli_num_rows($result);
        if($num_rows<=0){
            $sql="INSERT INTO progreso (idmatricula,idlecciones,idcurso) VALUES ($idmatricula,$idlecciones,$idcurso)";
            return ejecutarConsulta($sql);
        }else{
            return ejecutarConsulta($consulta);
        }
		
	}

    public function comentar($idpersona,$idcurso,$idleccionb,$comentario,$idfamilia)
	{
        $sql="INSERT INTO comentarios (idpersona,idcurso,idlecciones,idfamilia,fecha,comentario)  VALUES($idpersona,$idcurso,$idleccionb,$idfamilia,now(),'$comentario')";
        return ejecutarConsulta($sql);
		
	}

    public function listarcomentarios($idcursob,$idleccionb)
	{
        $sql="SELECT *,p.nombre FROM comentarios c 
        INNER JOIN persona p ON p.idpersona=c.idpersona
        WHERE idcurso=$idcursob AND idlecciones=$idleccionb";
        return ejecutarConsulta($sql);
		
	}

    public function listarSubcomentarios($idcomentario)
	{
        $sql="SELECT * FROM comentarios WHERE idfamilia=$idcomentario";
        return ejecutarConsulta($sql);
		
	}

}