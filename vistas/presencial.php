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
      
        <!-- Main content -->
        <section class="content">
        <section class="content-header">
            <br>
            <ol class="breadcrumb">      
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
              <li class="active">Administrar matriculas presenciales</li>    
            </ol>
        </section>
        <div class="panel panel-default" style="border-color:#666; border-width: 3px; border-style: double;">

          <div class="panel-heading">
        <div class="box-header with-border" >
            <h1 class="box-title" > Administrar matriculas presenciales </h1>
        </div> 
      </div>

      <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:16px" ><i class="fa fa-plus"> Crear Nueva Matricula</i>
        </button>&nbsp&nbsp
         <a href="cargamatriculas.html" target="_blank"><button class="btn btn-success" style="font-size:16px"><i class="fa fa-cloud-upload">  Cargar Masiva de matricula</i>
        </button></a>
        <br><br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Fecha</th>
                <th>Codigo</th>
                <th>Apellidos y Nombres</th>
                <th>DNI</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Cumpleaños</th>
                <th>Ciudad</th>
                <th>Departamento</th>
                <th>Curso</th>
                <th>Fecha Certificado</th>
                <th>Horas</th>
                <th>Codigo Curso</th>
                <th>N° Operacion</th>
                <th>Monto</th>
                <th>Forma de Pagos</th>
                <th>Asesor </th>
                <th>Observaciones</th>
                <th>Estado</th>
                <th>Acciones</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Fecha</th>
                <th>Codigo</th>
                <th>Apellidos y Nombres</th>
                <th>DNI</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Cumpleaños</th>
                <th>Ciudad</th>
                <th>Departamento</th>
                <th>Curso</th>
                <th>Fecha Certificado</th>
                <th>Horas</th>
                <th>Codigo Curso</th>
                <th>N° Operacion</th>
                <th>Monto</th>
                <th>Forma de Pagos</th>
                <th>Asesor </th>
                <th>Observaciones</th>
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
          <h4 class="modal-title; text-center">Formulario de Matricula</h4>
        </div>

        <div class="modal-body panel-body" style="padding: 20px; ">

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Fecha <spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <input type="date" class="form-control" name="fecha" id="fecha" maxlength="50" placeholder="Fecha de matricula" required>
            </div>

            <label for="name" class="col-sm-2 control-label">Código de Matricula <spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="codigo" id="codigo" maxlength="50" placeholder="Código de matricula" required>
            </div>            
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2  control-label">Apellidos y Nombres<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-10">
              <input type="hidden" name="idpresencial" id="idpresencial">
              <input type="text" class="form-control" name="nombres" id="nombres" maxlength="350" placeholder="Apellidos y Nombres" required>
            </div>           
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">DNI <spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <input type="text" class="form-control" name="dni" id="dni" maxlength="20" placeholder="Dni" required>
            </div>
            <label for="name" class="col-sm-2 control-label">Celular<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="celular" id="celular" maxlength="20" placeholder="Celular" required>
            </div>            
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Correo <spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <input type="text" class="form-control" name="correo" id="correo" maxlength="100" placeholder="Correo" >
            </div>
            <label for="name" class="col-sm-2 control-label">Cumpleaños<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="cumpleaños" id="cumpleaños" maxlength="15" placeholder="Cumpleaños" >
            </div>            
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Ciudad <spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="100" placeholder="Ciudad" >
            </div>
            <label for="name" class="col-sm-2 control-label">Departamento<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="departamento" id="departamento" maxlength="100" placeholder="Departamento" >
            </div>            
          </div>

          
          <div class="form-group">       
          <label for="name" class="col-sm-2 control-label">Nombre del Curso<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-10"> 
              <input type="text" class="form-control" name="curso" id="curso" maxlength="800" placeholder="Nombre del Cursoo" >
            </div>
          </div>

          <div class="form-group">       
          <label for="name" class="col-sm-2 control-label">Fecha del certificado<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-10"> 
              <input type="text" class="form-control" name="fecha_certificado" id="fecha_certificado" maxlength="200" placeholder="Fecha del certificado" >
            </div>
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Horas <spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <input type="text" class="form-control" name="horas" id="horas" maxlength="10" placeholder="Horas" >
            </div>
            <label for="name" class="col-sm-2 control-label">Codigo curso<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="codigo_curso" id="codigo_curso" maxlength="100" placeholder="Codigo curso" >
            </div>            
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Numero operación <spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <input type="text" class="form-control" name="n_operacion" id="n_operacion" maxlength="10" placeholder="N° operación" >
            </div>
            <label for="name" class="col-sm-2 control-label">Monto<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="monto" id="monto" maxlength="10" placeholder="Monto" >
            </div>            
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Forma de pagos <spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <input type="text" class="form-control" name="forma_pago" id="forma_pago" maxlength="10" placeholder="Forma de pagos" >
            </div>
            <label for="name" class="col-sm-2 control-label">Asesor<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="asesor" id="asesor" maxlength="150" placeholder="Asesor" >
            </div>            
          </div>
          
          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Observaciones: </label>
            <div class="col-sm-10"> 
              <textarea class="form-control" name="observacion" id="observacion" maxlength="200" placeholder="Observaciones"></textarea>
            </div>
          </div>
          
         </div>
         
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar Matricula</button>
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
<script type="text/javascript" src="js/presencial.js"></script>
<?php 
}
ob_end_flush();
?>