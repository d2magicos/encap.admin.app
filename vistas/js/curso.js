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
	$.post("../controladores/curso.php?op=selectCategoria", function(r){
		$("#idcategoria").html(r);
		$('#idcategoria').selectpicker('refresh');

});

// //Cargamos los items al select participante
  $.post("../controladores/curso.php?op=id", function($id){
  	//$("#id").html(r);
  	$('#id').val($id);				

  });
	
}

//Función limpiar
function limpiar()
{
	$("#cod_curso").val("");
	$("#nombre1").val("");
	$("#docente").val("");
	$("#temario1").val("");
	$("#contexto").val("");
	$("#n_horas").val("");
	$("#fecha_inicio").val("");
	$("#observaciones").val("");
	$("#idcurso").val("");
	$("#enlace").val("");
	$("#id").val("");

	$.post("../controladores/curso.php?op=id", function($id){
		//$("#id").html(r);
		$('#id').val($id);				
  
	});
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
		//"scrollY":"800px",//tamaño del scroll
		"scrollCollapse":true,//barra lateral Y
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/curso.php?op=listarc',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación 10
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/curso.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Cursos',
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


function mostrar(idcurso)
{
	$.post("../controladores/curso.php?op=mostrar",{idcurso : idcurso}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcurso").val(data.idcurso);
		$("#cod_curso").val(data.cod_curso);
		$("#nombre1").val(data.nombre);
		$("#idcategoria").val(data.idcategoria);
		$("#idcategoria").selectpicker('refresh');
		$("#n_horas").val(data.n_horas);
		$("#fecha_inicio").val(data.fecha_inicio);
		$("#docente").val(data.docente);
		$("#temario1").val(data.temario);
		$("#contexto").val(data.contexto);
		$("#observaciones").val(data.observaciones); 			
		$("#enlace").val(data.enlace);
		$("#aula").val(data.aula);
 	})
}


//Función para desactivar registros
function desactivar(idcurso)
{
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro Que Desea Desactivar el Curso?",
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
				$.post("../controladores/curso.php?op=desactivar", {idcurso : idcurso}, function(e){
				swal(
					'!!! Desactivado !!!',e,'success')
			tabla.ajax.reload();
		});
		}else {
			swal("! Cancelado ¡", "Se Cancelo la desactivacion del Producto", "error");
			}
		});
}

//Función para activar registros
function activar(idcurso)
{
	swal({
		    title: "¿Activar?",
		    text: "¿Está seguro Que desea Activar el Curso?",
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
						$.post("../controladores/curso.php?op=activar", {idcurso : idcurso}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del Producto", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(idcurso)
{
	swal({
	    title: "Eliminar?",
	    text: "¿Está seguro Que Desea Eliminar el Curso?",
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
				$.post("../controladores/curso.php?op=eliminar", {idcurso : idcurso}, function(e){
					swal(
						'!!! Eliminado !!!',e,'success')
            tabla.ajax.reload();
    	});
	    }else {
	    swal("! Cancelado ¡", "Se Cancelo la eliminaciòn del Curso", "error");
		 }
		});
}

init();