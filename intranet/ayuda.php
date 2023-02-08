<!-- <?php require "../configuraciones/Conexion.php";?>

<?php
    if (isset($_GET["consultarid"])) {
        $doc = $_GET["consultarid"];
    } else {
        $doc = null;
    }

    if (isset($_GET["docente"])) {
        $prof = $_GET["docente"];
    } else {
        $prof = null;
    }

    if ($doc != null) {
        /* Get student */
        $resultadop = mysqli_query($conexion, "SELECT nombre, num_documento,departamento,ciudad
                                                FROM persona
                                                WHERE num_documento='" . $doc . "'");
    } else if ($prof != null) {
        /* Get teacher */
        $resultadop = mysqli_query($conexion, "SELECT nombre, num_documento,departamento,ciudad
                                                FROM docente
                                                WHERE num_documento='" . $prof . "'");
    }

    $consulta = mysqli_fetch_array($resultadop);
?>
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encap | Ayuda</title>
    <!-- bootstrap 5.2.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../public/css/sweetalert.min.css" /> -->
    <link rel="stylesheet" href="./css/resetcss.css">
    <link rel="stylesheet" href="./css/custom-style.css">
    <link rel="stylesheet" href="./css/modal-style.css">
</head>

<body>
    <header class="header">
        <div class="container header-container">
            <!-- <div class="mobile-header">
                <i class="fa-solid fa-bars"></i>
            </div> -->
            <nav class="main-menu">
                <a href=https://encap.edu.pe/cursos/"><img class="logo-encap" src="../files/encap blanco.png"
                        alt="logo encap"></a>
                <ul>
                    <li class="menu-item"><a href="./intranet2.php?consultarid=<?= $doc; ?>">Inicio</a></li>
                    <li class="actived"><a href="">Ayuda</a></li>
                    <li class="menu-item"><a href="../intranet/">Salir</a></li>
                </ul>
            </nav>
            <div class="help-container text-center">
                <!-- <div class="aula-virtual-letrero">
                    <nav class="help-title pt-2 pb-1" style="font-size: 18px;">Aula Virtual</nav>
                    <div class="pt-1"><a href="https://aula.encap.edu.pe/" target="_blank"><nav class="aula-link">Ingrese aquí <i class="fa-solid fa-arrow-up-right-from-square"></i></nav></a></div>
                </div> -->
                <a href="https://wa.link/io5yae" target="_blank">
                    <div class="numbers">
                        <nav class="help-title">Si necesitas ayuda, comunícate con nosotros</nav>
                        <div class="pt-1"><nav class="number-1"><i class="fa-solid fa-phone mx-2"></i>925 248 166</nav></div>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="container py-5">
            <h2>Preguntas frecuentes</h2>
            <div class="accordion px-2" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1.- ¿Cómo descargo mi certificado?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/kR1Kry0qfSM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2.- ¿Cómo ingreso al aula virtual?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/yp5F8UGkhgQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3.- ¿Cómo accedo a mi curso?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/knNep07IEVY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            4.- ¿Cómo válido mi certificado?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/Qyu9xSvVfEM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            5.- ¿Cómo veo el estado de envío de mi certificado en físico?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/xmQ0ZxwhUf8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            6.- ¿Cómo accedo al portal de bolsa de trabajo?
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/ZaMqDxX5Pcw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            7.- ¿Cómo puedo unirme al grupo de WHATSAPP para ver más cursos?
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/mIPZPBEW8KI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            8.- Deseo inscribirme en otros cursos.
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <iframe class="tutorial-iframe" src="https://www.youtube.com/embed/qw9Dgt6mUiQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script src="../public/js/sweetalert.min.js"></script> -->
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/75ab5a9917.js" crossorigin="anonymous"></script>
    <!-- bootstrap 5.2.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>

    <!-- DATATABLES -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>
    <!-- <script src="../public/datatables/dataTables.buttons.min.js"></script> -->
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <!-- <script src="../public/datatables/pdfmake.min.js"></script> -->
    <script src="../public/datatables/vfs_fonts.js"></script>

    <script src="./js/intranet.js"></script>
</body>

</html>