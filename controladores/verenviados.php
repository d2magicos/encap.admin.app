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
require_once "../modelos/Verenviados.php";

$compra=new Compra();

$idenvio=isset($_POST["idenvio"])? limpiarCadena($_POST["idenvio"]):"";
$idmatricula=isset($_POST["idmatricula"])? limpiarCadena($_POST["idmatricula"]):"";

$lugarenvio=isset($_POST["lugarenvio"])? limpiarCadena($_POST["lugarenvio"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$idcourier=isset($_POST["idcourier"])? limpiarCadena($_POST["idcourier"]):"";
$fecha_info=isset($_POST["fecha_info"])? limpiarCadena($_POST["fecha_info"]):"";
$factura_envio=isset($_POST["factura_envio"])? limpiarCadena($_POST["factura_envio"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$fechaenvio=isset($_POST["fechaenvio"])? limpiarCadena($_POST["fechaenvio"]):"";
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):""; 

switch ($_GET["op"]){
	case 'guardaryeditar':				
		if (empty($idenvio)){			
			$rspta=$compra->insertar($idmatricula,$lugarenvio,$monto,$idcourier,$fechaenvio,$clave,$factura_envio,$fecha_info,$observaciones);
			echo $rspta ? "" : "No se pudieron registrar todos los datos del Envio";
		}
		else {
			//$rspta=$compra->editar($idenvio,$idmatricula,$lugarenvio,$monto,$idcourier,$fechaenvio,$clave,$factura_envio,$fecha_info,$observaciones);
			//echo $rspta ? "" : "Envio no se pudo actualizar";
		}
	break;
					
	case 'actualizado':
		$rspta=$compra->actualizado($idmatricula);
 		echo $rspta ? "" : "Envio no se puede enviado";
	break;

	case 'eliminar':
		$rspta=$compra->eliminar($idenvio);
 		echo $rspta ? "" : "Envio no se puede enviado";
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
                                </tfoot>';
	break;


	case 'listar':
		$rspta=$compra->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idmatricula,
				"1"=>$reg->fecha_hora,
				"2"=>$reg->cod_matricula,
				"3"=>$reg->num_documento,	
				"4"=>$reg->participante,
				"5"=>$reg->telefono,
				"6"=>$reg->telefono2,
				"7"=>$reg->email,
				"8"=>$reg->nombre,
 				"9"=>$reg->categoria,
				"10"=>$reg->fecha_inicio,
				"11"=>$reg->lugar_confirmacion,							 
				"12"=>($reg->estadoenvio=='PENDIENTE POR LLAMAR')?'<span class="badge bg-yellow">PENDIENTE DE INFORMACION</span>':
				'<span class="badge bg-green">ENVIO COMPLETADO</span>',
			   	"13"=>($reg->estadoenvio=='PENDIENTE POR LLAMAR')?'<button class="btn btn-warning btn-xs" title="Formulario detalles de envio, monto, courier, fecha de envio y observcaiones" onclick="mostrar('.$reg->idmatricula.')"><i class="fa fa-pencil"></i></button>':
				   //' <button class="btn btn-primary btn-xs" onclick="actualizado('.$reg->idenvio.')"><i class="fa fa-check"></i></button>':
				   ' <button class="btn btn-success btn-xs" title="Realizado el envio con exito" ><i class="fa fa-check"></i></button>'.
				   //' <button class="btn btn-primary btn-xs" onclick="actualizado('.$reg->idenvio.')"><i class="fa fa-check"></i></button>'.
				   //' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idmatricula.')"><i class="fa fa-trash"></i></button>'
					' ',		
				"14"=>$reg->observaciones_envio,			
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

