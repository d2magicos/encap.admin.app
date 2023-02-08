<?php require "../configuraciones/Conexion.php";?>

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENCAP | Intranet</title>
    <!-- bootstrap 5.2.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../public/css/sweetalert.min.css" /> -->
    <link rel="stylesheet" href="./css/resetcss.css">
    <link rel="stylesheet" href="./css/custom-style.css">
    <link rel="stylesheet" href="./css/modal-style.css">
    <link rel="stylesheet" href="./css/stars.css">
</head>
<body>
    <?php if ($consulta > 0) { ?>
    
    <header class="header">
        <div class="container header-container">
            <nav class="main-menu">
                <a href="./intranet2.php?consultarid=<?= $doc; ?>"><img class="logo-encap" src="../files/encap blanco.png" alt="logo encap"></a>
                <ul>
                    <li class="actived"><a href="./intranet2.php?consultarid=<?= $doc; ?>">Inicio</a></li>
                    <li class="menu-item"><a href="./ayuda.php?consultarid=<?= $doc; ?>">Ayuda</a></li>
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
    <main class="container pt-5 pb-4">
        <div class="row">
            <div class="col-lg-5">
                <div class="px-2">
                    <div class="user-info">
                        <div class="main-info">
                            <span>Intranet 2.0</span>
                            <h1 class="title-company">Estudiantes</h1>
                            <?php date_default_timezone_set("America/Lima"); ?>
                            <span class="city">Última actualización: <?= date('d/m/Y'); ?></span>
                        </div>
                        <div class="details">
                            <!-- <h4 class="pb-3">Hola: <span class="user-name"><?= $consulta['nombre']; ?></span></h4> -->
                            <ul>
                                <li class="detail">
                                    <span class="label">Documento: </span>
                                    <span class="document"><?= $consulta['num_documento']; ?></span>
                                </li>
                                <li class="detail">
                                    <span class="label">Nombre: </span>
                                    <span class="name"><?= $consulta['nombre']; ?></span>
                                </li>
                                <li class="detail">
                                    <span class="label">Ciudad: </span>
                                    <span class="city"><?= $consulta['ciudad']; ?>, <?= $consulta['departamento']; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="links-container">
                        <h3 class="py-4 text-center">Links de interés</h3>
                        <div class="row links">
                            <div class="col-xl-3 col-lg-4 col-md-4 text-center link">
                                <div class="card-link text-center">
                                    <a href="https://sistemas.encap.edu.pe/certificados/" target="_blank">
                                        <h4 class="link-title">Validación de certificados</h4>
                                        <div class="link-img p-2">
                                            <img class="link-img" src="./img/diploma.png" alt="" width="60px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-4 link">
                                <div class="card-link text-center">
                                    <a href="https://sistemas.encap.edu.pe/tracking/" target="_blank">
                                        <h4 class="link-title">Seguimiento de envío<br/> (Certificados físicos)</h4>
                                        <div class="link-img p-1">
                                            <img class="link-img" src="./img/camion.png" alt="" width="55px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-4 link">
                                <div class="card-link text-center">
                                    <a href="https://buscatuempleo.pe/" target="_blank">
                                        <h4 class="link-title">Encuentra tu empleo</h4>
                                        <div class="link-img">
                                            <img class="link-img" src="./img/work-tools.png" alt="" width="70px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-4 link">
                                <div class="card-link text-center">
                                    <a href="https://chat.whatsapp.com/Jly7TX1qmPVGUXIb8bkTQh" target="_blank">
                                        <h4 class="link-title">Ver más cursos</h4>
                                        <div class="link-img p-2 m-1">
                                            <img class="link-img" src="./img/whatsapp.png" alt="" width="50px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aula-mobile-container text-center">
                <a href="https://wa.link/io5yae" target="_blank">
                    <div class="aula-mobile-button my-4">
                        <div class="py-2">
                            <nav class="help-title">Comunícate con el Área de Soporte</nav>
                            <div class="pt-1"><nav class="number-1"><i class="fa-solid fa-phone mx-2"></i>925 248 166</nav></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-7">
                <div class="table-container">
                    <div class="user-history">
                        <table id="tabla" class="details-table w-100">
                            <thead>
                                <tr>
                                    <th class="colum-title">Nombre del curso</th>
                                    <th class="colum-title" style="width: 20%;">Certificado</th>
                                    <th class="colum-title" style="width: 20%;">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="links-container-mobile">
                <h3 class="py-4 text-center">Links de interés</h3>
                <div class="row links">
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://sistemas.encap.edu.pe/certificados/" target="_blank">
                                <h4 class="link-title">Validación de certificados</h4>
                                <div class="link-img p-2">
                                    <img class="link-img" src="./img/diploma.png" alt="" width="60px">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://sistemas.encap.edu.pe/tracking/" target="_blank">
                                <h4 class="link-title">Seguimiento de envío<br/> (Certificados físicos)</h4>
                                <div class="link-img p-1">
                                    <img class="link-img" src="./img/camion.png" alt="" width="55px">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://buscatuempleo.pe/" target="_blank">
                                <h4 class="link-title">Encuentra tu empleo</h4>
                                <div class="link-img">
                                    <img class="link-img" src="./img/work-tools.png" alt="" width="70px">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://chat.whatsapp.com/Jly7TX1qmPVGUXIb8bkTQh" target="_blank">
                                <h4 class="link-title">Ver más cursos</h4>
                                <div class="link-img p-2 m-1">
                                    <img class="link-img" src="./img/whatsapp.png" alt="" width="50px">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-text text-center py-2">
            © Todos los derechos reservados <?= date("Y"); ?>
        </div>
    </footer>
    
    <?php 
    } else {
        require_once('../public/templates/_404/404.php');
    } 
    ?>

    <?php require_once('./resources/detailsModal.php'); ?>
    <?php require_once('./resources/encuestaModal.php'); ?>

    <script>const personid = "<?= $_GET["consultarid"] ?>";</script>
    <script>
        resetButton = () => {
            if ($('input:radio[name=estrellas]').is(':checked')) {
                $('input:radio[name=estrellas]').prop('checked', false)
                document.getElementById('qualification').value = '';
                document.getElementById('txtRespuesta').innerHTML = '';
            }
        }
    </script>
    <!-- jQuery -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script src="../public/js/sweetalert.min.js"></script> -->
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/75ab5a9917.js" crossorigin="anonymous"></script>
    <!-- bootstrap 5.2.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <!-- DATATABLES -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>    
    <!-- <script src="../public/datatables/dataTables.buttons.min.js"></script> -->
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <!-- <script src="../public/datatables/pdfmake.min.js"></script> -->
    <script src="../public/datatables/vfs_fonts.js"></script> 

    <script src="./js/intranet.js"></script>
    <!-- <script src="./js/tabla.js"></script> -->
    <script src="./js/details.js"></script>
    <script src="./js/toggle.js"></script>
    <script src="./js/survey.js"></script>
</body>
</html>