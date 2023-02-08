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
m.imagen AS imagen,m.imagenposterior AS imagenposterior,m.imagenf AS imagenf,m.imagenposteriorf AS imagenposteriorf
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

class PDF extends FPDF {
    
    function SetCellMargin($margin) {
        $this->cMargin = $margin;
    }
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
  $sQuery2=mysqli_query($conexion, "SELECT *,c1.imagen as imagen,c1.imagenposterior as imagenposterior,
  c1.imagenf as imagenf,c1.imagenposteriorf as imagenposteriorf  FROM certificados c1

  WHERE   c1.idcategoria=$categoria AND '$fecham'>=c1.fecha_inicio AND '$fecham'<=c1.fecha_fin" );
  
  
  $dPlant=mysqli_fetch_array($sQuery2, MYSQLI_ASSOC);

  $imagenbg=$dPlant["imagen"];
  $imagenpostbg=$dPlant["imagenposterior"];

  $imagenbgf=$dPlant["imagenf"];
  $imagenpostbgf=$dPlant["imagenposteriorf"];
}else{
  $imagenbg=$dCerti["imagen"];
  $imagenpostbg=$dCerti["imagenposterior"];

  $imagenbgf=$dCerti["imagenf"];
  $imagenpostbgf=$dCerti["imagenposteriorf"];
}

//echo $dPlant["imagen"];
if($imprimir=="digital" || $imprimir==null){
  $pdf->Image('./fpdf/img/'.$imagenbg,0,0,283,187);
}else{
  $pdf->Image('./fpdf/img/'.$imagenbgf,0,0,283,187);
}


//$pdf=new PDF('L','mm',array(251,166));
$pdf->setY(2);
$pdf->setX(5);

$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(200,5,"ID: ".utf8_decode($dCerti['cod_matricula']),0,'L');
 


$pdf->setY(52);
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
  $horas="Por haber aprobado\n durante ".strtolower($dCerti["horas_old"])." académicas, en el curso de:";
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

$pdf->setY(77);
$pdf->setX(53);
$pdf->SetFont('Arial','',20);  
$pdf->MultiCell(185,9,utf8_decode($horas),0,'C');

//FUNCION DE NOMBRE
$curso=$dCerti["nombrec"];
$str=strlen($curso);



$pdf->setY(97);
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
          $pdf->setY(102);
        $pdf->setX(35);
        $pdf->SetFont('Oswald','B',31); 
        $pdf->MultiCell(220,13,utf8_decode($curso),0,'C');
       
        };
        
         if( $str<=36){
          $pdf->setY(104);
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
    $pdf->setY(98);
    $pdf->setX(35);
    $pdf->SetFont('Oswald','B',20); 
    $pdf->MultiCell(220,11,utf8_decode($curso),0,'C');
  
  

  };



 
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
  }else{
    $pdf->Image('./fpdf/img/'.$imagenpostbgf,0,0,283,187);
  }
$pdf->SetFont("Times","",20);
$pdf->SetMargins(0,0,0,0);
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

if (!empty($dCerti['nota'])) {
    $pdf->setY(20);
    $pdf->setX(15);
    $pdf->SetFont('Arial','',10);  
    $pdf->MultiCell(200,5,$dCerti['nota'],0,'L');
}

/* temario */

$pdf->setY(45);
$pdf->setX(20);
$pdf->SetFont('Arial','',13);  
$pdf->SetCellMargin(5);
$pdf->MultiCell(245,5,"\n".utf8_decode($dCerti['temario']."\n\n"),1,'L');

//$pdf->Image($file,12,5,60,60);

$pdf->setY(75);
$pdf->setX(20);
$pdf->SetFont('Arial','B',10);  
$pdf->MultiCell(200,5,$dCerti['docente'],0,'L');

/*$pdf->setY(50);
$pdf->setX(85);
$pdf->SetFont('Arial','',12);  
$pdf->MultiCell(200,5,$nota,0,'L');*/

$pdf->setY(163);
$pdf->setX(70);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(95,5,"DNI: ",0,'L');

$pdf->setY(163);
$pdf->setX(103);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(100,5,$dCerti['numdoc'],0,'L');

$pdf->setY(170);
$pdf->setX(70);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(95,5,"PARTICIPANTE: ",0,'L');

$pdf->setY(170);
$pdf->setX(103);
$pdf->SetFont('Arial','',10);  
$pdf->MultiCell(100,5,$dCerti['nombrep'],0,'L');

$pdf->Image($file,10,130,50,50);


$pdf->Output($id.'-'.utf8_decode($nombre_part).'.pdf','I');



