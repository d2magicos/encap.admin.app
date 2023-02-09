import { Validate } from "../../../public/js/lib/validate.js";


document.addEventListener("DOMContentLoaded", function (event) {
    let validate = new Validate();
    let _URL_ = document.querySelector("#url");
    validate.allowInputNum(["#num_docu", "#celular"])
    validate.allowInputStringSpace(["#nombre"]);
    let form = document.querySelector("#form")
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(form);
        let reply_val = validate.validateData([
            formData.get("num_docu"), formData.get("nombre"),
            formData.get("celular"), formData.get("email"),
            formData.get("mensaje")
        ]);
        if (reply_val) {
            $.ajax({
                type: "post",
                url: "contactos/send_email",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    let reply = JSON.parse(response);
                    if (reply["success"]) {
                        $("#form").trigger("reset");
                        $("#modal").modal("show");
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: reply["message"],
                            position: "topCenter",
                            displayMode: 1
                        });
                    }
                }
            });
        } else {
            iziToast.error({
                title: 'Error',
                message: 'Rellene correctamente los campos',
                position: "topCenter",
                displayMode: 1
            });

        }
    })
});