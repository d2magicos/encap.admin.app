<?php 
require_once "../modelos/Docentes.php";

$docente=new Docente();

$iddocente=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$tipo_docente=isset($_POST["tipo_persona"])? limpiarCadena($_POST["tipo_persona"]):"";
$nombre1=isset($_POST["nombre1"])? limpiarCadena($_POST["nombre1"]):"";
$nombre=mb_strtoupper($nombre1,'UTF-8');//Convertir Mayusculas
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

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($iddocente)){
			$rspta=$docente->insertar($nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple);
			echo $rspta ? "Docente registrado" : "Docente no se pudo registrar".mysqli_error($conexion);
		}
		else {
			$rspta=$docente->editar($iddocente,$nombre,$idtipo_documento,$num_documento,$telefono,$telefono2,$email,$idpais,$departamento,$ciudad,$direccion,$fecha_cumple);
			echo $rspta ? "Docente actualizado" : "Docente no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$docente->desactivar($iddocente);
 		echo $rspta ? "Docente Desactivado" : "Docente no se puede desactivar";
	break;

	case 'activar':
		$rspta=$docente->activar($iddocente);
 		echo $rspta ? "Docente activado" : "Docente no se puede activar";
	break;

	case 'eliminar':
		$rspta=$docente->eliminar($iddocente);
 		echo $rspta ? "Docente eliminado" : "Docente no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$docente->mostrar($iddocente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarp':
		$rspta=$docente->listarp();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idpersona,
				"1"=>$reg->nombre,
 				"2"=>$reg->tipo_documento.' - '.$reg->documento,
 				"3"=>$reg->telefono,
 				"4"=>$reg->telefono2,
				"5"=>$reg->email,
				"6"=>$reg->pais,
				"7"=>$reg->departamento,
				"8"=>$reg->ciudad,
				"9"=>$reg->direccion,
				"10"=>$reg->fecha_cumple,
				"11"=>($reg->condicion)?'<span class="badge bg-green">ACTIVADO</span>':
					'<span class="badge bg-red">DESACTIVADO</span>',
				"12"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpersona.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idpersona.')"><i class="fa fa-close"></i></button>':
					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpersona.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idpersona.')"><i class="fa fa-check"></i></button>'.
 	 				' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idpersona.')"><i class="fa fa-trash"></i></button>'
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
?>