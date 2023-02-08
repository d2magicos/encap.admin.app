
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
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
  <link rel="stylesheet" href="../public/css/sweetalert.min.css">

  <!--Estilos para adaptar a dispositivos moviles-->
  <link rel="stylesheet" href="css/interface.css">

  </head>

  <body class="hold-transition contenedor__intranet" id="contenedor__intranet">
    <div class="wrapper" id="wrapper" style="height: auto;/* position: absolute; *//* overflow-x: hidden; *//* overflow-y: auto; */float: left;width: 100%;">
      <section class="content">
            <div class="row" >
              <div class="col-md-12">
                    <!-- centro -->
                    <div class="panel-body">

                      <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="padding:0px 5px 50px 5px;"> -->
                        <a href="#" class="contenedor__imagen__intranet">
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

                                if(isset($_GET["consultarid"])){
                                  $doc=$_GET["consultarid"];
                                }else{
                                  $doc=null;
                                }

                                if(isset($_GET["docente"])){
                                  $prof=$_GET["docente"];
                                }else{
                                  $prof=null;
                                }

                               
                              
                                

                                if($doc!=null){
                                  $resultadop = mysqli_query($conexion,"SELECT nombre, num_documento,departamento,ciudad
                                  FROM persona WHERE num_documento='".$doc."'");
                                }else if($prof!=null){
                                  $resultadop = mysqli_query($conexion,"SELECT nombre, num_documento,departamento,ciudad
                                  FROM docente WHERE num_documento='".$prof."'");
                                }
                                
                               

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

                          <p>&nbsp;</p>
                        <div class="clock" style="text-align: right; color: black;" >								
                        <p class="icon-datos"> <span  id="Date"> </span> &nbsp; <i class="fa fa-calendar"></i> </p>
                        <ul>
                          <li id="hours"></li>
                          <li id="point">:</li>
                          <li id="min"></li>
                          <li id="point">:</li>
                          <li id="sec"></li> &nbsp;
                          <i class="fa fa-clock-o"></i> 
                        </ul>
                      </div>
                      </div>                      

                      <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 ">                
                      </div>    
                      <br> <br> <br>
                      
                      <div class="panel-body">
                               
                        <?php
                    
                         
                                if($doc!=null){
                                     if($doc=="") //VERIFICO 
                                        {echo "
                                          ";}
                                        else
                                      {  
                    
                                        $resultados = mysqli_query($conexion,"SELECT cursos.nombre,ca.nombre as categoria, cursos.n_horas, m.fecha_inicio ,m.cod_matricula,
                                        persona.nombre AS participante, persona.num_documento,m.estadoventa ,m.idplantilla, m.cod_matricula,m.certificado as certificado,enlace,aula
                                        FROM cursos INNER JOIN matricula m ON cursos.idcurso = m.idcurso 
                                        INNER JOIN categoria ca ON ca.idcategoria = cursos.idcategoria
                                        INNER JOIN persona ON m.idparticipante = persona.idpersona 
                                        WHERE m.estadoventa ='ACTIVADO' and persona.num_documento ='$doc' 
                                        ORDER BY m.idmatricula DESC");
              
              
                                        $row = mysqli_num_rows($resultados);
              
                                        if($row<1){
                                          echo "  <div class='col-lg-8 col-md-12 col-sm-12 col-xs-12' style='text-align: center;'>
                                          <h3>No estas matriculado en ningún curso.</h3>  
                                          </div>";
                                        }else{
                                          echo 
                                          "
                                          <div class='col-lg-2 col-md-12 col-sm-12 col-xs-12'>
                                          </div>
                      
                                          <div class='col-lg-8 col-md-12 col-sm-12 col-xs-12' >
                                          <h4> <strong>Cursos: </strong></h4>
                                            <div class='row' style='max-width: 100%;overflow-y: auto;' >
                                              <div class='col-lg-12' style='border-color:  #21618c ; border-radius: 20px; border-width: 2px; border-style: solid; padding: 10px 5px; width: fit-content;'>
                                                
                                                <table class='tabla__intranet table table-striped table-bordered table-condensed table-hover text-center' width=\"100%\" id='tabla' >
                                                
                                                <tr style='background-color:#003e99;color:white' > 
                                                    <th class='codigo_curso'><b><center>Codigo Matricula</center></b></th>                       
                                                    <th><b><center>Nombre del Curso</center></b></th>
                                                    <th class='detallesCurso'><b><center>Detalles de curso</center></b></th>
                                                    <th class='tipo__curso' ><b><center>Tipo de Curso</center></b></th>
                                                    <th class='numero__horas' ><b><center>Numero de Horas</center></b></th>
                                                    <th class='fecha' ><b><center>Fecha </center></b></th>  
                                                    <th class='certificado' ><b><center>Certificado </center></b></th>  
                                                    <th class='aula__virtual' ><b><center>Aula Virtual</center></b></th>    
                                                    <th class='materiales' ><b><center>Materiales</center></b></th> 
                                                  </tr>  ";
                                                  
                                              while($consulta = mysqli_fetch_array($resultados))
                                              {  
                                              
                                                      echo "
                                                      
                                                    <tr class='filas' codigo='".$consulta['cod_matricula']."' nombre='".$consulta['nombre']."' tipo='".$consulta['categoria']."' numero='".$consulta['n_horas']."' fecha='".$consulta['fecha_inicio']."' certificado='".$consulta['certificado']."' materiales='".$consulta["enlace"]."' aula='".$consulta["aula"]."'>
                                                
                                                    <td class='codigo_curso' id='codMatricula'
                                                      id='codmatricula'>".$consulta['cod_matricula']."</td>
                                                      <td id='nombreCurso' val='".trim($consulta['nombre'])."'>".$consulta['nombre']."</td>
                                                      <td class='detallesCurso'><a class='botonpopup' onclick='llamarModal()'>Ver Detalles</a></td>
                                                      <td id='tipoCurso' class='tipo__curso'>".$consulta['categoria']."</td>
                                                      <td id='numeroHoras' class='numero__horas' >".$consulta['n_horas']."</td>
                                                      <td id ='fechaInicio'class='fecha' >".$consulta['fecha_inicio']."</td>";

                                                      //codigo por categorias de curso
                                                        /*                            
                                                          if($consulta['categoria']=="CURSO CORTO"){
                                                       
                                                                                     
                                                           if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                                            echo "<td class='certificado'><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                                            
                                                          }else{
                                                            
                                                        
                          
                                                              echo "<td class='certificado' ><a href='../cert_digitales/curso_corto.php?id=".trim($consulta['cod_matricula'])."'  target='_blank'><img src='../files/btn3.png' style='width:150px;height;auto'></a>
                                                           </td>";
                                                           
                                                          }
                                                          
                                                          }else if($consulta['categoria']=="DIPLOMA" || $consulta['categoria']=="MOVIMIENTO SIERRA Y SELVA CONTIGO JUNÍN" ){
                                                           if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                                             echo "<td class='certificado'><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                                             
                                                           }else{
                                                             
                                                         
                           
                                                               echo "<td class='certificado' ><a href='../cert_digitales/diploma.php?id=".trim($consulta['cod_matricula'])."'  target='_blank'><img src='../files/btn3.png' style='width:150px;height;auto'></a>
                                                            </td>";
                                                            
                                                           }
                                                      
                                                          }else if($consulta['categoria']=="CONVENIO CIP HUANCAVELICA"){
                                                           if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                                             echo "<td class='certificado'><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                                             
                                                           }else{
                                                             
                                                         
                           
                                                               echo "<td class='certificado' ><a href='../cert_digitales/diplomacip.php?id=".trim($consulta['cod_matricula'])."'  target='_blank'><img src='../files/btn3.png' style='width:150px;height;auto'></a>
                                                            </td>";
                                                            
                                                           }
                                                      
                                                          }else{
                           
                                                           if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                                             echo "<td class='certificado' ><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                                             
                                                           }else{
                                                        
                                                          echo "<td class='certificado' ><a href='../cert_digitales/diploma_especializacion.php?id=".trim($consulta['cod_matricula'])."' target='_blank'><img src='../files/btn3.png' style='width:150px;height;auto'></a>
                                                          </td>";
                                                           }
                                                        
                                                          
                                                          }*/
                                                
                                               //codigo dinamico para certificados
                                                
                                                      if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                                        echo "<td><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                                        
                                                      }else{
                                                        echo  "<td><a href='../cert_digitales/".$consulta['idplantilla']."?id=".trim($consulta['cod_matricula'])."' target='_blank'><img src='../files/btn3.png' style='width:150px;height:auto'></a>
                                                        </td>"; 
                                                    
                                                      
                                                      }



              
                                                    
                                                    
                                                    
                      
                                                    if(!empty($consulta["aula"])){
                                                      echo  "<td><a href='".$consulta["aula"]."'   target='_blank'><img src='../files/btn1.png' style='width:150px;height:auto'></a></td>";
                                                      
                                                    }else{
                                                      echo  "<td class='span'></td>";
                                                    }
                      
                      
                                                    if(!empty($consulta["enlace"])){
                                                      echo  "<td><a href='".$consulta["enlace"]."'   target='_blank'><img src='../files/btn2.png' style='width:150px;height:auto'></a></td>";
                                                    
                                                    }else{
                                                      echo  "<td class='span'></td>";
                                                    }
                                                    
                                                  
                                                            
                                                    "</tr> ";
                                                    }
                                                echo "
                                                  </table>
                                                  
                                          </div>
                      
                                          <div class='col-lg-2 col-md-12 col-sm-12 col-xs-12'>
                                                  
                                          </div>            
                                          "; 
                                        }
              
                              
                                  }
                                }else if($prof!=null){
                                    if($prof=="") //VERIFICO 
                                      {echo "
                                        ";}
                                      else
                                    {  
                  
                                        $resultados = mysqli_query($conexion,"SELECT cursos.nombre,ca.nombre as categoria, cursos.n_horas, m.fecha_inicio ,m.cod_matricula,
                                        d.nombre AS participante, d.num_documento,m.idplantilla, m.cod_matricula,m.certificado as certificado,enlace,aula
                                        FROM cursos INNER JOIN matricula_docentes m ON cursos.idcurso = m.idcurso 
                                        INNER JOIN categoria ca ON ca.idcategoria = cursos.idcategoria
                                        INNER JOIN docente d ON m.idparticipante = d.idpersona 
                                        WHERE d.num_documento ='$prof' 
                                        ORDER BY m.idmatricula DESC");
              
              
                                        $row = mysqli_num_rows($resultados);
              
                                        if($row<1){
                                          echo "  <div class='col-lg-8 col-md-12 col-sm-12 col-xs-12' style='text-align: center;'>
                                          <h3>No estas matriculado en ningún curso.</h3>  
                                          </div>";
                                        }else{
                                          echo 
                                          "
                                          <div class='col-lg-2 col-md-12 col-sm-12 col-xs-12'>
                                          </div>
                      
                                          <div class='col-lg-8 col-md-12 col-sm-12 col-xs-12' >
                                          <h4> <strong>Cursos: </strong></h4>
                                            <div class='row' style='max-width: 100%;overflow-y: auto;' >
                                              <div class='col-lg-12' style='border-color:  #21618c ; border-radius: 20px; border-width: 2px; border-style: solid; padding: 10px 5px; width: fit-content;'>
                                                
                                                <table class='tabla__intranet table table-striped table-bordered table-condensed table-hover text-center' width=\"100%\" id='tabla' >
                                                
                                                <tr style='background-color:#003e99;color:white' > 
                                                    <th class='codigo_curso'><b><center>Codigo Matricula</center></b></th>                       
                                                    <th><b><center>Nombre del Curso</center></b></th>
                                                    <th class='detallesCurso'><b><center>Detalles de curso</center></b></th>
                                                   
                                                    <th class='fecha' ><b><center>Fecha </center></b></th>  
                                                    <th class='certificado' ><b><center>Certificado </center></b></th>  
                                                   
                                                  </tr>  ";
                                                  
                                              while($consulta = mysqli_fetch_array($resultados))
                                              {  
                                              
                                                      echo "
                                                      
                                                    <tr class='filas' codigo='".$consulta['cod_matricula']."' nombre='".$consulta['nombre']."' tipo='DOCENTES' url='".$consulta['idplantilla']."' numero='".$consulta['n_horas']."' fecha='".$consulta['fecha_inicio']."' certificado='".$consulta['certificado']."' materiales='".$consulta["enlace"]."' aula='".$consulta["aula"]."'>
                                                
                                                    <td class='codigo_curso' id='codMatricula'
                                                      id='codmatricula'>".$consulta['cod_matricula']."</td>
                                                      <td id='nombreCurso' val='".trim($consulta['nombre'])."'>".$consulta['nombre']."</td>
                                                      <td class='detallesCurso'><a class='botonpopup' onclick='llamarModal()'>Ver Detalles</a></td>
                                                   
                                                      <td id ='fechaInicio'class='fecha' >".$consulta['fecha_inicio']."</td>";
                                                
                                                  //  echo  "<td><a href='../cert_digitales/curso_corto.php?id=".trim($consulta['cod_matricula'])."' class='btn btn-block btn-danger btn-xs' target='_blank'>VER CERTIFICADO</a>
                                                    // </td>";  
                      
                                                      if($consulta['certificado']=="NO" || empty($consulta['certificado'])){
                                                        echo "<td><span class='badge bg-yellow'><i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> CERTIFICADO EN PROCESO</span></td>";
                                                        
                                                      }else{
                                                        echo  "<td><a href='../cert_digitales/".$consulta['idplantilla']."?id=".trim($consulta['cod_matricula'])."' target='_blank'><img src='../files/btn3.png' style='width:150px;height:auto'></a>
                                                        </td>"; 
                                                    
                                                      
                                                      }
                                                                 
                                                    
                                                    
                      
                                                   
                                                    
                                                  
                                                            
                                                    "</tr> ";
                                                    }
                                                echo "
                                                  </table>
                                                  
                                          </div>
                      
                                          <div class='col-lg-2 col-md-12 col-sm-12 col-xs-12'>
                                                  
                                          </div>            
                                          "; 
                                        }
              
                              
                                  }
                                }




                      
            ?>          
            </div>
                  <!--Fin centro -->
                  </div><!-- /.box btn-block -->
                 </div><!-- /.col -->

                 <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">  <br>                                          
                    <a href="../intranet/" class="btn btn-success" ><i class="fa fa-reply"></i>  Salir</a>               
                  </div>  -->
      </section><!-- /.content -->
    
    <!--seccion ára los enlaces de intres de los alumnos-->
    <section class="enlacesInteres">
      <h2 class="enlacesInteres__heading" >Enlaces de Interés</h2>
      <div class="boxEnlaces">
        <div class="box">
          <img src="img/icono1.png" alt="Icono validación de cetificados">
          <h3>Validación de<br> Certificados</h3>
          <a target="_blank" class="boxEnlaces__btn" href="https://sistemas.encap.edu.pe/certificados/">Ver más</a>      
        </div>
        <div class="box">
        <img src="img/icono2.png" alt="Icono validación de cetificados">
          <h3>Seguimiento de envío de certificados en físico</h3>
          <a target="_blank" class="boxEnlaces__btn" href="https://sistemas.encap.edu.pe/tracking/">Ver más</a>  
        </div>
        <div class="box">
        <img src="img/icono3.png" alt="Icono validación de cetificados">
          <h3>Bolsa de<br> trabajo</h3>
          <a target="_blank" class="boxEnlaces__btn" href="https://sistemas.encap.edu.pe/bolsa_de_trabajo/">Ver más</a>  
        </div>
        
        
         <div class="box">
        <img src="img/icono23.png" alt="Icono validación de cetificados">
          <h3>Grupo exclusivo</h3>
          <a target="_blank" class="boxEnlaces__btn" style="background-color:rgb(0 187 54);font-family:Arial, Helvetica, sans-serif" href="https://chat.whatsapp.com/Jly7TX1qmPVGUXIb8bkTQh">Únete al grupo exclusivo en Whatsapp</a>  
        </div>
      </div>

                 <div style="margin:20px 0 30px 0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">        <br>                                          
                    <a href="../intranet/" class="btn btn-success" ><i class="fa fa-reply"></i>  Salir</a>               
                  </div>         
    </section>

    </div><!-- /.row -->

    

    <section class="ventanaModal" id="ventanaModal">
      <div class="contenedor_modal">
        <div class="contenedor_campo">
          <span>Código de Mátricula:</span>
          <p id="campoOne"></p>
        </div>
        <div class="contenedor_campo">
          <span>Nombre del Curso:</span>
          <p id="campoDos"></p>
        </div>
        <?php
        if(!isset($_GET['docente'])){

        
        ?>
        <div class="contenedor_campo">
          <span>Tipo de Curso:</span>
          <p id="campoTres" ></p>
        </div>
        <div class="contenedor_campo">
          <span>Número de Horas:</span>
          <p id="campoCuatro"></p>
        </div>
        <?php }else{?>
          <div class="contenedor_campo" style="display: none;">
          <span>Tipo de Curso:</span>
          <p id="campoTres" ></p>
        </div>
        <div class="contenedor_campo" style="display: none;">
          <span>Número de Horas:</span>
          <p id="campoCuatro"></p>
        </div>
        <?php }?>
        <div class="contenedor_campo">
          <span>Fecha:</span>
          <p id="campoCinco"></p>
        </div>
        <div class="contenedor_campo">
          <span>Certificado:</span>
          <p>
            <a target="_blank" class="btncertificado" href="" id="campoSeis">Ver Certificado</a>
            <a target="_blank" id="campoSeisMod" class="btncertificadoNone" href="#" >Certificado en Proceso</a>
          </p>
        </div>
        <?php
        if(!isset($_GET['docente'])){

        
        ?>
        <div class="contenedor_campo">
          <span>Aula Virtual:</span>
          <p>
            <a href="" target="_blank" id="campoOcho" class="btnAula">Ir a Aula Virtual</a>
            <a href="" target="_blank" id="campoOchoMod" class="btnAula">mmm</a>
          </p>
        </div>
        <div class="contenedor_campo">
          <span>Materiales:</span>
          <p>
            <a target="_blank" class="btnMateriales" href="" id="campoSiete">Ir a materiales</a>
            <a target="_blank" class="btnMateriales" href="" id="campoSieteMod">mmm</a>
          </p>
        </div>
          <?php }else{?>
            <div class="contenedor_campo" style="display:none">
          <span>Aula Virtual:</span>
          <p>
            <a href="" target="_blank" id="campoOcho" class="btnAula">Ir a Aula Virtual</a>
            <a href="" target="_blank" id="campoOchoMod" class="btnAula">mmm</a>
          </p>
        </div>
        <div class="contenedor_campo" style="display:none">
          <span>Materiales:</span>
          <p>
            <a target="_blank" class="btnMateriales" href="" id="campoSiete">Ir a materiales</a>
            <a target="_blank" class="btnMateriales" href="" id="campoSieteMod">mmm</a>
          </p>
        </div>

            <?php }?>
        <div id='modalClose' onclick="cerrarModal()" class="modal__close"><i class="fa fa-close icono__cerrar"></i>Cerrar</div>
      </div>
       

    </section>

  

      <footer class="main-footer text-center" style="margin-left: 0px;margin-left: 0px;float: left;width: 100%;"> 
          <p><strong>Escuela Nacional de Capacitación y Actualización Profesional</strong></p>
          <p> RUC: 20603336250</p>
                <div style="display:flex;margin:auto;justify-content: center;">
                <p style="padding:10px;text-align:center"><strong>Área de VENTAS:</strong><br>
                &nbsp;Cel. 951 428 884<br>
                &nbsp;Cel. 930 627 791</p>

                 <p style="padding:10px;text-align:center"><strong>Área de SOPORTE:</strong><br>
                 &nbsp;Cel. 925 248 166</p>

                </div>
          
      </footer>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--Script para ventana modal-->
    <script src="js/main.js"></script>

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

 <script>

$(document).ready(function(){
    $('#tabla').after('<div id="nav" style="text-align:center"></div>');
    var rowsShown = 10;
    var rowsTotal = $('#tabla tbody .filas').length;
    var numPages = rowsTotal/rowsShown;

    $('#nav').append("Paginas:&nbsp;&nbsp;");

    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" class="paginate_button" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#tabla tbody .filas').hide();
    $('#tabla tbody .filas').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#tabla tbody .filas').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});


 </script>

<script type="text/javascript">
		$(document).ready(function() {
		// Making 2 variable month and day
		var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Deciembre" ]; 
		var dayNames= ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"]

		// make single object
		var newDate = new Date();
		// make current time
		newDate.setDate(newDate.getDate());
		// setting date and time
		$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' de ' + monthNames[newDate.getMonth()] + ' del ' + newDate.getFullYear());

		setInterval( function() {
		// Create a newDate() object and extract the seconds of the current time on the visitor's
		var seconds = new Date().getSeconds();
		// Add a leading zero to seconds value
		$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
		},1000);

		setInterval( function() {
		// Create a newDate() object and extract the minutes of the current time on the visitor's
		var minutes = new Date().getMinutes();
		// Add a leading zero to the minutes value
		$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
		},1000);

		setInterval( function() {
		// Create a newDate() object and extract the hours of the current time on the visitor's
		var hours = new Date().getHours();
		// Add a leading zero to the hours value
		$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
		}, 1000); 
		});
</script>

 
</body>
</html>