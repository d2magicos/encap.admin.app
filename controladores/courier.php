<?php 

require_once "../modelos/Courier.php";

$courier=new Courier();

$idcourier=isset($_POST["idcourier"])? limpiarCadena($_POST["idcourier"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
//Convertir Mayusculas
$nombre=mb_strtoupper($nombre1, 'UTF-8');

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcourier)){
			$rspta=$courier->insertar($nombre);
			echo $rspta ? "Empresa Courier registrada" : "Empresa Courier no se pudo registrar";
		}
		else {
			$rspta=$courier->editar($idcourier,$nombre);
			echo $rspta ? "Empresa Courier actualizada" : "Empresa Courier no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$courier->desactivar($idcourier);
 		echo $rspta ? "Empresa Courier Desactivada" : "Empresa Courier no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$courier->eliminar($idcourier);
 		echo $rspta ? "Empresa Courier Eliminado" : "Empresa Courier no se puede eliminar";
 		break;
	break;

	case 'activar':
		$rspta=$courier->activar($idcourier);
 		echo $rspta ? "Empresa Courier activada" : "Empresa Courier no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$courier->mostrar($idcourier);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$courier->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"2"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcourier.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idcourier.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcourier.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idcourier.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idcourier.')"><i class="fa fa-trash"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>