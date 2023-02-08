var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#myModal").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    $('#mAlmacen').addClass("treeview active");
    $('#lCategorias').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idcourier").val("");
	$("#nombre1").val("");
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
					url: '../controladores/pais.php?op=listar',
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

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/pais.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'País',
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

function mostrar(idpais)
{
	$.post("../controladores/pais.php?op=mostrar",{idpais : idpais}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre1").val(data.nombre);
 		$("#idpais").val(data.idpais);

 	})
}

//Función para desactivar registros
function desactivar(idpais)
{
	swal({
						    title: "¿Desactivar?",
						    text: "¿Está seguro Que Desea Desactivar el País?",
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
									$.post("../controladores/pais.php?op=desactivar", {idpais : idpais}, function(e){
										swal(
											'!!! Desactivada !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo la desactivacion del País", "error");
							 }
							});
}

//Función para activar registros
function activar(idpais)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea Activar el País?",
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
						$.post("../controladores/pais.php?op=activar", {idpais : idpais}, function(e){
						swal("!!! Activada !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del País", "error");
			 }
			});
}


//Función para eliminar registros
function eliminar(idpais)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro Que Desea Eliminar el País?",
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
				$.post("../controladores/pais.php?op=eliminar", {idpais : idpais}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se Cancelo la eliminaciòn del País", "error");
		 }
		});
}
init();
