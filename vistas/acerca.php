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
                        <h4 class="modal-title text-center">Datos de la Empresa ENCAP</h4>
                    </div>

                    <div class="modal-body">
                      <div class="form-group">
                        <label for="name" class="col-lg-12 control-label">RUC: <spam style="font-size: 18px"> 20603336250</spam> </label><br>
                        <label for="name" class="col-lg-12 control-label">RAZÓN SOCIAL: <spam style="font-size: 18px"> Escuela Nacional de Capacitación y Actualización Profesional S.A.C.</spam> </label>
                        <label for="name" class="col-lg-12 control-label">DIRECCIÓN: <spam style="font-size: 18px"> Av. Arterial N° 1244 - Chilca - Huancayo</spam> </label>
                        
                      </div>                      
                    </div> <br> <br>

                    <div class="modal-body">
                      <div class="form-group text-center">
                        <a href="#" >
                            <img src="../files/logo.png" alt="">
                        </a>   
                      </div>                      
                    </div>                         
                  </div><!-- /.box-body -->
              </div><!-- /.box primary-->                    
          </div><!-- /.col (RIGHT) -->
        </div> 

        <div class="row">
          <div class="col-md-12 col-lg-12 col-xs-12">
              <div class="box box-success">
                  <div class="box-header with-border">                 
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>

                  <div class="box-body">                                        
                    <div class="modal-header" style="background:#151e38; color:white">
                        <h4 class="modal-title text-center">Sistema de Matricula - ENCAP - </h4>
                  </div><br>

                  <div class="row">
                    <div class="col-md-6 col-lg-6 col-xs-12">
                      <div class="box box-warning">
                          <div class="box-header with-border">
                                <h3 class="box-title" style="font-size:17px;"><b> - OPERACIONES - </b></h3>
                            <div class="box-tools pull-right">
                              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                          </div>
                          <div class="box-body">                            
                            <h4>* Gestión Comercial</h4>
                              <ol>            
                                <li> Registrar nueva matricula</li> 
                                <li> Cancelar matricula</li>           
                                <li >Registrar nuevo participante</li> 
                                <li >Vista de lista de matriculas (Por Asesor de ventas y Fecha Actual)</li>
                                <li >Vista de lista de matriculas (Por Asesor de ventas)</li>         
                              </ol>
                            <h4>* Gestión Administrativa</h4>
                              <ol>            
                                <li> Vista de lista de matriculas</li> 
                                <li> Boton confirmar envio digital</li>           
                                <li>Formulario rellenar ingreso de acceso al aula virtual, estado de venta, comporbante y observaciones de matricula y envío</li>    
                              </ol> 

                            <h4>* Gestión de Envios</h4> 
                            <ol>            
                                <li>Vista de lista env'ios por confirmar el lugar de envío</li>        
                                <li>Formulario rellenar ingreso de envío: fecha, courier, factura de envío, monto, clave y observcaiones del envío</li>      
                              </ol> 
                            <h4>* Gestión Reclamos</h4> 
                            <ol>            
                                <li> Vista de lista de matriculas </li>          
                                <li> Formulario rellenar asunto de reclamo, fecha, prioridad, estado y observaciones del reclamo</li>    
                              </ol> 
                            <h4>* Satisfacción del Cliente</h4> 
                            <ol>            
                                <li> Vista de lista de matriculas</li>          
                                <li>Formulario rellenar Satisfación del participante por cada matricula</li>    
                              </ol> 
                          
                          </div><!-- /.box-body -->
                      </div>                   
                    </div>

                    <div class="col-md-6 col-lg-6 col-xs-12">
                      <div class="box box-warning">
                          <div class="box-header with-border">
                                <h3 class="box-title" style="font-size:17px;"><b> - ADMINISTRACIÓN - </b></h3>
                            <div class="box-tools pull-right">
                              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                          </div>
                          <div class="box-body">
  
                            <h4> * Módulo de Participantes </h4> 
                              <ol>            
                                <li>Crear nuevo participante</li>            
                                <li >Modificar participante</li> 
                                <li >Activar participante</li>         
                                <li >Desactivar participante</li>          
                                <li >Eliminar participante</li>         
                                <li >Carga masiva de participantes</li>
                                <li >Exportación de datos en excel y pdf</li>          
                              </ol>
                            <h4> * Módulo de Cursos  </h4> 
                              <ol>            
                                  <li>Crear nuevo curso</li>            
                                  <li >Modificar curso</li> 
                                  <li >Activar curso</li>         
                                  <li >Desactivar curso</li>          
                                  <li >Eliminar curso</li>         
                                  <li >Carga masiva de cursos</li>
                                  <li >Exportación de datos en excel y pdf</li>          
                                </ol>
                            <h4> * Módulo de Personal  </h4> 
                            <ol>            
                                <li>Crear nuevo personal</li>            
                                <li >Modificar personal</li> 
                                <li >Activar personal</li>         
                                <li >Desactivar personal</li>          
                                <li >Eliminar personal</li>        
                                <li >Exportación de datos en excel y pdf</li>          
                              </ol>
                            <h4> * Módulo de Reportes  </h4> 
                            <ol>            
                                <li> Reporte General Encap</li>            
                                <li >Reporte Detallado (Consultas por fechas) </li> 
                                <li >Reporte de Envíos Encap</li>                   
                              </ol>
                            <h4> * Módulo de Configuración  (Todos con las aciones: Crear Nuevo, Modificar, Activar, Desactivar, Eliminar,Exportación de datos en excel y pdf)</h4>
                            <ol>            
                                <li>Categoria Cursos</li>
                                <li>Courier</li>
                                <li>Medios de Pagos </li>   
                                <li>Forma de Recaudación   </li> 
                                <li>País </li>
                                <li>Tipo de Documento </li>
                                <li>Tipo de Documento </li>
                                <li>Medio de Trafico      
                                <li>Tipo de Documento </li>
                                <li>Asuntos - Reclamos        
                              </ol>

                            <h4> * Módulo de Backup SIS-ENCAP  </h4> 
                            <ol>            
                                <li> Realizar copia de seguridad Base de Datos</li>            
                                <li >Restaurar copia de seguridad Base de Datos</li>         
                              </ol>

                          
                          </div><!-- /.box-body -->
                      </div>                   
                    </div>

                  </div>
                                                          
                  </div><!-- /.box-body -->
              </div><!-- /.box primary-->                    
          </div><!-- /.col (RIGHT) -->
        </div> 
        

  </section>
      </div><!-- /.row -->
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


<?php 
}
ob_end_flush();
?>