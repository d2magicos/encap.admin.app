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
	$("#idvtutorial").val("");
	$("#nombre").val("");
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
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [		        
		            
		        ],
		"ajax":
				{
					url: '../controladores/videotutorial.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 50,//Paginación
	    //"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/videotutorial.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: '',
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

function mostrar(idvtutorial)
{
	$.post("../controladores/videotutorial.php?op=mostrar",{idvtutorial : idvtutorial}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#descripcion").val(data.descripcion);
		$("#nombre").val(data.nombre);
 		$("#idvtutorial").val(data.idvtutorial);

 	})
}

//Función para desactivar registros
function desactivar(idvtutorial)
{
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro que desea desactivar el video tutorial?",
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
				$.post("../controladores/videotutorial.php?op=desactivar", {idvtutorial : idvtutorial}, function(e){
					swal(
						'!!! Desactivada !!!',e,'success')
					tabla.ajax.reload();
			});
				}else {
					swal("! Cancelado ¡", "Se Cancelo la desactivación del video tutorial", "error");
						}
		});
}

//Función para activar registros
function activar(idvtutorial)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar el video tutorial?",
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
						$.post("../controladores/videotutorial.php?op=activar", {idvtutorial : idvtutorial}, function(e){
						swal("!!! Activada !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activaciónn del video tutorial", "error");
			 }
			});
}


//Función para eliminar registros
function eliminar(idvtutorial)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Estás seguro de eliminar este video tutorial?",
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
				$.post("../controladores/videotutorial.php?op=eliminar", {idvtutorial : idvtutorial}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se cancelo la eliminación del video tutorial", "error");
		 }
		});
}



init();
