var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#myModal").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

		//Cargamos los items al select TipoDocumento
	$.post("../controladores/personacrear.php?op=selectTipodocumento", function(r){
		$("#idtipo_documento").html(r);
		$('#idtipo_documento').selectpicker('refresh');
});

	//Cargamos los items al select pais
	$.post("../controladores/personacrear.php?op=selectPais", function(r){
		$("#idpais").html(r);
		$('#idpais').selectpicker('refresh');
});

}

//Función limpiar
function limpiar()
{
	$("#nombre1").val("");
	$("#apellidos").val("");
	$("#num_documento").val("");
	$("#telefono").val("");
	$("#telefono2").val("");
	$("#email").val("");
	//$("#pais").val("");
	$("#departamento").val("");
	$("#ciudad").val("");
	$("#direccion").val("");
	$("#fecha_cumple").val("");
	$("#idpersona").val("");
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
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            
		        ],
		"ajax":
				{
					url: '../controladores/personacrear.php?op=listarp',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 200,//Paginación
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
		url: "../controladores/personacrear.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Participante',
				  type: 'success',
					text:datos
				});
              $('#myModal').modal('hide');	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idpersona)
{
	$.post("../controladores/personacrear.php?op=mostrar",{idpersona : idpersona}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre1").val(data.nombre);
		$("#idpais").val(data.idpais);
		$("#idtipo_documento").val(data.idtipo_documento);
		$("#idtipo_documento").selectpicker('refresh');
		$("#num_documento").val(data.documento);
		$("#telefono").val(data.telefono);
		$("#telefono2").val(data.telefono2);
		$("#email").val(data.email);
		$("#pais").val(data.pais);
		$("#idpais").selectpicker('refresh');
		$("#departamento").val(data.departamento);
		$("#ciudad").val(data.ciudad);
		$("#direccion").val(data.direccion);	
		$("#fecha_cumple").val(data.fecha_cumple);
 		$("#idpersona").val(data.idpersona);
 	})
}


//Función para desactivar registros
function desactivar(idpersona)
{
	swal({
						    title: "¿Desactivar?",
						    text: "¿Está seguro Que Desea Desactivar al Participante?",
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
									$.post("../controladores/personacrear.php?op=desactivar", {idpersona : idpersona}, function(e){
										swal(
											'!!! Desactivado !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo la desactivacion del Participante", "error");
							 }
							});
}

//Función para activar registros
function activar(idpersona)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea Activar al Participante?",
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
						$.post("../controladores/personacrear.php?op=activar", {idpersona : idpersona}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del Participante", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(idpersona)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro Que Desea Eliminar al Participante?",
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
				$.post("../controladores/personacrear.php?op=eliminar", {idpersona : idpersona}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se Cancelo la eliminaciòn del Participante", "error");
		 }
		});
}

init();
