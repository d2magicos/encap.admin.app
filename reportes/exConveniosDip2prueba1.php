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
    <link href="qrcode/index.html">
    </head>
    <body onload="createQrCode(); ">
   
<?php

 //Obtenemos los datos de la cabecera de la venta actual
 require_once "../modelos/Gestionenvios.php";
 $compra= new Compra();
 $rsptav = $compra->impdip($_GET["id"]);
 //Recorremos todos los valores obtenidos
 $regv = $rsptav->fetch_object();

?>

<div class="zona_impresion">
<!-- codigo imprimir -->
<!-- Mostramos los detalles de la venta en el documento HTML -->
<script type="text/javascript" src="qrcode/qrcode.js"></script>

<input type="hidden" id="valor" value="<?php echo $regv->qr; ?>" >
<!-- <button onClick="createQrCode()">Gerar QR Code</button> -->

  <script>
    
    function createQrCode()
    {
        var userInput = document.getElementById('valor').value;

        var qrcode = new QRCode("qrcode", {
            text: userInput,
            width: 170,
            height: 170,
            colorDark: "black",
            colorLight: "white",
            correctLevel : QRCode.CorrectLevel.H
        });
        
    }
    
    </script>

<!-- <p align="left" style="padding:10px 0px 8px 10px;   font-size: 14px; position:absolute;  ">CÓDIGO DE REGISTRO:<b> <?php echo $regv->cod_matricula;  ?></b></p>
<p align="left" style="padding:35px 0px 0px 10px;   font-size: 14px; position:absolute; ">AÑO: <b><?php echo $regv->año;  ?></b> </p>   
<p align="left" style="padding:60px 0px 0px 10px;   font-size: 14px; position:absolute; "><?php echo $regv->nota;  ?></p>  -->  
<br><br><br><br>
<br><br><br><br>


<!-- <table border="0" align="center" width="100%" >
    
    <tr>
      <td align="center" style="font-family:Oswald; font-size:40px; text-decoration:underline; padding:10px 0px 0px 0px;   ">
            <strong>TEMARIO</strong>
      </td>
       
    </tr>
    <div align="center" style="padding:20px 0px 0px 145px; position:absolute; ">
    <br>
    <img  src="../files/fondoencap.png "  >
    </div>
    
</table>

<table style="position: absolute;padding:10px 60px 0px 60px;">
<tr >
        <td >
                
          <p style="padding: 15px 15px 15px 15px; border: 2px solid #060606; width: 930px;  text-align:left; font-size:11px;"> <?php echo str_replace("\n", "<br>", $regv->temario)?></p>
          <p style="font-size: 14px;"><?php echo $regv->docente; ?> </p>
          
        </td>
    </tr>
</table> -->

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<div style="padding: 95px 0px 0px 770; position:absolute;" >
    <p style="padding:0px 0px 0px 75px; font-size:13px;"><b>VALIDACIÓN DE CERTIFICADOS</b></p>
    <p style="padding:10px 0px 10px 10px; border: 2px solid #060606; width: 300px; border-radius: 10px; text-align:center; font-size:13px;"> Verifica la validez de este documento en: <br>  <b>  www.sistemas.encap.edu.pe/certificados </b></p>
    
    <p style="padding:5px 0px 0px 40px"><b>Página Web: www.encap.edu.pe</b></p>
</div>


<table border="0" align="left" style="padding:0px 0px 8px 30px">
  <div align="left" style="padding:60px 0px 8px 25px; position:absolute;  " id="qrcode"></div>
  
  <div align="center" style="padding:20px 0px 50px 500px; position:absolute; ">
  <br>
  <img  src="../files/firma.png "  style="width: 185px; height:160px">
  </div>


    <tr>
        <td align="left" style=" font-size:15px; padding:195px 0px 0px 190px">
            <p>DNI: <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $regv->num_documento; ?></b><br>NOMBRE: &nbsp;&nbsp;<b><?php echo $regv->participante; ?></b></p>
        </td>
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
