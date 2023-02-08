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
if ($_SESSION['reportes']==1)
{
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->

        <section class="content"  style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
            <div class="row" >
              <div class="col-md-12" style="background: #181f38; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                  <div class="panel " style="background: #181f38; color:#fff;">
                  <div class="col-md-12" style="background: #181f38">
                  <div class="box">
                    <div class="box-header with-border text-center" style="background: #181f38;">
                          <h1 class="box-title" style="color:#fff">- Consultas reporte de Envíos por <strong>  Fecha </strong> - </h1>
                    </div>
                  </div>
              </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body" >
                      <div class="row">
                          <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Inicio</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                          </div>

                          <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Fin</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                          </div>

                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">   
                          <label></label>                           
                              <div class="form-group has-success">                                
                                  <div class="input-group">                                      
                                      <span class="input-group-btn">
                                        <button class="btn btn-warning" style="width:100%; height:100%; border-radius: 20px; font-size:20px" onclick="Cargar()"><i class="fa fa-search"></i> Mostrar Resultados</button>
                                      </span>
                                  </div>   
                              </div> 
                          </div>               
                      </div>
                    </div>
                  </div>
              </div>
            </div>

        <div class="row">
            <!-- N° de ventas por tipo y asesor -->  
            <div class="col-md-6" >
              <!-- tabla de ventas por mes -->
              <div class="box box-info" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                   <div class="box-header">
                     <h3 class="box-title" style="font-size:17px; color:#fff">- ENVÍOS SEGUN TIPO DE CURSO CANTIDAD Y MONTO -</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff">
                   <table id="listanenviosseguntipo"class="table table-striped table-bordered table-condensed table-hover" width="100%" height="300"  style=" color:#000;">
                         <thead>
                           <th>Categoría</th>
                           <th>Cantidad</th>
                           <th>Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Categoría</th>
                           <th>Cantidad</th>
                           <th>Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div> 

             <!-- N° de ventas por tipo y asesor -->  
            <div class="col-md-6" >
                  <div class="box box-info"  style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap;">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px; color:#fff;">- ENVÍOS SEGUN TIPO DE CURSO (Monto) -</h3>
                      <div class="box-tools pull-left">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <canvas id="enviosseguntipo" width="300" height="400"></canvas>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->              
            </div>
          </div>

        <div>
          <br>
        </div>

        <div class="row">
            <!-- Ventas por categorias -->  
            <div class="col-md-6" >
              <div class="box box-warning" style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap; ">
                   <div class="box-header">
                     <h3 class="box-title" style="font-size:17px; color:#fff"> - LISTA DE ENVÍOS POR COURIER (Cantidad y Monto) -</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="background: #fff;color:#fff">
                   <table id="listaenvioscourier"class="table table-striped table-bordered table-condensed table-hover" width="100%" height="300"  style=" color:#000;">
                         <thead>
                           <th>Courier</th>
                           <th>Cantidad</th>
                           <th >Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Courier</th>
                           <th>Cantidad</th>
                           <th >Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div> 

             <!-- Ventas por categorias -->  
          <div class="col-md-6" >
                <div class="box box-warning"  style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap; ">
                  <div class="box-header with-border">
                    <h3 class="box-title" style="font-size:17px; color:#fff;">- LISTA DE ENVÍOS POR COURIER (Monto) -</h3>
                    <div class="box-tools pull-left">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <canvas id="envioscourier" width="400" height="550"></canvas>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->              
          </div>
        </div><!-- -->


        <div>
          <br>
        </div>        


        <div class="row">
            <div class="col-md-12">               
               <!-- LISTA DE CURSOS CORTOS -->
              <div class="box box-success">
                   <div class="box-header with-border">
                     <h3 class="box-title" style="font-size:17px;">* LISTA DE CIUDADES DE ENVÍOS *</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div>
                 <div class="panel-body table-responsive" id="listadoregistros" style="color:#000">
                   <table id="tbllistaciudadesenvios" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                         <thead>
                           <th>Ciudad</th>
                           <th>Cantidad</th>
                           <th>Monto</th>
                         </thead>
                         <tbody>                            
                         </tbody>
                         <tfoot>
                           <th>Ciudad</th>
                           <th>Cantidad</th>
                           <th>Monto</th>
                         </tfoot>
                     </table>
                 </div>
              </div> 
            </div><!--/.box --> 
            
            
              <!-- Ventas por categorias -->  
            <div class="col-md-12" >
                  <div class="box box-warning"  style="background: #272c3b; color:#fff; flex-direction: row;flex-wrap: nowrap; ">
                    <div class="box-header with-border">
                      <h3 class="box-title" style="font-size:17px; color:#fff;">- LISTA DE ENVÍOS POR COURIER (Monto) -</h3>
                      <div class="box-tools pull-left">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <canvas id="cuidadesenvios" width="100%" height="650"></canvas>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->              
            </div>
          </div><!--/.box -->             
        
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
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

<script src="../public/js/Chart.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>

<script type="text/javascript">

  function Cargar(){
   
    Listanenviosseguntipo();
    Enviosseguntipo();
    Listaenvioscourier();
    Envioscourier();
    Listaciudadesenvios();
    Cuidadesenvios();

  }


//LISTA N VENTAS X ASESOR
function Listanenviosseguntipo(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listanenviosseguntipo').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listanenviosseguntipo',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    //"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
  
   //  GRAFICO - MONTO VENTAS X MES Y PERSONAL  ///
   function Enviosseguntipo(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=enviosseguntipo',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var nombre =[];
         var monto =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
          nombre.push(data[i][0]);
             monto.push(data[i][1]);           
          
           }
           CrearGraficoEnviosseguntipo(nombre,monto);          
      }
    })
   }

  function CrearGraficoEnviosseguntipo(nombre,monto){
    var ctx = document.getElementById("enviosseguntipo").getContext('2d');   
    var compras = new Chart(ctx, {
    type: 'bar',    
    data: {
        labels: nombre,
        datasets: [{
           label: ['S/. '],
            data: monto,
            backgroundColor: [
                'rgba(125, 170, 247, 0.3)',
                'rgba(240, 123, 114, 0.3)',
                'rgba(252, 208, 79, 0.3)',
                'rgba(125, 170, 247, 0.3)',
                'rgba(240, 123, 114, 0.3)',
                'rgba(252, 208, 79, 0.3)',
                'rgba(125, 170, 247, 0.3)',
                'rgba(240, 123, 114, 0.3)',
                'rgba(252, 208, 79, 0.3)',
                'rgba(125, 170, 247, 0.3)',
                'rgba(240, 123, 114, 0.3)',
                'rgba(252, 208, 79, 0.3)',
                'rgba(125, 170, 247, 0.3)',
                'rgba(240, 123, 114, 0.3)',
                'rgba(252, 208, 79, 0.3)'
            ],
            borderColor: [
                'rgba(125, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)',
                'rgba(125, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)',
                'rgba(125, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)',
                'rgba(125, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)',
                'rgba(125, 170, 247, 1)',
                'rgba(240, 123, 114, 1)',
                'rgba(252, 208, 79, 1)'
                             
            ],
            borderWidth: 2
        }
        ]
    },
    options: {
      maintainAspectRatio: false,
      legend: {
          display: false,          
        },
       scales: {
            yAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#fff'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: ' #afafaf '
                 }
             }]
         }
    }
  });
 }


