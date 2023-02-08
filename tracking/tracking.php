<?php if (strlen(session_id() < 1)) {
      session_start();
} ?>

<?php require "../configuraciones/Conexion.php";?>

<?php
  $doc = $_SESSION["num_documento"];

  $query = mysqli_query($conexion, "SELECT num_documento, nombre, ciudad, departamento 
                                    FROM persona
                                    WHERE num_documento = '$doc'");

  $consulta = mysqli_fetch_array($query);
?>

<!-- <?= $doc; ?> -->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encap | Tracking</title>
  <!-- bootstrap 5.2.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/resetcss.css">
  <link rel="stylesheet" href="./css/custom-style.css">
  <!-- <link rel="stylesheet" href="./cards/style.css"> -->
  <link rel="stylesheet" href="./css/modal-style.css">
</head>

<body>
    
  <?php if (!empty($_SESSION["num_documento"])) { ?>
    
  <header class="header">
    <div class="container header-container">
      <nav class="main-menu">
        <a href=""><img class="logo-encap" src="../files/encap blanco.png" alt="logo encap"></a>
        <ul>
          <li class="actived"><a href="">Inicio</a></li>
          <!--<li class="menu-item"><a href="">Ayuda</a></li>-->
          <li class="menu-item"><a href="./">Salir</a></li>
        </ul>
      </nav>
      <div class="help-container text-center">
        <a href="https://wa.link/t2lv5n" target="_blank" title="Click Aquí">
          <div class="numbers">
            <span class="help-title">Si necesitas ayuda, comunícate con nosotros</span>
            <div class="pt-1">
              <span class="number-1"><i class="fa-solid fa-phone mx-2"></i>918 495 569</span>
            </div>
            <div style="font-size: 9px; padding: 1px 0;">
              <span class="fw-bold d-block pt-1" style="font-size: 10px;">Lunes a Sábado</span>
              <span class="fw-bold" style="font-size: 11px;">de 9:00 am a 1:00 pm</span>
            </div>
             <!-- <label style="font-size: 9px;">Horario de atención: 8:30 am - 1:00 pm</label> -->
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
              <h1 class="title-company">Tracking</h1>
              <?php date_default_timezone_set("America/Lima"); ?>
              <span class="city">Última actualización:
              <?= date('d/m/Y'); ?>
              </span>
            </div>
            <div class="details my-2">
              <!-- <span style="font-size: 16px">Hola <span class="label"><?= $consulta['nombre']; ?></span>!</span> -->
              <ul>
                <li class="detail">
                  <span class="label">Documento: </span>
                  <span class="document">
                    <?= $consulta['num_documento']; ?>
                  </span>
                </li>
                <li class="detail">
                  <span class="label">Nombre: </span>
                  <span class="name">
                    <?= $consulta['nombre']; ?>
                  </span>
                </li>
                <li class="detail">
                  <span class="label">Ciudad: </span>
                  <span class="city">
                    <?= $consulta['ciudad']; ?>,
                    <?= $consulta['departamento']; ?>
                  </span>
                </li>
              </ul>
            </div>
            <div class="help-mobile-container text-center">
              <a href="https://wa.link/t2lv5n" target="_blank" title="Click Aquí">
                <div class="help-mobile-button my-4">
                    <div class="py-2">
                        <nav class="help-title">Si necesitas ayuda, comunícate con nosotros</nav>
                        <div class="pt-1"><nav class="number-1"><i class="fa-solid fa-phone mx-2"></i>918 495 569</nav></div>
                    </div>
                </div>
              </a>
            </div> 

            <div>
              <div class="tracking-mobile-container py-1" id="">
                <div class="course-tracking-container">
                  <div class="course-tracking-state">
                    <div class="row m-4">
                      <div class="tracking-image text-center">
                        <img src="./images/tracking2.png" alt="">
                      </div>
                      <h2 style="color: skyblue; font-weight: 600;">Bienvenidos</h2>
                      <p>En este módulo podrá realizar seguimiento del envío de su <span class="fw-bold">certificado físico</span> emitido por la Escuela Nacional de Capacitación y Actualización Profesional (ENCAP).</p>
                      <div class="tracking-steps">
                        <h5 class="pt-3 fw-bold">Pasos:</h5>
                        <ol class="p-4">
                          <li class="pb-1">Diríjase al curso que desee hacer seguimiento.</li>
                          <li class="pb-1">Pulse el botón <span class="fw-bold">Ver envío</span>.</li>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="buscador-container my-4">
              <table id="cursosTabla" class="table-courses w-100">
                <thead>
                  <tr>
                    <th>Curso</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody class="cursosDetails">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="tracking-container py-1" id="tracking-container">
          <div class="course-tracking-container">
            <div class="course-tracking-state">
              <div class="row m-4">
                <div class="tracking-image text-center">
                  <img src="./images/tracking2.png" alt="">
                </div>
                <h2 style="color: skyblue; font-weight: 600;">Bienvenidos</h2>
                <p>En este módulo podrá realizar seguimiento del envío de su <span class="fw-bold">certificado físico</span> emitido por la Escuela Nacional de Capacitación y Actualización Profesional (ENCAP).</p>
                <div class="tracking-steps">
                  <h5 class="pt-3 fw-bold">Pasos:</h5>
                  <ol class="p-4">
                    <li class="pb-1">Diríjase al curso que desee hacer seguimiento.</li>
                    <li class="pb-1">Pulse el botón <span class="fw-bold">Ver envío</span>.</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <footer>
    <div class="footer-text text-center py-2">
      © Todos los derechos reservados 2023
    </div>
  </footer>

  <?php require_once("./resources/modalAviso.php"); ?>

  <!-- Modal -->
  <div class="modal fade" id="modalAvisoOne" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-lg-5">
              <div class="text-center h-100 d-flex" style="align-items: center; justify-content: center;">
                <img src="./images/atencion.png" class="atencion-img text-center" alt="">
              </div>
            </div>
            <div class="col-12 col-lg-7">
              <div class="px-3">
                <?php 
                  $nombres = $consulta['nombre'];

                  $nombre = ($nombres != "" && $nombres != null) ? explode(" ", $nombres) : "";
                ?>
                <h3 class="mt-2 pb-1 fw-bold" style="font-size: 20px; color: rgb(55, 55, 55); border-bottom: 2px solid rgb(128, 128, 128);">Hola <?= ucfirst(strtolower($nombre[2])); ?> 👋</h3>
                <div class="" style="margin-top: .75rem;">
                  <p class="" style="font-size: 15px; color: rgb(68, 68, 68); text-align: justify;">
                    En los próximos días el Área de Envíos se estará comunicando con usted vía whatsapp o telefónica para confirmar el lugar de envío.
                  </p>
                </div>
                <p class="pt-4 pb-2 fw-bold" style="color: rgb(110, 110, 110);">Att. Área de envíos</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("./resources/modalTrackInfo.php"); ?>

  <?php 
  } else {
    require_once('../public/templates/_404/404.php');
  } 
  ?>

  <script>const documento = "<?= $doc ?>";</script>

  <!-- jQuery -->
  <script src="../public/js/jquery-3.1.1.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/75ab5a9917.js" crossorigin="anonymous"></script>
  <!-- bootstrap 5.2.2 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  
  <!-- DATATABLES -->
  <script src="../public/datatables/jquery.dataTables.min.js"></script>    

  <script src="./js/tracking.js"></script>
  <script src="./js/table-cursos.js"></script>
  <script src="./js/tracking-info.js"></script>
  <script src="./js/mediaquery.js"></script>

</body>

</html>