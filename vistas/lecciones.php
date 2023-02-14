<?php
ob_start();
session_start();
//si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"])) {
  header("Location: login.html");
} else {
  require 'modulos/header.php';
  //Usuario revisa el contenido
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
            <li class="active">Administrar Lecciones</li>
          </ol>
        </section>
        <div class="panel panel-default" style="border-color:#666; border-width: 3px; border-style: double;">

          <div class="panel-heading">
            <div class="box-header with-border">
              <h1 class="box-title"> Administrar Lecciones </h1>
            </div>
          </div>

          <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:16px"><i
                class="fa fa-plus"> Crear Nueva leccion</i>
            </button>&nbsp&nbsp

            <br><br>
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Modulo</th>
                <th>Categoria</th>
                <th>Curso</th>
                <th>HTML</th>
                <th>Duracion</th>
                <th>Video</th>
                <th>Material</th>
                <th>Examen</th>
                <th>Acciones</th>

              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Nombre</th>
                <th>Modulo</th>
                <th>Categoria</th>
                <th>Curso</th>
                <th>HTML</th>
                <th>Duracion</th>
                <th>Video</th>
                <th>Material</th>
                <th>Examen</th>
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
          <form class="form-horizontal" role="form" name="formulariolec" id="formulariolec" method="POST">

            <div class="modal-header" style="background:#151e38; color:white">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title; text-center">Formulario de Leccion</h4>
            </div>

            <div class="modal-body panel-body" style="padding: 20px; ">

              <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Curso <spam style="color: #c0392b ; font-size: 18px">*
                  </spam> :</label>
                <div class="col-sm-10">
                  <style>
                    #productslist ul {
                      background-color: #eee;
                      cursor: pointer;
                      position: absolute;
                    }

                    #lista {
                      padding: 12px;
                    }
                  </style>

                  <input onClick="this.select();" style="width:100%" class="form-control" type="text" id="descripcion"
                    name="descripcion" autocomplete="off" placeholder="Ingrese el nombre del producto">
                  <div style="width:100%" id="productslist">
                  </div>

                </div>
              </div>

              <div id="section_put" style="display:none">

                <div class="form-group">

                  <label for="name" class="col-sm-2 control-label">Modulos:<spam style="color: #c0392b ; font-size: 18px">*
                    </spam> : </label>
                  <div class="col-sm-10">
                    <input type="text" style="display:none" class="form-control" name="idcurso" id="idcurso" maxlength="50"
                      placeholder="id" required>
                    <select id="idcursos" name="idcursos" class="form-control" required>
                      <option value="-1">Seleccione un modulo</option>
                    </select>
                  </div>
                  <h3>&nbsp;</h3>
                  <label for="name" class="col-sm-2 control-label">Titulo de la leccion<spam
                      style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input style="display:none" class="form-control" id="idleccion" name="idleccion"></input>
                    <input style="display:none" class="form-control" id="idc" name="idc"></input>
                    <input type="text" class="form-control" name="lec_titulo" id="lec_titulo" maxlength="50"
                      placeholder="Titulo de la leccion" required>
                  </div>
                </div>


                <div class="form-group">

                  <label for="name" class="col-sm-2 control-label">Codigo HTML<spam
                      style="color: #c0392b ; font-size: 18px">*</spam> : </label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="lec_html" id="lec_html" maxlength="2000"
                      placeholder="Codigo HTML" style="height:300px"></textarea>
                  </div>
                </div>




                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Enlace de video:<spam
                      style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="video" id="video" maxlength="500" placeholder="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Duracion de video:<spam
                      style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="duracion" id="duracion" maxlength="500" placeholder="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Enlace de material<spam
                      style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="material" id="material" maxlength="500" placeholder="">
                  </div>
                </div>


                <div class="form-group">

                  <label for="name" class="col-sm-2 control-label">Enlace de examen: </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="examen" id="examen" maxlength="500"
                      placeholder="Campo Opcional">
                  </div>
                </div>



                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i
                      class="fa fa-times"></i> Cerrar</button>
                  <button class="btn btn-primary" type="button" onclick="guardaryeditarLecciones()"
                    id="btnGuardarLeccion"><i class="fa fa-save"></i> Guardar Leccion</button>
                </div>


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
            <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i
                class="fa fa-times"></i> Cerrar</button>

          </div>

        </div>
      </div>
    </div>
    <!-- Fin modal -->
    <!-- Modal MODULOS -->
    <div class="modal fade" id="myModalModulos" tabindex="-1" role="dialog">

      <div class="modal-dialog modal-lg" style="height:800px;">

        <div class="modal-content">
          <!-- form -->
          <form class="form-horizontal" role="form" name="formulario" id="formularioModulo" method="POST">

            <div class="modal-header" style="background:#151e38; color:white">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title; text-center">Formulario de Modulo</h4>
            </div>

            <div class="modal-body panel-body" style="padding: 20px; ">



              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Codigo del curso<spam
                    style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="cod_curso2" id="cod_curso2" maxlength="50"
                    placeholder="Codigo del curso" readonly>
                </div>
              </div>

              <div class="form-group">
                <P class="text-center" style="color: red">Ejemplo: *MODULO I: ASISTENTE ADMINISTRATIVO EN LA GESTIÓN
                  PÚBLICA*</P>
                <label for="name" class="col-sm-2  control-label">Nombre del modulo:<spam
                    style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                <div class="col-sm-10">
                  <input type="hidden" name="idcurso2" id="idcurso2">
                  <input type="hidden" name="id" id="id">
                  <input type="text" class="form-control" name="nombrem1" id="nombrem1" maxlength="250"
                    placeholder="Nombre del Modulo" required>

                </div>
              </div>



              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Modulos Creados+: </label>
                <div class="col-sm-10">

                  <div class="col-sm-10" id="modulos1"></div>

                </div>


              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i
                    class="fa fa-times"></i> Cerrar</button>
                <button class="btn btn-primary" type="button" onclick="guardaryeditarModulo()" id="btnGuardar2"><i
                    class="fa fa-save"></i> Agregar Modulo</button>
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
  <script type="text/javascript" src="js/lecciones.js"></script>

<?php
}
ob_end_flush();
?>