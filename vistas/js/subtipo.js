var tabla;
var webservicefile = "subtipo.php";
var entityName = "Subtipo";

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#myModal").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	$.post("../controladores/"+ webservicefile +"?op=selectTipo", function(r) {
        $("#tipo").html(r);
        $('#tipo').selectpicker('refresh');

    });

    $('#mAlmacen').addClass("treeview active");
    $('#ltipos').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#id").val("");
	$("#nombre1").val("");
	$("#descripcion").val("");
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
					url: '../controladores/'+ webservicefile +'?op=listar',
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
		url: '../controladores/'+ webservicefile +'?op=guardaryeditar',
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: entityName,
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

function mostrar(id)
{
	$.post('../controladores/'+ webservicefile +'?op=mostrar',{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre1").val(data.nombre);
		$("#tipo").val(data.tipo_id);
        $("#tipo").selectpicker('refresh');
		$("#descripcion").val(data.descripcion);
 		$("#id").val(data.id);

 	})
}

//Función para desactivar registros
function desactivar(id)
{
	swal({
						    title: "¿Desactivar?",
						    text: "¿Está seguro que desea desactivar este registro?",
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
									$.post('../controladores/'+ webservicefile +'?op=desactivar', {id : id}, function(e){
										swal(
											'!!! Desactivada !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se cancelo la desactivacion ", "error");
							 }
							});
}

//Función para activar registros
function activar(id)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar este registro",
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
						$.post('../controladores/'+ webservicefile +'?op=activar', {id : id}, function(e){
						swal("!!! Activada !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se cancelo la activacion de la ", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(id)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro que desea eliminar este registro?",
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
				$.post('../controladores/'+ webservicefile +'?op=eliminar', {id : id}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se cancelo la eliminación", "error");
		 }
		});
}


init();