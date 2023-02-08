let tabla;

init = () => {
    listarCursos();
    /* alert(personid) */
}

listarCursos = () => {
    tabla = $('#tabla').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',  //Definimos los elementos del control de tabla
        "ajax": {
            url: '../controladores/intranet-doc.php?idperson=' + personid,
            type : "get",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "iDisplayLength": 4,   //  Paginación
        "order": [[ 0, "desc" ]]    //  Ordenar (columna,orden)
    }).DataTable();
}

init();