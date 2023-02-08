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

	//Cargamos los items al select categoria
	$.post("../controladores/consultaenvio.php?op=selectCourier", function(r){
		$("#idcourier").html(r);
		$('#idcourier').selectpicker('refresh');
	});

}

//Función limpiar
function limpiar()
{
	$("#ciudad").val("");
	$("#provincia").val("");
	$("#departamento").val("");
	$("#idcourier").val("");
	$("#montoa").val("");
	$("#adicional").val("");
	$("#direccion").val("");
	$("#idciudad").val("");
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
		"scrollY":"800px",//tamaño del scroll
		"scrollCollapse":true,//barra lateral Y
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            
		        ],
		"ajax":
				{
					url: '../controladores/consultaenvio.php?op=listarc',
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
		url: "../controladores/consultaenvio.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Ciudades Principales',
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

function mostrar(idciudad)
{
	$.post("../controladores/consultaenvio.php?op=mostrar",{idciudad : idciudad}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idciudad").val(data.idciudad);
		$("#ciudad").val(data.ciudad);
		$("#provincia").val(data.provincia);
		$("#departamento").val(data.departamento);
		$("#idcourier").val(data.idcourier);
		$("#idcourier").selectpicker('refresh');
		$("#montoa").val(data.montoa);
		$("#adicional").val(data.adicional);
		$("#direccion").val(data.direccion); 			
 	})
}


//Función para desactivar registros
function desactivar(idciudad)
{
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro que desea desactivar esta ciudad?",
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
				$.post("../controladores/consultaenvio.php?op=desactivar", {idciudad : idciudad}, function(e){
				swal(
					'!!! Desactivado !!!',e,'success')
			tabla.ajax.reload();
		});
		}else {
			swal("! Cancelado ¡", "Se cancelo la desactivacion de la ciudad", "error");
			}
		});
}

//Función para activar registros
function activar(idciudad)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar la ciudad?",
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
						$.post("../controladores/consultaenvio.php?op=activar", {idciudad : idciudad}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se cancelo la activacion de la ciudad", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(idciudad)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro que desea eliminar la ciudad?",
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
				$.post("../controladores/consultaenvio.php?op=eliminar", {idciudad : idciudad}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se cancelo la eliminaciòn de la ciudad", "error");
		 }
		});
}

init();