$("#frmAcceso").on('submit',function(e)
{
    e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();

    $.post("../controladores/usuario.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(data)
    {
        if (data!="null")
        {         
            $(location).attr("href","inicio.php");
        }
        else
        {
            swal("Usuario y/o Password incorrectos");
            //bootbox.alert("Usuario y/o Password incorrectos");
        }
    });
})