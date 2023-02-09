<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
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
  <link rel="stylesheet" href="../public/css/sweetalert.min.css">
  </head>

  <body class="hold-transition ">
    <div class="wrapper">
      <section class="content">
            <div class="row">
              <div class="col-md-12">
                    <!-- centro -->
                    <div class="panel-body">

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="padding:0px 5px 50px 5px">
                        <a href="">
                          <img src="../files/logo.png" alt="" width="280px" height="100%">
                         </a>                          
                      </div>

                      <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" >
                      </div>

                      <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" style="border-radius: 20px;">
                        <h4>Datos del <strong>participante</strong> </h4>
                        <div class="row" >
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-color:  #21618c ;border-radius: 20px; border-width: 2px; border-style: solid; padding: 10px;">
                              <div class="col-lg-2 text-center" style="padding:5px" >
                                <img src="../files/student.webp" alt="" width="130px" height="100%">
                              </div>

                              <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="font-size:14px">
                                <label style="font-size:18px;text-align:center"><strong ><?php echo $_SESSION['nombres']; ?></strong></label><br>
                                  N° de Documento: <strong> &nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $_SESSION["dni"]; ?></strong><br>
                                  Departamento: <strong> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $_SESSION["departamento"]; ?></strong><br>
                                  Ciudad: <strong> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $_SESSION["ciudad"]; ?></strong><br>                             

                              </div>
                          </div>                    

                        </div>
                      </div>                      

                      <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">                
                      </div>   
                      <br> <br> <br>
                      
                      <div class="panel-body">
                               
                        <?php
                      require "../configuraciones/Conexion.php";
                        $doc = $_SESSION["dni"];
                        
                        if($doc=="") //VERIFICO 
                          {echo "
                            ";}
                          else
                        {  
      
                          $resultados = mysqli_query($conexion,"SELECT p.idpresencial,p.fecha,p.codigo,p.nombres,p.dni,p.departamento,
                          p.ciudad,p.curso,p.fecha_certificado,p.horas  FROM  presenciales p WHERE p.dni = '$doc'
                          AND p.condicion=1 ORDER BY p.idpresencial DESC");
                  echo 
                    "
                    <div class='col-lg-2 col-md-12 col-sm-12 col-xs-12'>
                    </div>

                    <div class='col-lg-8 col-md-12 col-sm-12 col-xs-12' >
                    <br><h4> <strong>Cursos: </strong></h4>
                      <div class='row'>
                        <div class='col-lg-12' style='border-color:  #21618c ; border-radius: 20px; border-width: 2px; border-style: solid; padding: 10px 5px;'>
                          
                          <table class='table table-striped table-bordered table-condensed table-hover text-center' width=\"100%\" >
                            <tr style='background-color:#65d2ed' >                        
                              <td><b><center>Fecha</center></b></td>
                              <td><b><center>Código de Matricula</center></b></td>
                              <td><b><center>Nombre del Curso</center></b></td>
                              <td><b><center>Fecha de Certificación</center></b></td>
                              <td><b><center>Horas </center></b></td>             
                            </tr>";
                        while($consulta = mysqli_fetch_array($resultados))
                        {
                                echo "
                              <tr class='filas'>
                                <td>".$consulta['fecha']."</td>
                                <td>".$consulta['codigo']."</td>
                                <td>".$consulta['curso']."</td>
                                <td>".$consulta['fecha_certificado']."</td>
                                <td>".$consulta['horas']."</td>    
                              </tr>";
                              }
                          echo "
                            </table>
                              
                    </div>

                    <div class='col-lg-2 col-md-12 col-sm-12 col-xs-12'>
                    </div>              
                    "; 
                  }
            ?>          
            </div>
                  <!--Fin centro -->
                  </div><!-- /.box btn-block -->
                 </div><!-- /.col -->

                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">  <br>                                          
                    <a href="../controladores/validacion.php?op=salirpresencial" class="btn btn-success" ><i class="fa fa-reply"></i>  Realizar otra consulta</a>               
                  </div> 

                 
              </div><!-- /.row -->
          </section><!-- /.content --> 

      <footer class="main-footer text-center"> 
          <strong > Copyright &copy; <script>document.write(new Date().getFullYear());</script>  </strong>
            Todo los derechos reservados por <a href="https://encap.edu.pe/cursos/" target="_blank">ENCAP SAC</a>
      </footer>   

    <!-- jQuery -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/js/app.min.js"></script>

    <script src="../public/js/bootbox.min.js"></script> 
    <script src="../public/js/bootstrap-select.min.js"></script>
    <!-- sweetalert2 -->
 <script src="../public/js/sweetalert.min.js"></script>  
</body>
</html>