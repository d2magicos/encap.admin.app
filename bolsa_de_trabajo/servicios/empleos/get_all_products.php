<?php
include("../../admin/configuraciones/Conexion.php");
$response=new stdClass();

//$datos=array();
$datos=[];
$i=0;
$sql="SELECT idempleo,nombre,empresa,ubicacion,nvacantes,renumeracion,experiencia,formacion,especializacion,conocimiento,competencia,detalle,destacado,replace(nombre,' ','_') as nombree,
CONCAT(DAY( fechainicio),'-', MONTH(fechainicio),'-', YEAR(fechainicio)) AS fechainicio, CONCAT(DAY( fechafin),'-', MONTH(fechafin),'-', YEAR(fechafin)) AS fechafin 
FROM empleos WHERE condicion=1 ORDER BY idempleo DESC";

$result=mysqli_query($conexion,$sql);
while($row=mysqli_fetch_array($result)){
	$obj=new stdClass();
	$obj->codpro=$row['idempleo'];
	$obj->idempleo=$row['idempleo'];
	$obj->nompro=$row['nombre'];
	$obj->empresa=$row['empresa'];
	$obj->ubicacion=$row['ubicacion'];
	$obj->nvacantes=$row['nvacantes'];
	$obj->renumeracion=$row['renumeracion'];
	$obj->experiencia=$row['experiencia'];
	$obj->formacion=$row['formacion'];
	$obj->especializacion=$row['especializacion'];
	$obj->conocimiento=$row['conocimiento'];
	$obj->competencia=$row['competencia'];
	$obj->detalle=$row['detalle'];
	$obj->destacado=$row['destacado'];

	$obj->fechainicio=$row['fechainicio'];
	$obj->fechafin=$row['fechafin'];	
	$datos[$i]=$obj;
	$i++;
}
$response->datos=$datos;

mysqli_close($conexion);
header('Content-Type: application/json');
echo json_encode($response);
