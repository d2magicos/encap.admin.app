
document.addEventListener("DOMContentLoaded", function (event) {

    new WOW().init();
    AOS.init();
    let _URL_ = document.querySelector("#url").value;

    // Select global
    document.querySelectorAll('.depa_select').forEach((el) => {
        let settings = {};
        new TomSelect(el, settings);
    });

    //Autofocus Select2
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    let forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    // Buscador
    let button_search = document.querySelectorAll(".button_search");
    button_search.forEach((btn) => {
        btn.addEventListener("click", () => {
            event.preventDefault();
            let search = document.querySelectorAll("#search");
            let depa_select = document.querySelectorAll("#depa_select");
            let busqueda, depa;
            for (let i = 0; i < search.length; i++) {
                if (search[i].value.length != 0) {
                    busqueda = search[i].value;
                    break;
                } else { busqueda = "todo"; }
            }
            for (let x = 0; x < depa_select.length; x++) {
                if (depa_select[x].value.length != 0) {
                    depa = depa_select[x].value;
                    break;
                } else { depa = "todo"; }
            }
            window.location.href = _URL_ + "home/search/" + busqueda + "/" + depa;
        })
    })

    // Anuncios
    let div_parentAnuncio = document.querySelector("#div_parentAnuncio");
    if (div_parentAnuncio) {
        let device;
        $.ajax({
            type: "get",
            url: _URL_ + "home/get_anuncios",
            beforeSend: function (e) {
                div_parentAnuncio.innerHTML = `<div class="text-center">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>`;
            },
            success: function (response) {
                let reply = JSON.parse(response);
                if (reply["success"]) {
                    set_anuncio(reply["message"])
                    window.addEventListener("resize", (e) => {
                        set_anuncio(reply["message"])
                    })
                }
                if (div_parentAnuncio.childElementCount == 0) {
                    div_parentAnuncio.parentElement.classList.add("d-none");
                }
            },
        });
        let set_anuncio = (data) => {
            div_parentAnuncio.innerHTML = "";
            if (window.innerWidth >= 500 && window.innerWidth <= 950) {//Tablet
                device = "device_tablet";
            } else if (window.innerWidth <= 500) {//Celular
                device = "device_movil";
            } else {//Desktop
                device = "device_desktop";
            }
            for (let i = 0; i < data.length; i++) {
                if (data[i][device] == 1) {
                    let div = document.createElement("div");
                    let a = document.createElement("a");
                    let img = document.createElement("img");
                    div.className = "col-sm-12 col-md-6 col-lg-12 mb-5 d-flex justify-content-center";
                    a.href = `${data[i]["link"]}`;
                    a.target = "_blank";
                    img.src = `${_URL_ + 'admin' + data[i]["imagen"].replace("..", "")}`;
                    img.className = "img-fluid";
                    a.appendChild(img);
                    div.appendChild(a);
                    div_parentAnuncio.appendChild(div);
                }
            }
        }
    }
});