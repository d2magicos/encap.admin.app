    function uploadContacts()
    {
        var Form = new FormData($('#filesForm')[0]);
        $.ajax({

            url: "import.php",
            type: "post",
            data : Form,
            processData: false,
            contentType: false,
            success: function(data)
            {
                alert('Registros Agregados Correctamente!');
            }
        });
    }
    init();