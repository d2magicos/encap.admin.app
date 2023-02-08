<?php
require 'modulos/header.php';

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

  $rsptav = $consulta->totalparticipantes();
  $regv=$rsptav->fetch_object();
  $totalp=$regv->idpersona;
  
//Datos para mostrar el gráfico de barras de las ventas ultimo 15 dias
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
 

//Datos para mostrar el gráfico de barras de las ventas de cada mes del año
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


//Datos para mostrar el grafico de barras de los medios de pagos
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

//Datos para mostrar el grafico de barras de forma de recaudacion
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

// Datos para mostrar el gráfico de barras de las ventas por categoria
  $ventascategoria = $consulta->montoventascategoria();
  $categoriaV='';
  $montoV='';
  while ($regventacategoriav= $ventascategoria->fetch_object()) {
    $categoriaV=$categoriaV.'"'.$regventacategoriav->categoria .'",';
    $montoV=$montoV.$regventacategoriav->monto .','; 
  }
  //Quitamos la última 
  $categoriaV=substr($categoriaV, 0, -1);
  $montoV=substr($montoV, 0, -1);
  
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

//Datos para mostrar el grafico de barras de ventas medios de pagos
  $ventasmediostrafico = $consulta->mediosdepagos();
  $nombreT='';
  $cantidadT='';
    while ($regmediosT=$ventasmediostrafico->fetch_object()) {
        $nombreT=$nombreT.'"'.$regmediosT->nombre .'",';
        $cantidadT=$cantidadT.$regmediosT->cantidad .','; 
    }
  //Quitamos la última coma
  $nombreT=substr($nombreT, 0, -1);
  $cantidadT=substr($cantidadT, 0, -1);


//Datos para mostrar el grafico de barras de ventas anulados
$ventasanulados = $consulta->ventasanulados();
$nombreA='';
$cantidadA='';
  while ($regventasA=$ventasanulados->fetch_object()) {
      $nombreA=$nombreA.'"'.$regventasA->nombre .'",';
      $cantidadA=$cantidadA.$regventasA->cantidad .','; 
  }
  //Quitamos la última coma
  $nombreA=substr($nombreA, 0, -1);
  $cantidadA=substr($cantidadA, 0, -1);

//Datos para mostrar grafico x mes y formato
  $ventasultimos_12mesesformato = $consulta->ventasultimos_12mesesformato();
  $fechaVF='';
  $formatoVF='';
  $cantidadVF='';
    while ($regventasultimos_12mesesformato=$ventasultimos_12mesesformato->fetch_object()) {
        $fechaVF=$fechaVF.'"'.$regventasultimos_12mesesformato->fecha .'",';
        $formatoVF=$formatoVF.'"'.$regventasultimos_12mesesformato->formato .'",';
        $cantidadVF=$cantidadVF.$regventasultimos_12mesesformato->cantidad .','; 
    }
  //Quitamos la última coma
  $fechaVF=substr($fechaVF, 0, -1);
  $formatoVF=substr($formatoVF, 0, -1);
  $cantidadVF=substr($cantidadVF, 0, -1);

//Datos para mostrar grafico x mes y formato monto
  $ventasultimos_12mesesformatomonto = $consulta->ventasultimos_12mesesformatomonto();
  $fechaVFM='';
  $formatoVFM='';
  $totalVM='';
    while ($regventasultimos_12monto=$ventasultimos_12mesesformatomonto->fetch_object()) {
        $fechaVFM=$fechaVFM.'"'.$regventasultimos_12monto->fecha .'",';
        $formatoVFM=$formatoVFM.'"'.$regventasultimos_12monto->formato .'",';
        $totalVM=$totalVM.$regventasultimos_12monto->total .','; 
    }
  //Quitamos la última coma
  $fechaVFM=substr($fechaVFM, 0, -1);
  $formatoVFM=substr($formatoVFM, 0, -1);
  $totalVM=substr($totalVM, 0, -1);

