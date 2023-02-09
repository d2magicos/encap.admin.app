<main class="container-fluid mx-0 px-0">
    <div class="container-fluid d-none d-lg-block bg-body">
        <div class="container p-0">
            <div class="row py-3">
                <?php include("views/templates/components/cmp_datetime.php") ?>
            </div>
        </div>
    </div>
    <div id="portada" class="position-relative w-100 p-0 m-0">
        <div class="position-absolute top-50 start-0 translate-middle-y p-0 m-0 h-100 w-100" id="parent_search">
            <div class="container h-100 p-0">
                <div class="row d-flex justify-content-between align-items-center h-100 w-100 p-0 m-0">
                    <div class="col-12 col-md-6 col-lg-4 mb-5" data-aos="fade-up">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 mb-5">
                                <h1 class="fw-normal">Hay <span class="fw-bolder"><?php echo $this->cantidad_empleos["message"] ?></span> trabajos esperándote en Perú</h1>
                            </div>
                            <div class="col-md-12">
                                <div class="group_input">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" class="form-control" name="search" id="search" placeholder="Puesto a buscar" autocomplete="off">
                                </div>
                                <div class="group_select my-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <select class="form-select depa_select" name="depa_select" id="depa_select">
                                        <option value="todo">Todo el país</option>
                                        <option value="AMAZONAS">AMAZONAS</option>
                                        <option value="ÁNCASH">ÁNCASH</option>
                                        <option value="APURÍMAC">APURÍMAC</option>
                                        <option value="AREQUIPA">AREQUIPA</option>
                                        <option value="AYACUCHO">AYACUCHO</option>
                                        <option value="CAJAMARCA">CAJAMARCA</option>
                                        <option value="CALLAO">CALLAO</option>
                                        <option value="CUSCO">CUSCO</option>
                                        <option value="HUANCAVELICA">HUANCAVELICA</option>
                                        <option value="HUÁNUCO">HUÁNUCO</option>
                                        <option value="ICA">ICA</option>
                                        <option value="JUNÍN">JUNÍN</option>
                                        <option value="LA LIBERTAD">LA LIBERTAD</option>
                                        <option value="LAMBAYEQUE">LAMBAYEQUE</option>
                                        <option value="LIMA">LIMA</option>
                                        <option value="LORETO">LORETO</option>
                                        <option value="MADRE DE DIOS">MADRE DE DIOS</option>
                                        <option value="MOQUEGUA">MOQUEGUA</option>
                                        <option value="PASCO">PASCO</option>
                                        <option value="PIURA">PIURA</option>
                                        <option value="PUNO">PUNO</option>
                                        <option value="SAN MARTÍN">SAN MARTÍN</option>
                                        <option value="TACNA">TACNA</option>
                                        <option value="TUMBES">TUMBES</option>
                                        <option value="UCAYALI">UCAYALI</option>
                                    </select>
                                </div>
                                <button type="button" class="btn button_search w-100 py-2 mt-3" id="btn_searchEmpleo">Buscar trabajo</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 d-flex justify-content-end align-items-end d-none d-md-flex h-100" data-aos="fade-left">
                        <img src="<?php echo URL ?>public/image/home/persona.png" alt="" style="max-width: 400px;" class="img-fluid" id="person_portada">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row d-flex justify-content-around">
            <div class="col-sm-12 col-md-12 col-lg-3">
                <div class="row d-flex justify-content-md-around h-100">
                    <div class="col-md-5 col-lg-12 bg-white rounded-3 mb-3 p-3">
                        <!-- Componente departamentos -->
                        <?php include("views/templates/components/cmp_filtro_departamento.php") ?>
                    </div>
                    <div class="col-md-5 col-lg-12 bg-white rounded-3 mb-3 p-3">
                        <!-- Componente provincias -->
                        <?php include("views/templates/components/cmp_filtro_provincia.php") ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 bg-white rounded-3 p-3 position-relative" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <h2 class="text-primary fw-bold text-center pb-3 mt-3 mt-md-auto">Encuentra el empleo ideal para ti</h2>
                <div class="row" id="container"></div>
                <div id="pagination" class="d-flex justify-content-center align-items-center position-absolute bottom-0 start-50 translate-middle-x mb-5"></div>
            </div>
        </div>
    </div>
    <!-- Anuncio redes sociales-->
    <div class="container py-4 d-flex flex-column justify-content-center align-items-center bg-body mt-5" id="anuncio_rs">
        <h3 class="text-center">Entérate de más <strong>Cursos, Diplomas y Diplomas en Especialización</strong></h3>
        <div class="d-flex justify-content-center list_redes_sociales mt-3">
            <a href="https://www.facebook.com/www.encap.edu.pe" target="_blank">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://wa.link/gq6z5w" target="_blank">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
            <a href="https://www.instagram.com/encap_capacitaciones/" target="_blank">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/c/ENCAPCAPACITACIONES" target="_blank">
                <i class="fa-brands fa-youtube"></i>
            </a>
        </div>
    </div>
</main>
</div>
</div>