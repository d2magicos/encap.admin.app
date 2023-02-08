<?php
if (strlen(session_id()) < 1) 
  session_start();


require 'modulos/header.php';

require_once "../modelos/Consultas.php";
  $consulta = new Consultas();  
  
// ---------------------------   VISTA INICIO ADMINISTRATIVA --------------------------- ///
  $idpersonal=$_SESSION["idpersonal"];
// Gadget de accesos directos vista inicio
  $rsptac = $consulta->totalmatriculas();
  $regc=$rsptac->fetch_object();
  $totalv=$regc->idmatricula;

  $rsptav = $consulta->totalcursos();
  $regv=$rsptav->fetch_object();
  $totalc=$regv->idcurso;

  $rsptav = $consulta->totalenvios();
  $regv=$rsptav->fetch_object();
  $totalen=$regv->idenvio;

  $rsptav = $consulta->totalparticipantes();
  $regv=$rsptav->fetch_object();
  $totalp=$regv->idpersona;  

// cantidad y monto CURSO CORTO HOY
  $rsptav = $consulta->totalcantidadcortohoy();
  $regv=$rsptav->fetch_object();
  $totalcantidadcortohoy=$regv->cantidad;
  
    
  $rsptav = $consulta->totalmontocortohoy();
  $regv=$rsptav->fetch_object();
  $totalmontocortohoy=$regv->monto;
  
// cantidad y monto DIPLOMA HOY
  $rsptav = $consulta->totalcantidiplomahoy();
  $regv=$rsptav->fetch_object();
  $totalcantidiplomahoy=$regv->cantidad;
     
  $rsptav = $consulta->totalmontodiplomahoy();
  $regv=$rsptav->fetch_object();
  $totalmontodiplomahoy=$regv->monto;
  
// cantidad y monto DIPLOMA ESPECIALIZACION HOY
  $rsptav = $consulta->totalcantidaddiplomaeshoy();
  $regv=$rsptav->fetch_object();
  $totalcantidaddiplomaeshoy=$regv->cantidad;
  
  $rsptav = $consulta->totalmontodiplomaeshoy();
  $regv=$rsptav->fetch_object();
  $totalmontodiplomaeshoy=$regv->monto;
  
// ventas cantidad y monto HOY
  $rsptav = $consulta->ventatotalcantidadhoy();
  $regv=$rsptav->fetch_object();
  $ventatotalcantidadhoy=$regv->cantidad;
    
    $rsptav = $consulta->ventatotalmontohoy();
    $regv=$rsptav->fetch_object();
    $ventatotalmontohoy=$regv->monto;
  
// cantidad y monto fisico hoy 
  $rsptav = $consulta->totalcantidadfisicohoy();
  $regv=$rsptav->fetch_object();
  $totalcantidadfisicohoy=$regv->cantidad;
    
    $rsptav = $consulta->totalmontofisicohoy();
    $regv=$rsptav->fetch_object();
    $totalmontofisicohoy=$regv->monto;
   
// cantidad y monto digital hoy
  $rsptav = $consulta->totalcantidaddigitalhoy();
  $regv=$rsptav->fetch_object();
  $totalcantidaddigitalhoy=$regv->cantidad;
    
    $rsptav = $consulta->totalmontodigitalhoy();
    $regv=$rsptav->fetch_object();
    $totalmontodigitalhoy=$regv->monto;

        // ---------------------------   VISTA INICIO GENERAL --------------------------- ///
// CUENTA DE CANTIDAD DE VISTA PARA MATRICULAS
  $rsptav = $consulta->cantidadpendienteenviodigitalgeneral();
  $regv=$rsptav->fetch_object();
  $cantidadPDG=$regv->cantidad; 

  $rsptav = $consulta->cantidadpendienteenviofisigeneral();
  $regv=$rsptav->fetch_object();
  $cantidadEPG=$regv->cantidad;  

  $rsptav = $consulta->cantidadreclamospendientesgeneral();
  $regv=$rsptav->fetch_object();
  $cantidadRPG=$regv->cantidad;  

  $rsptav = $consulta->cantidadsatisfaccionclientegeneral();
  $regv=$rsptav->fetch_object();
  $cantidadSPG=$regv->cantidad;  

    // ---------------------------   VISTA INICIO MATRICULA --------------------------- ///
