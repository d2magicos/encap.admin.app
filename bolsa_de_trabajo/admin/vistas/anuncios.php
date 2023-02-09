<?php
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
              <h1 class="box-title">Anuncios</h1>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Nuevo Anuncio</i>
            </button>

            <br><br>
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Imagen</th>
                <th>Link</th>
                <th>Computadora</th>
                <th>Tablet</th>
                <th>Celular</th>
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
              <h4 class="modal-title">Formulario del Anuncio</h4>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <label>Imagen</label><br>
                  <img id="show_img" width="80px" height="80px" style="margin: 15px;">
                  <input type="file" name="img_anuncio" id="img_anuncio">
                  <input type="hidden" name="before_img" id="before_img">
                  <input type="hidden" name="id_anuncio" id="id_anuncio">
                </div>
                <div class="col-md-6">
                  <label>Link del anuncio</label>
                  <input type="text" class="form-control" name="link_anuncio" id="link_anuncio">
                </div>
                <div class="col-md-6">
                  <label>Mostrar en</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="device_desktop">
                    <label class="form-check-label" for="device_desktop">
                      Computadora
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="device_tablet">
                    <label class="form-check-label" for="device_tablet">
                      Tablet
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="device_movil">
                    <label class="form-check-label" for="device_movil">
                      Celular
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" onclick="cancelarform()" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar Anuncio</button>
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
  <script type="text/javascript" src="js/anuncios.js"></script>
<?php
}
ob_end_flush();
?>