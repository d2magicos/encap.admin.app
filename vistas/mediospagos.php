<?php
ob_start();
session_start();
//si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"]))
{
  header("Location: login.html");
}
else
{
require 'modulos/header.php';
//Usuario revisa el contenido
if ($_SESSION['configuracion']==1)
{
?>
<!--Contenido-->
<div class="content-wrapper">
  <section class="content">
  <section class="content-header">
            <br>
            <ol class="breadcrumb">      
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
              <li class="active">Administrar medios de pagos</li>    
            </ol>
        </section>
    <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border" >
            <h1 class="box-title" > Administrar medios de pagos </h1>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
              </button>
              <button class="btn btn-box-tool" data-widget="remove">
              <i class="fa fa-times"></i>
              </button>
            </div>

        </div>
      </div>

      <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:18px" ><i class="fa fa-plus"> Crear Nuevo Medio de Pago</i>
        </button>
        <!-- <a href="../reportes/rptmediospagos.php" target="_blank"><button class="btn btn-danger"><i class="fa fa-file"></i> Reporte</button></a> -->
        <br><br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Medios de Pagos </th>
                <th>Estado</th>
                <th>Acciones</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Medios de Pagos </th>
                <th>Estado</th>
                <th>Acciones</th>
              </tfoot>
            </table>
      </div>
    </div>
  </section>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <!-- form -->
      <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">

        <div class="modal-header" style="background:#151e38; color:white">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" style="text-align: center; font-size: 20px">Formulario Medio de Pago</h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Medio de Pago:</label>
            <div class="col-sm-8">
              <input type="hidden" name="idmediospagos" id="idmediospagos">
              <input type="text" class="form-control" name="nombre1" id="nombre1" maxlength="50" placeholder="Nombre del medio de pago" required>
            </div>
          </div>
          
        </div>
        <div class="text-center" style="color: #c0392b"><p><spam style="color: #c0392b ; font-size: 18px">*</spam> INGRESE NOMBRE CON MAYUSCULA</p></div>

        <div class="modal-footer">
          <button type="button" onclick="cancelarform()" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </form>        
    </div>
  </div>
</div>  
<!-- Fin modal -->
<?php
}
else
{
  require 'notieneacceso.php';
}
require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/mediospagos.js"></script>
<?php 
}
ob_end_flush();
?>


