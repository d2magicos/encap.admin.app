import { Validate } from "../../../public/js/lib/validate.js";
import { PDF } from "../../../public/js/lib/pdf.js";

document.addEventListener("DOMContentLoaded", function (event) {

    const _URL_ = document.querySelector("#url").value;
    const validate = new Validate();
    const DateTime = luxon.DateTime;
    const date_now = new Date();
    const pdf = new PDF();

    // DATE
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
    const dayNames = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"]
    let date = document.querySelector(".date");
    if (date) {
        date.innerHTML = `${dayNames[date_now.getDay()]} ${date_now.getDate()} de ${monthNames[date_now.getMonth()]} del ${date_now.getFullYear()}`;
        // TIME
        const time = document.querySelector(".time");
        const getTimeClock = () => {
            const date_nowt = new Date();
            time.innerHTML = `
            ${date_nowt.getHours() < 10 ? "0" + date_nowt.getHours() : date_nowt.getHours()}:
            ${date_nowt.getMinutes() < 10 ? "0" + date_nowt.getMinutes() : date_nowt.getMinutes()}:
            ${date_nowt.getSeconds() < 10 ? "0" + date_nowt.getSeconds() : date_nowt.getSeconds()}`;
        }
        setInterval(getTimeClock, 1000);
    }

    // PAGINATION
    let set_scroll_tops = () => {
        let heightParent = document.querySelector("#container").clientHeight;
        let height, overflowY;
        if (heightParent < 800) {
            height = "300px";
            overflowY = "scroll"
        } else {
            height = "100%";
            overflowY = "hidden"
        }
        document.querySelector(".list_departamentos").style.maxHeight = height;
        document.querySelector(".list_departamentos").style.overflowY = overflowY;
        document.querySelector(".list_provincias").style.maxHeight = height;
        document.querySelector(".list_provincias").style.overflowY = overflowY;
    }
    let canti_empleos = 9;
    let set_empleos = () => {
        if (document.querySelector("#pagination")) {
            $.ajax({
                type: "get",
                url: _URL_ + 'home/get_all_empleos',
                beforeSend: function (params) {
                    $("#container").append(`
                        <div class="d-flex flex-column justify-content-center align-items-center" style="height:400px">
                            <div class="spinner-grow" style="width: 50px; height: 50px;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `)
                },
                success: function (response) {
                    let reply = JSON.parse(response);
                    let container = $('#pagination');
                    container.pagination({
                        dataSource: reply["message"],
                        pageSize: canti_empleos,
                        callback: function (data, pagination) {
                            $("#container").html("");
                            $.each(data, function (index, item) {
                                let message_destacado = `<span class="badge info_destacado position-absolute">DESTACADO</span>`
                                $("#container").append(`
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <div class="card card_empleo position-relative h-100" style="width: auto;">
                                        <div class="card-header card-img-top bg-body d-flex justify-content-around align-items-center mb-3">
                                            <p class="text-center fw-bolder">${item.nombre}</p>
                                        </div>
                                        <div class="card-body mt-0 pt-0 pb-0 mb-0">
                                            <div class="row">
                                                <div class="col-md-12 d-flex">
                                                    <i class="fa-solid fa-building"></i>
                                                    <label class="card-text">${item.empresa}</label>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <label class="card-text">${item.ubi_depa} - ${item.ubi_provi}</label>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <i class="fa-solid fa-user"></i>
                                                    <label class="card-text">${item.nvacantes} ${item.nvacantes == 1 ? "vacante disponible" : "vacantes disponibles"}</label>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                    <label class="card-text">S/ ${item.renumeracion} Soles</label>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <i class="fa-regular fa-calendar-check"></i>
                                                    <label class="card-text">Publicado el ${(item.fechainicio).split("-").reverse().join("/")}</label>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <i class="fa-regular fa-calendar-xmark"></i>
                                                    <label class="card-text">Vigente hasta el ${(item.fechafin).split("-").reverse().join("/")}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="${_URL_}home/empleo/${(item.nombre.replaceAll(" ", "-").replaceAll("/", "-")).toLowerCase()}/${item.idempleo}" class="btn w-100">VER CONVOCATORIA</a>
                                        </div>
                                        ${item.destacado == 1 ? message_destacado : ""}
                                    </div>
                                </div>
                                `);
                            });
                        },
                        afterPageOnClick: function () {
                            set_scroll_tops();
                        },
                        afterInit: function () {
                            set_scroll_tops();
                        }
                    })
                },
                complete: function (params) {
                }
            });
        }
    }
    set_empleos()

    // Descargar PDF
    let btn_download = document.querySelector("#btn_download");
    let id_empleo = document.querySelector("#id_empleo");
    if (btn_download) {
        btn_download.addEventListener("click", (e) => {
            $.ajax({
                type: "post",
                url: _URL_ + "home/get_empleoForID",
                data: {
                    "id_empleo": id_empleo.value
                },
                success: function (response) {
                    let reply = JSON.parse(response);
                    if (reply["success"]) {
                        pdf.generarPDFEmpleo(reply["message"]);
                    }
                }
            });
        })
    }

    window.addEventListener("resize", (e) => {
        if (window.innerWidth >= 500 && window.innerWidth <= 950) {
            canti_empleos = 6;
        } else if (window.innerWidth <= 500) {
            canti_empleos = 3;
        } else {
            canti_empleos = 9;
        }
        set_empleos()
    })
});