<?php 
require_once "../modelos/Subtipo.php";
require_once "../modelos/Tipo.php";

$tipo=new Subtipo();
$stipo=new Tipo();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";

$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
$nombre=mb_strtoupper($nombre1, 'UTF-8');
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$idtipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id)){
			$url = Lib::slugify($nombre);
			$rspta=$tipo->insertar($nombre,$descripcion,$url,$idtipo);
		}
		else {
			$rspta=$tipo->editar($id,$nombre,$descripcion,$idtipo);
			echo $rspta ? "Registro actualizado" : "El Registro no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipo->desactivar($id);
 		echo $rspta ? "Registro Desactivado" : "El Registro no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$tipo->eliminar($id);
 		echo $rspta ? "Registro eliminado" : "El Registro no se puede eliminar";
	break;

	case 'activar':
		$rspta=$tipo->activar($id);
 		echo $rspta ? "Registro activado" : "El Registro no se puede activar";
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
				"2"=>$reg->nombre_tipo,
 				/*"2"=>$reg->descripcion,*/
 				"3"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"4"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
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

	case "selectTipo":
		$rspta = $stipo->select();

		echo '<option value=>-- SELECCIONE --</option>';

		while ($reg = $rspta->fetch_object())
		{
			echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
		}
	break;
}
?>

