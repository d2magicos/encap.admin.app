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
?>

<!--Contenido-->
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <section class="content"  style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
            <div class="row" >
              <div class="col-md-12" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="panel " style="background: #181f38; color:#fff;">
                  <div class="col-md-12" style="background: #181f38">
                  <div class="box">
                    <div class="box-header with-border text-center" style="background: #181f38;">
                          <h1 class="box-title" style="color: #fff;" >- Consultas de Ventas por <strong>  Fecha </strong> - </h1>
                          
                    </div>
                  </div>
              </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body" >
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
                                        <button class="btn btn-success" style="width:100%; height:100%; border-radius: 20px; font-size:20px" onclick="Cargar()"><i class="fa fa-search"></i> Mostrar Resultados</button>
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
             <!-- Monto total  --> 
            <div class="row">
                <div class="col-md-3">
                </div>
                
            <div class="col-md-6" style="text-align:center;">
                <div class="panel-body table-responsive" style="background: #fff;color:#fff;text-align:center;">
                   <table id="ventamontototal" class="table table-striped table-bordered table-condensed table-hover" width="750" height="50"  style=" color:#000;">
                         <thead>
                           <th >Monto total</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th >Monto total</th>
                         </tfoot>
                     </table>
                 </div>
            </div>
            
            <div class="col-md-3">
                
            </div>
            </div>
            <br>
             
            <!-- N° de ventas por tipo y asesor -->  
            <div class="col-md-6" >
              <!-- tabla de ventas por mes -->
              <div class="box box-info" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                   <div class="box-header">
                     <h3 class="box-title" style="font-size:17px; color:#fff">- N° DE VENTAS POR ASESOR Y TIPO DE CURSO -</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff">
                   <table id="listanventasasesor"class="table table-striped table-bordered table-condensed table-hover" width="100%" height="400"  style=" color:#000;">
                         <thead>
                           <th>Asesor</th>
                           <th>Categoría</th>
                           <th >N°</th>
                           <th >Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Asesor</th>
                           <th>Categoría</th>
                           <th >N°</th>
                           <th >Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div> 

             <!-- N° de ventas por tipo y asesor -->  
            <div class="col-md-6" >
                  <div class="box box-info"  style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px; color:#fff;">- N° DE VENTAS POR ASESOR Y TIPO DE CURSO -</h3>
                      <div class="box-tools pull-left">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <canvas id="ventasportipoasesor" width="300" height="600"></canvas>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->              
            </div>
          </div>


          <div class="row">
            <!-- Monto de ventas por mes -->  
            <div class="col-md-6" >
              <div class="row">
                <div class="col-md-12">
                                <!-- tabla de ventas por mes -->
                  <div class="box box-danger" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                      <div class="box-header">
                        <h3 class="box-title" style="font-size:17px; color:#fff">- N° DE VENTAS POR ASESOR Y FORMATO (DIGITAL, FÍSICO) -</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                      </div>
                      <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff" >
                      <table id="listamontoventaspormes" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="300"  style="font-size:12px; color:#000;">
                            <thead>
                              <th>Asesor </th>
                              <th>Formato </th>
                              <th >Cantidad</th>
                              <th >Monto</th>
                            </thead>
                            <tbody>                            
                            </tbody>
                            <tfoot>
                              <th>Asesor</th>
                              <th>Formato </th>
                              <th>Cantidad</th>
                              <th>Monto</th>
                            </tfoot>
                        </table>
                      </div>
                  </div>  
                </div>
                <div class="col-md-12">
                  <!-- tabla de ventas por mes -->
                   <div class="box box-danger" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                      <div class="box-header">
                        <h3 class="box-title" style="font-size:17px; color:#fff">- MONTO TOTAL DE VENTAS POR ASESOR -</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                      </div>
                      <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff" >
                      <table id="listamontototalventaspormes" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="230"  style="font-size:12px; color:#000;">
                            <thead>
                              <th>Asesor </th>
                              <th >Monto</th>
                            </thead>
                            <tbody>                            
                            </tbody>
                            <tfoot>
                              <th>Asesor</th>
                              <th>Monto</th>
                            </tfoot>
                        </table>
                      </div>
                  </div>  

                </div>
              </div>                                
            </div><!-- -->

             <!-- Monto de ventas por mes -->  
            <div class="col-md-6" >
                  <div class="box box-danger" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap; ">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px; color:#fff;">- N° DE VENTAS POR ASESOR Y FORMATO (DIGITAL, FÍSICO) -</h3>
                      <div class="box-tools pull-left">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                    <canvas id="montoventaspormes" width="300" height="650" ></canvas>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->                               
            </div>                 
        </div><!-- -->


        <div>
          <br>
        </div>

        <div class="row">
            <!-- Ventas por categorias -->  
            <div class="col-md-6" >
              <div class="box box-warning" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap; ">
                   <div class="box-header">
                     <h3 class="box-title" style="font-size:17px; color:#fff"> - N° DE VENTAS POR TIPO DE CURSO -</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff">
                   <table id="listamontoCategoria"class="table table-striped table-bordered table-condensed table-hover" width="100%" height="300"  style=" color:#000;">
                         <thead>
                           <th>Categoría</th>
                           <th >Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Categoría</th>
                           <th >Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div> 

             <!-- Ventas por categorias -->  
          <div class="col-md-6" >
                <div class="box box-warning"  style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap; ">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px; color:#fff;">- N° DE VENTAS POR TIPO DE CURSO -</h3>
                    <div class="box-tools pull-left">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <canvas id="categoriasmonto" width="400" height="400"></canvas>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->              
          </div>
        </div><!-- -->

        <div class="row">
           <!-- Formatos fisico y digital  -->  
            <div class="col-md-6" >
              <div class="box box-success" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap; ">
                  <div class="box-header">
                     <h3 class="box-title" style="font-size:17px; color:#fff"> - N° DE VENTAS POR FORMATO (DIGITAL, FÍSICO) -</h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                  </div>
                  <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff" >
                   <table id="listaformatosfisicosdigital" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="300"  style=" color:#000;">
                         <thead>
                           <th>Categoria </th>
                           <th>Formato</th>
                           <th>Cantidad</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Categoria </th>
                           <th>Formato</th>
                           <th>Cantidad</th>
                         </tfoot>
                     </table>
                  </div>
              </div>                                  
          </div><!-- -->
         
            <!-- Formatos fisico y digital   -->  
          <div class="col-md-6" >
                <div class="box box-success" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px; color:#fff;">- N° DE VENTAS POR FORMATO (DIGITAL, FÍSICO) -</h3>
                    <div class="box-tools pull-left">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                  <canvas id="formatosfisicosdigital" width="400" height="400" ></canvas>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->                               
          </div>        
        </div><!-- -->

        <div>
          <br>
        </div>

        <div class="row">
            <div class="col-md-4">
              <!-- DONUT CHART  -->
              <div class="box box-danger" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;color:#fff"> - N° DE VENTAS POR MEDIOS DE PAGO - </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff" >
                   <table id="listamediospagos" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="550"  style="font-size:12px;color:#000;">
                         <thead>
                           <th>Medios de pagos </th>
                           <th>Cantidad</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Medios de pagos</th>
                           <th>Cantidad</th>
                         </tfoot>
                     </table>
                  </div>
              </div><!-- /.box -->
            </div><!-- /.box -->

            <div class="col-md-8">
              <div class="box box-danger" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;color:#fff"> - N° DE VENTAS POR MEDIOS DE PAGO -  </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="mediospagos" width="400" height="550"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) -->
            </div>

            <div class="row">
            <div class="col-md-4" >
              <div class="box box-white" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px; color:#fff"> - N° DE VENTAS POR FORMAS DE RECAUDACIÓN -</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff" >
                   <table id="listaformarecaudacion" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="400"  style="font-size:12px;color:#000;">
                         <thead>
                           <th>Formas de recaudación </th>
                           <th>Cantidad</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Formas de recaudación</th>
                           <th>Cantidad</th>
                         </tfoot>
                     </table>
                </div>
              </div><!-- /.box -->
            </div><!-- /.box -->

            <div class="col-md-8">
              <div class="box box-white" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;" >
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px;color:#fff"> - N° DE VENTAS POR FORMAS DE RECAUDACIÓN - </h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                        <canvas id="formarecaudacion" width="400" height="450"></canvas>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) -->
            </div>

          <div class="row">
            <div class="col-md-4" >
                <div class="box box-primary" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;color:#fff"> - MEDIOS DE TRÁFICO - </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff" >
                   <table id="listamediostrafico" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="400"  style="font-size:12px;color:#000;">
                         <thead>
                           <th>Medios de trafico </th>
                           <th>Cantidad</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Medios de trafico</th>
                           <th>Cantidad</th>
                         </tfoot>
                     </table>
                  </div>
              </div><!-- /.box -->
            </div><!-- /.box -->

            <div class="col-md-8" >
              <div class="box box-primary" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;color:#fff">- MEDIOS DE TRÁFICO -</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="mediostrafico" width="300" height="450"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) -->          
          <!------------------->
        </div><!-- /.row --> 

        
        <div class="row">
            <div class="col-md-4" >
                <div class="box box-primary" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;color:#fff"> * LISTA TOTAL DE VENTAS ACTIVAS Y ANULADOS * </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff" >
                   <table id="listaestadoventas" class="table table-striped table-bordered table-condensed table-hover" width="100%" height="300"  style="font-size:12px;color:#000;">
                         <thead>
                           <th>Estado Ventas </th>
                           <th>Cantidad</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Estado Ventas </th>
                           <th>Cantidad</th>
                         </tfoot>
                     </table>
                  </div>
              </div><!-- /.box -->
            </div><!-- /.box -->

            <div class="col-md-8" >
              <div class="box box-primary" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px;color:#fff">- TOTAL DE VENTAS ACTIVAS Y ANULADOS  -</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                      <canvas id="estadoventas" width="300" height="450"></canvas>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div> <!-- /.col (RIGHT) -->          
          <!------------------->
        </div><!-- /.row --> 
        
        <div>
          <br>
        </div>        

        <div class="row">
          <div class="col-md-3">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-success">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:17px;">* LISTA DEPARTAMENTOS MÁS VENDIDOS *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                   <table id="listadepartamentos" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                         <thead>
                           <th>Departamento</th>
                           <th>N°</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Departamento</th>
                           <th>N°</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div><!--/.box -->  

            <div class="col-md-9">               
               <!-- GRAFICO DE CIUDADES MAS VENDIDOS -->
              <div class="box box-success" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:17px;color:#fff"> - DEPARTAMENTOS MÁS VENDIDOS - </h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                  <div class="box-body">
                    <canvas id="cuidadesmasvendidos" width="100%" height="500"></canvas>
                  </div><!-- /.box-body -->
              </div> 
            </div><!--/.box -->  

        </div>

        <div class="row">
            <div class="col-md-4">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-success">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:17px;">* LISTA DE CURSOS MÁS VENDIDOS *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                   <table id="tbllistadocursos" class="table table-striped table-bordered table-condensed table-hover" width="100%">
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
              </div> 
            </div><!--/.box -->  


            <div class="col-md-4">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-success">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:17px;">* LISTA DE DIPLOMA MÁS VENDIDOS *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                   <table id="tbllistadodiplomas" class="table table-striped table-bordered table-condensed table-hover" width="100%">
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
              </div> 
            </div><!--/.box -->  

            <div class="col-md-4">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-success">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:17px;">* LISTA DE DIPLOMA DE ESPECIALIZACIÓN MÁS VENDIDOS *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                   <table id="tbllistadodiplomasesp" class="table table-striped table-bordered table-condensed table-hover" width="100%">
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
              </div> 
            </div><!--/.box -->  
        
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<!-- Fin modal -->
<?php
}
else
{
  require 'notieneacceso.php';
}
require 'modulos/footer.php';
?>

