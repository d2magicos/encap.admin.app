var tabla;

//Función que se ejecuta al inicio
function init(){

	 $("#myModal").on("submit",function(e)
	 {
	 	guardaryeditar(e);	
	 });

}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/perfil.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          swal({
				  title: 'Usuario actualizado con éxito!',
				  type: 'success',
					//text:datos
				});
	    }
	});
	limpiar();
}

//Función limpiar
function limpiar()
{
	$("#login").val("");
	$("#clave").val("");
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

init();