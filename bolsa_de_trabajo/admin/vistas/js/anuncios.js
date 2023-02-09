var tabla;
let id_anuncio = document.querySelector("#id_anuncio");
let img_anuncio = document.querySelector("#img_anuncio");
let before_img = document.querySelector("#before_img");
let show_img = document.querySelector("#show_img");
let link_anuncio = document.querySelector("#link_anuncio");
let device_desktop = document.querySelector("#device_desktop");
let device_tablet = document.querySelector("#device_tablet");
let device_movil = document.querySelector("#device_movil");

$("#myModal").on("hidden.bs.modal", (e) => {
	$("#myModal").find("form").trigger("reset");
	id_anuncio.value = "";
	// eliminando los inputs hidden
	before_img.value = "";
	$("#show_img").hide();
	// show_img.classList.add("d-none");
});

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#myModal").on("submit", function (e) {
		guardaryeditar(e);
	})
}

//Función mostrar formulario
function mostrarform(flag) {
	$("#show_img").hide();
	if (flag) {
		$('#myModal').modal('show');
	}
	else {
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform() {
	mostrarform(false);
}

//Función Listar
function listar() {
	tabla = $('#tbllistado').dataTable(
		{
			"aProcessing": true,//Activamos el procesamiento del datatables
			"aServerSide": true,//Paginación y filtrado realizados por el servidor
			dom: 'Bfrtip',//Definimos los elementos del control de tabla
			buttons: [

			],
			"ajax":
			{
				url: '../controladores/anuncios.php?op=listar',
				type: "get",
				dataType: "json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			"iDisplayLength": 30,//Paginación
			"order": [[0, "desc"]]//Ordenar (columna,orden)
		}).DataTable();
}

//Función para guardar o editar

function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulario")[0]);
	formData.set("device_desktop", device_desktop.checked ? 1 : 0);
	formData.set("device_tablet", device_tablet.checked ? 1 : 0);
	formData.set("device_movil", device_movil.checked ? 1 : 0);
	if ((img_anuncio.files.length == 0 && !before_img.value) || formData.get("link_anuncio").trim().length == 0) {
		swal({
			title: 'Empleo',
			type: 'error',
			text: "Rellene correctamente los campos"
		});
	} else {
		$.ajax({
			url: "../controladores/anuncios.php?op=guardaryeditar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function (datos) {
				let reply = JSON.parse(datos);
				if (reply["success"]) {
					swal({
						title: 'Empleo',
						type: 'success',
						text: reply["message"]
					});
					$('#myModal').modal('hide');
					mostrarform(false);
				} else {
					swal({
						title: 'Empleo',
						type: 'error',
						text: reply["message"]
					});
				}
				tabla.ajax.reload();
			}

		});
	}
}

function mostrar(id) {
	$.post("../controladores/anuncios.php?op=mostrar", { id_anuncio: id }, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);
		id_anuncio.value = data.id_anuncio;
		link_anuncio.value = data.link;
		data.device_desktop==1 ? device_desktop.setAttribute("checked", true) : device_desktop.removeAttribute("checked");
		data.device_tablet==1 ? device_tablet.setAttribute("checked", true) : device_tablet.removeAttribute("checked");
		data.device_movil==1 ? device_movil.setAttribute("checked", true) : device_movil.removeAttribute("checked");

		if (data.imagen) {
			show_img.src = data.imagen;
			$("#show_img").show();
			before_img.value = data.imagen;
		}
	})
}

//Función para eliminar registros
function eliminar(id_anuncio) {
	swal({
		title: "Eliminar?",
		text: "¿Está seguro Que Desea eliminar el anuncio?",
		type: "warning",
		showCancelButton: true,
		cancelButtonText: "No",
		cancelButtonColor: '#d11d41',
		confirmButtonText: "Si",
		confirmButtonColor: "#3870d1",
	}, function (isConfirm) {
		if (isConfirm) {
			$.post("../controladores/anuncios.php?op=eliminar", { id_anuncio: id_anuncio }, function (e) {
				tabla.ajax.reload();
			});
		}
	});

}

init();