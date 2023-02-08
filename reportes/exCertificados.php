<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['envios']==1)

{
  ?>
    <html>
    <head>
   
    <link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
    <link href="../certificados/qrcode/index.html">
    </head>
    <body onload="createQrCode();">
   
<?php

//Incluímos el archivo Factura.php <body onload="window.print();">

 //Obtenemos los datos de la cabecera de la venta actual
 require_once "../modelos/Gestionenvios.php";
 $compra= new Compra();
 $rsptav = $compra->ventacabecera($_GET["id"]);
 //Recorremos todos los valores obtenidos
 $regv = $rsptav->fetch_object();

?>

<div class="zona_impresion">
<!-- codigo imprimir -->
<h1 align="left" style="padding:30px 0px 8px 0px; position:absolute; width: 500px; font-size: 10px;transform: rotate(-90deg) "><?php echo $regv->cod_matricula;  ?></h1>
   
<br><br><br><br><br><br><br><br><br>
<table border="0" align="center" width="100%" >
    <tr>
        <td align="center"  >
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        <font size="5">Otorgado a:</font>
        </td>
       
    </tr>
    
    <tr>
        <td align="center" style="font-family:Oswald; font-size:34px; padding:15px">
            <strong><?php echo $regv->participante; ?></strong>
       </td>
    </tr> 
    
   
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center"><font size="5"> calidad de participante</font></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center"><font size="5">durnate 60 horas académicas en el curso de:</font></td>
    </tr>

    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center" style="font-family:Oswald; font-size:42px; padding:8px 50px 8px 50px; line-height : 50px;" >
        <strong ><b><?php echo $regv->nombre; ?></b></strong>
        </td>
    </tr>

    <tr>
        <td align="center"><font size="5"><?php echo $regv->fecha_inicio.", organizado por "?></font></td>
    </tr>
    <tr>
    <td align="center"><font size="5">la Escuela Nacional de Capacitación y Actualización Profesinal.</font></td>
  </tr>    
</table>
<br><br><br><br><br><br><br><br><br>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<script type="text/javascript" src="../qrcode/qrcode.js"></script>

<input type="hidden" id="valor" value="<?php echo $regv->qr ?>" >
<!-- <button onClick="createQrCode()">Gerar QR Code</button> -->

  <script>
    
    function createQrCode()
    {
        var userInput = document.getElementById('valor').value;

        var qrcode = new QRCode("qrcode", {
            text: userInput,
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
    <div align="left" style="padding:40px 0px 8px 20px; position:absolute;  " id="qrcode"></div>
    <tr>
      <td style="padding:15px 0px 8px 0px; font-size: 13px;"><b>&nbsp;PARTICIPANTE:</b>&nbsp;&nbsp; <?php  echo $regv->participante;  ?></td>
    </tr>    
    <tr>
      <td style="padding:0px 0px 8px 0px; font-size: 13px;"><b>&nbsp;DNI:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $regv->num_documento;  ?></td>
    </tr>   
    <tr>
      <td style="padding:0px 0px 8px 0px; font-size: 13px;"><b>&nbsp;CÓDIGO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $regv->cod_matricula;  ?></td>
    </tr>
    <tr>
      <td style="padding:0px 0px 8px 0px; font-size: 13px;"><b>&nbsp;AÑO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2022</td>
    </tr>  
  
</table>
<div style="padding:100px 0px 8px 130px; text-align: center; " >
  <br>
  <img  src="../files/sello.png " >
</div>
<br><br><br><br><br><br><br>

<table border="0" align="left" style="padding:0px 0px 10px 10px">
  <tr>
    <td style="padding:10px 0px 8px 60px; font-size:13px"><b>VALIDACIÓN DE CERTIFICADOS</b></td>    
  </tr>
  <tr style="padding:0px 0px 8px 0px" >
    <td style="padding:0px 0px 8px 10px; border: 2px solid #060606; width: 300px; margin: 120px; border-radius: 10px; text-align:center; font-size:13px;"> Verifica la validez de este documento en: <br>  <b>  www.sistemas.encap.edu.pe/certificados </b></td>  
    <td style="padding:10px 0px 8px 120px"><br><b>www.encap.edu.pe</b></td>
  </tr>
  
</table>



<br>
</div>
</body>
</html>
<?php 


 ?>
 <?php

// //Mostramos el documento pdf
// $pdf->Output();

 ?>
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
<script>

  function createQrCode()
    {
        var userInput = $regv->qr.value;

        var qrcode = new QRCode("qrcode", {
            text: userInput,
            width: 100,
            height: 100,
            colorDark: "black",
            colorLight: "white",
            correctLevel : QRCode.CorrectLevel.H
        });
    }
    
</script>