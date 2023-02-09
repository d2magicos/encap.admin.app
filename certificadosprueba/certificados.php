
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
            <div class="row" >
              <div class="col-md-12">
                    <!-- centro -->
                    <div class="panel-body">

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="padding:0px 5px 50px 5px;">
                        <a href="">
                          <img src="../files/ENCAP.ico" alt="" width="120px" height="100%">
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

                              <?php 
                                require "../configuraciones/Conexion.php";

                                $doc=$_GET["consultarid"];

                                $resultadop = mysqli_query($conexion,"SELECT nombre, num_documento,departamento,ciudad,m.cod_matricula
                              FROM persona p INNER JOIN matricula m ON m.idparticipante = p.idpersona WHERE m.cod_matricula='".$doc."'");

                                $consulta = mysqli_fetch_array($resultadop);

                                if($consulta!=null){
                                  echo '<label style="font-size:18px;text-align:center"><strong >'.$consulta["nombre"].'</strong></label><br>';
                                  echo 'N° de Documento: <strong> &nbsp&nbsp&nbsp&nbsp&nbsp'.$consulta["num_documento"].'</strong><br>';
                                  echo 'Departamento: <strong> &nbsp&nbsp&nbsp&nbsp&nbsp'.$consulta["departamento"].'</strong><br>';
                                  echo 'Ciudad: <strong> &nbsp&nbsp&nbsp&nbsp&nbsp'.$consulta["ciudad"].'</strong><br>';
                                }else{
                                  echo '<label style="font-size:18px;text-align:center"><strong >&nbsp;</strong></label><br>';
                                  echo '<label style="font-size:18px;text-align:center"><strong >No se encontro el participante.</strong></label><br>';
                              
                                }

                                
                              
                              ?>

                       
                              </div>
                          </div>                    

                        </div>
                      </div>                      

                      <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">                
                      </div>   
                      <br> <br> <br>
                      
                      <div class="panel-body">
                               
                        <?php
                    
                         
                        
                        if($doc=="") //VERIFICO 
                          {echo "
                            ";}
                          else
                        {  
      
                          $resultados = mysqli_query($conexion,"SELECT cursos.nombre,ca.nombre as categoria, cursos.n_horas, m.fecha_inicio ,m.cod_matricula,
                           persona.nombre AS participante, persona.num_documento,m.estadoventa , m.cod_matricula,m.certificado as certificado,enlace,aula
                          FROM cursos INNER JOIN matricula m ON cursos.idcurso = m.idcurso 
                          INNER JOIN categoria ca ON ca.idcategoria = cursos.idcategoria
                          INNER JOIN persona ON m.idparticipante = persona.idpersona 
                          WHERE m.estadoventa ='ACTIVADO' and m.cod_matricula ='$doc' 
                          ORDER BY m.idmatricula DESC");
                  echo 
                    "
                    <div class='col-lg-2 col-md-12 col-sm-12 col-xs-12'>
                    </div>

                    <div class='col-lg-8 col-md-12 col-sm-12 col-xs-12' >
                    <br><h4> <strong>Cursos: </strong></h4>
                      <div class='row' style='max-width: 100%;overflow-y: auto;' >
                        <div class='col-lg-12' style='border-color:  #21618c ; border-radius: 20px; border-width: 2px; border-style: solid; padding: 10px 5px; width: fit-content;'>
                          
                          <table class='table table-striped table-bordered table-condensed table-hover text-center' width=\"100%\" >
                            <tr style='background-color:#65d2ed' > 
                            <td><b><center>Codigo Matricula</center></b></td>                       
                              <td><b><center>Nombre del Curso</center></b></td>
                              <td><b><center>Tipo de Curso</center></b></td>
                              <td><b><center>Numero de Horas</center></b></td>
                              <td><b><center>Fecha </center></b></td>  
                              <td><b><center>Certificado </center></b></td>  
                            
                            </tr>";
                        while($consulta = mysqli_fetch_array($resultados))
                        {
                                echo "
                              <tr class='filas'>
                              <td>".$consulta['cod_matricula']."</td>
                                <td>".$consulta['nombre']."</td>
                                <td>".$consulta['categoria']."</td>
                                <td>".$consulta['n_horas']."</td>
                                <td>".$consulta['fecha_inicio']."</td>";
                               if($consulta['categoria']=="CURSO CORTO"){
                               echo  "<td><a href='../cert_digitales/curso_corto.php?id=".trim($consulta['cod_matricula'])."' class='btn btn-block btn-danger btn-xs' target='_blank'>VER CERTIFICADO</a>
                                </td>";  
                               
                               }else if($consulta['categoria']=="DIPLOMA"){
                                if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                  echo "<td><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                  
                                }else{
                                  
                                  echo "<td><a href='../cert_digitales/diploma.php?id=".trim($consulta['cod_matricula'])."' class='btn btn-block btn-danger btn-xs' target='_blank'>VER DIPLOMA</a>
                                  </td>";
                                 
                                }
                           
                               }else{

                                if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                  echo "<td><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                  
                                }else{
                                  
                                  echo "<td><a href='../cert_digitales/diploma_especializacion.php?id=".trim($consulta['cod_matricula'])."' class='btn btn-block btn-danger btn-xs' target='_blank'>VER DIPLOMA</a>
                                  </td>";
                                 
                                }
                             
                               
                               }

                                                         
                             
                               
                              
                                       
                              "</tr>";
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
                    <a href="../certificadosprueba/" class="btn btn-success" ><i class="fa fa-reply"></i>  Realizar otra consulta</a>               
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