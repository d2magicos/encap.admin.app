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
      
        <!-- Main content -->
        <section class="content">
        <section class="content-header">
            <br>
            <ol class="breadcrumb">      
              <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>      
              <li class="active">Consulta por Ciudades de envios</li>    
            </ol>
        </section>
        <div class="panel panel-default" style="border-color:#666; border-width: 3px; border-style: double;">

          <div class="panel-heading">
        <div class="box-header with-border" >
            <h1 class="box-title" > Consulta por Ciudades de envios </h1>
        </div> 
      </div>

      <div class="panel-body table-responsive" class="box-body" id="listadoregistros">
        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
              <thead>
                <th>Id</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Ciudad Principal</th>
                <th>Courier</th>
                <th>Costo</th>
                <th>Adicional</th>
                <th>Direccion</th>
              </thead>
              <tbody>                            
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Ciudad Principal</th>
                <th>Courier</th>
                <th>Costo</th>
                <th>Adicional</th>
                <th>Direccion</th>
              </tfoot>
            </table>
      </div>
    </div>
  </section>
</div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">

  <div class="modal-dialog modal-lg" style="height:800px;">

    <div class="modal-content">
      <!-- form -->
      <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">

        <div class="modal-header" style="background:#151e38; color:white">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title; text-center">Formulario de Ciudades de envios</h4>
        </div>

        <div class="modal-body panel-body" style="padding: 20px; ">

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Ciudad Principal<spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9">
            <input type="hidden" name="idciudad" id="idciudad">
              <input type="text" class="form-control" name="ciudad" id="ciudad" maxlength="50" placeholder="Ciudad Principal" required >
            </div>           
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Provincia <spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9">
           
              <select class=" form-control select-picker"  name="provincia" id="provincia" required >
                        <option value="" >Seleccionar</option>
                        <option value="Abancay">1 Abancay</option>
                      <option value="Acobamba">2 Acobamba</option>
                      <option value="Acomayo">3 Acomayo</option>
                      <option value="Aija">4 Aija</option>
                      <option value="Alto Amazonas">5 Alto Amazonas</option>
                      <option value="Ambo">6 Ambo</option>
                      <option value="Andahuaylas">7 Andahuaylas</option>
                      <option value="Angaraes">8 Angaraes</option>
                      <option value="Anta">9 Anta</option>
                      <option value="Antabamba">10 Antabamba</option>
                      <option value="Antonio Raimondi">11 Antonio Raimondi</option>
                      <option value="Arequipa">12 Arequipa</option>
                      <option value="Ascope">13 Ascope</option>
                      <option value="Asunci??n">14 Asunci??n</option>
                      <option value="Atalaya">15 Atalaya</option>
                      <option value="Ayabaca">16 Ayabaca</option>
                      <option value="Aymaraes">17 Aymaraes</option>
                      <option value="Az??ngaro">18 Az??ngaro</option>
                      <option value="Bagua">19 Bagua</option>
                      <option value="Barranca">20 Barranca</option>
                      <option value="Bellavista">21 Bellavista</option>
                      <option value="Bol??var">22 Bol??var</option>
                      <option value="Bolognesi">23 Bolognesi</option>
                      <option value="Bongara">24 Bongara</option>
                      <option value="Cajabamba">25 Cajabamba</option>
                      <option value="Cajamarca">26 Cajamarca</option>
                      <option value="Cajatambo">27 Cajatambo</option>
                      <option value="Calca">28 Calca</option>
                      <option value="Caman??">29 Caman??</option>
                      <option value="Canas">30 Canas</option>
                      <option value="Canchis">31 Canchis</option>
                      <option value="Candarave">32 Candarave</option>
                      <option value="Cangallo">33 Cangallo</option>
                      <option value="Canta">34 Canta</option>
                      <option value="Ca??ete">35 Ca??ete</option>
                      <option value="Carabaya">36 Carabaya</option>
                      <option value="Caravel??">37 Caravel??</option>
                      <option value="Carhuaz">38 Carhuaz</option>
                      <option value="Carlos Ferm??n Fitzcarrald">39 Carlos Ferm??n Fitzcarrald</option>
                      <option value="Casma">40 Casma</option>
                      <option value="Castilla">41 Castilla</option>
                      <option value="Castrovirreyna">42 Castrovirreyna</option>
                      <option value="Caylloma">43 Caylloma</option>
                      <option value="Celend??n">44 Celend??n</option>
                      <option value="Chachapoyas">45 Chachapoyas</option>
                      <option value="Chanchamayo">46 Chanchamayo</option>
                      <option value="Chep??n">47 Chep??n</option>
                      <option value="Chiclayo">48 Chiclayo</option>
                      <option value="Chincha">49 Chincha</option>
                      <option value="Chincheros">50 Chincheros</option>
                      <option value="Chota">51 Chota</option>
                      <option value="Chucuito">52 Chucuito</option>
                      <option value="Chumbivilcas">53 Chumbivilcas</option>
                      <option value="Chupaca">54 Chupaca</option>
                      <option value="Churcampa">55 Churcampa</option>
                      <option value="Concepci??n">56 Concepci??n</option>
                      <option value="Condesuyos">57 Condesuyos</option>
                      <option value="Condorcanqui">58 Condorcanqui</option>
                      <option value="Contralmirante Villar">59 Contralmirante Villar</option>
                      <option value="Contumaz??">60 Contumaz??</option>
                      <option value="Coronel Portillo">61 Coronel Portillo</option>
                      <option value="Corongo">62 Corongo</option>
                      <option value="Cotabambas">63 Cotabambas</option>
                      <option value="Cutervo">64 Cutervo</option>
                      <option value="Cuzco">65 Cuzco</option>
                      <option value="Daniel Alcides  Carri??n">66 Daniel Alcides Carri??n</option>
                      <option value="Datem del Mara????n">67 Datem del Mara????n</option>
                      <option value="Dos de Mayo">68 Dos del Mayo</option>
                      <option value="El Collao">69 El Collao</option>
                      <option value="El Dorado">70 El Dorado</option>
                      <option value="Espinar">71 Espinar</option>
                      <option value="Ferre??afe">72 Ferre??afe</option>
                      <option value="General S??nchez Cerro">73 General S??nchez Cerro</option>
                      <option value="Gran Chim??">74 Gran Chim??</option>
                      <option value="Grau">75 Grau</option>
                      <option value="Huacaybamba">76 Huacaybamba</option>
                      <option value="Hualgayoc">77 Hualgayoc</option>
                      <option value="Huallaga">78 Huallaga</option>
                      <option value="Huamal??es">79 Huamal??es</option>
                      <option value="Huamanga">80 Huamanga</option>
                      <option value="Huanca Sancos">81 Huanca Sancos</option>
                      <option value="Huancabamba">82 Huancabamba</option>
                      <option value="Huancan??">83 Huancan??</option>
                      <option value="Huancavelica">84 Huancavelica</option>
                      <option value="Huancayo">85 Huancayo</option>
                      <option value="Huanta">86 Huanta</option>
                      <option value="Hu??nuco">87 Hu??nuco</option>
                      <option value="Huaral">88 Huaral</option>
                      <option value="Huaraz">89 Huaraz</option>
                      <option value="Huari">90 Huari</option>
                      <option value="Huarmey">91 Huarmey</option>
                      <option value="Huarochir??">92 Huarochir??</option>
                      <option value="Huaura">93 Huaura</option>
                      <option value="Huaylas">94 Huaylas</option>
                      <option value="Huaytar??">95 Huaytar??</option>
                      <option value="Ica">96 Ica</option>
                      <option value="Ilo">97 Ilo</option>
                      <option value="Islay">98 Islay</option>
                      <option value="Ja??n">99 Ja??n</option>
                      <option value="Jauja">100 Jauja</option>
                      <option value="Jorge Basadre">101 Jorge Basadre</option>
                      <option value="Julc??n">102 Julc??n</option>
                      <option value="Jun??n">103 Jun??n</option>
                      <option value="La Convenci??n">104 La Convenci??n</option>
                      <option value="La Mar">105 La Mar</option>
                      <option value="La Uni??n">106 La Uni??n</option>
                      <option value="Lamas">107 Lamas</option>
                      <option value="Lambayeque">108 Lambayeque</option>
                      <option value="Lampa">109 Lampa</option>
                      <option value="Lauricocha">110 Lauricocha</option>
                      <option value="LeoncioPrado">111 LeoncioPrado</option>
                      <option value="Lima">112 Lima</option>
                      <option value="Loreto">113 Loreto</option>
                      <option value="Lucanas">114 Lucanas</option>
                      <option value="Luya">115 Luya</option>
                      <option value="Manu">116 Manu</option>
                      <option value="Mara????n">117 Mara????n</option>
                      <option value="Mariscal C??ceres">118 Mariscal C??ceres</option>
                      <option value="Mariscal Luzuriaga">119 Mariscal Luzuriaga</option>
                      <option value="Mariscal Nieto">120 Mariscal Nieto</option>
                      <option value="Mariscal Ram??nCastilla">121 Mariscal Ram??n Castilla</option>
                      <option value="Maynas">122 Maynas</option>
                      <option value="Melgar">123 Melgar</option>
                      <option value="Moho">124 Moho</option>
                      <option value="Morrop??n">125 Morrop??n</option>
                      <option value="Moyobamba">126 Moyobamba</option>
                      <option value="Nazca">127 Nazca</option>
                      <option value="Ocros">128 Ocros</option>
                      <option value="Otuzco">129 Otuzco</option>
                      <option value="Oxapampa">130 Oxapampa</option>
                      <option value="Oy??n">131 Oy??n</option>
                      <option value="Pacasmayo">132 Pacasmayo</option>
                      <option value="Pachitea">133 Pachitea</option>
                      <option value="Padre Abad">134 Padre Abad</option>
                      <option value="Paita">135 Paita</option>
                      <option value="Pallasca">136 Pallasca</option>
                      <option value="Palpa">137 Palpa</option>
                      <option value="Parinacochas">138 Parinacochas</option>
                      <option value="Paruro">139 Paruro</option>
                      <option value="Pasco">140 Pasco</option>
                      <option value="Pataz">141 Pataz</option>
                      <option value="P??ucar del Sara Sara">142 P??ucar del Sara Sara</option>
                      <option value="Paucartambo">143 Paucartambo</option>
                      <option value="Picota">144 Picota</option>
                      <option value="Pisco">145 Pisco</option>
                      <option value="Piura">146 Piura</option>
                      <option value="Pomabamba">147 Pomabamba</option>
                      <option value="Prov. Const. del Callao">148 Prov. Const. del Callao</option>
                      <option value="PuertoInca">149 PuertoInca</option>
                      <option value="Puno">150 Puno</option>
                      <option value="Pur??s">151 Pur??s</option>
                      <option value="Putumayo">152 Putumayo</option>
                      <option value="Quispicanchi">153 Quispicanchi</option>
                      <option value="Recuay">154 Recuay</option>
                      <option value="Requena">155 Requena</option>
                      <option value="Rioja">156 Rioja</option>
                      <option value="Rodr??guez de Mendoza">157 Rodr??guez de Mendoza</option>
                      <option value="San Antonio de Putina">158 San Antonio de Putina</option>
                      <option value="San Ignacio">159 San Ignacio</option>
                      <option value="San Marcos">160 San Marcos</option>
                      <option value="San Mart??n">161 San Mart??n</option>
                      <option value="San Miguel">162 San Miguel</option>
                      <option value="San Pablo">163 San Pablo</option>
                      <option value="San Rom??n">164 San Rom??n</option>
                      <option value="S??nchez Carri??n">165 S??nchez Carri??n</option>
                      <option value="Sandia">166 Sandia</option>
                      <option value="Santa">167 Santa</option>
                      <option value="Santa Cruz">168 Santa Cruz</option>
                      <option value="Santiago de Chuco">169 Santiago de Chuco</option>
                      <option value="Satipo">170 Satipo</option>
                      <option value="Sechura">171 Sechura</option>
                      <option value="Sihuas">172 Sihuas</option>
                      <option value="Sucre">173 Sucre</option>
                      <option value="Sullana">174 Sullana</option>
                      <option value="Tacna">175 Tacna</option>
                      <option value="Tahuamanu">176 Tahuamanu</option>
                      <option value="Talara">177 Talara</option>
                      <option value="Tambopata">178 Tambopata</option>
                      <option value="Tarata">179 Tarata</option>
                      <option value="Tarma">180 Tarma</option>
                      <option value="Tayacaja">181 Tayacaja</option>
                      <option value="Tocache">182 Tocache</option>
                      <option value="Trujillo">183 Trujillo</option>
                      <option value="Tumbes">184 Tumbes</option>
                      <option value="Ucayali">185 Ucayali</option>
                      <option value="Urubamba">186 Urubamba</option>
                      <option value="Utcubamba">187 Utcubamba</option>
                      <option value="V??ctor Fajardo">188 V??ctor Fajardo</option>
                      <option value="Vilcashuam??n">189 Vilcashuam??n</option>
                      <option value="Vir??">190 Vir??</option>
                      <option value="Yarowilca">191 Yarowilca</option>
                      <option value="Yauli">192 Yauli</option>
                      <option value="Yauyos">193 Yauyos</option>
                      <option value="Yungay">194 Yungay</option>
                      <option value="Yunguyo">195 Yunguyo</option>
                      <option value="Zarumilla">196 Zarumilla</option>
                      </select>           
            </div>           
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Departamento <spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9">              
              <select class="form-control select-picker" name="departamento" id="departamento" required>
                  <option value="" >Seleccionar</option>
                  <option value="AMAZONAS" >AMAZONAS</option>
                  <option value="??NCASH">??NCASH</option>
                  <option value="APUR??MAC">APUR??MAC</option>
                  <option value="AREQUIPA" >AREQUIPA</option>
                  <option value="AYACUCHO">AYACUCHO</option>
                  <option value="CAJAMARCA">CAJAMARCA</option>
                  <option value="CUSCO" >CUSCO</option>
                  <option value="HUANCAVELICA">HUANCAVELICA</option>
                  <option value="HU??NUCO">HU??NUCO</option>
                  <option value="ICA" >ICA</option>
                  <option value="JUN??N">JUN??N</option>
                  <option value="LA LIBERTAD">LA LIBERTAD</option>
                  <option value="LAMBAYEQUE" >LAMBAYEQUE</option>
                  <option value="LIMA">LIMA</option>
                  <option value="LORETO">LORETO</option>
                  <option value="MADRE DE DIOS" >MADRE DE DIOS</option>
                  <option value="MOQUEGUA">MOQUEGUA</option>
                  <option value="PASCO">PASCO</option>
                  <option value="PIURA" >PIURA</option>
                  <option value="PUNO">PUNO</option>
                  <option value="SAN MART??N">SAN MART??N</option>
                  <option value="TACNA">TACNA</option>
                  <option value="TUMBES" >TUMBES</option>
                  <option value="UCAYALI">UCAYALI</option>
                  <option value="OTROS">OTROS</option>
              </select>   
            </div>           
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-3 control-label">Courier <spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9"> 
              <select id="idcourier" name="idcourier" class="form-control selectpicker" data-live-search="true" required></select>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Monto Adicional <spam style="color: #c0392b ; font-size: 18px">*</spam> :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="montoa" id="montoa" maxlength="50" placeholder="Monto Adicional" >
            </div>           
          </div>

          <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Direcci??n: </label>
            <div class="col-sm-10"> 
              <textarea class="form-control" name="direccion" id="direccion" maxlength="800" placeholder="Direcci??n"></textarea>
            </div>
          </div>
          
         </div>
         <div class="text-center" style="color: #c0392b"><p><spam style="color: #c0392b ; font-size: 18px">*</spam> Campos obligatorios</p></div>
         
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
        </div>

      </form>        
    </div>
  </div>
</div> 
<!-- Fin modal -->
  <!-- Modal -->
  <div class="modal fade" id="myCarga" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
         <!-- form -->

      <div class="modal-header" style="background:#151e38; color:white">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title; text-center">Cargar Cursos</h4>
      </div>
    
       <form action="files.php" method="post" enctype="multipart/form-data" id="filesForm">
            <div class="col-md-6 offset-md-4">
                <input class="form-control" type="file" name="fileContacts" id="fileContacts">
                <button type="button" onclick="uploadContacts()" class="btn btn-primary form-control" >Cargar</button>
            </div>
        </form>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" onclick="cancelarform()" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
        
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
<script type="text/javascript" src="js/consultaenvio.js"></script>
<?php 
}
ob_end_flush();
?>