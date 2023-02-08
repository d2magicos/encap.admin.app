<?php
    require "../configuraciones/Conexion.php";

    class Survey {
	    public function __construct() { }

        public function actualizar($cod_matricula, $estado, $comentario, $Date) {	
	    	$sql = "UPDATE matricula 
				    SET estadosatisfacion = '$estado', observaciones_satisfacion = '$comentario', fechainfo = '$Date' 
                    WHERE cod_matricula = '$cod_matricula'";
	    	return ejecutarConsulta($sql);
	    }

	     public function obtenerEstado($idmatricula) {	
	     	$sql="SELECT estadosatisfacion FROM matricula where cod_matricula='$idmatricula'";
	     	return ejecutarConsulta($sql);
	     }
    }
?>