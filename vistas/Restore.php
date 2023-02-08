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
        <!-- Main content -->

    <section class="content">  
         <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="box box-primary">
   
                    <div class="box-body">                                        
                            <div class="modal-header" style="background:#151e38; color:white">
                                <h4 class="modal-title text-center">Crear y restaurar copias de seguridad </h4>
                            </div> 
                                
                        <div class="row">
						   <div class="col-md-12 col-lg-12 col-xs-12 modal-body">
                                <div class="form-group text-center">
								<h3>  Restauración de la base de datos completada con éxito </h3> 
							<a href="copiaseguridadbd.php" class="btn btn-warning" style="font-size:25px; border-radius: 20px;"><i class="fa fa-arrow-circle-left" ></i> Regresar </a> <br><br>
							
                	
									<?php
									include 'Connet.php';
									$restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);
									$sql=explode(";",file_get_contents($restorePoint));
									$totalErrors=0;
									set_time_limit (60);
									$con=mysqli_connect(SERVER, USER, PASS, BD);
									$con->query("SET FOREIGN_KEY_CHECKS=0");
									for($i = 0; $i < (count($sql)-1); $i++){
										if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
									}
									$con->query("SET FOREIGN_KEY_CHECKS=1");
									$con->close();
									if($totalErrors<=0){
							echo '
						
		
							<h3>  Ocurrio un error inesperado, no se pudo hacer la restauración completamente </h3> 
							<a href="copiaseguridadbd.php" class="btn btn-warning" style="font-size:25px; border-radius: 20px;"><i class="fa fa-arrow-circle-left" ></i> Regresar </a> <br><br>
							
							</div>
							';
						}else{
							echo '
							<h3>  Ocurrio un error inesperado, no se pudo hacer la restauración completamente </h3>
							<a href="copiaseguridadbd.php" class="btn btn-warning" style="font-size:25px; border-radius: 20px;"><i class="fa fa-arrow-circle-left" ></i> Regresar </a> <br><br>
							</div>
							';
						}
				
						?>
							
						   </div>
						</div>
					</div>
				</div>
			</div>
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
