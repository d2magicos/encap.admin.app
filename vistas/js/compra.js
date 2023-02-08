 var tabla;

 // activa campos para registrar Cliente
$('.btn_new_cliente').click(function(e) {
		//Cargamos los items al select pais
		$.post("../controladores/compra.php?op=selectPais", function(r){
			$("#idpais").html(r);
			$('#idpais').selectpicker('refresh');
	});

	
	//Cargamos id
	$.post("../controladores/compra.php?op=id", function($id){
		//$("#cod_matricula").html(r);
		$('#id').val(($id));
		
	});

	//Cargamos idmatricula
	$.post("../controladores/compra.php?op=idmatriculaprimary", function($id){
		//$("#cod_matricula").html(r);
		$('#idmatricula').val(($id));			

	});

	e.preventDefault();
	$('#nombre1').removeAttr('disabled');
	$('#telefono').removeAttr('disabled');
	$('#telefono2').removeAttr('disabled');
	$('#email').removeAttr('disabled');
	//$('#pais').removeAttr('disabled');
	$('#departamento').removeAttr('disabled');
	$('#ciudad1').removeAttr('disabled');
	$('#direccion').removeAttr('disabled');
	$('#fecha_cumple').removeAttr('disabled');
	$("#idpais").selectpicker('refresh');
  
	$('#div_registro_cliente').slideDown();
  
  });

 //function buscarDNI(){
$('#btnBuscar').click(function(e) {

	var num_digitos= $('#num_documento').val().length;
	console.log(num_digitos);
	if(num_digitos<3){
		swal({
			icon: 'error',
			type: 'error',
			title: 'Faltan Digitos',
			text: 'Debe ingresar mínimo 4 digitos.',
			html:
			  '' +
			  'and other'
		  });
	
	}else{
		e.preventDefault();

		//Cargamos los items al select pais
		$.post("../controladores/compra.php?op=selectPais", function(r){
			$("#idpais").html(r);
			$('#idpais').selectpicker('refresh');
	});


	//Cargamos id
	$.post("../controladores/compra.php?op=id", function($id){
		//$("#cod_matricula").html(r);
		$('#id').val(($id));
		
	});

	//Cargamos idmatricula
	$.post("../controladores/compra.php?op=idmatriculaprimary", function($id){
		//$("#cod_matricula").html(r);
		$('#idmatricula').val(($id));			

	});

	

	var cl = $('#num_documento').val();
	var action = 'searchCliente';

	$.ajax({
	  url: '../controladores/compra.php?op=buscarcliente',
	  type: "POST",
	  async: true,
	  data: {action:action,num_documento:cl},
	  success: function(response) {

		if (response == 0) {

			swal({
				icon: 'error',
				type: 'error',
				title: 'Participante no encontrado <br><br> <a href="participantescrear.php" class="btn btn-success tepull-center" style="width: 270px; height:40px; font-size:20px;"><i class="fa fa-user-plus"></i> Crear nuevo participante <br></a> ',
				
				html:
				  '' +
				  'and other'
			  });
			  
			$('#idparticipante').val('');
			$('#nombre1').val('');
			$('#telefono').val('');
			$('#telefono2').val('');
			$('#email').val('');
			$('#departamento').selectpicker('refresh');
			$('#ciudad1').val('');
			$('#direccion').val('');
			$('#fecha_cumple').val('');
			$('#idpais').selectpicker('refresh');
			//$('#idpais').val('');

		  // mostar boton agregar
		  $('.btn_new_cliente').slideDown();
		}else {

			swal("¡Participante Encontrado!", "", "success");
		  var data = $.parseJSON(response);
		  //$('#idparticipante').val(data.idparticipante);
		  $('#idparticipante').val(data.idpersona);
		  $('#idpersona').val(data.idpersona);
		  $('#nombre1').val(data.nombre);
		  $("#idtipo_documento").val(data.idtipo_documento);
		  //$("#idtipo_documento").selectpicker('refresh');
		  $('#nombreparticipante').val(data.nombre);
		  $('#telefono').val(data.telefono);
		  $('#telefono2').val(data.telefono2);
		  $('#email').val(data.email);
		  $("#idpais").val(data.idpais);
		  $("#idpais").selectpicker('refresh');
		  $('#departamento').val(data.departamento);
		  $("#departamento").selectpicker('departamento');
		  $('#ciudad1').val(data.ciudad);
		  $('#direccion').val(data.direccion);
		  $('#fecha_cumple').val(data.fecha_cumple);
		  // ocultar boton Agregar
		  $('.btn_new_cliente').slideUp();
		  $('#div_registro_curso').slideDown();
  
		  // Bloque campos
		  $('#nombre1').attr('disabled','disabled');
		  $('#telefono').attr('disabled','disabled');
		  $('#telefono2').attr('disabled','disabled');
		  $('#email').attr('disabled','disabled');
		  //$('#idpais').attr('disabled','disabled');
		  //$('#departamento').attr('disabled','disabled');
		  $('#ciudad1').attr('disabled','disabled');
		  $('#direccion').attr('disabled','disabled');
		  $('#fecha_cumple').attr('disabled','disabled');
		  // ocultar boto Guardar
		  $('#div_registro_cliente').slideUp();
		}
	  },
	  error: function(error) {  
	  }
	});

	}


	
  });
