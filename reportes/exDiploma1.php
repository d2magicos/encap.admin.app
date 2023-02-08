<?php
//Activamos el almacenamiento en el buffer

use Dompdf\Css\Color;

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

    </head>
 
   
<?php


 //Obtenemos los datos de la cabecera de la venta actual
 require_once "../modelos/Gestionenvios.php";
 $compra= new Compra();
 $rsptav = $compra->impdip($_GET["id"]);
 //Recorremos todos los valores obtenidos
 $regv = $rsptav->fetch_object();


?>

<div class="zona_impresion" >
<!-- codigo imprimir -->

<br><br><br><br><br><br><br>

<div  style="padding:17px 0px 0px 842px; position:absolute; " >
    <br>
    <img  src="../files/modulodip2.png "  style="width: 245px; height:340px">
</div>
<br><b><br>


<table border="0" align="center" width="100%" style="padding:0px 85px 0px 0px;" >
    
    <tr>
        <td align="center" style="padding:16px 0px 0px 0px;  font-size:27px">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        <font >Otorgado a:</font>
        </td>
       
    </tr>
    
    <tr>
        <td align="center" style="font-family:Oswald; font-size:33px; padding:5px 0px 5px 0px; ">
            <strong><?php echo $regv->participante; ?></strong>
       </td>
    </tr> 
    
   
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center"  style="font-size:27px"><font >En calidad de participante</font></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center" style="font-size:27px"><font >durante <?php echo strtolower($regv->n_horas); ?> académicas en el curso de:</font></td>
    </tr>


    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center" style="font-family:Oswald;  padding:10px 140px 10px 120px; " >
        <strong ><b><?php $str =strlen($regv->nombre) ;
           // 7
           if($str>=50 and $str<=80){

            $cadena = $regv->nombre;
            $color = "#000000"; //lo mismo que antes
            echo "<p style=' padding:0px 0px 0px 0px; font-size:40px;line-height : 50px;'><font color='".$color."' >".$cadena."</font></p>"; 
     
          };
          if($str>=81 and $str<=95){

            $cadena = $regv->nombre;
            $color = "#000000"; //lo mismo que antes
            echo "<p style=' padding:0px 0px 0px 0px; font-size:38px;line-height : 50px;'><font color='".$color."' >".$cadena."</font></p>"; 
            
  
          };
          if($str<=49){

            $cadena = $regv->nombre;
            $color = "#000000"; //lo mismo que antes
            echo "<p style='font-size:50px;line-height : 60px;padding:8px 0px 8px 0px;'><font color='".$color."' >".$cadena."</font></p>"; 
          };
          if($str>=96){

            $cadena = $regv->nombre;
            $color = "#000000"; //lo mismo que antes
            echo "<p style='padding:0px 0px 0px 0px;font-size:35px;line-height : 40px;'><font color='".$color."' >".$cadena."</font></p>"; 
            
  
          };
            ?></b></strong>
        </td>
    </tr>

    <tr>
        <td align="center"  style="font-size:27px"><font><?php echo $regv->fecha_inicio;?></font>.</td>
    </tr>
    <tr>
      <td align="center"  style="padding:0px 120px 0px 80px;  font-size:27px; "><font ><?php echo $regv->contexto;?></font></td>
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

