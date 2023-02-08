let tabla;

init = () => {
    listarCursos()
}

listarCursos = () => {
    tabla = $('#cursosTabla').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',  //Definimos los elementos del control de tabla
        "ajax": {
            url: '../controladores/trackingTable.php?documento=' + documento,
            type : "get",
            dataType : "json",						
            error: function(e) {
                console.log(e.responseText);	
            }
        },
        "columns": [
            { "width": "70%" },
            { "width": "30%" },
        ],
        "bDestroy": true,
        "iDisplayLength": 2,  
        "order": [[ 1, "desc" ]] 
    }).DataTable();
}

init();