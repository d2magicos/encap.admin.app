var tabla;
let rowTable = "";
let rowTable2 = "";
 
//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e) {
		guardaryeditar(e);		
	});	 

	$("#formulario2").on("submit", function(e) {
		guardarForm2(e);
		//console.log(e.currentTarget)
	});
}

//Función limpiar
function limpiar() {
    $("#observaciones_satisfacion").val("");
    $("#fechaatencion").val("");
    $("#fechainfo").val("");
	$('#satisfacion').selectpicker('refresh');
    $("#satisfacion").val("");
	$('#estadosatisfacion').selectpicker('refresh');
    $("#estadosatisfacion").val("");
}

//Función mostrar formulario fechaatencion
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
function listar() {
	tabla = $('#tbllistado').dataTable({
		"aProcessing": true,	// Activamos el procesamiento del datatables
	    "aServerSide": true,	// Paginación y filtrado realizados por el servidor
		//"scrollY":"800px",//tamaño del scroll
		"scrollCollapse": true,	// barra lateral Y
	    dom: 'Bfrtip',			// Definimos los elementos del control de tabla
	    buttons: [
			'excelHtml5'
		],
		"ajax": {
			url: '../controladores/listasatisfacion.php?op=listar',
			type : "get",
			dataType : "json",						
			error: function(e) {
				console.log(e.responseText);	
			}
		},
		"bDestroy": true,
		"iDisplayLength": 5,	// Paginación
	    "order": [[ 0, "desc" ]]	// Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/listasatisfacion.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos) {                    
	        swal({
				title: 'Matricula Actualizada',
				type: 'success',
				text: datos
			});	      

			$('#formulario').modal('hide');	          
			mostrarform(false);
			tabla.ajax.reload();
	    }
	});

	limpiar();
}

/* getDataSat = (element) => {
	console.log(element.parentNode)
} */

function limpiar2() {
	$('#valoracion01').selectpicker('refresh')
	$('#valoracion01').val('')
	$('#valoracion02').selectpicker('refresh')
	$('#valoracion02').val('')
	$('#valoracion03').selectpicker('refresh')
	$('#valoracion03').val('')
	$('#valoracion04').selectpicker('refresh')
	$('#valoracion04').val('')

	$('#comentario01').val('')
	$('#comentario02').val('')
	$('#comentario03').val('')
	$('#comentario04').val('')
}

/*  */
function guardarForm2(e) {
	e.preventDefault()

	let formData = new FormData($("#formulario2")[0])
	/* let objData = JSON.stringify(formData)
	console.log(objData) */

	const data = {}

	formData.forEach((value, key) => (data[key] = value))

	let fecha = new Date()

	$.ajax({
		url: "../controladores/listasatisfacion.php?op=guardarFormulario02",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos) {                    
	        swal({
				title: 'Satisfación #2 registrada',
				type: 'success',
				text: datos
			});	      

			$('#formulario2').modal('hide');	

			rowTable2.cells[19].innerHTML = data.valoracion01  
			rowTable2.cells[20].innerHTML = data.comentario01  
			rowTable2.cells[21].innerHTML = data.valoracion02  
			rowTable2.cells[22].innerHTML = data.comentario02  
			rowTable2.cells[23].innerHTML = data.valoracion03  
			rowTable2.cells[24].innerHTML = data.comentario03  
			rowTable2.cells[25].innerHTML = data.valoracion04  
			rowTable2.cells[26].innerHTML = data.comentario04  
			rowTable2.cells[27].innerHTML = '<span class="badge bg-green"><i class="fa fa-check-square-o"></i> CONFIRMADO</span>'  
			//rowTable2.cells[28].contentType = fecha.getFullYear + '-' + (fecha.getUTCMonth + 1) + '-' + fecha.getDay 
			rowTable2.cells[29].innerHTML = '<a class="badge bg-yellow p-1" target="_blank" onclick="habilitarBono(this, ' + data.idmatricula2 + ')">Habilitar bono</a>'  

			limpiar2()
	    }
	});

	limpiar();
}


