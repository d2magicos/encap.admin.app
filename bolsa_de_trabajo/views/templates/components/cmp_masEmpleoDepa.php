<?php if ($this->mas_empleos_departamento["success"]) : ?>
    <h4 class="text-primary fw-bold mb-4">Mas empleos en <span class="text-warning"><?php echo $this->mas_empleos_departamento["message"][0]["ubi_depa"] ?></span></h4>
    <ul class="list-group list_departamentos">
        <?php for ($i = 0; $i < count($this->mas_empleos_departamento["message"]); $i++) : ?>
            <a href="<?php echo URL; ?>home/empleo/<?php echo strtolower(str_replace([" ", "/"], "-", $this->mas_empleos_departamento["message"][$i]["nombre"])) ?>/<?php echo $this->mas_empleos_departamento["message"][$i]["idempleo"] ?>" class="list-group-item d-flex justify-content-start align-items-start item_provincia">
                <i class="fa-solid fa-caret-right mt-1 me-1"></i>
                <?php echo mb_convert_case($this->mas_empleos_departamento["message"][$i]["nombre"], MB_CASE_TITLE) ?>
            </a>
        <?php endfor ?>
    </ul>
<?php else : ?>
    <div class="d-flex flex-column justify-content-center align-items-center h-100">
        <i class="fa-solid fa-cube fs-1"></i>
        <label class="fs-5 my-3 text-secondary text-center">No se encontrarón mas empleos</label>
    </div>
<?php endif ?>