var tabla;
 
//Función que se ejecuta al inicio
function init(){
	mostrarform(true);
	listar();

	$('#impresion').selectpicker('refresh');

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
		limpiar();
		mostrarform(false);
	});	


	$("#formulario2").on("submit",function(e)
	{
		guardaryeditar2(e);	
		limpiar();
		mostrarform(false);
	});	

	 $('#mCompras').addClass("treeview active");
	 $('#lIngresos').addClass("active");
}

//Función limpiar
function limpiar()
{
	
	$("#lugar_confirmacion").val("");
	$("#observaciones_envio").val("");
	$('#impresion').selectpicker('refresh');
	$('#impresion').val("");
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
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/gestionenvios.php?op=listar',
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
		url: "../controladores/gestionenvios.php?op=updatecontacto",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Envio Registrada',
				  type: 'success',
					text:datos
				});	          
				$('#formulario').modal('hide');	          
				mostrarform(false);
				tabla.ajax.reload();
				limpiar();
	    }

	});
	limpiar();
	listar();
}

function guardaryeditar2(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario2")[0]);

	$.ajax({
		url: "../controladores/gestionenvios.php?op=guardaryeditar2",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Envio Registrada',
				  type: 'success',
					text:datos
				});	          
				$('#formulario2').modal('hide');	          
				mostrarform(false);
				tabla.ajax.reload();
				limpiar();
	    }

	});
	limpiar();
	listar();
}

function confirmarenvio(idmatricula)
{
	
	$("#formulario2").modal('show');
	$.post("../controladores/gestionenvios.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#nombrepersonal").val(data.nombrepersonal);	
		$("#idpersonal").val(data.idpersonal);
		$("#idmatricula").val(data.idmatricula);
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

		$("#qr").val(data.qr);
		$("#idpersonal").val(data.idpersonal);

		$("#montom").val(data.monto);
		$("#formatom").val(data.formato);
		$("#accesoaula").val(data.accesoaula);
		$("#accesoaula").selectpicker('refresh');
		$("#formatom").selectpicker('refresh');
		$("#prioridadm").val(data.prioridad);
		$("#mediodepagom").val(data.mediopago);
		$("#idmediospagosm").val(data.idmediospagos);
		$("#idmediospagosm").selectpicker('refresh');
		$("#formarecaudacionm").val(data.formarecaudacion);
		$("#idforma_recaudacionm").val(data.idforma_recaudacion);
		$("#idforma_recaudacionm").selectpicker('refresh');
		$("#noperacionm").val(data.noperacion);
		$("#observacionesm").val(data.observaciones);
		$("#enviodigital").val(data.enviodigital);

		$("#observaciones_envio").val(data.observaciones_envio);
		$("#lugar_confirmacion").val(data.lugar_confirmacion);

 	});


	
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/gestionenvios.php?op=listarDetalle&id="+idmatricula,function(r){
	        $("#detallesm").html(r);
	});
	
}

//muestra datos de la tabla y del detalle de la tabla
function mostrar(idmatricula)
{
	$("#formulario").modal('show');
	$.post("../controladores/gestionenvios.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#nombrepersonal").val(data.nombrepersonal);	
		$("#idpersonal").val(data.idpersonal);
		$("#idmatricula").val(data.idmatricula);
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

		$("#qr").val(data.qr);
		$("#idpersonal").val(data.idpersonal);

		$("#montom").val(data.monto);
		$("#formatom").val(data.formato);
		$("#accesoaula").val(data.accesoaula);
		$("#accesoaula").selectpicker('refresh');
		$("#formatom").selectpicker('refresh');
		$("#prioridadm").val(data.prioridad);
		$("#mediodepagom").val(data.mediopago);
		$("#idmediospagosm").val(data.idmediospagos);
		$("#idmediospagosm").selectpicker('refresh');
		$("#formarecaudacionm").val(data.formarecaudacion);
		$("#idforma_recaudacionm").val(data.idforma_recaudacion);
		$("#idforma_recaudacionm").selectpicker('refresh');
		$("#noperacionm").val(data.noperacion);
		$("#observacionesm").val(data.observaciones);
		$("#enviodigital").val(data.enviodigital);

		$("#observaciones_contacto").val(data.observaciones_contacto);
		$("#contacto_confirmacion").val(data.cliente_contactado);

		console.log(data);

 	});
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/gestionenvios.php?op=listarDetalle&id="+idmatricula,function(r){
	        $("#detallesm").html(r);
	});
}


