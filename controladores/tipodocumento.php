<?php 

require_once "../modelos/Tipodocumento.php";

$tipodocumento=new Tipodocumento();

$idtipo_documento=isset($_POST["idtipo_documento"])? limpiarCadena($_POST["idtipo_documento"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
$nombre=mb_strtoupper($nombre1, 'UTF-8');
switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtipo_documento)){
			$rspta=$tipodocumento->insertar($nombre);
			echo $rspta ? "Tipo de Documento registrada" : "Tipo de Documento no se pudo registrar";
		}
		else {
			$rspta=$tipodocumento->editar($idtipo_documento,$nombre);
			echo $rspta ? "Tipo de Documento actualizada" : "Tipo de Documento no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipodocumento->desactivar($idtipo_documento);
 		echo $rspta ? "Tipo de Documento Desactivada" : "Tipo de Documento no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$tipodocumento->activar($idtipo_documento);
 		echo $rspta ? "Tipo de Documento activada" : "Tipo de Documento no se puede activar";
 		break;
	break;

	case 'eliminar':
		$rspta=$tipodocumento->eliminar($idtipo_documento);
 		echo $rspta ? "Tipo de Documento Desactivada" : "Tipo de Documento no se puede desactivar";
 		break;
	break;

	case 'mostrar':
		$rspta=$tipodocumento->mostrar($idtipo_documento);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$tipodocumento->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"2"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idtipo_documento.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idtipo_documento.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idtipo_documento.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idtipo_documento.')"><i class="fa fa-check"></i></button>'.
					 ' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idtipo_documento.')"><i class="fa fa-trash"></i></button>'
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