<?php
    require_once "../modelos/Curso.php";

    $cursos = new Curso();

    $doc = $_GET['documento'];
    $data = Array();
    //  $doc = '73256893';

    $res = $cursos->getCursosTracking($doc);

    $btnEstadoEnvio = "";
            
    while ($curso = $res->fetch_object()) {
        //  echo '<option value='. $curso->idmatricula .'>'. $curso->nombre .'</option>';
        $btnEstadoEnvio = '<a id="btnSearch" codigo="'.$curso->idmatricula.'" class="btn-estadoEnvio text-center" href="#tracking-container">Ver envío</a>';

        //  $btnEstadoEnvioMobile = '<a id="btnSearch" codigo="'.$curso->idmatricula.'" class="btn-details" data-bs-toggle="modal" data-bs-target="#studensModal">Ver detalles</a>';
        
        $data[] = array(
            //  "1" => $curso->idmatricula,
            "0" => $curso->nombre,
            "1" => $btnEstadoEnvio
        );
    }

    $dataCurso = array(
        "sEcho" => 1, //Información para el datatables
        "iTotalRecords" => count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
        "aaData" => $data);

    echo json_encode($dataCurso);
?>