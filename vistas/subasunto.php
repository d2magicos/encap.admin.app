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
              <li class="active">Administrar sub categorias asuntos</li>    
            </ol>
        </section>
    <div class="panel panel-default" style="border-color:#666; border-width: 3px; border-style: double;">
          <div class="panel-heading">
            <div class="box-header with-border" >
                <h1 class="box-title" > Administrar sub categorias asuntos  </h1>
            </div> 
          </div>

      <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:16px" ><i class="fa fa-plus"> Crear Nuevo Sub Categoria Asunto</i>
        </button>
        <br><br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Sub categoria</th>
                <th>Asunto</th>
                <th>Estado</th>
                <th>Acciones</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Sub categoria</th>
                <th>Asunto</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tfoot>
            </table>
      </div>
    </div>
  </section>
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" style="height:800px;">
    <div class="modal-content">
      <!-- form -->
      <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">

        <div class="modal-header" style="background:#151e38; color:white">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title; text-center">Formulario sub categoria asunto</h4>
        </div>

        <div class="modal-body panel-body" style="padding: 20px; ">
         <div class="form-group">
            <label for="name" class="col-sm-3  control-label">Nombre sub categoria<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9">
              <input type="hidden" name="idsubasunto" id="idsubasunto">
              <textarea type="text" class="form-control" name="nombre" id="nombre" maxlength="250" placeholder="Nombre de la sub categoria" required></textarea>
            </div>           
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Tipo de asunto<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-9"> 
              <select id="idasunto" name="idasunto" class="form-control selectpicker" data-live-search="true" required></select>
            </div>       
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal" style="font-size:18px"><i class="fa fa-times"></i> Cerrar</button>
          <button class="btn btn-primary" type="submit" id="btnGuardar" style="font-size:18px"><i class="fa fa-save"></i> Guardar</button>
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
<script type="text/javascript" src="js/subasunto.js"></script>
<?php 
}
ob_end_flush();
?>