<?php

require './fpdf/fpdf.php';

require_once "../configuraciones/datos.php";
require_once "../configuraciones/Conexion.php";
//$conexion=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);


$id = $_GET['id'];
$imprimir = $_GET['imprimir'];

$conexion->set_charset("utf8");
$sQuery=mysqli_query($conexion, "SELECT *,p.nombre AS nombrep,p.num_documento AS numdoc,m.nota AS nota,m.contexto AS context,
c.nombre AS nombrec,c.idcategoria AS categoria,m.fecha_inicio AS fechac,c.docente AS docente,c.n_horas AS horas_old,m.horas AS horas,c.temario AS temario, m.año as año,
m.imagen AS imagen,m.imagenposterior AS imagenposterior
FROM matricula m 
INNER JOIN persona p
ON m.idparticipante=p.idpersona 
INNER JOIN cursos c 
ON m.idcurso= c.idcurso
WHERE cod_matricula='$id'");
$dCerti=mysqli_fetch_array($sQuery, MYSQLI_ASSOC);

if($dCerti==null){
    echo "Error al mostrar la pagina";
    return false;
}

class PDF extends FPDF{
    


}
ob_end_clean();

$pdf=new PDF('L','mm',array(283,187));
//$pdf=new PDF('L','mm',array(283,191));
//$pdf=new PDF('L','mm','Letter');

$pdf->AddFont('Oswald','B','Oswald-Bold.php');
$pdf->AddPage();
$pdf->SetFont("Times","",20);
$pdf->SetMargins(0,0,0,0);
$pdf->SetFillColor(0,255,255);

$categoria=$dCerti["categoria"];
$fecham=$dCerti["fecha_hora"];
$fechaini=$dCerti["fecha_inicio"];

//echo $categoria;
//$pdf->Image('./fpdf/img/DIPLOMA A.jpg',0,0,297,210);

if(empty($dCerti["imagen"])){
  $sQuery2=mysqli_query($conexion, "SELECT *,c1.imagen as imagen,c1.imagenposterior as imagenposterior  FROM certificados c1

  WHERE   c1.idcategoria=$categoria AND '$fecham'>=c1.fecha_inicio AND '$fecham'<=c1.fecha_fin" );
  
  
  $dPlant=mysqli_fetch_array($sQuery2, MYSQLI_ASSOC);

  $imagenbg=$dPlant["imagen"];
  $imagenpostbg=$dPlant["imagenposterior"];
}else{
  $imagenbg=$dCerti["imagen"];
  $imagenpostbg=$dCerti["imagenposterior"];
}

//echo $dPlant["imagen"];
if($imprimir=="digital" || $imprimir==null){
  $pdf->Image('./fpdf/img/'.$imagenbg,0,0,283,187);
}


//$pdf=new PDF('L','mm',array(251,166));
$pdf->setY(2);
$pdf->setX(5);

$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(200,5,"ID: ".utf8_decode($dCerti['cod_matricula']),0,'L');
 


$pdf->setY(55);
$pdf->setX(0);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(270,5,utf8_decode("Otorgado a:"),0,'C');


$nombre_part=$dCerti['nombrep'];

if(strlen($nombre_part)<=43){
  $pdf->setY(67);
  $pdf->setX(30);
  $pdf->SetFont('Oswald','B',22);  
  $pdf->MultiCell(220,5,utf8_decode($nombre_part),0,'C');

}else{
    $pdf->setY(67);
    $pdf->setX(30);
  $pdf->SetFont('Oswald','B',18);  
  $pdf->MultiCell(220,5,utf8_decode($nombre_part),0,'C');
}

if(strlen($dCerti["horas"])<10){
  $horas="En calidad de participante durante ".strtolower($dCerti["horas_old"])." académicas, en el curso de:";
}else{
 
  $horas=$dCerti["horas"];
}
//$horas=$dCerti["horas"];

/*$array=explode(" ",$horas);

$i=0;
foreach($array as $palabra){
 

  $horas.=$palabra." ";
  $i++;
}

echo  $horas;*/

//$horas="En calidad de participante\n durante 60 horas académicas, en el curso de:";

$curso=$dCerti["nombrec"];
$str=strlen($curso);




$pdf->setY(77);
$pdf->setX(53);
$pdf->SetFont('Arial','',20);  
$pdf->MultiCell(185,9,utf8_decode($horas)." ".utf8_decode($curso),0,'C');

//FUNCION DE NOMBRE


 
$y=$pdf->GetY();

$pdf->setY($y+4);
$pdf->setX(8);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(270,5,utf8_decode($dCerti["fechac"]),0,'C');

$y=$pdf->GetY();
$pdf->setY($y+3);
$pdf->setX(33);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(220,8,utf8_decode($dCerti["context"]),0,'C');



//Segunda Hoja
$pdf->AddPage();
if($imprimir=="digital" || $imprimir==null ){
  $pdf->Image('./fpdf/img/'.$imagenpostbg,0,0,283,187);
  }
$pdf->SetFont("Times","",20);
$pdf->SetMargins(0,0,0,0);
$pdf->SetFillColor(0,255,255);


include './qrcode/qrlib.php';
$text = "https://sistemas.encap.edu.pe/certificados/certificados.php?consultarid=".$dCerti['cod_matricula'];


$file = "./qrcode/img/qr1.png";
  

$ecc = 'H';
$pixel_size = 20;
$frame_size = 5;
  

QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
  


$pdf->Image($file,12,5,60,60);



$pdf->setY(65);
$pdf->setX(15);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(200,5,"ID: ".utf8_decode($dCerti['cod_matricula']),0,'L');

$pdf->setY(70);
$pdf->setX(15);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(150,5,utf8_decode($dCerti['docente']),0,'L');

$pdf->setY(10);
$pdf->setX(85);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(95,5,"PARTICIPANTE: ",0,'L');

$pdf->setY(10);
$pdf->setX(118);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['nombrep']),0,'L');

$pdf->setY(20);
$pdf->setX(85);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(95,5,"DNI: ",0,'L');

$pdf->setY(20);
$pdf->setX(118);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,$dCerti['numdoc'],0,'L');

$pdf->setY(30);
$pdf->setX(85);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(95,5,utf8_decode("CÓDIGO: "),0,'L');

$pdf->setY(30);
$pdf->setX(118);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['cod_matricula']),0,'L');

$pdf->setY(40);
$pdf->setX(85);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(95,5,utf8_decode("AÑO: "),0,'L');

$pdf->setY(40);
$pdf->setX(118);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,$dCerti['año'],0,'L');

//Validacion de nota
if(!empty($dCerti['nota'])){
  $nota=$dCerti['nota'];
}else{
  $nota="";
}

$pdf->setY(50);
$pdf->setX(85);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(200,5,$nota,0,'L');



$pdf->Output($id.'-'.utf8_decode($nombre_part).'.pdf','I');



