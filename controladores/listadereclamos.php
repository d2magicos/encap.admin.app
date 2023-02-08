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
if ($_SESSION['administrativa']==1)
{
require_once "../modelos/Listadereclamos.php";

$compra=new Compra();

$idreclamo=isset($_POST["idreclamo"])? limpiarCadena($_POST["idreclamo"]):"";

$idmatricula=isset($_POST["idmatricula"])? limpiarCadena($_POST["idmatricula"]):"";
$idpersonal=isset($_POST["idpersonal"])? limpiarCadena($_POST["idpersonal"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$hora=isset($_POST["hora"])? limpiarCadena($_POST["hora"]):"";
$fechaatencion=isset($_POST["fechaatencion"])? limpiarCadena($_POST["fechaatencion"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$solucion=isset($_POST["solucion"])? limpiarCadena($_POST["solucion"]):""; 
$prioridad=isset($_POST["prioridad"])? limpiarCadena($_POST["prioridad"]):""; 
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):""; 
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':				
		if (empty($idreclamo)){			
			$rspta=$compra->insertar($idmatricula,$idpersonal,$idasunto,$idsubasunto,$fecha,$descripcion,$fechaatencion,$hora,$solucion,$prioridad,$estado,$observaciones);
			echo $rspta ? "" : "No se pudieron registrar todos los datos del reclamo";
		}
		else {
			$rspta=$compra->editar($idreclamo,$fecha,$descripcion,$fechaatencion,$hora,$solucion,$prioridad,$estado,$observaciones);
			echo $rspta ? "" : "El reclamo no se pudo actualizar";
			$rspta=$compra->actualizado($idmatricula,$estado);
			echo $rspta ? "" : "Reclamo no se puede actualizar en matricula";
		}
	break;
					
	case 'desactivar':
		$rspta=$compra->desactivar($idreclamo);
 		echo $rspta ? "" : "Reclamo no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$compra->eliminar($idreclamo);
 		echo $rspta ? "" : "Reclamo no se puede elimiar";
 		break;
	break;

	case 'activar':
		$rspta=$compra->activar($idreclamo);
 		echo $rspta ? "" : "Reclamo no se puede activar";
 		break;
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
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idreclamo,
				"1"=>$reg->personal,
				"2"=>$reg->fecha_hora,
				"3"=>$reg->cod_matricula,
				"4"=>$reg->num_documento,
				"5"=>$reg->participante,
				"6"=>$reg->telefono,
				"7"=>$reg->email,		
				"8"=>$reg->nombre,
 				"9"=>$reg->categoria,
				"10"=>$reg->fecha_inicio,
				"11"=>$reg->fecha,
				"12"=>$reg->hora_reclamo,
				"13"=>$reg->asunto,
				"14"=>$reg->subasunto,
				"15"=>$reg->descripcion,
				"16"=>$reg->observaciones,
				"17"=>$reg->fechaatencion,
				"18"=>$reg->hora,
				"19"=>$reg->solucion,								 
				"20"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
					'<span class="badge bg-red">URGENTE</span>',			
				"21"=>($reg->condicion)?'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Formulario para editar el reclamo pendiente"> <button class="btn btn-warning btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrar('.$reg->idreclamo.')"><i class="fa fa-pencil"></i></button></a>'.
				  ' <a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Eliminar "> <button class="btn btn-danger btn-xs"  style="width: 35px; height:30px;font-size:18px"  onclick="eliminar('.$reg->idreclamo.')"><i class="fa fa-trash"></i></button></a>':
				  '',	
				"22"=>($reg->estado=='POR RESOLVER')?'<span class="badge bg-yellow"><i class="fa fa-exclamation"></i> POR RESOLVER</span>':
				  '<span class="badge bg-green"><i class="fa fa-check-square-o"></i> SOLUCIONADO</span>',
 				);
 		}
 		$results = array(
 			"sEcho"=>2, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;	
	
		//el lisyado de todos los proveedores lo vamos a mostrar en la vista ingreso
	case 'selectAsunto':
			require_once "../modelos/Asunto.php";
			$asunto = new Asunto();

			$rspta = $asunto->select();		
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->idasunto.'>'.$reg->nombre.'</option>';
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

