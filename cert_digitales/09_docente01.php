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
FROM matricula_docentes m 
INNER JOIN docente p
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
    
  function WriteText($text)
  {
      $intPosIni = 0;
      $intPosFim = 0;
      if (strpos($text,'<')!==false && strpos($text,'[')!==false)
      {
          if (strpos($text,'<')<strpos($text,'['))
          {
              $this->Write(5,substr($text,0,strpos($text,'<')));
              $intPosIni = strpos($text,'<');
              $intPosFim = strpos($text,'>');
              $this->SetFont('','B');
              $this->Write(5,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
              $this->SetFont('','');
              $this->WriteText(substr($text,$intPosFim+1,strlen($text)));
          }
          else
          {
              $this->Write(5,substr($text,0,strpos($text,'[')));
              $intPosIni = strpos($text,'[');
              $intPosFim = strpos($text,']');
              $w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
              $this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'');
              $this->WriteText(substr($text,$intPosFim+1,strlen($text)));
          }
      }
      else
      {
          if (strpos($text,'<')!==false)
          {
              $this->Write(5,substr($text,0,strpos($text,'<')));
              $intPosIni = strpos($text,'<');
              $intPosFim = strpos($text,'>');
              $this->SetFont('','B');
              $this->WriteText(substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
              $this->SetFont('','');
              $this->WriteText(substr($text,$intPosFim+1,strlen($text)));
          }
          elseif (strpos($text,'[')!==false)
          {
              $this->Write(5,substr($text,0,strpos($text,'[')));
              $intPosIni = strpos($text,'[');
              $intPosFim = strpos($text,']');
              $w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
              $this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'');
              $this->WriteText(substr($text,$intPosFim+1,strlen($text)));
          }
          else
          {
              $this->Write(5,$text);
          }
  
      }
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

}

//echo $dPlant["imagen"];
$pdf->Image('./fpdf/img/'.$imagenbg,0,0,283,187);


//$pdf=new PDF('L','mm',array(251,166));

 


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
  
  $horas="En calidad de <ponente>, durante 2 horas lectivas\n\n                                                        en el curso de:";
  //$horas="En calidad de <ponente>, durante 2 horas lectivas en el curso de:";

  $pdf->setY(79);
$pdf->setX(67);
$pdf->SetFont('Arial','',20);  
$pdf->WriteText($horas);
//$pdf->MultiCell(160,9,utf8_decode($horas),0,'C');
}else{
 
  $horas=$dCerti["horas"];
  $pdf->setY(77);
$pdf->setX(63);
$pdf->SetFont('Arial','',20);  
$pdf->MultiCell(155,9,utf8_decode($horas),0,'C');
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



//FUNCION DE NOMBRE
$curso=$dCerti["nombrec"];
$str=strlen($curso);



$pdf->setY(97);
$pdf->setX(38);

if($str>=60 and $str<=80){
  $pdf->setX(32);
    $pdf->SetFont('Oswald','B',24); 
    $pdf->MultiCell(220,12,utf8_decode($curso),0,'C');
   
  };
  if($str>=81 and $str<=98){
    
    $pdf->setX(32);
    $pdf->SetFont('Oswald','B',22); 
    $pdf->MultiCell(220,12,utf8_decode($curso),0,'C');
   

  };
  if($str>=53 and $str<=59){
    $pdf->setX(45);
    $pdf->SetFont('Oswald','B',25); 
    $pdf->MultiCell(190,13,utf8_decode($curso),0,'C');
   
    };
    if($str>=45 and $str<=52){
      
      $pdf->setX(50);
      $pdf->SetFont('Oswald','B',27); 
      $pdf->MultiCell(180,13,utf8_decode($curso),0,'C');
     
      };

      if($str>=37 and $str<=44){
          $pdf->setY(102);
        $pdf->setX(32);
        $pdf->SetFont('Oswald','B',31); 
        $pdf->MultiCell(220,13,utf8_decode($curso),0,'C');
       
        };
        
         if( $str<=36){
          $pdf->setY(102);
        $pdf->setX(32);
        $pdf->SetFont('Oswald','B',38); 
        $pdf->MultiCell(220,13,utf8_decode($curso),0,'C');
       
        };
        
        if($str>=99 && $str<=117){
    $pdf->setY(98);
    $pdf->setX(32);
    $pdf->SetFont('Oswald','B',24); 
    $pdf->MultiCell(220,11,utf8_decode($curso),0,'C');
  
  

  };
  if($str>=118){
    $pdf->setY(98);
    $pdf->setX(32);
    $pdf->SetFont('Oswald','B',20); 
    $pdf->MultiCell(220,11,utf8_decode($curso),0,'C');
  
  

  };



 
$y=$pdf->GetY();

$pdf->setY($y+3);
$pdf->setX(5);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(270,5,utf8_decode($dCerti["fechac"]),0,'C');

$y=$pdf->GetY();
$pdf->setY($y+3);
$pdf->setX(30);
$pdf->SetFont('Arial','',18);  
$pdf->MultiCell(220,8,utf8_decode($dCerti["context"]),0,'C');





include './qrcode/qrlib.php';
$text = "https://sistemas.encap.edu.pe/certificados/certificados2-docente.php?docente=".$dCerti['cod_matricula'];


$file = "./qrcode/img/qr1.png";
  

$ecc = 'H';
$pixel_size = 20;
$frame_size = 5;
  

QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
  


$pdf->Image($file,26,30,25,25);

$y=$pdf->GetY();
$pdf->setY(59);
$pdf->setX(12);
$pdf->SetFont('Arial','',9);  
$pdf->MultiCell(53,8,utf8_decode($dCerti["cod_matricula"]),0,'C');


$pdf->setY(56);
$pdf->setX(12);
$pdf->SetFont('Arial','',9);  
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(53,4,utf8_decode("Código de matricula:"),0,'C');

$pdf->setY(68);
$pdf->setX(12);
$pdf->SetFont('Arial','',10);  
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(53,4,utf8_decode("Puedes verificar\n la autenticidad\n del certificado en:"),0,'C');

$y=$pdf->GetY();
$pdf->setY($y+1);
$pdf->setX(20);
$pdf->SetFont('Arial','',9);  
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(40,4,utf8_decode("www.sistemas.encap.edu.pe/certificados/"),0,'C');
$y=$pdf->GetY();
/*$pdf->SetDrawColor(255,255,255);
$pdf->Line(15, $y, 62, $y);*/

$pdf->Output($id.'-'.utf8_decode($nombre_part).'.pdf','I');



