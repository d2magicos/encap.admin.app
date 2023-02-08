<?php
ob_start();
session_start();

require_once "../modelos/Consultas.php";
$consulta = new Consultas();  

$idpersonal=$_SESSION["idpersonal"];
ini_set('date.timezone','America/Lima');  
$fecha = date('d/m'); 

//si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"]))
{
  header("Location: login.html");
}
else
{
require 'modulos/header.php';
//Usuario revisa el contenido
if ($_SESSION['inicio']==1)
{

?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">  
        <div class="row">
          <div class="col-md-2 col-lg-3 col-xs-12">
            <div style="background: #FFF;padding: 10px">
              <img style="width:400px; height: auto;  padding: 5px" src="../files/HB1.jpeg">
              <input type="hidden" class="form-control" id="idpersonal" value="<?php echo $_SESSION["idpersonal"]; ?>" >
              <input type="hidden" class="form-control" id="fecha" value="<?php ini_set('date.timezone','America/Lima');  $fecha = date('d/m');  echo $fecha;?>" >
            </div>
          </div>

          <div class="col-md-10 col-lg-9 col-xs-12">
              <div class="box box-primary">
                  <div class="box-body">                                        
                    <div class="modal-header" style="background:#151e38; color:white">
                        <h4 class="modal-title text-center">Lista de cumpleaños del dia  <?php ini_set('date.timezone','America/Lima');  $fecha = date(' d / m / Y');  echo $fecha;?> </h4>

                    </div>

                    <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
                      <table id="tbllistadocumpleañospersonal" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                            <thead>
                              <th>Nombre y Apellidos</th>
                              <th>Dni</th>
                              <th>Celular</th>
                              <th>Celular 2</th>
                              <th>fecha de cumpleaños</th>
                            </thead>
                            <tbody>                            
                            </tbody>
                            <tfoot>
                              <th>Nombre y Apellidos</th>
                              <th>Dni</th>
                              <th>Celular</th>
                              <th>Celular 2</th>
                              <th>fecha de cumpleaños</th>
                            </tfoot>
                          </table>
                    </div>
                  </div>
              </div>
          </div>
        </div>
    </section>
  </div>

<?php
}
else
{
  require 'notieneacceso.php';
}
require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/listacump.js"></script>
<?php 
}
ob_end_flush();
?>
