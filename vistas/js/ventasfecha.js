var tabla;

//Función que se ejecuta al inicio
function init(){ 
	listar();

	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar);
	$('#mConsultaC').addClass("treeview active");
    $('#lConsulasC').addClass("active");

		// //Cargamos los items al select cliente
	$.post("../controladores/compra.php?op=selectPersonal", function(r){
	        $("#idpersonal").html(r);
	        $('#idpersonal').selectpicker('refresh');
	});
}

//Función Listar
function listar()
{
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
	var idpersonal = $("#idpersonal").val();

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
					url: '../controladores/consultas.php?op=ventasfecha',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin,idpersonal:idpersonal},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();

}

init();