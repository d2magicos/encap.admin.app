var tabla;

//Función que se ejecuta al inicio
function init(){ 
	listarp();
	listarcumpleaños();

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var hoy = (day)+"/"+(month);
    $('#fecha').val((hoy));  
}


//Función listar de cursos mas vendidos
function listarp()
{
	tabla=$('#tbllistado').dataTable(
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
					url: '../controladores/consultasinicio.php?op=productosmasvendidos',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 2, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

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
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/consultasinicio.php?op=listarcumpleaños',
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