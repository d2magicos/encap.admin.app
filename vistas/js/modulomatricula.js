var tabla;
 
//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
		
	});

	 
}


//Función limpiar
function limpiar()
{
	$("#idpersona").val("");
	$("#nombre").val("");

	$("#cod_matricula").val("");
	$("#num_documento").val("");
	$("#nombre").val("");
	$("#telefono").val("");
	$("#telefono2").val("");
	$("#email").val("");
	$("#pais").val("");
	$("#departamento").val("");
	$("#ciudad").val("");
	$("#direccion").val("");
	$("#fecha_cumple").val("");

	$("#monto").val("");
	$("#noperacion").val("");
	$("#observaciones").val("");

	articuloAdd="";

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	var ano = now.getFullYear()
    $('#fecha_hora').val(today);  

	// $('#mes').val(month);  
 	//  $('#ano').val(ano.split(ano,2)); 
 	//  var codigomatricula = (month)+"."+(ano) ;
	//  $('#cod_matricula').val(codigomatricula); 

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").show();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").show();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();

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
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controladores/modulomatricula.php?op=listar',
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
		url: "../controladores/modulomatricula.php?op=guardaryeditar",
		//url: "../controladores/compra.php?op=generarqr",
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
	          mostrarform(false);
	          listar();
	    }

	});
	limpiar();
}


//muestra datos de la tabla y del detalle de la tabla
function mostrar(idmatricula)
{
	$("#formulario").modal('show');
	$.post("../controladores/modulomatricula.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		//mostrarform(true);

		$("#idmatricula").val(data.idmatricula);
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
		$("#qr").val(data.qr);
		$("#idpersonal").val(data.idpersonal);

		$("#montom").val(data.monto);
		$("#formatom").val(data.formato);
		$("#prioridadm").val(data.prioridad);
		$("#mediodepagom").val(data.mediopago);
		$("#idmediospagos").val(data.idmediospagos);
		$("#formarecaudacionm").val(data.formarecaudacion);
		$("#idforma_recaudacion").val(data.idforma_recaudacion);
		$("#noperacionm").val(data.noperacion);
		$("#observacionesm").val(data.observaciones);

 	});
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/modulomatricula.php?op=listarDetalle&id="+idmatricula,function(r){
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
									$.post("../controladores/modulomatricula.php?op=enviar", {idmatricula : idmatricula}, function(e){
										swal(
											'!!! Entregado !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo el envio digital", "error");
							 }
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
			url:'../controladores/modulomatricula.php?op=listarArticulos',
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

var articuloAdd="";
//declaramos variables necesarias para trabajar con las compras y sus detalles
//var impuesto=18;
//para contar cuantos detalles le agregamos a la compra
var cont=0;
//cantidad de detalles que tiene la compra
var detalles=0;

//var no_aplica=0;

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

init();