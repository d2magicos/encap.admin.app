<?php
require_once "../modelos/Certificados.php";

$Certificados = new Certificado();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";

$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$idsubtipocurso = isset($_POST["idsubtipocurso"]) ? limpiarCadena($_POST["idsubtipocurso"]) : "";
$idestilo = isset($_POST["idestilo"]) ? limpiarCadena($_POST["idestilo"]) : "";

$nombre1 = isset($_POST["nombre1"]) ? limpiarCadena($_POST["nombre1"]) : "";
$nombre = strtoupper($nombre1);

$fechaini = isset($_POST["fechainicio"]) ? limpiarCadena($_POST["fechainicio"]) : "";
$fechafin = isset($_POST["fechafin"]) ? limpiarCadena($_POST["fechafin"]) : "";

$imagen = isset($_POST["imagenactual"]) ? limpiarCadena($_POST["imagenactual"]) : "";
$imagenposterior = isset($_POST["imagenactual2"]) ? limpiarCadena($_POST["imagenactual2"]) : "";
$imagenf = isset($_POST["imagenactualf"]) ? limpiarCadena($_POST["imagenactualf"]) : "";
$imagenposteriorf = isset($_POST["imagenactual2f"]) ? limpiarCadena($_POST["imagenactual2f"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':

        $idcert = $_POST["idcert"];

        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $imagen = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../cert_digitales/fpdf/img/" . $imagen);
            }
        }

        if (!file_exists($_FILES['imagenposterior']['tmp_name']) || !is_uploaded_file($_FILES['imagenposterior']['tmp_name'])) {
            $imagenposterior = $_POST["imagenactual2"];
        } else {
            $ext = explode(".", $_FILES["imagenposterior"]["name"]);
            if ($_FILES['imagenposterior']['type'] == "image/jpg" || $_FILES['imagenposterior']['type'] == "image/jpeg" || $_FILES['imagenposterior']['type'] == "image/png") {
                //$imagenposterior = round(microtime(true)) . '.' . end($ext);
                $imagenposterior = $_FILES['imagenposterior']['name'];
                move_uploaded_file($_FILES["imagenposterior"]["tmp_name"], "../cert_digitales/fpdf/img/" . $imagenposterior);
            }
        }
        // Curso fisico
        if (!file_exists($_FILES['imagenf']['tmp_name']) || !is_uploaded_file($_FILES['imagenf']['tmp_name'])) {
            $imagenf = $_POST["imagenactualf"];
        } else {
            $ext = explode(".", $_FILES["imagenf"]["name"]);
            if ($_FILES['imagenf']['type'] == "image/jpg" || $_FILES['imagenf']['type'] == "image/jpeg" || $_FILES['imagenf']['type'] == "image/png") {
                $imagenf = $_FILES['imagenf']['name'];
                move_uploaded_file($_FILES["imagenf"]["tmp_name"], "../cert_digitales/fpdf/img/" . $imagenf);
            }
        }

        if (!file_exists($_FILES['imagenposteriorf']['tmp_name']) || !is_uploaded_file($_FILES['imagenposteriorf']['tmp_name'])) {
            $imagenposteriorf = $_POST["imagenactual2f"];
        } else {
            $ext = explode(".", $_FILES["imagenposteriorf"]["name"]);
            if ($_FILES['imagenposteriorf']['type'] == "image/jpg" || $_FILES['imagenposteriorf']['type'] == "image/jpeg" || $_FILES['imagenposteriorf']['type'] == "image/png") {
                //$imagenposterior = round(microtime(true)) . '.' . end($ext);
                $imagenposteriorf = $_FILES['imagenposteriorf']['name'];
                move_uploaded_file($_FILES["imagenposteriorf"]["tmp_name"], "../cert_digitales/fpdf/img/" . $imagenposteriorf);
            }
        }

        if (empty($idcert)) {
            $rspta = $Certificados->insertar($nombre, $fechaini, $fechafin, $idcategoria, $idsubtipocurso, $idestilo, $imagen, $imagenposterior, $imagenf, $imagenposteriorf);
            echo $rspta ? "Certificado registrado" : "Certificado no se pudo registrar";
            echo mysqli_error($conexion);
        } else {
            $rspta = $Certificados->editar($idcert, $nombre, $fechaini, $fechafin, $idcategoria, $idsubtipocurso, $idestilo, $imagen, $imagenposterior, $imagenf, $imagenposteriorf);
            echo $rspta ? "Certificado actualizado" : "Certificado no se pudo actualizar";
        }

        //$rspta=$Certificados->actualizar($oria,$idestilo);

        break;

    case 'desactivar':
        $rspta = $Certificados->desactivar($id);
        echo $rspta ? "Certificado desactivado" : "Certificado no se puede desactivar";
        break;

    case 'activar':
        $rspta = $Certificados->activar($id);
        echo $rspta ? "Certificado activado" : "Certificado no se puede activar";
        break;

    case 'eliminar':
        $rspta = $Certificados->eliminar($id);
        echo $rspta ? "Certificado eliminado" : "Certificado no se puede eliminar";
        break;

    case 'mostrar':
        $rspta = $Certificados->mostrar($id);
        //Codificar el resultado utilizando json

        //echo $rspta;
        echo json_encode($rspta);
        break;

    case 'id':
        $rspta = $Certificados->id();
        while ($reg = $rspta->fetch_object()) {
            echo $id = $reg->id;
        }
        break;
        break;

    case 'listarc':
        $rspta = $Certificados->listarc();
        //Vamos a declarar un array
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->id,
                "1" => $reg->subcategoria,
                "2" => $reg->fecha_inicio,
                "3" => $reg->fecha_fin,
                "4" => $reg->categoria,
                "5" => $reg->subtipo,
                "6" => $reg->estilo,
                "7" => $reg->imagen,
                "8" => $reg->imagenposterior,
                "9" => $reg->imagenf,
                "10" => $reg->imagenposteriorf,
                "11" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger btn-xs" onclick="eliminar(' . $reg->id . ')"><i class="fa fa-trash"></i></button>',
            );
        }
        $results = array(
            "sEcho" => 1, //Informaci¨®n para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);

        break;

    case "selectCategoria":
        require_once "../modelos/Categoria.php";
        $categoria = new Categoria();

        $rspta = $categoria->select();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->idcategoria . ' data-size="' . $reg->idcategoria . '"  >' . $reg->nombre . '</option>';
        }
        break;
}
