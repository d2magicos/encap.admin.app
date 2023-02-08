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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
  <section class="content-header">
            <br>
            <ol class="breadcrumb">      
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
              <li class="active">Administrar videos tutorial</li>    
            </ol>
        </section>
    <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border" >
            <h1 class="box-title" > Administrar videos tutorial </h1>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:18px"><i class="fa fa-plus"> Ingresar nuevo video tutorial</i>
        </button>
        <br><br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Nombre</th>
                <th>Descripción</th>
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
  <div class="modal-dialog" style="width: 1000px">
    <div class="modal-content">
      <!-- form -->
      <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">

        <div class="modal-header" style="background:#151e38; color:white">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" style="text-align: center; font-size: 20px"  >Formulario Video Tutorial</h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre del Video:</label>
            <div class="col-sm-10">
              <input type="hidden" name="idvtutorial" id="idvtutorial">
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del video tutorial" required>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Descripción:</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" name="descripcion" id="descripcion"  style="height:100px; " placeholder="Ingresar el Iframe tamaño : 380 x 320 " required></textarea>
            </div>
          </div>
          
        </div>

        <div class="modal-footer">
          <button type="button" onclick="cancelarform()" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar Video</button>
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
<script type="text/javascript" src="js/videotutorial.js"></script>
<?php 
}
ob_end_flush();
?>

