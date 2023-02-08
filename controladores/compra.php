<?php
ob_start();
if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
    header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.
} else {
//Validamos el acceso solo al usuario logueado y autorizado.
    if ($_SESSION['matricula'] == 1) {
        require_once "../modelos/Compra.php";
        $compra = new Compra();

        $idmatricula = isset($_POST["idmatricula"]) ? limpiarCadena($_POST["idmatricula"]) : "";
        $idparticipante = isset($_POST["idpersona"]) ? limpiarCadena($_POST["idpersona"]) : "";

/* nuevo pruebas */

        if ($_SESSION['idpersonal'] == 21) {
            $idpersonal = isset($_POST['selectPersonal']) ? limpiarCadena($_POST['selectPersonal']) : "";
        } else {
            $idpersonal = $_SESSION["idpersonal"];
        }

//Almacenar lo que tenemos en la variable sesion
//  $idpersonal=$_SESSION["idpersonal"];
        $fecha_hora = isset($_POST["fecha_hora"]) ? limpiarCadena($_POST["fecha_hora"]) : "";
        $hora = isset($_POST["hora"]) ? limpiarCadena($_POST["hora"]) : "";

        $tipo_persona = isset($_POST["tipo_persona"]) ? limpiarCadena($_POST["tipo_persona"]) : "";

        $nombre1 = isset($_POST["nombre1"]) ? limpiarCadena($_POST["nombre1"]) : "";
        $idtipo_documento = isset($_POST["idtipo_documento"]) ? limpiarCadena($_POST["idtipo_documento"]) : "";
        $num_documento = isset($_POST["num_documento"]) ? limpiarCadena($_POST["num_documento"]) : "";
        $telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
        $telefono2 = isset($_POST["telefono2"]) ? limpiarCadena($_POST["telefono2"]) : "";
        $email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
        $pais = isset($_POST["pais"]) ? limpiarCadena($_POST["pais"]) : "";
        $departamento = isset($_POST["departamento"]) ? limpiarCadena($_POST["departamento"]) : "";
        $ciudad1 = isset($_POST["ciudad1"]) ? limpiarCadena($_POST["ciudad1"]) : "";
        $direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
        $fecha_cumple = isset($_POST["fecha_cumple"]) ? limpiarCadena($_POST["fecha_cumple"]) : "";

        $monto = isset($_POST["monto"]) ? limpiarCadena($_POST["monto"]) : "";
        $formato = isset($_POST["formato"]) ? limpiarCadena($_POST["formato"]) : "";
        $idmediospagos = isset($_POST["idmediospagos"]) ? limpiarCadena($_POST["idmediospagos"]) : "";
        $idtrafico = isset($_POST["idtrafico"]) ? limpiarCadena($_POST["idtrafico"]) : "";

        $idforma_recaudacion = isset($_POST["idforma_recaudacion"]) ? limpiarCadena($_POST["idforma_recaudacion"]) : "";
        $noperacion = isset($_POST["noperacion"]) ? limpiarCadena($_POST["noperacion"]) : "";
        $qr = isset($_POST["qr"]) ? limpiarCadena($_POST["qr"]) : "";
        $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
        $idcurso1 = isset($_POST["idcurso1"]) ? limpiarCadena($_POST["idcurso1"]) : "";
        $fecha_inicio1 = isset($_POST["fecha_inicio1"]) ? limpiarCadena($_POST["fecha_inicio1"]) : "";
        $contexto = isset($_POST["contexto"]) ? limpiarCadena($_POST["contexto"]) : "";
        $horas = isset($_POST["horas"]) ? limpiarCadena($_POST["horas"]) : "";
        $compromiso = isset($_POST["compromiso"]) ? limpiarCadena($_POST["compromiso"]) : "";
        $voucher = isset($_POST["voucher"]) ? limpiarCadena($_POST["voucher"]) : "";

        $observaciones = isset($_POST["observaciones"]) ? limpiarCadena($_POST["observaciones"]) : "";
        $observaciones_envio = isset($_POST["observaciones_envio"]) ? limpiarCadena($_POST["observaciones_envio"]) : "";

        $cod_matricula = isset($_POST["cod_matricula"]) ? limpiarCadena($_POST["cod_matricula"]) : "";
        $prioridad = isset($_POST["prioridad"]) ? limpiarCadena($_POST["prioridad"]) : "";

        switch ($_GET["op"]) {
            case 'guardaryeditar':
                // Generar codigo matricula
                if ($cod_matricula = $cod_matricula) {
                    $cod_matricula = $_POST["cod_matricula"];
                } else {
                    $mes = substr($_POST["fecha_hora"], 5, 2);
                    $ano = substr($_POST["fecha_hora"], 2, 2);
                    $num_documento = $_POST["num_documento"];
                    $id = $_POST["id"];
                    //$id =lastInsertId();

                    $codigocurso = $_POST["codigocurso"];
                    //$cod_matricula = (1+($id)).".".$mes.".".$ano."-".$codigocurso."-".$num_documento;
                    $cod_matricula = (1 + ($id)) . "-" . $num_documento;
                }

                //      Generar codigo matricula
                if ($qr = $qr) {
                    $qr = $_POST["qr"];
                } else {
                    $mes = substr($_POST["fecha_hora"], 5, 2);
                    $ano = substr($_POST["fecha_hora"], 2, 2);
                    $num_documento = $_POST["num_documento"];
                    $nombrecurso = $_POST["nombrecurso"];
                    $id = $_POST["id"];
                    $nombreparticipante = $_POST["nombreparticipante"];
                    $qr = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https://sistemas.encap.edu.pe/certificados/certificados.php?consultarid=" . $cod_matricula;
                    $qr = html_entity_decode($qr);
                    //$qr ="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=[PARTICIPANTE]:".$nombreparticipante." / [DNI]=".$num_documento. " / [CURSO]=".$nombrecurso." / [ID]=".$cod_matricula." ---www.encap.edu.pe---";
                }

                if ($idcurso1 = $idcurso1) {
                    $idcurso1 = $_POST["idcurso1"];
                } else {
                    $idcurso1 = $idcurso1;
                }

                if ($fecha_inicio1 = $fecha_inicio1) {
                    $fecha_inicio1 = $_POST["fecha_inicio1"];
                } else {
                    $fecha_inicio1 = $fecha_inicio1;
                }

                /*  */
                $query_verify = $compra->verificarSubCategoria($idcurso1);
                $res_verify = $query_verify->fetch_object();

                if ($res_verify->idsubtipo == 0) {
                    //    Verifica tenga plantilla
                    $rspta = $compra->buscarCategoria($idcurso1, $fecha_hora);
                    $result = mysqli_num_rows($rspta);
                } else {
                    $rspta = $compra->buscarCertificadoSubCategoria($idcurso1, $res_verify->idsubtipo, $fecha_hora);
                    $result = mysqli_num_rows($rspta);
                }

                /* $query_verify = $compra->verificarSubCategoria($idcurso1);
                echo $query_verify; */

                /* $rspta = $compra->buscarCategoria($idcurso1, $fecha_hora);
                $result = mysqli_num_rows($rspta); */

                if ($result <= 0) {
                    echo "Debe asignar una plantilla a este curso.";
                } else {
                    $reg = $rspta->fetch_object();

                    $imagen = $reg->imagen;
                    $imagenposterior = $reg->imagenposterior;
                    $imagenf = $reg->imagenf;
                    $imagenposteriorf = $reg->imagenposteriorf;
                    $estilo = $reg->estilo;
                    $categoria = $reg->subcategoria;

                    //     Guardar y  actualizar
                    if (empty($idmatricula)) {
                        $rspta = $compra->insertar($idmatricula, $idpersonal, $fecha_hora, $hora, $cod_matricula, $idparticipante, $idcurso1, $fecha_inicio1, $qr, $monto, $formato, $idforma_recaudacion, $idmediospagos, $noperacion, $prioridad, $observaciones, $idtrafico, $observaciones_envio, $horas, $contexto, $compromiso, $voucher, $imagen, $estilo, $imagenposterior, $categoria, $imagenf, $imagenposteriorf);
                        echo mysqli_error($conexion);
                        echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";
                    } else {
                        $rspta = $compra->insertar($idmatricula, $idpersonal, $fecha_hora, $hora, $cod_matricula, $idparticipante, $idcurso1, $fecha_inicio1, $qr, $monto, $formato, $idforma_recaudacion, $idmediospagos, $noperacion, $prioridad, $observaciones, $idtrafico, $observaciones_envio, $horas, $contexto, $compromiso, $voucher, $imagen, $estilo, $imagenposterior, $categoria, $imagenf, $imagenposteriorf);
                        echo mysqli_error($conexion);
                        echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";
                    }
                }

                break;

            // buscar cliente = matricula
            case 'buscarcliente':
                if ($_POST['action'] == 'searchCliente') {
                    if (!empty($_POST['num_documento'])) {
                        $num_documento = $_POST['num_documento'];

                        $rspta = $compra->buscarcliente($num_documento);
                        $result = mysqli_num_rows($rspta);
                        $data = '';
                        if ($result > 0) {
                            $data = mysqli_fetch_assoc($rspta);
                        } else {
                            $data = 0;
                        }
                        echo json_encode($data, JSON_UNESCAPED_UNICODE);
                    }
                    exit;
                }
                break;

            // registrar cliente = matricula
            case 'nuevocliente':
                if ($_POST['action'] == 'addCliente') {

                    $idpersona = $_POST['idpersona'];
                    $idparticipante = $_POST['idparticipante'];
                    $idtipo_documento = $_POST['idtipo_documento'];
                    $nombre1 = $_POST['nombre1'];
                    $nombre = strtoupper($nombre1);
                    //$tipo_documento = $_POST['tipo_documento'];
                    $num_documento = $_POST['num_documento'];
                    $telefono = $_POST['telefono'];
                    $telefono2 = $_POST['telefono2'];
                    $email = $_POST['email'];
                    $idpais = $_POST['idpais'];
                    $departamento = $_POST['departamento'];
                    $ciudad1 = $_POST['ciudad1'];
                    $ciudad = strtoupper($ciudad1);
                    $direccion = $_POST['direccion'];
                    $fecha_cumple = $_POST['fecha_cumple'];

                    //     $query_insert = mysqli_query($conexion, "INSERT INTO cliente(dni, nombre, telefono, direccion, usuario_id) VALUES ('$dni','$nomnre','$telefono','$direccion','$usuario_id')");
                    $query_insert = $compra->nuevocliente($tipo_persona, $nombre, $idtipo_documento, $num_documento, $telefono, $telefono2, $email, $idpais, $departamento, $ciudad, $direccion, $fecha_cumple);
                    if ($query_insert) {
                        $codCliente = mysqli_insert_id($conexion);
                        $msg = $codCliente;
                    } else {
                        $msg = 'error';
                    }
                    mysqli_close($conexion);
                    echo $msg;
                    exit;
                }
                break;

            case 'id':
                $rspta = $compra->id();
                while ($reg = $rspta->fetch_object()) {
                    echo $id = $reg->id;
                }
                break;
                break;

            case 'idmatriculaprimary':
                $rspta = $compra->idmatriculaprimary();
                while ($reg = $rspta->fetch_object()) {
                    echo $id = $reg->id;
                }
                break;
                break;

            case 'mostrar':
                $rspta = $compra->mostrar($idmatricula);
                //Codificar el resultado utilizando json
                echo json_encode($rspta);
                break;

            case 'listarDetalle':
                //Recibimos el idingreso
                $id = $_GET['id'];

                $rspta = $compra->listarDetalle($id);
                //$total=0;
                echo '
					<thead style="background-color:#A9D0F5">
						<th>Codigo Curso</th>
						<th>Nombre</th>
						<th>Tipo Curso</th>
                        <th>Numero de Horas</th>
						<th>Fecha del Curso</th>
                    </thead>';

                while ($reg = $rspta->fetch_object()) {
                    echo '
					<tr class="filas">
						<td>' . $reg->cod_curso . '</td>
						<td>' . $reg->curso . '</td>
						<td>' . $reg->categoria . '</td>
						<td>' . $reg->n_horas . '</td>
						<td>' . $reg->fecha_curso . '</td>
					</tr>';
                }
                echo '
					<tfoot>
                        <th></th>
						<th></th>
						<th></th>
                        <th></th>
						<th></th>
                    </tfoot>';
                break;

            case 'listar':
                $rspta = $compra->listar($idpersonal);
                //Vamos a declarar un array
                $data = array();
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => $reg->idmatricula,
                        "1" => $reg->fecha,
                        "2" => $reg->cod_matricula,
                        "3" => $reg->tipo_documento . ' - ' . $reg->num_documento,
                        "4" => $reg->participante,
                        "5" => $reg->telefono,
                        "6" => $reg->nombre,
                        "7" => $reg->categoria,
                        "8" => $reg->n_horas,
                        "9" => $reg->fecha_inicio,
                        "10" => $reg->monto,
                        "11" => $reg->formato,
                        "12" => $reg->trafico,
                        "13" => ($reg->prioridad == 'NORMAL') ? '<span class="badge bg-blue">NORMAL</span>' :
                        '<span class="badge bg-red">URGENTE</span>',
                        "14" => ($reg->enviodigital == 'ENTREGADO') ? '<span class="badge bg-green"><i class="fa fa-check-square-o"></i> ENTREGADO</span>' :
                        '<span class="badge bg-yellow"><i class="fa fa-clock-o"></i> PENDIENTE</span>',
                        "15" => ($reg->estadoenvio == 'ENVIO COMPLETADO') ? '<span class="badge bg-green"><i class="fa fa-external-link"></i> ENVIO <br>COMPLETADO</span>' :
                        '<span class="badge bg-salmon"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> POR ENVIAR</span>',
                    );
                }
                $results = array(
                    "sEcho" => 2, //Información para el datatables
                    "iTotalRecords" => count($data), //enviamos el total registros al datatable
                    "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
                    "aaData" => $data);
                echo json_encode($results);
                break;
            //'<a target="_blank" href="../reportes/exCompra.php?id='.$reg->idmatricula.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>'

            case 'listarArticulos':
                require_once "../modelos/Curso.php";
                $producto = new Curso();
                $rspta = $producto->listarActivos();
                $data = array();

                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => $reg->cod_curso,
                        "1" => $reg->nombre,
                        "2" => $reg->tipo_curso,
                        "3" => $reg->sub_tipo,
                        "4" => $reg->n_horas,
                        "5" => $reg->fecha_inicio,
                        "6" => '<button class="btn btn-warning" onclick="agregarDetalle(' . $reg->idcurso . ',\'' . $reg->cod_curso . '\',\'' . $reg->nombre . '\',\'' . $reg->tipo_curso . '\',\'' . $reg->n_horas . '\',\'' . $reg->fecha_inicio . '\',\'' . $reg->contexto . '\')"><span class="fa fa-plus"></span></button>',
                    );
                }
                $results = array(
                    "sEcho" => 1, //info para datatables
                    "iTotalRecords" => count($data), //enviamos el total de registros al datatable
                    "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
                    "aaData" => $data);
                echo json_encode($results);

                break;

            case "selectMediospagos":
                require_once "../modelos/Mediospagos.php";
                $mediopagos = new Mediopagos();

                $rspta = $mediopagos->select();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idmediospagos . '>' . $reg->nombre . '</option>';
                }
                break;

            case "selectRecaudacion":
                require_once "../modelos/Procedimiento.php";
                $procedimiento = new Procedimiento();

                $rspta = $procedimiento->select();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idforma_recaudacion . '>' . $reg->nombre . '</option>';
                }
                break;

            /* NUEVO: pruebas */
            case 'selectStaff':
                require_once '../modelos/Personal.php';
                $personal = new Personal();

                $rspta = $personal->selectPersonal();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idpersonal . '>' . $reg->nombre . '</option>';
                }
                break;

            case "selectTipodocumento":
                require_once "../modelos/Tipodocumento.php";
                $tipodocumento = new Tipodocumento();

                $rspta = $tipodocumento->select();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idtipo_documento . '>' . $reg->nombre . '</option>';
                }
                break;

            case "selectPais":
                require_once "../modelos/Pais.php";
                $pais = new Pais();

                $rspta = $pais->select();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idpais . '>' . $reg->nombre . '</option>';
                }
                break;

            case "selectTrafico":
                require_once "../modelos/Trafico.php";
                $trafico = new Trafico();

                $rspta = $trafico->select();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idtrafico . '>' . $reg->nombre . '</option>';
                }
                break;

            case 'selectPersonal':
                require_once "../modelos/Empleado.php";
                $empleado = new Empleado();

                $rspta = $empleado->listar();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idpersonal . '>' . $reg->nombre . '</option>';
                }
                break;

            case 'selectCategoria':
                require_once "../modelos/.php";
                $empleado = new Empleado();

                $rspta = $empleado->listar();

                while ($reg = $rspta->fetch_object()) {
                    echo '<option value=' . $reg->idpersonal . '>' . $reg->nombre . '</option>';
                }
                break;

        }

//Fin de las validaciones de acceso
    } else {
        require 'noacceso.php';
    }

}

ob_end_flush();
