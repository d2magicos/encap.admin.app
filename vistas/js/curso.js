var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    limpiar();

    $("#myModal").on("submit", function(e) {
            guardaryeditar(e);
        })
        //Cargamos los items al select categoria
    $.post("../controladores/curso.php?op=selectCategoria", function(r) {
        $("#idcategoria").html(r);
        $('#idcategoria').selectpicker('refresh');



    });


    $.post("../controladores/curso.php?op=selectSubCategoria", function(r) {
        $("#idsubcategoria").html(r);
        $('#idsubcategoria').selectpicker('refresh');
        console.log(r)

    });

    // //Cargamos los items al select participante
    $.post("../controladores/curso.php?op=id", function($id) {
        //$("#id").html(r);
        $('#id').val($id);

    });

}

//Función limpiar
function limpiar() {
    $("#cod_curso").val("");
    $("#nombre1").val("");
    $("#docente").val("");
    $("#temario1").val("");
    $("#contexto").val("");
    $("#examen").val("");
    $("#n_horas").val("");
    $("#fecha_inicio").val("");
    $("#cursoenvivo").val("");
    $("#observaciones").val("");
    $("#idcurso").val("");
    $("#enlace").val("");
    $("#id").val("");
    $("#imagen").val("");
    $("#walink").val("");
    $("#imagenmuestra").attr("src", "");
    $.post("../controladores/curso.php?op=id", function($id) {
        //$("#id").html(r);
        $('#id').val($id);

    });
}

