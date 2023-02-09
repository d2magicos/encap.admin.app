document.addEventListener("DOMContentLoaded", function (event) {

    const _URL_ = document.querySelector("#url").value;

    let pagination = document.querySelector("#pagination_search");

    // PAGINATION
    let canti_empleos = 9;
    let set_empleos = () => {
        if (document.querySelector("#pagination_search")) {
            $.ajax({
                type: "get",
                url: _URL_ + 'home/get_empleosSearch/' + $("#name_empleo").val() + "/" + $("#name_depa").val(),
                beforeSend: function (params) {
                    $("#container_search").append(`
                        <div class="d-flex flex-column justify-content-center align-items-center" style="height:400px">
                            <div class="spinner-grow" style="width: 50px; height: 50px;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `)
                },
                success: function (response) {
                    let reply = JSON.parse(response);
                    if (reply["success"]) {
                        // Asignando valores al input y select
                        $("#search").val($("#name_empleo").val() == "todo" ? "" : $("#name_empleo").val());
                        $("#depa_select").val($("#name_depa").val()).trigger("change");
                        document.querySelector("#result_message").innerHTML = `Se encontraron ${reply["message"].length} ${reply["message"].length == 1 ? "resultado" : "resultados"} para:`;
                        document.querySelector("#text_search").innerHTML = ($("#name_empleo").val() == "todo" ? "todos los empleos" : $("#name_empleo").val()) + "<span class='text-secondary'> en </span>";
                        document.querySelector("#text_depa").innerHTML = ($("#name_depa").val() == "todo" ? "todo el país" : $("#name_depa").val()).toLowerCase();
                        let container = $('#pagination_search');
                        container.pagination({
                            dataSource: reply["message"],
                            pageSize: canti_empleos,
                            callback: function (data, pagination) {
                                $("#container_search").html("");
                                $.each(data, function (index, item) {
                                    $("#container_search").append(`
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <div class="card card_empleo h-100" style="width: auto;">
                                            <div class="card-header card-img-top bg-body d-flex justify-content-around align-items-center mb-3">
                                                <p class="text-center fw-bolder">${item.nombre}</p>
                                            </div>
                                            <div class="card-body mt-0 pt-0 pb-0 mb-0">
                                                <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-beetwen">
                                                        <i class="fa-solid fa-building"></i>
                                                        <label class="card-text">${item.empresa}</label>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-beetwen">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <label class="card-text">${item.ubi_depa}-${item.ubi_provi}</label>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-beetwen">
                                                        <i class="fa-solid fa-user"></i>
                                                        <label class="card-text">${item.nvacantes} ${item.nvacantes == 1 ? "vacante disponible" : "vacantes disponibles"}</label>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-beetwen">
                                                        <i class="fa-solid fa-dollar-sign"></i>
                                                        <label class="card-text">S/ ${item.renumeracion} Soles</label>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-beetwen">
                                                        <i class="fa-regular fa-calendar-check"></i>
                                                        <label class="card-text">Publicado el ${(item.fechainicio).split("-").reverse().join("/")}</label>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-beetwen">
                                                        <i class="fa-regular fa-calendar-xmark"></i>
                                                        <label class="card-text">Vigente hasta el ${(item.fechafin).split("-").reverse().join("/")}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="${_URL_}home/empleo/${(item.nombre.replaceAll(" ", "-").replaceAll("/", "-")).toLowerCase()}/${item.idempleo}" class="btn w-100">VER CONVOCATORIA</a>
                                            </div>
                                        </div>
                                    </div>
                                    `);
                                });
                            }
                        })
                        reply["message"].length == 0 ? pagination.parentElement.classList.add("d-none") : pagination.parentElement.classList.remove("d-none");
                    } else {
                        document.querySelector("#result_message").innerHTML = `Se encontraron ${reply["message"].length} ${reply["message"].length == 1 ? "resultado" : "resultados"} para:`;
                        document.querySelector("#text_search").innerHTML = ($("#name_empleo").val() == "todo" ? "todos los empleos" : $("#name_empleo").val()) + "<span class='text-secondary'> en </span>";
                        document.querySelector("#text_depa").innerHTML = ($("#name_depa").val() == "todo" ? "todo el país" : $("#name_depa").val()).toLowerCase();
                        $("#container_search").html(`
                            <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" style="height:400px;">
                                <i class="fa-regular fa-circle-xmark text-secondary mb-3" style="font-size:35px"></i>
                                <label class="fs-5">Sin resultados</label>
                                <a href="${_URL_}" class="link-warning fw-bold">Ir a inicio</a>
                            </div>
                        `)
                    }
                },
                complete: function (params) {
                }
            });
        }
    }
    set_empleos();
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