<?php 

require_once "../modelos/Asunto.php";

$asunto=new Asunto();

$idasunto=isset($_POST["idasunto"])? limpiarCadena($_POST["idasunto"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";
$nombre=strtoupper($nombre1);//Convertir Mayusculas

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idasunto)){
			$rspta=$asunto->insertar($nombre,$observaciones);
			echo $rspta ? "Asunto registrada" : "Asunto no se pudo registrar";
		}
		else {
			$rspta=$asunto->editar($idasunto,$nombre,$observaciones);
			echo $rspta ? "Asunto actualizada" : "Asunto no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$asunto->desactivar($idasunto);
 		echo $rspta ? "Asunto Desactivada" : "Asunto no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$asunto->eliminar($idasunto);
 		echo $rspta ? "Asunto Eliminar" : "Asunto no se puede eliminar";
 		break;
	break;

	case 'activar':
		$rspta=$asunto->activar($idasunto);
 		echo $rspta ? "Asunto activada" : "Asunto no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$asunto->mostrar($idasunto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$asunto->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>$reg->observaciones,
 				"2"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"3"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idasunto.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idasunto.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idasunto.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idasunto.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idasunto.')"><i class="fa fa-trash"></i></button>'
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