function mostrarFalso(idmatricula)
{
	$("#formulario2").modal('show');
	$.post("../controladores/gestionenvios.php?op=mostrarfalso",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#nombrepersonal2").val(data.nombrepersonal);	
		$("#idpersonal2").val(data.idpersonal);
		$("#idmatricula2").val(data.idmatricula);
		$("#idparticipante2").val(data.idparticipante);
		$("#nombrem2").val(data.participante);
		$("#fecha_horam2").val(data.fecha);
		$("#cod_matriculam2").val(data.cod_matricula);
		$("#num_documentom2").val(data.num_documento);
		$("#tipo_documentom2").val(data.tipo_documento);
		$("#telefonom2").val(data.telefono);
		$("#telefono2m2").val(data.telefono2);
		$("#emailm2").val(data.email);
		$("#paism2").val(data.pais);
		$("#departamentom2").val(data.departamento);
		$("#ciudadm2").val(data.ciudad);
		$("#direccionm2").val(data.direccion);
		$("#fecha_cumplem2").val(data.fecha_cumple);
	
		$("#idcurso12").val(data.idcurso);
		$("#fecha_inicio2").val(data.fecha_inicio);

		$("#qr2").val(data.qr);
		$("#idpersonal2").val(data.idpersonal);

		$("#montom2").val(data.monto);
		$("#formatom2").val(data.formato);
		$("#accesoaula2").val(data.accesoaula);
		$("#accesoaula2").selectpicker('refresh');
		$("#formatom2").selectpicker('refresh');
		$("#prioridadm2").val(data.prioridad);
		$("#mediodepagom2").val(data.mediopago);
		$("#idmediospagosm2").val(data.idmediospagos);
		$("#idmediospagosm2").selectpicker('refresh');
		$("#formarecaudacionm2").val(data.formarecaudacion);
		$("#idforma_recaudacionm2").val(data.idforma_recaudacion);
		$("#idforma_recaudacionm2").selectpicker('refresh');
		$("#noperacionm2").val(data.noperacion);
		$("#observacionesm2").val(data.observaciones);
		$("#enviodigital2").val(data.enviodigital);

		$("#observaciones_envio2").val(data.observaciones_envio);
		$("#lugar_confirmacion2").val(data.lugar_confirmacion);

 	});
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/gestionenvios.php?op=listarDetalle&id="+idmatricula,function(r){
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
			url:'../controladores/gestionenvios.php?op=listarArticulos',
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

function evaluar(){
  	//si los detalles son mayores que 0 mostrar boton guardar
  	if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide(); 
      cont=0;
    }
  }

  //funcion que espera el id de la fila a eliminar
  function eliminarDetalle(indice){
  	//id fila mas el indice
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	evaluar();
  	articuloAdd="";
  }

  
//Función para desactivar registros
function okimpresion(idmatricula)
{
	swal({
		title: "¿Deseas imprimir?",
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
				$.post("../controladores/gestionenvios.php?op=okimpresion", {idmatricula : idmatricula}, function(e){
				swal(
					'!!! Impresión Realizada !!!',e,'success')
			tabla.ajax.reload();
		});
		}else {
			$.post("../controladores/gestionenvios.php?op=oknoimpresion", {idmatricula : idmatricula}, function(e){
				swal('! Se Cancelo la impresión  ¡', e, 'error');
			tabla.ajax.reload();
			});
		  }
		});

}

init();