<script src="../public/js/Chart.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>

<script type="text/javascript">

  function Cargar(){
   
    Ventamontototal();
    Listacategoriaventasasesor();
    Categoriaventasasesor();
    Listamontoventaspormes();
    Montoventaspormes();
    Listamontototalventaspormes();

    ListamontoCategoria();
    MontoCategoria();
    ListacantidadCategoria();
    CantidadCategoria();

    Listamediospagos();
    MediosPagos();
    ListaformaRecaudacion();
    formaRecaudacion();
    ListamediosTrafico();
    MediosTrafico();
    Listaestadoventas();
    Estadoventas();

    Listadepartamentos();
    Ciudadesmasvendidos();

    listacursos();
    listadiplomas();
    listadiplomasesp();
  }

// // -* LISTA MONTO POR MES Y ASESOR 
function Ventamontototal(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#ventamontototal').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=ventamontototal',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	   // "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//LISTA N VENTAS X ASESOR
function Listacategoriaventasasesor(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listanventasasesor').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listacategoriaventasasesor',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    //"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
  
   //  GRAFICO - MONTO VENTAS X MES Y PERSONAL  ///
   function Categoriaventasasesor(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=categoriaventasasesor',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var personal =[];
         var categoria =[];
         var cantidad =[];
         var monto =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
             personal.push(data[i][0]);
             categoria.push(data[i][1]);
             cantidad.push(data[i][2]);
             monto.push(data[i][3]);           
          
           }
           CrearGraficoCategoriaventasasesor(personal,categoria,cantidad,monto);          
      }
    })
   }

  function CrearGraficoCategoriaventasasesor(personal,categoria,cantidad,monto){
    var ctx = document.getElementById("ventasportipoasesor").getContext('2d');   
    var compras = new Chart(ctx, {
    type: 'horizontalBar',    
    data: {
        labels: personal,
        datasets: [{
           label: ['N° '],
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
        }
        ]
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
                     fontColor: '#fff'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: ' #afafaf '
                 }
             }]
         }
    }
  });
 }

