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
if ($_SESSION['compras']==1)
{
//Incluímos el archivo compra.php
require('Compra.php');

//Establecemos los datos de la empresa
$logo="logofac.png";
$ext_logo="png";

$logo2 = "qr.png";
$ext_logo2 = "png";
$empresa="COMUNICACIONES UNIVERSO";
$documento="RUC: 10445496834";
$direccion="Direccion: Jr. Los Incas 375-Satipo";
$telefono="Celular: +51 930 100 674";
$email="ventas@comuniverso.com";

//Obtenemos los datos de la cabecera de la venta actual
require_once "../modelos/Compra.php";
$compra= new Compra();
$rsptav = $compra->ingresocabecera($_GET["id"]);
//Recorremos todos los valores obtenidos
$regv = $rsptav->fetch_object();

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'L', 'mm', 'A5' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
$pdf->addSociete(utf8_decode($empresa),
                  utf8_decode("RUC: ").utf8_decode($documento)."\n" .
                  utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                  utf8_decode("Teléfono: ").$telefono."\n" .
                  "Email : ".$email,$logo,$ext_logo);
$pdf->fact_dev( "$regv->tipo_comprobante ", "$regv->serie_comprobante-$regv->num_comprobante" );
$pdf->temporaire( "" );
$pdf->addDate( $regv->fecha);

//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
$pdf->addClientAdresse(utf8_decode($regv->proveedor),"Domicilio: ".utf8_decode($regv->direccion),$regv->tipo_documento.": ".$regv->num_documento);

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta
$cols=array( "CODIGO"=>23,
             "DESCRIPCION"=>78,
             "CANTIDAD"=>22,
             "P.COMPRA."=>25,
             "P.VENTA."=>20,
             "SUBTOTAL"=>22);
$pdf->addCols( $cols);
$cols=array( "CODIGO"=>"C",
             "DESCRIPCION"=>"L",
             "CANTIDAD"=>"C",
             "P.COMPRA."=>"C",
             "P.VENTA." =>"C",
             "SUBTOTAL"=>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
$y= 66;

//Obtenemos todos los detalles de la venta actual
$rsptad = $compra->ingresodetalle($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "CODIGO"=> "$regd->codigo",
                "DESCRIPCION"=> utf8_decode("$regd->producto"),
                "CANTIDAD"=> "$regd->cantidad",
                "P.COMPRA."=> "$regd->precio_compra",
                "P.VENTA." => "$regd->precio_venta",
                "SUBTOTAL"=> "$regd->subtotal");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}

//Convertimos el total en letras
require_once "Letras.php";
$V=new EnLetras(); 
$con_letra=strtoupper($V->ValorEnLetras($regv->total_compra,"NUEVOS SOLES"));
$pdf->addCadreTVAs("---".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->impuesto, $regv->total_compra,"S/ ");
$pdf->addCadreEurosFrancs("IGV"." $regv->impuesto %");
$pdf->Output('Reporte de Venta','I');


}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>