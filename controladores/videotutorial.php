<?php 
require_once "../modelos/Videotutorial.php";

$videotutorial=new Videotutorial();

$idvtutorial=isset($_POST["idvtutorial"])? limpiarCadena($_POST["idvtutorial"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

$descripcion1=html_entity_decode( $descripcion);

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idvtutorial)){
			$rspta=$videotutorial->insertar($nombre,$descripcion1);
			echo $rspta ? "Se agregó el video tutorial con éxito!" : "El video tutorial no se pudo registrar!";
		}
		else {
			$rspta=$videotutorial->editar($idvtutorial,$nombre,$descripcion1);
			echo $rspta ? "Se actualizó el video tutorial!" : "El video tutorial no se pudo actualizar!";
		}
	break;

	case 'desactivar':
		$rspta=$videotutorial->desactivar($idvtutorial);
 		echo $rspta ? "Se desactivó el video tutorial!" : "El video tutorial no se pudo desactivar!";
 		break;
	break;

	case 'activar':
		$rspta=$videotutorial->activar($idvtutorial);
 		echo $rspta ? "Se activó el video tutorial!" : "El video tutorial no se pudo activar!";
 		break;
	break;

	case 'eliminar':
		$rspta=$videotutorial->eliminar($idvtutorial);
 		echo $rspta ? "Se eliminó el video tutorial con éxito!" : "El video tutorial no se pudo eliminar!";
 		break;
	break;

	case 'mostrar':
		$rspta=$videotutorial->mostrar($idvtutorial);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$videotutorial->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>$reg->descripcion,
 				"2"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"3"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idvtutorial.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idvtutorial.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idvtutorial.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idvtutorial.')"><i class="fa fa-check"></i></button>'.
					 ' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idvtutorial.')"><i class="fa fa-trash"></i></button>'
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
