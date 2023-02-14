<?php 
require_once "../modelos/Tipo.php";

$tipo=new Tipo();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";

$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
$nombre=mb_strtoupper($nombre1, 'UTF-8');
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id)){
			$url = Lib::slugify($nombre);
			$rspta=$tipo->insertar($nombre,$descripcion,$url);
			//echo $rspta ? "Tipo registrado" : "Tipo no se pudo registrar";
		}
		else {
			$rspta=$tipo->editar($id,$nombre,$descripcion);
			echo $rspta ? "Tipo actualizado" : "Tipo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipo->desactivar($id);
 		echo $rspta ? "Tipo Desactivado" : "Tipo no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$tipo->eliminar($id);
 		echo $rspta ? "Tipo eliminado" : "Tipo no se puede eliminar";
	break;

	case 'activar':
		$rspta=$tipo->activar($id);
 		echo $rspta ? "Tipo activado" : "Tipo no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$tipo->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$tipo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->id,
				"1"=>$reg->nombre,
 				/*"2"=>$reg->descripcion,*/
 				"2"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"3"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':
					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>'.
 	 				' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>'
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

