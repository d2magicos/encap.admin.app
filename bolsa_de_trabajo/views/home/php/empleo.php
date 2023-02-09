<main class="container-fluid mx-0 px-0 mt-5 pt-5 bg-body">
    <div class="container my-4">
        <div class="row d-flex justify-content-around">
            <div class="col-12 d-block d-md-none mb-3">
                <!-- Componente buscador -->
                <label class="fs-2 text-center w-100 fw-bolder"><span class="text-warning">Busca tu</span><span class="text-secondary"> empleo</span></label>
                <?php include("views/templates/components/cmp_buscador.php") ?>
            </div>
            <div class="col-md-12 col-lg-8">
                <input type="hidden" id="id_empleo" value="<?php echo $this->empleo["message"]["idempleo"] ?>">
                <?php if ($this->empleo["success"]) : ?>
                    <!-- AVISO -->
                    <div class="row bg-white rounded-3 p-2 p-md-5">
                        <!-- Encabezado del aviso -->
                        <h4><i class="fa-regular fa-address-card me-2 mb-3"></i><strong>Aviso: </strong></h4>
                        <div class="d-flex flex-column justify-content-center align-items-center header_empleo">
                            <h4 class="text-center"><?php echo $this->empleo["message"]["nombre"] ?></h4>
                            <label class="text-center"><?php echo $this->empleo["message"]["empresa"] ?></label>
                        </div>
                        <!-- Información del aviso -->
                        <h4><i class="fa-solid fa-bullhorn me-2 my-3"></i><strong>Sobre el aviso: </strong></h4>
                        <div class="d-flex flex-column body_empleo bg-white py-3">
                            <h4 class="subtitle_dt mb-3"><strong>Requerimientos:</strong></h4>
                            <div class="row ms-3">
                                <div class="div_detalle">
                                    <label><i class="fa-solid fa-caret-right"></i> EXPERIENCIA: </label>
                                    <p class="mx-3"><?php echo $this->empleo["message"]["experiencia"] ?></p>
                                </div>
                                <div class="div_detalle">
                                    <label><i class="fa-solid fa-caret-right"></i> FORMACIÓN ACADÉMICA - PERFIL: </label><br>
                                    <p class="mx-3"><?php echo $this->empleo["message"]["formacion"] ?></p>
                                </div>
                                <div class="div_detalle">
                                    <label><i class="fa-solid fa-caret-right"></i> ESPECIALIZACIÓN: </label><br>
                                    <p class="mx-3"><?php echo $this->empleo["message"]["especializacion"] ?></p>
                                </div>
                                <div class="div_detalle">
                                    <label><i class="fa-solid fa-caret-right"></i> CONOCIMIENTO: </label>
                                    <p class="mx-3"><?php echo $this->empleo["message"]["conocimiento"] ?></p>
                                </div>
                                <div class="div_detalle">
                                    <label><i class="fa-solid fa-caret-right"></i> COMPETENCIAS: </label>
                                    <?php $compe = explode(",", $this->empleo["message"]["competencia"]); ?>
                                    <ol>
                                        <?php for ($i = 0; $i < count($compe); $i++) : ?>
                                            <li><?php echo $compe[$i] ?></li>
                                        <?php endfor ?>
                                    </ol>
                                </div>
                            </div>
                            <h4 class="subtitle_dt mb-3"><strong>Detalle:</strong></h4>
                            <div class="row ms-3">
                                <div class="col-md-6">
                                    <div class="row" id="div_detalle_basico">
                                        <div class="col-md-12 d-flex justify-content-beetwen">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <label class="card-text"><?php echo $this->empleo["message"]["ubi_depa"] ?>-<?php echo $this->empleo["message"]["ubi_provi"] ?></label>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-beetwen">
                                            <i class="fa-solid fa-user"></i>
                                            <label class="card-text"><?php echo $this->empleo["message"]["nvacantes"] ?> <?php echo $this->empleo["message"]["nvacantes"] == 1 ? ' vacante disponible' : ' vacantes disponibles' ?></label>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-beetwen">
                                            <i class="fa-solid fa-dollar-sign"></i>
                                            <label class="card-text">S/ <?php echo $this->empleo["message"]["renumeracion"] ?> Soles</label>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-beetwen">
                                            <i class="fa-regular fa-calendar-check"></i>
                                            <label class="card-text">Publicado el <?php print_r(implode("/", array_reverse(explode("-", $this->empleo["message"]["fechainicio"])))) ?></label>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-beetwen">
                                            <i class="fa-regular fa-calendar-xmark"></i>
                                            <label class="card-text">Vigente hasta el <?php print_r(implode("/", array_reverse(explode("-", $this->empleo["message"]["fechafin"])))) ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="<?php echo $this->empleo["message"]["detalle"] ?>" target="_blank" class="btn btn_enlace">Ir al Enlace de la convocatoria</a>
                                    <button type="button" class="btn btn_descargar" id="btn_download">Descargar aviso</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Empleos relacionados -->
                    <?php if ($this->empleo_relacionados["success"]) : ?>
                        <div class="row my-3 bg-white rounded-3 p-md-2" id="empleos_relacionados" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                            <h4><i class="fa-solid fa-briefcase me-2 my-3"></i><strong>Empleos relacionados: </strong></h4>
                            <?php for ($i = 0; $i < count($this->empleo_relacionados["message"]); $i++) : ?>
                                <!-- <div class="col-md-4"> -->
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <div class="card card_empleo h-100" style="width: auto;">
                                        <div class="card-header card-img-top bg-body d-flex justify-content-around align-items-center mb-3">
                                            <p class="text-center fw-bolder"><?php echo $this->empleo_relacionados["message"][$i]["nombre"] ?></p>
                                        </div>
                                        <div class="card-body mt-0 pt-0 pb-0 mb-0">
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-beetwen">
                                                    <i class="fa-solid fa-building"></i>
                                                    <label class="card-text"><?php echo $this->empleo_relacionados["message"][$i]["empresa"] ?></label>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-beetwen">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <label class="card-text"><?php echo $this->empleo_relacionados["message"][$i]["ubi_depa"] ?>- <?php echo $this->empleo_relacionados["message"][$i]["ubi_provi"] ?></label>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-beetwen">
                                                    <i class="fa-solid fa-user"></i>
                                                    <label class="card-text"><?php echo $this->empleo_relacionados["message"][$i]["nvacantes"] ?><?php echo $this->empleo_relacionados["message"][$i]["nvacantes"] == 1 ? ' vancante disponible' : ' vancantes disponibles' ?></label>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-beetwen">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                    <label class="card-text">S/ <?php echo $this->empleo_relacionados["message"][$i]["renumeracion"] ?> Soles</label>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-beetwen">
                                                    <i class="fa-regular fa-calendar-check"></i>
                                                    <label class="card-text">Publicado el <?php print_r(implode("/", array_reverse(explode("-", $this->empleo_relacionados["message"][$i]["fechainicio"])))) ?></label>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-beetwen">
                                                    <i class="fa-regular fa-calendar-xmark"></i>
                                                    <label class="card-text">Vigente hasta el <?php print_r(implode("/", array_reverse(explode("-", $this->empleo_relacionados["message"][$i]["fechafin"])))) ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="<?php echo URL; ?>home/empleo/<?php echo strtolower(str_replace([" ", "/"], "-", $this->empleo_relacionados["message"][$i]["nombre"])) ?>/<?php echo $this->empleo_relacionados["message"][$i]["idempleo"] ?>" class="btn w-100">VER CONVOCATORIA</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor ?>
                        </div>
                    <?php endif ?>
                <?php endif ?>
            </div>
            <div class="positio-relative col-12 col-lg-3 h-100">
                <div class="bg-white rounded-3 p-3 mb-4">
                    <!-- Componente anuncio -->
                    <?php include("views/templates/components/cmp_masEmpleoDepa.php") ?>
                </div>
                <div class="bg-white rounded-3 p-3">
                    <!-- Componente anuncio -->
                    <?php include("views/templates/components/cmp_anuncio.php") ?>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>