<?php
    require_once "../modelos/Curso.php";
    /* require_once "../modelos/Gestionenvios.php"; */

    $cursos = new Curso();

    switch ($_GET["op"]) {
        case "getCursos":	
            $doc = $_GET['documento'];
            $data = Array();
            //  $doc = '73256893';

            $res = $cursos->getCursosTracking($doc);
            
            while ($curso = $res->fetch_object()) {
                //  echo '<option value='. $curso->idmatricula .'>'. $curso->nombre .'</option>';
                $data[] = array(
                    "0" => $curso->idmatricula,
                    "1" => $curso->nombre,
                );
            }

            $dataCurso = array(
                "sEcho" => 1, //Información para el datatables
                "iTotalRecords" => count($data), //enviamos el total registros al datatable
                "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
                "aaData" => $data);

            echo json_encode($dataCurso, JSON_UNESCAPED_UNICODE);
        break;

        case "getTrackingDetails":
            $matricula = $_GET['codigo'];

            $res = $cursos->getTrackingDetails($matricula);
            $curso = $res->fetch_object();

            $btnCourierTracking = "";
            $btnTrackingInfo = "";

            if (!empty($curso->courier)) {
                //  $curso = $res->fetch_object();

                if ($curso->tracking_link != "" && $curso->tracking_link != null) {
                    $btnCourierTracking = '<a href="'. $curso->tracking_link .'" title="Visitar el tracking" target="_blank"><span class="btnTrackingExt"><i class="fa-solid fa-truck-fast tracking-icon"></i> Visitar tracking</span></a>';
                } else {
                    $btnCourierTracking = "";
                }

                if ($curso->info_seguimiento != "" && $curso->info_seguimiento != null) {
                    $btnTrackingInfo = '<a id="btnTrackingInfo" data-bs-toggle="modal" data-bs-target="#trackingInfoModal" matricula="'. $matricula .'"><span class="btnTrackingExt"><i class="fa-solid fa-circle-info tracking-icon"></i> Info</span></a>';
                } else {
                    $btnTrackingInfo = "";
                }
                
                $data = array(
                    "0" => $curso->curso,
                    "1" => $curso->lugar_confirmacion,
                    "2" => $curso->courier,
                    "3" => $curso->fechaenvio,
                    "4" => $curso->cliente_contactado,
                    "5" => $curso->observacion_cliente,
                    "6" => $curso->clave,
                    "7" => $curso->categoria,
                    "8" => $btnCourierTracking,
                    "9" => $btnTrackingInfo,
                    "10" => $curso->direccion_envio
                );
            } else {
                $res = $cursos->getTrackingDetails2($matricula);

                $curso = $res->fetch_object();

                $data = array(
                    "0" => $curso->curso,
                    "1" => $curso->lugar_confirmacion,
                    "2" => "",
                    "3" => $curso->fecha_envio,
                    "4" => $curso->cliente_contactado,
                    "5" => "",
                    "6" => "",
                    "7" => $curso->categoria,
                    "8" => "",
                    "9" => "",
                    "10" => ""
                );
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

        case "getTrackingInfo":
            $matricula = $_GET['matricula'];

            $res = $cursos->getTrackingDetails($matricula);
            $curso = $res->fetch_object();

            $data = array("0" => $curso->info_seguimiento);

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
    }

?>