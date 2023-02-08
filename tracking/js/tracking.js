init = () => {
    //listarCursos()
}

listarCursos = () => {
    //  let documento = '73256893'

    $.post("../controladores/tracking.php?op=getCursos", { documento }, (res) => {
		/* alert(res) */
        $('#courseSelect').html(res);
		$('#courseSelect').selectpicker('refresh');
	});
}

/* botón buscar */
$(document).on("click", "#btnSearch", function(e) {
    var codigo = $(this).attr('codigo');
    //  let codigo = $("#courseSelect").val()
    
    //  alert(codigo)

    $("#tracking-container").html("");

    $("#tracking-container").append(`
        <div class="course-tracking-container">
            <div class="course-tracking-state">
                <div class="row my-4">
                    <div class="col-4 text-center">
                        <div class="icon-phase">
                            <button id="phase-1" class="phase-icon"> 1 </button>
                            <i id="iconSuccess1" class="icon-success hide-icon fa-sharp fa-solid fa-circle-check"></i>
                            <i id="iconInProcess1" class="icon-inprocess hide-icon spin fa-solid icon-inprocess fa-spinner"></i>
                        </div>
                        <div>
                            <span class="phase-name">
                                <small>
                                    CONFIRMACIÓN </br>DE DESTINO
                                </small>
                            </span>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="icon-phase">
                            <button id="phase-2" class="phase-icon"> 2 </button>
                            <i id="iconSuccess2" class="icon-success hide-icon fa-sharp fa-solid fa-circle-check"></i>
                            <i id="iconInProcess2" class="icon-inprocess hide-icon spin fa-solid fa-spinner"></i>
                        </div>
                        <div>
                            <span class="phase-name">
                                <small>
                                    EN TRÁNSITO
                                </small>
                            </span>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="icon-phase">
                            <button id="phase-3" class="phase-icon"> 3 </button>
                            <i id="iconSuccess3" class="icon-success hide-icon fa-sharp fa-solid fa-circle-check"></i>
                            <i id="iconInProcess3" class="icon-inprocess hide-icon spin fa-solid fa-spinner"></i>
                        </div>
                        <div>
                            <span class="phase-name">
                                <small>
                                    DISPONIBLE PARA <br/>SU RECOJO
                                </small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="course-tracking-container">
            <div class="course-tracking">
                <div>
                    <div class="track-details">
                        <h5 class="text-center mb-1 fw-bold" style="color: rgba(255, 255, 255, .65);" id="tipo-curso"></h5>
                        <h4 class="fw-bold text-center mb-3" id="curso" style="color: skyblue;"></h4>
                        <div class="mt-2">
                            <div class="">
                                <div class="row text-center">
                                    <div class="destino-origen col" style="margin-right:13px">
                                        <div class="row">
                                            <div class="origen-bg col-12 col-lg-6 py-3 fw-bold">
                                                Origen:
                                            </div>
                                            <div class="col-12 col-lg-6 py-3 px-2 lbl-details">
                                                Huancayo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="destino-origen col">
                                        <div class="row">
                                            <div class="destino-bg col-12 col-lg-6 py-3 fw-bold">
                                                Destino:
                                            </div>
                                            <div class="col-12 col-lg-6 py-3 px-2">
                                                <span id="destino" class="lbl-details"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="col-6 title-des-org py-2 fw-bold">Origen: Huancayo</div>
                                    <div class="col-6 title-des-org py-2 fw-bold">Destino</div>
                                    <div class="col-6 py-2"><nav>Huancayo</nav></div>
                                    <div class="col-6 py-2" id="destino"><nav></nav></div>-->
                                </div>
                            </div>
                        </div>
                        <div class="tracking-details">
                            <table class="table-details" id="table-details">
                                <tr>
                                    <th class="title text-end">Empresa courier :</th>
                                    <th class="description lbl-details" id="courier"></th>
                                </tr>
                                <tr>
                                    <th class="title text-end">Dirección de envío :</th>
                                    <th class="description lbl-details" id="direccion_envio"></th>
                                </tr>
                                <tr>
                                    <th class="title text-end">Clave :</th>
                                    <th class="description lbl-details" id="clave"></th>
                                </tr>
                                <tr>
                                    <th class="title text-end">Fecha de envío :</th>
                                    <th class="description lbl-details" id="fechaEnvio"></th>
                                </tr>
                                <tr>
                                    <th class="title text-end labelFecRecojo">Fecha de recojo :</th>
                                    <th class="description lbl-details" id="fechaRecojo"></th>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);

    /*  */
    $.get("../controladores/tracking.php?op=getTrackingDetails", { codigo }, (res) => {
        //console.log(res)
        let data = JSON.parse(res)
        
        let _dtFormatEnvio = (data["3"] != null) ? changeFormatDate(data["3"]) : ""
        let _dtFormatRecojo = (data["5"] != null && data["5"] != "") ? changeFormatDate(data["5"]) : ""

        let curso = data["0"]
        let destino = data["1"] != "" ? data["1"] : "Por definir"
        let courier = (data["2"] != "" && data["2"] != "Seleccionar") ? data["2"] : "Por definir"
        let fechaEnvio = (data["3"] != null && data["3"] != "") ? (_dtFormatEnvio) : "Por definir"
        let clienteContactado = data["4"] != "" ? data["4"] : "No contactado"
        let fechaRecojo = data["5"] != "" ? (_dtFormatRecojo) : "Por definir"
        let clave = (data["6"] != null && data["6"] != "") ? data["6"] : "Por definir"
        let categoria = (data["7"] != null && data["7"] != "") ? data["7"] : "CURSO"
        let btnTracking = (data["8"] != null && data["8"] != "") ? data["8"] : ""
        let btnTrackInfo = (data["9"] != null && data["9"] != "") ? data["9"] : ""
        let lugar_envio = (data["10"] != null && data["10"] != "") ? data["10"] : "Por definir"

        /* console.log(data["8"]) */

        /* buttons */
        let btnPhase1 = document.getElementById('phase-1')
        let btnPhase2 = document.getElementById('phase-2')
        let btnPhase3 = document.getElementById('phase-3')

        /* icons */
        let iconSuccess1 = document.getElementById('iconSuccess1')
        let iconSuccess2 = document.getElementById('iconSuccess2')
        let iconSuccess3 = document.getElementById('iconSuccess3')

        let iconIP1 = document.getElementById('iconInProcess1')
        let iconIP2 = document.getElementById('iconInProcess2')
        let iconIP3 = document.getElementById('iconInProcess3')

        /*  */
        let labelDatSucess = document.querySelector('.labelFecRecojo')
        let dateSucess = document.getElementById('fechaRecojo')

        /* comparación de fechas */

        let _fechaEnvio = changeFormatDate2(data["5"])
        let _fechaNow = getDateNow()

        let _estadoenvio = compareDates(_fechaNow, _fechaEnvio)
        
        /* validaciones */

        /* CONFIRMACION DE DATOS */
        if (clienteContactado !== "No contactado") {
            /*  */
            $('#tracking-container').css('display', 'block')
            $('#tracking-container').css('opacity', '1')

            if (destino != "Por definir") {
                btnPhase1.classList.add('current')
                btnPhase2.classList.remove('current')
                btnPhase3.classList.remove('current')

                /*  */
                //  iconErr1.classList.remove('hide-icon')

                iconSuccess1.classList.remove('hide-icon')
                iconSuccess1.classList.add('show-icon')

                iconIP2.classList.remove('hide-icon')
                iconIP2.classList.add('show-icon')

                iconIP3.classList.remove('hide-icon')
                iconIP3.classList.add('show-icon')

                if (fechaEnvio != "Por definir") {
                    /*  */
                    btnPhase1.classList.remove('current')
                    btnPhase2.classList.add('current')
                    btnPhase3.classList.remove('current')
                    
                    /*  */
                    iconSuccess2.classList.remove('hide-icon')
                    iconSuccess2.classList.add('show-icon')

                    iconIP2.classList.remove('show-icon')
                    iconIP2.classList.add('hide-icon')

                    iconIP3.classList.remove('hide-icon')
                    iconIP3.classList.add('show-icon')

                    /*  */
                    labelDatSucess.classList.add('date-inprocess')
                    dateSucess.classList.add('date-inprocess')

                    if (_estadoenvio == "Ya puede recogerlo") {
                        btnPhase1.classList.remove('current')
                        btnPhase2.classList.remove('current')
                        btnPhase3.classList.add('current')
                        
                        /*  */
                        iconSuccess3.classList.remove('hide-icon')
                        iconSuccess3.classList.add('show-icon')

                        iconIP3.classList.remove('show-icon')
                        iconIP3.classList.add('hide-icon')

                        /*  */
                        labelDatSucess.classList.add('date-success')
                        dateSucess.classList.add('date-success')

                        //verModal('#modalAvisoTwo')
                    }
                }
            } else {
                iconIP1.classList.remove('hide-icon')
                iconIP1.classList.add('show-icon')

                iconIP2.classList.remove('hide-icon')
                iconIP2.classList.add('show-icon')

                iconIP3.classList.remove('hide-icon')
                iconIP3.classList.add('show-icon')
            } 
        } else {
            $('#tracking-container').css('display', 'block')
            $('#tracking-container').css('opacity', '1')

            iconIP1.classList.remove('hide-icon')
            iconIP1.classList.add('show-icon')

            iconIP2.classList.remove('hide-icon')
            iconIP2.classList.add('show-icon')

            iconIP3.classList.remove('hide-icon')
            iconIP3.classList.add('show-icon')

            verModal('#modalAvisoOne')
        }

        document.getElementById("tipo-curso").innerHTML = categoria
        document.getElementById("curso").innerHTML = curso
        document.getElementById("destino").innerHTML = destino
        document.getElementById("courier").innerHTML = courier + "<br>" + btnTrackInfo + " " + btnTracking
        document.getElementById("fechaEnvio").innerHTML = fechaEnvio
        document.getElementById("fechaRecojo").innerHTML = fechaRecojo
        document.getElementById("clave").innerHTML = clave
        document.getElementById("direccion_envio").innerHTML = lugar_envio
    })
})

verModal = (modalID) => {
    $(modalID).modal('show')
}

changeFormatDate = (strDate) => {
    let date = strDate.split('-').join('/')
    let dateFormat = new Date(date).toLocaleDateString('es-pe', { weekday: "long", year: "numeric", month: "short", day: "numeric" })

    return dateFormat
}

changeFormatDate2 = (strDate) => {
    let date = strDate.split('-').join('/')
    //let dateFormat = new Date(date).toLocaleDateString()

    return date
}

getDateNow = () => {
    let now = new Date()

    return now.getFullYear() + '/' + (now.getMonth() + 1) + '/' + now.getDate()
}

compareDates = (hoy, recojo) => {
    let res = ""
    /* console.log(hoy)
    console.log(recojo) */
    let dhoy = new Date(hoy)
    let drecojo = new Date(recojo)

    /* console.log(dhoy, ' ', drecojo) */

    /* if (recojo != null && recojo != "") {
        if (hoy >= recojo) {
            res = "Ya puede recogerlo"
            console.log("Ya puede recogerlo")
        } else {
            res = "En tránsito"
            console.log("En tránsito")
        }
    } else {
        res = "En tránsito"
        console.log("En tránsito")
    } */

    if (drecojo != null && drecojo != "") {
        if (dhoy >= drecojo) {
            res = "Ya puede recogerlo"
            console.log("Ya puede recogerlo")
        } else {
            res = "En tránsito"
            console.log("En tránsito")
        }
    } else {
        res = "En tránsito"
        console.log("En tránsito")
    }
    
    return res
}

init();