//LISTA MONTO POR MES ASESORES
function Listamontoventaspormes(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listamontoventaspormes').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listamontoventaspormes',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    //"order": [[ 3, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

// // -* LISTA MONTO POR MES Y ASESOR 
function Listamontototalventaspormes(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listamontototalventaspormes').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listamontototalventaspormes',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	   // "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//  GRAFICO - MONTO VENTAS X MES Y PERSONAL 
  function Montoventaspormes(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=montoventaspormes',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var personal =[];
         var monto =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
             personal.push(data[i][0]);
             monto.push(data[i][1]);           
          
           }
           CrearGraficoMontoventaspormes(personal,monto);          
      }
    })
   }

  function CrearGraficoMontoventaspormes(personal,monto){
    var ctx = document.getElementById("montoventaspormes").getContext('2d');   
    var compras = new Chart(ctx, {
    type: 'horizontalBar',
    
    data: {
        labels: personal,
        datasets: [{
          label: [' S/.'],
            data: monto,
            backgroundColor: [
                'rgba(125, 170, 247, 0.3)',
                'rgba(240, 123, 114, 0.3)',
                'rgba(252, 208, 79, 0.3)',
                'rgba(113, 194, 135, 0.3)',
                'rgba(225, 78, 202, 0.3)',
                'rgba(255, 99, 132, 0.3)',
                'rgba(54, 162, 235, 0.3)',
                'rgba(255, 153, 77, 0.3)'
            ],
            borderColor: [
                'rgba(125, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)',
                'rgba(113, 194, 135, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 153, 77, 1)'                
            ],
            borderWidth: 2
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
                     fontColor: '#fff'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: ' #afafaf '
                 }
             }]
         }
    }
  });
 }

  
   //  Lista y grafico CATEGORIAS  
