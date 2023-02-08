 var tabla;
 
//Función que se ejecuta al inicio
function init(){


	mostrarform(true);
	listar();
	$('#prioridad').selectpicker('refresh');

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	
		//Obtenemos la fecha y hora actual
		var now = new Date();
		var hora = now.getHours() + ":"+ now.getMinutes() + ':' + now.getSeconds();
		$('#hora_reclamo').val(hora); 

}

//Función limpiar
function limpiar()
{
	
	$('#descripcion').val("");
	$('#observaciones').val("");
	$('#prioridad').selectpicker('refresh');
	$('#prioridad').val("");
	$('#fecha').val("");
		//Obtenemos la fecha y hora actual
		var now = new Date();
		var hora = now.getHours() + ":"+ now.getMinutes() + ':' + now.getSeconds();
		$('#hora_reclamo').val(hora); 
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").show();
		$("#formularioregistros").show();
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").show();
		$("#btnCancelar").show();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").hide();
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
		        ],
		"ajax":
				{
					url: '../controladores/gestionreclamos.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/gestionreclamos.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Reclamo Registrada',
				  type: 'success',
					text:datos
				});	          
				$('#formulario').modal('hide');	          
				mostrarform(false);
				tabla.ajax.reload();
	    }

	});
	limpiar();
	listar();
}

//muestra datos de la tabla y del detalle de la tabla
function mostrar(idmatricula)
{
	$("#formulario").modal('show');
	$.post("../controladores/gestionreclamos.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idmatricula").val(data.idmatricula);
		//$("#idpersonal").val(data.idpersonal);
		$("#nombrepersonal").val(data.personal);

		$("#idparticipante").val(data.idparticipante);
		$("#nombrem").val(data.participante);
		$("#fecha_horam").val(data.fecha);
		$("#cod_matriculam").val(data.cod_matricula);
		$("#num_documentom").val(data.num_documento);
		$("#tipo_documentom").val(data.tipo_documento);
		$("#telefonom").val(data.telefono);
		$("#telefono2m").val(data.telefono2);
		$("#emailm").val(data.email);
		$("#paism").val(data.pais);
		$("#departamentom").val(data.departamento);
		$("#ciudadm").val(data.ciudad);
		$("#direccionm").val(data.direccion);
		$("#fecha_cumplem").val(data.fecha_cumple);
	
		$("#idcurso1").val(data.idcurso);
		$("#fecha_inicio2").val(data.fecha_inicio);

		//$("#fecha").val(data.fecha);
		$("#descripcion").val(data.descripcion);
		$("#observaciones").val(data.observaciones);
		$("#prioridad").val(data.prioridad);
		$("#prioridad").selectpicker('refresh');
		$("#idasunto").val(data.idasunto);
		$("#idasunto").selectpicker('refresh');

 	});
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/gestionreclamos.php?op=listarDetalle&id="+idmatricula,function(r){
	        $("#detallesm").html(r);
	});
}


function listarArticulos(){
	tabla=$('#tblarticulos').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [

		],
		"ajax":
		{
			url:'../controladores/gestionreclamos.php?op=listarArticulos',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}


init();

