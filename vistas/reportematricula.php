<?php
ob_start();
session_start();
//si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"]))
{
  header("Location: login.html");
}
else
{
require 'modulos/header.php';
if ($_SESSION['reportes']==1)
{

//require 'modulos/header.php';

require_once "../modelos/Consultas.php";
  $consulta = new Consultas();
  

  $rsptac = $consulta->totalmatriculas();
  $regc=$rsptac->fetch_object();
  $totalv=$regc->idmatricula;

  $rsptav = $consulta->totalcursos();
  $regv=$rsptav->fetch_object();
  $totalc=$regv->idcurso;

  $rsptav = $consulta->totalusuariosr();
  $regv=$rsptav->fetch_object();
  $totalu=$regv->idpersonal;

  $rsptav = $consulta->totalproveedoresr();
  $regv=$rsptav->fetch_object();
  $totalp=$regv->idpersona;

  // cantidad y monto CURSO CORTO
   $rsptav = $consulta->totalcantidadcortohoy();
   $regv=$rsptav->fetch_object();
   $totalcantidadcortohoy=$regv->cantidad;

   
   $rsptav = $consulta->totalmontocortohoy();
   $regv=$rsptav->fetch_object();
   $totalmontocortohoy=$regv->monto;

  // cantidad y monto DIPLOMA
    $rsptav = $consulta->totalcantidiplomahoy();
    $regv=$rsptav->fetch_object();
    $totalcantidiplomahoy=$regv->cantidad;
    
    $rsptav = $consulta->totalmontodiplomahoy();
    $regv=$rsptav->fetch_object();
    $totalmontodiplomahoy=$regv->monto;

   // cantidad y monto DIPLOMA ESPECIALIZACION
   $rsptav = $consulta->totalcantidaddiplomaeshoy();
   $regv=$rsptav->fetch_object();
   $totalcantidaddiplomaeshoy=$regv->cantidad;

   $rsptav = $consulta->totalmontodiplomaeshoy();
   $regv=$rsptav->fetch_object();
   $totalmontodiplomaeshoy=$regv->monto;

  // cantidad y monto HOY
    $rsptav = $consulta->ventatotalcantidadhoy();
    $regv=$rsptav->fetch_object();
    $ventatotalcantidadhoy=$regv->cantidad;
   
    $rsptav = $consulta->ventatotalmontohoy();
    $regv=$rsptav->fetch_object();
    $ventatotalmontohoy=$regv->monto;

  // cantidad y monto HOY FISICO
    $rsptav = $consulta->totalcantidadfisicohoy();
    $regv=$rsptav->fetch_object();
    $totalcantidadfisicohoy=$regv->cantidad;
   
    $rsptav = $consulta->totalmontofisicohoy();
    $regv=$rsptav->fetch_object();
    $totalmontofisicohoy=$regv->monto;
  
  // cantidad y monto HOY DIGITAL
    $rsptav = $consulta->totalcantidaddigitalhoy();
    $regv=$rsptav->fetch_object();
    $totalcantidaddigitalhoy=$regv->cantidad;
   
      $rsptav = $consulta->totalmontodigitalhoy();
      $regv=$rsptav->fetch_object();
      $totalmontodigitalhoy=$regv->monto;
  
 //Datos para mostrar el gráfico de barras de las compras
   $compras10 = $consulta->ventasultimos_10dias();
   $fechasc='';
   $totalesc='';
   while ($regfechac= $compras10->fetch_object()) {
     $fechasc=$fechasc.'"'.$regfechac->fecha .'",';
     $totalesc=$totalesc.$regfechac->total .','; 
   }
   //Quitamos la última coma
   $fechasc=substr($fechasc, 0, -1);
   $totalesc=substr($totalesc, 0, -1);
 

  // //Datos para mostrar el gráfico de barras de las ventas
   $ventas12 = $consulta->ventasultimos_12meses();
   $fechasv='';
   $totalesv='';
   while ($regfechav= $ventas12->fetch_object()) {
     $fechasv=$fechasv.'"'.$regfechav->fecha .'",';
     $totalesv=$totalesv.$regfechav->total .','; 
   }
   //Quitamos la última coma
   $fechasv=substr($fechasv, 0, -1);
   $totalesv=substr($totalesv, 0, -1);

   //Datos para mostrar el grafico de barras de los medios de pagos formarecaudacion

   $productosV = $consulta->mediosdepagos();
   $nombreV='';
   $productosm='';
   while ($regnombreV=$productosV->fetch_object()) {
     $nombreV=$nombreV.'"'.$regnombreV->nombre .'",';
     $productosm=$productosm.$regnombreV->cantidad .','; 
   }
   //Quitamos la última coma
   $nombreV=substr($nombreV, 0, -1);
   $productosm=substr($productosm, 0, -1);

    //Datos para mostrar el grafico de barras de formarecaudacion

   $formarecaudacionV = $consulta->formarecaudacion();
   $nombreF='';
   $cantidadF='';
   while ($regnombreF=$formarecaudacionV->fetch_object()) {
     $nombreF=$nombreF.'"'.$regnombreF->nombre .'",';
     $cantidadF=$cantidadF.$regnombreF->cantidad .','; 
   }
   //Quitamos la última coma
   $nombreF=substr($nombreF, 0, -1);
   $cantidadF=substr($cantidadF, 0, -1);

// // Datos para mostrar el gráfico de barras de las ventas por categoria
    $ventascategoria = $consulta->montoventascategoria();
    $categoriaV='';
    $montoV='';
    while ($regventacategoriav= $ventascategoria->fetch_object()) {
      $categoriaV=$categoriaV.'"'.$regventacategoriav->categoria .'",';
      $montoV=$montoV.$regventacategoriav->monto .','; 
    }
//    //Quitamos la última 
    $categoriaV=substr($categoriaV, 0, -1);
    $montoV=substr($montoV, 0, -1);


// Datos para mostrar el gráfico de ciudades mas vendidas
    $ciudadmas = $consulta->listaciudadesmas();
    $departamentoV='';
    $nV='';
    while ($regciudadmas= $ciudadmas->fetch_object()) {
      $departamentoV=$departamentoV.'"'.$regciudadmas->departamento .'",';
      $nV=$nV.$regciudadmas->n .','; 
    }
 //Quitamos la última 
    $departamentoV=substr($departamentoV, 0, -1);
    $nV=substr($nV, 0, -1);

  
// Datos para mostrar el gráfico de personal con mas ventas
$ventastotalpersonal = $consulta->ventaspersonal();
$personalV='';
$montopersonalV='';
while ($regventastotalpersonal= $ventastotalpersonal->fetch_object()) {
  $personalV=$personalV.'"'.$regventastotalpersonal->personal .'",';
  $montopersonalV=$montopersonalV.$regventastotalpersonal->monto .','; 
}
//Quitamos la última
$personalV=substr($personalV, 0, -1);
$montopersonalV=substr($montopersonalV, 0, -1);


?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content-header">
          <br>
          <ol class="breadcrumb">
            
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio </a></li>
            
            <li class="active">Panel de control</li>
          
          </ol>
        </section>
    <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Inicio </h1>
                          <small> - Reporte</small>
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
                  <div class="panel-body"  >
                    <div class="row" style="background:#F0F3F4">

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="small-box bg-green">
                          <div class="inner">
                            <h4 style="font-size:20px;">
                              <strong>  <?php echo $totalv; ?></strong>
                            </h4>
                            <p>Matriculados </p>
                          </div>
                          <div class="icon">                            
                             <a href="matricula.php" style="color:#008d4c"><i class="fa fa-file text-cyan"></i></a>
                          </div>
                          <a href="matricula.php" class="small-box-footer">Matriculas <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h4 style="font-size:20px;">
                              <strong> <?php echo $totalc; ?></strong>
                            </h4>
                            <p>Cursos </p>
                          </div>
                          <div class="icon">
                             <a href="curso.php" style="color:#00a3cb"><i class="fa fa-th"></i></a>
                          </div>
                          <a href="curso.php" class="small-box-footer">Cursos <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>                      

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="small-box bg-red ">
                          <div class="inner">
                            <h4 style="font-size:20px;">
                              <strong><?php echo $totalu; ?></strong>
                            </h4>
                            <p>Empleados </p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-user"></i>
                          </div>
                          <a href="empleado.php" class="small-box-footer">Empleados <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="small-box bg-yellow ">
                          <div class="inner">
                            <h4 style="font-size:20px;">
                              <strong><?php echo $totalp; ?></strong>
                            </h4>
                            <p>Participantes </p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-users"></i>
                          </div>
                          <a href="participantes.php" class="small-box-footer">Participantes <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div> 
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-md-4 col-sm-6 col-xs-6" style="border-radius: 10px;">
                        <h3 style="text-align:center"> Resumen de venta del día de hoy</h3>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#EC7063; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <P style="font-size:16px;">Cantidad: <strong><?php echo $totalcantidadcortohoy; ?></strong></P>
                            <P style="font-size:16px;">Monto:<strong> S/. <?php echo $totalmontocortohoy; ?></strong></p>

                            <h4 style="text-align:center">CURSO CORTO </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-file-o"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#EB984E; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <p style="font-size:16px;">Cantidad: <strong><?php echo $totalcantidiplomahoy; ?></strong></p>
                            <p style="font-size:16px;">Monto:<strong> S/. <?php echo $totalmontodiplomahoy; ?></strong></p>

                            <h4 style="text-align:center">DIPLOMA </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-file-text"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#F4D03F; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <p style="font-size:16px;">Cantidad: <strong><?php echo $totalcantidaddiplomaeshoy; ?></strong></p>
                            <p style="font-size:16px;">Monto:<strong> S/. <?php echo $totalmontodiplomaeshoy; ?></strong></p>

                            <h4 style="text-align:center;font-size:12px;">DIPLOMA DE ESPECIALIZACÓN </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-files-o"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#C0392B; color:#fff;  border-radius: 20px;text-align:center">
                          <div class="inner">
                            <h6 style="font-size:18px;">Cantidad: <strong><?php echo $totalcantidadfisicohoy; ?></strong></h6>
                            <h6 style="font-size:18px;">Monto:<strong> S/. <?php echo $totalmontofisicohoy; ?></strong></h6>

                            <h4 style="text-align:center;font-size:14px;">FORMATOS FISICOS </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-credit-card"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#2980B9; color:#fff;  border-radius: 20px; text-align:center">
                          <div class="inner">
                            <h6 style="font-size:18px;">Cantidad: <strong><?php echo $totalcantidaddigitalhoy; ?></strong></h6>
                            <h6 style="font-size:18px;">Monto:<strong> S/. <?php echo $totalmontodigitalhoy; ?></strong></h6>

                            <h4 style="text-align:center;font-size:14px;">FORMATOS DIGITALES </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-credit-card"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#E74C3C; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <h6 style="font-size:18px;">Cantidad: <strong><?php echo $ventatotalcantidadhoy; ?></strong></h6>
                            <h6 style="font-size:18px;">Monto:<strong> S/. <?php echo $ventatotalmontohoy; ?></strong></h6>

                            <h4 style="text-align:center;font-size:14px;">VENTAS TOTAL DEL DIA </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-usd"></i>
                          </div>
                        </div>
                      </div>   

                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->         
          </div>
              <!--------------------->

          <div class="row">
             <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;">Ventas - Últimos 10 días</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="compras" width="400" height="300"></canvas>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              <!-- AREA CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px;">Monto total de certificados , diplomas y diplomas de especialización</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <canvas id="montototalcategoria" width="400" height="300"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->


              </div> <!-- /.col (RIGHT) -->

            <div class="col-md-6">
              <!-- AREA CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px;">Ventas - Últimos 12 meses</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <canvas id="ventas" width="400" height="300"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <!-- LINE CHART -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px;">Cuidades mas vendidas</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="ciudadesmasvendidas" width="400" height="300"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->



            </div><!--/.col (LEFT) -->           
        </div><!-- -->

        <div class="row">

             <div class="col-md-6">
              <!-- DONUT CHART  -->
              <div class="box box-dark">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;"> Medios de pagos </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="pieChart" width="300" height="150"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            <!-- DONUT CHART  -->
            <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;"> Personal con mas ventas en monto S/. </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="personalmasventas" width="300" height="150"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) -->

            <div class="col-md-6">
              <!-- DONUT CHART  -->
              <div class="box box-dark">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;"> Ventas del Acesor: </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="pieChart" width="300" height="150"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            <!-- DONUT CHART  -->
            <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;"> Personal con mas ventas en monto S/. </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="personalmasventas" width="300" height="150"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) -->


            <div class="col-md-6">
          <!-- DONUT CHART  -->
               <div class="box box-white">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px;"> Formas de recaudación</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="formarRe" width="300" height="150"></canvas>
                </div><!-- /.box-body -->
               </div><!-- /.box -->

                <!-- BAR CHART -->
               <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px;">Lista de cursos mas vendidos</h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                  <div class="panel-body table-responsive" id="listadoregistros">
                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                          <thead>
                            <th>Nombre del curso</th>
                            <th>Categoría</th>
                            <th>N°</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>N°</th>
                          </tfoot>
                      </table>
                  </div>
                </div><!--/.box -->          

            </div><!--/.col (LEFT) -->           
          </div><!-- -->

          <!------------------->
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
  //GRFICO VENTAS DIARIAS 10
var ctx = document.getElementById("compras").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasc; ?>],
        datasets: [{
            label: 'Matriculas de los últimos 10 días S/.',
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

 //VENTAS MESES  
var ctx = document.getElementById("ventas").getContext('2d');
var ventas = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasv; ?>],
        datasets: [{
            label: 'Matriculas de los últimos 12 meses S/.',
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

// MEDIOS DE PAGOS
var ctx = document.getElementById("pieChart").getContext('2d');
var compras = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php echo $nombreV; ?>],
        datasets: [{
            label: 'Medios de pagos',
            data: [<?php echo $productosm; ?>],
            backgroundColor: [
                'rgba(215, 40, 40, 0.9)',
                'rgba(97, 103, 225, 0.9)',
                'rgba(255, 159, 65, 0.9)',
                'rgba(52, 168, 83, 0.9)',
                'rgba(255, 109, 1, 0.9)',
                'rgba(70, 189, 198, 0.9)',
                'rgba(123, 170, 247, 0.9)',
                'rgba(240, 123, 114, 0.9)',
                'rgba(252, 208, 79, 0.9)',
                'rgba(113, 194, 135, 0.9)',
                'rgba(255, 153, 77, 0.9)'
            ],
            borderColor: [
                'rgba(215, 40, 40, 1)',
                'rgba(97, 103, 225, 1)',
                'rgba(255, 159, 65, 1)',
                'rgba(52, 168, 83, 1)',
                'rgba(255, 109, 1, 1)',
                'rgba(70, 189, 198, 1)',
                'rgba(123, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)',
                'rgba(113, 194, 135, 1)',
                'rgba(255, 153, 77, 1)'
                
            ]
        }]
    },
    options: {
       legend: {
        position: 'right',
      },     

  },
     

});

