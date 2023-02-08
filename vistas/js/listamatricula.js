 var tabla;
 
//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
		limpiar();
		mostrarform(false);
	});	 

	//Cargamos los items al select Medios Pagos
	$.post("../controladores/listamatricula.php?op=selectMediospagos", function(r){
		$("#idmediospagosm").html(r);
		$('#idmediospagosm').selectpicker('refresh');
	});

	//Cargamos los items al select Forma de recaudacion
	$.post("../controladores/listamatricula.php?op=selectRecaudacion", function(r){
		$("#idforma_recaudacionm").html(r);
		$('#idforma_recaudacionm').selectpicker('refresh');
	});

}

//Función limpiar
function limpiar()
{
	$("#observcaionesm").val("");
	$("#obervacionesenviom").val("");
	$("#contexto").val("");
	$("#nota").val("");
	$("#año").val("");
	$("#comprobante").val("");
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
	   // "scrollY":"800px",//tamaño del scroll
		"scrollCollapse":true,//barra lateral Y
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'excelHtml5'
		        ],
		"ajax":
				{
					url: '../controladores/listamatricula.php?op=listar',
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
		url: "../controladores/listamatricula.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Matricula Actualizada',
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
	//listar();
}

//funcion para decodificar url
function htmlDecode(input) {
	var doc = new DOMParser().parseFromString(input, "text/html");
	return doc.documentElement.textContent;
  }


//muestra datos de la tabla y del detalle de la tabla
function mostrar(idmatricula)
{

	$("#formulario").modal('show');
	$.post("../controladores/listamatricula.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);
		
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

		$("#qr").val(htmlDecode(data.qr));
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
		$("#estadoventa").selectpicker('refresh');
		$("#estadoventa").val(data.estadoventa);
		$("#idcategoria").val(data.idplantilla);
		
			
	
		
		console.log(data.categoria);
		$("#formarecaudacionm").val(data.formarecaudacion);
		$("#idforma_recaudacionm").val(data.idforma_recaudacion);
		$("#idforma_recaudacionm").selectpicker('refresh');
		$("#noperacionm").val(data.noperacion);
		$("#obervacionesm").val(htmlDecode(data.observaciones));
		$("#obervacionesenviom").val(data.observaciones_envio);
		$("#compromiso").val(data.compromiso);
		$("#voucher").val(data.voucher);
		$("#enviodigitalm").val(data.enviodigital);
		//$("#fecha_inicio2").val(data.fecha_inicio);
		$("#año").val(data.año);
		$("#nota").val(data.nota);
		$("#contexto").val(data.contexto);
		$("#horas").val(data.horas);
		$("#comprobante").val(data.comprobante);
		$("#imagen").val(data.imagen);
		$("#imagenposterior").val(data.imagenposterior);
		$("#imagenpreview").attr("src","../cert_digitales/fpdf/img/"+data.imagen);
		$("#imagenpreview2").attr("src","../cert_digitales/fpdf/img/"+data.imagenposterior);
		$("#imagenposterior").val(data.imagenposterior);
		$("#idplantilla").val(data.idplantilla);

		var idcurso= document.getElementById("idcurso1").value;
	
		

		$.post("../controladores/listamatricula.php?op=selectSub&id="+idcurso, function(r){
			
			$("#select_idcategoria").html(r);
			$("#select_idcategoria").val(data.categoria);	
			$('#select_idcategoria').selectpicker('refresh');

			Actualizar();
		
		});
		
	
 	});
	 
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/listamatricula.php?op=listarDetalle&id="+idmatricula,function(r){
	        $("#detallesm").html(r);
	});

	
	

	
	
}

//Función para anular registros
function enviar(idmatricula)
{
	swal({
			title: "¿Envio Digital?",
			text: "",
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
						$.post("../controladores/listamatricula.php?op=enviar", {idmatricula : idmatricula}, function(e){
							swal(
								'!!! Entregado !!!',e,'success')
					        tabla.ajax.reload();
				        });
					}else {
						$.post("../controladores/listamatricula.php?op=noenviar", {idmatricula : idmatricula}, function(e){
							swal(
								'! Cancelado ¡','Se Cancelo el envio digital',e,'error')
					        tabla.ajax.reload();
				    });	 
				}
		});
}

//Función para anular registros
function habilitarCert(idmatricula)
{
	swal({
			title: "¿Habilitar certificado digital?",
			text: "",
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
						$.post("../controladores/listamatricula.php?op=habilitar", {idmatricula : idmatricula}, function(e){
							swal(
								'Habilitado',e,'success')
					        tabla.ajax.reload();
				        });
					}else {
						$.post("../controladores/listamatricula.php?op=nohabilitar", {idmatricula : idmatricula}, function(e){
							swal(
								'Cancelado','Se Cancelo la habilitacion del certificado.',e,'error')
					        tabla.ajax.reload();
				    });	 
				}
		});
}

