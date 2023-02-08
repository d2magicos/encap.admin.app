 var tabla;
 
//Función que se ejecuta al inicio
function init(){
	mostrarform(true);
	listar();
	
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);		
	});
	
	//Cargamos los items al select pais
	$.post("../controladores/verlistadereclamos.php?op=selectAsunto", function(r){
		$("#idasunto").html(r);
		$("#idasunto").selectpicker('refresh');
	});	 

		//Obtenemos la fecha y hora actual
		var now = new Date();
		var hora = now.getHours() + ":"+ now.getMinutes() + ':' + now.getSeconds();
		$('#hora_reclamo').val(hora); 
}

//Función limpiar
function limpiar()
{
	$("#prioridad").selectpicker('refresh');
	$("#fecha").val("");

	$("#descripcion").val("");
	$('#idasunto').selectpicker('refresh');
	$('#idsubasunto').selectpicker('refresh');

		//Obtenemos la fecha y hora actual
		var now = new Date();
		var hora = now.getHours() + ":"+ now.getMinutes() + ':' + now.getSeconds();
		$('#hora_reclamo').val(hora); 
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
		//Obtenemos la fecha y hora actual
		var now = new Date();
		var hora = now.getHours() + ":"+ now.getMinutes() + ':' + now.getSeconds();
		$('#hora_reclamo').val(hora); 

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


//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/verlistadereclamos.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Reclamo Actualizado',
				  type: 'success',
					text:datos
				});	   
				$('#formulario').modal('hide');	          
				mostrarform(false);	
				listar();
				tabla.ajax.reload();		  	   
	    }

	});
	limpiar();
}

//muestra datos de la tabla y del detalle de la tabla
function mostrar(idmatricula)
{

	$("#formulario").modal('show');
	$.post("../controladores/verlistadereclamos.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		
		$("#idmatricula").val(data.idmatricula);
		$("#idpersonal").val(data.idpersonal);
		$("#nuevoVendedor").val(data.personal);

		$("#idreclamo").val(data.idreclamo);	

		$("#nombrem").val(data.participante);
		$("#fecha_horam").val(data.fecha_hora);
		$("#cod_matriculam").val(data.cod_matricula);
		$("#tipo_documento").val(data.tipo_documento);
		$("#num_documentom").val(data.num_documento);
		$("#telefonom").val(data.telefono);
		$("#telefono2m").val(data.telefono2);
		$("#emailm").val(data.email);
		$("#paism").val(data.pais);
		$("#departamentom").val(data.departamento);
		$("#ciudadm").val(data.ciudad);
		$("#direccionm").val(data.direccion);
		$("#fecha_cumplem").val(data.fecha_cumple);
	
		$("#idasunto").val(data.idasunto);
		$("#idasunto").selectpicker('refresh');
		$("#idsubasunto").val(data.idsubasunto);
		$("#idsubasunto").selectpicker('refresh');
			
		$("#estado").val(data.estado);
		$("#estado").selectpicker('refresh');
		$("#prioridad").val(data.prioridad);
		$("#fecha").val(data.fecha);
		$("#fechaatencion").val(data.fechaatencion);
		$("#descripcion").val(data.descripcion);
		$("#solucion").val(data.solucion);
		$("#observaciones").val(data.observaciones);
 	});
 	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/verlistadereclamos.php?op=listarDetalle&id="+idmatricula,function(r){
		$("#detallesm").html(r);
});
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar($idpersonal)
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
					url: '../controladores/verlistadereclamos.php?op=listar',
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

function listarArticulos(){
	tabla=$('#tblarticulos').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [

		],
		"ajax":
		{
			url:'../controladores/verlistadereclamos.php?op=listarArticulos',
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