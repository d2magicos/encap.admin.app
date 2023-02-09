<?php
require_once "../modelos/Empleo.php";

$empleo = new Empleo();

$idempleo = isset($_POST["idempleo"]) ? limpiarCadena($_POST["idempleo"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$empresa = isset($_POST["empresa"]) ? limpiarCadena($_POST["empresa"]) : "";
$ubi_depa = isset($_POST["ubi_depa"]) ? limpiarCadena($_POST["ubi_depa"]) : "";
$ubi_provi = isset($_POST["ubi_provi"]) ? limpiarCadena($_POST["ubi_provi"]) : "";
$nvacantes = isset($_POST["nvacantes"]) ? limpiarCadena($_POST["nvacantes"]) : "";
$renumeracion = isset($_POST["renumeracion"]) ? limpiarCadena($_POST["renumeracion"]) : "";
$fechainicio = isset($_POST["fechainicio"]) ? limpiarCadena($_POST["fechainicio"]) : "";
$fechafin = isset($_POST["fechafin"]) ? limpiarCadena($_POST["fechafin"]) : "";
$experiencia = isset($_POST["experiencia"]) ? limpiarCadena($_POST["experiencia"]) : "";
$formacion = isset($_POST["formacion"]) ? limpiarCadena($_POST["formacion"]) : "";
$especializacion = isset($_POST["especializacion"]) ? limpiarCadena($_POST["especializacion"]) : "";
$conocimiento = isset($_POST["conocimiento"]) ? limpiarCadena($_POST["conocimiento"]) : "";
$competencia = isset($_POST["competencia"]) ? limpiarCadena($_POST["competencia"]) : "";
$detalle = isset($_POST["detalle"]) ? limpiarCadena($_POST["detalle"]) : "";
$destacado = isset($_POST["destacado"]) ? limpiarCadena($_POST["destacado"]) : "";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($idempleo)) {
			$rspta = $empleo->insertar($nombre, $empresa, $ubi_depa, $ubi_provi, $nvacantes, $renumeracion, $fechainicio, $fechafin, $experiencia, $formacion, $especializacion, $conocimiento, $competencia, $detalle, $destacado);
			echo $rspta ? "Empleo registrado" : "Empleo no se pudo registrar";
		} else {
			$rspta = $empleo->editar($idempleo, $nombre, $empresa, $ubi_depa, $ubi_provi, $nvacantes, $renumeracion, $fechainicio, $fechafin, $experiencia, $formacion, $especializacion, $conocimiento, $competencia, $detalle, $destacado);
			echo $rspta ? "Empleo actualizado" : "Empleo no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$rspta = $empleo->desactivar($idempleo);
		echo $rspta ? "Empleo Desactivado" : "Empleo no se puede desactivar";
		break;

	case 'activar':
		$rspta = $empleo->activar($idempleo);
		echo $rspta ? "Empleo activado" : "Empleo no se puede activar";
		break;

	case 'eliminar':
		$rspta = $empleo->eliminar($idempleo);
		echo $rspta ? "Empleo eliminado" : "Empleo no se puede eliminar ";
		break;

	case 'mostrar':
		$rspta = $empleo->mostrar($idempleo);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		break;

	case 'listar':
		$rspta = $empleo->listar();
		//Vamos a declarar un array
		$data = array();

		while ($reg = $rspta->fetch_object()) {
			$data[] = array(
				"0" => $reg->idempleo,
				"1" => $reg->nombre,
				"2" => $reg->empresa,
				"3" => $reg->ubi_depa,
				"4" => $reg->ubi_provi,
				"5" => $reg->nvacantes,
				"6" => $reg->renumeracion,
				"7" => $reg->fechainicio,
				"8" => $reg->fechafin,
				"9" => $reg->experiencia . ' ' . $reg->formacion,
				"10" => ($reg->condicion) ? '<span class="badge bg-green">ACTIVADO</span>' :
					'<span class="badge bg-red">DESACTIVADO</span>',
				"11" => ($reg->condicion) ? '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idempleo . ')"><i class="fa fa-pencil"></i></button>' .
					' <button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->idempleo . ')"><i class="fa fa-close"></i></button>' :
					'<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idempleo . ')"><i class="fa fa-pencil"></i></button>' .
					' <button class="btn btn-primary btn-xs" onclick="activar(' . $reg->idempleo . ')"><i class="fa fa-check"></i></button>' .
					' <button class="btn btn-danger btn-xs" onclick="eliminar(' . $reg->idempleo . ')"><i class="fa fa-trash"></i></button>'
			);
		}
		$results = array(
			"sEcho" => 1, //Información para el datatables
			"iTotalRecords" => count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
			"aaData" => $data
		);
		echo json_encode($results);

		break;

	case "get_alldepa":
		$rspta = $empleo->get_alldepa();
		$data = array();
		while ($reg = $rspta->fetch_object()) {
			array_push($data, array("depa" => $reg->depa));
		}
		echo json_encode($data);
		break;

	case "get_allprovi":
		$rspta = $empleo->get_allprovi($_POST["depa"]);
		$data = array();
		while ($reg = $rspta->fetch_object()) {
			array_push($data, array("provi" => $reg->provi));
		}
		echo json_encode($data);
		break;
}
