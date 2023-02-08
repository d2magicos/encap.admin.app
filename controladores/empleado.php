<?php 
require_once "../modelos/Empleado.php";

$empleado=new Empleado();

$idpersonal=isset($_POST["idpersonal"])? limpiarCadena($_POST["idpersonal"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
$nombre=mb_strtoupper($nombre1, 'UTF-8');
//$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$idtipo_documento=isset($_POST["idtipo_documento"])? limpiarCadena($_POST["idtipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$telefono2=isset($_POST["telefono2"])? limpiarCadena($_POST["telefono2"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$idpais=isset($_POST["idpais"])? limpiarCadena($_POST["idpais"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$fecha_cumple=isset($_POST["fecha_cumple"])? limpiarCadena($_POST["fecha_cumple"]):"";
$cargo1=isset($_POST["cargo1"])? limpiarCadena($_POST["cargo1"]):"";
$cargo=strtoupper($cargo1);
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/personal/" . $imagen);
			}
		}
		if (empty($idpersonal)){
			$rspta=$empleado->insertar($fecha_hora,$nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple,$cargo,$imagen);
			echo $rspta ? "Empleado registrado" : "Empleado no se pudo registrar";
		}
		else {
			$rspta=$empleado->editar($idpersonal,$fecha_hora,$nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple,$cargo,$imagen);
			echo $rspta ? "Empleado actualizado" : "Empleado no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$empleado->desactivar($idpersonal);
 		echo $rspta ? "Empleado Desactivado" : "Empleado no se puede desactivar";
	break;

	case 'activar':
		$rspta=$empleado->activar($idpersonal);
 		echo $rspta ? "Empleado activado" : "Empleado no se puede activar";
	break;

	case 'eliminar':
		$rspta=$empleado->eliminar($idpersonal);
 		echo $rspta ? "Empleado eliminado" : "Empleado no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$empleado->mostrar($idpersonal);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$empleado->listar();
 		//Vamos a declarar un array fecha_hora
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
		 			$data[]=array(
		 				"0"=>$reg->fecha_hora,
		 				"1"=>$reg->nombre,
		 				"2"=>$reg->tipo_documento.' - '.$reg->num_documento,
		 				"3"=>$reg->telefono,
		 				"4"=>$reg->telefono2,
		 				"5"=>$reg->email,						 
		 				"6"=>$reg->pais,
		 				"7"=>$reg->departamento,
		 				"8"=>$reg->ciudad,
		 				"9"=>$reg->direccion,
		 				"10"=>$reg->fecha_cumple,
						"11"=>$reg->cargo,
		 				"12"=>"<img src='../files/personal/".$reg->imagen."' height='50px' width='50px' >",
		 				"13"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
		 				'<span class="badge bg-red">DESACTIVADO</span>',
		 				"14"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpersonal.')"><i class="fa fa-pencil"></i></button>'.
		 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idpersonal.')"><i class="fa fa-close"></i></button>':
		 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpersonal.')"><i class="fa fa-pencil"></i></button>'.
		 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idpersonal.')"><i class="fa fa-check"></i></button>'.
							 ' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idpersonal.')"><i class="fa fa-trash"></i></button>'
		 				);
		 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case "selectTipodocumento":
		require_once "../modelos/Tipodocumento.php";
		$tipodocumento = new Tipodocumento();

		$rspta = $tipodocumento->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idtipo_documento . '>' . $reg->nombre . '</option>';
				}
	break;

	case "selectPais":
		require_once "../modelos/Pais.php";
		$pais = new Pais();

		$rspta = $pais->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idpais . '>' . $reg->nombre . '</option>';
				}
	break;


}

