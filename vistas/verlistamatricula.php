<?php
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'modulos/header.php';
require_once "../modelos/Consultas.php";
// Total de ventas MONTO
  $consulta = new Consultas(); 
  $idpersonal=$_SESSION["idpersonal"];
 $rsptav = $consulta->totalventahoy($idpersonal);
 $regv=$rsptav->fetch_object();
 $totalv=$regv->monto;

 // Total de ventas monto y cantidad CURSO CORTO
 $rsptamontocorto= $consulta->totalmontocorto($idpersonal);
 $regmontocorto=$rsptamontocorto->fetch_object();
 $totalmontocorto=$regmontocorto->monto;

 $rsptacantidadcorto= $consulta->totalcantidadcorto($idpersonal);
 $regcantidadcorto=$rsptacantidadcorto->fetch_object();
 $totalcantidadcorto=$regcantidadcorto->cantidad;

  // Total de ventas monto y cantidad DIPLOMA
  $rsptamontodiploma= $consulta->totalmontodiploma($idpersonal);
  $regmontodiploma=$rsptamontodiploma->fetch_object();
  $totalmontodiploma=$regmontodiploma->monto;
 
  $rsptacantidaddiploma= $consulta->totalcantidaddiploma($idpersonal);
  $regcantidaddiploma=$rsptacantidaddiploma->fetch_object();
  $totalcantidaddiploma=$regcantidaddiploma->cantidad;

   // Total de ventas monto y cantidad DIPLOMA DE  ESPECIALIZACION
 $rsptamontodiplomaespecializacion= $consulta->totalmontodiplomaespecializacion($idpersonal);
 $regmontodiplomaespecializacion=$rsptamontodiplomaespecializacion->fetch_object();
 $totalmontodiplomaespecializacion=$regmontodiplomaespecializacion->monto;

 $rsptacantidaddiplomaesp= $consulta->totalcantidaddiplomaespecializacion($idpersonal);
 $regcantidaddiplomaesp=$rsptacantidaddiplomaesp->fetch_object();
 $totalcantidaddiplomaespecializacion=$regcantidaddiplomaesp->cantidad;


if ($_SESSION['matricula']==1)
{
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content">
  <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border">
            <h1 class="box-title">Lista de matricula realizadas de <strong> <?php echo $_SESSION["nombre"]; ?></strong></h1>
        </div>
      </div>

      <!-- /.col -->
    <div class="panel-heading ">
        <div class="row">            
          <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="box-header"  style=" background:#fff; padding: 5px 0px 5px 0px; border-radius: 30px; text-align:center; color:#1abc9c; box-shadow: 6px 6px 5px #1abc9c;"> 
              <h4 style="font-size:20px; padding:0px 20px 0px">
                  <strong> <i class="fa fa-tags"></i> <?php echo $totalcantidadcorto; ?></strong>
              </h4>
              <h4 style="font-size:20px;padding:0px 20px 0px">
                  <strong>S/. <?php echo $totalmontocorto; ?></strong>
              </h4>
              <p style="color: #148f77; font-size:22px; padding:0px 20px 0px"> Certificados </p>               
            </div>
          </div>

          <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="box-header" style=" background:#fff; padding: 5px 0px 5px 0px;border-radius: 30px; text-align:center;color:#3498db;box-shadow: 6px 6px 5px #3498db;"> 
              <h4 style="font-size:20px; padding:0px 20px 0px">
                  <strong><i class="fa fa-tags"></i> <?php echo $totalcantidaddiploma; ?></strong>
              </h4>
              <h4 style="font-size:20px;padding:0px 20px 0px">
                  <strong> S/. <?php echo $totalmontodiploma; ?></strong>
              </h4>
              <p style="color: #2471a3; font-size:22px; padding:0px 20px 0px"> &nbsp Diplomas &nbsp</p>               
            </div>
          </div>

          <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="box-header" style=" background:#fff; padding: 5px 0px 5px 0px;border-radius: 30px;text-align:center;color:#f39c12;box-shadow: 6px 6px 5px #f39c12;"> 
              <h4 style="font-size:20px; padding:0px 20px 0px">
                  <strong> <i class="fa fa-tags"></i>  <?php echo $totalcantidaddiplomaespecializacion; ?></strong>
              </h4>
              <h4 style="font-size:20px;padding:0px 20px 0px">
                  <strong>S/. <?php echo $totalmontodiplomaespecializacion; ?></strong>
              </h4>
              <p style="color:  #ca6f1e;font-size:22px; padding:0px 20px 0px"> Diplomas de Especialización </p>               
            </div>
          </div>

          <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="box-header " style=" background:#fff; padding: 5px 0px 5px 15px;text-align:center; border-radius: 30px; box-shadow: 6px 6px 5px  #abb2b9  ;">
              <h4 style="font-size:20px; text-align:center">
                  <strong>S/ <?php echo $totalv; ?></strong>
              </h4>
              <p style="color:#000; font-size:22px;"> Tus ventas de hoy</p>
              <h4> <?php  $fechaActual = date('d-m-Y');   echo $fechaActual;?> </h4>
            </div>
          </div>   
          
          <div class="form-group col-lg-2 col-md-12 col-sm-12 col-xs-12 " style="padding: 35px 0px;">
            <a href="matricula.php" class="btn btn-success" ><i class="fa fa-book fa-fw"></i>Realizar Nueva Matricula</a>  
          </div>   
        </div>
      </div>
      
      <div class="panel-body table-responsive" class="box-body" id="listadoregistros" style="background: #f2f3f4;"> 
      
        
        <br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="10%">
              <thead>
                <th>Id</th>
                <th>Fecha de matricula</th>
                <th>Codigo matricula</th>
                <th>Número documento</th>
                <th>Participante</th>
                <th>Telefono</th>
                <th>Email</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo Curso</th>
                <th style="color:#1abc9c">Horas curso</th>
                <th style="color:#1abc9c">Fecha del Curso</th>
                <th>Medios de pagos</th>
                <th>Monto</th>
                <th>Formato</th>
                <th>Trafico</th>
                <th>Prioridad</th>
                <th style="color:red">Envío digital</th>
                <th style="color:red">Envío fisico</th>
                <th>Acceso aula</th>
                <th>Observaciones matricula</th>
                <th>Observaciones Envío</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Fecha de matricula</th>
                <th>Codigo matricula</th>
                <th>Número documento</th>
                <th>Participante</th>
                <th>Telefono</th>
                <th>Email</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo Curso</th>
                <th style="color:#1abc9c">Horas curso</th>
                <th style="color:#1abc9c">Fecha del Curso</th>
                <th>Medios de pagos</th>
                <th>Monto</th>
                <th>Formato</th>
                <th>Trafico</th>
                <th>Prioridad</th>
                <th style="color:red">Envío digital</th>
                <th style="color:red">Envío fisico</th>
                <th>Acceso aula</th>
                <th>Observaciones matricula</th>
                <th>Observaciones Envío</th>
              </tfoot>
        </table>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->


<?php
}
else
{
  require 'notieneacceso.php';
}

require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/verlistamatricula.js"></script>



<?php 
}
ob_end_flush();
?>





