<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el modo de impresion';
}
else
{
if ($_SESSION['envios']==1)
{

//Incluímos el archivo Factura.php
require('Factura.php');

//Establecemos los datos de la empresa
$fondo="logofac.png";
$ext_logo="png";

$logo2 = "qr.png";
$ext_logo2 = "png";
$empresa="COMUNICACIONES UNIVERSO";



//Obtenemos los datos de la cabecera de la venta actual
require_once "../modelos/Gestionenvios.php";
$compra= new Compra();
$rsptav = $compra->ventacabecera($_GET["id"]);
//Recorremos todos los valores obtenidos
$regv = $rsptav->fetch_object();

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'L', 'mm', 'A5' );
$pdf->AddPage();

//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
$pdf->addClientAdresse(utf8_decode("\n". $regv->participante));
$pdf->addCursoAdresse(utf8_decode("\n". $regv->nombre));
$pdf->addFechaAdresse(utf8_decode("\n". $regv->fecha_inicio));
$pdf->addPartAdresse(utf8_decode("\n". $regv->participante));

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta

//Convertimos el total en letras
$pdf->Output();

}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>