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
if ($_SESSION['envios']==1)
{
require_once "../modelos/Listadeenvios.php";

$compra=new Compra();

$idenvio=isset($_POST["idenvio"])? limpiarCadena($_POST["idenvio"]):"";
$idmatricula=isset($_POST["idmatricula"])? limpiarCadena($_POST["idmatricula"]):"";

$lugarenvio=isset($_POST["lugarenvio"])? limpiarCadena($_POST["lugarenvio"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$idcourier=isset($_POST["idcourier"])? limpiarCadena($_POST["idcourier"]):"";
$observacion_cliente=isset($_POST["observacion_cliente"])? limpiarCadena($_POST["observacion_cliente"]):"";
$direccion_envio=isset($_POST["direccion_envio"])? limpiarCadena($_POST["direccion_envio"]):"";
$fecha_info=isset($_POST["fecha_info"])? limpiarCadena($_POST["fecha_info"]):"";
$factura_envio=isset($_POST["factura_envio"])? limpiarCadena($_POST["factura_envio"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$fechaenvio=isset($_POST["fechaenvio"])? limpiarCadena($_POST["fechaenvio"]):"";
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):""; 
$info_seguimiento=isset($_POST["tracking_info"])? limpiarCadena($_POST["tracking_info"]):""; 


switch ($_GET["op"]){
	case 'guardaryeditar':				
		if (empty($idenvio)){			
			$rspta=$compra->insertar($idmatricula,$lugarenvio,$monto,$idcourier,$direccion_envio,$fechaenvio,$clave,$observacion_cliente,$factura_envio,$fecha_info,$observaciones);
			echo $rspta ? "" : "No se pudieron registrar todos los datos del Envio";

			$rspta=$compra->estadoenvio($idmatricula);
			echo $rspta ? "" : "Lugar no confirmado";

			$rspta=$compra->updateEnvio($idmatricula);
			echo $rspta ? "" : "No se pudo actualizar";

			$rspta=$compra->estadogestionenvio($idmatricula);
			echo $rspta ? "" : "No se pudo actualizar";

		}
		else {
			$rspta = $compra->editar($idenvio, $idmatricula, $lugarenvio, $monto, $idcourier, $direccion_envio, $fechaenvio, $clave, $observacion_cliente, $factura_envio, $fecha_info, $observaciones, $info_seguimiento);
			echo $rspta ? "" : "Envio no se pudo actualizar";

			$rspta=$compra->estadoenvio($idmatricula);
			echo $rspta ? "" : "Lugar no confirmado";

			$rspta=$compra->estadogestionenvio($idmatricula);
			echo $rspta ? "" : "No se pudo actualizar";
		}
	break;
					
	case 'actualizado':
		$rspta=$compra->actualizado($idmatricula);
 		echo $rspta ? "" : "Envio no se puede enviado";
	break;

	case 'desactivar':
		$rspta=$compra->desactivar($idenvio);
 		echo $rspta ? "" : "Envio no se puede desactivar";
 		break;
	break;

	case 'eliminar':
		$rspta=$compra->eliminar($idenvio);
 		echo $rspta ? "" : "Envio no se puede elimiar";
 		break;
	break;

	case 'activar':
		$rspta=$compra->activar($idenvio);
 		echo $rspta ? "" : "Envio no se puede activar";
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
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idenvio,
				"1"=>$reg->fecha_hora,
				"2"=>'<strong>'.$reg->fechaenvio.'</strong>',	
				"3"=>$reg->cod_matricula,
				"4"=>$reg->num_documento,
				"5"=>$reg->participante,
				"6"=>$reg->telefono,
				"7"=>$reg->telefono2,
				"8"=>$reg->email,		
				"9"=>$reg->nombre,
 				"10"=>$reg->categoria,
				"11"=>$reg->fecha_inicio,
				"12"=>$reg->ciudad,
				"13"=>$reg->lugarenvio,
				"14"=>$reg->monto,
				"15"=>$reg->courier,								 
				"16"=>$reg->factura_envio,	
				"17"=>$reg->clave,							 
				"18"=>$reg->fechaenvio,								 							 
				"19"=>($reg->estado=='ENVÍO REALIZADO')?'<span class="badge bg-green"><i class="fa fa-external-link"></i> ENVÍO REALIZADO</span>':
				'<span class="badge bg-red"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> ENVÍO EN PROCESO</span>',
				"20"=>($reg->condicion)?'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Formulario para editar el envio realizado"> <button class="btn btn-warning btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrar('.$reg->idenvio.')"><i class="fa fa-pencil"></i></button></a>'.
				  ' <a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Desactivar"> <button class="btn btn-danger btn-xs"  style="width: 35px; height:30px;font-size:18px" onclick="desactivar('.$reg->idenvio.')"><i class="fa fa-close"></i></button></a>':
				  ' <a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Formulario para editar el envio realizado"> <button class="btn btn-warning btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrar('.$reg->idenvio.')"><i class="fa fa-pencil"></i></button></a>'.
				  ' <a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Activar"> <button class="btn btn-primary btn-xs"   style="width: 35px; height:30px;font-size:18px" onclick="activar('.$reg->idenvio.')"><i class="fa fa-check"></i></button></a>'.
				  ' <a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Eliminar "> <button class="btn btn-danger btn-xs"  style="width: 35px; height:30px;font-size:18px"  onclick="eliminar('.$reg->idenvio.')"><i class="fa fa-trash"></i></button></a>',	
				"21"=>$reg->observaciones,
				"22"=>$reg->direccion_envio,			
				"23"=>$reg->info_seguimiento,
				"24"=>$reg->observacion_cliente,
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
	case 'selectCourier':
			require_once "../modelos/Courier.php";
			$courier = new Courier();

			$rspta = $courier->select();		
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->idcourier.'>'.$reg->nombre.'</option>';
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

