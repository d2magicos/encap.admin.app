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
	$.post("../controladores/subasunto.php?op=selectAsunto", function(r){
		$("#idasunto").html(r);
		$('#idasunto').selectpicker('refresh');
	});
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#idasunto").val("");
	$("#idsubasunto").val("");
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
					url: '../controladores/subasunto.php?op=listarc',
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
		url: "../controladores/subasunto.php?op=guardaryeditar",
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
}


function mostrar(idsubasunto)
{
	$.post("../controladores/subasunto.php?op=mostrar",{idsubasunto : idsubasunto}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idsubasunto").val(data.idsubasunto);
		$("#nombre").val(data.nombre);
		$("#idasunto").val(data.idasunto);
		$("#idasunto").selectpicker('refresh');			

 	})
}


//Función para desactivar registros
function desactivar(idsubasunto)
{
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro que desea desactivar la sub categoria?",
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
				$.post("../controladores/subasunto.php?op=desactivar", {idsubasunto : idsubasunto}, function(e){
				swal(
					'!!! Desactivado !!!',e,'success')
			tabla.ajax.reload();
		});
		}else {
			swal("! Cancelado ¡", "Se Cancelo la desactivacion de la sub categoria", "error");
			}
		});
}

//Función para activar registros
function activar(idsubasunto)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar la sub categoria?",
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
						$.post("../controladores/subasunto.php?op=activar", {idsubasunto : idsubasunto}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion de la sub categoria", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(idsubasunto)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro que desea eliminar la sub categoria?",
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
				$.post("../controladores/subasunto.php?op=eliminar", {idsubasunto : idsubasunto}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se Cancelo la eliminaciòn de la sub categoria", "error");
		 }
		});
}

init();