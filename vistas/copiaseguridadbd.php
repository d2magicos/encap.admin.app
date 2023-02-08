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
if ($_SESSION['configuracion']==1)
{
?>
<!--Contenido-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
      <section class="content">  
      <section class="content-header">
            <br>
            <ol class="breadcrumb">      
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
              <li class="active">Crear y restaurar copias de seguridad</li>    
            </ol>
        </section>
        <div class="row">
          <div class="col-md-12 col-lg-12 col-xs-12">
              <div class="box box-primary">
                  <div class="box-body">                                        
                    <div class="modal-header" style="background:#151e38; color:white">
                        <h4 class="modal-title text-center">Crear y restaurar copias de seguridad </h4>
                    </div>

                    <div class="row">
                      <div class="col-md-4 modal-body">
                          <div class="form-group text-center">
                            <a href="#" >
                                <img   src="../files/backupbd.png" alt="">
                            </a>   
                          </div>                      
                      </div>  

                      <div class="col-md-8 modal-body">
                        <div class="form-group">
                          <a href="Backup.php" class="btn btn-info" style="font-size:25px; border-radius: 20px;"><i class="fa fa-floppy-o" ></i>  Realizar copia de seguridad</a> <br><br>

                          <p> ========================================================================</p>
  
                          <form class="form-horizontal" for="name" action="Restore.php" method="POST" style="font-size:16px; border-radius: 20px;">
                            <label class="control-label" for="name">Seleccione un punto de restauración</label><br>
                            <select class="form-control select-picker" id="restorePoint" name="restorePoint">
                            <option value="" disabled="" selected="">Seleccione un punto de restauración</option>

                              <?php
                                include_once 'Connet.php';
                                  $ruta=BACKUP_PATH;
                                  if(is_dir($ruta)){
                                      if($aux=opendir($ruta)){
                                        while(($archivo = readdir($aux)) !== false){
                                              if($archivo!="."&&$archivo!=".."){
                                                $nombrearchivo=str_replace(".sql", "", $archivo);
                                                $nombrearchivo=str_replace("-", ":", $nombrearchivo);
                                                $ruta_completa=$ruta.$archivo;
                                                if(is_dir($ruta_completa)){
                                              }else{
                                              echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
                                                }
                                              }
                                        }
                                        closedir($aux);
                                      }
                                    }else{
                                  echo $ruta." No es ruta válida";
                                }
                              ?>

                            </select>   
                         <br><br><br><br>
                          
                          <a ><button class="btn btn-primary" type="submit" style="font-size:18px;"><i class="fa fa-save"></i> Restaurar la copias de seguridad </button></a>  &nbsp; 
                          <a href="inicio.php" class="btn btn-success" style="font-size:18px;" ><i class="fa fa-home"></i> Regresar al inicio</a>
                          
                          </form>
                        </div>   
                      </div>

                    </div>

                                           
                  </div><!-- /.box-body -->
              </div><!-- /.box primary-->                    
          </div><!-- /.col (RIGHT) -->
        </div> 


      </section>
    </div>

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