//}
  
// Crear cliente = Matricula
  $('.btn_cliente').click(function(e) {
	e.preventDefault();
	$.ajax({
	  url: '../controladores/compra.php?op=nuevocliente',
	  type: "POST",
	  async: true,
	  data: $('#formulario').serialize(),
	  success: function(response) {
	
		if (response  != 0) {
		  // Agregar id a input hidden
		  $('#idparticipante').val(response);
		  $('#idpersona').val(response);
		  
		  //Mensaje de Creado cliente nuevo
		swal("¡Participante Creado!", "", "success");
		$('#div_registro_curso').slideDown();

		  //bloque campos
		  $('#nombre1').attr('disabled','disabled');
		  $('#telefono').attr('disabled','disabled');
		  $('#telefono2').attr('disabled','disabled');
		  $('#email').attr('disabled','disabled');
		  $('#idpais').attr('disabled','disabled');
		  $('#departamento').attr('disabled','disabled');
		  $('#ciudad1').attr('disabled','disabled');
		  $('#direccion').attr('disabled','disabled');
		  $('#fecha_cumple').attr('disabled','disabled');
		  // ocultar boton Agregar
		  $('.btnAgregarArt').slideUp();
		  //ocultar boton Guardar
		}
		
	  },	  
	  error: function(error) {
		 
	  }
	});
  });
  
