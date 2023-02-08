<?php 
require_once "../modelos/Perfil.php";

$empleado=new Empleado();
$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$idpersonal=isset($_POST["idpersonal"])? limpiarCadena($_POST["idpersonal"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);
		
		if (empty($idusuario)){
			$rspta=$empleado->insertar($idpersonal,$login,$clavehash);
			echo $rspta ? "Usuario registrado" : "No se pudieron s del usuario";
		}
		else {
			$rspta=$empleado->editar($idusuario,$idpersonal,$login,$clavehash);
			echo $rspta ? "Usuario actualizado" : "";
		}
	break;

}