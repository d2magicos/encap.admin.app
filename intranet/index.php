<!DOCTYPE html>
<html>
  <?php 
  
  session_start();
  ?>
<head>
  <meta charset="utf8_general_ci">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ENCAP | Intranet</title>
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

  <!--Estilos de página de intranet-->
  <link rel="stylesheet" href="css/intranet.css">
</head>

<body class="intranet">
  <section class="contenedor__login contenedor">
    <div class="loginCard">
      <div class="loginCard__contenedor">
        <div class="logoencap">
          <a class="logoencap__contenedor" href="#">
            <img class="logoencap__imagen" src="../files/encap blanco.png" alt="logo encap" width="120px" height="100%">
          </a>
        </div><br>
        <form class="intranetForm" method="post" id="frmAcceso">
          <div class="intranetForm__contenedor">
            <h1 class="intranetForm__heading">Intranet</h1><br/>
            <div class="intranetEntrada">
              <div class="intranetEntrada__contenedor">
                <div
                  style="display: flex; background: #c3c1c1;border-radius: 20px;height: fit-content;margin: 0;margin-bottom:5px">
                  <script>
                    function Activar(id) {
                      var activo = document.getElementById(id);
                      var buttons = document.getElementsByClassName("button_active");
                      var mensaje = document.getElementById('mensaje');
 
                      for (var x = 0; x < buttons.length; x++) {
                        buttons[x].style.cssText = "width:50%;background:#c3c1c1;border-radius: 20px;padding:10px;color:black;font-weight:bold;text-align:center;margin:0";
                      }

                      if (id == "alumno") {
                        activo.style.cssText = "width:50%;background:#28e4f0;border-radius: 20px;padding:10px;color:black;font-weight:bold;box-shadow: rgb(136 136 136) 2px 10px 6px -4px;transition-duration:0.5s;text-align:center;margin:0;transform: scale(1.1)";
                        mensaje.innerHTML = "¡Bienvenido Estudiante!";
                      } else {
                        activo.style.cssText = "width:50%;background:#004daa;border-radius: 20px;padding:10px;color:white;font-weight:bold;box-shadow: rgb(136 136 136) 2px 10px 6px -4px;transition-duration:0.5s;text-align:center;margin:0;transform: scale(1.1)";
                        mensaje.innerHTML = "¡Bienvenido Docente!";
                      }

                      var tipop = document.getElementById("tipopart");
                      tipop.value = id;
                    }
                  </script>

                  <p id="alumno" class="button_active" href=""
                    style="width:50%;background:#28e4f0;border-radius: 20px;padding:10px;color:black;font-weight:bold;box-shadow: rgb(136 136 136) 2px 10px 6px -4px;text-align:center;margin:0"
                    tabindex="1" role="button" aria-disabled="false" onclick="Activar(this.id);"
                    style="padding-right: 32px; z-index: 0;">Estudiante</p>

                  <p id="docente" class="button_active" href=""
                    style="width:50%;background:#c3c1c1;border-radius: 20px;padding:10px;color:black;font-weight:bold;text-align:center;margin:0"
                    tabindex="0" role="button" aria-disabled="false" onclick="Activar(this.id);">Docente</p>

                </div>
                <h3 id="mensaje" style="text-align:center">¡Bienvenido Estudiante!</h3>
                <input type="hidden" id="tipopart" name="tipopart" class="form-control">
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingresa tu DNI">
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Ingresa tu contraseña">
                <!-- <div id="message">Por favor resuelva la suma.</div>  -->
                <table>
                  <tr>
                    <td>
                      <p id="question" style="display: flex;
                                              align-content: center;
                                              justify-content: center;
                                              align-items: center;
                                              flex-wrap: nowrap;
                                              font-size:16px;
                                              font-weight:bold;
                                              flex-direction: row;
                                              height: 50px;
                                              margin: 0 0 0 !important;"></p>
                    </td>
                    <td style="width:50%"><input id="ans" type="text" placeholder="Ingrese la suma"></td>
                  </tr>
                </table>
                <div id="fail" style="color: red;
                    border-radius: 10px;
                    padding: 5px;margin-top: -17px;
                    display: none;">Por favor ingrese la suma correcta.</div>
                <button name="btnLogin" id="btnLogin" type="submit" class="intranetEntrada__btn"><i
                    style="margin-right:5px; font-size:15px;color:white" class="fa fa-sign-in"
                    id="icono"></i>Ingresar</button>
              </div>
              <span class="link"><a class="link__whattsap" target="_blank" href="https://wa.link/v0w975">¿Olvidaste tu
                  contraseña?</a></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- jQuery -->
  <script src="../public/js/jquery-3.1.1.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="../public/js/bootstrap.min.js"></script>
  <!-- Bootbox -->
  <script src="../public/js/bootbox.min.js"></script>

  <script src="../intranet/js/captcha.js"></script>

  <script type="text/javascript">
    /*  
      function Consulta() {
        consultar=$("#consultar").val();
        $(location).attr("href","http://localhost/SISt_ENCAP_V2/intranet/intranet.php?consultarid="+consultar);
      }
    */

    $("#frmAcceso").on('submit', function (e) {
      e.preventDefault();
      tipop = $('#tipopart').val();
      usuario = $("#usuario").val();
      pass = $("#pass").val();
      if (tipop == "docente") {
        $.post("../controladores/validacion.php?op=logindocente",
          { "usuario": usuario,
            "pass":pass
          },
          function (data) {
            if (data != "null") {
              consulta = jQuery.parseJSON(data);
              //  console.log(consulta.num_documento);
           
              //  $(location).attr("href","http://localhost/encap.app.v6/intranet/intranet-docentes.php?docente="+consulta.num_documento);
             
              $(location).attr("href", "https://sistemas.encap.edu.pe/intranet/intranet-docentes.php?docente=" + consulta.num_documento);
            }
            else if( usuario != pass){
              swal("Contraseña incorrecta.", "", "error");
            }else{
              swal("No se encontró al docente.", "", "error");
            }
          });
      } else {
       $.post("../controladores/validacion.php?op=login",
          { "usuario": usuario,
            "pass":pass },
          function (data) {
            if (data != "null") {
              consulta = jQuery.parseJSON(data);
              //console.log(consulta.num_documento);
              localStorage.setItem('miusuario',consulta.idpersona);
              
          
                $(location).attr("href","http://localhost:2020/encap2023/intranet/intranet2.php");
            //  $(location).attr("href", "https://sistemas.encap.edu.pe/intranet/intranet2.php?consultarid=" + consulta.num_documento);
              

            }else if( usuario != pass){
              swal("Contraseña incorrecta.", "", "error");
            }
            else {
              swal("No se encontró al alumno.", "", "error");
            }
          });
       

      }
    })
  </script>

  <!-- sweetalert2 -->
  <script src="../public/js/sweetalert.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../public/js/app.min.js"></script>
  <script src="../public/js/bootstrap-select.min.js"></script>
  <!-- sweetalert2 -->
  <script src="../public/js/sweetalert.min.js"></script>
</body>

</html>