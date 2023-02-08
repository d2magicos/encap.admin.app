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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content-header">
          <br>
          <ol class="breadcrumb">            
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>            
            <li class="active">Ayuda Sistema de Matricula</li>          
          </ol>
        </section>

        <section class="content">  
        <div class="row">
          <div class="col-md-12 col-lg-12 col-xs-12">
              <div class="box box-primary">
                  <div class="box-header with-border">                 
                    <div class="box-tools pull-right">
                   
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>

                  <div class="box-body">                                        
                    <div class="modal-header" style="background:#151e38; color:white">
                        <h4 class="modal-title text-center">Videos tutoriale del sistema</h4>
                    </div>

                    <div class="modal-body">                    
               
                      <div class="row">                        
                          <?php
                          require "../configuraciones/Conexion.php";
          
                            $resultados = mysqli_query($conexion,"SELECT * FROM videostutorial ORDER BY idvtutorial DESC");
                                while($consulta = mysqli_fetch_array($resultados))
                                {
                          echo '
                            <div class="col-md-3" style=" padding: 20px ">
                              '. $consulta['descripcion'].'
                              <h5 style="color: #151e38" >'.$consulta['nombre'].'</h5>                      
                            </div>
                            ';
                          }
                          ?>
                
                      </div>
  
                    </div>                         
                  </div><!-- /.box-body-->    
              </div><!-- /.box primary-->                    
          </div><!-- /.col (RIGHT) -->
        </div> 
        </section>

    </div><!-- /.row -->

<!-- Fin modal -->
<?php
}
else
{
  require 'notieneacceso.php';
}
require 'modulos/footer.php';
?>


<?php 
}
ob_end_flush();
?>