//Función para anular registros
function enviarNotf(dni,nombre,curso,email,idmatricula)
{
	swal({
			title: "¿Enviar notificación al cliente?",
			text: "",
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
					/*if (isConfirm){
						$.post("../controladores/listamatricula.php?op=habilitarnotf", {idmatricula : idmatricula}, function(e){
							swal(
								'Habilitado',e,'success')
							  tabla.ajax.reload();
				        });
					}else {
						$.post("../controladores/listamatricula.php?op=nohabilitarnotf", {idmatricula : idmatricula}, function(e){
							swal('Cancelado','No se envió la notificación.',e,'error'); 
					        tabla.ajax.reload();
				    });*/
				    
				    /* email issue fixed */
				    if (isConfirm) {
					    $.post("../../enviaremail.php", {dni : dni, nombre : nombre, curso : curso, email : email}, function(e){
						    swal('Notificación enviada.',e,'success');
				        });
				        $.post("../../controladores/listamatricula.php?op=habilitarnotf", {idmatricula : idmatricula}, function(e){
							  tabla.ajax.reload();
				        });
					}else {
						$.post("../../controladores/listamatricula.php?op=nohabilitarnotf", {idmatricula : idmatricula}, function(e){
							swal('Cancelado','No se envió la notificación.',e,'error'); 
					        tabla.ajax.reload();
				    });
						
				}
		});
}

function EliminarRegistro(idmatricula){
	swal({
		title: "¿Desea eliminar el registro?",
		text: "",
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
					$.post("../controladores/listamatricula.php?op=eliminar", {idmatricula : idmatricula}, function(e){
						swal(
							'Registro eliminado',e,'success')
						tabla.ajax.reload();
					});
				}else{
					$.post("../controladores/listamatricula.php?op=nohabilitar999", {idmatricula : idmatricula}, function(e){
						swal(
							'Cancelado','No se elimino el registro.',e,'error')
						tabla.ajax.reload();
				});	 
		
				}
	});

}




var articuloAdd="";

var cont=0;
var detalles=0;

$("#btnguardar").hide();

  function agregarDetalle(idcurso,cod_curso,curso,tipo_curso,n_curso)
  {
  	
	//aquí preguntamos si el idarticulo ya fue agregado
    if(articuloAdd.indexOf(idcurso)!= -1)
    { //reporta -1 cuando no existe
     	swal( curso +" ya se agrego");
    }
    else
    {
  	var fecha_curso="";

    if (idcurso!="")
    {
		swal( "Agrego el curso de: "+curso );
    	//var subtotal=cantidad*precio_compra;
		var fila='<tr class="filas" id="fila'+cont+'">'+
		'<td><input class="form-control" type="hidden" name="cod_curso[]" id="cod_curso[]" value="'+idcurso+'">'+cod_curso+'</td>'+
        '<td><input class="form-control" type="hidden" name="idcurso[]" id="idcurso[]" value="'+idcurso+'">'+curso+'</td>'+
		'<td><input style="text-align:center" type="hidden" name="tipo_curso[]" value="'+idcurso+'">'+tipo_curso+'</td>'+
		'<td><input style="text-align:center" type="hidden" name="n_curso[]" value="'+idcurso+'">'+n_curso+'</td>'+
        '<td><input type="text" class="form-control" maxlength="150" name="fecha_curso[]" id="fecha_curso[]" value="'+fecha_curso+'"></td>'+
        //'<td><input style="text-align:center" type="number" step="0.01" onchange="modificarSubtotales()" name="precio_compra[]" id="precio_compra[]" value="'+precio_compra+'"></td>'+
        //'<td><input style="text-align:center" type="number" step="0.01" name="precio_venta[]" value="'+precio_venta+'"></td>'+
        //'<td><spans id="subtotal'+cont+'" name="subtotal">'+subtotal+'</span></td>'+
        '<td><center><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fa fa-trash"></i></button></center></td>'+
		'</tr>';
    	cont++;
    	detalles=detalles+1;
    	articuloAdd= articuloAdd + idcurso + "-"; //aca concatemanos los idarticulos xvg: 1-2-5-12-20
    	//agregar fila a la tabla
    	$('#detalles').append(fila);
    	//$("#btnguardar").show();
    }
    else
    {
    	swal("Error al ingresar el detalle, revisar los datos del Curso");
    }
	}
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

  function Actualizar(){
	var e = document.getElementById("select_idcategoria");
	  var value = e.value;
	  var text = e.options[e.selectedIndex].text;
	  var img = e.options[e.selectedIndex].getAttribute("img1");
	  var img2 = e.options[e.selectedIndex].getAttribute("img2");
	  var estilo = e.options[e.selectedIndex].getAttribute("plantilla");

	  console.log(e.options[e.selectedIndex]);

	  document.getElementById("imagen").value=img;
	  document.getElementById("imagenposterior").value=img2;
	  document.getElementById("idplantilla").value=estilo;


	  document.getElementById("imagenpreview").src="../cert_digitales/fpdf/img/"+img;
	  document.getElementById("imagenpreview2").src="../cert_digitales/fpdf/img/"+img2;
	 
  }
 

init();