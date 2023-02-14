function init() {

    listar();
    limpiar();

}

var band = false;
$(document).ready(function() {
    $('#descripcion').keyup(function() {
        var value = $(this).val();
        $('#section_put').hide();
        if (value.length < 3) {
            return false;
        }
        var query = $(this).val();
        console.log(query);
        if (query != '') {
            $.ajax({
                url: "../controladores/searchproductsactivos.php",
                method: "POST",
                data: { query: query },
                success: function(data) {

                    $('#productslist').fadeIn();
                    $('#productslist').html(data);


                }
            });
        }
    });
    $(document).on('click', '#lista', function() {
        var nombre = $(this).attr('name');
        var nombres = nombre.split("|");
        console.log(nombres);
        $('#descripcion').val(nombres[1]);
        $('#idcurso').val(nombres[0]);
        console.log(nombres[1]);
        $('#descripcion').readonly = true;
        $('#productslist').fadeOut();
        $('#section_put').show();

        ListarModulos();


    });
    $(document).on("focusout", "#descripcion", function() {
        $('#descripcion').readonly = true;
        $('#productslist').fadeOut();
    });



});


function ListarModulos() {
    var idcurso = $("#idcurso").val();
    console.log(idcurso);
    $.ajax({
        url: "../controladores/curso.php?op=listarM2",
        method: "POST",
        data: { idcurso: idcurso },
        success: function(data) {


            $('#idcursos').html(data);
            $("#idcurso").val($("#idcursos").find("option:first-child").val());

        }
    });

}


$('#idcursos').on('change', function() {
    $("#idcurso").val(this.value);

});




function guardaryeditarLecciones() {

    var formData = new FormData($("#formulariolec")[0]);

    $.ajax({
        url: "../controladores/lecciones.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            swal({
                title: 'Leccion',
                type: 'success',
                text: datos
            });
            $('#myModal').modal('hide');
            tabla.ajax.reload();
        }

    });
    limpiar();
}


//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        //"scrollY":"800px",//tamaño del scroll
        "scrollCollapse": true, //barra lateral Y
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'excelHtml5'
        ],
        "ajax": {
            url: '../controladores/lecciones.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación 10
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}


//Función para eliminar registros
function eliminar(idleccion) {
    //   document.getElementById("idcurso2").val = idleccion;
    swal({
        title: "Eliminar?",
        text: "¿Está seguro Que Desea Eliminar la leccion?",
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
            $.post("../controladores/lecciones.php?op=eliminar", { idleccion: idleccion }, function(e) {
                console.log(idleccion);
                swal(
                    '!!! Eliminado !!!', e, 'success')
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la eliminaciòn de la leccion", "error");
        }
    });
}

function mostrar(idleccion) {
    $.post("../controladores/lecciones.php?op=mostrar", { idleccion: idleccion }, function(data, status) {
        data = JSON.parse(data);
        console.log(data);
        mostrarform(true);
        $("#idc").val(data.idcurso);
        $("#idleccion").val(data.idlecciones);
        $("#descripcion").val(data.curso);
        $("#descripcion").prop("disabled", true);
        $("#lec_titulo").val(data.leccion);
        $('#section_put').show();
        $("#lec_html").val(htmlDecode(data.codigohtml));
        $("#idcurso").val(data.idmodulo);
        $("#duracion").val(data.duracion);
        $("#video").val(data.link_video);
        $("#material").val(data.link_material);
        $("#examen").val(data.link_examen);

        let modulo = data.idmodulo;


        var idc = $("#idc").val();

        $.post("../controladores/lecciones.php?op=listarM2", { idc: idc }, function(data) {


            $("#idcursos").html(data);
            //$("#idcursos").selectpicker('refresh');

            $("#idcursos").val(modulo).change();
            console.log(modulo)
            $("#idcursos").selectpicker('refresh');

        });

        //  ListarModulos();
        /* */

    });





};


function htmlDecode(input) {
    var doc = new DOMParser().parseFromString(input, "text/html");
    return doc.documentElement.textContent;
}


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

function limpiar() {
    console.log("limpiar")
    $("#idc").val("");
    $("#idleccion").val("");
    $("#descripcion").val("");
    $("#descripcion").prop("disabled", false);
    $("#lec_titulo").val("");
    $('#section_put').hide();
    $("#lec_html").val("");
    $("#idcurso").val("");
    $("#duracion").val("");
    $("#video").val("");
    $("#material").val("");
    $("#examen").val("");

}

function cancelarform() {
    limpiar();
    mostrarform(false);
}
init();