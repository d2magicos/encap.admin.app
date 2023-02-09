<footer id="footer" class="mt-3">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4 col-lg-4 d-flex flex-column align-items-center">
                <a href="./" class="logo">
                    <img style="width: 90px; height:auto ; padding: 5px;" src="<?php echo URL ?>public/image/encap_blanco.png" alt="Logo Comunicaciones Universo">
                </a>
                <p class="descrip mt-3">Encap es una organización privada con presencia a nivel nacional e internacional, dedicada a brindar servicios de capacitación y especialización a diferentes profesionales, técnicos y administrativos vinculados con el ámbito público y privado.</p>
            </div>

            <div class="col-md-4 col-lg-4 mt-4 mt-md-0 d-flex justify-content-start justify-content-md-center">
                <ul class="list_enlaces">
                    <li><a href="https://encap.edu.pe/cursos/courses/?status%5B%5D=hot&search=&is_lms_filter=1" target="_blank"><i class="fa fa-caret-right"></i>Cursos</a></li>
                    <li><a href="https://encap.edu.pe/cursos/courses/?status%5B%5D=hot&search=&is_lms_filter=1" target="_blank"><i class="fa fa-caret-right"></i>Diplomas</a></li>
                    <li><a href="https://encap.edu.pe/cursos/courses/?status%5B%5D=hot&search=&is_lms_filter=1" target="_blank"><i class="fa fa-caret-right"></i>Diplomas de Especializacion</a></li>
                    <li><a href="https://www.facebook.com/www.encap.edu.pe" target="_blank"><i class="fa fa-caret-right"></i>Cursos en Vivo</a></li>
                    <li><a href="https://walink.co/cc9281" target="_blank"><i class="fa fa-caret-right"></i>Cursos In House </a></li>
                </ul>
            </div>

            <div class="col-md-4 col-lg-4 mt-4 mt-lg-0 d-flex flex-column align-items-start align-items-md-center alin">
                <h3 class="text-white">Siguenos en:</h3>
                <ul class="list_contact">
                    <li><a href="https://www.facebook.com/www.encap.edu.pe" target="_blank"><i class="fa-brands fa-facebook text-white fs-1 me-3 my-2"></i>Facebook</a></li>
                    <li><a href="https://www.instagram.com/encap_capacitaciones/" target="_blank"><i class="fa-brands fa-instagram text-white fs-1 me-3 mb-2"></i>Instagram</a></li>
                    <li><a href="https://www.linkedin.com/company/encap-capacitaciones" target="_blank"><i class="fa-brands fa-linkedin text-white fs-1 me-3 mb-2"></i>Linkedin</a></li>
                    <li><a href="https://www.youtube.com/c/ENCAPCAPACITACIONES" target="_blank"><i class="fa-brands fa-youtube text-white fs-1 me-3 mb-2"></i>Youtube</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer_end d-flex justify-content-center align-items-center py-4">
        <label>
            Copyright &copy; <?php echo date("Y"); ?> Desarrollado <i class="fa-regular fa-heart mx-2"></i> por <a href="https://www.facebook.com/www.encap.edu.pe" target="_blank" class="ms-2">ENCAP S.A.C.</a>
        </label>
    </div>
</footer>


<!-- PHP -->
<?php if (isset($this->php)) : ?>
    <?php foreach ($this->php as $php) : ?>
        <?php require("views/" . $php) ?>
    <?php endforeach ?>
<?php endif ?>

<!-- SCRIPTS -->
<?php if (isset($this->js)) : ?>
    <?php foreach ($this->js as $js) : ?>
        <script src="<?php echo URL; ?>views/<?php echo $js; ?>" type="module"></script>
    <?php endforeach ?>
<?php endif ?>

<!-- LIBRERIES -->
<script src="<?php echo URL; ?>public/plugins/jquery v3.6.0/jquery.min.js"></script>
<script src="<?php echo URL; ?>public/plugins/bootstrap v5.1.1/bootstrap.bundle.min.js"></script>
<script src="<?php echo URL; ?>public/plugins/wow/wow.min.js"></script>
<script src="<?php echo URL; ?>public/plugins/select2/select2.min.js"></script>
<script src="<?php echo URL; ?>public/plugins/luxon/luxon.min.js"></script>
<script src="<?php echo URL; ?>public/plugins/jspdf/jspdf.umd.min.js"></script>
<script src="<?php echo URL; ?>public/plugins/jspdf/jspdf.plugin.autotable.js"></script>
<script src="<?php echo URL; ?>public/plugins/iziToast/iziToast.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo URL; ?>public/plugins/pagination/pagination.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<!-- SCRIPT -->
<script src="<?php echo URL; ?>public/js/app.js"></script>
<script src="<?php echo URL; ?>public/js/main.js" type="module"></script>
</body>

</html>