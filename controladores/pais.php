<?php 

require_once "../modelos/Pais.php";

$pais=new Pais();

$idpais=isset($_POST["idpais"])? limpiarCadena($_POST["idpais"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
//Convertir Mayusculas
$nombre=mb_strtoupper($nombre1, 'UTF-8');

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idpais)){
			$rspta=$pais->insertar($nombre);
			echo $rspta ? "País registrado" : "País no se pudo registrar";
		}
		else {
			$rspta=$pais->editar($idpais,$nombre);
			echo $rspta ? "País actualizado" : "País no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$pais->desactivar($idpais);
 		echo $rspta ? "País Desactivado" : "País no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$pais->activar($idpais);
 		echo $rspta ? "País Activado" : "País no se puede activar";
 		break;
	break;

	case 'eliminar':
		$rspta=$pais->eliminar($idpais);
 		echo $rspta ? "País Eliminado" : "País no se puede eliminar";
 		break;
	break;

	case 'mostrar':
		$rspta=$pais->mostrar($idpais);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$pais->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"2"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpais.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idpais.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpais.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idpais.')"><i class="fa fa-check"></i></button>'.
					 ' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idpais.')"><i class="fa fa-trash"></i></button>'
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