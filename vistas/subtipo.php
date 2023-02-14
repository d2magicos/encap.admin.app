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
              <li class="active">Subtipos de cursos</li>    
            </ol>
        </section>
    <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border" >
            <h1 class="box-title"> Subtipos de cursos </h1>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:18px"><i class="fa fa-plus"> Crear nuevo Subtipo </i>
        </button>
        <br><br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>N°</th>
                <th>Subtipo de Curso</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>N°</th>
                <th>Subtipo de Curso</th>
                <th>Tipo</th>
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
          <h4 class="modal-title"  style="text-align: center; font-size: 20px" >Formulario Subtipo de Curso</h4>
        </div>

        <div class="modal-body">
          
        <div class="form-group">
              <label for="name" class="col-sm-3 control-label">Tipo:<spam style="color: #c0392b ; font-size: 18px">*</spam></label>
              <div class="col-sm-9">
                <!--<input type="text" style="display:none" class="form-control" name="idtipo" id="idcurso" maxlength="50"
                  placeholder="idtipo" required>-->
                <select id="tipo" name="tipo" class="form-control" required>
                  <option value="-1">Seleccione una categoría</option>
                </select>
              </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Subtipo de Curso<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9">
              <input type="hidden" name="id" id="id">
              <input type="text" class="form-control" name="nombre1" id="nombre1" maxlength="50" placeholder="Nombre del Subtipo de curso" required>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Descripción<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="50" placeholder="descripcion" required>
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
<script type="text/javascript" src="js/subtipo.js"></script>
<?php 
}
ob_end_flush();
?>

