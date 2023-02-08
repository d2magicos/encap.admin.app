<?php 
require_once "../modelos/Subasunto.php";

$subasunto=new Subasunto();

$idsubasunto=isset($_POST["idsubasunto"])? limpiarCadena($_POST["idsubasunto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$idasunto=isset($_POST["idasunto"])? limpiarCadena($_POST["idasunto"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':			
		if (empty($idsubasunto)){
			$rspta=$subasunto->insertar($nombre,$idasunto);
			echo $rspta ? "Sub categoria registrado" : "Sub categoria no se pudo registrar";
		}
		else {
			$rspta=$subasunto->editar($idsubasunto,$nombre,$idasunto);
			echo $rspta ? "Sub categoria actualizado" : "Sub categoria no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$subasunto->desactivar($idsubasunto);
 		echo $rspta ? "Sub categoria desactivado" : "Sub categoria no se puede desactivar";
	break;

	case 'activar':
		$rspta=$subasunto->activar($idsubasunto);
 		echo $rspta ? "Sub categoria activado" : "Sub categoria no se puede activar";
	break;

	case 'eliminar':
		$rspta=$subasunto->eliminar($idsubasunto);
 		echo $rspta ? "Sub categoria eliminado" : "Sub categoria no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$subasunto->mostrar($idsubasunto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	
	case 'listarc':
		$rspta=$subasunto->listarc();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idsubasunto,
 				"1"=>$reg->nombre,
 				"2"=>$reg->asunto,
				"3"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"4"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idsubasunto.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idsubasunto.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idsubasunto.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idsubasunto.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idsubasunto.')"><i class="fa fa-trash"></i></button>'			 
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	case "selectAsunto":
		require_once "../modelos/Asunto.php";
		$asunto = new Asunto();
		$rspta = $asunto->select();
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idasunto . '>' . $reg->nombre . '</option>';
				}
	break;

		// Select Subasunto
		case "selectSubasunto":
			require_once "../modelos/Subasunto.php";
			$parametros=$_POST['parametros'];
			$subasunto = new Subasunto();
			$rspta = $subasunto->selectSubasunto($parametros);
			while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsubasunto . '>' . $reg->nombre . '</option>';
				}
		break;

}
?>
