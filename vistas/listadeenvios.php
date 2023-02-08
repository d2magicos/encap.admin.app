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
            <h1 class="box-title">Lista de Envios Realizados</h1>
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
                <th>N°</th>
                <th>Fecha Matricula</th>
                <th style="color:red">Fecha de envio</th>   
                <th>Código Matricula</th>
                <th>DNI</th>
                <th>Participante</th>
                <th>Telefono</th>
                <th>Telefono 2</th>
                <th>Correo</th>          
                <th>Curso</th>
                <th>Tipo </th>
                <th>Fecha Curso</th>   
                <th>Ciudad</th>               
                <th style="color:red">Lugar enviado</th>
                <th style="color:red">Monto</th>
                <th style="color:red">Courier</th>
                <th style="color:red">Factura</th> 
                <th style="color:red">Clave</th>                
                            
                <th style="color:red">Fecha de envio de información</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Observaciones</th>                
                <th style="color:green">Dirección de envío</th>
                <th style="color:green">Info de seguimiento</th>
                <th style="color:green">Fecha de probable recojo</th><!-- Cambiado -->
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>N°</th>
                <th>Fecha Matricula</th>
                <th style="color:red">Fecha de envio</th>   
                <th>Código Matricula</th>
                <th>DNI</th>
                <th>Participante</th>
                <th>Telefono</th>
                <th>Telefono 2</th>
                <th>Correo</th>          
                <th>Curso</th>
                <th>Tipo </th>
                <th>Fecha Curso</th>  
                <th>Ciudad</th>                
                <th style="color:red">Lugar enviado</th>
                <th style="color:red">Monto</th>
                <th style="color:red">Courier</th>
                <th style="color:red">Factura</th> 
                <th style="color:red">Clave</th>                
                            
                <th style="color:red">Fecha de envio de información</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Observaciones</th>
                <th style="color:green">Dirección de envío</th>
                <th style="color:green">Info de seguimiento</th>
                <th style="color:green">Fecha de probable recojo</th><!-- Cambiado -->
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
                  <h4 class="modal-title text-center"><span >FORMULARIO </span> VISTA DE ENVIO REALIZADO</h4>  
              </div>

              <div class="modal-body panel-body">                       
                  <div class="form-group col-lg-3">
                    <label class="col-form-label">Personal (*)</label>
                    <input type="hidden" name="idpersonal" id="idpersonal">  
                      <input type="text" class="form-control" name="nombrepersonal" id="nombrepersonal" readonly>
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
                <h4 class="modal-title" style="color:#fff"><span id="titulo-formulario">Detalles</span> del envío para el cliente</h4>  
            </div>

            <div class="form-group col-sm-6 col-lg-12 " style="background: #fff ; padding:5px 10px" >
              <div class="row">
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Lugar de confirmación:</label>
                  <div class="input-group" >    
                    <select class=" form-control select-picker"  style="width:200px; height:35px" name="lugarenvio" id="lugarenvio" required >
                        <?php $cont=1; ?>
                        
                    <option value="Abancay"><?php echo $cont++; ?> Abancay</option>
                      <option value="Acobamba"><?php echo $cont++; ?> Acobamba</option>
                      <option value="Acomayo"><?php echo $cont++; ?> Acomayo</option>
                      <option value="Aija"><?php echo $cont++; ?> Aija</option>
                      <option value="Alto Amazonas"><?php echo $cont++; ?> Alto Amazonas</option>
                      <option value="Ambo"><?php echo $cont++; ?> Ambo</option>
                      <option value="Andahuaylas"><?php echo $cont++; ?> Andahuaylas</option>
                      <option value="Angaraes"><?php echo $cont++; ?> Angaraes</option>
                      <option value="Anta"><?php echo $cont++; ?> Anta</option>
                      <option value="Antabamba"><?php echo $cont++; ?> Antabamba</option>
                      <option value="Antonio Raimondi"><?php echo $cont++; ?> Antonio Raimondi</option>
                      <option value="Arequipa"><?php echo $cont++; ?> Arequipa</option>
                      <option value="Ascope"><?php echo $cont++; ?> Ascope</option>
                      <option value="Asunción"><?php echo $cont++; ?> Asunción</option>
                      <option value="Atalaya"><?php echo $cont++; ?> Atalaya</option>
                      <option value="Ayabaca"><?php echo $cont++; ?> Ayabaca</option>
                      <option value="Aymaraes"><?php echo $cont++; ?> Aymaraes</option>
                      <option value="Azángaro"><?php echo $cont++; ?> Azángaro</option>
                      <option value="Bagua"><?php echo $cont++; ?> Bagua</option>
                      <option value="Bambamarca"><?php echo $cont++; ?> Bambamarca</option>
                      <option value="Barranca"><?php echo $cont++; ?> Barranca</option>
                      <option value="Bellavista"><?php echo $cont++; ?> Bellavista</option>
                      <option value="Bolívar"><?php echo $cont++; ?> Bolívar</option>
                      <option value="Bolognesi"><?php echo $cont++; ?> Bolognesi</option>
                      <option value="Bongara"><?php echo $cont++; ?> Bongara</option>
                      <option value="Cabana"><?php echo $cont++; ?> Cabana</option>
                      <option value="Cajabamba"><?php echo $cont++; ?> Cajabamba</option>
                      <option value="Cajamarca"><?php echo $cont++; ?> Cajamarca</option>
                      <option value="Cajatambo"><?php echo $cont++; ?> Cajatambo</option>
                      <option value="Calca"><?php echo $cont++; ?> Calca</option>
                      <option value="Camaná"><?php echo $cont++; ?> Camaná</option>
                      <option value="Canas"><?php echo $cont++; ?> Canas</option>
                      <option value="Canchis"><?php echo $cont++; ?>Canchis</option>
                      <option value="Candarave"><?php echo $cont++; ?> Candarave</option>
                      <option value="Cangallo"><?php echo $cont++; ?> Cangallo</option>
                      <option value="Canta"><?php echo $cont++; ?> Canta</option>
                      <option value="Cañete"><?php echo $cont++; ?> Cañete</option>
                      <option value="Caraz"><?php echo $cont++; ?> Caraz</option>
                      <option value="Carabaya"><?php echo $cont++; ?> Carabaya</option>
                      <option value="Caravelí"><?php echo $cont++; ?> Caravelí</option>
                      <option value="Carhuaz"><?php echo $cont++; ?> Carhuaz</option>
                      <option value="Carlos Fermín Fitzcarrald"><?php echo $cont++; ?> Carlos Fermín Fitzcarrald</option>
                      <option value="Casma"><?php echo $cont++; ?> Casma</option>
                      <option value="Castilla"><?php echo $cont++; ?> Castilla</option>
                      <option value="Castrovirreyna"><?php echo $cont++; ?> Castrovirreyna</option>
                      <option value="Catacaos"><?php echo $cont++; ?> Catacaos</option>
                      <option value="Caylloma"><?php echo $cont++; ?> Caylloma</option>
                      <option value="Celendín"><?php echo $cont++; ?> Celendín</option>
                      <option value="Cerro Colorado"><?php echo $cont++; ?> Cerro Colorado</option>
                      <option value="Chancay"><?php echo $cont++; ?> Chancay</option>
                      <option value="Chachapoyas"><?php echo $cont++; ?> Chachapoyas</option>
                      <option value="Chanchamayo"><?php echo $cont++; ?> Chanchamayo</option>
                      <option value="Chao"><?php echo $cont++; ?> Chao</option>
                      <option value="Chavín de Huantar"><?php echo $cont++; ?> Chavín de Huantar</option>
                      <option value="Chepén"><?php echo $cont++; ?> Chepén</option>
                      <option value="Chiclayo"><?php echo $cont++; ?> Chiclayo</option>
                      <option value="Chincha"><?php echo $cont++; ?> Chincha</option>
                      <option value="Chincheros"><?php echo $cont++; ?> Chincheros</option>
                      <option value="Chota"><?php echo $cont++; ?> Chota</option>
                      <option value="Chucuito"><?php echo $cont++; ?> Chucuito</option>
                      <option value="Chumbivilcas"><?php echo $cont++; ?> Chumbivilcas</option>
                      <option value="Chupaca"><?php echo $cont++; ?> Chupaca</option>
                      <option value="Churcampa"><?php echo $cont++; ?> Churcampa</option>
                      <option value="Concepción"><?php echo $cont++; ?> Concepción</option>
                      <option value="Condesuyos"><?php echo $cont++; ?> Condesuyos</option>
                      <option value="Condorcanqui"><?php echo $cont++; ?> Condorcanqui</option>
                      <option value="Contralmirante Villar"><?php echo $cont++; ?> Contralmirante Villar</option>
                      <option value="Contumazá"><?php echo $cont++; ?> Contumazá</option>
                      <option value="Coronel Portillo"><?php echo $cont++; ?> Coronel Portillo</option>
                      <option value="Corongo"><?php echo $cont++; ?> Corongo</option>
                      <option value="Cotabambas"><?php echo $cont++; ?> Cotabambas</option>
                      <option value="Cutervo"><?php echo $cont++; ?> Cutervo</option>
                      <option value="Cuzco"><?php echo $cont++; ?> Cuzco</option>
                      <option value="Daniel Alcides  Carrión"><?php echo $cont++; ?> Daniel Alcides Carrión</option>
                      <option value="Datem del Marañón"><?php echo $cont++; ?> Datem del Marañón</option>
                      <option value="Dos de Mayo"><?php echo $cont++; ?> Dos del Mayo</option>
                      <option value="El Agustino"><?php echo $cont++; ?> El Agustino</option>
                      <option value="El Collao"><?php echo $cont++; ?> El Collao</option>
                      <option value="El Dorado"><?php echo $cont++; ?> El Dorado</option>
                      <option value="Espinar"><?php echo $cont++; ?> Espinar</option>
                      <option value="Ferreñafe"><?php echo $cont++; ?> Ferreñafe</option>
                      <option value="General Sánchez Cerro"><?php echo $cont++; ?> General Sánchez Cerro</option>
                      <option value="Gran Chimú"><?php echo $cont++; ?> Gran Chimú</option>
                      <option value="Grau"><?php echo $cont++; ?> Grau</option>
                      <option value="Huacaybamba"><?php echo $cont++; ?> Huacaybamba</option>
                      <option value="Huacho"><?php echo $cont++; ?> Huacho</option>
                      <option value="Hualgayoc"><?php echo $cont++; ?> Hualgayoc</option>
                      <option value="Huallaga"><?php echo $cont++; ?> Huallaga</option>
                      <option value="Huamachuco"><?php echo $cont++; ?> Huamachuco</option>
                      <option value="Huamalíes"><?php echo $cont++; ?> Huamalíes</option>
                      <option value="Huamanga"><?php echo $cont++; ?> Huamanga</option>
                      <option value="Huanca Sancos"><?php echo $cont++; ?> Huanca Sancos</option>
                      <option value="Huancabamba"><?php echo $cont++; ?> Huancabamba</option>
                      <option value="Huancané"><?php echo $cont++; ?> Huancané</option>
                      <option value="Huancavelica"><?php echo $cont++; ?> Huancavelica</option>
                      <option value="Huancayo"><?php echo $cont++; ?> Huancayo</option>
                      <option value="Huanta"><?php echo $cont++; ?> Huanta</option>
                      <option value="Huánuco"><?php echo $cont++; ?> Huánuco</option>
                      <option value="Huaral"><?php echo $cont++; ?> Huaral</option>
                      <option value="Huaraz"><?php echo $cont++; ?> Huaraz</option>
                      <option value="Huari"><?php echo $cont++; ?> Huari</option>
                      <option value="Huarmey"><?php echo $cont++; ?> Huarmey</option>
                      <option value="Huarochirí"><?php echo $cont++; ?> Huarochirí</option>
                      <option value="Huaura"><?php echo $cont++; ?> Huaura</option>
                      <option value="Huaylas"><?php echo $cont++; ?> Huaylas</option>
                      <option value="Huaytará"><?php echo $cont++; ?> Huaytará</option>
                      <option value="Ica"><?php echo $cont++; ?> Ica</option>
                      <option value="Ilo"><?php echo $cont++; ?> Ilo</option>
                      <option value="Islay"><?php echo $cont++; ?> Islay</option>
                      <option value="Jaén"><?php echo $cont++; ?> Jaén</option>
                      <option value="Jauja"><?php echo $cont++; ?> Jauja</option>
                      <option value="Jorge Basadre"><?php echo $cont++; ?> Jorge Basadre</option>
                      <option value="Juanjuí"><?php echo $cont++; ?> Juanjuí</option>
                      <option value="Julcán"><?php echo $cont++; ?> Julcán</option>
                      <option value="Junín"><?php echo $cont++; ?> Junín</option>
                      <option value="La Convención"><?php echo $cont++; ?> La Convención</option>
                      <option value="La Mar"><?php echo $cont++; ?> La Mar</option>
                      <option value="La Unión"><?php echo $cont++; ?> La Unión</option>
                      <option value="Lamas"><?php echo $cont++; ?> Lamas</option>
                      <option value="Lambayeque"><?php echo $cont++; ?> Lambayeque</option>
                      <option value="Lampa"><?php echo $cont++; ?> Lampa</option>
                      <option value="Lauricocha"><?php echo $cont++; ?> Lauricocha</option>
                      <option value="LeoncioPrado"><?php echo $cont++; ?> LeoncioPrado</option>
                      <option value="Lima"><?php echo $cont++; ?> Lima</option>
                      <option value="Lircay"><?php echo $cont++; ?> Lircay</option>
                      <option value="Llamellín"><?php echo $cont++; ?> Llamellín</option>
                      <option value="Loreto"><?php echo $cont++; ?> Loreto</option>
                      <option value="Lucanas"><?php echo $cont++; ?> Lucanas</option>
                      <option value="Luya"><?php echo $cont++; ?> Luya</option>
                      <option value="Manu"><?php echo $cont++; ?> Manu</option>
                       <option value="Mala"><?php echo $cont++; ?> Mala</option>
                      <option value="Marañón"><?php echo $cont++; ?> Marañón</option>
                      <option value="Mariscal Cáceres"><?php echo $cont++; ?> Mariscal Cáceres</option>
                      <option value="Mariscal Luzuriaga"><?php echo $cont++; ?> Mariscal Luzuriaga</option>
                      <option value="Mariscal Nieto"><?php echo $cont++; ?> Mariscal Nieto</option>
                      <option value="Mariscal RamónCastilla"><?php echo $cont++; ?> Mariscal Ramón Castilla</option>
                      <option value="Maynas"><?php echo $cont++; ?> Maynas</option>
                      <option value="Melgar"><?php echo $cont++; ?> Melgar</option>
                      <option value="Miraflores"><?php echo $cont++; ?> Miraflores</option>
                      <option value="Moho"><?php echo $cont++; ?> Moho</option>
                      <option value="Morropón"><?php echo $cont++; ?> Morropón</option>
                      <option value="Moyobamba"><?php echo $cont++; ?> Moyobamba</option>
                      <option value="Nazca"><?php echo $cont++; ?> Nazca</option>
                      <option value="Ocros"><?php echo $cont++; ?> Ocros</option>
                      <option value="Otuzco"><?php echo $cont++; ?> Otuzco</option>
                      <option value="Oxapampa"><?php echo $cont++; ?> Oxapampa</option>
                      <option value="Oyón"><?php echo $cont++; ?> Oyón</option>
                      <option value="Pacasmayo"><?php echo $cont++; ?> Pacasmayo</option>
                      <option value="Pachitea"><?php echo $cont++; ?> Pachitea</option>
                      <option value="Padre Abad"><?php echo $cont++; ?> Padre Abad</option>
                      <option value="Paita"><?php echo $cont++; ?> Paita</option>
                      <option value="Pallasca"><?php echo $cont++; ?> Pallasca</option>
                      <option value="Palpa"><?php echo $cont++; ?> Palpa</option>
                      <option value="Parinacochas"><?php echo $cont++; ?> Parinacochas</option>
                      <option value="Paruro"><?php echo $cont++; ?> Paruro</option>
                      <option value="Pasco"><?php echo $cont++; ?> Pasco</option>
                      <option value="Pataz"><?php echo $cont++; ?> Pataz</option>
                      <option value="Páucar del Sara Sara"><?php echo $cont++; ?> Páucar del Sara Sara</option>
                      <option value="Paucartambo"><?php echo $cont++; ?> Paucartambo</option>
                      <option value="Picota"><?php echo $cont++; ?> Picota</option>
                      <option value="Pisco"><?php echo $cont++; ?> Pisco</option>
                      <option value="Piura"><?php echo $cont++; ?> Piura</option>
                      <option value="Pomabamba"><?php echo $cont++; ?> Pomabamba</option>
                      <option value="Prov. Const. del Callao"><?php echo $cont++; ?> Prov. Const. del Callao</option>
                      <option value="PuertoInca"><?php echo $cont++; ?> PuertoInca</option>
                      <option value="Puno"><?php echo $cont++; ?> Puno</option>
                      <option value="Purús"><?php echo $cont++; ?> Purús</option>
                      <option value="Putumayo"><?php echo $cont++; ?> Putumayo</option>
                      <option value="Quispicanchi"><?php echo $cont++; ?> Quispicanchi</option>
                      <option value="Recuay"><?php echo $cont++; ?> Recuay</option>
                      <option value="Requena"><?php echo $cont++; ?> Requena</option>
                      <option value="Rioja"><?php echo $cont++; ?> Rioja</option>
                      <option value="Rodríguez de Mendoza"><?php echo $cont++; ?> Rodríguez de Mendoza</option>
                      <option value="San Antonio de Putina"><?php echo $cont++; ?> San Antonio de Putina</option>
                      <option value="San Ignacio"><?php echo $cont++; ?> San Ignacio</option>
                      <option value="San Marcos"><?php echo $cont++; ?> San Marcos</option>
                      <option value="San Martín"><?php echo $cont++; ?> San Martín</option>
                      <option value="S.M. Pangoa"><?php echo $cont++; ?> S.M. Pangoa</option>
                      <option value="San Miguel"><?php echo $cont++; ?> San Miguel</option>
                      <option value="San Pablo"><?php echo $cont++; ?> San Pablo</option>
                      <option value="San Román"><?php echo $cont++; ?> San Román</option>
                      <option value="Sánchez Carrión"><?php echo $cont++; ?> Sánchez Carrión</option>
                      <option value="Sandia"><?php echo $cont++; ?> Sandia</option>
                      <option value="Santa"><?php echo $cont++; ?> Santa</option>
                      <option value="Santa Cruz"><?php echo $cont++; ?> Santa Cruz</option>
                      <option value="Santiago de Chuco"><?php echo $cont++; ?> Santiago de Chuco</option>
                      <option value="Satipo"><?php echo $cont++; ?> Satipo</option>
                      <option value="Sechura"><?php echo $cont++; ?> Sechura</option>
                      <option value="Sicuani"><?php echo $cont++; ?> Sicuani</option>
                      <option value="Sihuas"><?php echo $cont++; ?> Sihuas</option>
                      <option value="Socabaya"><?php echo $cont++; ?> Socabaya</option>
                      <option value="Sucre"><?php echo $cont++; ?> Sucre</option>
                      <option value="Sullana"><?php echo $cont++; ?> Sullana</option>
                      <option value="Tacna"><?php echo $cont++; ?> Tacna</option>
                      <option value="Tahuamanu"><?php echo $cont++; ?> Tahuamanu</option>
                      <option value="Talara"><?php echo $cont++; ?> Talara</option>
                      <option value="Tambopata"><?php echo $cont++; ?> Tambopata</option>
                      <option value="Tarata"><?php echo $cont++; ?> Tarata</option>
                      <option value="Tarma"><?php echo $cont++; ?> Tarma</option>
                      <option value="Tayacaja"><?php echo $cont++; ?> Tayacaja</option>
                      <option value="Tingo Maria"><?php echo $cont++; ?> Tingo María</option>
                      <option value="Tocache"><?php echo $cont++; ?> Tocache</option>
                      <option value="Trujillo"><?php echo $cont++; ?> Trujillo</option>
                      <option value="Tumbes"><?php echo $cont++; ?> Tumbes</option>
                      <option value="Ucayali"><?php echo $cont++; ?> Ucayali</option>
                      <option value="Urubamba"><?php echo $cont++; ?> Urubamba</option>
                      <option value="Utcubamba"><?php echo $cont++; ?> Utcubamba</option>
                      <option value="Víctor Fajardo"><?php echo $cont++; ?> Víctor Fajardo</option>
                      <option value="Vilcashuamán"><?php echo $cont++; ?> Vilcashuamán</option>
                      <option value="Virú"><?php echo $cont++; ?> Virú</option>
                      <option value="Yarowilca"><?php echo $cont++; ?> Yarowilca</option>
                      <option value="Yauli"><?php echo $cont++; ?> Yauli</option>
                      <option value="Yauyos"><?php echo $cont++; ?> Yauyos</option>
                      <option value="Yungay"><?php echo $cont++; ?> Yungay</option>
                      <option value="Yunguyo"><?php echo $cont++; ?> Yunguyo</option>
                      <option value="Zarumilla"><?php echo $cont++; ?> Zarumilla</option>
                      <option value="Zorritos"><?php echo $cont++; ?> Zorritos</option>
                      </select>                     
                  </div>
                </div>

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Monto:</label>
                  <div class="input-group"> 
                    <input type="text" class="form-control" name="monto" id="monto" maxlength="10" style="width:200px; height:35px" placeholder="Ingrese el monto de Envio: 8.50"  >           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div>           

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Courier:</label>
                  <div class="input-group">    
                    <select id="idcourier" name="idcourier" class="selectpicker" data-live-search="true" style="width: 320px; height:34px;" ></select>              
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div>

                <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                  <label>Dirección de envío:</label>
                  <div class="input-group">    
                    <input type="text" class="form-control" name="direccion_envio" id="direccion_envio" style="width:700px;" maxlength="500" placeholder="Dirección de envío de courier y número de courier" >                     
                  </div>                  
                </div>
              </div>

              <div class="row">
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Fecha de envío:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="fechaenvio" id="fechaenvio" style="width:200px; height:35px" maxlength="200" placeholder="Fecha de envio" >           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div> 

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Clave de envío:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="clave" id="clave" style="width:200px; height:35px" maxlength="200" placeholder="Clave de envio" >           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div> 

                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Número de factura de envío:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="factura_envio" id="factura_envio" style="width:220px; height:35px" maxlength="200" placeholder="Factura de envio" >           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div>
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Fecha de probable recojo:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="observacion_cliente" id="observacion_cliente" style="width:200px; height:35px" maxlength="200" placeholder="Fecha de probable recojo" >           
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div>
                <div class="form-group col-lg-2 col-md-8 col-sm-8 col-xs-12">
                  <label>Información de seguimiento:</label>
                  <div class="input-group">
                    <textarea style="width: 340px; height:40px" type="text" class="form-control" name="tracking_info" id="tracking_info" placeholder="Observaciones" maxlength="200" > </textarea>
                    <!-- <input type="date" class="form-control" name="observacion_cliente" id="observacion_cliente" style="width:200px; height:35px" maxlength="200" placeholder="Fecha de probable recojo" >     -->       
                  </div>
                  <label for="name" class="control-label text-right" style="color: #c0392b ; font-size: 14px">* Obligatorio</label>
                </div> 
              </div>

              <div class="row" >              

                <div class="form-group col-lg-12 col-md-8 col-sm-8 col-xs-12" style=" border-color: #666; border-width: 2px 0px 0px 0px; border-style: dashed;"><br>
                  <label>Observaciones de envío interno:</label>
                  <div class="input-group">
                    <textarea style="width: 1400px; height:40px" type="text" class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones" maxlength="200" > </textarea>          
                  </div>
                </div> 
              </div>
            </div>   
              
            <div class="modal-footer panel-footer">
                 <button class="btn btn-primary" type="submit" id="btnGuardar" style="font-size:18px" ><i class="fa fa-save"></i> Guardar y Actualizar Envio</button>
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" style="font-size:18px" ><i class="fa fa-times"></i> Cancelar</button>
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
<script type="text/javascript" src="js/listadeenvios.js"></script>
<?php 
}
ob_end_flush();
?>



