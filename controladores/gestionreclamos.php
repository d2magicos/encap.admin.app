<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
}
else
{
//Validamos el acceso solo al usuario logueado y autorizado.
if ($_SESSION['reclamos']==1)
{
require_once "../modelos/Gestionreclamos.php";

$compra=new Compra();

$idreclamo=isset($_POST["idreclamo"])? limpiarCadena($_POST["idreclamo"]):"";

$idmatricula=isset($_POST["idmatricula"])? limpiarCadena($_POST["idmatricula"]):"";
$idpersonal=isset($_POST["idpersonal"])? limpiarCadena($_POST["idpersonal"]):"";

$idasunto=isset($_POST["idasunto"])? limpiarCadena($_POST["idasunto"]):"";
$idsubasunto=isset($_POST["idsubasunto"])? limpiarCadena($_POST["idsubasunto"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$hora_reclamo=isset($_POST["hora_reclamo"])? limpiarCadena($_POST["hora_reclamo"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$prioridad=isset($_POST["prioridad"])? limpiarCadena($_POST["prioridad"]):""; 
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";


switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idreclamo)){		
			$rspta=$compra->insertar($idmatricula,$idpersonal,$idasunto,$idsubasunto,$fecha,$hora_reclamo,$descripcion,$prioridad,$observaciones);
			echo $rspta ? "" : "No Registrado reclamo";
			$rspta=$compra->estadoreclamo($idmatricula);
			echo $rspta ? "" : "Estado reclamo ";			
		}
		else {
			//$rspta=$compra->editar($idenvio,$idmatricula,$lugar_confirmacion);
			//echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";
		}
	break;	

	case 'mostrar':
		$rspta=$compra->mostrar($idmatricula);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];
		$rspta = $compra->listarDetalle($id);
		//$total=0;
		echo '<thead style="background-color:#ccc">
									<th>Codigo Curso</th>
									<th>Nombre</th>
									<th>Tipo Curso</th>
                                    <th>Numero de Horas</th>
									<th>Fecha del Curso</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
				echo '<tr class="filas">
					<td>'.$reg->cod_curso.'</td>					
					<td>'.$reg->curso.'</td>
					<td>'.$reg->categoria.'</td>
					<td>'.$reg->n_horas.'</td>
					<td>'.$reg->fecha_inicio.'</td>
					</tr>';					
				}
				echo '<tfoot>
                    <th></th>
					<th></th>
					<th></th>
                    <th></th>
					<th></th>
                </tfoot>';
	break;

	case 'listar':
		$rspta=$compra->listar();
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){				
 			$data[]=array(
				"0"=>$reg->fecha,
				"1"=>$reg->cod_matricula,
				"2"=>$reg->tipo_documento.' - '.$reg->num_documento,
				"3"=>$reg->participante,
				"4"=>$reg->telefono,
				"5"=>$reg->email,				
				"6"=>$reg->nombre,
 				"7"=>$reg->categoria,
				"8"=>$reg->fecha_inicio,
				"9"=>$reg->monto,
				"10"=>$reg->formato,
				"11"=>$reg->trafico,
					'<span class="badge bg-dryan">  </span>', 	
				"12"=>($reg->enviodigital=='ENTREGADO')?'<span class="badge bg-green"><i class="fa fa-check-square-o"></i> ENTREGADO</span>':
					'<span class="badge bg-yellow"><i class="fa fa-clock-o"></i> PENDIENTE</span>',	
				"13"=>($reg->accesoaula=='SI')?'<span class="badge bg-green">SI</span>':
					'<span class="badge bg-red">NO</span>',	
				"14"=>($reg->estadoreclamo=='')?'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Formulario para realizar el reclamo"> <button class="btn btn-info btn-xs" style="font-size:18px"onclick="mostrar('.$reg->idmatricula.')"><i class="fa fa-question"></i></button></a>':
					' <span class="badge bg-grey"><i class="fa fa-exclamation"></i> Reclamo Enviado</span> ',
				"15"=>$reg->estadoreclamo,	
			 );
 		}
 		$results = array(
 			"sEcho"=>2, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	// Select Asunto
	case "selectAsunto":
		require_once "../modelos/Asunto.php";
		$asunto = new Asunto();
		$rspta = $asunto->select();
		while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->idasunto . '>' . $reg->nombre . '</option>';
			}
	break;




}
//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}

}
ob_end_flush();
?>
