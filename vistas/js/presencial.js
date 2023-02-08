var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	limpiar();

	$("#myModal").on("submit",function(e)
	{
		guardaryeditar(e);	
	})	
}

//Función limpiar
function limpiar()
{
	$("#fecha").val("");
	$("#codigo").val("");
	$("#nombres").val("");
	$("#dni").val("");
	$("#celular").val("");
	$("#correo").val("");
	$("#cumpleaños").val("");
	$("#ciudad").val("");
	$("#departamento").val("");
	$("#curso").val("");
	$("#fecha_certificado").val("");
	$("#horas").val("");
	$("#codigo_curso").val("");
	$("#n_operacion").val("");
	$("#monto").val("");
	$("#forma_pago").val("");
	$("#asesor").val("");
	$("#observacion").val("");
	$("#idpresencial").val("");

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
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/presencial.php?op=listarc',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/presencial.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Matricula',
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


function mostrar(idpresencial)
{
	$.post("../controladores/presencial.php?op=mostrar",{idpresencial : idpresencial}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idpresencial").val(data.idpresencial);
		$("#fecha").val(data.fecha);
		$("#codigo").val(data.codigo);
		$("#nombres").val(data.nombres);
		$("#dni").val(data.dni);
		$("#celular").val(data.celular);
		$("#correo").val(data.correo);
		$("#cumpleaños").val(data.cumpleaños);
		$("#ciudad").val(data.ciudad);
		$("#departamento").val(data.departamento);
		$("#curso").val(data.curso);
		$("#fecha_certificado").val(data.fecha_certificado);
		$("#horas").val(data.horas);
		$("#codigo_curso").val(data.codigo_curso);
		$("#n_operacion").val(data.n_operacion);
		$("#monto").val(data.monto);
		$("#forma_pago").val(data.forma_pago);
		$("#asesor").val(data.asesor);

		$("#observacion").val(data.observacion); 			

 	})
}


//Función para desactivar registros
function desactivar(idpresencial)
{
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro que desea desactivar la matricula?",
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
				$.post("../controladores/presencial.php?op=desactivar", {idpresencial : idpresencial}, function(e){
				swal(
					'!!! Desactivado !!!',e,'success')
			tabla.ajax.reload();
		});
		}else {
			swal("! Cancelado ¡", "Se cancelo la desactivacion de la matricula", "error");
			}
		});
}

//Función para activar registros
function activar(idpresencial)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar la matricula?",
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
						$.post("../controladores/presencial.php?op=activar", {idpresencial : idpresencial}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se cancelo la activacion de la matricula", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(idpresencial)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro que desea eliminar la matricula?",
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
				$.post("../controladores/presencial.php?op=eliminar", {idpresencial : idpresencial}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se cancelo la eliminaciòn de la matricula", "error");
		 }
		});
}

init();