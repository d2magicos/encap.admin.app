<?php 
require_once "../modelos/Consultaenvio.php";

$ciudades=new Ciudades();

$idciudad=isset($_POST["idciudad"])? limpiarCadena($_POST["idciudad"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$provincia=isset($_POST["provincia"])? limpiarCadena($_POST["provincia"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$idcourier=isset($_POST["idcourier"])? limpiarCadena($_POST["idcourier"]):"";
$montoa=isset($_POST["montoa"])? limpiarCadena($_POST["montoa"]):"";
$adicional=isset($_POST["adicional"])? limpiarCadena($_POST["adicional"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':	
		if (empty($idciudad)){
			$rspta=$ciudades->insertar($ciudad,$provincia,$departamento,$idcourier,$montoa,$adicional,$direccion);
			echo $rspta ? "Ciudad registrado" : "Ciudad no se pudo registrar";
		}
		else {
			$rspta=$ciudades->editar($idciudad,$ciudad,$provincia,$departamento,$idcourier,$montoa,$adicional,$direccion);
			echo $rspta ? "Ciudad actualizado" : "Ciudad no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ciudades->desactivar($idciudad);
 		echo $rspta ? "Ciudad desactivado" : "Ciudad no se puede desactivar";
	break;

	case 'activar':
		$rspta=$ciudades->activar($idciudad);
 		echo $rspta ? "Ciudad activado" : "Ciudad no se puede activar";
	break;

	case 'eliminar':
		$rspta=$ciudades->eliminar($idciudad);
 		echo $rspta ? "Ciudad eliminado" : "Ciudad no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$ciudades->mostrar($idciudad);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	
	case 'listarc':
		$rspta=$ciudades->listarc();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idciudad,
 				"1"=>$reg->departamento,
				"2"=>$reg->provincia,
 				"3"=>$reg->ciudad,
 				"4"=>$reg->courier,
 				"5"=>'S/.'.$reg->montoa,
 			 	"6"=>'<p style="color:red">'.'S/.'.$reg->adicional.'</p>',	
 				"7"=>$reg->direccion,
				"8"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"9"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idciudad.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idciudad.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idciudad.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idciudad.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idciudad.')"><i class="fa fa-trash"></i></button>'			 
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case "selectCourier":
		require_once "../modelos/Courier.php";
		$courier = new Courier();
		$rspta = $courier->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcourier . '>' . $reg->nombre . '</option>';
				}
	break;

}
?>
