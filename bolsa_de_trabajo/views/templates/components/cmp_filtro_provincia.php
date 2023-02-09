<h4 class="text-primary fw-bold pb-3">Top Provincias</h4>
<?php if ($this->get_allprovincias["success"]) : ?>
    <ul class="list-group list_provincias">
        <?php for ($i = 0; $i < count($this->get_allprovincias["message"]); $i++) : ?>
            <li class="list-group-item item_departamento">
                <a href="<?php echo URL; ?>home/search/todo/<?php echo strtolower($this->get_allprovincias["message"][$i]["ubi_provi"] ?: "todo") ?>" class="d-flex justify-content-between align-items-center">
                    <?php echo $this->get_allprovincias["message"][$i]["ubi_provi"] ?>
                    <span class="badge bg-primary rounded-pill px-2"><?php echo $this->get_allprovincias["message"][$i]["cantidad"] ?></span>
                </a>
            </li>
        <?php endfor ?>
    </ul>
<?php else : ?>
    <div class="d-flex flex-column justify-content-center align-items-center h-100">
        <i class="fa-solid fa-cube fs-1"></i>
        <label class="fs-5 my-3 text-secondary text-center">No se encontrarón más Provincias</label>
    </div>
<?php endif ?>