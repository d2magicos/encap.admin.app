<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf8_general_ci">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>ENCAP | Validación de certificados</title>
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

      <!--Hoja de estilos de validacion de certificados-->
      <link rel="stylesheet" href="css/certificados.css">
  </head>

  

  <body class="certificados">
  <section class="contenedor__certificados">
    <div class="imagenCertificados">
      <a href="imagenCertificados__contenedor">
        <img src="../files/certificados.png" alt="logo encap" width="120px" height="100%">
      </a>                
    </div><br>

    <div class="certificadosForm">
      <form method="post" id="frmAcceso" >         
        <div class="certificadosForm__entradas">
          <h1 class="certificadosForm__heading" id="titulo" >VALIDACIÓN DE CERTIFICADO PARA ALUMNOS</h1><br>



          <div style="display: flex; background: #c3c1c1;border-radius: 20px;height: fit-content;width:330px;margin:auto;margin-bottom:20px">

            <script>

              function Activar(id){
                var activo= document.getElementById(id);

                
                
                var buttons = document.getElementsByClassName("button_active");
               // var mensaje = document.getElementById('mensaje');
                var titulo = document.getElementById("titulo");
                
                for(var x=0;x<buttons.length;x++){
                  buttons[x].style.cssText="width:50%;background:#c3c1c1;border-radius: 20px;padding:10px;color:black;font-weight:bold;text-align:center;margin:0";
                }
                if(id=="alumno"){
                  titulo.innerHTML="VALIDACIÓN DE CERTIFICADO PARA ALUMNOS";
                  activo.style.cssText="width:50%;background:#28e4f0;border-radius: 20px;padding:10px;color:black;font-weight:bold;box-shadow: rgb(136 136 136) 2px 10px 6px -4px;transition-duration:0.5s;text-align:center;margin:0;transform: scale(1.1)";
               //   mensaje.innerHTML="¡Bienvenido Alumno!";
                }else{
                  titulo.innerHTML="VALIDACIÓN DE CERTIFICADO PARA DOCENTES";
                  activo.style.cssText="width:50%;background:#004daa;border-radius: 20px;padding:10px;color:white;font-weight:bold;box-shadow: rgb(136 136 136) 2px 10px 6px -4px;transition-duration:0.5s;text-align:center;margin:0;transform: scale(1.1)";
               //   mensaje.innerHTML="¡Bienvenido Docente!";
                }
              
                var tipop=document.getElementById("tipopart");
                tipop.value= id;
                console.log(tipop.value);
                

              }

            </script>
            <p id="alumno" class="button_active" href=""  style="font-size:16px;width:50%;background:#28e4f0;border-radius: 20px;padding:10px;color:black;font-weight:bold;box-shadow: rgb(136 136 136) 2px 10px 6px -4px;text-align:center;margin:0" tabindex="1" role="button" aria-disabled="false" onclick="Activar(this.id);"  style="padding-right: 32px; z-index: 0;">Alumno</p>

            <p id="docente" class="button_active" href="" style="font-size:16px;width:50%;background:#c3c1c1;border-radius: 20px;padding:10px;color:black;font-weight:bold;text-align:center;margin:0" tabindex="0" role="button" aria-disabled="false" onclick="Activar(this.id);"  >Docente</p>
              <input type="hidden" id="tipopart" value="alumno"></input>

          </div>

          <div class="certificadosBuscador" >
            <div class="certificadosBuscador__entrada">              
              <input type="text" id="consultar" name="consultar" placeholder="Ingresa tu código de matricula" style="border-radius:10px">

             <!-- <select style="padding:10px;color: black;font-weight:bold;border:0;background:gray;color:white" id="tipo">
                <option value="Alumno">Alumno</option>
                <option value="Docente">Docente</option>
              </select> -->             
            </div>                                    
            <div class="certificadosBuscador__busqueda">                      
              <button name="btnBuscar" type="submit"><i class="fa fa-search"></i>Validar Certificado</button>
            </div>
          </div>

          <div class="certificadosBuscador__texto" >                       
            <p> Valida si has estudiado con nosotros (desde enero del año 2022) </p>  
          </div>                          
        </div>        
      </form>
    </div>                 
  </section>

    <!-- jQuery -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>
     <!-- Bootbox -->
    <script src="../public/js/bootbox.min.js"></script>	

  <script type="text/javascript">

   /* function Consulta(){
      consultar=$("#consultar").val();
      $(location).attr("href","http://localhost/SISt_ENCAP_V2/certificados/certificados.php?consultarid="+consultar);

    }*/


    $("#frmAcceso").on('submit',function(e)
            {
                e.preventDefault();
                consultar=$("#consultar").val();
                tipo=$("#tipopart").val();
                console.log(tipo);
                if(tipo=="alumno"){
                      $.post("../controladores/validacion.php?op=verificar",
                        {"consultar":consultar},
                        function(data)
                    {
                        if (data!="null")
                        { 
                         
                         //   $(location).attr("href","http://localhost/SISt_ENCAP_V2/certificados/certificados.php?consultarid="+consultar);
                                                  
                          
                         //    $(location).attr("href","https://sistemas.encap.edu.pe/certificados/certificados.php?consultarid="+consultar);
                         $(location).attr("href","https://sistemas.encap.edu.pe/certificados/certificados.php?consultarid="+consultar);
                        }
                        else
                        {
                            swal("No se encontró el alumno.","","error");
                        }
                    });
                }else{
                    $.post("../controladores/validacion.php?op=verificarDocente",//Tener cuidado al implementar este metodo, solo copiar la funcion
                    //en el hosting
                          {"consultar":consultar},
                          function(data)
                      {
                          if (data!="null")
                          { 
                           
                             // $(location).attr("href","http://localhost/SISt_ENCAP_V2/certificados/certificados.php?docente="+consultar);
                            
                             
                            
                            
                             //    $(location).attr("href","https://sistemas.encap.edu.pe/certificados/certificados.php?docente="+consultar);
                             $(location).attr("href","https://sistemas.encap.edu.pe/certificados/certificados2-docente.php?docente="+consultar);
                          }
                          else
                          {
                              swal("No se encontró el docente.","","error");
                          }
                      });
                }

              
            })

 

      
      
    </script>

<!-- sweetalert2 -->
<!--<script src="../public/js/sweetalert.min.js"></script>-->
<!-- AdminLTE App -->
<script src="../public/js/app.min.js"></script>
<script src="../public/js/bootstrap-select.min.js"></script>
<!-- sweetalert2 -->
<script src="../public/js/sweetalert.min.js"></script>  
</body>
</html>
