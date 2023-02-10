<?php 
require_once "../modelos/Lecciones.php";

$lecciones=new Leccion();

$titulo=isset($_POST["lec_titulo"])? limpiarCadena($_POST["lec_titulo"]):"";
$html=isset($_POST["lec_html"])? limpiarCadena($_POST["lec_html"]):"";
$video=isset($_POST["video"])? limpiarCadena($_POST["video"]):"";
$duracion=isset($_POST["duracion"])? limpiarCadena($_POST["duracion"]):"";
$material=isset($_POST["material"])? limpiarCadena($_POST["material"]):"";
$examen=isset($_POST["examen"])? limpiarCadena($_POST["examen"]):"";
$idmodulo=isset($_POST["idcursom"])? limpiarCadena($_POST["idcursom"]):"";
$idc=isset($_POST["idc"])? limpiarCadena($_POST["idc"]):"";
$idleccion=isset($_POST["idleccion"])? limpiarCadena($_POST["idleccion"]):"";

$html=str_replace("\"",'\"',$html);

switch ($_GET["op"]){
case 'guardaryeditar':
		


		if (empty($idleccion)){
			$rspta=$lecciones->insertarLeccion($titulo,$idmodulo,$html,$video,$duracion,$material,$examen);
			echo $rspta ? "Leccion agregada" : "Leccion no se pudo agregar";
			
			echo mysqli_error($conexion);
		}
		else {
			$rspta=$lecciones->editarLeccion($idleccion,$titulo,$idmodulo,$html,$video,$duracion,$material,$examen);
			echo $rspta ? "Leccion actualizada" : "Leccion no se pudo actualizar";
			echo mysqli_error($conexion);
		}
	break;


	case 'eliminar':
		$rspta=$lecciones->eliminar($idleccion);
	
 		echo $rspta ? "Leccion eliminado" : "Leccion no se puede eliminar";
	break;


    case 'listar':
		$rspta=$lecciones->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
                "0"=>$reg->idlecciones,
				"1"=>$reg->nombre,
				"2"=>$reg->nombrec,
				"3"=>$reg->categoria,
 				"4"=>$reg->curso,
				"5"=>$reg->codigohtml,
				"6"=>$reg->duracion,
 				"7"=>'<button class="btn btn-info btn-xs" onclick="window.open(\''.$reg->link_video.'\',\'_blank\')">Ver video</button>',
 				"8"=>'<button class="btn btn-info btn-xs" onclick="window.open(\''.$reg->link_material.'\',\'_blank\')">Ver material</button>',
				"9"=>'<button class="btn btn-info btn-xs" onclick="window.open(\''.$reg->link_examen.'\',\'_blank\')">Ver examen</button>',
       
				"10"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idlecciones.')"><i class="fa fa-pencil"></i></button>'.
					
					' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idlecciones.')"><i class="fa fa-trash"></i></button>'
				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listarM2':


		$rspta=$lecciones->listarM($idmodulo);
		//echo $idc;
		 //Vamos a declarar un array
		 $data= "";
		 while ($reg=$rspta->fetch_object()){
			$data.="<option value='".$reg->idmodulo."'>".$reg->nombre."</option>";
			
		 }
		
		 echo $data;
 

break;


	case 'mostrar':
		$rspta=$lecciones->mostrar($idleccion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
}