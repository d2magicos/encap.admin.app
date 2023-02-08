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

<section class="content">
  <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border">
            <h1 class="box-title" style="text-align:center">Registro de Nueva Matricula</h1>
        </div>
      </div>

      <div class="panel-body" id="formularioregistros" style="border-color: #eaeded ; background: #ffffff ; border-width: 3px; border-style: double;">

        <form name="formulario" id="formulario" method="POST" >
            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12" style="background:#ffffff;">
              <label>Personal:</label>
              <div class="input-group" >      
                <span class="input-group-addon" ><i class="fa fa-user"></i></span> 
                <input style="border-color: #FFC7BB; text-align:center" type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
              </div>
            </div>            
            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12" style="background:#ffffff;">            
              <input type="hidden" name="nombrecurso" id="nombrecurso">             
              <label>Fecha:</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input style="border-color:#FFC7BB; text-align:center" class="form-control pull-right" type="date" name="fecha_hora" id="fecha_hora"  required>
              </div>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12" style="background:#ffffff">
              
              <div class="input-group" >
                             
                <input type="hidden" name="idmatricula" id="idmatricula">    
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="cod_matricula" id="cod_matricula"> 
                <input type="hidden" name="idcurso1" id="idcurso1">
                <input type="hidden" name="fecha_inicio1" id="fecha_inicio1">
                <input type="hidden" name="hora" id="hora">
                <input type="hidden" name="horas" id="horas">
                <input type="hidden" name="contexto" id="contexto">

             </div>
            </div>
            

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: 1px solid  #ccc ; background: #d6eaf8">
     
            <div class="modal-header " style="background-color: #01324b">                
                  <h4 class="modal-title" style="color:#fff"><span id="titulo-formulario">Datos </span> del Docente</h4>  
              </div>

            <!-- FORMULARIO PARTICIPANTE -->
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #ccc; background: #d6eaf8">
          <div>

          </div>
              
        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="background:#d6eaf8 ; padding:5px" >

          <div class="row">        
          
            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
              <label>Número de documento<spam style="color: #c0392b ; font-size: 18px">*</spam>:</label> 
                <div class="input-group" >                    
                <div class="input-group" >  
                  <input type="hidden" name="action" value="addCliente">      
                  <input type="hidden" name="idpersona" id="idpersona">
                  <input type="hidden" name="idparticipante" value="1" id="idparticipante">
                  <input type="hidden" name="tipo_persona" id="tipo_persona" value="Participantes">
                    <input  style="width: 310px; height:34px; font-size: 20px; border: 1px solid; border-color: #00c0ef" class="form-control"  name="num_documento" id="num_documento"  required>
                    <button class="btn btn-success" style="width: 40px; height:38px; font-size: 24px; border-radius:15px; " id="btnBuscar" type="button" ><i class="fa fa-search" ></i></button>
                </div>                
                </div>
                <label for="name" class="control-label" style="color: #c0392b ; font-size: 14px">* Ingrese solo números</label>
            </div>

            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
              <label>Email:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>                 
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control" id="email" name="email" placeholder="Correo Electronico" disabled >           
                           
              </div>
            </div>

            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">           
              <label>Apellidos y nombres:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <input type="hidden" name="nombreparticipante" id="nombreparticipante">               
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control"  id="nombre1" name="nombre1" placeholder="Nombre Completo" disabled >           
                           
              </div>
             
            </div>
          
          </div>
       
             
          <div class="row"> 
            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <input type="hidden" name="codigocurso" id="codigocurso"> 
              <label>Teléfono 1:</label>
              <div class="input-group" >      
                <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control" type="number" name="telefono" id="telefono"  maxlength="20" placeholder="Telefono del Participante" disabled >
              </div>
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <label>Teléfono 2:</label>
              <div class="input-group" >      
                <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control" type="text" name="telefono2" id="telefono2"  maxlength="20" placeholder="Telefono del Participante" disabled >
              </div>
            </div>
                    

            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <label>País:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span> 
                <select id="idpais" name="idpais" class="form-control selectpicker " data-live-search="true" disabled>
                
                </select>  
               </div> 
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <label>Departamento:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>  
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control" type="text"name="departamento" id="departamento" disabled > 
                <!-- <select class="form-control select-picker" name="departamento" id="departamento" required>
                  <option value="" >Seleccionar</option>
                  <option value="AMAZONAS" >AMAZONAS</option>
                  <option value="ÁNCASH">ÁNCASH</option>
                  <option value="APURÍMAC">APURÍMAC</option>
                  <option value="AREQUIPA" >AREQUIPA</option>
                  <option value="AYACUCHO">AYACUCHO</option>
                  <option value="CAJAMARCA">CAJAMARCA</option>
                  <option value="CUSCO" >CUSCO</option>
                  <option value="HUANCAVELICA">HUANCAVELICA</option>
                  <option value="HUÁNUCO">HUÁNUCO</option>
                  <option value="ICA" >ICA</option>
                  <option value="JUNÍN">JUNÍN</option>
                  <option value="LA LIBERTAD">LA LIBERTAD</option>
                  <option value="LAMBAYEQUE" >LAMBAYEQUE</option>
                  <option value="LIMA">LIMA</option>
                  <option value="LORETO">LORETO</option>
                  <option value="MADRE DE DIOS" >MADRE DE DIOS</option>
                  <option value="MOQUEGUA">MOQUEGUA</option>
                  <option value="PASCO">PASCO</option>
                  <option value="PIURA" >PIURA</option>
                  <option value="PUNO">PUNO</option>
                  <option value="SAN MARTÍN">SAN MARTÍN</option>
                  <option value="TACNA">TACNA</option>
                  <option value="TUMBES" >TUMBES</option>
                  <option value="UCAYALI">UCAYALI</option>
                  <option value="OTROS">OTROS</option>
              </select>             -->
              </div>
            </div>
          </div>

          <div class="row"> 
            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <label>Ciudad:</label>
              <div class="input-group" >      
                <span class="input-group-addon" ><i class="fa fa-map fa-fw"></i></span> 
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control" type="text" name="ciudad1" id="ciudad1"  maxlength="70" placeholder="Cuidad del Participante" disabled>
              </div>
            </div>           

            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <label>Dirección:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>   
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control" type="text" name="direccion" id="direccion" maxlength="300" placeholder="Direccion del Participante" disabled >           
              </div>
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
              <label>Fecha de cumpleaños:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                <input style=" border: 1px solid; border-color: #00c0ef" class="form-control" type="text" name="fecha_cumple" id="fecha_cumple" maxlength="20" placeholder="Fecha de Cumpleaño del Participante" disabled >           
              </div>
             
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
            </div>
          </div> 

        </div>
    
  </div>             

            <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12">
              <a data-toggle="modal" href="#myModal" id="div_registro_curso">
                <center>           
                <button id="btnAgregarArt" class="btn btn-success btn-lg">
                  <span class="fa fa-plus"></span> MATRICULAR EN CURSO</button>
                </center>
              </a>
            </div>
          <!---->

          <!-- Lista de cursos -->
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="background: #c0dff5 ; border: 3px; font-size:16px;overflow:auto;"  >
              <table id="detalles"  class="table table-striped table-bordered table-condensed table-hover text-center" width="100%">
                <thead>
                    <th>Código</th>
                    <th>Curso</th>
                    <th>Tipo</th>
                    <th>Horas</th>
                    <th>Fecha inicio</th>
                    <th>Acciones</th>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    
                </tbody>
              </table>
            </div>

          <!-- Lista de cursos -->    

            
     </div> 
              <!---->
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="background:#ffffff; padding: 0px 100px 0px 150px;" >
                    <br>              
                      <button class="btn btn-primary" type="submit" id="btnGuardar" > <i class="fa fa-save"></i> Guardar Matricula</button> &nbsp&nbsp&nbsp
                      <button class="btn btn-danger" id="btnCancelar"  onclick="cancelarform()" type="button" ><i class="fa fa-remove"></i> Cancelar</button>   &nbsp&nbsp&nbsp                      
                                            
                  </div> 
                       
      </div>  
 
    </form>
  

      <!-- /.col -->
      
      
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center">Seleccione un Curso</h4>
        </div>
        <div class="modal-body" class="panel-body table-responsive">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover" width="100%">
            <thead>
                <th style="width: 180px;">Codigo</th>
                <th style="width: 550px;">Nombre</th>
                <th style="width: 100px;">Tipo Curso</th>
                <th style="width: 80px;">Horas</th>
                <th style="width: 350px;">Fecha Curso</th>
                <th style="width: 0px;"></th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <th style="width: 180px;">Codigo</th>
                <th style="width: 550px;">Nombre</th>
                <th style="width: 100px;">Tipo Curso</th>
                <th style="width: 80px;">Horas</th>
                <th style="width: 350px;">Fecha Curso</th>
                <th style="width: 0px;"></th>
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
  
<?php
}
else
{
  require 'notieneacceso.php';
}

require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/matriculadocentes.js"></script>
<?php 
}
ob_end_flush();
?>





