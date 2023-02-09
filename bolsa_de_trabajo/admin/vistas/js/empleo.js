$("#myModal").on("hidden.bs.modal", (e) => {
	$("#myModal").find("form").trigger("reset");
	set_depa();
	set_provi();
});

var tabla;
// select
let ubi_depa = document.querySelector("#ubi_depa");
let set_depa = () => {
	$.ajax({
		type: "get",
		url: "../controladores/empleo.php?op=get_alldepa",
		success: function (response) {
			let reply = JSON.parse(response);
			for (let i = 0; i < reply.length; i++) {
				let option = document.createElement("option");
				option.value = reply[i]["depa"];
				option.innerText = reply[i]["depa"];
				ubi_depa.appendChild(option);
			}
		}
	});
}
set_depa();

let ubi_provi = document.querySelector("#ubi_provi");
let set_provi = (depa = "AMAZONAS") => {
	$("#ubi_provi").empty();
	$.ajax({
		type: "post",
		url: "../controladores/empleo.php?op=get_allprovi",
		data: {
			depa: depa
		},
		success: function (response) {
			let reply = JSON.parse(response);
			for (let i = 0; i < reply.length; i++) {
				let option = document.createElement("option");
				option.value = reply[i]["provi"];
				option.innerText = reply[i]["provi"];
				ubi_provi.appendChild(option);
			}
		}
	});
}
set_provi();

ubi_depa.addEventListener("change", (e) => {
	set_provi(ubi_depa.value);
})

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#myModal").on("submit", function (e) {
		guardaryeditar(e);
	})

	$("#imagenmuestra").hide();
	$('#mAlmacen').addClass("treeview active");
	$('#lproductos').addClass("active");
}

//Función limpiar
function limpiar() {
	$("#nombre").val("");
	$("#empresa").val("");
	$("#ubi_depa").val("");
	$("#ubi_provi").val("");
	$("#nvacantes").val("");
	$("#renumeracion").val("");
	$("#fechainicio").val("");
	$("#fechafin").val("");
	$("#experiencia").val("");
	$("#formacion").val("");
	$("#especializacion").val("");
	$("#conocimiento").val("");
	$("#competencia").val("");
	$("#detalle").val("");
	$('#destacado').selectpicker('refresh');
	$('#destacado').val("");

	$("#idempleo").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").show();
		$('#myModal').modal('show');
	}
	else {
		$("#listadoregistros").show();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform() {
	limpiar();
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
				url: '../controladores/empleo.php?op=listar',
				type: "get",
				dataType: "json",
				error: function (e) {

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
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../controladores/empleo.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			swal({
				title: 'Empleo',
				type: 'success',
				text: datos
			});
			$('#myModal').modal('hide');
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}

function mostrar(idempleo) {
	$.post("../controladores/empleo.php?op=mostrar", { idempleo: idempleo }, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);

		$("#idempleo").val(data.idempleo);
		$("#nombre").val(data.nombre);
		$("#empresa").val(data.empresa);

		$("#ubi_depa").val(data.ubi_depa).trigger("change");
		$.ajax({
			type: "post",
			url: "../controladores/empleo.php?op=get_allprovi",
			data: {
				depa: data.ubi_depa
			},
			success: function (response) {
				$("#ubi_provi").empty();
				let reply = JSON.parse(response);
				for (let i = 0; i < reply.length; i++) {
					let option = document.createElement("option");
					option.value = reply[i]["provi"];
					option.innerText = reply[i]["provi"];
					ubi_provi.appendChild(option);
				}
				$("#ubi_provi").val(data.ubi_provi);
			}
		});

		$("#nvacantes").val(data.nvacantes);
		$("#renumeracion").val(data.renumeracion);
		$("#fechainicio").val(data.fechainicio);
		$("#fechafin").val(data.fechafin);
		$("#experiencia").val(data.experiencia);
		$("#formacion").val(data.formacion);
		$("#especializacion").val(data.especializacion);
		$("#conocimiento").val(data.conocimiento);
		$("#competencia").val(data.competencia);
		$("#detalle").val(data.detalle);
		$("#destacado").val(data.destacado);
		$("#destacado").selectpicker('refresh');
	})

}

//Función para desactivar registros
function desactivar(idempleo) {
	swal({
		title: "¿Desactivar?",
		text: "¿Está seguro que desea desactivar el empleo?",
		type: "warning",
		showCancelButton: true,
		cancelButtonText: "No",
		cancelButtonColor: '#FF0000',
		confirmButtonText: "Si",
		confirmButtonColor: "#0004FA",
		closeOnConfirm: false,
		closeOnCancel: false,
		showLoaderOnConfirm: true
	}, function (isConfirm) {
		if (isConfirm) {
			$.post("../controladores/empleo.php?op=desactivar", { idempleo: idempleo }, function (e) {
				swal(
					'!!! Desactivado !!!', e, 'success')
				tabla.ajax.reload();
			});
		} else {
			swal("! Cancelado ¡", "Se cancelo la desactivacion del empleo", "error");
		}
	});
}

//Función para activar registros
function activar(idempleo) {
	swal({
		title: "¿Activar?",
		text: "¿Está seguro que desea activar el empleo?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#0004FA',
		confirmButtonText: "Si",
		cancelButtonText: "No",
		cancelButtonColor: '#FF0000',
		closeOnConfirm: false,
		closeOnCancel: false,
		showLoaderOnConfirm: true
	}, function (isConfirm) {
		if (isConfirm) {
			$.post("../controladores/empleo.php?op=activar", { idempleo: idempleo }, function (e) {
				swal("!!! Activarda !!!", e, "success");
				tabla.ajax.reload();
			});
		} else {
			swal("! Cancelado ¡", "Se cancelo la activacion del empleo", "error");
		}
	});
}

//Función para eliminar registros
function eliminar(idempleo) {
	swal({
		title: "Eliminar?",
		text: "¿Está seguro Que Desea eliminar el empleo?",
		type: "warning",
		showCancelButton: true,
		cancelButtonText: "No",
		cancelButtonColor: '#FF0000',
		confirmButtonText: "Si",
		confirmButtonColor: "#0004FA",
		closeOnConfirm: false,
		closeOnCancel: false,
		showLoaderOnConfirm: true
	}, function (isConfirm) {
		if (isConfirm) {
			$.post("../controladores/empleo.php?op=eliminar", { idempleo: idempleo }, function (e) {
				swal(
					'!!! Eliminado !!!', e, 'success')
				tabla.ajax.reload();
			});
		} else {
			swal("! Cancelado ¡", "Se Cancelo la eliminaciòn del empleo", "error");
		}
	});
}

init();