function mostrar(idmodulo) {
    $.post("../controladores/modulo.php?op=mostrar", { idcategoria: idmodulo }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombre1").val(data.nombre);
        $("#etiqueta").val(data.etiqueta);
        $("#idcursos").val(data.idcategoria);

    })
}