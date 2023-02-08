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

if ($_SESSION['matricula']==1)
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
        <div class="box-header with-border" >
            <h1 class="box-title">Matricula</h1>
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

      <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
        <button class="btn btn-primary" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus"> Nuevo</i>
        </button>
        <a href="../reportes/rptmatriculas.php" target="_blank"><button class="btn btn-danger"><i class="fa fa-file"></i> Reporte</button></a>
        <br><br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Fecha</th>
                <th>Personal</th>
                <th>Codigo Matricula</th>
                <th>Participante</th>
                <th>Tipo Documento</th>
                <th>Numero Documento</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Nombre Curso</th>
                <th>Tipo curso</th>
                <th>Numero Horas</th>
                <th>Observaciones</th>
                <th>Fecha Curso</th>
                <th>Acciones</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Fecha</th>
                <th>Personal</th>
                <th>Codigo Matricula</th>
                <th>Participante</th>
                <th>Tipo Documento</th>
                <th>Numero Documento</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Nombre Curso</th>
                <th>Tipo Curso</th>
                <th>Numero Horas</th>
                <th>Observaciones</th>
                <th>Fecha Curso</th>
                <th>Acciones</th>
              </tfoot>
            </table>
      </div>

      <div class="panel-body" id="formularioregistros">
          <form name="formulario" id="formulario" method="POST">

            <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
              <label>Personal:</label>
              <div class="input-group" >      
              <span class="input-group-addon" ><i class="fa fa-user"></i></span> 
              <input style="border-color: #FFC7BB; text-align:center" type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
              </div>
            </div>
            
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Fecha:</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input style="border-color:#FFC7BB; text-align:center" class="form-control pull-right" type="date" name="fecha_hora" id="fecha_hora" required>
              </div>
            </div>

            <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
              <label>Codigo de Matricula:</label>
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>                
              <input type="hidden" name="idmatricula" id="idmatricula">    
              <input style="border-color: #FFC7BB; text-align:center" type="text" class="form-control" name="cod_matricula" id="cod_matricula" maxlength="20" placeholder="Codigo de Matricula" required>             
              </select>             
            </div>
            </div>

            <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <label>Tipo de Documento:</label>
                <div class="input-group" >                    
                    <span class="input-group-addon" ><i class="fa fa-file-text-o"></i></span> 
                      <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" >
                        <option value="DNI"selected="selected">DNI</option>
                        <option value="RUC">RUC</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <label>Numero de Documento:</label> 
                <div class="input-group" >      
                    <!-- <select id="idparticipante" name="idparticipante" class="form-control selectpicker" data-live-search="true" required>     -->
                    <input type="hidden" id="idparticipante" name="idparticipante" >                                             
                    <input type="text" style="width: 330px; height:34px; padding: 2px 10px 2px 10px;font-size: 14px; border: 1px solid #ccc;" name="num_documento" id="num_documento"  placeholder="Numero de Documento" required>
                    <button style="padding: 5px 10px; font-size: 14px; border: 1px solid #ccc" id="btnBuscar" type="button" ><i class="fa fa-search" ></i></button>
                </div>
            </div>

            <div class="form-group col-lg-6 col-md-4 col-sm-4 col-xs-12">
                <label>Nombre del Participante:</label>
                <div class="input-group" >      
                <span class="input-group-addon" ><i class="fa fa-users fa-fw"></i></span> 
                <input style="border-color: #99C0E7" class="form-control pull-right" type="text" class="form-control" type="text" id="nombre" name="nombre" required>           
                <!-- <select style="border-color: #99C0E7" class="form-control pull-right" type="text" class="form-control" type="text" id="nombre" name="nombre" required>             
              </select> -->
                <!-- <select id="idparticipante" name="idparticipante" class="form-control selectpicker" data-live-search="true" required>   -->
                 </div>
            </div>

            <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
              <label>Telefono:</label>
              <div class="input-group" >      
              <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
              <input style="border-color: #99C0E7" class="form-control pull-right" type="text" class="form-control" type="text" name="telefono" id="telefono"  maxlength="20" placeholder="Telefono del Participante" >
              </div>
            </div>
            
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Email:</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-envelope-o fa-fw"></i>
                </div>
                <input style="border-color: #99C0E7" class="form-control pull-right" type="text" name="email" id="email"  maxlength="80" placeholder="Email del Participante" >
              </div>
            </div>

            <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
              <label>Dirección:</label>
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
              <input style="border-color: #99C0E7" class="form-control pull-right" type="text" class="form-control" name="direccion" id="direccion" maxlength="300" placeholder="Direccion del Participante">             
              </select>             
            </div>
            </div>

            <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12">
              <a data-toggle="modal" href="#myModal">
                <center>           
                <button type="button" class="btn btn-success btn-lg" style="border-color: #28a745; background: #28a745;text-"  id="btnAgregarArt" ><span class="fa fa-plus"></span>  Buscar Cursos</button>
                </center>
              </a>
            </div>

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover text-center" width="100%">
                <thead>
                      <th>Curso</th>
                      <th>Tipo de Curso</th>
                      <th>Numero de horas</th>
                      <th>Fecha del Curso</th>
                      <th>Acciones</th>
                  </thead>
                  <tfoot>
                      
                  </tfoot>
                  <tbody>
                    
                  </tbody>
              </table>
            </div>

            <!---->

            <div class="col-sm-8 col-sm-offset-3 col-lg-8 col-lg-offset-2 main">
              <div class="row">
                  <div class="col-lg-4 left">
                      <div class="input-group has-error">
                                        

                          
                      </div>
                    </div>
                <div class="col-lg-4 left  has-error">
                  <div class="input-group">
                  
              </div>
            </div>

            <div class="col-lg-4 left has-error">
              <div class="input-group">
                  
                  
              </div>
            </div>
            </div>
          </div>

            <!---->

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <br>
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

              <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-remove"></i> Cancelar</button>
            </div>
          </form>
      </div>
    </div>
  </section>