//Función que se ejecuta al inicio
function init(){
	mostrarform(true);
	listar();
	limpiar();
	$('#div_registro_curso').slideUp();
	
	$("#prioridad").selectpicker('refresh');
	$("#formato").val("");
	$("#formato").selectpicker('refresh');
	$("#idforma_recaudacion").val("");
	$("#idforma_recaudacion").selectpicker('refresh');
	$("#idmediospagos").val("");
	$("#idmediospagos").selectpicker('refresh');
	$("#idtrafico").val("");
	$("#idtrafico").selectpicker('refresh');
	$("#observaciones").val("");
	$("#observaciones_envio").val("");
	$("#compromiso").val("");
	$("#voucher").val("");

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
				
	});


	//Cargamos los items al select tipodocumento
		$.post("../controladores/compra.php?op=selectTipodocumento", function(r){
			$("#idtipo_documento").html(r);
			$('#idtipo_documento').selectpicker('refresh');
	});
	
	//Cargamos los items al select pais
	 	$.post("../controladores/compra.php?op=selectPais", function(r){
	 		$("#idpais").html(r);
 			$('#idpais').selectpicker('refresh');
	 });

	//Cargamos los items al select Medios Pagos
	$.post("../controladores/compra.php?op=selectMediospagos", function(r){
		$("#idmediospagos").html(r);
		$('#idmediospagos').selectpicker('refresh');
	});

	//Cargamos los items al select Procedimiento
	$.post("../controladores/compra.php?op=selectRecaudacion", function(r){
		$("#idforma_recaudacion").html(r);
		$('#idforma_recaudacion').selectpicker('refresh');
	});
	
	/* NUEVO pruebas */
	$.post("../controladores/compra.php?op=selectStaff", (r) => {
		$('#selectPersonal').html(r);
		$('#selectPersonal').selectpicker('refresh');
	});

	//Cargamos los items al select Procedimiento
	$.post("../controladores/compra.php?op=selectTrafico", function(r){
		$("#idtrafico").html(r);
		$('#idtrafico').selectpicker('refresh');
	});


	//Cargamos id
	$.post("../controladores/compra.php?op=id", function($id){
		//$("#cod_matricula").html(r);
		$('#id').val(($id));
		
	});

	//Cargamos idmatricula
	$.post("../controladores/compra.php?op=idmatriculaprimary", function($id){
		//$("#cod_matricula").html(r);
		$('#idmatricula').val(($id));			

	});

	 


	$('#mCompras').addClass("treeview active");
    $('#lIngresos').addClass("active");	 

	//Obtenemos la fecha y hora actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var hora = now.getHours() + ":"+ now.getMinutes() + ':' + now.getSeconds();
	var fecha  = now.getFullYear()+"-"+(month)+"-"+(day);
    $('#fecha_hora').val(fecha);  
    $('#hora').val(hora); 

}


//Función limpiar
function limpiar()
{

	//Cargamos id
	$.post("../controladores/compra.php?op=id", function($id){
		//$("#cod_matricula").html(r);
		$('#id').val(($id));
		
	});

	//Cargamos idmatricula
	$.post("../controladores/compra.php?op=idmatriculaprimary", function($id){
		//$("#cod_matricula").html(r);
		$('#idmatricula').val(($id));			

	});

	$("#idpersona").val("");
	$("#nombre").val("");

	$("#cod_matricula").val("");
	$("#num_documento").val("");
	$("#nombre1").val("");
	$("#telefono").val("");
	$("#telefono2").val("");
	$("#email").val("");
	$("#departamento").val("");
	$("#ciudad1").val("");
	$("#direccion").val("");
	$("#fecha_cumple").val("");

	$("#monto").val("");
	$("#prioridad").selectpicker('refresh');
	
	$("#formato").val("");	//	NUEVO
	$("#formato").selectpicker('refresh');
	$("#idforma_recaudacion").val("");
	$("#idforma_recaudacion").selectpicker('refresh');
	$("#idmediospagos").val("");
	$("#idmediospagos").selectpicker('refresh');
	$("#idtrafico").val("");
	$("#idtrafico").selectpicker('refresh');

	$("#idcurso1").val("");
	$("#noperacion").val("");
	$("#observaciones").val("");
	$("#observaciones_envio").val("");
	$("#compromiso").val("");
	$("#voucher").val("");

	//$("#fecha_curso").val("");
	$(".filas").remove();
	articuloAdd="";

	//Obtenemos la fecha y hora actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var hora = now.getHours() + ":"+ now.getMinutes() + ':' + now.getSeconds();
	var fecha  = now.getFullYear()+"-"+(month)+"-"+(day);
    $('#fecha_hora').val(fecha);  
    $('#hora').val(hora);  
	
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
		detalles=0;
		$("#btnAgregarArt").show();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	//mostrarform(false);
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
		        ],
		"ajax":
				{
					url: '../controladores/compra.php?op=listar',
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
		url: "../controladores/compra.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Matricula Registrada',
				  type: 'success',
					text:datos
				});	          
	          mostrarform(true);
	          listar();
			  limpiar();
			
	    }
	});

	limpiar();
}

