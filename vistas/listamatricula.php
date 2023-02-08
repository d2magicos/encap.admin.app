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
              <h1 class="box-title">Administrar Lista de Matriculas</h1>
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
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" style="font-size:11px;" width="80%">
              <thead>
                <th style="width: 5x;">Fecha de Matricula</th>
                <th style="width: 5x;">Hora</th>
                <th>Personal </th>
                <th>Codigo Matricula</th>
                <th>Numero Documento</th>
                <th>Participante</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo</th>
                <th style="color:#1abc9c">Sub tipo</th>
                <th style="color:#1abc9c">Horas</th>
                <th style="color:#1abc9c">Fecha Curso</th>

                <th>Formato</th>
                <th>Monto</th>
                <th>Medio de Pago</th>
                <th>Prioridad</th>
                <th>Envio Digital</th>
                <th>Acceso Aula</th>
                <th>Certificado</th>
                <th>Notificacion</th>
                <th>Acciones</th>
                <th>Estado Venta</th>
                <th>Medio de Trafico</th>
                <th>Comprobante</th>
                <th>Compromiso</th>
                <th>Voucher</th>
                <th style="color:red">Observaciones administrativa</th>
                <th style="color:red">Observaciones de envío</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th style="width: 5x;">Fecha de Matricula</th>
                <th style="width: 5x;">Hora</th>
                <th>Personal </th>
                <th>Codigo Matricula</th>
                <th>Numero Documento</th>
                <th>Participante</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo</th>
                <th style="color:#1abc9c">Sub tipo</th>
                <th style="color:#1abc9c">Horas</th>
                <th style="color:#1abc9c">Fecha Curso</th>

                <th>Formato</th>
                <th>Monto</th>
                <th>Medio de Pago</th>
                <th>Prioridad</th>
                <th>Envio Digital</th>
                <th>Acceso Aula</th>
                <th>Certificado</th>
                <th>Notificacion</th>
                <th>Acciones</th>
                <th>Estado Venta</th>
                <th>Medio de Trafico</th>
                <th>Comprobante</th>
                <th>Compromiso</th>
                <th>Voucher</th>
                <th style="color:red">Observaciones administrativa</th>
                <th style="color:red">Observaciones de envío</th>
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
            <h4 class="modal-title text-center"><span>FORMULARIO </span> VISTA DE MATRICULA</h4>
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
                <input class="form-control pull-right" type="date" name="fecha_horam" id="fecha_horam">
              </div>
            </div>

            <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
              <label>Codigo de Matricula (*):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
                <input type="hidden" name="idmatricula" id="idmatricula">
                <input style="color:red; width: 550px; height:34px" type="text" class="form-control" name="cod_matriculam" id="cod_matriculam" maxlength="200">
              </div>
            </div>

            <div class="form-group col-lg-12 col-md-8 col-sm-8 col-xs-12">
              <label>Codigo QR(*):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
                <textarea style="color:red; width: 1400px; height:50px" type="text" class="form-control" name="qr" id="qr" maxlength="500"> </textarea>
              </div>
            </div>
          </div>

          <div class="modal-header panel-heading" style="background-color: #01324b">
            <h4 class="modal-title"><span id="titulo-formulario">Datos</span> del participante</h4>
          </div>

          <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="background-color: #FFF"><br>

            <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
              <label>Tipo de Documento (*):</label>
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
              <label>Numero de Documento (*):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                <input type="hidden" name="idpersona" id="idpersona">
                <input type="hidden" name="idparticipante" value="1" id="idparticipante">
                <input style="height:34px" type="text" class="form-control" name="num_documentom" id="num_documentom" readonly>
                <!-- <button style="padding: 5px 10px; font-size: 14px; border: 1px solid #ccc" onclick="buscarDNI()" id="btnBuscar" type="button" ><i class="fa fa-search" ></i></button> -->
              </div>
            </div>

            <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
              <label>Nombre del Participante (*):</label>
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
              <label>Telefono 1 (*):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                <input type="text" class="form-control" type="text" name="telefonom" id="telefonom" maxlength="20" readonly>
              </div>
            </div>

            <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
              <label>Telefono 2 (*):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                <input type="text" class="form-control" type="text" name="telefono2m" id="telefono2m" maxlength="20" readonly>
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
              <label>Departamento (*):</label>
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
              <label>Fecha de Cumpleaño (*):</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control" name="fecha_cumplem" id="fecha_cumplem" maxlength="20" readonly>
              </div>
            </div>
          </div>

          <div class="modal-header panel-heading" style="background-color: #01324b">
            <h4 class="modal-title"><span id="titulo-formulario">Datos</span> del curso</h4>
          </div>

          <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="background:  #fff; padding: 0px 0px -10px 0px"><br>

            <table id="detallesm" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <tbody>
              </tbody>
            </table>
          </div>

          <div class="row">
            <div class="form-group col-lg-12 col-md-8 col-sm-8 col-xs-12">
              <label>Lista de Subcategoria (*):</label>
              <div class="input-group">
                <input type="hidden" name="idcategoria" id="idcategoria">

                <script>






                </script>


              </div>
              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px 30px 0px 30px">
                <label>&nbsp;Plantilla: </label>
                <select id="select_idcategoria" name="select_idcategoria" class="select-picker" data-live-search="true" onchange="Actualizar()">


                </select>


                <label>&nbsp;Vista Frontal:&nbsp;</label>
                <img src="../cert_digitales/fpdf/img/images.png" width="150px" height="120px" id="imagenpreview" />
                <label>&nbsp;Vista Posterior:&nbsp;</label>
                <img src="../cert_digitales/fpdf/img/images.png" width="150px" height="120px" id="imagenpreview2" />
              </div>

            </div>

            <input type="hidden" name="imagen" id="imagen">
            <input type="hidden" name="imagenposterior" id="imagenposterior">
            <input type="hidden" name="idplantilla" id="idplantilla">

          </div>

          <div class="row">
            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding: 0px 30px 0px 30px">
              <label style="color:red;"> Organizado por la Escuela Nacional de Capacitación y Actualización Profesional.
              </label><br>
              <label>Contexto (*):</label>
              <div class="input-group">
                <textarea style="width: 900px; height:48px" name="contexto" id="contexto" maxlength="500" required></textarea>
              </div>
            </div>

            <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
              <label style="color:red;"> Nota: 15 </label><br>
              <label>Nota:</label>
              <div class="input-group">
                <input type="text" class="form-control" name="nota" id="nota" maxlength="20">
              </div>
            </div>

            <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
              <label></label><br>
              <label>Año (*):</label>
              <div class="input-group">
                <input type="text" class="form-control" name="año" id="año" maxlength="15" required>
              </div>
            </div>

            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding: 0px 30px 0px 30px">
              <label style="color:red;"> En calidad de participante durante 120 horas académicas, en el curso de:
              </label><br>
              <label>Horas (*):</label>
              <div class="input-group">
                <textarea style="width: 900px; height:48px" name="horas" id="horas" maxlength="500" required></textarea>
              </div>
            </div>
          </div>


          <div class="modal-header panel-heading" style="background-color: #e74c3c ">
            <h4 class="modal-title" style="color:#fff"><span id="titulo-formulario">Detalles</span> de la matricula</h4>
          </div>

          <div class="form-group col-sm-6 col-lg-12 " style="background: #fff ; padding:5px 5px 10px 10px">
            <div class="row">
              <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                <label>Monto (*):</label>
                <div class="input-group">
                  <input type="hidden" name="idcurso1" id="idcurso1">
                  <input type="text" class="form-control" name="montom" id="montom" maxlength="70">
                </div>
              </div>

              <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                <label>Formato (*):</label>
                <div class="input-group">
                  <select class=" select-picker" name="formatom" id="formatom">
                    <option value="FISICO" selected="selected">FISICO</option>
                    <option value="DIGITAL">DIGITAL</option>
                  </select>
                </div>
              </div>

              <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                <label>Forma de recaudacion (*):</label>
                <div class="input-group">
                  <input type="hidden" name="idforma_recaudacion" id="idforma_recaudacion">
                  <select id="idforma_recaudacionm" name="idforma_recaudacionm" class=" select-picker" data-live-search="true" required></select>
                </div>
              </div>

              <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                <label>Medio de pago (*):</label>
                <div class="input-group">
                  <input type="hidden" name="idmediospagos" id="idmediospagos">
                  <select id="idmediospagosm" name="idmediospagosm" class=" select-picker" data-live-search="true" required></select>
                </div>
              </div>

              <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                <label>Numero operacion (*):</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="noperacionm" id="noperacionm" maxlength="20" readonly>
                </div>
              </div>

              <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                <label>Prioridad (*):</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="prioridadm" id="prioridadm" maxlength="20" readonly>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                <label>Matriculado en el aula virtual?</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                  <select class="form-control select-picker" name="accesoaula" id="accesoaula">
                    <option value="NO" selected="selected">NO</option>
                    <option value="SI">SI</option>
                  </select>
                </div>
              </div>

              <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                <label>Estado venta:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                  <select class="form-control select-picker" name="estadoventa" id="estadoventa">
                    <option value="ACTIVADO" selected="selected">ACTIVADO</option>
                    <option value="ANULADO">ANULADO</option>
                    <option value="DEVOLUCIÓN">DEVOLUCIÓN</option>
                  </select>
                </div>
              </div>

              <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                <label>Comprobante:</label>
                <div class="input-group">
                  <input style="width: 470px;" type="text" class="form-control" name="comprobante" id="comprobante" maxlength="20">
                </div>
              </div>

              <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                <label>Observaciones de Matricula (*):</label>
                <div class="input-group">
                  <textarea style="width: 725px; height:45px" class="form-control" name="obervacionesm" id="obervacionesm" maxlength="200"> </textarea>
                </div>
              </div>

              <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                <label>Observaciones de Envío (*):</label>
                <div class="input-group">
                  <textarea style="width: 725px; height:45px" class="form-control" name="obervacionesenviom" id="obervacionesenviom" maxlength="200"> </textarea>
                </div>
              </div>

              <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                <label>Voucher:</label>
                <div class="input-group">
                  <textarea style="width: 725px; height:45px" class="form-control" name="voucher" id="voucher" maxlength="900"> </textarea>
                </div>
              </div>

              <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                <label>Compromiso:</label>
                <div class="input-group">
                  <textarea style="width: 725px; height:45px" class="form-control" name="compromiso" id="compromiso" maxlength="900"> </textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer panel-footer">
            <button class="btn btn-primary" type="submit" id="btnGuardar" style="font-size:18px"><i class="fa fa-save"></i>
              Actualizar Matricula</button> &nbsp
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" style="font-size:18px"><i class="fa fa-times"></i> Cancelar</button>
          </div>
        </div>
      </div>
    </form>
  <?php
  } else {
    require 'notieneacceso.php';
  }

  require 'modulos/footer.php';
  ?>
  <script type="text/javascript" src="js/listamatricula.js"></script>
  <script type="text/javascript">
    function ValidarCert(url, categoria) {
      console.log(url, categoria);

      if (categoria == "") {
        swal({
          title: 'País',
          type: 'success',
          text: "HOLA"
        });
      } else {
        window.open(
          url,
          '_blank'
        );
      }
    }
  </script>
<?php
}
ob_end_flush();
?>