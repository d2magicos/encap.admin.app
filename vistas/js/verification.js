let count = 0;

init = () => {
    $("#verificationForm").on("submit", (e) => {
        verify_code(e)
    })
}

verify_code = (e) => {
    e.preventDefault()

    let formData = new FormData($('#verificationForm')[0])

    console.log(formData)

    $.ajax({
        url: '../controladores/usuario.php?op=verify_code',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,

        success: function(data) {
            let objData = JSON.parse(data)
            //console.log(objData)
            
            if (objData.status) {
                $(location).attr("href", "inicio.php")
            } else {
                count++;
                //console.log(count)

                if (count < 4) {
                    swal("Verificación", objData.message, 'warning')
                } else {
                    swal("Error", "El código ha expirado", "error").then(
                        function() {
                            $.post("../controladores/usuario.php?op=destroy_session", function() {
                                console.log("Code expired")
                            })

                            window.location.href = "https://sistemas.encap.edu.pe/vistas/login.html"
                        }
                    )
                }
            }

            //console.log(objData.status)

            //swal("", "", "");
        }
    })
}

init()