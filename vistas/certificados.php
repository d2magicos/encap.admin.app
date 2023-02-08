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
            <li class="active">Administrar nuestras plantillas</li>
          </ol>
        </section>
        <div class="panel panel-default" style="border-color:#666; border-width: 3px; border-style: double;">

          <div class="panel-heading">
            <div class="box-header with-border">
              <h1 class="box-title"> Administrar nuestros plantillas </h1>
            </div>
          </div>

          <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:16px"><i class="fa fa-plus"> Crear Nueva Plantilla</i>
            </button>&nbsp&nbsp

            <br><br>
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Nombre de plantilla</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Tipo de Curso</th>
                <th>Sub Tipo de Curso</th>
                <th>Estilo</th>
                <th>Imagen Frontal Digital</th>
                <th>Imagen Posterior Digital</th>
                <th>Imagen Frontal Físico</th>
                <th>Imagen Posterior Físico</th>
                <th>Acciones</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Nombre de plantilla</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Tipo de Curso</th>
                <th>Sub Tipo de Curso</th>
                <th>Estilo</th>
                <th>Imagen Frontal Digital</th>
                <th>Imagen Posterior Digital</th>
                <th>Imagen Frontal Físico</th>
                <th>Imagen Posterior Físico</th>
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
              <h4 class="modal-title; text-center">Formulario del Plantilla</h4>
            </div>

            <div class="modal-body panel-body" style="padding: 20px; ">


              <div class="form-group">
                <P class="text-center" style="color: red">Ejemplo: *Plantilla A*</P>
                <label for="name" class="col-sm-2  control-label">Nombre de la plantilla<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                <div class="col-sm-10">

                  <input type="hidden" name="id" id="id">
                  <input type="hidden" name="idcert" id="idcert">
                  <input type="text" class="form-control" name="nombre1" id="nombre1" maxlength="250" placeholder="Nombre de la plantilla" required>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Tipo Curso<spam style="color: #c0392b ; font-size: 18px">*
                  </spam> : </label>
                <div class="col-sm-4">
                  <select id="idcategoria" name="idcategoria" class="form-control" required></select>
                </div>
                <label for="name" class="col-sm-2 control-label">Sub Tipo de Curso<spam style="color: #c0392b ; font-size: 18px">*
                  </spam> : </label>
                <div class="col-sm-4">
                  <select id="idsubtipocurso" name="idsubtipocurso" class="form-control selectpicker" data-live-search="true"></select>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Tipo Estilo<spam style="color: #c0392b ; font-size: 18px">*
                  </spam> : </label>
                <div class="col-sm-4">
                  <select id="idestilo" name="idestilo" class="form-control" required>
                    <?php
                    $directorio = '../cert_digitales/';
                    $ficheros1 = scandir($directorio);

                    for ($i = 0; $i < count($ficheros1); $i++) {
                      if (substr($ficheros1[$i], -4) == ".php" && $ficheros1[$i] != "WriteTag.php") {
                        $cod = explode("_", $ficheros1[$i]);

                        switch ($cod[0]) {
                          case "01":
                            $cod[0] = 1;
                            break;

                          case "02":
                            $cod[0] = 2;
                            break;

                          case "03":
                            $cod[0] = 3;
                            break;

                          case "04":
                            $cod[0] = 4;
                            break;

                          case "05":
                            $cod[0] = 5;
                            break;

                          case "06":
                            $cod[0] = 6;
                            break;

                          case "07":
                            $cod[0] = 7;
                            break;

                          case "08":
                            $cod[0] = 8;
                            break;

                          case "09":
                            $cod[0] = 9;
                            break;

                          case "10":
                            $cod[0] = 10;
                            break;

                          case "11":
                            $cod[0] = 11;
                            break;

                          case "12":
                            $cod[0] = 12;
                            break;

                          case "13":
                            $cod[0] = 13;
                            break;
                        }

                        echo '<option value="' . $ficheros1[$i] . '" data-size="' . $cod[0] . '">' . $ficheros1[$i] . '</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha de inicio:</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control" name="fechainicio" id="fechainicio" style="width:200px; height:35px" maxlength="200" placeholder="Fecha de envio" required>
                </div>

                <label class="col-sm-2 control-label">Fecha final:</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control" name="fechafin" id="fechafin" style="width:200px; height:35px" maxlength="200" placeholder="Fecha de envio" required>
                </div>
              </div>

              <div class="form-group">
                <h4 class="modal-title"><span id="titulo-formulario">Formato Digital:</h4>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Imagen Frontal (Sólo JPG o JPEG):</label>
                <div class="col-sm-6">
                  <input type="file" accept="image/jpeg" class="form-control" accept="image/*" name="imagen" id="imagen" onchange="document.getElementById('imagenmuestra').src = window.URL.createObjectURL(this.files[0]);document.getElementById('imagenactual').value=document.getElementById('imagen').value.replace('C:\\fakepath\\','');document.getElementById('imagenmuestra').style.display='block'">
                  <input type="hidden" name="imagenactual" id="imagenactual" value="">
                  <img src="" width="150px" height="120px" id="imagenmuestra" style="display: none;">
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Imagen Posterior (Sólo JPG o JPEG):</label>
                <div class="col-sm-6">
                  <input type="file" accept="image/jpeg" class="form-control" name="imagenposterior" id="imagenposterior" onchange="document.getElementById('imagenmuestra2').src = window.URL.createObjectURL(this.files[0]);document.getElementById('imagenactual2').value=document.getElementById('imagenposterior').value.replace('C:\\fakepath\\','');document.getElementById('imagenmuestra2').style.display='block'">
                  <input type="hidden" name="imagenactual2" id="imagenactual2" value="">
                  <img src="" width="150px" height="120px" id="imagenmuestra2" style="display: none;">
                </div>
              </div>

              <div id="diplomafisico">
                <div class="form-group">
                  <h4 class="modal-title"><span id="titulo-formulario">Formato Físico:</h4>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Imagen Frontal (Sólo JPG o JPEG):</label>
                  <div class="col-sm-6">
                    <input type="file" accept="image/jpeg" class="form-control" accept="image/*" name="imagenf" id="imagenf" onchange="document.getElementById('imagenmuestraf').src = window.URL.createObjectURL(this.files[0]);document.getElementById('imagenactualf').value=document.getElementById('imagenf').value.replace('C:\\fakepath\\','');document.getElementById('imagenmuestraf').style.display='block'">
                    <input type="hidden" name="imagenactualf" id="imagenactualf" value="">
                    <img src="" width="150px" height="120px" id="imagenmuestraf" style="display: none;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Imagen Posterior (Sólo JPG o JPEG):</label>
                  <div class="col-sm-6">
                    <input type="file" accept="image/jpeg" class="form-control" name="imagenposteriorf" id="imagenposteriorf" onchange="document.getElementById('imagenmuestra2f').src = window.URL.createObjectURL(this.files[0]);document.getElementById('imagenactual2f').value=document.getElementById('imagenposteriorf').value.replace('C:\\fakepath\\','');document.getElementById('imagenmuestra2f').style.display='block'">
                    <input type="hidden" name="imagenactual2f" id="imagenactual2f" value="">
                    <img src="" width="150px" height="120px" id="imagenmuestra2f" style="display: none;">
                  </div>
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
  <script type="text/javascript" src="js/certificados.js"></script>

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

  <script>
    var $select1 = $('#idcategoria'),
      $select2 = $('#idestilo'),
      $select3 = $('#fechainicio'),
      $options = $select2.find('option');

    var div = document.getElementById('diplomafisico');

    $select1.on('change', function() {
      var size = $(this).find("option:selected").data("size");

      $select2.html($options.filter('[data-size="' + size + '"]'));

      $select2.val($select2.find("option:first").val());
      $select2.selectpicker('refresh');

      console.log($select1.val());

      if ($select1.val() == "9") {
        div.style.display = 'none';
      } else {
        div.style.display = 'block';
      }
    }).trigger('change');
  </script>


<?php
}
ob_end_flush();
?>