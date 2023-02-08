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

if ($_SESSION['envios']==1)
{
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <br>
    <ol class="breadcrumb">      
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
      <li class="active">Administrar Envios</li>    
    </ol>
  </section>

  <section class="content">
    <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border">
            <h1 class="box-title">Lista de Envios por Realizar</h1>
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
                <th>Id</th>
                <th>Fecha de matricula</th>
                <th>Codigo Matricula</th>
                <th>DNI</th>
                <th>Participante</th>            
                <th>Télefono 1</th>
                <th>Télefono 2</th>
                <th>Correo</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo </th>
                <th style="color:#1abc9c">Fecha Curso</th>
                <th style="color:red">Lugar de envio</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Observaciones del envio</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Fecha de matricula</th>
                <th>Codigo Matricula</th>
                <th>DNI</th>
                <th>Participante</th>            
                <th>Télefono 1</th>
                <th>Télefono 2</th>
                <th>Correo</th>
                <th style="color:#1abc9c">Curso</th>
                <th style="color:#1abc9c">Tipo </th>
                <th style="color:#1abc9c">Fecha Curso</th>
                <th style="color:red">Lugar de envio</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Observaciones del envio</th>
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
                          
            <div class="modal-header panel-heading" style="background-color: #01324b">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center"><span >FORMULARIO </span> VISTA DE ENVIO POR REALIZAR</h4>  
            </div>
            

          <div class="modal-body panel-body">
                  <input type="hidden" id="txtCodigoSeleccionado">                  
                    <div class="form-group col-lg-3">
                      <label class="col-form-label">Personal (*)</label>
                     <input type="hidden" name="idpersonal" id="idpersonal">
                      <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Fecha (*):</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i> </div>
                        <input class="form-control pull-right" type="text" name="fecha_horam" id="fecha_horam" readonly>
                      </div>
                    </div>

                  <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <label>Codigo de matricula (*):</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
                      <input type="hidden" name="idenvio" id="idenvio">                  
                      <input type="hidden" name="idmatricula" id="idmatricula">    
                      <input type="text" class="form-control" name="cod_matriculam" id="cod_matriculam" style="color:red; width: 500px; height:34px" maxlength="100" readonly >                        
                    </div>
                  </div>

                </div>

              <div class="modal-header panel-heading" style="background-color: #01324b">
                  <h4 class="modal-title" ><span id="titulo-formulario">Datos</span> del participante</h4>  
              </div>                  

              <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="background-color: #fff"><br>
                
                <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                  <label>Tipo de documento (*):</label>
                  <div class="input-group" >                    
                    <span class="input-group-addon" ><i class="fa fa-file-text-o"></i></span> 
                    <select style="height:34px" class="form-control select-picker" name="tipo_documentom" id="tipo_documentom" >
                        <option value="DNI"selected="selected">DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="CE">CE - Carnet de extranjeria</option>
                        <option value="PAS">PAS - Pasaporte</option>
                      </select>
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">              
                  <label>Número de documento (*):</label> 
                  <div class="input-group" >   
                  <span class="input-group-addon"><i class="fa fa-instagram"></i></span> 
                    <input style=" height:34px" type="text" class="form-control" name="num_documentom" id="num_documentom"   readonly>
                 </div>
                </div>

                <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                  <label>Nombre del participante (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>                 
                    <input style=" height:34px" type="text" class="form-control" id="nombrem" name="nombrem" readonly >                 
                  </div>
                </div>
            
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Teléfono 1 (*):</label>
                  <div class="input-group" >      
                    <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
                    <input type="text" class="form-control"  type="text" name="telefonom" id="telefonom" maxlength="20" readonly >
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Teléfono 2 (*):</label>
                  <div class="input-group" >      
                    <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
                    <input type="text" class="form-control"  type="text" name="telefono2m" id="telefono2m" maxlength="20" readonly  >
                  </div>
                </div>
              
                <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                  <label>Email (*):</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-envelope-o fa-fw"></i>
                    </div>
                    <input class="form-control"   type="email" name="emailm" id="emailm" maxlength="80" readonly>
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>País (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
                    <input type="text" class="form-control" name="paism" id="paism" maxlength="20" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Departamento (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
                    <input type="text" class="form-control" name="departamentom" id="departamentom" maxlength="50" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Ciudad (*):</label>
                  <div class="input-group" >      
                    <span class="input-group-addon" ><i class="fa fa-map fa-fw"></i></span> 
                    <input type="text" class="form-control" name="ciudadm" id="ciudadm"  maxlength="70" readonly>
                  </div>
                </div>           

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Dirección (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
                    <input type="text" class="form-control" name="direccionm" id="direccionm" maxlength="300" readonly>           
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Fecha de cumpleaños (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                    <input type="text" class="form-control" name="fecha_cumplem" id="fecha_cumplem" maxlength="20" readonly>           
                  </div>
                </div>                 
              </div>
              
            <div class="modal-header panel-heading" style="background-color: #01324b">                
                  <h4 class="modal-title" ><span id="titulo-formulario">Datos</span> del curso</h4>  
            </div>         
             
            <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="border: 1px solid #d1f2eb; background:  #fff"><br>
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                  <table id="detallesm" class="table table-striped table-bordered table-condensed table-hover"width="100%">
                      <tbody>
         
                      </tbody>
                      </table>
                </div>
            </div>

            <div class="modal-header panel-heading" style="background-color: #e74c3c ">
                <h4 class="modal-title" style="color:#fff"><span id="titulo-formulario">Detalles</span> del envio</h4>  
            </div>

            <div class="form-group col-sm-6 col-lg-12 " style="background: #fff ; padding:5px 10px" >
              <div class="row">
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Lugar de confirmación:</label>
                  <div class="input-group" >                    
                    <input type="text" class="form-control" name="lugarenvio" id="lugarenvio" style=" height:34px;" placeholder="Lugar de confirmación" maxlength="70" >
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Monto:</label>
                  <div class="input-group"> 
                    <input type="text" class="form-control" name="monto" id="monto" maxlength="10" style="height:34px;" placeholder="Ingrese el monto de Envio: 8.50" required >           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div>           

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Courier:</label>
                  <div class="input-group">    
                    <select id="idcourier" name="idcourier" class="selectpicker" data-live-search="true" style="width: 320px; height:34px;" required></select>              
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Fecha de envío:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="fechaenvio" id="fechaenvio" style=" height:34px;" maxlength="200" placeholder="Fecha de envio" required>           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div> 

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Clave de envío:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="clave" id="clave" style=" height:34px;" maxlength="200" placeholder="Clave de envio" >           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div> 

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Número de factura de envío:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="factura_envio" id="factura_envio" style=" height:34px;" maxlength="200" placeholder="Factura de envio" required>           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div> 
              </div>

              <div class="row">
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Fecha envío de información:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="fecha_info" id="fecha_info" style=" height:34px;" maxlength="200" placeholder="Factura de envio" required>           
                  </div>
                  <!-- <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label> -->
                </div>                

                <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                  <label>Observaciones:</label>
                  <div class="input-group">
                    <input  style="width: 900px; height:34px" type="text" class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones" maxlength="200" >           
                  </div>
                </div> 
              </div>
            </div>   
          
            <div class="modal-footer panel-footer">
              <button class="btn btn-primary" type="submit" id="btnGuardar" ><i class="fa fa-save"></i> Guardar el Envio</button>
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
<script type="text/javascript" src="js/verenviados.js"></script>
<?php 
}
ob_end_flush();
?>



