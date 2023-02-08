
$(document).on("click", "#btnTrackingInfo", function(e) {
    let matricula = $(this).attr('matricula');

    $.get("../controladores/tracking.php?op=getTrackingInfo", { matricula }, function(res) {
        let data = JSON.parse(res)

        console.log(data["0"])

        let arrData = data["0"].split(" ")
        /* let arrNew = []

        for (let i = 0; i < arrData.length; i++) {
            arrNew[i] = [arrData[i] + " " + arrData[i+1]]
        }

        console.log(arrNew) */

        $("#trackinginfo-container").html("");

        $("#trackinginfo-container").append(`
            <div>
                <div class="info-tracking-container">
                    <div class="info-track-header">
                        <h5 class="mb-2" style="color: #c1bfbd; font-weight: 600;">Informaci&oacute;n de seguimiento </h5>
                    </div>
                    <div class="info-track-body">
                        <p class="lblBlack mb-2 pt-1" style="font-weight: 500; text-align: justify;">La siguiente informaci&oacute;n es importante para que usted pueda realizar seguimiento de su env&iacute;o en la empresa courier.</p>
                        <div class="text-center lblInfo pt-3 pb-2 fw-bold">
                            ${data[0]}
                        </div>
                    </div>
                </div>
            </div>
        `);
    })
})