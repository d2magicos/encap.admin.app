<?php
//  Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: login.html");
} else {
  require 'modulos/header.php';

if ($_SESSION['administrativa'] == 1) {
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <br>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Matricula</li>
    </ol>
  </section>

  <section class="content">
    <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border">
          <h1 class="box-title">Lista de Satisfacción de los Participantes Matriculados</h1>
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

      <!-- /.col -->

      <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
          <thead>
            <th style="width: 5x;">Fecha</th>
            <th>Codigo Matricula</th>
            <th>Asesor</th>
            <th>Participante</th>
            <th>Celular 1</th>
            <th>Celular 2</th>
            <th style="width: 10x;">Correo</th>
            <th style="color:#1abc9c">Curso</th>
            <th style="color:#1abc9c">Tipo</th>
            <th style="color:#1abc9c">Horas</th>
            <th style="color:#1abc9c">Formato</th>
            <th style="color:#1abc9c">Monto</th>
            <th style="color:#1abc9c">Fecha Curso</th>
            <th style="color: #cb4335 ">Nivel de Satisfacción</th>
            <th style="color: #1abc9c ">Encuesta</th>
            <th>Acciones</th>
            <th>Estado</th>
            <th>Observaciones</th>
            <th>Fecha Información</th>
            <th style="color: rgb(238, 130, 15); font-size: 13px;">¿Qué le pareció la atención brindada por el asesor?</th>
            <th>Comentario #1</th>
            <th style="color: rgb(238, 130, 15); font-size: 13px;">¿Me podría confirmar si el envío de su (certificado o diploma) fue óptimo?</th>
            <th>Comentario #2</th>
            <th style="color: rgb(238, 130, 15); font-size: 13px;">Y coménteme sobre la información del curso y materiales. ¿Qué le pareció?</th>
            <th>Comentario #3</th>
            <th style="color: rgb(238, 130, 15); font-size: 13px;">¿Usted volvería a adquir nuestro servicio? ¿Nos recomendaría?</th>
            <th>Comentario #4</th>
            <th>Estado</th>
            <th>Fecha de Registro</th>
            <th>Bono</th>
            <th>Fecha de caducidad</th>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <th style="width: 5x;">Fecha</th>
            <th>Codigo Matricula</th>
            <th>Asesor</th>
            <th>Participante</th>
            <th>Celular 1</th>
            <th>Celular 2</th>
            <th style="width: 10x;">Correo</th>
            <th style="color:#1abc9c">Curso</th>
            <th style="color:#1abc9c">Tipo</th>
            <th style="color:#1abc9c">Horas</th>
            <th style="color:#1abc9c">Formato</th>
            <th style="color:#1abc9c">Pago</th>
            <th style="color:#1abc9c">Fecha Curso</th>
            <th style="color: #cb4335 ">Nivel de Satisfacción</th>
            <th style="color: #1abc9c ">Encuesta</th>
            <th>Acciones</th>
            <th>Estado</th>
            <th>Observaciones</th>
            <th>Fecha Información</th>
            <th>Valoración #1</th>
            <th>Comentario #1</th>
            <th>Valoración #2</th>
            <th>Comentario #2</th>
            <th>Valoración #3</th>
            <th>Comentario #3</th>
            <th>Valoración #4</th>
            <th>Comentario #4</th>
            <th>Estado</th>
            <th>Fecha de Registro</th>
            <th>Bono</th>
            <th>Fecha de caducidad</th>
          </tfoot>
        </table>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<!-- Modal -->
<form id="formulario" class="modal fade" method="POST">
  <div class="modal-dialog modal-lg" style="width: 1500px">
    <!-- Modal content-->
    <div class="modal-content panel panel-primary">
      <div class="modal-header panel-heading" style="background-color: #01324b">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><span id="titulo-formulario">FORMULARIO </span> DE SATISFACIÓN DEL
          PARTICIPANTE</h4>
      </div>

      <div class="modal-body panel-body">
        <input type="hidden" id="txtCodigoSeleccionado">
        <div class="form-group col-lg-3">
          <label class="col-form-label">Personal (*)</label>
          <input type="hidden" name="idpersonal" id="idpersonal">
          <input type="text" class="form-control" name="nombrepersonal" id="nombrepersonal" readonly>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label>Fecha (*):</label>
          <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i>
            </div>
            <input class="form-control pull-right" type="text" name="fecha_horam" id="fecha_horam" readonly>
          </div>
        </div>

        <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
          <label>Codigo de matricula (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
            <input type="hidden" name="idmatricula" id="idmatricula">
            <input type="hidden" name="idpersonal" id="idpersonal">
            <input style="color:red; width: 550px; height:34px" type="text" class="form-control" name="cod_matriculam"
              id="cod_matriculam" maxlength="20" readonly>
          </div>
        </div>

      </div>

      <div class="modal-header panel-heading" style="background-color: #01324b">
        <h4 class="modal-title"><span id="titulo-formulario">Datos</span> del participante</h4>
      </div>


      <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12"
        style="border: 1px solid #85c1e9 ; background-color: #ffffff"><br>

        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
          <label>Tipo de documento (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
            <select style="height:34px" class="form-control select-picker" name="tipo_documentom" id="tipo_documentom">
              <option value="DNI" selected="selected">DNI</option>
              <option value="RUC">RUC</option>
              <option value="CE">CE - Carnet de extranjeria</option>
              <option value="PAS">PAS - Pasaporte</option>
            </select>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
          <label>Número de documento (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
            <input type="hidden" name="idpersona" id="idpersona">
            <input type="hidden" name="idparticipante" value="1" id="idparticipante">
            <input style=" height:34px" type="text" class="form-control" name="num_documentom" id="num_documentom"
              readonly>
            <!-- <button style="padding: 5px 10px; font-size: 14px; border: 1px solid #ccc" onclick="buscarDNI()" id="btnBuscar" type="button" ><i class="fa fa-search" ></i></button> -->
          </div>
        </div>

        <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
          <label>Nombre del participante (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users"></i></span>
            <input style=" height:34px" type="text" class="form-control" id="nombrem" name="nombrem" readonly>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
          <label>Email (*):</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-envelope-o fa-fw"></i>
            </div>
            <input class="form-control" type="email" name="emailm" id="emailm" maxlength="80" readonly>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Teléfono 1 (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
            <input type="text" class="form-control" type="text" name="telefonom" id="telefonom" maxlength="20" readonly>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Teléfono 2 (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
            <input type="text" class="form-control" type="text" name="telefono2m" id="telefono2m" maxlength="20"
              readonly>
          </div>
        </div>


        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>País (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="paism" id="paism" maxlength="20" readonly>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label style="text-align: left">Departamento (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="departamentom" id="departamentom" maxlength="50" readonly>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Ciudad (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="ciudadm" id="ciudadm" maxlength="70" readonly>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Dirección (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="direccionm" id="direccionm" maxlength="300" readonly>
          </div>
        </div>

        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Fecha de cumpleaños (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name="fecha_cumplem" id="fecha_cumplem" maxlength="20" readonly>
          </div>
        </div>
      </div>

      <div class="modal-header panel-heading" style="background-color: #01324b">
        <h4 class="modal-title"><span id="titulo-formulario">Datos</span> del curso</h4>
      </div>

      <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="background: #ffffff">
        <div class="form-group col-lg-12 col-md-12 col-xs-12"><br>
          <table id="detallesm" class="table table-striped table-bordered table-condensed table-hover" width="100%">
            <tbody>
            </tbody>
          </table>
        </div>
      </div>

      <div class="form-group col-sm-6 col-lg-12 " style="background:  #fff">
        <div class="modal-header panel-heading" style="background-color: #e74c3c ">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:#fff"><span id="titulo-formulario">Detalles</span> de satisfación</h4>
        </div>
        <div class="row">
          <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
            <label>Fecha de Información:</label>
            <div class="input-group">
              <input type="date" class="form-control" name="fechainfo" id="fechainfo" style=" height:34px;"
                maxlength="200" required>
            </div>
            <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">*
              Obligatorio</label>
          </div>
          <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
            <label>Conformidad del cliente<spam style="color: #c0392b ; font-size: 18px">*</spam>:</label>
            <div class="input-group">
              <select style="width:350px; height:34px" class=" select-picker" name="satisfacion" id="satisfacion"
                required>
                <option value="" selected="selected">Seleccionar</option>
                <option value="1 - Muy insatisfecho">1 - Muy insatisfecho</option>
                <option value="2 - Insatisfecho">2 - Insatisfecho</option>
                <option value="3 - Regular">3 - Regular</option>
                <option value="4 - Satisfecho">4 - Satisfecho</option>
                <option value="5 - Muy satisfecho">5 - Muy satisfecho</option>
              </select>
            </div>
          </div>
          <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
            <label>Estado <spam style="color: #c0392b ; font-size: 18px">*</spam>:</label>
            <div class="input-group">
              <select style="width: 250px; height:34px" class="select-picker" name="estadosatisfacion"
                id="estadosatisfacion" required>
                <option value="PENDIENTE" selected="selected">PENDIENTE</option>
                <option value="CONFIRMADO">CONFIRMADO</option>
              </select>
            </div>
          </div>
          <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
            <label>Observaciones:</label>
            <div class="input-group">
              <textarea style="width: 720px; height:50px" type="text" class="form-control"
                name="observaciones_satisfacion" id="observaciones_satisfacion" placeholder="Observaciones"
                maxlength="200">
                </textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer panel-footer">
        <button class="btn btn-primary" type="submit" id="btnGuardar" style="font-size:18px"><i class="fa fa-save"></i>
          Guardar satisfación del Participante</button> &nbsp
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" style="font-size:18px">
          <i class="fa fa-times"></i> Cancelar</button>
      </div>

    </div>
  </div>
</form>

<!-- Modal 2 -->
<form id="formulario2" class="modal fade" method="POST">
  <div class="modal-dialog modal-lg" style="width: 1500px">
    <!-- Modal content-->
    <div class="modal-content panel panel-primary">
      <div class="modal-header panel-heading" style="background-color: #01324b">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><span id="titulo-formulario">FORMULARIO </span> DE SATISFACIÓN DEL
          PARTICIPANTE</h4>
      </div>
      <div class="modal-body panel-body">
        <input type="hidden" id="txtCodigoSeleccionado">
        <div class="form-group col-lg-3">
          <label class="col-form-label">Personal (*)</label>
          <input type="hidden" name="idpersonal" id="idpersonal">
          <input type="text" class="form-control" name="nombrepersonal2" id="nombrepersonal2" readonly>
        </div>
        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label>Fecha (*):</label>
          <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i>
            </div>
            <input class="form-control pull-right" type="text" name="fecha_horam2" id="fecha_horam2" readonly>
          </div>
        </div>
        <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
          <label>Codigo de matricula (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
            <input type="hidden" name="idmatricula2" id="idmatricula2">
            <input type="hidden" name="idpersonal" id="idpersonal">
            <input style="color:red; width: 550px; height:34px" type="text" class="form-control" name="cod_matriculam2"
              id="cod_matriculam2" maxlength="20" readonly>
          </div>
        </div>
      </div>
      <div class="modal-header panel-heading" style="background-color: #01324b">
        <h4 class="modal-title"><span id="titulo-formulario">Datos</span> del participante</h4>
      </div>
      <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12"
        style="border: 1px solid #85c1e9 ; background-color: #ffffff"><br>
        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
          <label>Tipo de documento (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
            <select style="height:34px" class="form-control select-picker" name="tipo_documentom2" id="tipo_documentom2">
              <option value="DNI" selected="selected">DNI</option>
              <option value="RUC">RUC</option>
              <option value="CE">CE - Carnet de extranjeria</option>
              <option value="PAS">PAS - Pasaporte</option>
            </select>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
          <label>Número de documento (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
            <input type="hidden" name="idpersona" id="idpersona">
            <input type="hidden" name="idparticipante" value="1" id="idparticipante">
            <input style=" height:34px" type="text" class="form-control" name="num_documentom2" id="num_documentom2"
              readonly>
            <!-- <button style="padding: 5px 10px; font-size: 14px; border: 1px solid #ccc" onclick="buscarDNI()" id="btnBuscar" type="button" ><i class="fa fa-search" ></i></button> -->
          </div>
        </div>
        <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
          <label>Nombre del participante (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users"></i></span>
            <input style=" height:34px" type="text" class="form-control" id="nombrem2" name="nombrem2" readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
          <label>Email (*):</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-envelope-o fa-fw"></i>
            </div>
            <input class="form-control" type="email" name="emailm2" id="emailm2" maxlength="80" readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Teléfono 1 (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
            <input type="text" class="form-control" type="text" name="telefonom2" id="telefonom2" maxlength="20" readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Teléfono 2 (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
            <input type="text" class="form-control" type="text" name="telefono2m2" id="telefono2m2" maxlength="20"
              readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>País (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="paism2" id="paism2" maxlength="20" readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label style="text-align: left">Departamento (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="departamentom2" id="departamentom2" maxlength="50" readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Ciudad (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="ciudadm2" id="ciudadm2" maxlength="70" readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Dirección (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
            <input type="text" class="form-control" name="direccionm2" id="direccionm2" maxlength="300" readonly>
          </div>
        </div>
        <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
          <label>Fecha de cumpleaños (*):</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name="fecha_cumplem2" id="fecha_cumplem2" maxlength="20" readonly>
          </div>
        </div>
      </div>

      <!-- NUEVOO -->

      <div class="modal-header panel-heading" style="background-color: #01324b">
        <h4 class="modal-title"><span id="titulo-formulario">Satisfacción al cliente (4 preguntas)</h4>
      </div>

      <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12"
        style="border: 1px solid #85c1e9 ; background-color: #ffffff"><br>

        <div class="form-group col-lg-12 col-md-4 col-sm-4 col-xs-12">
          <label>PREGUNTA 01: ¿Qué le pareció la atención brindada por el asesor? :</label>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label>Valoración:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
            <select style="width:350px; height:34px" class=" select-picker" name="valoracion01" id="valoracion01"
                required>
                <option value="" selected="selected">Seleccionar</option>
                <option value="1 - Muy insatisfecho">1 - Muy insatisfecho</option>
                <option value="2 - Insatisfecho">2 - Insatisfecho</option>
                <option value="3 - Regular">3 - Regular</option>
                <option value="4 - Satisfecho">4 - Satisfecho</option>
                <option value="5 - Muy satisfecho">5 - Muy satisfecho</option>
              </select>
          </div>
        </div>

        <div class="form-group col-lg-8">
          <label>Observaciones:</label>
          <div class="input-group">
            <textarea style="width: 480px; height: 50px" type="text" class="form-control"
              name="comentario01" id="comentario01" placeholder="Observaciones"
              maxlength="200" required></textarea>
          </div>
        </div>

        <div class="form-group col-lg-12 col-md-4 col-sm-4 col-xs-12">
          <label>PREGUNTA 02: ¿Me podría confirmar si el envío de sus (certificado o diploma) fue óptimo? :</label>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label>Valoración:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
            <select style="width:350px; height:34px" class=" select-picker" name="valoracion02" id="valoracion02"
                required>
                <option value="" selected="selected">Seleccionar</option>
                <option value="1 - Muy insatisfecho">1 - Muy insatisfecho</option>
                <option value="2 - Insatisfecho">2 - Insatisfecho</option>
                <option value="3 - Regular">3 - Regular</option>
                <option value="4 - Satisfecho">4 - Satisfecho</option>
                <option value="5 - Muy satisfecho">5 - Muy satisfecho</option>
              </select>
          </div>
        </div>

        <div class="form-group col-lg-8">
          <label>Observaciones:</label>
          <div class="input-group">
            <textarea style="width: 480px; height: 50px" type="text" class="form-control"
              name="comentario02" id="comentario02" placeholder="Observaciones"
              maxlength="200" required></textarea>
          </div>
        </div>

        <div class="form-group col-lg-12 col-md-4 col-sm-4 col-xs-12">
          <label>PREGUNTA 03: La información del curso y materiales referente a la calidad de los mismos con qué puntuación :</label>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label>Valoración:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
            <select style="width:350px; height:34px" class=" select-picker" name="valoracion03" id="valoracion03"
                required>
                <option value="" selected="selected">Seleccionar</option>
                <option value="1 - Muy insatisfecho">1 - Muy insatisfecho</option>
                <option value="2 - Insatisfecho">2 - Insatisfecho</option>
                <option value="3 - Regular">3 - Regular</option>
                <option value="4 - Satisfecho">4 - Satisfecho</option>
                <option value="5 - Muy satisfecho">5 - Muy satisfecho</option>
              </select>
          </div>
        </div>

        <div class="form-group col-lg-8">
          <label>Observaciones:</label>
          <div class="input-group">
            <textarea style="width: 480px; height: 50px" type="text" class="form-control"
              name="comentario03" id="comentario03" placeholder="Observaciones"
              maxlength="200" required></textarea>
          </div>
        </div>

        <div class="form-group col-lg-12 col-md-4 col-sm-4 col-xs-12">
          <label>PREGUNTA 04: ¿Usted volvería a adquir nuestro servicio? ¿Nos recomendaría? :</label>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label>Valoración:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
            <select style="width:350px; height:34px" class=" select-picker" name="valoracion04" id="valoracion04"
                required>
                <option value="" selected="selected">Seleccionar</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
              </select>
          </div>
        </div>

        <div class="form-group col-lg-8">
          <label>Observaciones:</label>
          <div class="input-group">
            <textarea style="width: 480px; height: 50px" type="text" class="form-control"
              name="comentario04" id="comentario04" placeholder="Observaciones"
              maxlength="200" required></textarea>
          </div>
        </div>
      </div>

      <div class="modal-footer panel-footer">
        <button class="btn btn-primary" type="submit" id="btnGuardar" style="font-size:18px"><i class="fa fa-save"></i>
          Guardar satisfación del Participante</button> &nbsp
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" style="font-size:18px"><i
            class="fa fa-times"></i> Cancelar</button>
      </div>

    </div>
  </div>
</form>

<?php
}
else
{
  require 'notieneacceso.php';
}

require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/listasatisfacion.js"></script>
<?php 
}
ob_end_flush();
?>