//FORMA DE RECAUDACION
var ctx = document.getElementById("formarRe").getContext('2d');
var forma = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $nombreF; ?>],
        datasets: [{
            label: 'Forma de recaudación',
            data: [<?php echo $cantidadF; ?>],
            backgroundColor: [
                'rgba(250, 236, 155, 0.9)',
                'rgba(255, 181, 155, 0.9)',
                'rgba(245, 89, 94, 0.9)',
                'rgba(176, 242, 95, 0.9)',
                'rgba(70, 189, 198, 0.9)',
                'rgba(255, 153, 77, 0.9)'
            ],
            borderColor: [
                'rgba(250, 236, 155, 1)',
                'rgba(255, 181, 155, 1)',
                'rgba(245, 89, 94, 1)',
                'rgba(176, 242, 95, 1)',
                'rgba(70, 189, 198, 1)',
                'rgba(255, 153, 77, 1)'
                
            ]
        }]
    },
    options: {
        
    }
});

// CIUDADES MAS VENDIDAS BARA
var ctx = document.getElementById("ciudadesmasvendidas").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $departamentoV; ?>],

        datasets: [{
            label: 'Ciudades mas vendidas',
            data: [<?php echo $nV; ?>],
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
            borderWidth: 1,
            
        }]
    },
    options: {
      indexAxis: 'y',
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
               
                }
            }]
        }
    }

});

