<?php
	session_start();
    //cadena conexion
    require_once "../modelos/Curso.php";
    $cursos = new Curso();

    $idperson = $_SESSION['idper'];
    
    $res = $cursos->getCursosPersona($idperson);

	$btnCertificado = '';
	$btnDetalles = '';
	$info = '';
	
	$data = Array();
	while ($courses = $res->fetch_object()) {
		//$btnDetalles = '<a id="btnDetails" codigo="'. $courses->cod_matricula .'" class="btn-details" data-bs-toggle="modal" data-bs-target="#studensModal">Ver curso</a>';
		$btnDetalles = '<a id="btnDetails" codigo="'. $courses->cod_matricula .'" class="btn-details" data-bs-toggle="modal" href="../intranet/aula.php?consultarid='.$courses->idcurso.'">Ver curso</a>';
		
		if ($courses->certificado == "SI") {
			if ($courses->estadosatisfacion == "CONFIRMADO") {
				$btnCertificado = "<a class='btn-table btn-success-cert' target='_blank' href='../cert_digitales/". $courses->idplantilla ."?id=". $courses->cod_matricula ."'>Ver certificado</a>";
			} else {
				$btnCertificado = "<a id='btnEncuesta' onclick='resetButton();' class='btn-table btn-answer-survey' codigo='". $courses->cod_matricula ."' data-bs-toggle='modal' data-bs-target='#encuestaModal'>Ver certificado</a>";
			}
		} else {
			$btnCertificado = "
			<div class='progress btn-progress'>
				<div class='progress-bar progress-bar-striped progress-bar-animated bg-warning btn-in-process' role='progressbar' aria-label='Animated striped example' aria-valuenow='90' aria-valuemin='0' aria-valuemax='100' style='width: 90%'>
					<nav class='text-progress-button'>Certificado<br/>en proceso</nav>
				</div>
			</div>    
			";
		}
		
 		$data[] = array(
			"0" => $courses->nombre,
 			"1" => $btnCertificado,
			"2" => $btnDetalles,
			"3" => $info
 		);
 	}
 	$results = array(
 		"sEcho" => 1, // Información para el datatables
 		"iTotalRecords" => count($data), //enviamos el total registros al datatable
 		"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
 		"aaData" => $data);
 	echo json_encode($results);
?>