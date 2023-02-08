let tabla;

init = () => {
    listarCursos();
}

listarCursos = () => {
    tabla = $('#tabla').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',  //Definimos los elementos del control de tabla
        "ajax": {
            url: '../controladores/intranet.php?idperson=' + personid,
            type : "get",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "columns": [
            { "width": "60%" },
            { "width": "20%" },
            { "width": "20%" },
        ],
        "bDestroy": true,
        "iDisplayLength": 4,  
        "order": [[ 2, "desc" ]] 
    }).DataTable();
}

init();