?>
<!--Contenido-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #181f38">      
    <section class="content" style="background: #181f38">
        <div class="row">
              <div class="col-md-12" style="background: #181f38">
                  <div class="box">
                    <div class="box-header with-border text-center" style="background: #181f38; ">
                          <h1 class="box-title" style="color:#fff">- REPORTE GENERAL <strong> ENCAP </strong> - </h1>
                          <div class="box-tools pull-right" style="background: #181f38"></div>
                    </div>
                  </div>
              </div>
                  <!-- /.box-header -->
                  <!-- centro -->
                  <div class="panel-body"  style="background: #181f38" >
                    <div class="row" style="background: #181f38">

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="small-box bg-green" >
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

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div  class="info-box bg-gray">
                                  <a  style="color:#d2d6de" href="producto.php"><span class="info-box-icon"><i class="fa fa-copy"></i></span></a>

                                  <div class="info-box-content">
                                    <span class="info-box-text">cursos</span>
                                    <span class="info-box-number"><?php echo $totalc; ?></span>

                                    <div class="progress">
                                      <?php  $porcentart=(100*$totalc)/800; ?>
                                      <?php echo '<div class="progress-bar" style="width: '.$porcentart.'%"></div>'; ?>
                                      
                                    </div>
                                    <span class="progress-description">
                                          <?php echo round($porcentart,2); ?>% de 800 cursos
                                        </span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="info-box bg-purple">
                                    <a style="color:#fff" href="categoria.php"><span href="categoria.php" class="info-box-icon"><i class="fa fa-files-o"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Participantes</span>
                                      <span class="info-box-number"><?php echo $totalp; ?></span>

                                      <div class="progress">
                                        <?php  $porcentcate=(100*$totalp)/4000; ?>
                                        <?php echo '<div class="progress-bar" style="width: '.$porcentcate.'%"></div>'; ?>
                                      </div>
                                      <span class="progress-description">
                                            <?php echo $porcentcate; ?>% total de 4000 participantes 
                                          </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                      </div>                     
                    </div>                
                  </div> <!--Fin centro -->
              </div><!-- /.col -->   
         <!--Fin centro -->
      

          <div class="row">

          <div class="col-md-4">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-success">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:14px;">* VENTAS TOTALES POR MES *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" style="color:#000">
                   <table id="tbllistadoventas" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                         <thead>
                           <th>Mes</th>
                           <th>Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Mes</th>
                           <th>Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div><!--/.box --> 
          <!-- VENTAS REALES POR ASESOR VS VENTAS PROYECTADAS -->   
            <div class="col-md-8" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
              <!-- AREA CHART -->
              <div class="box box-success"  style="background: #404040; color:#fff; flex-wrap: nowrap;   opacity: 50; transition: opacity 80s; ">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px; color:#fff;">- VENTAS TOTALES POR MES -</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <canvas id="ventas" width="100%" height="500"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.box -->

            <div class="col-md-4">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-info">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:14px;">* VENTAS TOTALES POR MES EN FORMATO DIGITAL Y FISICO *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000;">
                      <table id="tbllistadoventasformatosmonto" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                         <thead>
                           <th>Mes</th>
                           <th>Formato</th>
                           <th>Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Mes</th>
                           <th>Formato</th>
                           <th>Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div><!--/.box --> 

            <!-- VENTAS REALES POR ASESOR VS VENTAS PROYECTADAS -->   
            <div class="col-md-8" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
              <!-- AREA CHART -->
              <div class="box box-info"  style="background: #404040; color:#fff; flex-wrap: nowrap;   opacity: 50; transition: opacity 80s; ">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px; color:#fff;">-VENTAS TOTALES POR MES EN FORMATO DIGITAL Y FISICO  -</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <canvas id="ventascantidadformato" width="100%" height="500"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.box -->

            <div class="col-md-4">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-danger">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:14px;">* NÚMERO DE VENTAS POR MES EN FORMATO DIGITAL Y FISICO *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000;">
                      <table id="tbllistadoventasformatoscantidad" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                         <thead>
                           <th>Mes</th>
                           <th>Formato</th>
                           <th>N°</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                          <th>Mes</th>
                           <th>Formato</th>
                           <th>N°</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div><!--/.box --> 

            <!-- VENTAS REALES POR ASESOR VS VENTAS PROYECTADAS -->   
            <div class="col-md-8" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
              <!-- AREA CHART -->
              <div class="box box-danger"  style="background: #404040; color:#fff; flex-wrap: nowrap;   opacity: 50; transition: opacity 80s; ">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px; color:#fff;">- NÚMERO DE VENTAS POR MES EN FORMATO DIGITAL Y FISICO -</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <canvas id="ventasmontoformato" width="100%" height="400"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.box -->
          </div>

          <div class="row">
            <div class="col-md-4">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-warning">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:14px;">* TOTAL DE VENTAS POR DÍA - ÚLTIMOS 14 DIAS *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                      <table id="tbllistadoventas15dias" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                         <thead>
                           <th>Fecha</th>
                           <th>Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Fecha</th>
                           <th>Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div><!--/.box --> 

            <!-- VENTAS ULTIMOS 10 DIAS -->  
             <div class="col-md-8" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                <div class="box box-warning" style="background: #404040; color:#fff; flex-direction: row;flex-wrap: nowrap;   opacity: 50; transition: opacity 80s; ">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px; color:#fff;"> - TOTAL DE VENTAS POR DÍA - ÚLTIMOS 15 DIAS - </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="compras" width="100%" height="400"></canvas>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) -->   
        </div><!-- -->

      
        <div class="row">
          <div class="col-md-4">             
                <!-- LISTA DE CURSOS CORTOS -->
                <div class="box box-dark">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:14px;">* LISTA MEDIOS DE PAGOS *</h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                  <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                        <table id="tbllistadomediospagos" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                          <thead>
                            <th>Fecha</th>
                            <th>Medios de pagos</th>
                            <th>Cantidad</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Fecha</th>
                            <th>Medios de pagos</th>
                            <th>Cantidad</th>
                          </tfoot>
                      </table>
                  </div>
                </div> 
            </div><!--/.box --> 
            <div class="col-md-8">
              <!-- DONUT CHART  -->
              <div class="box box-dark" style="background: #404040; color:#fff; flex-wrap: nowrap;   opacity: 50; transition: opacity 80s; ">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;color:#fff"> MEDIOS DE PAGOS </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="mediospagos" width="500" height="600"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>            

          </div><!-- -->
       
       <div class="row">
            <div class="col-md-4">             
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-danger">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:14px;">* LISTA VENTAS ACTIVAS Y ANULADOS *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                      <table id="tbllistadoestadoventas" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                         <thead>
                           <th>Estado ventas</th>
                           <th>Cantidad</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Estado ventas</th>
                           <th>Cantidad</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div><!--/.box --> 

            <div class="col-md-8">
              <div class="box box-danger" style="background: #404040; color:#fff; flex-wrap: nowrap;   opacity: 50; transition: opacity 80s; ">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px;color:#fff"> TOTAL DE VENTAS ACTIVAS Y ANULADOS </h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                        <canvas id="ventasactivas" width="300" height="300"></canvas>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) --> 

       </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  
