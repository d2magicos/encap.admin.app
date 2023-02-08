<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar modo impresion del curso corto';
}
else
{
if ($_SESSION['envios']==1)

{
  ?>
    <html>
    <head>
   
    <link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
    <link href="qrcode/index.html">
    </head>
    <body onload="createQrCode(); ">
   
<?php

//Incluímos el archivo Factura.php <body onload="window.print();">
//require('Factura.php');

//Establecemos los datos de la empresa
$fondo="firma.png";
$ext_logo="png";

$fondo2="pie.png";
$ext_logo2="png";
 


 //Obtenemos los datos de la cabecera de la venta actual
 require_once "../modelos/Gestionenvios.php";
 $compra= new Compra();
 $rsptav = $compra->ventacabecera($_GET["id"]);
 //Recorremos todos los valores obtenidos
 $regv = $rsptav->fetch_object();


?>

<div class="zona_impresion">
<!-- codigo imprimir -->
<!-- Mostramos los detalles de la venta en el documento HTML -->
<script type="text/javascript" src="../certificados/qrcode/qrcode.js"></script>

<input type="hidden" id="valor" value="<?php echo $regv->qr; ?>" >
<!-- <button onClick="createQrCode()">Gerar QR Code</button> -->

  <script>
    
    function createQrCode()
    {
        var userInput = document.getElementById('valor').value;
        userInput= userInput.replace("https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=","");
        console.log(userInput.length);
        var qrcode = new QRCode("qrcode", {
            text: userInput.padEnd(220),
            width: 180,
            height: 180,
            colorDark: "black",
            colorLight: "white",
            correctLevel : QRCode.CorrectLevel.H
        });
        
    }
    
    </script>
    
<table border="0" align="center" >
   
    <!-- Mostramos los totales de la venta en el documento HTML -->
    <td>&nbsp;</td> <td>&nbsp;</td>
    <div align="left" style="padding:40px 0px 8px 10px; position:absolute;  " id="qrcode">
    </div>
    <strong align="left" style="padding:270px 0px 0px 0px; position:absolute; width:550px; "><font size="2"><?php echo $regv->docente; ?></font></strong>
    <strong align="left" style="padding:250px 0px 0px 0px; position:absolute; width:550px; "><font size="2"><?php echo "ID: ".$regv->cod_matricula; ?></font></strong>
    <tr>
      <td colspan="3" style="padding:15px 130px 8px 0px; font-size: 13px;"><b>&nbsp;PARTICIPANTE:</b>&nbsp;&nbsp; <?php  echo $regv->participante;  ?></td>
    </tr>    
    <tr>
      <td colspan="8" style="padding:0px 130px 8px 0px; font-size: 13px;"><b>&nbsp;DNI:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $regv->num_documento;  ?></td>
    </tr>   
    <tr>
      <td colspan="3" style="padding:0px 130px 8px 0px; font-size: 13px;"><b>&nbsp;CÓDIGO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $regv->cod_matricula;  ?></td>
    </tr>
    <tr>
      <td colspan="3" style="padding:0px 130px 8px 0px; font-size: 13px;"><b>&nbsp;AÑO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $regv->año;  ?></td>
    </tr>
    <tr>
      <td colspan="3" style="padding:0px 130px 8px 0px; font-size: 13px;">&nbsp;<?php echo $regv->nota;  ?></td>
    </tr>   

  

</table>
 
<br><br><br><br>

<div style="padding: 80px 0px 8px 0px; text-align: center; " >
  <br>
 <!-- <img  src="../files/sellosencap.png"  style="width: 120px; height:120px">-->
    <img  src="../files/Sello2022.png"  style="width: 170px; height:153px">
  
</div>
<br><br><br><br><br>

<table border="0" align="left" style="padding:0px 0px 8px 0px">
  <tr>
    <td style="padding:10px 0px 8px 40px; font-size:13px"><b>VALIDACIÓN DE CERTIFICADOS</b></td>    
  </tr>
  <tr style="padding:0px 0px 8px 0px" >
    <td style="padding:0px 0px 8px 10px; border: 2px solid #060606; width: 300px; margin: 120px; border-radius: 10px; text-align:center; font-size:13px;"> Verifica la validez de este documento en: <br>  <b>  www.sistemas.encap.edu.pe/certificados </b></td>  
    <td style="padding:10px 0px 8px 80px"><br><b>www.encap.edu.pe</b></td>
  </tr>
  
</table>



<br>
</div>
</body>
</html>

 <?php
}
else
{
  echo 'No tiene permiso para visualizar el modo impresion';
}

}
ob_end_flush();
?>

<script type="text/javascript" src="qrcode.js"></script>
