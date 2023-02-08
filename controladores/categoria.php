<?php 
require_once "../modelos/Categoria.php";

$categoria=new Categoria();

$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
//Convertir Mayusculas
$nombre=mb_strtoupper($nombre1, 'UTF-8');
$etiqueta=isset($_POST["etiqueta"])? limpiarCadena($_POST["etiqueta"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$rspta=$categoria->insertar($nombre,$etiqueta);
			echo $rspta ? "Categoría registrada" : "Categoría no se pudo registrar";
		}
		else {
			$rspta=$categoria->editar($idcategoria,$nombre,$etiqueta);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$categoria->desactivar($idcategoria);
 		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$categoria->eliminar($idcategoria);
 		echo $rspta ? "Categoría eliminado" : "Categoría no se puede eliminar";
	break;

	case 'activar':
		$rspta=$categoria->activar($idcategoria);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$categoria->mostrar($idcategoria);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$categoria->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idcategoria,
				"1"=>$reg->nombre,
 				"2"=>$reg->etiqueta,
 				"3"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"4"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':
					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>'.
 	 				' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idcategoria.')"><i class="fa fa-trash"></i></button>'
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

