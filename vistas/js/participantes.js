var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#myModal").on("submit", function(e) {
        guardaryeditar(e);
    })

    //Cargamos los items al select TipoDocumento
    $.post("../controladores/persona.php?op=selectTipodocumento", function(r) {
        $("#idtipo_documento").html(r);
        $('#idtipo_documento').selectpicker('refresh');
    });

    //Cargamos los items al select pais
    $.post("../controladores/persona.php?op=selectPais", function(r) {
        $("#idpais").html(r);
        $('#idpais').selectpicker('refresh');
    });

}

//Función limpiar
function limpiar() {
    $("#nombre1").val("");
    $("#apellidos").val("");
    $("#num_documento").val("");
    $("#telefono").val("");
    $("#telefono2").val("");
    $("#email").val("");
    //$("#pais").val("");
    $("#departamento").val("");
    $("#ciudad").val("");
    $("#direccion").val("");
    $("#fecha_cumple").val("");
    $("#idpersona").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").show();
        $('#myModal').modal('show');
    } else {
        $("#listadoregistros").show();
        $("#btnagregar").show();
    }
}


function mostrarformDetalle(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").show();
        $('#myModalDetalle').modal('show');
    } else {
        $("#listadoregistros").show();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función cancelarform
function cancelarformDetalle() {

    mostrarformDetalle(false);
}

//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        "scrollY": "800px", //tamaño del scroll
        "scrollCollapse": true, //barra lateral Y
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'excelHtml5'
        ],
        "ajax": {
            url: '../controladores/persona.php?op=listarp',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}

//Función para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controladores/persona.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            swal({
                title: 'Participante',
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

function mostrar(idpersona) {
    $.post("../controladores/persona.php?op=mostrar", { idpersona: idpersona }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre1").val(data.nombre);
        $("#idpais").val(data.idpais);
        $("#idtipo_documento").val(data.idtipo_documento);
        $("#idtipo_documento").selectpicker('refresh');
        $("#num_documento").val(data.documento);
        $("#telefono").val(data.telefono);
        $("#telefono2").val(data.telefono2);
        $("#email").val(data.email);
        $("#pais").val(data.pais);
        $("#idpais").selectpicker('refresh');
        $("#departamento").val(data.departamento);
        $("#ciudad").val(data.ciudad);
        $("#direccion").val(data.direccion);
        $("#fecha_cumple").val(data.fecha_cumple);
        $("#idpersona").val(data.idpersona);
    })
}


function mostrarDetalle(idpersona) {
    $.post("../controladores/persona.php?op=mostrar", { idpersona: idpersona }, function(data, status) {
        data = JSON.parse(data);
        mostrarformDetalle(true);

        $("#nombre1").html(data.nombre);


        $("#num_documento").html(data.documento);
        $("#telefono").html(data.telefono);

        $("#email").html(data.email);

    })

    $.post("../controladores/persona.php?op=mostrarDetalle", { idpersona: idpersona }, function(data, status) {

        console.log(data);
        $("#tablacursos").html(data);



    })
}


//Función para desactivar registros
function desactivar(idpersona) {
    swal({
        title: "¿Desactivar?",
        text: "¿Está seguro que desea desactivar al participante?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: '#FF0000',
        confirmButtonText: "Si",
        confirmButtonColor: "#0004FA",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../controladores/persona.php?op=desactivar", { idpersona: idpersona }, function(e) {
                swal(
                    '!!! Desactivado !!!', e, 'success')
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se cancelo la desactivacion del participante", "error");
        }
    });
}

//Función para activar registros
function activar(idpersona) {
    swal({
        title: "¿Activar?",
        text: "¿Está seguro que desea activar al participante?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#0004FA',
        confirmButtonText: "Si",
        cancelButtonText: "No",
        cancelButtonColor: '#FF0000',
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../controladores/persona.php?op=activar", { idpersona: idpersona }, function(e) {
                swal("!!! Activarda !!!", e, "success");
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se cancelo la activacion del participante", "error");
        }
    });
}

//Función para eliminar registros
function eliminar(idpersona) {
    swal({
        title: "Eliminar?",
        text: "¿Está seguro que desea eliminar al participante?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: '#FF0000',
        confirmButtonText: "Si",
        confirmButtonColor: "#0004FA",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../controladores/persona.php?op=eliminar", { idpersona: idpersona }, function(e) {
                swal(
                    '!!! Eliminado !!!', e, 'success')
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se cancelo la eliminaciòn del participante", "error");
        }
    });
}

init();