//Función limpiar Modulo
function limpiarModulo() {


    $("#modulos1").val("");
    $("#nombrem1").val("");
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



//Función mostrar formulario
function mostrarformModulo(flag) {
    limpiarModulo();
    if (flag) {
        $("#listadoregistros").show();
        $('#myModalModulos').modal('show');
    } else {
        $("#listadoregistros").show();
        $("#btnagregar").show();
    }
}



function mostrarModulo(idcurso) {

    valor = "";
    console.log(idcurso);
    $.post("../controladores/curso.php?op=mostrar", { idcurso: idcurso }, function(data, status) {
        data = JSON.parse(data);
        mostrarformModulo(true);
        console.log(data);
        $("#idcurso2").val(data.idcurso);
        $("#cod_curso2").val(data.cod_curso);
        listarModulo(idcurso);

    })


}


//Función mostrar formulario
function mostrarformLeccion(flag) {
    limpiarModulo();
    if (flag) {
        $("#listadoregistros").show();
        $('#myModalLec').modal('show');
    } else {
        $("#listadoregistros").show();
        $("#btnagregar").show();
    }
}




function mostrarLeccion(idcurso, nombre) {
    $('#myModalModulos').hide();
    $('#myModalLec').show()

    $("#idcursom").val(idcurso);
    $('#descripcion').val(nombre);
    mostrarformLeccion(true);
    //ListarModulos(idcurso);



};

function mostrardatosleccion(idleccion) {
    $.post("../controladores/lecciones.php?op=mostrar", { idleccion: idleccion }, function(data, status) {
        data = JSON.parse(data);

        $('#myModalModulos').hide();
        $('#myModalLec').show();
        mostrarformLeccion(true);
        //    $("#idc").val(data.idcurso);
        $("#idleccion").val(data.idlecciones);
        $("#descripcion").val(data.curso);
        $("#descripcion").prop("disabled", true);
        $("#lec_titulo").val(data.leccion);
        $('#section_put').show();
        $("#lec_html").val(htmlDecode(data.codigohtml));
        $("#idcursom").val(data.idmodulo);
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



function guardaryeditarLecciones() {

    var formData = new FormData($("#formulariolec")[0]);
    let idcurso = $("#idcurso").val();

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
            cancelarforml();

        }

    });
    limpiarLecciones();
}

function limpiarLecciones() {
    console.log("limpiar")

    $("#lec_titulo").val("");
    $("#idleccion").val("");
    $("#lec_html").val("");
    $("#idcurso").val("");
    $("#duracion").val("");
    $("#video").val("");
    $("#material").val("");
    $("#examen").val("");

}

function ListarModulos(idcurso) {

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

function listarModulo(idcurso) {
    //editar modulos
    $.post("../controladores/curso.php?op=listarM", { idcurso: idcurso }, function(data2, status) {
        data2 = JSON.parse(data2);
        console.log(data2)
        let valor = "<input style='display:none;width:100%' class='form-control' name='nombrem2' id='nombrem2' ></input><input style='display:none' class='form-control' name='idm2' id='idm2' ></input><table role='grid' class='table table-striped table-bordered table-condensed table-hover dataTable'><thead><tr><th class='sorting' colspan='1'>Nombre del Modulo</th><th colspan='1'>Acciones</th></tr></thead>";
        for (let i = 0; i < data2.length; i++) {
            valor += "<tr><td><p id='p" + i + "'><b>" + data2[i][0] + "</b></p><input oninput=Copy(this.id) style='display:none;width:100%' id='inp" + i + "'  value='" + data2[i][0] + "'></input>" + "<div id='mlecc" + data2[i][1] + "' ></div><hr><div></div></td>" +

                "<td><button id='btne" + i + "' type='button' class='btn btn-warning btn-xs'  onclick=\"editarModulo(\'" + i + "\',\'" + data2[i][1] + "\')\"><i class='fa fa-pencil'></i></button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-info btn-xs' onclick='mostrarLeccion(\"" + data2[i][1] + "\",\"" + data2[i][0] + "\")' ><i class='fa fa-file'></i></button><button class='btn btn-success btn-xs' type='button' id='btng" + i + "' style='display:none' onclick=\"guardarModulo(\'" + data2[i][1] + "\')\">Guardar</button>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger btn-xs' type='button' onclick=\"eliminarModulo(\'" + data2[i][1] + "\')\"><i class='fa fa-close'></i></button></td></tr>";
            $("#modulos1").val(valor);

        }
        valor += "</table>     ";
        document.getElementById("modulos1").innerHTML = valor;

    })

    //listarlecciones
    let conta = 0;
    let modulos = [];
    let valorl = "";
    $.post("../controladores/curso.php?op=listarL", { idcurso: idcurso }, function(data3, status) {
        data3 = JSON.parse(data3);



        for (let i = 0; i < data3.length; i++) {
            modulos.push(data3[i][1]);

        }

        modulos = removeDuplicates(modulos);


        for (let i = 0; i < modulos.length; i++) {
            let data4 = groupByKey(data3, 1);
            conta++;

            for (let j = 0; j < data4[modulos[i]].length; j++) {



                valorl += "<div class='col-sm-9'><p>&nbsp;&nbsp;" + conta + "-" + (j + 1) + ".- " + data4[modulos[i]][j][0] + "</p><br></div><div class='col-sm-3'><button type='button' class='btn btn-warning btn-xs' onclick=\"mostrardatosleccion('" + data4[modulos[i]][j][2] + "')\"><i class='fa fa-pencil'></i></button>" +
                    "&nbsp;&nbsp;<button type='button' class='btn btn-danger btn-xs' onclick=\"eliminarLeccion('" + data4[modulos[i]][j][2] + "','" + idcurso + "')\"><i class='fa fa-close'></i></button></div>";
            }
            $("#mlecc" + modulos[i]).html(valorl);
            valorl = "";


        }

    })
}


//Función para eliminar registros
function eliminarLeccion(idleccion, idcurso) {
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
                listarModulo(idcurso)
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la eliminaciòn de la leccion", "error");
        }
    });
}

function groupByKey(array, key) {
    return array
        .reduce((hash, obj) => {
            if (obj[key] === undefined) return hash;
            return Object.assign(hash, {
                [obj[key]]: (hash[obj[key]] || []).concat(obj)
            })
        }, {})
}

function removeDuplicates(arr) {
    let unique = arr.reduce(function(acc, curr) {
        if (!acc.includes(curr))
            acc.push(curr);
        return acc;
    }, []);
    return unique;
}

function htmlDecode(input) {
    var doc = new DOMParser().parseFromString(input, "text/html");
    return doc.documentElement.textContent;
}

function eliminarModulo(idmodulo) {
    valor = "";
    idcurso = $("#idcurso2").val();

    swal({
        title: "¿Eliminar?",
        text: "¿Está seguro Que Desea Eliminar el modulo?",
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
            $.post("../controladores/curso.php?op=eliminarm", { idcurso: idmodulo }, function(data, status) {

                console.log(data);
                swal(
                    'Eliminado', 'Se elimino el modulo.', 'success')

            })

            listarModulo(idcurso);
        } else {
            swal("Cancelado", "No se borro el Modulo", "error");
        }
    });





}

function editarModulo(id, idm) {

    valor = "#inp" + id;
    valor2 = "#btng" + id;
    valor3 = "#btne" + id;
    valor4 = "#p" + id;
    console.log($(valor));

    $(valor).show();
    $(valor2).show();
    $(valor3).hide();
    $(valor4).hide();
    $("#idm2").val(idm);
    //Refrescar()
    mostrarformModulo(idm);
}

