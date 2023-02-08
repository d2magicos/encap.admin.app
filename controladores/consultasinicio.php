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

		case 'productosmasvendidos':
		$rspta=$consulta->productosmasvendidos();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				"1"=>$reg->categoria,
 				"2"=>$reg->cantidad
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

		break;

		case 'listarcumpleaños':

			$fecha=$_REQUEST["fecha"];

			$rspta=$consulta->listarcumpleaños($fecha);
			 //Vamos a declarar un array
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