<?php
require_once "../modelos/Curso.php";

$cursos = new Curso();

$idcurso = isset($_POST["idcurso"]) ? limpiarCadena($_POST["idcurso"]) : "";
$idmedit=isset($_POST["idm2"])? limpiarCadena($_POST["idm2"]):"";
$cod_curso = isset($_POST["cod_curso"]) ? limpiarCadena($_POST["cod_curso"]) : "";
$cod_curso2=isset($_POST["idcurso2"])? limpiarCadena($_POST["idcurso2"]):"";
$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$idsubcategoria=isset($_POST["idsubcategoria"])? limpiarCadena($_POST["idsubcategoria"]):"";
$idsubtipo = isset($_POST["idsubtipocurso"]) ? limpiarCadena($_POST["idsubtipocurso"]) : "0";
$nombre1 = isset($_POST["nombre1"]) ? limpiarCadena($_POST["nombre1"]) : "";
$nombre = strtoupper($nombre1);
$nombreModulo=isset($_POST["nombrem1"])? limpiarCadena($_POST["nombrem1"]):"";
$nombreModulo2=isset($_POST["nombrem2"])? limpiarCadena($_POST["nombrem2"]):"";
$n_horas = isset($_POST["n_horas"]) ? limpiarCadena($_POST["n_horas"]) : "";
$fecha_inicio = isset($_POST["fecha_inicio"]) ? limpiarCadena($_POST["fecha_inicio"]) : "";
$docente = isset($_POST["docente"]) ? limpiarCadena($_POST["docente"]) : "";
$temario1 = isset($_POST["temario1"]) ? limpiarCadena($_POST["temario1"]) : "";
$cursoenvivo=isset($_POST["cursoenvivo"])? limpiarCadena($_POST["cursoenvivo"]):"";
$temario = str_replace("\n", "<br>", $temario1);
$descripcion=isset($_POST["descripcionc"])? limpiarCadena($_POST["descripcionc"]):"";
$contexto = isset($_POST["contexto"]) ? limpiarCadena($_POST["contexto"]) : "";
$examen=isset($_POST["examen"])? limpiarCadena($_POST["examen"]):"";
$observaciones = isset($_POST["observaciones"]) ? limpiarCadena($_POST["observaciones"]) : "";
$enlace = isset($_POST["enlace"]) ? limpiarCadena($_POST["enlace"]) : "";
$walink=isset($_POST["walink"])? limpiarCadena($_POST["walink"]):"";
$aula = isset($_POST["aula"]) ? limpiarCadena($_POST["aula"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':

        if ($idcategoria == "1") {
            $etiqueta = "ENCAP1-SG";
        }

        if ($idcategoria == "2") {
            $etiqueta = "ENCAP2-SG";
        }

        if ($idcategoria == "3") {
            $etiqueta = "ENCAP3-SG";
        }

        if ($idcategoria == "4") {
            $etiqueta = "ENCAP4-SG";
        }

        if ($idcategoria == "5") {
            $etiqueta = "ENCAP5-SG";
        }

        if ($idcategoria == "6") {
            $etiqueta = "ENCAP6-SG";
        }

        if ($idcategoria == "7") {
            $etiqueta = "ENCAP7-SG";
        }

        if ($idcategoria == "8") {
            $etiqueta = "ENCAP8-SG";
        }

        if ($idcategoria == "9") {
            $etiqueta = "ENCAP9-SG";
        }

        if ($idcategoria == "10") {
            $etiqueta = "ENCAP10-SG";
        }

        if ($idcategoria == "13") {
            $etiqueta = "ENCAP13-SG";
        }

        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen =$_FILES['imagen']['name'] ;
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../Imagenes_cursos/" . $imagen);
			}
		}


        if ($cod_curso = $cod_curso) {
            $cod_curso = $_POST["cod_curso"];
        } else {
            $id = $_POST["id"];
            $extraeradelante = substr($nombre, 0, 3);
            $extraerultimo = substr($nombre, -3);
            $cod_curso = $etiqueta . "-" . $extraeradelante . $extraerultimo . "-" . (1 + $id);
        }

        if (empty($idcurso)) {
            $rspta = $cursos->insertar($cod_curso, $nombre, $idcategoria, $idsubtipo, $n_horas, $fecha_inicio, $docente, $temario,$descripcion, $imagen,$idsubcategoria,$cursoenvivo,$contexto,$examen, $observaciones, $enlace,$walink, $aula);
            echo $rspta ? "Curso registrado" : "Curso no se pudo registrar";
            echo mysqli_error($conexion);
        } else {
            $rspta = $cursos->editar($idcurso,$cod_curso, $nombre, $idcategoria, $idsubtipo, $n_horas, $fecha_inicio, $docente, $temario,$descripcion, $imagen,$idsubcategoria,$cursoenvivo,$contexto,$examen, $observaciones, $enlace,$walink, $aula);
            echo $rspta ? "Curso actualizado" : "Curso no se pudo actualizar";
        }
        break;

        case 'guardaryeditarModulo':
		
            $rspta=$cursos->insertarModulo($cod_curso2,$nombreModulo);
            echo $rspta ? "Modulo agregado" : "Modulo no se pudo agregar";
            echo mysqli_error($conexion);
        break;

    case 'desactivar':
        $rspta = $cursos->desactivar($idcurso);
        echo $rspta ? "Curso desactivado" : "Curso no se puede desactivar";
        break;

    case 'activar':
        $rspta = $cursos->activar($idcurso);
        echo $rspta ? "Curso activado" : "Curso no se puede activar";
        break;

    case 'eliminar':
        $rspta = $cursos->eliminar($idcurso);
        echo $rspta ? "Curso eliminado" : "Curso no se puede eliminar";
        break;

    case 'mostrar':
        $rspta = $cursos->mostrar($idcurso);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'id':
        $rspta = $cursos->id();
        while ($reg = $rspta->fetch_object()) {
            echo $id = $reg->id;
        }
        break;
        break;

    case 'listarc':
        $rspta = $cursos->listarc();
        //Vamos a declarar un array
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->idcurso,
                "1" => $reg->cod_curso,
                "2" => $reg->nombre,
                "3" => $reg->tipo_curso,
                "4" => $reg->subtipo_curso,
                "5" => $reg->n_horas,
                "6" => $reg->fecha_inicio,
                "7" => $reg->docente,
                "8" => $reg->temario,
                "9" => $reg->contexto,
                "10" => $reg->observaciones,
                "11" => ($reg->condicion) ?
                    '<span class="badge bg-green">ACTIVADO</span>' :
                    '<span class="badge bg-red">DESACTIVADO</span>',
                "12" => ($reg->condicion) ?
                ' <button class="btn btn-success btn-xs" onclick="mostrarModulo(\''.$reg->idcurso.'\')">Contenido del curso</button></br></br>'.
                    '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idcurso . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->idcurso . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idcurso . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary btn-xs" onclick="activar(' . $reg->idcurso . ')"><i class="fa fa-check"></i></button>' .
                    ' <button class="btn btn-danger btn-xs" onclick="eliminar(' . $reg->idcurso . ')"><i class="fa fa-trash"></i></button>',
                "13" => $reg->enlace,
                "14" => $reg->aula,
            );
        }
        $results = array(
            "sEcho" => 1, //Informaci��n para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);

        break;

        case 'guardarm':

            $rspta2=$cursos->editarM($nombreModulo2,$idmedit);
    
            
             echo "Se Edito.";
         
    
        break;
    
        case 'sumarvista':
    
            $rspta2=$cursos->sumarvistas($idcurso);
            echo mysqli_error($conexion);
            echo $idcurso. "Se sumo.";
         
    
        break;
    
    
        case 'eliminarm':
    
            $rspta2=$cursos->eliminarM($idcurso);
    
            
             echo "Se elimino.";
         
    
        break;
    
        case 'listarM60':
    
            
            $query1=$cursos->listarM($idcurso);
            $data = array();
            foreach ($query1 as $row) {
                $data['query1'][$row->k] = $row->value;
            }
                $query2=$cursos->listarL($idcurso);
             //Vamos a declarar un array
             foreach ($query2 as $row){
                $data['query2'][$row->k] = $row->value;
            }
            
             echo json_encode($data);
             break;
    
             case 'listarM':
    
            
                $rspta=$cursos->listarM($idcurso);
        
                 //Vamos a declarar un array
                 $data= Array();
                 while ($reg=$rspta->fetch_object()){
                    $data[]=array(
                        "1"=>$reg->idmodulo,
                        "0"=>$reg->nombre
                        
                    );
                 }
                
                 echo json_encode($data);
                 break;
    
    
                 case 'listarL':
    
            
                    $rspta=$cursos->listarL($idcurso);
            
                     //Vamos a declarar un array
                     $data= Array();
                     while ($reg=$rspta->fetch_object()){
                        $data[]=array(
                            "1"=>$reg->idmodulo,
                            "0"=>$reg->nombrel,
                            "2"=>$reg->idlecciones
                        );
                     }
                    
                     echo json_encode($data);
                     break;
    
         case 'listarM2':
    
    
                $rspta=$cursos->listarM($idcurso);
        
                 //Vamos a declarar un array
                 $data= "";
                 while ($reg=$rspta->fetch_object()){
                    $data.="<option value='".$reg->idmodulo."'>".$reg->nombre."</option>";
                    
                 }
                
                 echo $data;
         
    
        break;

    case "detailsCurso":
        $cod_curso = $_GET['codigoCurso'];
        //$cod_curso = '8829-29567097';

        $res = $cursos->getDetailsCurso($cod_curso);

        $btnCertificado = '';
        $btnMatAula = '';

        while ($reg = $res->fetch_object()) {
            /* CERTIFICADO */
            if ($reg->certificado == "SI") {
                if ($reg->estadosatisfacion == "CONFIRMADO") {
                    $btnCertificado = '<a target="_blank" class="btn-certificado-success" id="btnCertificado"><i class="fa-solid fa-circle-check pdf-icon"></i>Certificado Listo</a>';
                } else {
                    $btnCertificado = '<a target="_blank" class="btn-certificadonull" id="btnCertificadoNull"><i class="fa-solid fa-spinner loading-icon"></i>Certificado en Proceso</a>';
                }
            } else {
                $btnCertificado = '<a target="_blank" class="btn-certificadonull" id="btnCertificadoNull"><i class="fa-solid fa-spinner loading-icon"></i>Certificado en Proceso</a>';
            }

            if ($reg->enlace != '') {
                $btnMatAula = '<a class="btn-aulavirtual" target="_blank" href="' . $reg->enlace . '"><img class="img-aula" src="./img/button-materiales.jpg" alt=""><span class="button-Click">Click Aqu�� <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 14px;"></i></span></a>';
            }

            if ($reg->aula != '') {
                $btnMatAula = '<a class="btn-aulavirtual" target="_blank" href="' . $reg->aula . '"><img class="img-aula" src="./img/button-aula.jpg" alt=""><span class="button-aula-Click">Click Aqu�� <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 14px;"></i></span></a>';
            }

            $data[] = array(
                "0" => $reg->cod_matricula,
                "1" => $reg->nombre,
                "2" => $reg->categoria,
                "3" => $reg->n_horas,
                "4" => $reg->fecha_inicio,
                "5" => $btnCertificado,
                "6" => $btnMatAula,
            );
        }
        $results = array(
            "sEcho" => 1, //Informaci�1�7�1�7n para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "detailsCursoDoc":
        $cod_curso = $_GET['codigoCurso'];

        $res = $cursos->getDetailsCursoDoc($cod_curso);

        $btnCertificado = '';

        while ($reg = $res->fetch_object()) {
            /* CERTIFICADO */
            if ($reg->certificado == "SI") {
                $btnCertificado = '<a target="_blank" class="btn-certificado-success" id="btnCertificado"><i class="fa-solid fa-circle-check pdf-icon"></i>Certificado Listo</a>';
            } else {
                $btnCertificado = '<a target="_blank" class="btn-certificadonull" id="btnCertificadoNull"><i class="fa-solid fa-spinner loading-icon"></i>Certificado en Proceso</a>';
            }

            /* MATERIAL - AULA */

            $data[] = array(
                "0" => $reg->cod_matricula,
                "1" => $reg->nombre,
                "2" => $reg->fecha_inicio,
                "3" => $btnCertificado,
            );
        }

        $results = array(
            "sEcho" => 1, //Informaci�1�7�1�7n para el datatables
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
            echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
        }
        break;

        
	case "selectSubCategoria":
		require_once "../modelos/SubCategoriacurso.php";
		$subcategoria = new SubCategoriacurso();

		$rspta = $subcategoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
				}
	break;
}
