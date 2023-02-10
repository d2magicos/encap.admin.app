<?php
ob_start();
session_start();
//si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"])) {
  header("Location: login.html");
} else {
  require 'modulos/header.php';
  //Usuario revisa el contenido
  if ($_SESSION['participantes'] == 1) {
?>
    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <section class="content-header">
          <br>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Consulta por Ciudades de envios</li>
          </ol>
        </section>
        <div class="panel panel-default" style="border-color:#666; border-width: 3px; border-style: double;">

          <div class="panel-heading">
            <div class="box-header with-border">
              <h1 class="box-title">Administrar nuestros participantes</h1>
            </div>
          </div>

          <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:16px"><i class="fa fa-plus"> Crear Nuevo Participante</i>
            </button>&nbsp&nbsp
            <a href="cargaparticipante.html" target="_blank"><button class="btn btn-success" style="font-size:16px"><i class="fa fa-cloud-upload"> Cargar Masiva de Participantes</i>
              </button></a>

            <br><br>
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="50%">
              <thead>
                <th>Id</th>
                <th>Apellidos y Nombres</th>
                <th>Documento - Numero</th>
                <th>Teléfono 1</th>
                <th>Teléfono 2</th>
                <th>Email</th>
                <th>Pais</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Cumpleaño</th>
                <th>Estado</th>
                <th>Acciones</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Apellidos y Nombres</th>
                <th>Documento - Numero</th>
                <th>Teléfono 1</th>
                <th>Teléfono 2</th>
                <th>Email</th>
                <th>Pais</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Cumpleaño</th>
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
    <div class="modal fade" id="myModalDetalle" tabindex="-1" role="dialog">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">
          <!-- form -->
          <form class="form-horizontal" role="form" name="formularioDetalle" id="formularioDetalle" method="POST">

            <div class="modal-header" style="background:#151e38; color:white">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title; text-center">Reporte del Participante</h4>
            </div>

            <div class="modal-body" style="text-align:left">
              <div class="form-group">
                <p class="col-sm-3">Apellidos y Nombres:

                </p>
                <p class="col-sm-9" type="text" name="nombre1" id="nombre1" maxlength="100" placeholder="Apellidos y Nombres">


              </div>

              <div class="form-group">
                <p class="col-sm-3">Número de Documento: </p>

                <p type="number" class="col-sm-9" name="num_documento" id="num_documento" maxlength="12" placeholder="Numero de Documento">


              </div>


              <div class="form-group">
                <p class="col-sm-3">Teléfono 1: </pl>

                <p type="number" class="col-sm-9" name="telefono" id="telefono" placeholder="Teléfono">


              </div>

              <div class="form-group">
                <p class="col-sm-3">Email: </p>

                <p type="email" class="col-sm-9" name="email" id="email" maxlength="50" placeholder="Email" required>


              </div>


              <div class="form-group" id="tablacursos">
              
              </div>

            </div>

            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-danger " onclick="cancelarform()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>

            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- Fin modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">
          <!-- form -->
          <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">

            <div class="modal-header" style="background:#151e38; color:white">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title; text-center">Formulario del Participante</h4>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Apellidos y Nombres<spam style="color: #c0392b ; font-size: 18px;">*</spam>: </label>
                <div class="col-sm-9">
                  <input type="hidden" name="idpersona" id="idpersona">
                  <input type="hidden" name="tipo_persona" id="tipo_persona" value="Participantes">
                  <input type="text" class="form-control" name="nombre1" id="nombre1" maxlength="100" placeholder="Apellidos y Nombres" required>
                  <label for="name" class="control-label" style="color: #c0392b ; font-size: 14px">Ejemplo: *SANTANA HINOJOSA, JUAN CARLOS*</label>
                </div>
              </div>

              <div class="form-group">

                <label for="name" class="col-sm-2 control-label">Tipo Documento<spam style="color: #c0392b ; font-size: 18px">*</spam>: </label>
                <div class="col-sm-4">
                  <select id="idtipo_documento" name="idtipo_documento" class="form-control selectpicker" data-live-search="true" required></select>
                  <!-- <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
              <option value="DNI">DNI</option>
              <option value="RUC">RUC</option>
              <option value="CEDULA">CEDULA</option>
              <option value="OTROS">OTROS</option>
            </select> -->
                </div>

                <label for="name" class="col-sm-2 control-label">Número Documento<spam style="color: #c0392b ; font-size: 18px">*</spam>: </label>
                <div style="display:flex">
                  <input type="number" class="form-control" name="num_documento" id="num_documento" maxlength="12" placeholder="Numero de Documento" required>
                  <button class="btn btn-info" type="button" onclick="Buscar();">Buscar</button>

                </div>
                <label for="name" class="control-label" style="color: #c0392b ; font-size: 14px">Ingrese solo numeros</label>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Teléfono 1<spam style="color: #c0392b ; font-size: 18px">*</spam>: </label>
                <div class="col-sm-4">
                  <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" maxlength="17" required>
                </div>

                <label for="name" class="col-sm-2 control-label">Teléfono 2:</label>
                <div class="col-sm-4">
                  <input type="number" class="form-control" name="telefono2" id="telefono2" maxlength="17" placeholder="Teléfono">
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Email<spam style="color: #c0392b ; font-size: 18px">*</spam>: </label>
                <div class="col-sm-4">
                  <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email" required>
                </div>

                <label for="name" class="col-sm-2 control-label">País<spam style="color: #c0392b ; font-size: 18px">*</spam>: </label>
                <div class="col-sm-4">
                  <select id="idpais" name="idpais" class="form-control selectpicker" data-live-search="true" required></select>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Departamento<spam style="color: #c0392b ; font-size: 18px">*</spam>: </label>
                <div class="col-sm-4">
                  <select class="form-control select-picker" name="departamento" id="departamento" required>
                    <option value="">Seleccionar</option>
                    <option value="AMAZONAS">AMAZONAS</option>
                    <option value="ÁNCASH">ÁNCASH</option>
                    <option value="APURÍMAC">APURÍMAC</option>
                    <option value="AREQUIPA">AREQUIPA</option>
                    <option value="AYACUCHO">AYACUCHO</option>
                    <option value="CAJAMARCA">CAJAMARCA</option>
                    <option value="CUSCO">CUSCO</option>
                    <option value="HUANCAVELICA">HUANCAVELICA</option>
                    <option value="HUÁNUCO">HUÁNUCO</option>
                    <option value="ICA">ICA</option>
                    <option value="JUNÍN">JUNÍN</option>
                    <option value="LA LIBERTAD">LA LIBERTAD</option>
                    <option value="LAMBAYEQUE">LAMBAYEQUE</option>
                    <option value="LIMA">LIMA</option>
                    <option value="LORETO">LORETO</option>
                    <option value="MADRE DE DIOS">MADRE DE DIOS</option>
                    <option value="MOQUEGUA">MOQUEGUA</option>
                    <option value="PASCO">PASCO</option>
                    <option value="PIURA">PIURA</option>
                    <option value="PUNO">PUNO</option>
                    <option value="SAN MARTÍN">SAN MARTÍN</option>
                    <option value="TACNA">TACNA</option>
                    <option value="TUMBES">TUMBES</option>
                    <option value="UCAYALI">UCAYALI</option>
                    <option value="OTROS">OTROS</option>
                  </select>
                </div>

                <label for="name" class="col-sm-2 control-label">Ciudad<spam style="color: #c0392b; font-size: 18px">*</spam>:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="50" placeholder="Ciudad" required>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Dirección </label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="direccion" id="direccion" maxlength="70" placeholder="Dirección">
                </div>
                <label for="name" class="col-sm-2 control-label">Fecha de cumpleaños<spam style="color: #c0392b ; font-size: 18px">*</spam>: </label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="fecha_cumple" id="fecha_cumple" maxlength="10" placeholder="Fecha de Cumpleaños" required>
                  <label for="name" class="control-label" style="color: #c0392b ; font-size: 14px">01/01/2022</label>
                </div>
              </div>
            </div>

            <div class="text-center" style="color: #c0392b">
              <p>
                <spam style="color: #c0392b ; font-size: 18px">*</spam> Campos obligatorios
              </p>
            </div>

            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-danger " onclick="cancelarform()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
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
  <script type="text/javascript" src="js/participantes.js"></script>
  <script type="text/javascript" src="js/consultaDNI.js"></script>
<?php
}
ob_end_flush();
?>