// CUENTA DE CANTIDAD DE VISTA PARA MATRICULAS
  $rsptav = $consulta->cantidadpendienteenviodigitalpersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadPF=$regv->cantidad; 

  $rsptav = $consulta->cantidadpendienteenviofisicopersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadPD=$regv->cantidad;  

  $rsptav = $consulta->cantidadreclamospendientespersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadRP=$regv->cantidad;  

  $rsptav = $consulta->cantidadsatisfaccionclientepersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadSP=$regv->cantidad;  



    // ---------------------------   VISTA INICIO ENVIO --------------------------- ///
// CUENTA DE CANTIDAD DE VISTA PARA ENVIOS 
  $rsptav = $consulta->cantidadpendienteenvios();
  $regv=$rsptav->fetch_object();
  $cantidadPEnvio=$regv->cantidad; 

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
                          <h1 class="box-title">- *** Bienvenido al SISTEMA (ENCAP) *** -</h1>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                    <div class="row">

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="small-box bg-green">
                          <div class="inner">
                            <h4 style="font-size:20px;">
                            <input type="hidden" class="form-control" name="fecha" id="fecha" >
                            <input type="hidden" class="form-control" id="idpersonal" value="<?php echo $_SESSION["idpersonal"]; ?>" >

                              <strong>  <?php echo $totalv;?></strong>
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
                              <strong><?php echo $totalen; ?></strong>
                            </h4>
                            <p>Gestion de Envios </p>
                          </div>
                          <div class="icon">
                          <a href="listadeenvios.php" style="color: #a33024"><i class="fa fa-ambulance"></i></a>
                          </div>
                          <a href="listadeenvios.php" class="small-box-footer">Gestion de Envios <i class="fa fa-arrow-circle-right"></i></a>
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
                          <a href="participantes.php" style="color:#c88142"><i class="fa fa-users"></i></a>
                          </div>
                          <a href="participantes.php" class="small-box-footer">Participantes <i class="fa fa-arrow-circle-right"></i></a>
                          
                        </div>
                      </div>

                     </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->

              <!------------ ** Resumen ventas del Dia  ** --------->


              
            <?php 
            if ($_SESSION['administrativa']==1)
            {
              echo '
                    <div class="row"  style="background:#fff;">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-radius: 10px;">
                        <h3 style="text-align:center; text-decoration:underline "> Resumen de venta del día de hoy'; ?> <strong> <?php  $fechaActual = date('d-m-Y');   echo $fechaActual;?> </strong> <?php echo '</h3>
                      </div>
                    </div>
                    
                    <div class="row"  style="background:#fff;">
                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#EC7063; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <P style="font-size:16px;">Cantidad: <strong>';  ?> <?php echo $totalcantidadcortohoy; ?> <?php echo '</strong></P>
                            <P style="font-size:16px;">Monto:<strong> S/. ';  ?>  <?php echo $totalmontocortohoy; ?> <?php echo '</strong></p>

                            <h4 class="small-box-footer" style="text-align:center;font-size:12px;">CURSO CORTO </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-file-o"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#EB984E; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <p style="font-size:16px;">Cantidad: <strong> ';  ?> <?php echo $totalcantidiplomahoy; ?> <?php echo '</strong></p>
                            <p style="font-size:16px;">Monto:<strong> S/. ';  ?> <?php echo $totalmontodiplomahoy; ?> <?php echo '</strong></p>

                            <h4 class="small-box-footer" style="text-align:center;font-size:12px;">DIPLOMA </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-file-text"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#F4D03F; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <p style="font-size:16px;">Cantidad: <strong> ';  ?> <?php echo $totalcantidaddiplomaeshoy; ?> <?php echo '</strong></p>
                            <p style="font-size:16px;">Monto:<strong> S/. ';  ?>  <?php echo $totalmontodiplomaeshoy; ?> <?php echo '</strong></p>

                            <h4 class="small-box-footer" style="text-align:center;font-size:11px;">DIPLOMA DE ESPECIALIZACÓN </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-files-o"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#C0392B; color:#fff;  border-radius: 20px;text-align:center">
                          <div class="inner">
                            <h6 style="font-size:16px;">Cantidad: <strong> ';  ?> <?php echo $totalcantidadfisicohoy; ?> <?php echo '</strong></h6>
                            <h6 style="font-size:16px;">Monto:<strong> S/. ';  ?> <?php echo $totalmontofisicohoy; ?> <?php echo '</strong></h6>

                            <h4 class="small-box-footer" style="text-align:center;font-size:14px;">FORMATOS FISICOS </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-credit-card"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#2980B9; color:#fff;  border-radius: 20px; text-align:center">
                          <div class="inner">
                            <h6 style="font-size:16px;">Cantidad: <strong> ';  ?> <?php echo $totalcantidaddigitalhoy; ?> <?php echo '</strong></h6>
                            <h6 style="font-size:16px;">Monto:<strong> S/. ';  ?> <?php echo $totalmontodigitalhoy; ?> <?php echo '</strong></h6>

                            <h4 class="small-box-footer" style="text-align:center;font-size:14px;">FORMATOS DIGITALES </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-credit-card"></i>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="small-box" style="background:#E74C3C; color:#fff;  border-radius: 20px;">
                          <div class="inner">
                            <h6 style="font-size:16px;">Cantidad: <strong> ';  ?> <?php echo $ventatotalcantidadhoy; ?> <?php echo '</strong></h6>
                            <h6 style="font-size:16px;">Monto:<strong> S/. ';  ?> <?php echo $ventatotalmontohoy; ?> <?php echo '</strong></h6>

                            <h4 class="small-box-footer" style="text-align:center;font-size:14px;">VENTAS TOTAL DEL DIA </h4>
                          </div>
                          <div class="icon">
                            <i class="fa fa-usd"></i>
                          </div>
                        </div>
                      </div> 

                    </div>  <BR> <BR>
                    
                    
                    <div class="row">
                    <div class="col-md-12">
                       <!-- DONUT CHART  -->
                        <div class="box box-success">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size:15px;">Hola, <strong> ';   ?> <?php echo $_SESSION["nombre"] ?>
                           <?php   echo '  </strong> tienes <strong style="color: red; font-size:18px"> ';?> <?php echo $cantidadPDG; ?> 
                           <?php   echo ' registros pendientes</strong> en <b>estado pendiente  </b> </h3>
                          </div>
                          <div class="panel-body table-responsive" id="listadoregistros">
                          <h5>(DIGITAL) Lista de matriculas PENDIENTE </h5>
                              <table id="tbllistadpendienteenviodigitalgeneral" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                              <thead>
                                <th>Fecha de matricula</th>
                                <th>Personal</th>
                                <th>Codigo matricula</th>
                                <th>Participante</th>
                                <th>DNI </th>
                                <th>Celular</th>
                                <th style="color:#1abc9c">Curso</th>
                                <th style="color:#1abc9c">Tipo</th>
                                <th style="color:#1abc9c">Fecha</th>
                                <th >Formato</th>
                                <th>Prioridad</th>
                                <th style="color:red">Envío Digital</th>
                                <th>Observaciones</th>
                              </thead>
                              <tbody>                            
                              </tbody>
                              <tfoot>
                                <th>Fecha de matricula</th>
                                <th>Personal</th>
                                <th>Codigo matricula</th>
                                <th>Participante</th>
                                <th>DNI </th>
                                <th>Celular</th>
                                <th style="color:#1abc9c">Curso</th>
                                <th style="color:#1abc9c">Tipo</th>
                                <th style="color:#1abc9c">Fecha</th>
                                <th >Formato</th>
                                <th>Prioridad</th>
                                <th style="color:red">Envío Digital</th>
                                <th>Observaciones</th>
                              </tfoot>
                            </table>
                          </div>
                        </div><!-- /.box -->
                    </div><!-- /.box -->
      
                    <div class="col-md-12">
                        <div class="box box-success">
                          <div class="box-header with-border">
                            <h3 class="box-title" style="font-size:15px;"> Hola, <strong>';  ?>
                            <?php echo $_SESSION["nombre"] ?>
                            <?php   echo '</strong> tienes <strong style="color: red; font-size:18px">';   ?>
                            <?php echo $cantidadEPG; ?>
                            <?php   echo ' registros pendientes </strong>  en  <b>envío en proceso </b> </h3>
                          </div>
                          <div class="panel-body table-responsive" id="listadoregistros">
                            <h5>(FÍSICO) Lista de certificados por envíar PENDIENTE </h5>
                              <table id="tbllistapendienteenviosfisicosgeneral" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                                <thead>
                                  <th>Fecha de matricula</th>
                                  <th>Personal</th>
                                  <th>Codigo matricula</th>
                                  <th>Participante</th>
                                  <th>DNI </th>
                                  <th>Celular</th>
                                  <th style="color:#1abc9c">Curso</th>
                                  <th style="color:#1abc9c">Tipo</th>
                                  <th>Lugar de envío</th>
                                  <th style="color:red">Estado de Envío</th>
                                  <th>Observaciones</th>
                                </thead>
                                <tbody>                            
                                </tbody>
                                <tfoot>
                                  <th>Fecha de matricula</th>
                                  <th>Personal</th>
                                  <th>Codigo matricula</th>
                                  <th>Participante</th>
                                  <th>DNI </th>
                                  <th>Celular</th>
                                  <th style="color:#1abc9c">Curso</th>
                                  <th style="color:#1abc9c">Tipo</th>
                                  <th>Lugar de envío</th>
                                  <th style="color:red">Estado de Envío</th>
                                  <th>Observaciones</th>
                                </tfoot>
                              </table>
                          </div>
                        </div><!-- /.box -->
                    </div><!-- /.box -->
                  </div><!-- /.box -->
                  
                  <div class="row">
                  <div class="col-md-12">
                     <!-- DONUT CHART  -->
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="font-size:15px;">Hola, <strong> ';   ?> <?php echo $_SESSION["nombre"] ?>
                         <?php   echo '  </strong> tienes <strong style="color: red; font-size:18px"> ';?> <?php echo $cantidadRPG; ?> 
                         <?php   echo ' registros pendientes </strong> en  <b>estado pendiente</b> </h3>
  
                        </div>
                        <div class="panel-body table-responsive" id="listadoregistros">
                        <h5>Lista de reclamos PENDIENTES </h5>
                          <table id="tbllistareclamospendientesgeneral" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                            <thead>
                              <th>Fecha de reclamo</th>
                              <th>Personal</th>
                              <th>Codigo matricula</th>
                              <th>Participante</th>
                              <th>DNI</th>
                              <th>Celular</th>
                              <th style="color:#1abc9c">Curso</th>
                              <th style="color:#1abc9c">Tipo</th>
                              <th style="color:#1abc9c">Fecha</th>
                              <th>Asunto</th>
                              <th>Descripcion</th>
                              <th style="color:red">Estado</th>
                              <th>Observaciones</th>
                            </thead>
                            <tbody>                            
                            </tbody>
                            <tfoot>
                              <th>Fecha de reclamo</th>
                              <th>Personal</th>
                              <th>Codigo matricula</th>
                              <th>Participante</th>
                              <th>DNI</th>
                              <th>Celular</th>
                              <th style="color:#1abc9c">Curso</th>
                              <th style="color:#1abc9c">Tipo</th>
                              <th style="color:#1abc9c">Fecha</th>
                              <th>Asunto</th>
                              <th>Descripcion</th>
                              <th style="color:red">Estado</th>
                              <th>Observaciones</th>
                            </tfoot>
                          </table>
                        </div>
                      </div><!-- /.box -->
                  </div><!-- /.box -->
      
                  <div class="col-md-12">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title" style="font-size:15px;"> Hola, <strong>';  ?>
                          <?php echo $_SESSION["nombre"] ?>
                          <?php   echo '</strong> tienes <strong style="color: red; font-size:18px">';   ?>
                          <?php echo $cantidadSPG; ?>
                          <?php   echo ' registros pendientes </strong>  en  <b>el estado pendiente </b> </h3>

                        </div>
                        <div class="panel-body table-responsive" id="listadoregistros">
                          <h5>Lista de satisfacción PENDIENTES</h5>
                          <table id="tbllistasatisfaccionclientegeneral" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                            <thead>
                              <th>Fecha de matricula</th>
                              <th>Codigo matricula</th>
                              <th>Participante</th>
                              <th>DNI </th>
                              <th>Celular</th>
                              <th style="color:#1abc9c">Curso</th>
                              <th style="color:#1abc9c">Tipo</th>
                              <th style="color:#1abc9c">Fecha</th>
                              <th>Estado</th>
                              <th>Observaciones</th>
                            </thead>
                            <tbody>                            
                            </tbody>
                            <tfoot>
                              <th>Fecha de matricula</th>
                              <th>Codigo matricula</th>
                              <th>Participante</th>
                              <th>DNI </th>
                              <th>Celular</th>
                              <th style="color:#1abc9c">Curso</th>
                              <th style="color:#1abc9c">Tipo</th>
                              <th style="color:#1abc9c">Fecha</th>
                              <th>Estado</th>
                              <th>Observaciones</th>
                            </tfoot>
                          </table>
                        </div>
                      </div><!-- /.box -->
                  </div><!-- /.box -->
                </div><!-- /.box -->
                <BR>

                <div class="row">
                <div class="col-md-12"> 
                  <div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px;">Lista de cumpleaños de nuestros participantes</h3>

                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                    <h5>Lista de cumpleaños de los clientes</h5>
                      <table id="tbllistadocumpleaños" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                        <thead>
                          <th>Personal </th>
                          <th>Nombre </th>
                          <th>Dni</th>
                          <th>Celular</th>
                          <th>Celular 2</th>
                          <th>fecha de cumpleaños</th>
                        </thead>
                        <tbody>                            
                        </tbody>
                        <tfoot>
                          <th>Personal </th>
                          <th>Nombre </th>
                          <th>Dni</th>
                          <th>Celular</th>
                          <th>Celular 2</th>
                          <th>fecha de cumpleaños</th>
                        </tfoot>
                      </table>
                    </div>
                  </div><!--/.box -->
                </div> <!-- /.box -->    
              </div><!-- /.row -->

                    '; 
                  }elseif ($_SESSION['matricula']==1)
            {
              echo '
            <div class="row">
              <div class="col-md-12">
                 <!-- DONUT CHART  -->
                  <div class="box box-white">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:15px;">Hola, <strong> ';   ?> <?php echo $_SESSION["nombre"] ?>
                     <?php   echo '  </strong> tienes <strong style="color: red; font-size:18px"> ';?> <?php echo $cantidadPF; ?> 
                     <?php   echo ' registros pendientes </strong> en el <b>estado pendiente  </b> </h3>

                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                    <h5>(DIGITAL) Lista de matriculas PENDIENTE  </h5>
                        <table id="tbllistadpendienteenviodigitalpersonal" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                        <thead>
                          <th>Fecha de matricula</th>
                          <th>Codigo matricula</th>
                          <th>Participante</th>
                          <th>DNI </th>
                          <th>Celular</th>
                          <th style="color:#1abc9c">Curso</th>
                          <th style="color:#1abc9c">Tipo</th>
                          <th style="color:#1abc9c">Fecha</th>
                          <th >Formato</th>
                          <th>Prioridad</th>
                          <th style="color:red">Envío Digital</th>
                          <th>Observaciones</th>
                        </thead>
                        <tbody>                            
                        </tbody>
                        <tfoot>
                          <th>Fecha de matricula</th>
                          <th>Codigo matricula</th>
                          <th>Participante</th>
                          <th>DNI </th>
                          <th>Celular</th>
                          <th style="color:#1abc9c">Curso</th>
                          <th style="color:#1abc9c">Tipo</th>
                          <th style="color:#1abc9c">Fecha</th>
                          <th >Formato</th>
                          <th>Prioridad</th>
                          <th style="color:red">Envío Digital</th>
                          <th>Observaciones</th>
                        </tfoot>
                      </table>
                    </div>
                  </div><!-- /.box -->
              </div><!-- /.box -->

              <div class="col-md-12">
                  <div class="box box-white">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:15px;"> Hola, <strong>';  ?>
                      <?php echo $_SESSION["nombre"] ?>
                      <?php   echo '</strong> tienes <strong style="color: red; font-size:18px">';   ?>
                      <?php echo $cantidadPD; ?>
                      <?php   echo ' registros pendientes </strong>  en  <b>envío en proceso </b> </h3>

                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <h5> (FÍSICO) Lista de certificados por envíar PENDIENTE  </h5>
                        <table id="tbllistapendienteenviosfisicospersonal" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                          <thead>
                            <th>Fecha de matricula</th>
                            <th>Codigo matricula</th>
                            <th>Participante</th>
                            <th>DNI </th>
                            <th>Celular</th>
                            <th style="color:#1abc9c">Curso</th>
                            <th style="color:#1abc9c">Tipo</th>
                            <th>Lugar de envío</th>
                            <th style="color:red">Estado de Envío</th>
                            <th>Observaciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Fecha de matricula</th>
                            <th>Codigo matricula</th>
                            <th>Participante</th>
                            <th>DNI </th>
                            <th>Celular</th>
                            <th style="color:#1abc9c">Curso</th>
                            <th style="color:#1abc9c">Tipo</th>
                            <th>Lugar de envío</th>
                            <th style="color:red">Estado de Envío</th>
                            <th>Observaciones</th>
                          </tfoot>
                        </table>
                    </div>
                  </div><!-- /.box -->
              </div><!-- /.box -->
            </div><!-- /.box -->
            
            <div class="row">
            <div class="col-md-12">
               <!-- DONUT CHART  -->
                <div class="box box-white">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:15px;">Hola, <strong> ';   ?> <?php echo $_SESSION["nombre"] ?>
                   <?php   echo '  </strong> tienes <strong style="color: red; font-size:18px"> ';?> <?php echo $cantidadRP; ?> 
                   <?php   echo ' registros pendientes </strong> en  <b>estado pendiente</b> </h3>

                  </div>
                  <div class="panel-body table-responsive" id="listadoregistros">
                  <h5>Lista de reclamos PENDIENTES </h5>
                    <table id="tbllistareclamospendientespersonal" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                      <thead>
                        <th>Fecha de reclamo</th>
                        <th>Codigo matricula</th>
                        <th>Participante</th>
                        <th>DNI</th>
                        <th>Celular</th>
                        <th style="color:#1abc9c">Curso</th>
                        <th style="color:#1abc9c">Tipo</th>
                        <th style="color:#1abc9c">Fecha</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th style="color:red">Estado</th>
                        <th>Observaciones</th>
                      </thead>
                      <tbody>                            
                      </tbody>
                      <tfoot>
                        <th>Fecha de reclamo</th>
                        <th>Codigo matricula</th>
                        <th>Participante</th>
                        <th>DNI</th>
                        <th>Celular</th>
                        <th style="color:#1abc9c">Curso</th>
                        <th style="color:#1abc9c">Tipo</th>
                        <th style="color:#1abc9c">Fecha</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th style="color:red">Estado</th>
                        <th>Observaciones</th>
                      </tfoot>
                    </table>
                  </div>
                </div><!-- /.box -->
            </div><!-- /.box -->

            <div class="col-md-12">
                <div class="box box-white">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:15px;"> Hola, <strong>';  ?>
                    <?php echo $_SESSION["nombre"] ?>
                    <?php   echo '</strong> tienes <strong style="color: red; font-size:18px">';   ?>
                    <?php echo $cantidadSP; ?>
                    <?php   echo ' registros pendientes </strong>  en  <b>el estado pendiente </b> </h3>

                  </div>
                  <div class="panel-body table-responsive" id="listadoregistros">
                    <h5>Lista de satisfacción PENDIENTES</h5>
                    <table id="tbllistasatisfaccionclientepersonal" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                      <thead>
                        <th>Fecha de matricula</th>
                        <th>Codigo matricula</th>
                        <th>Participante</th>
                        <th>DNI </th>
                        <th>Celular</th>
                        <th style="color:#1abc9c">Curso</th>
                        <th style="color:#1abc9c">Tipo</th>
                        <th style="color:#1abc9c">Fecha</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                      </thead>
                      <tbody>                            
                      </tbody>
                      <tfoot>
                        <th>Fecha de matricula</th>
                        <th>Codigo matricula</th>
                        <th>Participante</th>
                        <th>DNI </th>
                        <th>Celular</th>
                        <th style="color:#1abc9c">Curso</th>
                        <th style="color:#1abc9c">Tipo</th>
                        <th style="color:#1abc9c">Fecha</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                      </tfoot>
                    </table>
                  </div>
                </div><!-- /.box -->
            </div><!-- /.box -->
          </div><!-- /.box -->
          
          <div class="row">
          <div class="col-md-12"> 
            <div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title" style="font-size:17px;">Lista de cumpleaños de nuestros participantes</h3>

              </div>
              <div class="panel-body table-responsive" id="listadoregistros">
              <h5>Lista de cumpleaños de tus clientes</h5>
                <table id="tbllistadocumpleañospersonal" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                  <thead>
                    <th>Nombre </th>
                    <th>Dni</th>
                    <th>Celular</th>
                    <th>Celular 2</th>
                    <th>fecha de cumpleaños</th>
                  </thead>
                  <tbody>                            
                  </tbody>
                  <tfoot>
                    <th>Nombre </th>
                    <th>Dni</th>
                    <th>Celular</th>
                    <th>Celular 2</th>
                    <th>fecha de cumpleaños</th>
                  </tfoot>
                </table>
              </div>
            </div><!--/.box -->
          </div> <!-- /.box -->

        </div><!-- /.row -->
          ';
          } 

          elseif ($_SESSION['envios']==1)
          {
            echo '
             <div class="col-md-12">
               <!-- DONUT CHART  -->
                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:15px;"> Hola, <strong> ';   ?> <?php echo $_SESSION["nombre"] ?>
                     <?php echo '</strong> tienes <strong style="color: red; font-size:18px">';   ?><?php echo $cantidadPEnvio; ?> 
                     <?php echo '</strong>  registros de  <b>envios en proceso  </b></h3>

                  </div>
                  <div class="panel-body table-responsive" id="listadoregistros">
                  <h5> (FÍSICO) Lista de certificados por envíar PENDIENTE </h5>
                    <table id="tbllistapendienteenviosgeneral" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                      <thead>
                        <th>Fecha de matricula</th>
                        <th>Codigo matricula</th>
                        <th>Participante</th>
                        <th>DNI </th>
                        <th>Celular</th>
                        <th style="color:#1abc9c">Curso</th>
                        <th style="color:#1abc9c">Tipo</th>
                        <th>Lugar de envío</th>
                        <th style="color:red">Estado de Envío</th>
                        <th style="color:red">Observaciones </th>
                      </thead>
                      <tbody>                            
                      </tbody>
                      <tfoot>
                        <th>Fecha de matricula</th>
                        <th>Codigo matricula</th>
                        <th>Participante</th>
                        <th>DNI </th>
                        <th>Celular</th>
                        <th style="color:#1abc9c">Curso</th>
                        <th style="color:#1abc9c">Tipo</th>
                        <th>Lugar de envío</th>
                        <th style="color:red">Estado de Envío</th>
                        <th style="color:red">Observaciones </th>
                      </tfoot>
                    </table>
                  </div>
                </div><!-- /.box -->
            </div><!-- /.box -->
          </div><!-- /.box -->';
        }
 ?>

          </div> 
        
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<?php
require 'modulos/footer.php';
?>

<script src="../public/js/Chart.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>
<script type="text/javascript" src="js/inicio.js"></script>
