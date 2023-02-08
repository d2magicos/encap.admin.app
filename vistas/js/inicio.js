var tabla;


//Función que se ejecuta al inicio
function init(){ 
// seccion general
	listarcumpleaños();
	listadpendienteenviodigitalgeneral();
	listapendienteenviosfisicosgeneral();
	listareclamospendientesgeneral();
	listasatisfaccionclientegeneral();

// seccion matriculas
    listadpendienteenviodigitalpersonal();
	listapendienteenviosfisicospersonal();
	listareclamospendientespersonal();
	listasatisfaccionclientepersonal();
	listarcumpleañospersonal();

//seccion envios
	listapendienteenviosgeneral();
}


// ---------------------------   VISTA INICIO ADMINISTRATIVO --------------------------- ///

 /// funcion Lista de matriculas pendiente digital 
 function listadpendienteenviodigitalgeneral()
 {
	 tabla=$('#tbllistadpendienteenviodigitalgeneral').dataTable(
	 {
		 "aProcessing": true,//Activamos el procesamiento del datatables
		 "aServerSide": true,//Paginación y filtrado realizados por el servidor
		 dom: 'Bfrtip',//Definimos los elementos del control de tabla
		 buttons: [
					
				 ],
		 "ajax":
				 {
					 url: '../controladores/consultas.php?op=listadpendienteenviodigitalgeneral',
					 type : "get",
					 dataType : "json",						
					 error: function(e){
						 console.log(e.responseText);	
					 }
				 },
		 "bDestroy": true,
		 "iDisplayLength": 10,//Paginación
		 "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	 }).DataTable();
 }

 
/// funcion Lista de matriculas pendiente envios fisicos   tblreclamospendientespersonal
function listapendienteenviosfisicosgeneral()
{

	tabla=$('#tbllistapendienteenviosfisicosgeneral').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		           
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listapendienteenviosfisicosgeneral',

					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

/// funcion Lista de matriculas pendiente envios fisicos   
 function listareclamospendientesgeneral()
 {

	 tabla=$('#tbllistareclamospendientesgeneral').dataTable(
	 {
		 "aProcessing": true,//Activamos el procesamiento del datatables
		 "aServerSide": true,//Paginación y filtrado realizados por el servidor
		 dom: 'Bfrtip',//Definimos los elementos del control de tabla
		 buttons: [
					
				 ],
		 "ajax":
				 {
					 url: '../controladores/consultas.php?op=listareclamospendientesgeneral',
		
					 type : "get",
					 dataType : "json",						
					 error: function(e){
						 console.log(e.responseText);	
					 }
				 },
		 "bDestroy": true,
		 "iDisplayLength": 10,//Paginación
		 "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	 }).DataTable();
 }
 
/// funcion Lista de satisfaccion del cliente
  function listasatisfaccionclientegeneral()
  {

	  tabla=$('#tbllistasatisfaccionclientegeneral').dataTable(
	  {
		  "aProcessing": true,//Activamos el procesamiento del datatables
		  "aServerSide": true,//Paginación y filtrado realizados por el servidor
		  dom: 'Bfrtip',//Definimos los elementos del control de tabla
		  buttons: [
					 
				  ],
		  "ajax":
				  {
					  url: '../controladores/consultas.php?op=listasatisfaccionclientegeneral',
					  type : "get",
					  dataType : "json",						
					  error: function(e){
						  console.log(e.responseText);	
					  }
				  },
		  "bDestroy": true,
		  "iDisplayLength": 10,//Paginación
		  "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	  }).DataTable();
  }

/// lista cumpleaños genral
function listarcumpleaños()
{
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var hoy = (day)+"/"+(month);
	$('#fecha').val((hoy)); 

	var fecha = $("#fecha").val();

	tabla=$('#tbllistadocumpleaños').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
		"aServerSide": true,//Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [
					'excelHtml5'
				],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listarcumpleaños',
					data:{fecha: fecha},
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


// ---------------------------   VISTA INICIO MATRICULAS --------------------------- ///

 /// funcion Lista de matriculas pendiente digital 
 function listadpendienteenviodigitalpersonal()
 {
	 var idpersonal = $("#idpersonal").val();
	 tabla=$('#tbllistadpendienteenviodigitalpersonal').dataTable(
	 {
		 "aProcessing": true,//Activamos el procesamiento del datatables
		 "aServerSide": true,//Paginación y filtrado realizados por el servidor
		 dom: 'Bfrtip',//Definimos los elementos del control de tabla
		 buttons: [
					
				 ],
		 "ajax":
				 {
					 url: '../controladores/consultas.php?op=listadpendienteenviodigitalpersonal',
					 data:{idpersonal: idpersonal},
					 type : "get",
					 dataType : "json",						
					 error: function(e){
						 console.log(e.responseText);	
					 }
				 },
		 "bDestroy": true,
		 "iDisplayLength": 10,//Paginación
		 "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	 }).DataTable();
 }

/// funcion Lista de matriculas pendiente envios fisicos   tblreclamospendientespersonal
function listapendienteenviosfisicospersonal()
{
	var idpersonal = $("#idpersonal").val();
	tabla=$('#tbllistapendienteenviosfisicospersonal').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		           
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listapendienteenviosfisicospersonal',
					data:{idpersonal: idpersonal},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

/// funcion Lista de matriculas pendiente envios fisicos   
 function listareclamospendientespersonal()
 {
	 var idpersonal = $("#idpersonal").val();
	 tabla=$('#tbllistareclamospendientespersonal').dataTable(
	 {
		 "aProcessing": true,//Activamos el procesamiento del datatables
		 "aServerSide": true,//Paginación y filtrado realizados por el servidor
		 dom: 'Bfrtip',//Definimos los elementos del control de tabla
		 buttons: [
					
				 ],
		 "ajax":
				 {
					 url: '../controladores/consultas.php?op=listareclamospendientespersonal',
					 data:{idpersonal: idpersonal},
					 type : "get",
					 dataType : "json",						
					 error: function(e){
						 console.log(e.responseText);	
					 }
				 },
		 "bDestroy": true,
		 "iDisplayLength": 10,//Paginación
		 "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	 }).DataTable();
 }
 
/// funcion Lista de satisfaccion del cliente
  function listasatisfaccionclientepersonal()
  {
	  var idpersonal = $("#idpersonal").val();
	  tabla=$('#tbllistasatisfaccionclientepersonal').dataTable(
	  {
		  "aProcessing": true,//Activamos el procesamiento del datatables
		  "aServerSide": true,//Paginación y filtrado realizados por el servidor
		  dom: 'Bfrtip',//Definimos los elementos del control de tabla
		  buttons: [
					 
				  ],
		  "ajax":
				  {
					  url: '../controladores/consultas.php?op=listasatisfaccionclientepersonal',
					  data:{idpersonal: idpersonal},
					  type : "get",
					  dataType : "json",						
					  error: function(e){
						  console.log(e.responseText);	
					  }
				  },
		  "bDestroy": true,
		  "iDisplayLength": 10,//Paginación
		  "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	  }).DataTable();
  }
  
/// lista cumpleaños por asesor
function listarcumpleañospersonal()
{
	var idpersonal = $("#idpersonal").val();
	
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var hoy = (day)+"/"+(month);
	$('#fecha').val((hoy)); 

	var fecha = $("#fecha").val();

	tabla=$('#tbllistadocumpleañospersonal').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
		"aServerSide": true,//Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [
					'excelHtml5'
				],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadocumpleañospersonal',
					data:{fecha: fecha , idpersonal: idpersonal},
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



// ---------------------------   VISTA INICIO ENVIO --------------------------- ///
/// FUNCION LISTAR GENERAL ENVIOS PENDIENTES 
function listapendienteenviosgeneral()
{
	//var idpersonal = $("#idpersonal").val();
	tabla=$('#tbllistapendienteenviosgeneral').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		           
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listapendienteenviosgeneral',
					//data:{idpersonal: idpersonal},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

/// lista cumpleaños genral
function listarcumpleaños()
{
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var hoy = (day)+"/"+(month);
	$('#fecha').val((hoy)); 

	var fecha = $("#fecha").val();

	tabla=$('#tbllistadocumpleaños').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
		"aServerSide": true,//Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [
					'excelHtml5'
				],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listarcumpleaños',
					data:{fecha: fecha},
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

 

init();