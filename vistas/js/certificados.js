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
	$.post("../controladores/certificados.php?op=selectCategoria", function(r){
		$("#idcategoria").html(r);
		$('#idcategoria').selectpicker('refresh');

});

// //Cargamos los items al select participante
  $.post("../controladores/certificados.php?op=id", function($id){
  	//$("#id").html(r);
  	$('#id').val($id);				

  });
	
}

//Función limpiar
function limpiar()
{

	$("#nombre1").val("");

	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");
	
	$("#imagen").val("");
	$("#imagenposterior").val("");
	$("#imagenf").val("");
	$("#imagenposteriorf").val("");
	$("#id").val("");
	$("#idcert").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#imagenmuestra2").attr("src","");
	$("#imagenactual2").val("");
	$("#imagenmuestraf").attr("src","");
	$("#imagenactualf").val("");
	$("#imagenmuestra2f").attr("src","");
	$("#imagenactual2f").val("");
	$.post("../controladores/certificados.php?op=id", function($id){
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
					url: '../controladores/certificados.php?op=listarc',
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
			url: "../controladores/certificados.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
	
			success: function(datos)
			{                    
				  swal({
					  title: 'Certificado',
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


function mostrar(id)
{
	console.log('hola');
	$.post("../controladores/certificados.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcert").val(data.id);
		$("#cod_curso").val(data.cod_curso);
		$("#nombre1").val(data.subcategoria);
		$("#idcategoria").val(data.idcategoria);

		var div=document.getElementById("diplomafisico");

		if(data.idcategoria=="9"){
			div.style.display="none";
		}else{
			div.style.display="block";
		}

		$("#idcategoria").selectpicker('refresh');
		
		
		if(data.imagen==""){
			$("#imagenmuestra").attr("src","../cert_digitales/fpdf/img/Getimage.jpg");
		}else{
			$("#imagenmuestra").attr("src","../cert_digitales/fpdf/img/"+data.imagen);
		}
		$("#imagenmuestra").show();
		

		var size = $("#idcategoria").find("option:selected").data("size");
		$("#idestilo").html($options.filter('[data-size="' + size + '"]'));
		$("#idestilo").val($select2.find("option:first").val());

		
		//$("#idestilo").val('');
		
		$("#idestilo").selectpicker('refresh');


		
		
		
		
		$("#imagenmuestra2").show();
		$("#imagenmuestra2").attr("src","../cert_digitales/fpdf/img/"+data.imagenposterior);

		$("#imagenmuestraf").show();
		$("#imagenmuestraf").attr("src","../cert_digitales/fpdf/img/"+data.imagenf);

		$("#imagenmuestra2f").show();
		$("#imagenmuestra2f").attr("src","../cert_digitales/fpdf/img/"+data.imagenposteriorf);
		$("#fechainicio").val(data.fecha_inicio);
		$("#fechafin").val(data.fecha_fin);
		
		//$("#imagen").val(data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#imagenactualf").val(data.imagenf);
		//$("#imagenposterior").val(data.imagenposterior);
		$("#imagenactual2").val(data.imagenposterior);
		$("#imagenactual2f").val(data.imagenposteriorf);
	
 	})
}


//Función para desactivar registros
function desactivar(id)
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
				$.post("../controladores/certificados.php?op=desactivar", {id : id}, function(e){
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
function activar(id)
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
						$.post("../controladores/certificados.php?op=activar", {id : id}, function(e){
						swal("!!! Activarda !!!", e ,"success");
								tabla.ajax.reload();
						});
		    }else {
		    swal("! Cancelado ¡", "Se Cancelo la activacion del Producto", "error");
			 }
			});
}

//Función para eliminar registros
function eliminar(id)
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
				$.post("../controladores/certificados.php?op=eliminar", {id : id}, function(e){
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