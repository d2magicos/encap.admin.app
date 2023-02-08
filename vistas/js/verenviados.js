 var tabla;
 
//Función que se ejecuta al inicio
function init(){
	mostrarform(true);
	listar();
	limpiar();
	
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);		
	});
	
	//Cargamos los items al select participante
	 $.post("../controladores/verenviados.php?op=selectCourier", function(r){
	             $("#idcourier").html(r);
	             $('#idcourier').selectpicker('refresh');
	 });

	 $('#mCompras').addClass("treeview active");
	 $('#lIngresos').addClass("active");	 
}

//Función limpiar
function limpiar()
{

	$("#monto").val("");
	$("#clave").val("");
	$("#fechaenvio").val("");
	$("#fecha_info").val("");
	$("#factura_envio").val("");
	$("#lugarenvio").val("");

	$("#observaciones").val("");
	$('#impresion').selectpicker('refresh');

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").show();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").show();
		$("#btnCancelar").show();

	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").hide();
	}
}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/verenviados.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Envio Registrado',
				  type: 'success',
					text:datos
				});	   
				$('#formulario').modal('hide');	          
				mostrarform(false);	
				listar();
				tabla.ajax.reload();		  	   
	    }

	});
	limpiar();
}

//muestra datos de la tabla y del detalle de la tabla
function mostrar(idmatricula)
{
	$("#formulario").modal('show');
	$.post("../controladores/verenviados.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		
		$("#idmatricula").val(data.idmatricula);	

		$("#nombrem").val(data.participante);
		$("#fecha_horam").val(data.fecha_hora);
		$("#cod_matriculam").val(data.cod_matricula);
		$("#tipo_documento").val(data.tipo_documento);

		$("#num_documentom").val(data.num_documento);
		$("#telefonom").val(data.telefono);
		$("#telefono2m").val(data.telefono2);
		$("#emailm").val(data.email);
		$("#paism").val(data.pais);
		$("#departamentom").val(data.departamento);
		$("#ciudadm").val(data.ciudad);
		$("#direccionm").val(data.direccion);
		$("#fecha_cumplem").val(data.fecha_cumple);
	
		$("#lugarenvio").val(data.lugar_confirmacion);
 	});
 	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/verenviados.php?op=listarDetalle&id="+idmatricula,function(r){
		$("#detallesm").html(r);
});
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
		"scrollY":"800px",//tamaño del scroll
		"scrollCollapse":true,//barra lateral Y
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/verenviados.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function listarArticulos(){
	tabla=$('#tblarticulos').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
		],
		"ajax":
		{
			url:'../controladores/verenviados.php?op=listarArticulos',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}

//Función para eliminar registros
function eliminar(idenvio)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro Que Desea Eliminar el Envio?",
	    type: "warning",
	    showCancelButton: true,
			cancelButtonText: "No",
			cancelButtonColor: '#FF0000',
	    confirmButtonText: "Si",
	    confirmButtonColor: "#0004FA",
	    closeOnConfirm: false,
	    closeOnCancel: false,
	    showLoaderOnConfirm: true
	    },function(isConfirm){
	    if (isConfirm){
				$.post("../controladores/verenviados.php?op=eliminar", {idenvio : idenvio}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se Cancelo la eliminaciòn el Envio", "error");
		 }
		});
}

init();