//MONT TOTAL POR CATEGORIA
var ctx = document.getElementById("montototalcategoria").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        //labels: ['CURSO CORTO','DIPLOMA','DIPLOMA DE ESPECIALIZACIÓN'],
        labels: [<?php echo $categoriaV; ?>],
        datasets: [{
            label: ' S/',
            data: [<?php echo $montoV; ?>],
            backgroundColor: [
                'rgba(215, 40, 40, 0.6)',
                'rgba(255, 143, 35, 0.6)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255, 143, 35, 1)',
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

// PERSONAL CON MAS VENTAS GRAFICO
var ctx = document.getElementById("personalmasventas").getContext('2d');
var compras = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $personalV; ?>],
        datasets: [{
            //label: 'Personal con mas ventas',
            data: [<?php echo $montopersonalV; ?>],
            backgroundColor: [
                'rgba(123, 170, 247, 0.9)',
                'rgba(240, 123, 114, 0.9)',
                'rgba(252, 208, 79, 0.9)',
                'rgba(113, 194, 135, 0.9)',
                'rgba(255, 153, 77, 0.9)'
            ],
            borderColor: [
                'rgba(123, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)',
                'rgba(113, 194, 135, 1)',
                'rgba(255, 153, 77, 1)'
                
            ]
        }]
    },
    options: {
        
    }
});


// PERSONAL CON MAS VENTAS GRAFICO
var ctx = document.getElementById("encapventasmes").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $personalV; ?>],
        datasets: [{
            //label: 'Personal con mas ventas',
            data: [<?php echo $montopersonalV; ?>],
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



</script>
<script type="text/javascript" src="js/reportematricula.js"></script>

