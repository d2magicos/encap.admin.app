<?php
require_once "../modelos/Anuncios.php";

$anuncio = new Anuncio();

$id_anuncio = isset($_POST["id_anuncio"]) ? limpiarCadena($_POST["id_anuncio"]) : "";
$img_anuncio = isset($_POST["img_anuncio"]) ? limpiarCadena($_POST["img_anuncio"]) : "";
$before_img = isset($_POST["before_img"]) ? limpiarCadena($_POST["before_img"]) : "";
$link_anuncio = isset($_POST["link_anuncio"]) ? limpiarCadena($_POST["link_anuncio"]) : "";
$device_desktop = isset($_POST["device_desktop"]) ? limpiarCadena($_POST["device_desktop"]) : "";
$device_tablet = isset($_POST["device_tablet"]) ? limpiarCadena($_POST["device_tablet"]) : "";
$device_movil = isset($_POST["device_movil"]) ? limpiarCadena($_POST["device_movil"]) : "";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($id_anuncio)) {
			$rspta = $anuncio->insertar($img_anuncio, $before_img, $link_anuncio, $device_desktop, $device_tablet, $device_movil);
			echo json_encode($rspta);
		} else {
			$rspta = $anuncio->editar($id_anuncio, $img_anuncio, $before_img, $link_anuncio, $device_desktop, $device_tablet, $device_movil);
			echo json_encode($rspta);
		}
		break;

	case 'eliminar':
		$rspta = $anuncio->eliminar($id_anuncio);
		echo json_encode($rspta);
		break;

	case 'mostrar':
		$rspta = $anuncio->mostrar($id_anuncio);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		break;

	case 'listar':
		$rspta = $anuncio->listar();
		//Vamos a declarar un array
		$data = array();

		while ($reg = $rspta->fetch_object()) {
			$estado = array(
				1 => "<span class='badge label-success'>Habilitado</span>",
				0 => "<span class='badge label-danger'>Deshabilitado</span>"
			);
			$data[] = array(
				"0" => $reg->id_anuncio,
				"1" => "<img src='$reg->imagen' width='70px' height='70px'>",
				"2" => $reg->link,
				"3" => $estado[$reg->device_desktop],
				"4" => $estado[$reg->device_tablet],
				"5" => $estado[$reg->device_movil],
				"6" => "<button class='btn btn-warning btn-xs' onclick='mostrar($reg->id_anuncio)'><i class='fa fa-pencil'></i></button>" .
					"<button class='btn btn-danger btn-xs' onclick='eliminar($reg->id_anuncio)'><i class='fa fa-trash'></i></button>"

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
}
