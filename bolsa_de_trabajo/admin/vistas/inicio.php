<?php
require 'modulos/header.php';

require_once "../modelos/Consultas.php";
  $consulta = new Consultas();  
  
// ---------------------------   VISTA INICIO  --------------------------- ///

// Gadget de accesos directos vista inicio
  $rsptac = $consulta->totalempleos();
  $regc=$rsptac->fetch_object();
  $totale=$regc->idempleo;

  $rsptav = $consulta->totalpersonal();
  $regv=$rsptav->fetch_object();
  $totalp=$regv->idpersonal;

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Inicio </h1>
                          <small>Panel de control</small>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                          </button>
                          <button class="btn btn-box-tool" data-widget="remove">
                          <i class="fa fa-times"></i>
                          </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                            <h4 style="font-size:20px;">
                            <input type="hidden" class="form-control" name="fecha" id="fecha" >
                            <input type="hidden" class="form-control"  >

                                <strong>  <?php echo $totale;?></strong>
                            </h4>
                            <p>Empleos </p>
                            </div>
                            <div class="icon">                            
                            <a href="empleo.php" style="color:#008d4c"><i class="fa fa-file"></i></a>
                            </div>
                            <a href="empleo.php" class="small-box-footer">Empleos <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                            <h4 style="font-size:20px;">
                                <strong> <?php echo $totalp; ?></strong>
                            </h4>
                            <p>Personal </p>
                            </div>
                            <div class="icon">
                            <a href="empleado.php" style="color:#00a3cb"><i class="fa fa-users"></i></a>
                            </div>
                            <a href="empleado.php" class="small-box-footer">Personal <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                        </div>       
    

              
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->

              <!--------------------->
          </div><!-- /.row -->


      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<?php
require 'modulos/footer.php';
?>
<script src="../public/js/Chart.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById("compras").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasc; ?>],
        datasets: [{
            label: 'Compras en S/ de los últimos 10 días',
            data: [<?php echo $totalesc; ?>],
            backgroundColor: [
                'rgba(215, 40, 40, 0.6)',
                'rgba(255, 143, 35, 0.6)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255, 143, 35, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

var ctx = document.getElementById("ventas").getContext('2d');
var ventas = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $fechasv; ?>],
        datasets: [{
            label: 'Ventas en S/ de los últimos 12 meses',
            data: [<?php echo $totalesv; ?>],
            backgroundColor: [
                'rgba(49, 148, 77, 0.6)',
                'rgba(190, 103, 89, 0.6)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(49, 164, 89, 1)',
                'rgba(190, 103, 89, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                stacked: true
            }]
        }
    }
});

var ctx = document.getElementById("pieChart").getContext('2d');
var compras = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php echo $nombreV; ?>],
        datasets: [{
            label: 'Productos más Vendidos',
            data: [<?php echo $productosm; ?>],
            backgroundColor: [
                'rgba(215, 40, 40, 0.9)',
                'rgba(97, 103, 225, 0.9)',
                'rgba(255, 159, 65, 0.9)'
            ],
            borderColor: [
                'rgba(215, 40, 40, 1)',
                'rgba(97, 103, 225, 1)',
                'rgba(255, 159, 65, 1)'
            ]
        }]
    },
    options: {
        
    }
});
</script>
<script type="text/javascript" src="js/stockproducto.js"></script>
