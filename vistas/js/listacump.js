var tabla;

//Función que se ejecuta al inicio
function init(){ 
	listarcumpleañospersonal();
}


// ---------------------------   VISTA INICIO MATRICULAS --------------------------- ///
  
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
 

init();