//muestra datos de la tabla y del detalle de la tabla
function mostrar(idmatricula)
{
	$("#formulario").modal('show');

	$.post("../controladores/listasatisfacion.php?op=mostrar",{idmatricula : idmatricula}, function(data, status)
	{
		data = JSON.parse(data);		
		//mostrarform(true);

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
		$("#qr").val(data.qr);
		$("#idpersonal").val(data.idpersonal);
		
		$("#satisfacion").val(data.satisfacion);
		$("#satisfacion").selectpicker('refresh');
		$("#estadosatisfacion").val(data.estadosatisfacion);
		$("#estadosatisfacion").selectpicker('refresh');
		$("#fechainfo").val(data.fechainfo);
		$("#observaciones_satisfacion").val(data.observaciones_satisfacion);

 	});
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/listasatisfacion.php?op=listarDetalle&id="+idmatricula,function(r){
	        $("#detallesm").html(r);
	});
}

/* nuevo 16/01 */

function mostrarFormulario2(element, idmatricula) {
	rowTable2 = element.parentNode.parentNode.parentNode

	console.log(rowTable2)

	$("#formulario2").modal('show');
	
	$.post("../controladores/listasatisfacion.php?op=mostrar", { idmatricula }, function(data, status) {
		data = JSON.parse(data);		
		//	mostrarform(true);

		$("#nombrepersonal2").val(data.nombrepersonal);	
		$("#idpersonal").val(data.idpersonal);
		
		$("#idmatricula2").val(data.idmatricula);
		$("#idparticipante").val(data.idparticipante);
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
	
		/* preguntas */
		
		$("#valoracion01").val(data.valoracion1);
		$("#valoracion01").selectpicker('refresh');
		$("#valoracion02").val(data.valoracion2);
		$("#valoracion02").selectpicker('refresh');
		$("#valoracion03").val(data.valoracion3);
		$("#valoracion03").selectpicker('refresh');
		$("#valoracion04").val(data.valoracion4);
		$("#valoracion04").selectpicker('refresh');

		$('#comentario01').val(data.comentario1)
		$('#comentario02').val(data.comentario2)
		$('#comentario03').val(data.comentario3)
		$('#comentario04').val(data.comentario4)

		/* $("#estadosatisfacion").val(data.estadosatisfacion);
		$("#estadosatisfacion").selectpicker('refresh');
		$("#fechainfo").val(data.fechainfo);
		$("#observaciones_satisfacion").val(data.observaciones_satisfacion); */
 	});

	//	enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/listasatisfacion.php?op=listarDetalle&id="+idmatricula,function(r) {
	        $("#detallesm").html(r);
	});
}

function habilitarBono(element, idmatricula) {
	rowTable = element.parentNode.parentNode
	/* console.log(rowTable) */

	let estado = "ACTIVO"
	//alert("holaa ")

	swal({
		title: "¿Habilitar bono?",
		text: "",
		type: "warning",
		showCancelButton: true,
		cancelButtonText: "No",
		confirmButtonText: "Si",
		cancelButtonColor: '#FF0000',
		confirmButtonColor: "#0004FA",
		closeOnConfirm: true,
		closeOnCancel: true,
		showLoaderOnConfirm: true
	}, function(isConfirm) {
		if (isConfirm) {
			$.post("../controladores/listasatisfacion.php?op=habilitarBono", { idmatricula }, function(e) {
				swal('Habilitado', e, 'success')

				let url = "https://sistemas.encap.edu.pe/encuesta_satisfaccion/cupon.php";
				
				//	tabla.ajax.reload();
				rowTable.cells[29].innerHTML = '<a class="badge bg-green" href=' +  url + '?id=' + idmatricula + ' target="_blank" style="padding: .65rem .85rem;">Bono</a>';
			});
		} 
	});
}

$("#btnguardar").hide();

  function agregarDetalle(idcurso,cod_curso,curso,tipo_curso,n_curso)
  {
  	
	//aquí preguntamos si el idarticulo ya fue agregado
    if (articuloAdd.indexOf(idcurso)!= -1) { //reporta -1 cuando no existe
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


  function CopyClipboard(id){
	console.log("hola"+id);

	navigator.clipboard.writeText(id);
	var button = document.getElementById(id);

	button.innerHTML="Copiado";

	console.log("Copiado");
  }

init();