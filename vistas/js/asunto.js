var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#myModal").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
}

//Función limpiar
function limpiar()
{
	$("#idasunto").val("");
	$("#nombre1").val("");
	$("#observaciones").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").show();
		$('#myModal').modal('show');
	}
	else
	{
		$("#listadoregistros").show();
		$("#btnagregar").show();
	}
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
		//"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [		        
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/asunto.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 50,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/asunto.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Asunto de reclamo',
				  type: 'success',
					text:datos
				});
              $('#myModal').modal('hide');
              	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
	//location.reload();
}

function mostrar(idasunto)
{
	$.post("../controladores/asunto.php?op=mostrar",{idasunto : idasunto}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#observaciones").val(data.observaciones);
		$("#nombre1").val(data.nombre);
 		$("#idasunto").val(data.idasunto);

 	})
}

//Función para desactivar registros
function desactivar(idasunto)
{
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro Que Desea Desactivar el Asunto de Reclamo?",
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
					$.post("../controladores/asunto.php?op=desactivar", {idasunto : idasunto}, function(e){
							swal(
								'!!! Desactivada !!!',e,'success')
					            tabla.ajax.reload();
				});
				}else {
					swal("! Cancelado ¡", "Se Cancelo la desactivacion del Asunto de Reclamo", "error");
				}
		});
}

//Función para activar registros
function activar(idasunto)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea Activar el Asunto de Reclamo?",
		    type: "warning",
		    showCancelButton: true,
				confirmButtonColor: '#0004FA',
				confirmButtonText: "Si",
		    cancelButtonText: "No",
				cancelButtonColor: '#FF0000',
		    closeOnConfirm: false,
		    closeOnCancel: false,
		    showLoaderOnConfirm: true
		    },function(isConfirm){
		    if (isConfirm){
						$.post("../controladores/asunto.php?op=activar", {idasunto : idasunto}, function(e){
						swal("!!! Activada !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del Asunto de Reclamo", "error");
			 }
			});
}


//Función para eliminar registros
function eliminar(idasunto)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro Que Desea Eliminar el Asunto de Reclamo?",
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
				$.post("../controladores/asunto.php?op=eliminar", {idasunto : idasunto}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se Cancelo la eliminaciòn del Asunto de Reclamo", "error");
		 }
		});
}

init();