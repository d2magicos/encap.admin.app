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
if ($_SESSION['matricula']==1)
{
require_once "../modelos/Verlistamatricula.php";
$compra=new Compra();
$idpersonal=$_SESSION["idpersonal"];

switch ($_GET["op"]){
	case 'listar':
		$rspta=$compra->listar($idpersonal);
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idmatricula,
				"1"=>$reg->fecha,
				"2"=>$reg->cod_matricula,
				"3"=>$reg->tipo_documento.' - '.$reg->num_documento,
				"4"=>$reg->participante,
				"5"=>$reg->telefono,
				"6"=>$reg->email,
				"7"=>$reg->nombre,
				"8"=>$reg->categoria,
				"9"=>$reg->n_horas,
 				"10"=>$reg->fecha_inicio,
 				"11"=>$reg->mediospagos,
 				"12"=>$reg->monto,
 				"13"=>$reg->formato,
 				"14"=>$reg->trafico,
 				"15"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
 	 				'<span class="badge bg-red">URGENTE</span>', 
				"16"=>($reg->enviodigital=='ENTREGADO')?'<span class="badge bg-green"><i class="fa fa-check-square-o"></i> ENTREGADO</span>':
					'<span class="badge bg-yellow"><span class="badge bg-yellow"><i class="fa fa-clock-o"></i>  PENDIENTE</span>', 	
				"17"=>($reg->estadoenvio=='ENVÍO REALIZADO')?'<span class="badge bg-green"><i class="fa fa-external-link"></i> ENVIO <br>COMPLETADO</span>':
					'<span class="badge bg-dryan">  </span>', 	
				"18"=>($reg->accesoaula=='SI')?'<span class="badge bg-green">SI</span>':
					'<span class="badge bg-red">NO</span>',	
				"19"=>$reg->observaciones,
				"20"=>$reg->observaciones_envio,	

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

//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}

}

ob_end_flush();
?>
