<?php 
require_once "../modelos/Procedimiento.php";

$procedimiento=new Procedimiento();

$idforma_recaudacion=isset($_POST["idforma_recaudacion"])? limpiarCadena($_POST["idforma_recaudacion"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
//Convertir Mayusculas
$nombre=mb_strtoupper($nombre1, 'UTF-8');

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idforma_recaudacion)){
			$rspta=$procedimiento->insertar($nombre);
			echo $rspta ? "Registrada" : "Medio de Proceder no se pudo registrar";
		}
		else {
			$rspta=$procedimiento->editar($idforma_recaudacion,$nombre);
			echo $rspta ? "Actualizado" : "Medio de Proceder no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$procedimiento->desactivar($idforma_recaudacion);
 		echo $rspta ? "Desactivado" : "Medio de Proceder no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$procedimiento->activar($idforma_recaudacion);
 		echo $rspta ? "Activado" : "Medio de Proceder no se puede activar";
 		break;
	break;

	case 'eliminar':
		$rspta=$procedimiento->eliminar($idforma_recaudacion);
 		echo $rspta ? "Eliminado" : "Medio de Proceder no se puede eliminar";
 		break;
	break;

	case 'mostrar':
		$rspta=$procedimiento->mostrar($idforma_recaudacion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$procedimiento->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"2"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idforma_recaudacion.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idforma_recaudacion.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idforma_recaudacion.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idforma_recaudacion.')"><i class="fa fa-check"></i></button>'.
					 ' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idforma_recaudacion.')"><i class="fa fa-trash"></i></button>'
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