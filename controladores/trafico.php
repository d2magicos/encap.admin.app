<?php 

require_once "../modelos/Trafico.php";

$trafico=new Trafico();

$idtrafico=isset($_POST["idtrafico"])? limpiarCadena($_POST["idtrafico"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
//Convertir Mayusculas
$nombre=mb_strtoupper($nombre1, 'UTF-8');

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtrafico)){
			$rspta=$trafico->insertar($nombre);
			echo $rspta ? "Medio de Trafico registrada" : "Medio de Trafico no se pudo registrar";
		}
		else {
			$rspta=$trafico->editar($idtrafico,$nombre);
			echo $rspta ? "Medio de Trafico actualizada" : "Medio de Trafico no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$trafico->desactivar($idtrafico);
 		echo $rspta ? "Medio de Trafico Desactivada" : "Medio de Trafico no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$trafico->activar($idtrafico);
 		echo $rspta ? "Medio de Trafico activada" : "Medio de Trafico no se puede activar";
 		break;
	break;

	case 'eliminar':
		$rspta=$trafico->eliminar($idtrafico);
 		echo $rspta ? "Medio de Trafico Desactivada" : "Medio de Trafico no se puede desactivar";
 		break;
	break;

	case 'mostrar':
		$rspta=$trafico->mostrar($idtrafico);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$trafico->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"2"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idtrafico.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idtrafico.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idtrafico.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idtrafico.')"><i class="fa fa-check"></i></button>'.
					 ' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idtrafico.')"><i class="fa fa-trash"></i></button>'
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