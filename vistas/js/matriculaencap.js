var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	//Cargamos los items al select proveedor
	$.post("../controladores/matricula.php?op=selectParticipant", function(r){
	            $("#idparticipante").html(r);
	            $('#idparticipante').selectpicker('refresh');
	});
	$('#mCompras').addClass("treeview active");
    $('#lIngresos').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idparticipante").val("");
	$("#cod_matricula").val("");
	$("#tipo_documento").val("");
	$("#num_documento").val("");
	$("#nombre").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#direccion").val("");
	
	articuloAdd="";
	no_aplica=0;

	$(".filas").remove();

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
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
					url: '../controladores/matricula.php?op=listar',
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
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/matricula.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'compra',
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
function mostrar(idcompra)
{
	$("#getCodeModal").modal('show');
	$.post("../controladores/compra.php?op=mostrar",{idcompra : idcompra}, function(data, status)
	{
		data = JSON.parse(data);		
		//mostrarform(true);

		$("#idproveedorm").val(data.proveedor);
		$("#tipo_comprobantem").val(data.tipo_comprobante);
		$("#serie_comprobantem").val(data.serie_comprobante);
		$("#num_comprobantem").val(data.num_comprobante);
		$("#fecha_horam").val(data.fecha);
		$("#impuestom").val(data.impuesto);
		$("#idingresom").val(data.idingreso);


 	});
	//enviar mediante get listar detalle a la varible op de ajax
 	$.post("../controladores/compra.php?op=listarDetalle&id="+idcompra,function(r){
	        $("#detallesm").html(r);
	});
}

//Función para anular registros
function anular(idcompra)
{
	swal({
						    title: "¿Anular?",
						    text: "¿Está seguro Que Desea anular la Compra?",
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
									$.post("../controladores/compra.php?op=anular", {idcompra : idcompra}, function(e){
										swal(
											'!!! Anulado !!!',e,'success')
					            tabla.ajax.reload();
				        	});
						    }else {
						    swal("! Cancelado ¡", "Se Cancelo la anulación de la Compra", "error");
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
			url:'../controladores/matriculaencap.php?op=listarArticulos',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":15,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}


var articuloAdd="";
//declaramos variables necesarias para trabajar con las compras y sus detalles
var impuesto=18;
//para contar cuantos detalles le agregamos a la compra
var cont=0;
//cantidad de detalles que tiene la compra
var detalles=0;

var no_aplica=0;

$("#btnguardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
  {
  	//lo que seleccionemos en el select estara guardado en esta variable
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
  	if (tipo_comprobante=='Factura') {
		$("#impuesto").val(impuesto); 
        no_aplica=impuesto;
	}else if(tipo_comprobante=='Boleta'){
		$("#impuesto").val("0");
        no_aplica=0;
	}
	else{
		$("#impuesto").val("0");
        no_aplica=0;	}
  }

  function agregarDetalle(idproducto,producto)
  {
  	//aquí preguntamos si el idarticulo ya fue agregado
    if(articuloAdd.indexOf(idproducto)!= -1)
    { //reporta -1 cuando no existe
     	swal( producto +" ya se agrego");
    }
    else
    {
  	var cantidad=1;
    var precio_compra=1;
    var precio_venta=1;

    if (idproducto!="")
    {
    	var subtotal=cantidad*precio_compra;
		var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><input style="text-align:center" type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td>'+
        '<td><input style="text-align:center" type="number" onchange="modificarSubtotales()" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><input style="text-align:center" type="number" step="0.01" onchange="modificarSubtotales()" name="precio_compra[]" id="precio_compra[]" value="'+precio_compra+'"></td>'+
        '<td><input style="text-align:center" type="number" step="0.01" name="precio_venta[]" value="'+precio_venta+'"></td>'+
        '<td><spans id="subtotal'+cont+'" name="subtotal">'+subtotal+'</span></td>'+
        '<td><center><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fa fa-trash"></i></button></center></td>'+
		'</tr>';
    	cont++;
    	detalles=detalles+1;
    	articuloAdd= articuloAdd + idproducto + "-"; //aca concatemanos los idarticulos xvg: 1-2-5-12-20
    	//agregar fila a la tabla
    	$('#detalles').append(fila);
    	modificarSubtotales();
    }
    else
    {
    	swal("Error al ingresar el detalle, revisar los datos del producto");
    }
	}
  }

  function modificarSubtotales()
  {
  	//tres array para almacenar las cantidades, precios de compra y subtotales
  	//leer del documento
  	var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_compra[]");
    var sub = document.getElementsByName("subtotal");
    //recorrer los detalles y calcular los subtotales
    //recorrer hasta la cantidad de indices que tiene cant
    for (var i = 0; i <cant.length; i++) {
    	var inpC=cant[i];
    	var inpP=prec[i];
    	var inpS=sub[i];

    	inpS.value=inpC.value * inpP.value;
    	document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    //Permitir calcular los totales en base a los subtotales
    calcularTotales();

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