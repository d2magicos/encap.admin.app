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
//Usuario revisa el contenido
if ($_SESSION['inicio']==1)
{
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
  <section class="content">  
  <section class="content-header">
            <br>
            <ol class="breadcrumb">      
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
              <li class="active">VIDEOS TUTORIALES DEL SISTEMA</li>    
            </ol>
        </section>
        <div class="row">
          <div class="col-md-12 col-lg-12 col-xs-12">
              <div class="box box-primary">
                  <div class="box-body">                                        
                    <div class="modal-header" style="background:#151e38; color:white">
                        <h4 class="modal-title text-center">VIDEOS TUTORIALES DEL SISTEMA</h4>
                    </div>

                    <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                            <thead>
                              <th>Nombre</th>
                              <th>Descripción</th>
                            </thead>
                            <tbody>                            
                            </tbody>
                            <tfoot>
                              <th>Nombre</th>
                              <th>Descripción</th>
                            </tfoot>
                          </table>
                    </div>
                  </div>
              </div>
          </div>
        </div>
    </section>
  </div>


<?php
}
else
{
  require 'notieneacceso.php';
}
require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/videotutorial.js"></script>
<?php 
}
ob_end_flush();
?>
