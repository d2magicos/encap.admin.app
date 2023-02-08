<?php 
require_once "../modelos/Presencial.php";

$presencial=new Presencial();

$idpresencial=isset($_POST["idpresencial"])? limpiarCadena($_POST["idpresencial"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombres=isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$celular=isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$cumpleaños=isset($_POST["cumpleaños"])? limpiarCadena($_POST["cumpleaños"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$curso=isset($_POST["curso"])? limpiarCadena($_POST["curso"]):"";
$fecha_certificado=isset($_POST["fecha_certificado"])? limpiarCadena($_POST["fecha_certificado"]):"";
$horas=isset($_POST["horas"])? limpiarCadena($_POST["horas"]):"";
$codigo_curso=isset($_POST["codigo_curso"])? limpiarCadena($_POST["codigo_curso"]):"";
$n_operacion=isset($_POST["n_operacion"])? limpiarCadena($_POST["n_operacion"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$forma_pago=isset($_POST["forma_pago"])? limpiarCadena($_POST["forma_pago"]):"";
$asesor=isset($_POST["asesor"])? limpiarCadena($_POST["asesor"]):"";
$observacion=isset($_POST["observacion"])? limpiarCadena($_POST["observacion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':		
		if (empty($idpresencial)){
			$rspta=$presencial->insertar($fecha,$codigo,$asesor,$nombres,$dni,$celular,$correo,$cumpleaños,$ciudad,$departamento,
			$n_operacion,$curso,$fecha_certificado,$horas,$codigo_curso,$monto,$forma_pago,$observacion);
			echo $rspta ? "Matricula registrado" : "Matricula no se pudo registrar";
		}
		else {
			$rspta=$presencial->editar($idpresencial,$fecha,$codigo,$asesor,$nombres,$dni,$celular,$correo,$cumpleaños,$ciudad,$departamento,
			$n_operacion,$curso,$fecha_certificado,$horas,$codigo_curso,$monto,$forma_pago,$observacion);
			echo $rspta ? "Matricula actualizado" : "Matricula no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$presencial->desactivar($idpresencial);
 		echo $rspta ? "Matricula desactivado" : "Matricula no se puede desactivar";
	break;

	case 'activar':
		$rspta=$presencial->activar($idpresencial);
 		echo $rspta ? "Matricula activado" : "Matricula no se puede activar";
	break;

	case 'eliminar':
		$rspta=$presencial->eliminar($idpresencial);
 		echo $rspta ? "Matricula eliminado" : "Matricula no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$presencial->mostrar($idpresencial);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	
	case 'listarc':
		$rspta=$presencial->listarc();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idpresencial,
 				"1"=>$reg->fecha,
				"2"=>$reg->codigo,
 				"3"=>$reg->nombres,
 				"4"=>$reg->dni,
				"5"=>$reg->celular,
				"6"=>$reg->correo,
				"7"=>$reg->cumpleaños,
				"8"=>$reg->ciudad,
				"9"=>$reg->departamento,
				"10"=>$reg->curso,
				"11"=>$reg->fecha_certificado,
				"12"=>$reg->horas,
				"13"=>$reg->codigo_curso,
				"14"=>$reg->n_operacion,
				"15"=>$reg->monto,
				"16"=>$reg->forma_pago,
				"17"=>$reg->asesor,
 				"18"=>$reg->observacion,
				"19"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
 				'<span class="badge bg-red">DESACTIVADO</span>',
 				"20"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpresencial.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idpresencial.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpresencial.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idpresencial.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idpresencial.')"><i class="fa fa-trash"></i></button>'			 
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
