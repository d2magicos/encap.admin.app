let divLoading = document.querySelector('#divLoading');

$("#frmAcceso").on('submit', function (e) {
    e.preventDefault();
    logina = $("#logina").val();
    clavea = $("#clavea").val();

    divLoading.style.display = "flex";

    $.post("../controladores/usuario.php?op=verificar",
        { "logina": logina, "clavea": clavea },
        function (data) {
            //console.log(data)

            $("#btnSignIn").attr('disabled', 'disabled')

            if (data != "null") {
                $(location).attr("href", "verification.php")
            } else {
                swal("Usuario y/o contraseè´–a incorrecto.")
                $("#btnSignIn").removeAttr('disabled')
                divLoading.style.display = "none";
            }
        });
})