//  GRAFICO - LISTA - ENVIOS COURIER
function Listaenvioscourier(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#listaenvioscourier').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listaenvioscourier',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	  "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function Envioscourier(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=envioscourier',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var nombre =[];
         var monto =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
            nombre.push(data[i][0]);
            monto.push(data[i][1]);           
          
           }
           CrearGraficoEnvioscourier(nombre,monto);          
      }
    })
   }

  function CrearGraficoEnvioscourier(nombre,monto){
    var ctx = document.getElementById("envioscourier").getContext('2d');   
    var compras = new Chart(ctx, {
      type: 'doughnut',
    data: {
        labels: nombre,
        datasets: [{
 
            data: monto,
            backgroundColor: [
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 226, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false,
       legend: {
        position: 'right',
      },   
  },  
});
}


 //Función Listar cursos cortos
 function Listaciudadesenvios(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	tabla=$('#tbllistaciudadesenvios').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listaciudadesenvios',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	   "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function Cuidadesenvios(){
     var fecha_inicio = $("#fecha_inicio").val();
     var fecha_fin = $("#fecha_fin").val();

     $.ajax({
       url:'../controladores/consultas.php?op=cuidadesenvios',
       type:'POST',
       data:{
         fecha_inicio : fecha_inicio,
         fecha_fin : fecha_fin
       }
     }).done(function(resp){
      if(resp.length > 0){
         var nombre =[];   
         var monto =[];        
         var data = JSON.parse(resp);
          //alert(data[0][1]);
         for(var i=0; i < data.length; i++){
          nombre.push(data[i][0]);
          monto.push(data[i][1]);                     
           }
           CrearGraficoCuidadesenvios(nombre,monto);          
      }
    })
   }

function CrearGraficoCuidadesenvios(nombre,monto){
  var ctx = document.getElementById("cuidadesenvios").getContext('2d'); 
    var compras = new Chart(ctx, {
      type: 'bar',
    data: {
        labels: nombre,
        datasets: [{
          label: ['S/. '],
            data: monto,
            backgroundColor: [
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 226, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 266, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 226, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 266, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 226, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 266, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 266, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)',
                'rgba(116, 72, 194, 0.2)',
                'rgba(33, 192, 215, 0.2)',
                'rgba(217, 158, 43, 0.2)',
                'rgba(205, 58, 129, 0.2)',
                'rgba(156, 153, 204, 0.2)',
                'rgba(225, 78, 202, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(25, 266, 80, 0.2)',
                'rgba(250, 260, 50, 0.2)',
                'rgba(0, 255, 204, 0.2)'
            ],
            borderColor: [
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)',
                'rgba(116, 72, 194, 1)',
                'rgba(33, 192, 215, 1)',
                'rgba(217, 158, 43, 1)',
                'rgba(205, 58, 129, 1)',
                'rgba(156, 153, 204, 1)',
                'rgba(225, 78, 202, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(25, 266, 80, 1)',
                'rgba(250, 260, 50, 1)',
                'rgba(0, 255, 204, 1)'
            ],
            borderWidth: 2,
        }]
    },
    options: {
      maintainAspectRatio: false,
      legend: {
          display: false,          
        },
       scales: {
            yAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {
                     display: true,
                     fontColor: '#fff'
                 }                
             }],
             xAxes: [{
                 gridLines: {
                     display: true,
                 },
                 ticks: {

                     display: true,
                     fontColor: '#afafaf',
                     fontSize: 10
                 }
             }]
         }
    }
});
}


</script>

<?php 
}
ob_end_flush();
?>