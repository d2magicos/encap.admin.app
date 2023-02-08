<?php
ob_start();

if (strlen(session_id()) < 1) {
	session_start();	// Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
  header("Location: ../vistas/login.html");	// Validamos el acceso solo a los usuarios logueados al sistema.
} else {
	// Validamos el acceso solo al usuario logueado y autorizado.
	if ($_SESSION['administrativa'] == 1) {
		require_once "../modelos/Listasatisfacion.php";

		$compra = new Compra();

		/* Satisfacción #1 */
		$idmatricula = isset($_POST["idmatricula"]) ? limpiarCadena($_POST["idmatricula"]) : "";
		$satisfacion = isset($_POST["satisfacion"]) ? limpiarCadena($_POST["satisfacion"]) : "";
		$estadosatisfacion = isset($_POST["estadosatisfacion"]) ? limpiarCadena($_POST["estadosatisfacion"]) : "";
		$fechainfo = isset($_POST["fechainfo"]) ? limpiarCadena($_POST["fechainfo"]) : "";
		$observaciones_satisfacion = isset($_POST["observaciones_satisfacion"]) ? limpiarCadena($_POST["observaciones_satisfacion"]) : "";

		/* Satisfacción #2 */
		$idmatri = isset($_POST['idmatricula2']) ? limpiarCadena($_POST['idmatricula2']) : "";
		$val01 = isset($_POST['valoracion01']) ? limpiarCadena($_POST['valoracion01']) : "";
		$com01 = isset($_POST['comentario01']) ? limpiarCadena($_POST['comentario01']) : "";
		$val02 = isset($_POST['valoracion02']) ? limpiarCadena($_POST['valoracion02']) : "";
		$com02 = isset($_POST['comentario02']) ? limpiarCadena($_POST['comentario02']) : "";
		$val03 = isset($_POST['valoracion03']) ? limpiarCadena($_POST['valoracion03']) : "";
		$com03 = isset($_POST['comentario03']) ? limpiarCadena($_POST['comentario03']) : "";
		$val04 = isset($_POST['valoracion04']) ? limpiarCadena($_POST['valoracion04']) : "";
		$com04 = isset($_POST['comentario04']) ? limpiarCadena($_POST['comentario04']) : "";

		$fechaRegistro = date('Y-m-d', time());

		switch ($_GET["op"]) {
			case 'guardaryeditar':
				if (!empty($idmatricula)) { 
					$rspta = $compra->editar($idmatricula,$satisfacion,$estadosatisfacion,$observaciones_satisfacion,$fechainfo);
					echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";
				}				
			break;	
			
			/* nuevo */
			case 'guardarFormulario02':
				/* echo print_r($_POST); */

				/* $mat = '8555';
				$va01 = '2 - Insatisfecho';
				$cm01 = 'zxc';
				$fdatee = '2022-11-10'; */

				/* if (!empty($idmatri)) {
					$rspta = $compra->agregarSatisfaccion02($idmatri, $val01, $com01, $val02, $com02, $val03, $com03, $val04, $com04, $fechaRegistro);

					echo $rspta ? "" : "No se pudo registrar la Satisfacción #2";
				}
 */
				if (!empty($idmatri)) {
					$verify = $compra->verificarSatisfaccion02($idmatri);
					$message = "";

					if ($verify->num_rows > 0) {
						$rspta = $compra->actualizarSatisfaccion02($idmatri, $val01, $com01, $val02, $com02, $val03, $com03, $val04, $com04, $fechaRegistro);
						$message = "Registro actualizado";
					} else {
						$rspta = $compra->agregarSatisfaccion02($idmatri, $val01, $com01, $val02, $com02, $val03, $com03, $val04, $com04, $fechaRegistro);
						$message = "Registrado con éxito";
					}
					//	$rspta = $compra->agregarSatisfaccion02($mat, $va01, $cm01, $va01, $cm01, $va01, $cm01, $va01, $cm01, $fdatee);

					echo $rspta ? $message : "No se pudo registrar la Satisfacción #2";
				}
			break;

			case 'habilitarBono':
				$id = $_POST['idmatricula'];
				$fecha_caducidad = date("Y-m-d", strtotime($fechaRegistro . "+ 2 days"));

				$rspta = $compra->habilitarBono($id, $fecha_caducidad);

				echo $rspta ? "" : "";
			break;
			
			case 'mostrar':
				$rspta = $compra->mostrar($idmatricula);
				
				echo json_encode($rspta);	//	Codificar el resultado utilizando json
			break;

			case 'listarDetalle':
				$id = $_GET['id'];	//	Recibimos el idingreso

				$rspta = $compra->listarDetalle($id);
				//$total=0;
				echo '
					<thead style="background-color:#CCC ">
						<th>Codigo Curso</th>
						<th>Nombre</th>
						<th>Tipo Curso</th>
						<th>Numero de Horas</th>
						<th>Fecha del Curso</th>
					</thead>
				';

				while ($reg = $rspta->fetch_object()) {
					echo '
						<tr class="filas">
							<td>'.$reg->cod_curso.'</td>					
							<td>'.$reg->curso.'</td>
							<td>'.$reg->categoria.'</td>
							<td>'.$reg->n_horas.'</td>
							<td>'.$reg->fecha_inicio.'</td>
						</tr>
					';					
				}
						
				echo '
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tfoot>
				';
			break;

			case 'listar':
				$rspta = $compra->listar();

				//	Vamos a declarar un array
				$data = Array();

				$url = "https://sistemas.encap.edu.pe/encuesta_satisfaccion/cupon.php";
				$btnBono = "";

				while ($reg = $rspta->fetch_object()) {
					$btnBono = "";

					if ($reg->bono_estado == "POR SOLICITAR") {
						$btnBono = '<a class="badge bg-yellow p-1" target="_blank" onclick="habilitarBono(this, '. $reg->idmatricula .')">Habilitar bono</a>';
					}

					if ($reg->bono_estado == "ACTIVO") {
						$btnBono = '<a class="badge bg-green" href='. $url . '?id=' . $reg->idmatricula .' target="_blank" style="padding: .65rem .85rem;">Bono</a>';
					}

					$data[] = array(
						"0"=>$reg->fecha,
						"1"=>$reg->cod_matricula,
						"2"=>$reg->personal,
						"3"=>$reg->participante,
						"4"=>$reg->telefono,
						"5"=>$reg->telefono2,
						"6"=>$reg->email,
						"7"=>$reg->nombre,
						"8"=>$reg->categoria,
						"9"=>$reg->n_horas,//cambio
						"10"=>$reg->formato,
						"11"=>"S/ ".$reg->monto,//cambio
						"12"=>$reg->fecha_inicio,
						"13"=>$reg->satisfacion,	
						"14"=>"<button id='https://sistemas.encap.edu.pe/encuesta_satisfaccion/?id=".$reg->cod_matricula."' type='button' onclick='CopyClipboard(this.id)'><a target='_blank'  >Copiar</a></button>",				
						"15"=>($reg->condicion) 
							? '<a target="_blank" data-toggle="tooltip" title="" data-original-title="Formulario para rellenar la satisfacion del participante"> <button class="btn btn-warning btn-xs" style="width: 35px; height:30px; font-size:18px" onclick="mostrar('.$reg->idmatricula.')"><i class="fa fa-smile-o"></i></button></a>' . ' ' .  
							  '<a target="_blank" data-toggle="tooltip" title="" data-original-title="Formulario de 4 preguntas"> <button class="btn btn-success btn-xs" style="width: 35px; height:30px; font-size:18px" onclick="mostrarFormulario2(this, '.$reg->idmatricula.')"><i class="fa fa-smile-o"></i></button></a>'
							: ' ',
						"16"=>($reg->estadosatisfacion == 'CONFIRMADO') ? 
							'<span class="badge bg-green"><i class="fa fa-check-square-o"></i> CONFIRMADO</span>' :
							'<span class="badge bg-yellow"><i class="fa fa-clock-o"></i> PENDIENTE</span>',
						"17"=>$reg->observaciones_satisfacion,
						"18"=>$reg->fechainfo,
						"19"=>$reg->valoracion1,
						"20"=>$reg->comentario1,
						"21"=>$reg->valoracion2,
						"22"=>$reg->comentario2,
						"23"=>$reg->valoracion3,
						"24"=>$reg->comentario3,
						"25"=>$reg->valoracion4,
						"26"=>$reg->comentario4,
						"27"=>($reg->estado == "CONFIRMADO") ?
							'<span class="badge bg-green"><i class="fa fa-check-square-o"></i> CONFIRMADO</span>' :
							'<span class="badge bg-yellow"><i class="fa fa-clock-o"></i> PENDIENTE</span>',
						"28"=>$reg->fechaSatisfaccion2,
						"29"=>$btnBono,
						"30"=>$reg->bono_caducidad
					);
				}
				$results = array(
					"sEcho"=>2, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);

			break;
		}

//	Fin de las validaciones de acceso
	} else {
	require 'noacceso.php';
	}
}

ob_end_flush();
?>
