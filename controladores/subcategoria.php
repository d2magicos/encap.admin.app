<?php 

require_once "../modelos/Subcategoria.php";

$subcategoria=new Subcategoria();

$idcat=isset($_GET["id"])? limpiarCadena($_GET["id"]):"";
$idcat="2";
$data= Array();	
	
		$rspta=$subcategoria->listar($idcat);
 		//Vamos a declarar un array

 		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>$reg->id,
				"1"=>$reg->subcategoria
			);
           
 		}
 		

?>