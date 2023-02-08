<?php
require 'modulos/header.php';
?>
  <body class="hold-transition login-page" style="background-color: #1B2544 ; background-size: 100% 100%; background-attachment: fixed">

    <article class="all-browsers">
       
      <article class="browser">
        <div class="row" style="text-center">
          <div class="col-md-3" >

          </div>

          <div class="col-md-6" >
            <p class=" login-box-msg" style="color:#fff; font-size: 30px">VERIFICAR CERTIFICADOS</p>
            <form method="post" id="frmAcceso">          
              <div class="row">
                  <div class="">
                    <p class="text-center" style="color:#fff; font-size: 18px" id="error"><span >Digite su N° de DNI, nombres completos o código (Ejem. 0159)</span></p>
                    <div class="row">
                      <div class="col-md-8">
                        <input type="text" id="consultar" name="consultar" class="form-control" style="font-size: 16px; height:44px;border-radius: 10px;" placeholder="Ingresa DNI, Nombre Completo o Código">
                      </div>
                      <!-- <span class="fa fa-user form-control-feedback"></span><br> -->
                      <div class="col-md-4">
                        <button name="btnBuscar" type="submit" style="color:#fff; font-size: 18px; border-radius: 10px;" class="btn btn-primary btn-block btn-lg"><i class="fa fa-sign"></i> Buscar</button>
                      </div>            
                    </div><!-- /.col -->

                    <div class="col-lg-12" style="font-size: 16px; color:#fff;">
                  <input type="checkbox" style="float:left; margin-right: 0.5rem">
                  
                  <p>* Al darle "BUSCAR" acepta la  <span style=" color:#1eb7ca; cursor: pointer">tratamiento de mis datos personales y haber leído la Política de privacidad</span></p>

                </div>
               
                
              </div>
            </form>
          </div>
        
          <div class="col-lg-12" >

          <p>Copyright © 2021. Desarrollado por la Oficina General de Tecnologías de la Información del Ministerio de Salud | Todos los derechos reservados. </p>

          </div>          

        </div><!-- /.login-box-body -->
      </article>
      <article class="browser">
        
      </article>
    </article>
    
<?php


if(isset($_POST['btnBuscar']))
{
  require "../configuraciones/Conexion.php";

    $doc = $_POST['consultar'];
    
    if($doc=="") //VERIFICO QUE AGREGEN UN DOCUMENTO OBLIGATORIAMENTE.
      {echo "
        <div class='col-lg-5 col-sm-2 col-md-2 col-xs-2'>

        </div>
        <div class=''col-lg-8< col-sm-2 col-md-2 col-xs-2; tex-center'>
        <p class='tex-center' style='color:#ff3939; font-size: 16px'><span >Digita un documento N° de DNI, nombres completos o código (Ejem. 0159)</span></p>
        <imput
        </div>
        <div class='col-lg-5 col-sm-2 col-md-2 col-xs-2'>

        </div>
        ";}
      else
    {  
      
      //$sql="SELECT i.idmatricula,i.idparticipante,p.nombre as participante,p.direccion,p.num_documento,p.email,p.telefono,id.idcurso,c.nombre as curso,id.fecha_curso as fecha_curso FROM matricula i INNER JOIN persona p ON i.idparticipante=p.idpersona INNER JOIN cursos c ON i.idcurso=c.idcurso WHERE i.idmaticula='$idmaticula'";
		  $resultados = mysqli_query($conexion,"SELECT cursos.nombre,ca.nombre as categoria, cursos.n_horas, m.fecha_inicio , persona.nombre AS participante, persona.num_documento 
      FROM cursos INNER JOIN matricula m ON cursos.idcurso = m.idcurso 
      INNER JOIN categoria ca ON ca.idcategoria = cursos.idcategoria
      INNER JOIN persona ON m.idparticipante = persona.idpersona 
      WHERE persona.nombre = '$doc' OR persona.num_documento ='$doc'");

      echo 
        "
        <div class='col-lg-1 col-sm-2 col-md-2 col-xs-2'>
        </div>
        <div class='col-lg-10 col-sm-8 col-md-8 col-xs-12' style='background-color:#f1eded; background-size: 100% 100%; background-attachment: fixed;'>
          <table class='table table-striped table-bordered table-condensed table-hover text-center' width=\"100%\" border=\"2\" style='color:#111111'>
            <tr style='background-color:#65d2ed' > 
              <td><b><center>Documento</center></b></td>    
              <td><b><center>Nombre del Participante</center></b></td>                       
              <td><b><center>Nombre del Curso</center></b></td>
              <td><b><center>Tipo de Curso</center></b></td>
              <td><b><center>Numero de Horas</center></b></td>
              <td><b><center>Fecha del curso que se llevo</center></b></td>             
            </tr>";
            while($consulta = mysqli_fetch_array($resultados))
            {
              echo "
            <tr class='filas'>
              <td>".$consulta['num_documento']."</td>
              <td>".$consulta['participante']."</td>
              <td>".$consulta['nombre']."</td>
              <td>".$consulta['categoria']."</td>
              <td>".$consulta['n_horas']."</td>
              <td>".$consulta['fecha_inicio']."</td>         
              
            </tr>";
            }

            echo "
            <tfoot>
                  <th></th>
                  <th></th>
									<th></th>
            </tfoot>";
        echo "
          </table>
           	
        </div>

        <div class='col-lg-1 col-sm-2 col-md-2 col-xs-2'>
        </div>              
        "; 
      }
}
?>
<div>

</div>
<div>

</div>
  
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>
     <!-- Bootbox -->
    <script src="../public/js/bootbox.min.js"></script>

    <!-- sweetalert2 -->
 <script src="../public/js/sweetalert.min.js"></script>
  </body>

  ?>
</html> 