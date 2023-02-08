var tabla;

//Función que se ejecuta al inicio
function init(){ 
	listarventasultimos15dias();
	listarventas();
	listadoventasformatosmonto();
	listadoventasformatoscantidad();

	listadomediospagos();
	listadoestadoventas();
 
}


//Función listar monto total por mes
function listarventasultimos15dias()
{
	tabla=$('#tbllistadoventas15dias').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listarventasultimos15dias',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 7,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función listar monto total por mes
function listarventas()
{
	tabla=$('#tbllistadoventas').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listaventatotalencap',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 6,//Paginación
	    //"order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función listar ventas por formato monto
function listadoventasformatosmonto()
{
	tabla=$('#tbllistadoventasformatosmonto').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadoventasformatosmonto',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 8,//Paginación
	    //"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función listar ventas por formato cantidad
function listadoventasformatoscantidad()
{
	tabla=$('#tbllistadoventasformatoscantidad').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadoventasformatoscantidad',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 8,//Paginación
	    "order": [[0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función listar medios de  trafico
function listadomediospagos()
{
	tabla=$('#tbllistadomediospagos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadomediospagos',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 12,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función listar estado de ventas
function listadoestadoventas()
{
	tabla=$('#tbllistadoestadoventas').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/consultas.php?op=listadoestadoventas',
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