<?php
require 'modulos/footer.php';
?>
<script src="../public/js/Chart.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>

<script type="text/javascript" src="js/reportematricula.js"></script>
<script type="text/javascript">

  //VENTAS MESES  
var ctx = document.getElementById("ventas").getContext('2d');
var ventas = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasv; ?>],
        datasets: [{
            label: ' VENTAS  S/. ',
            data: [<?php echo $totalesv; ?>],
            backgroundColor: [
                'rgba(49, 148, 77, 0.2)',
                'rgba(190, 103, 89, 0.2)',
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
        },
        {
          type: 'line',
          fill: false,
          
            label: 'VENTAS PROYECTADAS S/. ',
            data: [ '35874.90','45664.39','37733.55'],
            backgroundColor: [
                'rgba(245, 126, 46, 0.2)'
                
            ],
            borderColor: [
                'rgba(245, 126, 46, 1)'
            ],
            borderWidth: 3
          }
        ]
    },
        
     options: {
      maintainAspectRatio: false, 
      scales: {
            yAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#afafaf'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: ' #fff '
                 }
             }]
         }
    }

});


  //GRAFICO VENTAS MONTO POR FORMATO
var ctx = document.getElementById("ventascantidadformato").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechaVFM; ?>],
        datasets: [{
            label: 'S/. ',
            data: [<?php echo $totalVM; ?>],
            backgroundColor: [
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)'

            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false, 
      legend: {
          display: false,
          
        },
        scales: {
            yAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#afafaf'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: ' #fff '
                 }
             }]
         }
    }
});

 //GRAFICO VENTAS MONTO POR FORMATO
 var ctx = document.getElementById("ventasmontoformato").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechaVF; ?>],
        datasets: [{
            label: 'N° ',
            data: [<?php echo $cantidadVF; ?>],
            backgroundColor: [
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(217, 158, 43, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(217, 158, 43, 1)'

            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false, 
      scales: {
            yAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#afafaf'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: ' #fff '
                 }
             }]
         }
    }
});

 //GRAFICO VENTAS DIARIAS 10
 var ctx = document.getElementById("compras").getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasc; ?>],
        datasets: [{
            label: ' S/.',
            data: [<?php echo $totalesc; ?>],
            backgroundColor: [
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(0, 255, 204,1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false, 
      scales: {
            yAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#afafaf'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: ' #fff '
                 }
             }]
         }
    }
});


// VENTAS ACTIVAS
var ctx = document.getElementById("ventasactivas").getContext('2d');
var compras = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $nombreA; ?>],
        datasets: [{
            //label: 'Personal con mas ventas',
            data: [<?php echo $cantidadA; ?>],
            backgroundColor: [
                'rgba(113, 194, 135, 0.2)',
                'rgba(215, 40, 40, 0.2)',
                'rgba(255, 153, 77, 0.2)'
            ],
            borderColor: [
                'rgba(113, 194, 135, 1)',
                'rgba(215, 40, 40, 1)',
                 'rgba(255, 153, 77, 1)'
                
            ]
        }]
    },
    options: {
      maintainAspectRatio: false, 
      legend: {
        position: 'right',
      },  
    }
});


// MEDIOS TRAFICO
var ctx = document.getElementById("mediospagos").getContext('2d');
var compras = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php echo $nombreT; ?>],
        datasets: [{
            //label: 'Personal con mas ventas',
            data: [<?php echo $cantidadT; ?>],
            backgroundColor: [
                'rgba(215, 40, 40, 0.2)',
                'rgba(255, 143, 35, 0.2)',
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
        }]
    },
    options: {
      maintainAspectRatio: false, 
       legend: {
        position: 'right',
      },    
  },
});

</script>




