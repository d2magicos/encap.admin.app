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
if ($_SESSION['personal']==1)
{
?>
<!--Contenido-->
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    
        <section class="content">

        <section class="content-header">
            <br>
            <ol class="breadcrumb">      
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
              <li class="active">Administrar Personal</li>    
            </ol>
        </section>

        <div class="panel panel-default" style="border-color: #666; border-width: 3px; border-style: double;">
          <div class="panel-heading">
          <div class="box-header with-border" >
              <h1 class="box-title">Administar personal</h1>
          </div>
        </div>

          <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="font-size:18px"><i class="fa fa-plus"> Crear Nuevo Personal </i>
            </button>
            <br><br>
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Fecha</th>
                <th>Apellidos y Nombres</th>
                <th>Documento - Numero</th>
                <th>Teléfono</th>
                <th>Teléfono 2</th>
                <th>Email</th>
                <th>Pais</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Fecha Cumpleaño</th>
                <th>Cargo</th>
                <th>Foto</th>
                <th>Estado</th>
                <th>?</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Fecha</th>
                <th>Apellidos y Nombres</th>
                <th>Documento - Numero</th>
                <th>Teléfono</th>
                <th>Teléfono 2</th>
                <th>Email</th>
                <th>Pais</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Fecha Cumpleaño</th>
                <th>Cargo</th>
                <th>Foto</th>
                <th>Estado</th>
                <th>?</th>
              </tfoot>
            </table>
      </div>
    </div>
  </section>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <!-- form -->
      <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">

        <div class="modal-header" style="background:#151e38; color:white">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center"> Formulario del Personal</h4>
        </div>

        <div class="modal-body"> 

        <div class="form-group">                          
              <label for="name" class="col-sm-3 control-label" >Fecha Ingreso al Sistema:</label>
              <div class="col-sm-4 input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input style="border-color:#FFC7BB; text-align:center" class="form-control" type="date" name="fecha_hora" id="fecha_hora" required>
              </div>
            </div>

          <div class="form-group">               
            <label for="name" class="col-sm-3 control-label">Apellidos y Nombres<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-9"> 
              <input type="hidden" name="idpersonal" id="idpersonal">
              <input type="text" class="form-control" name="nombre1" id="nombre1" maxlength="100" placeholder="Apellidos y Nombres" required>
              <label for="name" class="control-label" style="color: #c0392b ; font-size: 14px">Ejemplo: *SANTANA HINOJOSA, JUAN CARLOS*</label> 
            </div> 
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Tipo Documento<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4"> 
              <select id="idtipo_documento" name="idtipo_documento" class="form-control selectpicker" data-live-search="true" required></select>
              <!-- <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
              <option value="DNI" selected="selected">DNI</option>
              <option value="RUC">RUC</option>
              <option value="CEDULA">CEDULA</option>
              <option value="OTROS">OTROS</option>
            </select> -->
            </div>

            <label for="name" class="col-sm-2 control-label">Número Documento<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div style="display:flex">
              <input type="number" class="form-control" name="num_documento" id="num_documento" maxlength="12" placeholder="Numero de Documento" required>
              <button class="btn btn-info"  type="button" onclick="Buscar();">Buscar</button>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Teléfono 1<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4"> 
              <input type="number" class="form-control" name="telefono" id="telefono" maxlength="17" placeholder="Celular" required>
            </div>

            <label for="name" class="col-sm-2 control-label">Teléfono 2 :</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" name="telefono2" id="telefono2" maxlength="17" placeholder="Teléfono">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Email<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4"> 
              <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email" required>
            </div>

            <label for="name" class="col-sm-2 control-label">País<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4">
              <!-- <input type="text" class="form-control" name="pais" id="pais" maxlength="10" placeholder="País" > -->
              <select id="idpais" name="idpais" class="form-control selectpicker" data-live-search="true" required></select>
              <!-- <select class="form-control select-picker" name="pais" id="pais" required >
                  <option value="PERÚ" selected="selected">PERÚ</option>
                  <option value="MEXICO">MEXICO</option>
                  <option value="ECUADOR">ECUADOR</option>
                  <option value="COLOMBIA">COLOMBIA</option>
                  <option value="ARGENTINA">ARGENTINA</option>
                  <option value="PANAMÁ">PANAMÁ</option>
                  <option value="PUERTO RICO">PUERTO RICO</option>
                  <option value="OTROS">OTROS</option>
              </select>  -->
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Departamento<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4"> 
              <select class="form-control select-picker" name="departamento" id="departamento" required>
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
              </select>   
            </div>

            <label for="name" class="col-sm-2 control-label">Ciudad<spam style="color: #c0392b ; font-size: 18px">*</spam> : </label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="50" placeholder="Ciudad" required>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Dirección :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" placeholder="Dirección">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Fecha de Cumpleaño<spam style="color: #c0392b ; font-size: 18px">*</spam>:</label>
            <div class="col-sm-4"> 
              <input type="text" class="form-control" name="fecha_cumple" id="fecha_cumple" maxlength="10" placeholder="Fecha de Cumpleaño" required>
              <label for="name" class="control-label" style="color: #c0392b ; font-size: 14px">01/01/2022</label>
            </div>

            <label for="name" class="col-sm-2 control-label">Cargo<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="cargo1" id="cargo1" maxlength="20" placeholder="Cargo" required>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Imagen:</label>
            <div class="col-sm-6">
              <input type="file" class="form-control" name="imagen" id="imagen">
            <input type="hidden" name="imagenactual" id="imagenactual">
            <img src="" width="150px" height="120px" id="imagenmuestra">
            </div>
          </div>
         </div>
         <div class="text-center" style="color: #c0392b"><p><spam style="color: #c0392b ; font-size: 18px">*</spam> Campos obligatorios</p></div>
        <div class="modal-footer">
          <button type="button" onclick="cancelarform()" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </form>        
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
<script type="text/javascript" src="js/empleado.js"></script>
<script type="text/javascript" src="js/consultaDNI.js"></script>
<?php 
}
ob_end_flush();
?>
