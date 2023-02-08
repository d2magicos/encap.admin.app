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

if ($_SESSION['reclamos']==1)
{
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <br>
    <ol class="breadcrumb">      
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
      <li class="active">Administrar Reclamos</li>    
    </ol>
  </section>

  <section class="content">
    <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
      <div class="panel-heading">
        <div class="box-header with-border">
            <h1 class="box-title">Administrar Gestion de Reclamos</h1>
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
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Fecha de Matricula</th>
                <th>Codigo Matricula</th>
                <th>Documento</th>
                <th>Participante</th>
                <th>Celular</th>
                <th>Correo</th>
                <th style="color:#1abc9c">Curso </th>
                <th style="color:#1abc9c">Tipo Curso</th>
                <th style="color:#1abc9c">Fecha Curso</th>
                <th>Monto</th>
                <th>Formato</th>
                <th>Trafico</th>
                <th style="color:red">Envío digital </th>
                <th style="color:red">Acceso aula</th>
                <th>?</th>
                <th>Estado Reclamo</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Fecha de Matricula</th>
                <th>Codigo Matricula</th>
                <th>Documento</th>
                <th>Participante</th>
                <th>Celular</th>
                <th>Correo</th>
                <th style="color:#1abc9c">Curso </th>
                <th style="color:#1abc9c">Tipo Curso</th>
                <th style="color:#1abc9c">Fecha Curso</th>
                <th>Monto</th>
                <th>Formato</th>
                <th>Trafico</th>
                <th style="color:red">Envío digital </th>
                <th style="color:red">Acceso aula</th>
                <th>?</th>
                <th>Estado Reclamo</th>
              </tfoot>
        </table>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
  
  <!-- Modal -->
  <form id="formulario" class="modal fade" method="POST">
      <div class="modal-dialog modal-lg" style="width: 1300px">
            <!-- Modal content-->
          <div class="modal-content panel panel-primary">                
          <div class="modal-header panel-heading" style="background-color: #01324b">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center"><span >FORMULARIO </span> VISTA DE INGRESAR EL RECLAMO</h4>  
            </div>

              <div class="modal-body panel-body">
                  <input type="hidden" id="txtCodigoSeleccionado">                  
                    <div class="form-group col-lg-3">
                      <label class="col-form-label">Personal (*)</label>
                      <input type="text" class="form-control" id="nombrepersonal" name="nombrepersonal" readonly>
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
                    <label>Codigo de matricula (*):</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>                
                      <input type="hidden" name="idmatricula" id="idmatricula">             
                      <input type="hidden" name="idpersonal" id="idpersonal" value= " <?php echo $_SESSION["idpersonal"]; ?>">   
                      <input style="color:red; width: 470px; height:34px" type="text" class="form-control" name="cod_matriculam" id="cod_matriculam" maxlength="20" readonly >                        
                    </div>
                  </div>
                </div>

              <div class="modal-header panel-heading" style="background-color: #01324b">
                  <h4 class="modal-title" ><span id="titulo-formulario">Datos</span> del participante</h4>  
              </div>   

              <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="background-color: #fff"><br>                        

                <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">              
                  <label>N° de documento (*):</label> 
                  <div class="input-group" >   
                  <span class="input-group-addon"><i class="fa fa-instagram"></i></span>              
                    <input  type="text" class="form-control" name="num_documentom" id="num_documentom"   readonly>
                 </div>
                </div>

                <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                  <label>Nombre del participante (*):</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>                 
                    <input type="text" class="form-control" id="nombrem" name="nombrem" readonly >                 
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
            
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Teléfono 1 (*):</label>
                  <div class="input-group" >      
                    <span class="input-group-addon" ><i class="fa fa-mobile"></i></span> 
                    <input type="text" class="form-control"  type="text" name="telefonom" id="telefonom" maxlength="20" readonly >
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

              <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12" style="background:  #fff"><br>
                  <table id="detallesm" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                    <tbody>         
                    </tbody>
                  </table>
            </div>            

            <div class="modal-header panel-heading" style="background-color: #e74c3c ">
                <h4 class="modal-title" style="color:#fff"><span id="titulo-formulario">Detalles</span> del reclamo</h4>  
            </div>

            <div class="form-group col-sm-6 col-lg-12 " style="background: #fff ; padding:10px 10px" >
              <div class="row">
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Fecha del reclamo:</label>
                  <div class="input-group" >  
                    <input style="border-color:#FFC7BB; text-align:center" class="form-control pull-right" type="date" name="fecha" id="fecha"  required>
                    <input type="hidden" name="idreclamo" id="idreclamo">  
                    <input type="hidden" name="hora_reclamo" id="hora_reclamo">                  

                  </div>
                </div> 
                
                 <div class="form-group col-lg-5 col-md-8 col-sm-8 col-xs-12">
                  <label>Asunto:</label>
                  <div class="input-group" >   
                    <input type="hidden" name="idreclamo" id="idreclamo">                    

                    <select name="idasunto" id="idasunto"  class="selectpicker" data-live-search="true" required>
                        <?php 
                          require_once "../modelos/Asunto.php";
                          $asunto = new Asunto();                          
                          $departamentos=$asunto->select("idasunto","1");
                          foreach($departamentos as $departamento):
                          ?>
                          <option value="<?php echo $departamento['idasunto'] ?>"><?php echo $departamento['nombre'] ?></option>
                          <?php 
                          endforeach;
                          ?> 
                    </select>                                  
                  </div>
                </div> 

                <div class="form-group col-lg-5 col-md-8 col-sm-8 col-xs-12">
                  <label>Sub Categoria:</label>
                  <div class="input-group" >                    
                     <select  id="idsubasunto" name="idsubasunto" class="selectpicker" required>
                     <option style="color:#fff" >Seleccionar Sub asunto</option>
                     </select>
                  </div>
                </div> 
                
              </div> 

              <div class="row"> 

                <div class="form-group col-lg-5 col-md-8 col-sm-8 col-xs-12">
                  <label>Descripción del reclamo:</label>
                  <div class="input-group">
                    <textarea  style="width: 500px;height:48px" type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion del reclamo" maxlength="500" required> </textarea>      
                  </div>
                </div> 
    

                <div class="form-group col-lg-5 col-md-8 col-sm-8 col-xs-12">
                    <label>Observaciones del asesor:</label>
                    <div class="input-group">
                      <textarea  style="width: 500px; height:48px" type="text" class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones" maxlength="500">   </textarea>        
                    </div>
                </div> 
             

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                    <label>Prioridad:</label>
                    <div class="input-group">                  
                      <select class=" select-picker" style="border-color:#FFC7BB; text-align:center" name="prioridad" id="prioridad" required >
                          <option value="NORMAL" style="text-align:center" selected="selected" >NORMAL</option>
                          <option value="URGENTE" style="text-align:center">URGENTE</option>
                        </select>
                    </div>
                </div> 
            </div>
            </div>
           
                <div class="modal-footer panel-footer">
                  <button class="btn btn-primary" type="submit" id="btnGuardar" style="font-size:17px" ><i class="fa fa-save"></i> Guardar y Actualizar Reclamo</button> &nbsp
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" style="font-size:17px" ><i class="fa fa-times"></i> Cancelar</button>
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
<script type="text/javascript" src="js/gestionreclamos.js"></script>


<script language="javascript">

$(document).ready(function(){
    $("#idasunto").on('change', function () {
        $("#idasunto option:selected").each(function () {
          idasunto=$(this).val();
            //alert(idasunto);
            $.post("../modelos/Asuntolista.php", { idasunto: idasunto }, function(r){
                $("#idsubasunto").html(r);
                $('#idsubasunto').selectpicker('refresh');
                //alert(data);
            });			
        });
   });
});

</script>

<?php 
}
ob_end_flush();
?>
