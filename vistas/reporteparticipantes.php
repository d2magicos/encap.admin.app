<?php
ob_start();
session_start();

// si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"])) {
  header("Location: login.html");
} else {
  require 'modulos/header.php';

  if ($_SESSION['reportes'] == 1) {
?>

    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->

      <section class="content" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
        <div class="row">
          <div class="col-md-12" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
            <div class="panel " style="background: #181f38; color:#fff;">
              <div class="col-md-12" style="background: #181f38">
                <div class="box">
                  <div class="box-header with-border text-center" style="background: #181f38; ">
                    <h1 class="box-title" style="color:#fff">- Consultas reporte de satisfacción por <strong> Fecha
                      </strong> - </h1>
                    <div class="box-tools pull-right" style="background: #181f38"></div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body">
                <div class="row">
                  <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Inicio</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                  </div>

                  <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Fin</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                  </div>

                  <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <label></label>
                    <div class="form-group has-success">
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn bg-purple" style="width:100%; height:100%; border-radius: 20px; font-size:20px" onclick="Cargar()"><i class="fa fa-search"></i> Mostrar Resultados</button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Satisfacción de los participantes -->
          <div class="col-md-12">
            <div class="box box-info" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
              <div class="box-header">
                <h3 class="box-title" style="font-size:17px; color:#fff">- Cantidad de compra de compra por participante -</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff">
                <table id="listaParticipantesxCursos" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="400" style=" color:#000;">
                  <thead>
                    <th>D.N.I</th>
                    <th>Nombre</th>
                    <th>Última compra</th>
                    <th>Curso</th>
                    <th>Diploma</th>
                    <th>Especialización</th>
                    <th>Course in House</th>
                    <th>Convenios</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>D.N.I</th>
                    <th>Nombre</th>
                    <th>Última compra</th>
                    <th>Curso</th>
                    <th>Diploma</th>
                    <th>Especialización</th>
                    <th>Course in House</th>
                    <th>Convenios</th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>

          <!-- Satisfacción de los participantes -->
          <!-- <div class="col-md-6">
        <div class="box box-info" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
          <div class="box-header with-border">
            <h3 class="box-title" style="font-size:17px; color:#fff;">- GRAFICO NIVEL DE SATISFACCIÓN (Cantidad) -</h3>
            <div class="box-tools pull-left">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <canvas id="graficosatisfaccion" width="300" height="600"></canvas>
          </div>
        </div>
      </div> -->
        </div>

      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <!-- Fin modal -->
  <?php
  } else {
    require 'notieneacceso.php';
  }
  require 'modulos/footer.php';
  ?>

  <script src="../public/js/Chart.js"></script>
  <script src="../public/js/Chart.bundle.min.js"></script>

  <script type="text/javascript">
    function Cargar() {
      ListaParticipantes();
      //  Graficosatisfaccion();
    }

    //  LISTA SATISFACCION DEL CLIENTE
    function ListaParticipantes() {
      var fecha_inicio = $("#fecha_inicio").val();
      var fecha_fin = $("#fecha_fin").val();

      tabla = $('#listaParticipantesxCursos').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
          'excelHtml5',
          'pdf'
        ],
        "ajax": {
          url: '../controladores/consultas.php?op=listaparticipantesxcurso',
          data: {
            fecha_inicio: fecha_inicio,
            fecha_fin: fecha_fin
          },
          type: "get",
          dataType: "json",
          error: function(e) {
            console.log(e.responseText);
          }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
          [2, "desc"]
        ] //Ordenar (columna,orden)
      }).DataTable();
    }

    // GRAFICO SATISFACCION DEL CLIENTE
    function Graficosatisfaccion() {
      var fecha_inicio = $("#fecha_inicio").val();
      var fecha_fin = $("#fecha_fin").val();

      $.ajax({
        url: '../controladores/consultas.php?op=graficosatisfaccion',
        type: 'POST',
        data: {
          fecha_inicio: fecha_inicio,
          fecha_fin: fecha_fin
        }
      }).done(function(resp) {
        if (resp.length > 0) {
          var nombre = [];
          var cantidad = [];
          var data = JSON.parse(resp);
          //alert(data[0][1]);
          for (var i = 0; i < data.length; i++) {
            nombre.push(data[i][0]);
            cantidad.push(data[i][1]);

          }
          CrearGraficosatisfaccion(nombre, cantidad);
        }
      })
    }

    function CrearGraficosatisfaccion(nombre, cantidad) {
      var ctx = document.getElementById("graficosatisfaccion").getContext('2d');
      var compras = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: nombre,
          datasets: [{
            label: ['S/. '],
            data: cantidad,
            backgroundColor: [
              'rgba(125, 170, 247, 0.3)',
              'rgba(240, 123, 114, 0.3)',
              'rgba(252, 208, 79, 0.3)',
              'rgba(125, 170, 247, 0.3)',
              'rgba(240, 123, 114, 0.3)',
              'rgba(252, 208, 79, 0.3)',
              'rgba(125, 170, 247, 0.3)',
              'rgba(240, 123, 114, 0.3)',
              'rgba(252, 208, 79, 0.3)',
              'rgba(125, 170, 247, 0.3)',
              'rgba(240, 123, 114, 0.3)',
              'rgba(252, 208, 79, 0.3)',
              'rgba(125, 170, 247, 0.3)',
              'rgba(240, 123, 114, 0.3)',
              'rgba(252, 208, 79, 0.3)'
            ],
            borderColor: [
              'rgba(125, 170, 247, 1)',
              'rgba(240, 123, 114, 1)',
              'rgba(252, 208, 79, 1)',
              'rgba(125, 170, 247, 1)',
              'rgba(240, 123, 114, 1)',
              'rgba(252, 208, 79, 1)',
              'rgba(125, 170, 247, 1)',
              'rgba(240, 123, 114, 1)',
              'rgba(252, 208, 79, 1)',
              'rgba(125, 170, 247, 1)',
              'rgba(240, 123, 114, 1)',
              'rgba(252, 208, 79, 1)',
              'rgba(125, 170, 247, 1)',
              'rgba(240, 123, 114, 1)',
              'rgba(252, 208, 79, 1)'

            ],
            borderWidth: 2
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            position: 'right',
          },
        }
      });
    }
  </script>

<?php
}
ob_end_flush();
?>