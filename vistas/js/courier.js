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
					url: '../controladores/courier.php?op=listar',
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
		url: "../controladores/courier.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Categoria',
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

function mostrar(idcourier)
{
	$.post("../controladores/courier.php?op=mostrar",{idcourier : idcourier}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre1").val(data.nombre);
 		$("#idcourier").val(data.idcourier);

 	})
}

//Función para desactivar registros
function desactivar(idcourier)
{
	swal({
						    title: "¿Desactivar?",
						    text: "¿Está seguro que desea desactivar la empresa courier?",
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
									$.post("../controladores/courier.php?op=desactivar", {idcourier : idcourier}, function(e){
										swal(
											'!!! Desactivada !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo la desactivacion de la empresa courier", "error");
							 }
							});
}

//Función para activar registros
function activar(idcourier)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar la empresa courier?",
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
						$.post("../controladores/courier.php?op=activar", {idcourier : idcourier}, function(e){
						swal("!!! Activada !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion de la empresa courier", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(idcourier)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro que desea eliminar la empresa courier?",
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
				$.post("../controladores/courier.php?op=eliminar", {idcourier : idcourier}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se Cancelo la eliminación la empresa courier", "error");
		 }
		});
}


init();