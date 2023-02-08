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
require_once "../modelos/Consultas.php";
$consulta=new Consultas();

switch ($_GET["op"]){	


//  -----------------------------------------   VISTA INICIO  ---------------------------------------------- //
//=============================================================================================================
//* SESSION **MATRICULA
/// Lista de matriculas pendiente digital
case 'listadpendienteenviodigitalpersonal':
	$idpersonal=$_REQUEST["idpersonal"];	
	$rspta=$consulta->listadpendienteenviodigitalpersonal($idpersonal);	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->cod_matricula,
			"2"=>$reg->participante,
			"3"=>$reg->num_documento,
			"4"=>$reg->telefono,
			"5"=>$reg->nombre,
			"6"=>$reg->categoria,
			"7"=>$reg->fecha_inicio,
			"8"=>$reg->formato,
			"9"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
			'<span class="badge bg-red">URGENTE</span>', 
			"10"=>($reg->enviodigital=='ENTREGADO')?'<span class="badge bg-green">ENTREGADO</span>':
					'<span class="badge bg-yellow">PENDIENTE</span>', 
			"11"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;

/// lista de envios en estado en proceso de envio
case 'listapendienteenviosfisicospersonal':
	$idpersonal=$_REQUEST["idpersonal"];
	$rspta=$consulta->listapendienteenviosfisicospersonal($idpersonal);	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->cod_matricula,
			"2"=>$reg->participante,
			"3"=>$reg->num_documento,
			"4"=>$reg->telefono,
			"5"=>$reg->nombre,
			"6"=>$reg->categoria,
			"7"=>$reg->lugarenvio,
		//	"7"=>$reg->formato,
		//	"7"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
		//	'<span class="badge bg-red">URGENTE</span>', 
			"8"=>($reg->estado=='ENVÍO EN PROCESO')?'<span class="badge bg-yellow">ENVÍO EN PROCESO</span>':
					'<span class="badge bg-green">ENVIO COMPLETADO</span>', 
			"9"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;

/// lista de reclamos en estado pendiente
case 'listareclamospendientespersonal':
	$idpersonal=$_REQUEST["idpersonal"];
	$rspta=$consulta->listareclamospendientespersonal($idpersonal);	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->cod_matricula,
			"2"=>$reg->participante,
			"3"=>$reg->num_documento,
			"4"=>$reg->telefono,
			"5"=>$reg->nombre,
			"6"=>$reg->categoria,
			"7"=>$reg->fecha_inicio,
			"8"=>$reg->asunto,
			"9"=>$reg->descripcion,
			"10"=>($reg->estado=='POR RESOLVER')?'<span class="badge bg-yellow">POR RESOLVER</span>':
					'<span class="badge bg-green">RESUELTO</span>', 
			"11"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;

/// lista de satisfaccion del cliente 
case 'listasatisfaccionclientepersonal':
	$idpersonal=$_REQUEST["idpersonal"];
	$rspta=$consulta->listasatisfaccionclientepersonal($idpersonal);	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->cod_matricula,
			"2"=>$reg->participante,
			"3"=>$reg->num_documento,
			"4"=>$reg->telefono,
			"5"=>$reg->nombre,
			"6"=>$reg->categoria,
			"7"=>$reg->fecha_inicio,
			"8"=>($reg->satisfacion==' PENDIENTE')?'<span class="badge bg-yellow">PENDIENTE</span>':
					'<span class="badge bg-green">RESUELTO</span>',
			"9"=>$reg->observaciones, 
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;

// lista de cumpleaños por asesor
case 'listadocumpleañospersonal':
	$fecha=$_REQUEST["fecha"];
	$idpersonal=$_REQUEST["idpersonal"];

	$rspta=$consulta->listadocumpleañospersonal($fecha,$idpersonal);	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->nombre,
			"1"=>$reg->num_documento,
			"2"=>$reg->telefono,
			"3"=>$reg->telefono2,
			"4"=>$reg->fecha_cumple
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;



//* SESSION **ENVIOS
/// LISTA DE PENDIENTES FISICOS
case 'listapendienteenviosgeneral':
	$rspta=$consulta->listapendienteenviosgeneral();	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->cod_matricula,
			"2"=>$reg->participante,
			"3"=>$reg->num_documento,
			"4"=>$reg->telefono,
			"5"=>$reg->nombre,
			"6"=>$reg->categoria,
			"7"=>$reg->lugarenvio,
		//	"7"=>$reg->formato,
		//	"7"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
		//	'<span class="badge bg-red">URGENTE</span>', 
			"8"=>($reg->estado=='ENVÍO EN PROCESO')?'<span class="badge bg-yellow">ENVÍO EN PROCESO</span>':
					'<span class="badge bg-green">ENVIO COMPLETADO</span>', 
			"9"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;


//* SESSION **GENERAL
/// LISTA DE CUMPLEAÑOS DE ACTUAL 
case 'listarcumpleaños':
	$fecha=$_REQUEST["fecha"];
	$rspta=$consulta->listarcumpleaños($fecha);
	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->personal,
			"1"=>$reg->nombre,
			"2"=>$reg->num_documento,
			"3"=>$reg->telefono,
			"4"=>$reg->telefono2,
			"5"=>$reg->fecha_cumple
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;


/// Lista de matriculas pendiente digital general
case 'listadpendienteenviodigitalgeneral':	
	$rspta=$consulta->listadpendienteenviodigitalgeneral();	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->personal,
			"2"=>$reg->cod_matricula,
			"3"=>$reg->participante,
			"4"=>$reg->num_documento,
			"5"=>$reg->telefono,
			"6"=>$reg->nombre,
			"7"=>$reg->categoria,
			"8"=>$reg->fecha_inicio,
			"9"=>$reg->formato,
			"10"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
			'<span class="badge bg-red">URGENTE</span>', 
			"11"=>($reg->enviodigital=='ENTREGADO')?'<span class="badge bg-green">ENTREGADO</span>':
					'<span class="badge bg-yellow">PENDIENTE</span>', 
			"12"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;

/// lista de envios en estado en proceso de envio
case 'listapendienteenviosfisicosgeneral':
	$rspta=$consulta->listapendienteenviosfisicosgeneral();	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->personal,
			"2"=>$reg->cod_matricula,
			"3"=>$reg->participante,
			"4"=>$reg->num_documento,
			"5"=>$reg->telefono,
			"6"=>$reg->nombre,
			"7"=>$reg->categoria,
			"8"=>$reg->lugarenvio,
		//	"7"=>$reg->formato,
		//	"7"=>($reg->prioridad=='NORMAL')?'<span class="badge bg-blue">NORMAL</span>':
		//	'<span class="badge bg-red">URGENTE</span>', 
			"9"=>($reg->estado=='ENVÍO EN PROCESO')?'<span class="badge bg-yellow">ENVÍO EN PROCESO</span>':
					'<span class="badge bg-green">ENVIO COMPLETADO</span>',
			"10"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;

/// lista de reclamos en estado pendiente
case 'listareclamospendientesgeneral':
	$rspta=$consulta->listareclamospendientesgeneral();	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->personal,
			"2"=>$reg->cod_matricula,
			"3"=>$reg->participante,
			"4"=>$reg->num_documento,
			"5"=>$reg->telefono,
			"6"=>$reg->nombre,
			"7"=>$reg->categoria,
			"8"=>$reg->fecha_inicio,
			"9"=>$reg->asunto,
			"10"=>$reg->descripcion,
			"11"=>($reg->estado=='POR RESOLVER')?'<span class="badge bg-yellow">POR RESOLVER</span>':
					'<span class="badge bg-green">RESUELTO</span>', 
			"12"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;


/// lista de satisfaccion del cliente 
case 'listasatisfaccionclientegeneral':
	$rspta=$consulta->listasatisfaccionclientegeneral();	
	$data= Array();
	while ($reg=$rspta->fetch_object()){
		$data[]=array(
			"0"=>$reg->fecha,
			"1"=>$reg->cod_matricula,
			"2"=>$reg->participante,
			"3"=>$reg->num_documento,
			"4"=>$reg->telefono,
			"5"=>$reg->nombre,
			"6"=>$reg->categoria,
			"7"=>$reg->fecha_inicio,
			"8"=>($reg->satisfacion==' PENDIENTE')?'<span class="badge bg-yellow">PENDIENTE</span>':
					'<span class="badge bg-green">RESUELTO</span>', 
			"9"=>$reg->observaciones,
			);
	}
	$results = array(
		"sEcho"=>1, //Información para el datatables
		"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		"aaData"=>$data);
	echo json_encode($results);
break;



//  -----------------------------------------   REPORTE GENERAL  ---------------------------------------------- //
//================================================================================================================

///   LISTA VENTAS TOTAL ULTIMOS 15 DIAS /// 
		case 'listarventasultimos15dias':
			$rspta=$consulta->listaventasultimos_10dias();
			//Vamos a declarar un array
			$data= Array();

			while ($reg=$rspta->fetch_object()){
				$data[]=array(
				"0"=>$reg->fecha,
				"1"=>$reg->total,	
					);
			}
			$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
		break;

///   LISTA VENTAS TOTAL ENCAP POR MES    /// 
		case 'listaventatotalencap':
			$rspta=$consulta->listaventatotalencap();
				//Vamos a declarar un array
			$data= Array();

			while ($reg=$rspta->fetch_object()){
				$data[]=array(
				"0"=>$reg->fecha,
				"1"=>$reg->total,	
				);
			}
				$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
				echo json_encode($results);
		break;

///   LISTA VENTAS MONTO POR FORMATOS    /// 
		case 'listadoventasformatosmonto':
			$rspta=$consulta->listadoventasformatosmonto();
			//Vamos a declarar un array
			$data= Array();

			while ($reg=$rspta->fetch_object()){
				$data[]=array(
				"0"=>$reg->fecha,
				"1"=>$reg->formato,	
				"2"=>$reg->total,	
					);
			}
			$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
		break;

	///   LISTA VENTAS CANTIDAD POR FORMATOS    /// 
		case 'listadoventasformatoscantidad':
			$rspta=$consulta->listadoventasformatoscantidad();
			//Vamos a declarar un array
			$data= Array();

			while ($reg=$rspta->fetch_object()){
				$data[]=array(
					"0"=>$reg->fecha,
					"1"=>$reg->formato,	
					"2"=>$reg->cantidad,	
					);
			}
			$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
		break;

		///   LISTA MEDIOS DE TRAFICO    /// 
		case 'listadomediospagos':
			$rspta=$consulta->listadomediospagos();
				//Vamos a declarar un array
			$data= Array();
	
			while ($reg=$rspta->fetch_object()){
				$data[]=array(
					"0"=>$reg->fecha,
					"1"=>$reg->nombre,
					"2"=>$reg->cantidad,	
					);
			}
			$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
		break;

			///   LISTA ESTADO DE VENTAS    /// 
		case 'listadoestadoventas':
			$rspta=$consulta->ventasanulados();
			//Vamos a declarar un array
			$data= Array();

			while ($reg=$rspta->fetch_object()){
				$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad,	
					);
			}
			$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
		break;



//  -----------------------------------------  REPORTE DETALLADOS DE ENCAP  ---------------------------------------------- //
//==========================================================================================================================

///   LISTA VENTAS TOTAL ULTIMOS 15 DIAS /// 
		case 'ventamontototal':
		    $fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
			
			$rspta=$consulta->ventamontototal($fecha_inicio,$fecha_fin);
			//Vamos a declarar un array
			$data= Array();

			while ($reg=$rspta->fetch_object()){
				$data[]=array(
				"0"=>$reg->monto,	
					);
			}
			$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
		break;
		
// LISTA VENTA CATEGORIA MONTO POR MES
		case 'listacategoriaventasasesor':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listacategoriaventasasesor($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->personal,
					"1"=>$reg->categoria,
					"2"=>$reg->cantidad,
					"3"=>$reg->monto,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;
		
		// GRAFICA VENTA CATEGORIA MONTO POR MES
		case 'categoriaventasasesor':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->categoriaventasasesor($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				"0"=>$reg->personal,
				"1"=>$reg->categoria,
				"2"=>$reg->cantidad,
				"3"=>$reg->monto,
			   );
		   }
			 echo json_encode($data);
	    break;

		// LISTA VENTA MONTO POR MES
		case 'listamontoventaspormes':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listamontoventaspormes($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->personal,
					"1"=>$reg->formato,
					"2"=>$reg->cantidad,
					"3"=>$reg->monto,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// LISTA VENTA MONTO TOTAL POR MES Y ASESOR 
		case 'listamontototalventaspormes':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listamontototalventaspormes($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->personal,
					"1"=>$reg->monto,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;
		
		// MONTO VENTAS X MES Y ASESOR //
		case 'montoventaspormes':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->montoventaspormes($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->personal,
				   "1"=>$reg->monto
			   );
		   }
			 echo json_encode($data);
	    break;
 
		// LISTA CATEGORIAS  monto
		case 'listamontoCategoria':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listamontoCategoria($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->categoria,
					"1"=>$reg->monto,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// GRAFICO CATEGORIAS monto
		case 'categoriasmonto':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];
		   $rspta=$consulta->categoriasmonto($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				"0"=>$reg->categoria,
				"1"=>$reg->monto,
			   );
		   }
			 echo json_encode($data);
	   break;

	   	// LISTA CATEGORIAS cantidad
		case 'listacantidadCategoria':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listacantidadCategoria($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->categoria,
					"1"=>$reg->formato,
					"2"=>$reg->cantidad,

						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// GRAFICO CATEGORIAS cantidad
	   case 'categoriascantidad':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];
		$rspta=$consulta->categoriascantidad($fecha_inicio,$fecha_fin);	
		$data = Array();
		while	($reg =$rspta ->fetch_object()){
			$data[]=array(
				"0"=>$reg->categoria,
				"1"=>$reg->formato,
				"2"=>$reg->cantidad,
			);
		}
			echo json_encode($data);
   		break;


		// LISTA MEDIOS DE PAGOS
		case 'listamediosdepagos':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listamediosdepagos($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad, 		
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		//GRAFICO MEDIOS DE PAGOS
		case 'mediospagos':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->mediospagosfechas($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->cantidad
			   );
		   }
			 echo json_encode($data);
	    break;

	   	// LISTA formas de recaudacion cantidad
		   case 'ListaformaRecaudacion':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->formaderecaudacion($fecha_inicio,$fecha_fin);
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
						"0"=>$reg->nombre,
						"1"=>$reg->cantidad
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

	   // Grafico Forma de Recaudacion cantidad
	   case 'formaderecaudacion':
				$fecha_inicio=$_POST["fecha_inicio"];
				$fecha_fin=$_POST["fecha_fin"];

			$rspta=$consulta->formaderecaudacion($fecha_inicio,$fecha_fin);	
			$data = Array();
			while	($reg =$rspta ->fetch_object()){
				$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad
				);
			}
			echo json_encode($data);
   		break;

	   	// Lista medios de traficos cantidad
		   case 'ListamediosTrafico':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->mediostrafico($fecha_inicio,$fecha_fin);
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
						"0"=>$reg->nombre,
						"1"=>$reg->cantidad
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// Grafico medios de traficos cantidad
		case 'mediostrafico':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->mediostrafico($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->cantidad
			   );
		   }
			 echo json_encode($data);
	   break;

	   	// LISTA estado de ventas cantidad
		   case 'listaestadoventas':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->estadoventas($fecha_inicio,$fecha_fin);
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
						"0"=>$reg->nombre,
						"1"=>$reg->cantidad
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// Grafico estado de ventas  cantidad
		case 'estadoventas':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->estadoventas($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->cantidad
			   );
		   }
			 echo json_encode($data);
	   break;
  

	   // Ciudades mas vendidos por formatos
	   case 'listamas':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		$rspta=$consulta->ciudadesmasvendidos($fecha_inicio,$fecha_fin);	
		$data = Array();
			while	($reg =$rspta ->fetch_object()){
				$data[]=array(
					"0"=>$reg->departamento,
					"1"=>$reg->n
				);
			}
			echo json_encode($data);
		break;

		// Ciudades mas vendidos por formatos
		case 'ciudadesmasvendidos':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		$rspta=$consulta->ciudadesmasvendidos($fecha_inicio,$fecha_fin);	
		$data = Array();
			while	($reg =$rspta ->fetch_object()){
				$data[]=array(
					"0"=>$reg->departamento,
					"1"=>$reg->n
				);
			}
			echo json_encode($data);
		break;

	 // lista de cursos mas vendidos
		case 'listacursos':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listacursos($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->categoria,
					"2"=>$reg->cantidad, 		
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;
	
		// lista de diplomas mas vendidos
		case 'listadiplomas':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listadiplomas($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->categoria,
					"2"=>$reg->cantidad, 		
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;
	
		// lista de diplomas de especialización mas vendidos
		case 'listadiplomasesp':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listadiplomasesp($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->categoria,
					"2"=>$reg->cantidad, 		
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// lista de ciudades mas vendidos	
		case 'listadepartamentos':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listadepartamentos($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();
	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->departamento,
					"1"=>$reg->cantidad,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;



//  -------------------------------   REPORTE DETALLADO ENVÍOS ENCAP   ------------------------------------- //
//============================================================================================================

		//  ENVÍOS SEGUN TIPO - LISTA
		case 'listanenviosseguntipo':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listanenviosseguntipo($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad,
					"2"=>$reg->monto, 		
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// ENVÍOS SEGUN TIPO - GRAFICO
		case 'enviosseguntipo':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->enviosseguntipo($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->monto
			   );
		   }
			 echo json_encode($data);
	    break;

		// ENVÍOS POR COURIER  - LISTA
		case 'listaenvioscourier':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listaenvioscourier($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad,
					"2"=>$reg->monto, 		
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		//ENVÍOS POR COURIER  - GRAFICO
		case 'envioscourier':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->envioscourier($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->monto
			   );
		   }
			 echo json_encode($data);
	    break;

		//  ENVÍOS PRINCIPALES CIUDADES  - LISTA
		case 'listaciudadesenvios':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listaciudadesenvios($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad,
					"2"=>$reg->monto, 		
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		//ENVÍOS PRINCIPALES CIUDADES  - GRAFICO
		case 'cuidadesenvios':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->cuidadesenvios($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->monto
			   );
		   }
			 echo json_encode($data);
	    break;


//  -------------------------------   REPORTE DETALLADO RECLAMOS ENCAP   ------------------------------------- //
//============================================================================================================

		//  RECLAMOS ASUNTO - CANTIDAD - LISTA
		case 'listareclamoporasunto':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listareclamoporasunto($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		//RECLAMOS ASUNTO - CANTIDAD - GRAFICO
		case 'graficoreclamoporasunto':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->listareclamoporasunto($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->cantidad
			   );
		   }
			 echo json_encode($data);
	    break;

		//  RECLAMOS SUB ASUNTO - CANTIDAD - LISTA
		case 'listareclamosubcategoria':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listareclamosubcategoria($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->asunto,
					"1"=>$reg->nombre,
					"2"=>$reg->cantidad,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		//RECLAMOS SUB ASUNTO - CANTIDAD - GRAFICO
		case 'graficoreclamosubcategoria':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->graficoreclamosubcategoria($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->cantidad
			   );
		   }
			 echo json_encode($data);
	    break;


//  -------------------------------   REPORTE DETALLADO SATISFACCIÓN ENCAP   ------------------------------------- //
//============================================================================================================

		//  SATISFACCION DEL CLIENTE - LISTA
		case 'listasatisfaccion':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
	
			$rspta=$consulta->listasatisfaccion($fecha_inicio,$fecha_fin);
				//Vamos a declarar un array
				$data= Array();	
				while ($reg=$rspta->fetch_object()){
					$data[]=array(
					"0"=>$reg->nombre,
					"1"=>$reg->cantidad,	
						);
				}
				$results = array(
					"sEcho"=>1, //Información para el datatables
					"iTotalRecords"=>count($data), //enviamos el total registros al datatable
					"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					"aaData"=>$data);
				echo json_encode($results);
		break;

		// SATISFACCION DEL CLIENTE - GRAFICO
		case 'graficosatisfaccion':
			$fecha_inicio=$_POST["fecha_inicio"];
			$fecha_fin=$_POST["fecha_fin"];

		   $rspta=$consulta->listasatisfaccion($fecha_inicio,$fecha_fin);	
		   $data = Array();
		   while	($reg =$rspta ->fetch_object()){
			   $data[]=array(
				   "0"=>$reg->nombre,
				   "1"=>$reg->cantidad
			   );
		   }
			 echo json_encode($data);
	    break;

//  -------------------------------   REPORTE DE PARTICIPANTES   ------------------------------------- //
//============================================================================================================
        case 'listaparticipantesxcurso':
			$fecha_inicio = $_GET["fecha_inicio"];
			$fecha_fin = $_GET["fecha_fin"];

			/*  */
			$rspta = $consulta->listaparticipantes($fecha_inicio, $fecha_fin);

			$data = Array();

			while($reg = $rspta->fetch_object()) {
				$data[] = array(
					"0" => $reg->num_documento,
					"1" => $reg->nombre,
					"2" => $reg->fecha_hora,
					"3" => $reg->curso_corto,
					"4" => $reg->diploma,
					"5" => $reg->diploma_esp,
					"6" => $reg->curso_house,
					"7" => $reg->convenios
				);
			}

			$results = array(
				"sEcho" => 1,								// Información para el datatables
				"iTotalRecords" => count($data), 			// enviamos el total registros al datatable
				"iTotalDisplayRecords" => count($data), 	// enviamos el total registros a visualizar
				"aaData" => $data);

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