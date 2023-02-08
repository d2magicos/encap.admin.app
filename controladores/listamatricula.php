<?php

ob_start();
if (strlen(session_id()) < 1) {
	session_start(); //Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"])) {
	header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.
} else {
	//Validamos el acceso solo al usuario logueado y autorizado.
	if ($_SESSION['administrativa'] == 1) {
		require_once "../modelos/Listamatricula.php";

		$compra = new Compra();
		//Almacenar lo que tenemos en la variable sesion
		$idmatricula = isset($_POST["idmatricula"]) ? limpiarCadena($_POST["idmatricula"]) : "";
		$idparticipante = isset($_POST["idparticipante"]) ? limpiarCadena($_POST["idparticipante"]) : "";
		$idpersonal = isset($_POST["idpersonal"]) ? limpiarCadena($_POST["idpersonal"]) : "";
		$fecha_hora = isset($_POST["fecha_horam"]) ? limpiarCadena($_POST["fecha_horam"]) : "";
		$tipo_persona = isset($_POST["tipo_persona"]) ? limpiarCadena($_POST["tipo_persona"]) : "";
		$cod_matricula = isset($_POST["cod_matriculam"]) ? limpiarCadena($_POST["cod_matriculam"]) : "";
		$qr = isset($_POST["qr"]) ? limpiarCadena($_POST["qr"]) : "";

		$idcurso1 = isset($_POST["idcurso1"]) ? limpiarCadena($_POST["idcurso1"]) : "";
		$fecha_inicio = isset($_POST["fecha_inicio"]) ? limpiarCadena($_POST["fecha_inicio"]) : "";
		$fecha_inicio2 = isset($_POST["fecha_inicio2"]) ? limpiarCadena($_POST["fecha_inicio2"]) : "";
		$contexto = isset($_POST["contexto"]) ? limpiarCadena($_POST["contexto"]) : "";
		$horas = isset($_POST["horas"]) ? limpiarCadena($_POST["horas"]) : "";
		$nota = isset($_POST["nota"]) ? limpiarCadena($_POST["nota"]) : "";
		$año = isset($_POST["año"]) ? limpiarCadena($_POST["año"]) : "";

		$monto = isset($_POST["montom"]) ? limpiarCadena($_POST["montom"]) : "";
		$formato = isset($_POST["formatom"]) ? limpiarCadena($_POST["formatom"]) : "";
		$idforma_recaudacion = isset($_POST["idforma_recaudacionm"]) ? limpiarCadena($_POST["idforma_recaudacionm"]) : "";
		$formarecaudacion = isset($_POST["formarecaudacionm"]) ? limpiarCadena($_POST["formarecaudacionm"]) : "";
		$idmediospagos = isset($_POST["idmediospagosm"]) ? limpiarCadena($_POST["idmediospagosm"]) : "";
		$noperacion = isset($_POST["noperacionm"]) ? limpiarCadena($_POST["noperacionm"]) : "";
		$prioridad = isset($_POST["prioridadm"]) ? limpiarCadena($_POST["prioridadm"]) : "";
		$accesoaula = isset($_POST["accesoaula"]) ? limpiarCadena($_POST["accesoaula"]) : "";
		$enviodigital = isset($_POST["enviodigital"]) ? limpiarCadena($_POST["enviodigital"]) : "";
		$estadoventa = isset($_POST["estadoventa"]) ? limpiarCadena($_POST["estadoventa"]) : "";
		$comprobante = isset($_POST["comprobante"]) ? limpiarCadena($_POST["comprobante"]) : "";
		$observaciones = isset($_POST["obervacionesm"]) ? limpiarCadena($_POST["obervacionesm"]) : "";
		$observaciones_envio = isset($_POST["obervacionesenviom"]) ? limpiarCadena($_POST["obervacionesenviom"]) : "";
		$voucher = isset($_POST["voucher"]) ? limpiarCadena($_POST["voucher"]) : "";
		$compromiso = isset($_POST["compromiso"]) ? limpiarCadena($_POST["compromiso"]) : "";
		$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";
		$imagenposterior = isset($_POST["imagenposterior"]) ? limpiarCadena($_POST["imagenposterior"]) : "";
		$idplantilla = isset($_POST["idplantilla"]) ? limpiarCadena($_POST["idplantilla"]) : "";
		$categoria = isset($_POST["select_idcategoria"]) ? limpiarCadena($_POST["select_idcategoria"]) : "";
		switch ($_GET["op"]) {
			case 'guardaryeditar':

				if ($fecha_inicio2 = $fecha_inicio2) {
					$fecha_inicio2 = $_POST["fecha_inicio2"];
				} else {
					$fecha_inicio2 = $fecha_inicio2;
				}

				if (empty($idmatricula)) {
					$rspta = $compra->insertar($idpersonal, $fecha_hora, $cod_matricula, $idparticipante, $idcurso1, $fecha_inicio2, $qr, $monto, $formato, $idforma_recaudacion, $idmediospagos, $noperacion, $prioridad, $accesoaula, $observaciones_envio, $estadoventa, $comprobante, $observaciones, $contexto, $nota, $año);
					echo $rspta ? "" : "No Matricula";
				} else {
				}
				$rspta = $compra->editar($idmatricula, $idpersonal, $fecha_hora, $cod_matricula, $idparticipante, $idcurso1, $fecha_inicio2, $qr, $monto, $formato, $idforma_recaudacion, $idmediospagos, $noperacion, $prioridad, $accesoaula, $observaciones_envio, $estadoventa, $comprobante, $observaciones, $horas, $contexto, $nota, $año, $voucher, $compromiso, $imagen, $imagenposterior, $idplantilla, $categoria);
				echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";

				break;

			case 'enviar':
				$rspta = $compra->enviar($idmatricula);
				echo $rspta ? "" : "Matricula no se envio";
				break;

			case 'noenviar':
				$rspta = $compra->noenviar($idmatricula);
				echo $rspta ? "" : "Matricula no se envio";
				break;

			case 'eliminar':
				$rspta = $compra->eliminarRegistro($idmatricula);

				echo $rspta ? "" : "No se pudo eliminar";
				break;


			case 'habilitar':
				$rspta = $compra->habilitar($idmatricula);
				echo $rspta ? "" : "Matricula no se envio";
				break;

			case 'nohabilitar':
				$rspta = $compra->nohabilitar($idmatricula);
				echo $rspta ? "" : "Matricula no se envio";
				break;

			case 'habilitarnotf':
				$rspta = $compra->habilitarNotf($idmatricula);
				echo mysqli_error($conexion);
				echo $rspta ? "" : "Matricula no se envio";
				break;

			case 'nohabilitarnotf':
				$rspta = $compra->nohabilitarNotf($idmatricula);
				echo mysqli_error($conexion);
				echo $rspta ? "" : "Matricula no se envio";
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
				echo '<thead style="background-color:#ccc ">
									<th>Codigo Curso</th>
									<th>Nombre</th>
									<th>Tipo Curso</th>
                                    <th>Numero de Horas</th>
									<th>Fecha del Curso (*)</th>
                                </thead>';

				while ($reg = $rspta->fetch_object()) {
					echo '<tr class="filas">
					<td>' . $reg->cod_curso . '</td>					
					<td>' . $reg->curso . '</td>
					<td>' . $reg->categoria . '</td>
					<td>' . $reg->n_horas . '</td>
					<td><label style="color:red;">  Del 1 al 30 de Diciembre del año 2022. </label> <input type="text" class="form-control" name="fecha_inicio2" id="fecha_inicio2" maxlength="500" required>' . $reg->fecha_inicio . '</td>
					
					</tr>';
				}
				echo 'EJECUTO';


				break;


			case 'listar':
				$rspta = $compra->listar();
				//Vamos a declarar un array
				$data = array();
				while ($reg = $rspta->fetch_object()) {
					$data[] = array(
						"0" => $reg->fecha,
						"1" => $reg->hora,
						"2" => $reg->personal,
						"3" => $reg->cod_matricula,
						"4" => $reg->num_documento,
						"5" => $reg->participante,
						"6" => $reg->email,
						"7" => $reg->telefono,
						"8" => $reg->departamento,
						"9" => $reg->ciudad,
						"10" => '<strong style="color:green">' . $reg->nombre . '</strong>',
						"11" => '<p style="color:green">' . $reg->categoria . '</p>',
						"12" => '<p style="color:green">' . $reg->subtipo . '</p>',
						"13" => '<p style="color:green">' . $reg->n_horas . '</p>',
						"14" => '<p style="color:green">' . $reg->fecha_inicio . '</p>',

						"15" => $reg->formato,
						"16" => $reg->monto,
						"17" => $reg->mediosdepagos,
						"18" => ($reg->prioridad == 'NORMAL') ? '<span class="badge bg-blue">NORMAL</span>' :
							'<span class="badge bg-red">URGENTE</span>',
						"19" => ($reg->enviodigital == 'PENDIENTE') ? '<span class="badge bg-yellow"><i class="fa fa-clock-o"></i> PENDIENTE</span>' :
							'<span class="badge bg-green"><i class="fa fa-check-square-o"></i> ENTREGADO</span>',

						"20" => ($reg->accesoaula == 'SI') ? '<span class="badge bg-cyan">SI</span>' :
							'<span class="badge bg-red">NO</span>',
						/*"20"=>($reg->categoria=="CURSO CORTO" && $reg->certificado=='SI')?'<span class="badge bg-green">SI</span>'. 
				'<br><a href="../cert_digitales/curso_corto.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs" style="font-size:14px">Ver digital</button></a>':
				(($reg->categoria=="DIPLOMA" && $reg->certificado=='SI')?'<span class="badge bg-green">SI</span>'. 
				'<br><a href="../cert_digitales/diploma.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs" style="font-size:14px">Ver digital</button></a>':
				(($reg->categoria=="DIPLOMA DE ESPECIALIZACIÓN" && $reg->certificado=='SI')?'<span class="badge bg-green">SI</span>'. 
				'<br><a href="../cert_digitales/diploma_especializacion.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs" style="font-size:14px">Ver digital</button></a>':
				($reg->categoria=="CONVENIO CIP HUANCAVELICA" && $reg->certificado=='SI'?'<span class="badge bg-green">SI</span>'. 
				'<br><a href="../cert_digitales/diplomacip.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs" style="font-size:14px">Ver digital</button></a>':
					($reg->certificado=='SI'?'<span class="badge bg-green">SI</span>':
						'<span class="badge bg-red">NO</span>')))),*/
						"21" => ($reg->certificado == 'SI') ? '<span class="badge bg-green">SI</span>' .
							'<br><a ><button  class="btn btn-info btn-xs" style="font-size:14px" onclick="enviarNotf(\'' . $reg->num_documento . '\',\'' . $reg->participante . '\',\'' . $reg->nombre . '\',\'' . $reg->email . '\',\'' . $reg->cod_matricula . '\')">Enviar notificación</button></a>' .
							'<br><a href="../cert_digitales/' . $reg->idplantilla . '?id=' . $reg->cod_matricula . '&imprimir=digital" target="_blank"><button  class="btn btn-danger btn-xs" style="font-size:14px">Ver digital</button></a>' :
							'<span class="badge bg-red">NO</span>',
						"22" => ($reg->notificacion == 'SI') ? '<span class="badge bg-cyan">Se envió la notificación</span>' :
							'<span class="badge bg-red">No se envió la notificación</span>',
						"23" => ($reg->categoria == "CURSO CORTO22") ? '<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Confirmar la entrega de Envio Digital"><button  class="btn btn-success btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="enviar(' . $reg->idmatricula . ')"><i class="fa fa-check"></i></button></a> ' .

							'  <a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Ingresar Acceso aula, Estado de venta y Comporbante"> <button class="btn btn-warning btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrar(' . $reg->idmatricula . ')"><i class="fa fa-eye"></i></button></a>' : ('<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Confirmar la entrega de Envio Digital"><button  class="btn btn-success btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="enviar(' . $reg->idmatricula . ')"><i class="fa fa-check"></i></button></a> ' .
								'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Habilitar Certificado"><button  class="btn btn-danger btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="habilitarCert(' . $reg->idmatricula . ')"><i class="fa fa-file-pdf-o"></i></button></a> ' .
								'  <a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Ingresar Acceso aula, Estado de venta y Comporbante"> <button class="btn btn-warning btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrar(' . $reg->idmatricula . ')"><i class="fa fa-eye"></i></button></a><p>&nbsp;</p>' .
								($_SESSION['administrativa'] == 1 ? '<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Eliminar matricula"><button  class="btn btn-danger btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="EliminarRegistro(' . $reg->idmatricula . ')"><i class="fa fa-close"></i></button></a>' : ('nada')) .
								'  <a></a>'),
						"24" => $reg->estadoventa,
						"25" => $reg->mediotrafico,
						"26" => $reg->comprobante,
						"27" => !empty($reg->compromiso) ? '<a href="' . $reg->compromiso . '" target="blank"><span class="badge bg-green"><i class="fa fa-check-o"></i>VER COMPROMISO</span></a>' : '',
						"28" => !empty($reg->voucher) ? '<a href="' . $reg->voucher . '" target="blank" ><span class="badge bg-green"><i class="fa fa-check-o"></i>VER VOUCHER</span></a>' : '',
						"29" => $reg->observaciones,
						"30" => $reg->observaciones_envio,
					);
				}
				$results = array(
					"sEcho" => 2, //Información para el datatables
					"iTotalRecords" => count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
					"aaData" => $data
				);
				echo json_encode($results);

				break;

				//el lisyado de todos los proveedores lo vamos a mostrar en la vista ingreso
			case 'selectParticipant':
				require_once "../modelos/Persona.php";
				$persona = new Persona();
				$rspta = $persona->listarp();
				while ($reg = $rspta->fetch_object()) {
					echo '<option value=' . $reg->idpersona . '>' . $reg->nombre . '</option>';
				}
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


			case "selectSub":
				require_once "../modelos/Subcategoria.php";
				$id = $_GET['id'];

				$sub = new Subcategoria();
				$rspta = $sub->select($id);
				while ($reg = $rspta->fetch_object()) {
					echo '<option  value="' . $reg->subcategoria . '"  img1=' . $reg->imagen . ' img2=' . $reg->imagenposterior . ' plantilla=' . $reg->estilo . '>' . $reg->subcategoria . '</option>';
				}
				break;
		}


		//Fin de las validaciones de acceso
	} else {
		require 'noacceso.php';
	}
}

ob_end_flush();
