<?php

require './fpdf/fpdf.php';

require_once "../configuraciones/datos.php";
require_once "../configuraciones/Conexion.php";
//$conexion=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);


$id = $_GET['id'];
$conexion->set_charset("utf8");
$sQuery=mysqli_query($conexion, "SELECT *,p.nombre AS nombrep,p.num_documento AS numdoc,m.nota AS nota,m.contexto AS context,
c.nombre AS nombrec,m.fecha_inicio AS fechac,c.docente AS docente,c.n_horas AS horas_old,m.horas AS horas,c.temario AS temario, m.año as año FROM matricula m 
INNER JOIN persona p
ON m.idparticipante=p.idpersona 
INNER JOIN cursos c 
ON m.idcurso= c.idcurso
WHERE cod_matricula='$id' ");
$dCerti=mysqli_fetch_array($sQuery, MYSQLI_ASSOC);

if($dCerti==null){
    echo "Error al mostrar la pagina";
    return false;
}

class PDF extends FPDF{
    
  function SetCellMargin($margin){
    
    $this->cMargin = $margin;
}

}
ob_end_clean();

//$pdf=new PDF('L','mm',array(283,187));
$pdf=new PDF('L','mm',array(283,191));
//$pdf=new PDF('L','mm','Letter');
//$pdf = new FPDF('P','mm','letter');

$pdf->AddFont('Oswald','B','Oswald-Bold.php');
$pdf->AddPage();
$pdf->SetFont("Times","",20);
$pdf->SetMargins(0,0,0,0);
$pdf->SetFillColor(0,255,255);


//$pdf->Image('./fpdf/img/DIPLOMA_FISICO.jpg',0,0,283,187);

$pdf->Image('./fpdf/img/DIPLOMA_FISICO_BACK.jpg',0,0,283,187);
//$pdf=new PDF('L','mm',array(251,166));
$pdf->setY(102);
$pdf->setX(8);

$pdf->SetFont('Arial','B',8);  
$pdf->MultiCell(30,25,utf8_decode("Cód: ").utf8_decode($dCerti['cod_matricula']),0,'C');
 


$pdf->setY(60);
$pdf->setX(0);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(270,5,utf8_decode("Otorgado a:"),0,'C');

$y=$pdf->GetY();

$nombre_part=$dCerti['nombrep'];

if(strlen($nombre_part)<=43){
  $pdf->setY($y+7);
  $pdf->setX(55);
  $pdf->SetFont('Oswald','B',24);  
  $pdf->MultiCell(180,7,utf8_decode($nombre_part),0,'C');

}else{
  $pdf->setY($y+7);
    $pdf->setX(55);
  $pdf->SetFont('Oswald','B',18);  
  $pdf->MultiCell(180,7,utf8_decode($nombre_part),0,'C');
}


$y=$pdf->GetY();
if(strlen($dCerti["horas"])<10){
  $horas="Por haber culminado con éxito durante ".utf8_decode($dCerti["horas_old"]).", en el curso de: ";
}else{
 
  $horas=$dCerti["horas"];
}


include './qrcode/qrlib.php';
$text = "https://sistemas.escaeperu.com/certificados/certificados.php?consultarid=".$dCerti['cod_matricula'];


$file = "./qrcode/img/qr1.png";
  

$ecc = 'H';
$pixel_size = 20;
$frame_size = 5;
  

QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
  


$pdf->Image($file,8,80,30,30);


//$horas=$dCerti["horas"];

/*$array=explode(" ",$horas);

$i=0;
foreach($array as $palabra){
 

  $horas.=$palabra." ";
  $i++;
}

echo  $horas;*/

//$horas="En calidad de participante\n durante 60 horas académicas, en el curso de:";



$pdf->setY($y+2);
$pdf->setX(55);
$pdf->SetFont('Arial','',16);  
$pdf->MultiCell(180,8,utf8_decode($horas),0,'C');
 
$y=$pdf->GetY();

$pdf->setY($y+3);
$pdf->setX(45);
$pdf->SetFont('Oswald','B',24);  
$pdf->MultiCell(190,12,"\" ".utf8_decode($dCerti["nombrec"])." \"",0,'C');

$y=$pdf->GetY();

$pdf->setY($y);
$pdf->setX(45);
$pdf->SetFont('Arial','',16);  
$pdf->MultiCell(205,8,utf8_decode("El mismo que se desarrolló en el periodo comprendido desde el ").utf8_decode($dCerti["fechac"]).", ".utf8_decode($dCerti["context"]),0,'L');

$y=$pdf->GetY();
$pdf->setY($y-3);
$pdf->setX(38);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(205,8,utf8_decode("Código: ").utf8_decode($dCerti['cod_matricula']),0,'R');



//Segunda Hoja
$pdf->AddPage();
$pdf->Image('./fpdf/img/CERTIFICADO B3.jpg',0,0,283,187);
$pdf->SetFont("Times","",20);
$pdf->SetMargins(0,0,0,0);
$pdf->SetFillColor(0,255,255);




$pdf->setY(15);
$pdf->setX(10);
$pdf->SetFont('Arial','B',12);  
$pdf->MultiCell(95,5,utf8_decode("CÓDIGO DE CERTIFICADO: "),0,'L');

$pdf->setY(15);
$pdf->setX(68);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['cod_matricula']),0,'L');

$pdf->setY(22);
$pdf->setX(10);
$pdf->SetFont('Arial','B',12);  
$pdf->MultiCell(95,5,"NOMBRE: ",0,'L');

$pdf->setY(22);
$pdf->setX(32);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['nombrep']),0,'L');

$pdf->setY(29);
$pdf->setX(10);
$pdf->SetFont('Arial','B',12);  
$pdf->MultiCell(95,5,utf8_decode("DNI: "),0,'L');

$pdf->setY(29);
$pdf->setX(20);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['numdoc']),0,'L');


$pdf->setY(40);
$pdf->setX(28);
$pdf->SetFont('Arial','B',14);  
$pdf->MultiCell(220,5,"TEMARIO:",0,'L');

$pdf->setY(48);
$pdf->setX(30);
$pdf->SetFont('Arial','',13);  
$pdf->SetCellMargin(5);
$pdf->MultiCell(220,5,"\n".utf8_decode($dCerti['temario']."\n\n"),1,'L');

$y=$pdf->GetY();

$pdf->setY($y+2);
$pdf->setX(25);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['docente']),0,'L');

$y=$pdf->GetY();

$pdf->setY($y+2);
$pdf->setX(25);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['nota']),0,'L');


$pdf->Output($id.'-'.utf8_decode($nombre_part).'.pdf','I');