// Id del registro d el matricula 
function id($id)
{
	
	$.post("../controladores/compra.php?op=id",{$id : $id}, function(data, status)
	{
		data = JSON.parse(data);		
		$("#id").val(data.id);		
 	});
	
}

// Id del registro d el matricula 
function idmatriculaprimary($id)
{
	
	$.post("../controladores/compra.php?op=idmatriculaprimary",{$id : $id}, function(data, status)
	{
		data = JSON.parse(data);		
		$("#idmatricula").val(data.id);		
 	});
	
}

function listarArticulos(){
		//Cargamos los items al select pais


	//Cargamos id
	$.post("../controladores/compra.php?op=id", function($id){
		//$("#cod_matricula").html(r);
		$('#id').val(($id));
		
	});

	//Cargamos idmatricula
	$.post("../controladores/compra.php?op=idmatriculaprimary", function($id){
		//$("#cod_matricula").html(r);
		$('#idmatricula').val(($id));			

	});

	tabla=$('#tblarticulos').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		"scrollY":"400px",//tamaño del scroll
		"scrollCollapse":true,//barra lateral Y
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [

		],
		"ajax":
		{
			url:'../controladores/compra.php?op=listarArticulos',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}

var articuloAdd="";
var cont=0;
var detalles=0;

function agregarDetalle(idcurso,cod_curso,curso,tipo_curso,n_horas,fecha_inicio,contexto)
  {

	//Cargamos id
	$.post("../controladores/compra.php?op=id", function($id){
		//$("#cod_matricula").html(r);
		$('#id').val(($id));
		
	});

	//Cargamos idmatricula
	$.post("../controladores/compra.php?op=idmatriculaprimary", function($id){
		//$("#cod_matricula").html(r);
		$('#idmatricula').val(($id));			

	});

	//aquí preguntamos si el curso ya fue agregado
    if(articuloAdd.indexOf(idcurso)!= -1)
    { //reporta -1 cuando no existe
		 swal( "El curso de: "+curso+" ya se agrego","", "warning");
    }
    else
    {

    if (idcurso!="")
    {
		swal("Agregaste el curso de: "," "+curso, "success");
		var fila='<tr class="filas" id="fila'+cont+'">'+
		'<td><input class="form-control" type="hidden" name="cod_curso[]" id="cod_curso[]" value="'+idcurso+'">'+cod_curso+'</td>'+
        '<td><input class="form-control" type="hidden" name="idcurso[]" id="idcurso[]" value="'+idcurso+'">'+curso+'</td>'+
		'<td><input style="text-align:center" type="hidden" name="tipo_curso[]" value="'+idcurso+'">'+tipo_curso+'</td>'+
		'<td><input style="text-align:center" type="hidden" name="n_horas[]" value="'+idcurso+'">'+n_horas+'</td>'+
        '<td><input style="text-align:center" type="hidden" name="fecha_inicio[]" value="'+idcurso+'">'+fecha_inicio+'</td>'+
        '<td><center><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fa fa-trash"></i></button></center></td>'+
		'</tr>';
    	cont++;
    	detalles=detalles;
    	articuloAdd= articuloAdd + idcurso - "-"; //aca concatemanos los idarticulos xvg: 1-2-5-12-20
    	//agregar a los imput los valores de la tabla
    	$('#detalles').append(fila);
		$('#codigocurso').val(cod_curso);
		$('#nombrecurso').val(curso);
		$('#idcurso1').val(idcurso);
		$('#fecha_inicio1').val(fecha_inicio);
		$('#horas').val(n_horas);
		$('#contexto').val(contexto);

    }
    else
    {
    	swal("Error al ingresar el detalle, revisar los datos del curso");
    }
	}
  }

  //funcion que espera el id de la fila a eliminar
  function eliminarDetalle(indice){
  	//id fila mas el indice
  	$("#fila" + indice).remove();
  	detalles=detalles-1;  
  	articuloAdd="";
	cont=0;
  }
  
init();