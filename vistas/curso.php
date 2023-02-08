<?php
ob_start();
session_start();

//  si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"])) {
  header("Location: login.html");
} else {
  require 'modulos/header.php';
  //  Usuario revisa el contenido
  if ($_SESSION['cursos'] == 1) {
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
            <li class="active">Administrar nuestros cursos</li>
          </ol>
        </section>
        <div class="panel panel-default" style="border-color:#666; border-width: 3px; border-style: double;">

          <div class="panel-heading">
            <div class="box-header with-border">
              <h1 class="box-title"> Administrar nuestros cursos </h1>
            </div>
          </div>

          <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:16px"><i class="fa fa-plus"> Crear Nuevo Curso</i>
            </button>&nbsp&nbsp
            <a href="cargacurso.html" target="_blank"><button class="btn btn-success" style="font-size:16px"><i class="fa fa-cloud-upload"> Cargar Masiva de Cursos</i>
              </button></a>
            <br><br>
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Codigo Curso</th>
                <th>Nombre</th>
                <th>Tipo de Curso</th>
                <th>Sub tipo de Curso</th>
                <th>Horas</th>
                <th>Fecha Curso</th>
                <th>Docente</th>
                <th>Temario</th>
                <th>Contexto</th>
                <th>Observaciones</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Materiales</th>
                <th>Aula</th>

              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Codigo Curso</th>
                <th>Nombre</th>
                <th>Tipo de Curso</th>
                <th>Sub tipo de Curso</th>
                <th>Horas</th>
                <th>Fecha Curso</th>
                <th>Docente</th>
                <th>Temario</th>
                <th>Contexto</th>
                <th>Observaciones</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Materiales</th>
                <th>Aula</th>

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
              <h4 class="modal-title; text-center">Formulario del Curso</h4>
            </div>

            <div class="modal-body panel-body" style="padding: 20px; ">

              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Codigo del curso<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="cod_curso" id="cod_curso" maxlength="50" placeholder="Codigo del curso" readonly>
                </div>
              </div>

              <div class="form-group">
                <P class="text-center" style="color: red">Ejemplo: *ASISTENTE ADMINISTRATIVO EN LA GESTIÓN PÚBLICA*</P>
                <label for="name" class="col-sm-2  control-label">Nombre del curso<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                <div class="col-sm-10">
                  <input type="hidden" name="idcurso" id="idcurso">
                  <input type="hidden" name="id" id="id">
                  <input type="text" class="form-control" name="nombre1" id="nombre1" maxlength="250" placeholder="Nombre del curso" required>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Tipo de curso<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
                <div class="col-sm-4">
                  <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required></select>
                </div>

                <label for="name" class="col-sm-2 control-label">Sub tipo de curso<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
                <div class="col-sm-4">
                  <select id="idsubtipocurso" name="idsubtipocurso" class="form-control selectpicker" data-live-search="true"></select>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Número de Horas<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="n_horas" id="n_horas" maxlength="50" placeholder="Número de Horas" required>
                </div>
              </div>

              <div class="form-group">
                <P class="text-center" style="color: red">Ejemplo: *Del 10 al 20 de diciembre del año 2021*</P>
                <label for="name" class="col-sm-2 control-label">Fecha del Curso<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" maxlength="150" placeholder="Fecha del Curso">
                </div>
              </div>

              <div class="form-group">
                <P class="text-center" style="color: red">Ejemplo: *Docente: Ing. Jose Díaz Lopez*</P>
                <label for="name" class="col-sm-2 control-label">Docente: </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="docente" id="docente" maxlength="200" placeholder="Campo Opcional">
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Temario: </label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" name="temario1" id="temario1" maxlength="2000" placeholder="Campo Opcional" style="height:300px"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Contexto<spam style="color: #c0392b ; font-size: 18px">*
                  </spam> :</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="contexto" id="contexto" maxlength="800" placeholder="Organizado por la Escuela Nacional de Capacitación y Actualización Profesional."></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Observaciones: </label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="observaciones" id="observaciones" maxlength="200" placeholder="Observaciones"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Enlace Materiales: </label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="enlace" id="enlace" maxlength="900" placeholder="Enlace de materiales"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Aula virtual: </label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="aula" id="aula" maxlength="900" placeholder="Enlace de aula virtual"></textarea>
                </div>
              </div>

            </div>
            <div class="text-center" style="color: #c0392b">
              <p>
                <spam style="color: #c0392b ; font-size: 18px">*</spam> Campos obligatorios
              </p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- Fin modal -->
    <!-- Modal -->
    <div class="modal fade" id="myCarga" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- form -->

          <div class="modal-header" style="background:#151e38; color:white">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title; text-center">Cargar Cursos</h4>
          </div>

          <form action="files.php" method="post" enctype="multipart/form-data" id="filesForm">
            <div class="col-md-6 offset-md-4">
              <input class="form-control" type="file" name="fileContacts" id="fileContacts">
              <button type="button" onclick="uploadContacts()" class="btn btn-primary form-control">Cargar</button>
            </div>
          </form>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>

          </div>

        </div>
      </div>
    </div>
    <!-- Fin modal -->

  <?php
  } else {
    require 'notieneacceso.php';
  }

  require 'modulos/footer.php';
  ?>
  <script type="text/javascript" src="js/curso.js"></script>

  <script>
    $(document).ready(function() {
      $("#idcategoria").on('change', function() {
        $("#idcategoria option:selected").each(function() {
          idcategoria = $(this).val()

          $.get("../controladores/subtipocurso.php?op=listarxCategoria", {
            idcategoria
          }, function(r) {
            $("#idsubtipocurso").html(r);
            $("#idsubtipocurso").selectpicker('refresh');
          })
        })
      })
    })
  </script>

<?php
}
ob_end_flush();
?>