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
    <div class="modal fade" id="myModalLec" tabindex="-1" role="dialog">

      <div class="modal-dialog modal-lg" style="height:800px;    z-index: 15;">

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
                  

                  <input onClick="this.select();" style="width:100%" class="form-control" type="text" id="descripcion" name="descripcion" autocomplete="off" placeholder="Ingrese el nombre del producto" disabled>
                  <div style="width:100%" id="productslist">
                  </div>

                </div>
              </div>

              <div id="section_put">

                <div class="form-group">


                  <div class="col-sm-10" style="display:none">
                    <label for="name" class="col-sm-2 control-label">Modulos:<spam style="color: #c0392b ; font-size: 18px">*
                      </spam> : </label>
                    <input type="text" class="form-control" name="idcursom" id="idcursom" maxlength="50" placeholder="id" required>
                    <select id="idcursos" name="idcursos" class="form-control" required>
                      <option value="-1">Seleccione un modulo</option>
                    </select>
                  </div>
                
                  <label for="name" class="col-sm-2 control-label">Titulo de la leccion<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input style="display:none" class="form-control" id="idleccion" name="idleccion"></input>
                    <input style="display:none" class="form-control" id="idc" name="idc"></input>
                    <input type="text" class="form-control" name="lec_titulo" id="lec_titulo" maxlength="50" placeholder="Titulo de la leccion" required>
                  </div>
                </div>


                <div class="form-group">

                  <label for="name" class="col-sm-2 control-label">Codigo HTML<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="lec_html" id="lec_html" maxlength="2000" placeholder="Codigo HTML" style="height:300px"></textarea>
                  </div>
                </div>




                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Enlace de video:<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="video" id="video" maxlength="500" placeholder="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Duracion de video:<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="duracion" id="duracion" maxlength="500" placeholder="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Enlace de material<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="material" id="material" maxlength="500" placeholder="">
                  </div>
                </div>


                <div class="form-group">

                  <label for="name" class="col-sm-2 control-label">Enlace de examen: </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="examen" id="examen" maxlength="500" placeholder="Campo Opcional">
                  </div>
                </div>



                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" onclick="cancelarforml()"><i class="fa fa-times"></i> Cerrar</button>
                  <button class="btn btn-primary" type="button" onclick="guardaryeditarLecciones()" id="btnGuardarLeccion"><i class="fa fa-save"></i> Guardar Leccion</button>
                </div>


              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- Fin modal -->

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
                <label for="name" class="col-sm-2 control-label">Imagen Curso (Sólo JPG o JPEG):</label>
                <div class="col-sm-6">
                  <input type="file" accept="image/jpeg" class="form-control" accept="image/*" name="imagen" id="imagen" onchange="document.getElementById('imagenmuestra').src = window.URL.createObjectURL(this.files[0]);document.getElementById('imagenactual').value=document.getElementById('imagen').value.replace('C:\\fakepath\\','');document.getElementById('imagenmuestra').style.display='block'">
                  <input type="hidden" name="imagenactual" id="imagenactual" value="">
                  <img src="" width="150px" height="120px" id="imagenmuestra" style="display: none;">


                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Descripción del curso: </label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" name="descripcionc" id="descripcionc" maxlength="2000" placeholder="Campo Opcional" style="height:300px"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Proximo Curso en vivo: </label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" name="cursoenvivo" id="cursoenvivo" maxlength="2000" placeholder="Campo Opcional" style="height:300px"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Contexto<spam style="color: #c0392b ; font-size: 18px">*
                  </spam> :</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="contexto" id="contexto" maxlength="800" placeholder="Organizado por la Escuela Nacional de Capacitación y Actualización Profesional."></textarea>
                </div>
              </div>

              <div class="form-group" style="display: none;">
                <P class="text-center" style="color: red">Ejemplo: *wa.link/45621*</P>
                <label for="name" class="col-sm-2 control-label">WALINK: </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="walink" id="walink" maxlength="200" placeholder="Campo Opcional">
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Examen: </label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="examen" id="examen" maxlength="200" placeholder="Examen del curso"></textarea>
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
                <label for="name" class="col-sm-3 control-label">Codigo del curso<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="cod_curso2" id="cod_curso2" maxlength="50" placeholder="Codigo del curso" readonly>
                </div>
              </div>

              <div class="form-group">
                <P class="text-center" style="color: red">Ejemplo: *MODULO I: ASISTENTE ADMINISTRATIVO EN LA GESTIÓN PÚBLICA*</P>
                <label for="name" class="col-sm-2  control-label">Nombre del modulo:<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
               
                <div class="col-sm-7">
                  <input type="hidden" name="idcurso2" id="idcurso2">
                  <input type="hidden" name="id" id="id">
                  <input type="text" class="form-control" name="nombrem1" id="nombrem1" maxlength="250" placeholder="Ingrese el Nombre del Modulo" required>
                
                </div>
                <div class="col-sm-2">
                     <button class="btn btn-primary" type="button" onclick="guardaryeditarModulo()" id="btnGuardar2"><i class="fa fa-save"></i> Agregar Modulo</button>
          
                </div>
              </div>


              <label for="name" class="col-sm-2 control-label">Modulos Creados: </label>
              <div class="form-group">
               
                <div class="col-sm-12">

                  <div class="col-sm-12" id="modulos1"></div>

                </div>


              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="cancelarformM()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                 </div>

          </form>
        </div>
      </div>
    </div>
    </div>
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