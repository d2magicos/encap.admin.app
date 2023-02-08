var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	limpiar();
	listarpermisos();

	$("#myModal").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Mostramos los permisos
	$.post("../controladores/usuario.php?op=permisos&id=",function(r){
	        $("#permisos").html(r);
	});

	//Cargamos los items al select categoria
	$.post("../controladores/usuario.php?op=selectEmpleado", function(r){
	            $("#idpersonal").html(r);
	            $('#idpersonal').selectpicker('refresh');

	});
}

//Función limpiar
function limpiar()
{
	$("#idpersonal").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#idusuario").val("");
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
	$.post("../controladores/usuario.php?op=permisos&id=",function(r){
	        $("#permisos").html(r);
	});
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
					url: '../controladores/usuario.php?op=listar',
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

//Función Listar
function listarpermisos()
{
	tabla=$('#tbllistadousuarios').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		        ],
		"ajax":
				{
					url: '../controladores/usuario.php?op=listarpermisos',
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
		url: "../controladores/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Usuario actualizado con éxito!',
				  type: 'success',
					//text:datos
				});
              $('#myModal').modal('hide');	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

//Función mostrar edicion
function mostrar(idusuario)
{
	$.post("../controladores/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idpersonal").val(data.idpersonal);
		$('#idpersonal').selectpicker('refresh');
		$("#login").val(data.login);
		$("#clave").val("");
		$("#idusuario").val(data.idusuario);

 	});

 	$.post("../controladores/usuario.php?op=permisos&id="+idusuario,function(r){
	        $("#permisos").html(r);
	});
}


//Función para desactivar registros
function desactivar(idusuario)
{
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro que desea desactivar el usuario?",
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
					$.post("../controladores/usuario.php?op=desactivar", {idusuario : idusuario}, function(e){
						swal(
							'!!! Desactivada !!!',e,'success')
					    tabla.ajax.reload();
				    });
				}else {
					swal("! Cancelado ¡", "Se cancelo la desactivación del usuario", "error");
						 }
		});
}

//Función para activar registros
function activar(idusuario)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro que desea activar el usuario?",
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
						$.post("../controladores/usuario.php?op=activar", {idusuario : idusuario}, function(e){
						swal("!!! Activada !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se cancelo la activación del usuario", "error");
			 }
			});
}

init();