function ListamontoCategoria(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listamontoCategoria').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
     
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	  buttons: [
              'excelHtml5',
		          'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listamontoCategoria',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    //"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
      stateSave: true,
	}).DataTable();
}

function MontoCategoria(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=categoriasmonto',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
             var data = JSON.parse(resp);
      if(resp.length > 0){
         var monto =[];
         var categoria =[];        
     
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
             categoria.push(data[i][0]);
             monto.push(data[i][1]);         
           }
           CrearGraficoMontoCategoria(categoria,monto);          
      }
    })
   }

  function CrearGraficoMontoCategoria(categoria,monto){
    var ctx = document.getElementById("categoriasmonto").getContext('2d');
     var compras = new Chart(ctx, {
      type: 'bar',
    data: {
        labels: categoria,
        datasets: [{
            label: [' S/.'],
            data: monto,
            backgroundColor: [
                'rgba(215, 99, 132, 0.2)',
                'rgba(255, 143, 35, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 143, 35, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 2
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
                     fontColor: '#ccc'
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
}


   //  LISTA Y GRAFICO CATEGORIAS CANTIDAD 
function ListacantidadCategoria(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listaformatosfisicosdigital').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	  buttons: [
              'excelHtml5',
		          'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listacantidadCategoria',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function CantidadCategoria(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=categoriascantidad',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var cantidad =[];
         var categoria =[]; 
         var formato =[];        

         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
             categoria.push(data[i][0]);
             formato.push(data[i][1]); 
             cantidad.push(data[i][2]);          
           }
           CrearGraficoCantidadCategoria(categoria,formato,cantidad);          
      }
    })
   }

  function CrearGraficoCantidadCategoria(categoria,formato,cantidad){

    var ctx = document.getElementById("formatosfisicosdigital").getContext('2d');
     var compras = new Chart(ctx, {
      type: 'horizontalBar',
    data: {
        labels: categoria,
        datasets: [{
            label: 'N° ',
            data: cantidad,
            backgroundColor: [
                'rgba(215, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(215, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(215, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(215, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
      maintainAspectRatio: false,
      legend: {
                display: false,
                position: 'bottom',
                labels: {
                    color: 'blue'
                },
            },
       scales: {
            yAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#ccc'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#fff'
                 }
             }]
         }
    }
});
}


//LISTA MEDIOS DE PAGOS
function Listamediospagos(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listamediospagos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	  buttons: [
               'excelHtml5',
		           'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listamediosdepagos',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

 // GRAFICO - MEDIOS DE PAGOS 
 function MediosPagos(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=mediospagos',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var nombre =[];
         var cantidad=[];      
         var data = JSON.parse(resp);    
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
             nombre.push(data[i][0]);  
             cantidad.push(data[i][1]);          
          
           }
           CrearGraficoMediosPagos(nombre,cantidad);          
      }
    })
   }

  function CrearGraficoMediosPagos(nombre,cantidad){
    var ctx = document.getElementById("mediospagos").getContext('2d'); 
    var compras = new Chart(ctx, {
      type: 'doughnut',
    data: {
        labels: nombre,
        datasets: [{
            data: cantidad,
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
                'rgba(25, 226, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false,
       legend: {
        position: 'right',
      },   
  },  
});
}


   //  FORMAS DE RECAUDACION  ///
//LISTA FORMAS DE RECAUDACION 
function ListaformaRecaudacion(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listaformarecaudacion').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	  buttons: [
               'excelHtml5',
		           'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=ListaformaRecaudacion',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

  function formaRecaudacion(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=formaderecaudacion',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var nombre =[];
         var cantidad =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
             nombre.push(data[i][0]);
             cantidad.push(data[i][1]);           
          
           }
           CrearGraficoFormaRecaudacion(nombre,cantidad);          
      }
    })
   }


  function CrearGraficoFormaRecaudacion(nombre,cantidad){
    var ctx = document.getElementById("formarecaudacion").getContext('2d');   
    var compras = new Chart(ctx, {
      type: 'doughnut',
    data: {
        labels: nombre,
        datasets: [{
            data: cantidad,
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
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(0, 255, 204, 1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false,
       legend: {
        position: 'right',
      },   
  },  
});
 }


//  MEDIOS DE TRAFICOS  ///
//LISTA MEDIOS DE TRAFICOS 
function ListamediosTrafico(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listamediostrafico').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	  buttons: [
               'excelHtml5',
		           'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=ListamediosTrafico',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function MediosTrafico(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=mediostrafico',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var nombre =[];
         var cantidad =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
          nombre.push(data[i][0]);
          cantidad.push(data[i][1]);           
          
           }
           CrearGraficoMediosTrafico(nombre,cantidad);          
      }
    })
   }


  function CrearGraficoMediosTrafico(nombre,cantidad){
    var ctx = document.getElementById("mediostrafico").getContext('2d');   
    var compras = new Chart(ctx, {
      type: 'doughnut',
    data: {
        labels: nombre,
        datasets: [{
            label: '',
            data: cantidad,
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
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(0, 255, 204, 1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false,
       legend: {
        position: 'right',
      },   
  },   
});
 }
 

 //  ESTADO DE VENTAS  ///
//LISTA ESTADO DE VENTAS
function Listaestadoventas(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listaestadoventas').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	  buttons: [
               'excelHtml5',
		           'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listaestadoventas',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

 // GRAFICO - MEDIOS DE PAGOS 
 function Estadoventas(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=estadoventas',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var nombre =[];
         var cantidad=[];      
         var data = JSON.parse(resp);    
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
             nombre.push(data[i][0]);  
             cantidad.push(data[i][1]);          
          
           }
           CrearGraficoEstadoventas(nombre,cantidad);          
      }
    })
   }

  function CrearGraficoEstadoventas(nombre,cantidad){
    var ctx = document.getElementById("estadoventas").getContext('2d'); 
    var compras = new Chart(ctx, {
      type: 'doughnut',
    data: {
        labels: nombre,
        datasets: [{
            data: cantidad,
            backgroundColor: [
              
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 226, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
               
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false,
       legend: {
        position: 'right',
      },   
  },  
});
}


// CIUDADES MAS VENDIDAS BARA
//LISTA CIUDADES MAS VENDIDOS
function Listamas(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listamas').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	  buttons: [
              'excelHtml5',
		          'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listamas',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


function Ciudadesmasvendidos(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=ciudadesmasvendidos',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var departamento =[];   
         var n =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
          departamento.push(data[i][0]);
          n.push(data[i][1]);                     
           }
           CrearGraficoCiudadesmasvendidos(departamento,n);          
      }
    })
   }

function CrearGraficoCiudadesmasvendidos(departamento,n){
  var ctx = document.getElementById("cuidadesmasvendidos").getContext('2d'); 
    var compras = new Chart(ctx, {
      type: 'bar',
    data: {
        labels: departamento,
        datasets: [{
            //label: nombre,
            data: n,
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
                'rgba(25, 226, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 266, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false,  
      legend: {
          display: false,          
        },
  },  
});
}


 //Función Listar cursos cortos
 function listacursos(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#tbllistadocursos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listacursos',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 2, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}



 //Función Listar diploma
 function listadiplomas(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#tbllistadodiplomas').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadiplomas',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 2, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}



 //Función Listar diploma espe
 function listadiplomasesp(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#tbllistadodiplomasesp').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadiplomasesp',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 2, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


 //Función Listar diploma espe
 function Listadepartamentos(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listadepartamentos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadepartamentos',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 8,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


</script>

<?php 
}
ob_end_flush();
?>