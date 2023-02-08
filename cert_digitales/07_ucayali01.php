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
  function SetCellMargin($margin){
    
    $this->cMargin = $margin;
}

}
ob_end_clean();

$pdf=new PDF('L','mm','A4');
$pdf->AddFont('Oswald','B','Oswald-Bold.php');
$pdf->AddPage();
$pdf->SetFont("Times","",20);
$pdf->setCellMargin(0);
$pdf->SetAutoPageBreak(TRUE, 0);
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
  $pdf->Image('./fpdf/img/'.$imagenbg,0,0,297,210);
}

$pdf->setY(62);
$pdf->setX(4);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(290,5,utf8_decode("Otorgado a:"),0,'C');


$nombre_part=$dCerti['nombrep'];

if(strlen($nombre_part)<=43){
  $pdf->setY(76);
  $pdf->setX(60);
  $pdf->SetFont('Oswald','B',25);  
  $pdf->MultiCell(180,5,utf8_decode($nombre_part),0,'C');

}else{
  $pdf->setY(76);
  $pdf->setX(60);
  $pdf->SetFont('Oswald','B',19);  
  $pdf->MultiCell(180,5,utf8_decode($nombre_part),0,'C');
}


$pdf->setY(89);
$pdf->setX(10);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(290,4,utf8_decode("En calidad de participante\n
durante ".strtolower($dCerti["horas"])." académicas, en el curso de:"),0,'C');

//FUNCION DE NOMBRE
$curso = $dCerti["nombrec"];
$str=strlen($curso);

$pdf->setY(108);
$pdf->setX(60);

if($str>=52 and $str<=80){
  $pdf->setX(25);
    $pdf->SetFont('Oswald','B',32); 
    $pdf->MultiCell(250,15,utf8_decode($curso),0,'C');
   
  };
  if($str>=81 and $str<=95){
    $pdf->setX(50);
    $pdf->SetFont('Oswald','B',28); 
    $pdf->MultiCell(200,15,utf8_decode($curso),0,'C');
   

  };
  if($str>=34 and $str<=51){
   
    $pdf->SetFont('Oswald','B',36); 
    $pdf->MultiCell(200,15,utf8_decode($curso),0,'C');
   
    };
    if($str>=20 and $str<=33){
      $pdf->SetFont('Oswald','B',44); 
      $pdf->MultiCell(180,16,utf8_decode($curso),0,'C');
     
      };

      if($str<=19){
        $pdf->SetFont('Oswald','B',50); 
        $pdf->MultiCell(180,30,utf8_decode($curso),0,'C');
       
        };
  if($str>=96 and $str<=144){
    $pdf->setY(103);
    $pdf->setX(50);
    $pdf->SetFont('Oswald','B',24); 
    $pdf->MultiCell(200,12,utf8_decode($curso),0,'C');
  
  

  };
  
  if ($str>=145) {
    $pdf->setY(105);
    $pdf->setX(45);
    $pdf->SetFont('Oswald','B',20); 
    $pdf->MultiCell(220,12,utf8_decode($curso),0,'C');
  }



 


$pdf->setY(144);
$pdf->setX(30);
$pdf->SetFont('Arial','',18);  

$pdf->MultiCell(250,5,utf8_decode($dCerti["fechac"]),0,'C');

$pdf->setY(152);
$pdf->setX(30);
$pdf->SetFont('Arial','',18);  
$sentence=utf8_decode($dCerti["context"]);
$wrapped = wordwrap($sentence, 53);
$wrapped=$sentence;
$pdf->MultiCell(250,8,$sentence,0,'C');


//Segunda Hoja

$pdf->AddPage();

if($imprimir=="digital" || $imprimir==null ){
  $pdf->Image('./fpdf/img/'.$imagenpostbg,0,0,297,210);
  }
$pdf->SetFont("Times","",20);
//$pdf->SetMargins(0,0,0,0);
$pdf->setCellMargin(0);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->SetFillColor(0,255,255);


include './qrcode/qrlib.php';
$text = "https://sistemas.encap.edu.pe/certificados/certificados.php?consultarid=".$dCerti['cod_matricula'];


$file = "./qrcode/img/qr1.png";
  

$ecc = 'H';
$pixel_size = 20;
$frame_size = 5;
  

QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
  




$pdf->setY(10);
$pdf->setX(15);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(95,5,utf8_decode("CÓDIGO DE REGISTRO: "),0,'L');

$pdf->setY(10);
$pdf->setX(58);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,$dCerti['cod_matricula'],0,'L');

$pdf->setY(15);
$pdf->setX(15);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(95,5,utf8_decode("AÑO: "),0,'L');

$pdf->setY(15);
$pdf->setX(30);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,$dCerti['año'],0,'L');

/*$pdf->setY(30);
$pdf->setX(20);
$pdf->SetFont('Oswald','B',36);  
$pdf->MultiCell(260,5,"TEMARIO",0,'C');

$pdf->setY(32);
$pdf->setX(20);
$pdf->SetFont('Oswald','B',36);  
$pdf->MultiCell(260,5,"__________",0,'C');*/

/*$pdf->setY(44);
$pdf->setX(20);
$pdf->SetFont('Arial','',13);  
$pdf->SetCellMargin(5);
$pdf->MultiCell(260,5,"\n".utf8_decode($dCerti['temario']."\n\n"),1,'L');

$pdf->setY(130);
$pdf->setX(70);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(95,5,utf8_decode($dCerti['docente']),0,'L');*/

//  Nota
if(!empty($dCerti['nota'])){
  $nota=$dCerti['nota'];
}else{
  $nota="";
}

$pdf->setY(20);
$pdf->setX(15);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,$nota,0,'L');

//  temario
$pdf->setY(44);
$pdf->setX(20);
$pdf->SetFont('Arial','',13);  
$pdf->SetCellMargin(5);
$pdf->MultiCell(260,5,"\n".utf8_decode($dCerti['temario']."\n\n"),1,'L');

$pdf->setY(190);
$pdf->setX(70);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(95,5,"DNI: ",0,'L');

$pdf->setY(190);
$pdf->setX(100);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(100,5,$dCerti['numdoc'],0,'L');

$pdf->setY(198);
$pdf->setX(70);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(40,5,"PARTICIPANTE: ",0,'L');

$pdf->setY(198);
$pdf->setX(100);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,utf8_decode($dCerti['nombrep']),0,'L');

$pdf->Image($file,10,155,50,50);


$pdf->Output(utf8_decode($dCerti['nombrep']).'.pdf','I');



