var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#myModal").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Cargamos los items al select tipodocumento
	$.post("../controladores/empleado.php?op=selectTipodocumento", function(r){
		$("#idtipo_documento").html(r);
		$('#idtipo_documento').selectpicker('refresh');
});

	//Cargamos los items al select pais
	$.post("../controladores/empleado.php?op=selectPais", function(r){
		$("#idpais").html(r);
		$('#idpais').selectpicker('refresh');
});

	$("#imagenmuestra").hide();
	$('#mAlmacen').addClass("treeview active");
    $('#lempleados').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#nombre1").val("");
	$("#num_documento").val("");
	$("#telefono").val("");
	$("#telefono2").val("");
	$("#email").val("");
	$("#cargo").val("");
	$("#departamento").val("");
	$("#ciudad").val("");
	$("#direccion").val("");
	$("#fecha_cumple").val("");
	$("#cargo").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idpersona").val("");

	
	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	//var ano = now.getFullYear()
    $('#fecha_hora').val(today);  
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
					url: '../controladores/empleado.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 8,//Paginación
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
		url: "../controladores/empleado.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Empleado',
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

function mostrar(idpersonal)
{
	$.post("../controladores/empleado.php?op=mostrar",{idpersonal : idpersonal}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre1").val(data.nombre);	
		$("#fecha_hora").val(data.fecha_hora);		
		$("#idpais").val(data.idpais);
		$("#idtipo_documento").val(data.idtipo_documento);
		$("#tipo_documento").val(data.tipo_documento);
		$("#tipo_documento").selectpicker('refresh');
		$("#num_documento").val(data.num_documento);
		$("#telefono").val(data.telefono);
		$("#telefono2").val(data.telefono2);
		$("#email").val(data.email);
		$("#pais").val(data.pais);
		$("#pais").selectpicker('refresh');
		$("#departamento").val(data.departamento);
		$("#ciudad").val(data.ciudad);
		$("#direccion").val(data.direccion);
		$("#fecha_cumple").val(data.fecha_cumple);
		$("#cargo1").val(data.cargo);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/personal/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#idpersonal").val(data.idpersonal);

 	})
}

//Función para desactivar registros
function desactivar(idpersonal)
{
	swal({
						    title: "¿Desactivar?",
						    text: "¿Está seguro que desea desactivar el empleado?",
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
									$.post("../controladores/empleado.php?op=desactivar", {idpersonal : idpersonal}, function(e){
										swal(
											'!!! Desactivado !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se cancelo la desactivacion del empleado", "error");
							 }
							});
}


//Función para activar registros
function activar(idpersonal)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar el empleado?",
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
						$.post("../controladores/empleado.php?op=activar", {idpersonal : idpersonal}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del empleado", "error");
			 }
			});
}


//Función para eliminar registros
function eliminar(idpersonal)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro que desea eliminar el personal?",
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
				$.post("../controladores/empleado.php?op=eliminar", {idpersonal : idpersonal}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se cancelo la eliminación del personal", "error");
		 }
		});
}
init();