</div><!-- /.content-wrapper -->

  <!--Fin-Contenido-->

<!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Curso</h4>
        </div>
        <div class="modal-body" class="panel-body table-responsive">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover" width="100%">
            <thead>
                <th style="width: 750x;" >Nombre</th>
                <th style="width: 150px;">Tipo curso</th>
                <th style="width: 50px;">Numero de horas</th>
                <th style="width: 30px;">Observaciones</th>
                <th style="width: 10px;">Acciones</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <th style="width: 750x;" >Nombre</th>
                <th style="width: 150px;" >Tipo curso</th>
                <th style="width: 50px;">Numero de horas</th>
                <th style="width: 30px;">Observaciones</th>
                <th style="width: 10px;" >Acciones</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->

  <!-- Modal 
  <div id="getCodeModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content
            <div class="modal-content panel panel-primary">
                
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="titulo-formulario">Vista</span> de Curso</h4>  
                </div>
                <div class="modal-body panel-body">
                    <input type="hidden" id="txtCodigoSeleccionado">
                    
                    <div class="form-group col-lg-5">
                        <label class="col-form-label">Proveedor (*)</label>
                        <input class="form-control" type="hidden" name="idcompra" id="idcompra">
                        <input class="form-control" type="text" name="idproveedorm" id="idproveedorm" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="col-form-label">Personal (*)</label>
                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                    </div>
                    <div class="form-group col-lg-4">
                        <label class="col-form-label">Fecha (*)</label>
                        <input class="form-control pull-right" type="text" name="fecha_horam" id="fecha_horam" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="col-form-label">Comprobante (*)</label>
                        <input class="form-control" type="text" name="tipo_comprobantem" id="tipo_comprobantem" maxlength="7" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="col-form-label">Serie (*)</label>
                        <input class="form-control" type="text" name="serie_comprobantem" id="serie_comprobantem" maxlength="7" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="col-form-label">Número (*)</label>
                         <input class="form-control" type="text" name="num_comprobantem" id="num_comprobantem" maxlength="10" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                      <div class="input-group">
                        <label class="col-form-label">Impuesto (*)</label>
                        <input class="form-control" type="text" name="impuestom" id="impuestom" readonly>
                    </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
                      <table id="detallesm" class="table table-striped table-bordered table-condensed table-hover"width="100%">
                      <tbody>
         
                      </tbody>
                      </table>
                    </div>
                </div>
                <div class="modal-footer panel-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                </div>
            </div>
        </div>
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
<script type="text/javascript" src="js/matriculaencap.js"></script>
<?php 
}
ob_end_flush();
?>



