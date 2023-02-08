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
if ($_SESSION['inicio']==1)
{
require_once "../modelos/Modulomatricula.php";

$compra=new Compra();

$idmatricula=isset($_POST["idmatricula"])? limpiarCadena($_POST["idmatricula"]):"";
$idparticipante=isset($_POST["idparticipante"])? limpiarCadena($_POST["idparticipante"]):"";
//Almacenar lo que tenemos en la variable sesion
$idpersonal=isset($_POST["idpersonal"])? limpiarCadena($_POST["idpersonal"]):"";


$fecha_hora=isset($_POST["fecha_horam"])? limpiarCadena($_POST["fecha_horam"]):"";
$tipo_persona=isset($_POST["tipo_persona"])? limpiarCadena($_POST["tipo_persona"]):"";
$cod_matricula = isset($_POST["cod_matriculam"])? limpiarCadena($_POST["cod_matriculam"]):""; 

$monto=isset($_POST["montom"])? limpiarCadena($_POST["montom"]):"";
$formato=isset($_POST["formatom"])? limpiarCadena($_POST["formatom"]):"";
$mediodepago=isset($_POST["mediodepagom"])? limpiarCadena($_POST["mediodepagom"]):"";
$noperacion=isset($_POST["noperacionm"])? limpiarCadena($_POST["noperacionm"]):"";
$qr=isset($_POST["qr"])? limpiarCadena($_POST["qr"]):"";

$formarecaudacion=isset($_POST["formarecaudacionm"])? limpiarCadena($_POST["formarecaudacionm"]):"";
$prioridad=isset($_POST["prioridadm"])? limpiarCadena($_POST["prioridadm"]):"";
$accesoaula=isset($_POST["accesoaula"])? limpiarCadena($_POST["accesoaula"]):"";
$observaciones=isset($_POST["obervacionesm"])? limpiarCadena($_POST["obervacionesm"]):"";

$idcurso1=isset($_POST["idcurso1"])? limpiarCadena($_POST["idcurso1"]):"";
$idmediospagos=isset($_POST["idmediospagos"])? limpiarCadena($_POST["idmediospagos"]):"";
$idforma_recaudacion=isset($_POST["idforma_recaudacion"])? limpiarCadena($_POST["idforma_recaudacion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':	
		// 	Guardar y  actualizar  	
		if (empty($idmatricula)){		
			$rspta=$compra->insertar($idpersonal,$fecha_hora,$cod_matricula,$idparticipante,$idcurso1,$qr,$monto,$formato,$idforma_recaudacion,$idmediospagos,$noperacion,$prioridad,$accesoaula,$observaciones);
			echo $rspta ? "" : "No Matricula";
			
		}
		else {
		}
			$rspta=$compra->editar($idmatricula,$idpersonal,$fecha_hora,$cod_matricula,$idparticipante,$idcurso1,$qr,$monto,$formato,$idforma_recaudacion,$idmediospagos,$noperacion,$prioridad,$accesoaula,$observaciones);
			echo $rspta ? "" : "No se pudieron registrar todos los datos de la Matricula";
			
	break;
			
	case 'enviar':
		$rspta=$compra->enviar($idmatricula);
 		echo $rspta ? "" : "Matricula no se envio";
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
		echo '<thead style="background-color:#a3e4d7 ">
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
				"0"=>$reg->fecha,
				"1"=>$reg->email,
				"2"=>$reg->participante,
				"3"=>$reg->cod_matricula,
				"4"=>$reg->nombre,
				"5"=>$reg->categoria,
				"6"=>$reg->n_horas,
 				"7"=>$reg->fecha_inicio,
				"8"=>$reg->ndocumento,
				"9"=>$reg->qr,
 				"10"=>$reg->formato,
				"11"=>$reg->monto,
 				"12"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
 	 				'<span class="badge bg-red">URGENTE</span>', 
				"13"=>($reg->enviodigital=='PENDIENTE')?'<span class="badge bg-yellow">PENDIENTE</span>':
 	 				'<span class="badge bg-green">ENTREGADO</span>',
				"14"=>($reg->accesoaula=='SI')?'<span class="badge bg-blue">SI</span>':
 	 				'<span class="badge bg-red">NO</span>',
				"15"=>($reg->estadoenvio=='ENVIADO')?'<span class="badge bg-green">ENVIADO</span>':
 	 				'<span class="badge bg-blue"> </span>',
				"16"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmatricula.')"><i class="fa fa-eye"></i></button>'.
					  ' <button class="btn btn-primary btn-xs" onclick="enviar('.$reg->idmatricula.')"><i class="fa fa-check"></i></button>':
					  			' '
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
	case 'selectParticipant':
			require_once "../modelos/Persona.php";
			$persona = new Persona();

			$rspta = $persona->listarp();
		
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->idpersona.'>'.$reg->nombre.'</option>';
				// echo '<#telefono value='.$reg->idpersona.'>'.$reg->telefono.'>';
				// echo '<#email value='.$reg->idpersona.'>'.$reg->email.'>';
				// echo '<#direccion value='.$reg->idpersona.'>'.$reg->direccion.'>';
			}
	break;
	
	case 'listarArticulos':
			require_once "../modelos/Curso.php";
			$producto=new  Curso();
				$rspta=$producto->listarActivos();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>$reg->cod_curso,
            "1"=>$reg->nombre,
            "2"=>$reg->tipo_curso,
            "3"=>$reg->n_curso,
            "4"=>$reg->observaciones,
            "5"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idcurso.',\''.$reg->cod_curso.'\',\''.$reg->nombre.'\',\''.$reg->tipo_curso.'\',\''.$reg->n_curso.'\')"><span class="fa fa-plus"></span></button>'

              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
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
