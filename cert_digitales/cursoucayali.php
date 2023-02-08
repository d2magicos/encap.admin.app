<?php

require './fpdf/fpdf.php';

require_once "../configuraciones/datos.php";
require_once "../configuraciones/Conexion.php";
//$conexion=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);


$id = $_GET['id'];
$conexion->set_charset("utf8");
$sQuery=mysqli_query($conexion, "SELECT *,p.nombre AS nombrep,p.num_documento AS numdoc,m.nota as nota,m.contexto AS context,m.fecha_hora AS fecha,
c.nombre AS nombrec,m.fecha_inicio AS fechac,c.n_horas AS horas_old,m.horas AS horas,c.docente AS docente, m.año as año FROM matricula m 
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

$pdf=new PDF('L','mm',array(297,210));
//$pdf=new PDF('L','mm',array(283,191));
//$pdf=new PDF('L','mm','Letter');

$pdf->AddFont('Oswald','B','Oswald-Bold.php');
$pdf->AddPage();
$pdf->SetFont("Times","",20);
$pdf->SetMargins(0,0,0,0);
$pdf->SetFillColor(0,255,255);

$pdf->Image('./fpdf/img/UCAYALIAA.jpg',0,0,297,210);

//$pdf=new PDF('L','mm',array(251,166));
$pdf->setY(2);
$pdf->setX(5);

$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(200,5,"ID: ".utf8_decode($dCerti['cod_matricula']),0,'L');
 


$pdf->setY(60);
$pdf->setX(5);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(270,5,utf8_decode("Otorgado a:"),0,'C');


$nombre_part=$dCerti['nombrep'];

if(strlen($nombre_part)<=43){
  $pdf->setY(72);
  $pdf->setX(35);
  $pdf->SetFont('Oswald','B',22);  
  $pdf->MultiCell(220,5,utf8_decode($nombre_part),0,'C');

}else{
    $pdf->setY(72);
  $pdf->setX(35);
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

$pdf->setY(80);
$pdf->setX(53);
$pdf->SetFont('Arial','',20);  
$pdf->MultiCell(185,9,utf8_decode($horas),0,'C');

//FUNCION DE NOMBRE
$curso=$dCerti["nombrec"];

if($curso=="LINEAMIENTOS PARA LA VIGILANCIA DE LA SALUD DE LOS TRABAJADORES CON RIESGO DE EXPOSICIÓN A SARS-COV-2" && $dCerti['cod_matricula']=="6345-47802658"){
    $curso="LINEAMIENTOS PARA LA VIGILANCIA DE LA SALUD DE LOS TRABAJADORES CON RIESGO DE EXPOSICIÓN";
}


$str=strlen($curso);



$pdf->setY(100);
$pdf->setX(38);

if($str>=59 and $str<=80){
  $pdf->setX(35);
    $pdf->SetFont('Oswald','B',24); 
    $pdf->MultiCell(220,12,utf8_decode($curso),0,'C');
   
  };
  if($str>=81 and $str<=98){
    
    $pdf->setX(35);
    $pdf->SetFont('Oswald','B',22); 
    $pdf->MultiCell(220,12,utf8_decode($curso),0,'C');
   

  };
  if($str>=53 and $str<=58){
    $pdf->setX(35);
    $pdf->SetFont('Oswald','B',25); 
    $pdf->MultiCell(220,13,utf8_decode($curso),0,'C');
   
    };
    if($str>=45 and $str<=52){
      
      $pdf->setX(50);
      $pdf->SetFont('Oswald','B',27); 
      $pdf->MultiCell(180,13,utf8_decode($curso),0,'C');
     
      };

      if($str>=37 and $str<=44){
          $pdf->setY(107);
        $pdf->setX(35);
        $pdf->SetFont('Oswald','B',31); 
        $pdf->MultiCell(220,13,utf8_decode($curso),0,'C');
       
        };
        
         if( $str<=36){
          $pdf->setY(109);
        $pdf->setX(35);
        $pdf->SetFont('Oswald','B',38); 
        $pdf->MultiCell(220,13,utf8_decode($curso),0,'C');
       
        };
        
        if($str>=99 && $str<=117){
    $pdf->setY(98);
    $pdf->setX(35);
    $pdf->SetFont('Oswald','B',24); 
    $pdf->MultiCell(220,11,utf8_decode($curso),0,'C');
  
  

  };
  if($str>=118){
    $pdf->setY(101);
    $pdf->setX(26);
    $pdf->SetFont('Oswald','B',23); 
    $pdf->MultiCell(240,11,utf8_decode($curso),0,'C');
  
  

  };



 
$y=$pdf->GetY();

$pdf->setY($y+3);
$pdf->setX(11);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(270,5,utf8_decode($dCerti["fechac"]),0,'C');

$y=$pdf->GetY();
$pdf->setY($y+3);
$pdf->setX(36);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(220,8,utf8_decode($dCerti["context"]),0,'C');




//Segunda Hoja

$pdf->AddPage();

$pdf->Image('./fpdf/img/DIPLOMA B.jpg',0,0,297,210);
$pdf->SetFont("Times","",20);
$pdf->SetMargins(0,0,0,0);
//$pdf->setCellMargin(0);
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
$pdf->MultiCell(200,5,utf8_decode($dCerti['cod_matricula']),0,'L');

$pdf->setY(15);
$pdf->setX(15);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(95,5,utf8_decode("AÑO: "),0,'L');

$pdf->setY(15);
$pdf->setX(30);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,$dCerti['año'],0,'L');

if(!empty($dCerti['nota'])){
  $nota=$dCerti['nota'];
}else{
  $nota="";
}

$pdf->setY(20);
$pdf->setX(15);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,$nota,0,'L');

/*$pdf->setY(30);
$pdf->setX(20);
$pdf->SetFont('Oswald','B',36);  
$pdf->MultiCell(260,5,"TEMARIO",0,'C');

$pdf->setY(32);
$pdf->setX(20);
$pdf->SetFont('Oswald','B',36);  
$pdf->MultiCell(260,5,"__________",0,'C');*/

$pdf->setY(44);
$pdf->setX(20);
$pdf->SetFont('Arial','',13);  
$pdf->SetCellMargin(5);
$pdf->MultiCell(260,5,"\n".utf8_decode($dCerti['temario']."\n\n"),1,'L');

$y=$pdf->GetY();
$pdf->setY($y+5);
$pdf->setX(15);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(95,5,utf8_decode($dCerti['docente']."\n\n"),0,'L');


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

$pdf->setY(150);
$pdf->setX(8);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(200,5,"ID: ".utf8_decode($dCerti['cod_matricula']),0,'L');

$pdf->Image($file,10,155,50,50);



$pdf->Output(utf8_decode($nombre_part).'.pdf','D');