function Refrescar() {
    $("#modulos1").load(location.href + " #modulos1");

}


function Copy(id) {
    console.log(id);
    valor = $("#" + id).val();
    if (valor.length <= 0) {
        $("#nombrem2").val("");
    } else {
        $("#nombrem2").val(valor);
    }


}


function guardarModulo(idmodulo) {


    nombre = $("#nombrem2").val();
    idcurso = $("#idcurso2").val();

    var formData = new FormData($("#formularioModulo")[0]);

    console.log(formData)

    $.ajax({
        url: "../controladores/curso.php?op=guardarm",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            swal({
                title: 'Modulos',
                type: 'success',
                text: datos
            });
            listarModulo(idcurso)
        }

    });



}


//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}


function cancelarformM() {
    limpiar();
    //  mostrarformModulo(false);
    $('#myModalModulos').modal("hide")
    $('#myModalLec').modal("hide")
    $('.modal-backdrop fade in').remove();
}


function cancelarforml() {
    idcurso = $("#idcurso2").val();
    limpiarLecciones();
    $('#myModalLec').hide();
    $('#myModalModulos').show()

    mostrarformLeccion(false);
    listarModulo(idcurso)
}

$('#myModalLec').on('hidden.bs.modal', function() {
    console.log("se oculto")
});

$('#myModalLec').on('hidden', function() {
    console.log("se oculto")
});

$('#myModalLec').is(":hidden", function() {
    console.log("se ocultoSS")
});

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
            url: '../controladores/curso.php?op=listarc',
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

//Función para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controladores/curso.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            swal({
                title: 'Cursos',
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


function guardaryeditarModulo() {

    var formData = new FormData($("#formularioModulo")[0]);
    var numero = $("#idcurso2").val();

    if ($("#nombrem1").val().length == 0) {
        swal({
            title: 'Modulo',
            type: 'error',
            text: "Complete el nombre del modulo"
        });
        listarModulo();
        return false;
    }

    $.ajax({
        url: "../controladores/curso.php?op=guardaryeditarModulo",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            swal({
                title: 'Modulo',
                type: 'success',
                text: datos
            });
            //  $('#myModalModulo').modal('hide');
            // mostrarform(false);
            //  tabla.ajax.reload();
            $("#nombrem1").val("");

        }

    });



    listarModulo(numero);


}

function mostrar(idcurso) {
    $.post("../controladores/curso.php?op=mostrar", { idcurso: idcurso }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idcurso").val(data.idcurso);
        $("#cod_curso").val(data.cod_curso);
        $("#nombre1").val(data.nombre);
        $("#idcategoria").val(data.idcategoria);
        $("#idcategoria").selectpicker('refresh');
        $("#idsubcategoria").val(data.idsubcategoria);
        $("#idsubcategoria").selectpicker('refresh');
        $("#n_horas").val(data.n_horas);
        $("#fecha_inicio").val(data.fecha_inicio);
        $("#docente").val(data.docente);
        $("#temario1").val(data.temario);
        $("#descripcionc").val(data.descripcion_curso);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../Imagenes_cursos/" + data.imagen_curso);
        $("#imagenactual").val(data.imagen_curso);
        $("#cursoenvivo").val(data.cursoenvivo);
        $("#contexto").val(data.contexto);
        $("#examen").val(data.examen);
        $("#observaciones").val(data.observaciones);
        $("#enlace").val(data.enlace);
        $("#walink").val(data.walink);
        $("#aula").val(data.aula);
    })
}


//Función para desactivar registros
function desactivar(idcurso) {
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../controladores/curso.php?op=desactivar", { idcurso: idcurso }, function(e) {
                swal(
                    '!!! Desactivado !!!', e, 'success')
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la desactivacion del Producto", "error");
        }
    });
}

//Función para activar registros
function activar(idcurso) {
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../controladores/curso.php?op=activar", { idcurso: idcurso }, function(e) {
                swal("!!! Activarda !!!", e, "success");
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la activacion del Producto", "error");
        }
    });
}

//Función para eliminar registros
function eliminar(idcurso) {
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../controladores/curso.php?op=eliminar", { idcurso: idcurso }, function(e) {
                swal(
                    '!!! Eliminado !!!', e, 'success')
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la eliminaciòn del Curso", "error");
        }
    });
}

init();