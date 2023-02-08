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
require_once "../modelos/Gestionenvios.php";

$compra=new Compra();
$idenvio=isset($_POST["idenvio"])? limpiarCadena($_POST["idenvio"]):"";

$idmatricula=isset($_POST["idmatricula"])? limpiarCadena($_POST["idmatricula"]):"";
$lugar_confirmacion=isset($_POST["lugar_confirmacion"])? limpiarCadena($_POST["lugar_confirmacion"]):"";
$idcourier=isset($_POST["idcourier"])? limpiarCadena($_POST["idcourier"]):"";
//$impresion=isset($_POST["impresion"])? limpiarCadena($_POST["impresion"]):"";
$observaciones_envio=isset($_POST["observaciones_envio"])? limpiarCadena($_POST["observaciones_envio"]):""; 

$lugar_confirmacionm=isset($_POST["lugar_confirmacionm"])? limpiarCadena($_POST["lugar_confirmacionm"]):"";
$observaciones_enviom=isset($_POST["observaciones_enviom"])? limpiarCadena($_POST["observaciones_enviom"]):"";

$cliente_contactado=isset($_POST["contacto_confirmacion"])? limpiarCadena($_POST["contacto_confirmacion"]):""; 
$observaciones_contacto=isset($_POST["observaciones_contacto"])? limpiarCadena($_POST["observaciones_contacto"]):""; 
$fecha_matricula=isset($_POST["fecha_horam2"])? limpiarCadena($_POST["fecha_horam2"]):""; 

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idenvio)){		
		/*	$rspta=$compra->insertar($idmatricula,$lugar_confirmacion,$idcourier,$observaciones_envio);
			echo $rspta ? "" : "No Registrado envío";*/
			$rspta=$compra->lugarconfirmar($idmatricula,$lugar_confirmacion);
			echo $rspta ? "" : "Lugar no confirmado";
			$rspta=$compra->observacionenvio($idmatricula,$observaciones_envio);
			echo $rspta ? "" : "No observacion confirmado";			
		}
		else {
			//$rspta=$compra->editar($idenvio,$idmatricula,$lugar_confirmacion);
			//echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";
		}
	break;

	case 'updatecontacto':
		if (empty($idenvio)){		
		/*	$rspta=$compra->insertar($idmatricula,$lugar_confirmacion,$idcourier,$observaciones_envio);
			echo $rspta ? "" : "No Registrado envío";*/
			$rspta=$compra->updateContacto($idmatricula,$cliente_contactado,$observaciones_contacto);
			echo $rspta ? "" : "No se pudo actualizar";
					
		}
		else {
			//$rspta=$compra->editar($idenvio,$idmatricula,$lugar_confirmacion);
			//echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";
		}
	break;
	


	case 'guardaryeditar2':
		if (empty($idenvio)){		
				$rspta=$compra->insertar($idmatricula,$lugar_confirmacion,$idcourier,$observaciones_envio);
			echo $rspta ? "" : "No Registrado envío";
			$rspta=$compra->lugarconfirmar($idmatricula,$lugar_confirmacion);
			echo $rspta ? "" : "Lugar no confirmado";
			$rspta=$compra->observacionenvio($idmatricula,$observaciones_envio);
			echo $rspta ? "" : "No observacion confirmado";	
			$rspta=$compra->updateConfirmacion($idmatricula);
			echo $rspta ? "" : "No se pudo actualizar";	
			$diff=(strtotime($fecha_matricula)-strtotime("now"))*1000;//dif de fechas
			$diff=abs($diff);
			
			if($diff<259200000){
				$rspta=$compra->setTiempo($idmatricula);
				echo $rspta ? "" : "No se pudo actualizar";	
			}else{
				$rspta=$compra->setTiempoTarde($idmatricula);
				echo $rspta ? "" : "No se pudo actualizar";	
			}
		}
		else {
			
		}
	break;	
	
	case 'okimpresion':
		$rspta=$compra->okimpresion($idmatricula);
		echo $rspta ? "" : "Impresión no realizado";
	break;	
	
	case 'oknoimpresion':
		$rspta=$compra->oknoimpresion($idmatricula);
		echo $rspta ? "" : "Impresión no realizado";
	break;

	case 'mostrar':
		$rspta=$compra->mostrarContacto($idmatricula);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrarfalso':
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
		$now = new DateTime();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
				$url1='../reportes/exCertificados2.php?id=';
				$url2='../reportes/exCertificados1.php?id=';
				$urlDip1='../reportes/exDiploma1Nuevo.php?id=';
				$urlDip2='../reportes/exDiploma2.php?id=';
				$urlEsp1='../reportes/exEspecializacion1Nuevo.php?id=';
				$urlEsp2='../reportes/exEspecializacion2.php?id=';
				
				$urlConDip='../reportes/exConveniosDip.php?id=';
				$urlConDip1='../reportes/exConveniosDip2prueba2.php?id=';
				$diff=(strtotime($reg->fecha)-strtotime("now"))*1000;//dif de fechas
				$diff=abs($diff);
 			$data[]=array(
				"0"=>(empty($reg->fecha_confirmacion) &&!empty($reg->fecha) && $diff>259200000 && $reg->fecha>"2022-06-14")?$reg->fecha.'<span class="badge bg-red"><i class="fa fa-exclamation-circle"> </i>PELIGRO</span>':$reg->fecha,//DIFERENCIA DE FECHAS 
				
				"1"=>$reg->fecha_contacto,
				"2"=>$reg->fecha_confirmacion,
				"3"=>$reg->fecha_envio,
				"4"=>$reg->cod_matricula.'<p id="'.$reg->cod_matricula.'" style="display:none">'.$reg->cod_matricula.'</p>',
				"5"=>$reg->tipo_documento.' - '.$reg->num_documento,
				"6"=>$reg->participante,
				"7"=>$reg->telefono,
				"8"=>$reg->telefono2,
				"9"=>$reg->email,				
				"10"=>$reg->nombre,
 				"11"=>$reg->categoria,
				"12"=>$reg->fecha_inicio,
				"13"=>$reg->departamento,
 				"14"=>$reg->ciudad,				 
 				"15"=>($reg->estadoenvio=='POR ENVIAR')?'<span class="badge bg-red"><i class="fa fa-pencil-square-o"></i> POR ENVIAR<br> Y CONFIRMAR LUGAR</span>':
				 ($reg->estadoenvio=='PENDIENTE POR LLAMAR'?
 				'<span class="badge bg-yellow"><i class="fa fa-check-square-o"></i> LUGAR CONFIRMADO</span>':
				'<span class="badge bg-green"><i class="fa fa-check-square-o"></i> ENVIO REALIZADO</span>'),
				"16"=>$reg->tiempoenvio,	
				"17"=>($reg->impresion=='NO')?'<span class="badge bg-red">NO</span>':
 				'<span class="badge bg-green">SI</span>',
				 "18"=>($reg->cliente_contactado=='NO' || empty($reg->cliente_contactado))?'<span class="badge bg-red">NO</span>':
 				'<span class="badge bg-green">SI</span>',
				 "19"=>$reg->observaciones_contacto,
				"20"=>$reg->lugar_confirmacion,
				"21"=>($reg->estadoenvio=='POR ENVIAR' && ($reg->cliente_contactado=='NO' || $reg->cliente_contactado==''))?'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Formulario para confirmar el lugar de envio" > <button class="btn btn-info btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrar('.$reg->idmatricula.')"><i class="fa fa-phone"></i></button></a>'.
				
						'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Confirmar impresion">  <button class="btn btn-primary btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="okimpresion('.$reg->idmatricula.')"><i class="fa fa-print"></i></button></a> ':
						
						($reg->estadoenvio=='POR ENVIAR' && $reg->cliente_contactado=='SI'?
				'<button class="btn btn-success btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrarFalso('.$reg->idmatricula.')"><i class="fa fa-check"></i></button>'.	
				'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Formulario para confirmar el lugar de envio" > <button class="btn btn-info btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="mostrar('.$reg->idmatricula.')"><i class="fa fa-phone"></i></button></a>'.	
						'<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Confirmar impresion">  <button class="btn btn-primary btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="okimpresion('.$reg->idmatricula.')"><i class="fa fa-print"></i></button></a> ':
						
						
						($reg->estadoenvio=='PENDIENTE POR LLAMAR'?				
															
					  '<a target="_blank" data-toggle="tooltip" title="" target="blanck" data-original-title="Confirmar impresion">  <button class="btn btn-primary btn-xs" style="width: 35px; height:30px;font-size:18px" onclick="okimpresion('.$reg->idmatricula.')"><i class="fa fa-print"></i></button></a>':
					  (' <span class="badge bg-green"> Envio Realizado <br> Se hizo el envio </span> '))),
					

				"22"=>($reg->impresion=='NO')?' <a target="_blank" href="'.$url2.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir CERTIFICADO hoja 1"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>'.
					  ' <a target="_blank" href="'.$url1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir CERTIFICADO hoja 2"> <button class="btn btn-info btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					  ' <a target="_blank" href="'.$urlDip1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA hoja 1"> <button class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>'.
					    ' <a target="_blank" href="'.$urlDip2.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA hoja 2"> <button class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					    //' <a target="_blank" href="'.$urlDipNuevo.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA NUEVO FORMATO hoja 1"> <button class="btn btn-dark btn-xs"><i class="fa fa-file"></i></button></a>'.
						' <a target="_blank" href="'.$urlEsp1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA DE ESPECIALIZACIÓN hoja 1"> <button class="btn btn-warning btn-xs"><i class="fa fa-file-text"></i></button></a>'.
						' <a target="_blank" href="'.$urlEsp2.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA DE ESPECIALIZACIÓN hoja 2"> <button class="btn btn-warning btn-xs"><i class="fa fa-file-text"></i></button></a>'.
						//' <a target="_blank" href="'.$urlEsp1Nuevo.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA DE ESPECIALIZACIÓN NUEVO FORMATO hoja 1"> <button class="btn btn-dark btn-xs"><i class="fa fa-file-text"></i></button></a>'.
						' <a target="_blank" href="'.$urlConDip.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA CONVENIOS hoja 1"> <button class="btn btn-success btn-xs"><i class="fa fa-file-text"></i></button></a>'.
						    ' <a target="_blank" href="'.$urlConDip1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA CONVENIOS hoja 2"> <button class="btn btn-success btn-xs"><i class="fa fa-file-text"></i></button></a>':
						'<a target="_blank" href="'.$url2.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir CERTIFICADO hoja 1"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>'.
					    ' <a target="_blank" href="'.$url1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir CERTIFICADO hoja 2"> <button class="btn btn-info btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					    //' <a target="_blank" href="'.$urlDipNuevo.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA NUEVO FORMATO hoja 1"> <button class="btn btn-secondary btn-xs"><i class="fa fa-file"></i></button></a>'.
						' <a target="_blank" href="'.$urlDip1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA hoja 1"> <button class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>'.
					    ' <a target="_blank" href="'.$urlDip2.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA hoja 2"> <button class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					    //' <a target="_blank" href="'.$urlDip1Nuevo.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA NUEVO FORMATO hoja 1"> <button class="btn btn-dark btn-xs"><i class="fa fa-file"></i></button></a>'.
					    ' <a target="_blank" href="'.$urlEsp1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA DE ESPECIALIZACIÓN hoja 1"> <button class="btn btn-warning btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					    ' <a target="_blank" href="'.$urlEsp2.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA DE ESPECIALIZACIÓN hoja 2"> <button class="btn btn-warning btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					    //' <a target="_blank" href="'.$urlEsp1Nuevo.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA DE ESPECIALIZACIÓN NUEVO FORMATO hoja 1"> <button class="btn btn-dark btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					    ' <a target="_blank" href="'.$urlConDip.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA CONVENIOS hoja 1"> <button class="btn btn-success btn-xs"><i class="fa fa-file-text"></i></button></a>'.
					    ' <a target="_blank" href="'.$urlConDip1.$reg->idmatricula.'" data-toggle="tooltip" title="" target="blanck" data-original-title="Imprimir DIPLOMA CONVENIOS hoja 2"> <button class="btn btn-success btn-xs"><i class="fa fa-file-text"></i></button></a>',
				/*"23"=>$reg->categoria=="CURSO CORTO"? '<a href="../cert_digitales/curso_fisico.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-success btn-xs"><i class="fa fa-print"></i> Imprimir</button></a>'.
				'<a href="../cert_digitales/curso_corto.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs">Ver digital</button></a>':
				($reg->categoria=="DIPLOMA"? '<a href="../cert_digitales/diploma_fisico.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-success btn-xs"><i class="fa fa-print"></i> Imprimir</button></a>'.
				'<a href="../cert_digitales/diploma.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs">Ver digital</button></a>':(
					$reg->categoria=="CONVENIO CIP HUANCAVELICA"? '<a href="../cert_digitales/diplomacip.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-success btn-xs"><i class="fa fa-print"></i> Imprimir</button></a>'.
				'<a href="../cert_digitales/diplomacip.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs">Ver digital</button></a>':
				'<a href="../cert_digitales/diplomaesp_fisico.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-success btn-xs"><i class="fa fa-print"></i> Imprimir</button></a>'.
				'<a href="../cert_digitales/diploma_especializacion.php?id='.$reg->cod_matricula.'" target="_blank"><button class="btn btn-danger btn-xs">Ver digital</button></a>')),*/
				"23"=>'<a href="../cert_digitales/'.$reg->idplantilla.'?id='.$reg->cod_matricula.'&imprimir=fisico" target="_blank"><button class="btn btn-success btn-xs"><i class="fa fa-print"></i> Imprimir</button></a>'. 
				'<a href="../cert_digitales/'.$reg->idplantilla.'?id='.$reg->cod_matricula.'&imprimir=digital" target="_blank"><button class="btn btn-danger btn-xs">Ver digital</button></a>',
				"24"=>$reg->observaciones_envio,
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
