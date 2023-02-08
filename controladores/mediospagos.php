<?php 

require_once "../modelos/Mediospagos.php";

$mediopagos=new Mediopagos();

$idmediospagos=isset($_POST["idmediospagos"])? limpiarCadena($_POST["idmediospagos"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
//Convertir Mayusculas
$nombre=mb_strtoupper($nombre1, 'UTF-8');

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idmediospagos)){
			$rspta=$mediopagos->insertar($nombre);
			echo $rspta ? "Medio de Pago registrada" : "Medio de Pago no se pudo registrar";
		}
		else {
			$rspta=$mediopagos->editar($idmediospagos,$nombre);
			echo $rspta ? "Medio de Pago actualizada" : "Medio de Pago no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$mediopagos->desactivar($idmediospagos);
 		echo $rspta ? "Medio de Pago Desactivada" : "Medio de Pago no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$mediopagos->eliminar($idmediospagos);
 		echo $rspta ? "Medio de Pago Eliminar" : "Medio de Pago no se puede elimiar";
 		break;
	break;

	case 'activar':
		$rspta=$mediopagos->activar($idmediospagos);
 		echo $rspta ? "Medio de Pago activada" : "Medio de Pago no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$mediopagos->mostrar($idmediospagos);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$mediopagos->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"2"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmediospagos.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idmediospagos.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmediospagos.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idmediospagos.')"><i class="fa fa-check"></i></button>'.
					 ' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idmediospagos.')"><i class="fa fa-trash"></i></button>'
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