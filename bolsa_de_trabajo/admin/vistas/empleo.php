<?php
require "../configuraciones/Conexion.php";
ob_start();
session_start();
//si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"])) {
  header("Location: login.html");
} else {
  require 'modulos/header.php';
  if ($_SESSION['inicio'] == 1) {
?>
    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">

          <div class="panel-heading">
            <div class="box-header with-border">
              <h1 class="box-title">Empleos</h1>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Nuevo Empleo</i>
            </button>

            <br><br>
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Nombre del empleo</th>
                <th>Empresa</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Vacantes</th>
                <th>Renumeración</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Requerimiento</th>
                <th>Estado</th>
                <th>Acciones</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </section>

    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- form -->
          <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">
            <div class="modal-header" style="background:#192441; color:white">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Formulario del Empleo</h4>
            </div>

            <div class="modal-body">

              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Nombre del empleo:</label>
                <div class="col-sm-9">
                  <input type="hidden" name="idempleo" id="idempleo">
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="500" placeholder="Nombre del Empleo" required>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Empresa: </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="empresa" name="empresa" maxlength="500" placeholder="Empresa o S.P." required>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Departamento:</label>
                <div class="col-sm-4">
                  <select class=" form-control select-picker" name="ubi_depa" id="ubi_depa" required>
                  </select>
                </div>
                <label for="name" class="col-sm-2 control-label">Provincia:</label>
                <div class="col-sm-4">
                  <select class=" form-control select-picker" name="ubi_provi" id="ubi_provi" required>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">N° Vacantes:</label>
                <div class="col-sm-4">
                  <input type="number" class="form-control" name="nvacantes" id="nvacantes" placeholder="Numéro de Vacantes" required>
                </div>
                <label for="name" class="col-sm-2 control-label">Renumeración:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="renumeracion" id="renumeracion" placeholder="Renumeración" required>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Fecha Inicio:</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control" name="fechainicio" id="fechainicio" placeholder="Fecha Inicio" required>
                </div>
                <label for="name" class="col-sm-2 control-label">Fecha Fin:</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control" name="fechafin" id="fechafin" placeholder="Fecha Fin" required>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Experiencia: </label>
                <div class="col-sm-10">
                  <textarea style="height:80px" type="text" class="form-control" name="experiencia" id="experiencia" maxlength="1200" placeholder="Experiencia"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Formación: </label>
                <div class="col-sm-10">
                  <textarea style="height:80px" type="text" class="form-control" name="formacion" id="formacion" maxlength="1200" placeholder="Formación"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Especialización: </label>
                <div class="col-sm-10">
                  <textarea style="height:80px" type="text" class="form-control" name="especializacion" id="especializacion" maxlength="1200" placeholder="Especialización"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Conocimiento: </label>
                <div class="col-sm-10">
                  <textarea style="height:80px" type="text" class="form-control" name="conocimiento" id="conocimiento" maxlength="1200" placeholder="Conocimiento"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Competencia: </label>
                <div class="col-sm-10">
                  <textarea style="height:80px" type="text" class="form-control" name="competencia" id="competencia" maxlength="1200" placeholder="Competencia"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Detalle: </label>
                <div class="col-sm-10">
                  <textarea style="height:40px" type="text" class="form-control" name="detalle" id="detalle" maxlength="1200" placeholder="Ejemplo: HTTPS://www.encap.edu.pe"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Destacado: </label>
                <div class="col-sm-10">

                  <select class=" form-control select-picker" style="width:300px; height:35px" name="destacado" id="destacado" required>
                    <option value="0" selected>Deshabilitado</option>
                    <option value="1">Habilitado</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" onclick="cancelarform()" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar Empleo</button>
            </div>
          </form>
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
  <script type="text/javascript" src="js/empleo.js"></script>
<?php
}
ob_end_flush();
?>