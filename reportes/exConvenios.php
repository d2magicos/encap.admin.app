<?php
//Activamos el almacenamiento en el buffer

//use Dompdf\Css\Color;

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

    </head>

   
<?php

 //Obtenemos los datos de la cabecera de la venta actual
 require_once "../modelos/Gestionenvios.php";
 $compra= new Compra();
 $rsptav = $compra->ventacabecera($_GET["id"]);
 //Recorremos todos los valores obtenidos
 $regv = $rsptav->fetch_object();

?>
<style>


</style>

<div class="zona_impresion">
<!-- codigo imprimir -->
<h1 align="left" style="padding:10px 0px 8px 40px; position:absolute;  font-size: 10px;  "><?php echo $regv->cod_matricula;  ?></h1>
<img src="../files/cip.png" width="150px" legth="130px" align="left" style=" position:absolute; padding: 35px 0px 0px 0px;" >   
<br><br><br><br><br><br><br><br><br>
<table border="0" align="center" width="100%" >
    <tr>
        <td align="center"  >
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        <font size="5">Otorgado a:</font>
        </td>
       
    </tr>
    
    <tr>
        <td align="center" style="font-family:Oswald; font-size:33px; ">
            <strong><?php echo $regv->participante; ?></strong>
       </td>
    </tr> 
    
   
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center"><font size="5">En calidad de participante</font></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center"><font size="5">durante <?php echo strtolower($regv->n_horas); ?> académicas en el curso de:</font></td>
    </tr>


    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td align="center" style="font-family:Oswald;  padding:6px 55px 6px 55px; " >
        <strong ><b><?php $str =strlen($regv->nombre) ;
           // 7
            if($str>=50 and $str<=80){

              $cadena = $regv->nombre;
              $color = "#000000"; //lo mismo que antes
              echo "<p style=' padding:0px 0px 0px 0px; font-size:35px;line-height : 42px;'><font color='".$color."' >".$cadena."</font></p>"; 
       
            };
            if($str>=81 and $str<=95){

              $cadena = $regv->nombre;
              $color = "#000000"; //lo mismo que antes
              echo "<p style=' padding:0px 0px 0px 0px; font-size:35px;line-height : 40px;'><font color='".$color."' >".$cadena."</font></p>"; 
              
    
            };
            if($str<=49){

              $cadena = $regv->nombre;
              $color = "#000000"; //lo mismo que antes
              echo "<p style='font-size:40px;line-height : 50px;padding:2px 120px 2px 120px;'><font color='".$color."' >".$cadena."</font></p>"; 
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
        <td align="center"><font size="5"><?php echo $regv->fecha_inicio;?>.</font></td>
    </tr>
    <tr>
      <td align="center"  style="padding:0px 40px 0px 70px;"><font size="5"><?php echo $regv->contexto;?></font></td>
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

