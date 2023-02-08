<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'modulos/header.php';

if ($_SESSION['inicio']==1)
{
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <br>
    <ol class="breadcrumb">      
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
      <li class="active">Administrar Matricula</li>    
    </ol>
  </section>

  <section class="content">
    <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border">
            <h1 class="box-title">Lista de Matriculas</h1>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
              </button>
              <button class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
              </button>
            </div>
        </div>
      </div>

   <!-- /.col -->
      
   <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
        <!-- <button class="btn btn-primary" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus"> Nuevo</i></button>
        <a href="../reportes/rptcompras.php" target="_blank"><button class="btn btn-danger"><i class="fa fa-file"></i> Reporte</button></a> 
        <br><br> -->
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Fecha</th>
                <th>Correo</th>
                <th>Participante</th>
                <th>Codigo Matricula</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo</th>
                <th style="color:#1abc9c">Horas</th>
                <th style="color:#1abc9c">Fecha Curso</th>
                <th>Numero Documento</th>
                <th>Codigo Qr</th>
                <th>Fromato</th>
                <th>Monto</th>
                <th>Prioridad</th>
                <th>Envio Digital</th>
                <th>Acceso Aula</th>
                <th>Envio Fisico</th>
                <th>Acciones</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Fecha</th>
                <th>Correo</th>
                <th>Participante</th>
                <th>Codigo Matricula</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo</th>
                <th style="color:#1abc9c">Horas</th>
                <th style="color:#1abc9c">Fecha Curso</th>
                <th>Numero Documento</th>
                <th>Codigo Qr</th>
                <th>Fromato</th>
                <th>Monto</th>
                <th>Prioridad</th>
                <th>Envio Digital</th>
                <th>Acceso Aula</th>
                <th>Envio Fisico</th>
                <th>Acciones</th>
              </tfoot>
        </table>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
 
  <!-- Modal -->
  <form id="formulario" class="modal fade" method="POST">
      <div class="modal-dialog modal-lg" style="width: 1500px">
            <!-- Modal content-->
          <div class="modal-content panel panel-primary">                
              <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><span id="titulo-formulario">Vista</span> de Matricula</h4>  
              </div>

              <div class="modal-body panel-body">
                  <input type="hidden" id="txtCodigoSeleccionado">                  
                    <div class="form-group col-lg-3">
                      <label class="col-form-label">Personal (*)</label>
                      <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Fecha (*):</label>
                      <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i>
                        </div>
                        <input class="form-control pull-right" type="text" name="fecha_horam" id="fecha_horam" readonly>
                      </div>
                    </div>

                  <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <label>Codigo de Matricula (*):</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>                
                      <input type="hidden" name="idmatricula" id="idmatricula">   
                      <input type="hidden" name="idpersonal" id="idpersonal">   
                      <input style="color:red; width: 550px; height:34px" type="text" class="form-control" name="cod_matriculam" id="cod_matriculam" maxlength="20" readonly >                        
                    </div>
                  </div>
                </div>

              <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="border: 1px solid #85c1e9 ; background-color: #eaf2f8">
                <center>  <h4 style="color: #000;" class="text-center">Datos del Cliente</h4> <br>
                
                <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                  <label>Tipo de Documento (*):</label>
                  <div class="input-group" >                    
                    <span class="input-group-addon" ><i class="fa fa-file-text-o"></i></span> 
                      <select style="width: 280px; height:34px" class="form-control select-picker" name="tipo_documentom" id="tipo_documentom" >
                        <option value="DNI"selected="selected">DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="CE">CE - Carnet de extranjeria</option>
                        <option value="PAS">PAS - Pasaporte</option>
                      </select>
                  </div>
                </div>

                <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">              
                  <label>Numero de Documento (*):</label> 
                  <div class="input-group" >   
                  <span class="input-group-addon"><i class="fa fa-instagram"></i></span>                  
                    <input type="hidden" name="idpersona" id="idpersona">
                    <input type="hidden" name="qr" id="qr">
                    <input type="hidden" name="idparticipante" value="1" id="idparticipante">
                    <input type="hidden" name="tipo_persona" id="tipo_persona" value="Participantes">
                    <input style="width: 300px; height:34px" type="text" class="form-control" name="num_documentom" id="num_documentom"   readonly>
                      <!-- <button style="padding: 5px 10px; font-size: 14px; border: 1px solid #ccc" onclick="buscarDNI()" id="btnBuscar" type="button" ><i class="fa fa-search" ></i></button> -->
                  </div>
                </div>

                <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                  <label>Nombre del Participante (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>                 
                    <input style="width: 650px; height:34px" type="text" class="form-control" id="nombrem" name="nombrem" readonly >                 
                  </div>
                </div>
            
                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>Telefono 1 (*):</label>
                  <div class="input-group" >      
                    <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
                    <input type="text" class="form-control"  type="text" name="telefonom" id="telefonom" maxlength="20" readonly >
                  </div>
                </div>

                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>Telefono 2 (*):</label>
                  <div class="input-group" >      
                    <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
                    <input type="text" class="form-control"  type="text" name="telefono2m" id="telefono2m" maxlength="20" readonly  >
                  </div>
                </div>
              
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>Email (*):</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-envelope-o fa-fw"></i>
                    </div>
                    <input class="form-control"   type="email" name="emailm" id="emailm" maxlength="80" readonly>
                  </div>
                </div>

                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>País (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
                    <input type="text" class="form-control" name="paism" id="paism" maxlength="20" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>Departamento (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
                    <input type="text" class="form-control" name="departamentom" id="departamentom" maxlength="50" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>Ciudad (*):</label>
                  <div class="input-group" >      
                    <span class="input-group-addon" ><i class="fa fa-map fa-fw"></i></span> 
                    <input type="text" class="form-control" name="ciudadm" id="ciudadm"  maxlength="70" readonly>
                  </div>
                </div>           

                <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                  <label>Dirección (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
                    <input type="text" class="form-control" name="direccionm" id="direccionm" maxlength="300" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>Fecha de Cumpleaño (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                    <input type="text" class="form-control" name="fecha_cumplem" id="fecha_cumplem" maxlength="20" readonly>           
                  </div>
                </div>  
              </div>


            <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="border: 1px solid #d1f2eb; background:  #e8f8f5   ">
                <center>  <h4 class="text-center"><span>Detalles del Curso</span></h4> 

                <div class="form-group col-lg-12 col-md-12 col-xs-12" style="background:  #e8f8f5 ">
                  <table id="detallesm" class="table table-striped table-bordered table-condensed table-hover"width="100%">
                      <tbody>
         
                      </tbody>
                      </table>
                </div>
            </div>

            <div class="form-group col-sm-6 col-lg-12 " style="background:#ffffff; padding:5px 10px" >
              <div class="row">

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Monto (*):</label>
                  <div class="input-group" >  
                  <input type="hidden" name="idcurso1" id="idcurso1">  
                    <input type="text" class="form-control" name="montom" id="montom"  maxlength="70" readonly>
                  </div>
                </div>           

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Formato (*):</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="formatom" id="formatom" maxlength="300" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Medio de pago (*):</label>
                  <div class="input-group">  
                  <input type="hidden" name="idmediospagos" id="idmediospagos">
                    <input type="text" class="form-control" name="mediodepagom" id="mediodepagom" maxlength="20" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Forma de Recaudacion (*):</label>
                  <div class="input-group">  
                  <input type="hidden" name="idforma_recaudacion" id="idforma_recaudacion">
                    <input type="text" class="form-control" name="formarecaudacionm" id="formarecaudacionm" maxlength="20" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Numero Operacion (*):</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="noperacionm" id="noperacionm" maxlength="20" readonly>           
                  </div>
                </div> 

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Prioridad (*):</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="prioridadm" id="prioridadm" maxlength="20" readonly>           
                  </div>
                </div> 

                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>Matriculado en el Aula Virtual?</label>
                  <div class="input-group">
                    <span class="input-group-addon" ><i class="fa fa-file-text-o"></i></span> 
                      <select style="width: 380px; height:34px" class="form-control select-picker" name="accesoaula" id="accesoaula">
                        <option value="SI"selected="selected">SI</option>
                        <option value="NO">NO</option>
                      </select>       
                  </div>
                </div> 

                <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                  <label>Observaciones (*):</label>
                  <div class="input-group">                      
                    <input style="width: 910px; height:34px"  type="text" class="form-control" name="obervacionesm" id="obervacionesm" maxlength="200" >           
                  </div>
                </div> 
              </div>
            </div>


                <div class="modal-footer panel-footer">
                  <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar Matricula</button> &nbsp
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                </div>

        </div>
    </div>
</form>

<?php
}
else
{
  require 'notieneacceso.php';
}

require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/modulomatricula.js"></script>
<?php 
}
ob_end_flush();
?>


