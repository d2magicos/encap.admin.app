<main class="container-fluid mx-0 px-0 mt-5 pt-5 bg-body" id="main_search_empleo">
    <input type="hidden" id="name_empleo" value="<?php echo $this->name_empleo ?>">
    <input type="hidden" id="name_depa" value="<?php echo $this->name_depa ?>">
    <div class="container my-4">
        <div class="row">
            <div class="col-12 d-block d-md-none mb-3">
                <!-- Componente buscador -->
                <label class="fs-2 text-center w-100 fw-bolder"><span class="text-warning">Busca tu</span><span class="text-secondary"> empleo</span></label>
                <?php include("views/templates/components/cmp_buscador.php") ?>
            </div>
            <div class="row d-flex justify-content-around my-3 my-lg-5">
                <div class="col-md-12 col-lg-8 bg-white rounded-3 p-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <label id="result_message"></label>
                    <label id="text_search"></label>
                    <label id="text_depa"></label>
                    <div class="row mt-5 mt-md-2" id="container_search"></div>
                    <div id="pagination_search" class="d-flex justify-content-center align-items-center"></div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 mt-3 mt-lg-0">
                    <div class="row d-flex justify-content-md-around h-100">
                        <div class="col-md-5 col-lg-12 bg-white rounded-3 mb-3 p-3">
                            <?php if ($this->get_allprovinciasSearch["success"]) : ?>
                                <h4 class="text-primary fw-bold pb-3">Top Provincias de <span class="text-warning"><?php echo $this->get_allprovinciasSearch["message"][0]["ubi_depa"] ?> </span></h4>
                                <ul class="list-group list_departamentos mb-3">
                                    <?php for ($i = 0; $i < count($this->get_allprovinciasSearch["message"]); $i++) : ?>
                                        <li class="list-group-item item_departamento">
                                            <a href="<?php echo URL; ?>home/search/todo/<?php echo strtolower($this->get_allprovinciasSearch["message"][$i]["ubi_provi"] ?: "todo") ?>" class="d-flex justify-content-between align-items-center">
                                                <?php echo $this->get_allprovinciasSearch["message"][$i]["ubi_provi"] ?>
                                                <span class="badge bg-primary rounded-pill px-2"><?php echo $this->get_allprovinciasSearch["message"][$i]["cantidad"] ?></span>
                                            </a>
                                        </li>
                                    <?php endfor ?>
                                </ul>
                            <?php else : ?>
                                <div class="d-flex flex-column justify-content-center align-items-center h-100">
                                    <i class="fa-solid fa-cube fs-1"></i>
                                    <label class="fs-5 my-3 text-secondary text-center">No se encontrarón más provincias</label>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>