<!DOCTYPE html>
<html>

<head>
  <meta charset="utf8_general_ci">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ENCAP | Seguimiento de envío</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/css/font-awesome.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">

  <!-- sweetalert2 -->
  <link rel="stylesheet" href="../public/css/sweetalert.min.css" />

  <!-- Icono Web -->
  <link rel="icon" href="../files/ENCAP.ico">

  <!--Hoja de estilos de traking-->
  <link rel="stylesheet" href="css/tracking.css">

</head>

<body class="tracking">
  <div class="tracking__contenedor">
    <div class="trackingImagen">
      <a class="trackingImagen__contenedor" href="">
        <img src="../files/tracking_logo.png" alt="logo encap" width="200px" height="100%">
      </a>
    </div><br>
    <div class="trackingForm">
      <form method="post" id="frmAcceso">
        <div class="trackingForm__contenedor">
          <h2 class="trackingForm__heading">CONSULTA EL ESTADO DE ENVÍO DE TU CERTIFICADO</h2><br>
          <div class="trackingBuscador">
            <div>
              <input type="text" id="consultar" name="consultar" placeholder="Ingresa tu número DNI ">
            </div>
            <div>
              <button name="btnBuscar" type="submit" class=""> Consultar &nbsp<i class="fa fa-truck"></i></button>
            </div>
          </div>
          <div class="trackingForm__texto">
            <p style="text-align:center; font-weight:bold; font-size:20px">Para realizar el seguimiento de su envío,
              haga clic en el botón <span style="font-size:23px">"consultar"</span> </p>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../public/js/jquery-3.1.1.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="../public/js/bootstrap.min.js"></script>
  <!-- Bootbox -->
  <script src="../public/js/bootbox.min.js"></script>

  <script type="text/javascript">
    $("#frmAcceso").on('submit', function (e) {
      e.preventDefault();

      consultar = $("#consultar").val();

      $.post("../controladores/validacion.php?op=verificarseguimientofisico", { "consultar": consultar },
        function (dataa) {
          if (dataa != "null") {
            $(location).attr("href", "tracking.php")
          } else {
            swal("Lo sentimos, este módulo es solo para envíos de certificados en físico.", "DNI no encontrado", "warning");
          }
        }
      );
    })
  </script>


  <!-- sweetalert2 -->
  <script src="../public/js/sweetalert.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../public/js/app.min.js"></script>
  <script src="../public/js/bootbox.min.js"></script>
  <script src="../public/js/bootstrap-select.min.js"></script>
  <!-- sweetalert2 -->
  <script src="../public/js/sweetalert.min.js"></script>
</body>

</html>