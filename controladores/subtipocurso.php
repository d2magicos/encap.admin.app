<?php
    require_once "../modelos/Subtipocurso.php";

    $subtipocurso = new Subtipocurso();

    //$idsubcategoria = isset($_POST['idsubcategoria']) ? limpiarCadena($_POST['idsubcategoria']) : "";
    
    switch ($_GET["op"]) {
        case 'listar':
            $rspta = $subtipocurso->listar();

            $data = Array();

            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" => $reg->idsubtipo,
                    "1" => $reg->nombre,
                    "2" => $reg->categoria,
                    "3" => ($reg->condicion) ? 
                        '<span class="badge bg-green">ACTIVADO</span>' :
                        '<span class="badge bg-red">DESACTIVADO</span>',
                    "4" => ($reg->condicion) ?
                        '<button class="btn btn-warning btn-xs" onclick="viewInfo('. $reg->idsubtipo .')"><i class="fa fa-pencil"></i></button>'.
                        ' <button class="btn btn-danger btn-xs" onclick="desactivar('. $reg->idsubtipo .')"><i class="fa fa-close"></i></button>' :
                        '<button class="btn btn-warning btn-xs" onclick="viewInfo('. $reg->idsubtipo .')"><i class="fa fa-pencil"></i></button>'.
                        ' <button class="btn btn-primary btn-xs" onclick="activar('. $reg->idsubtipo .')"><i class="fa fa-check"></i></button>'
                        /* ' <button class="btn btn-danger btn-xs" onclick="eliminar('. $reg->idsubcategoria .')"><i class="fa fa-trash"></i></button>' */
                );
            }

            $results = array(
                "sEcho" => 1,                           // Información para el datatables
                "iTotalRecords" => count($data),        // enviamos el total registros al datatable
                "iTotalDisplayRecords" => count($data), // enviamos el total registros a visualizar
                "aaData" => $data
            );

            echo json_encode($results);
        break;

        case 'listarxCategoria':
            $idcategoria = $_GET['idcategoria'];

            $rspta = $subtipocurso->listarxCategoria($idcategoria);

            if ($rspta->num_rows > 0) {
                while ($row = $rspta->fetch_assoc()) {
                    $html .= '<option value="'. $row['idsubtipo'] .'">'. $row['nombre'] .'</option>';
                }
            }

            echo $html;
        break;

        case 'guardaryeditar':
            $idsubcategoria = isset($_POST['idsubcategoria']) ? limpiarCadena($_POST['idsubcategoria']) : "";
            $nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
            $idcategoria = isset($_POST['idcategoria']) ? limpiarCadena($_POST['idcategoria']) : "";

            if (empty($idsubcategoria)) {
                $res = $subtipocurso->insertar($nombre, $idcategoria);
                echo $res ? "Sub categoría registrada" : "No se pudo registrar la sub categoría";
            } else {
                $res = $subtipocurso->editar($idsubcategoria, $nombre, $idcategoria);
                echo $res ? "Sub categoría actualizada" : "No se pudo actualizar la sub categoría";
            }
        break;

        case 'activar':
            $idsubcategoria = isset($_POST['idsubcategoria']) ? limpiarCadena($_POST['idsubcategoria']) : "";

            if (!empty($idsubcategoria)) {
                $res = $subtipocurso->activar($idsubcategoria);
                echo $res ? "Sub categoria activada" : "No se pudo activar la sub categoria";
            } else {
                echo "No se pudo ejecutar la consulta";
            }
        break;

        case 'desactivar':
            $idsubcategoria = isset($_POST['idsubcategoria']) ? limpiarCadena($_POST['idsubcategoria']) : "";

            if (!empty($idsubcategoria)) {
                $res = $subtipocurso->desactivar($idsubcategoria);
                echo $res ? "Sub categoria desactivada" : "No se pudo desactivar la sub categoria";
            } else {
                echo "No se pudo ejecutar la consulta";
            }
        break;

        case 'mostrar':
            //  
            $id = $_GET['idscat'];

            $res = $subtipocurso->mostrarx($id);
            //$res = $id;
            
            echo json_encode($res);
        break;

        case 'test':
            $ress = $subtipocurso->mostrarx();

            echo json_encode($ress);
        break;
    }
?>