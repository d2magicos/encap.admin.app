<?php
ob_start();
session_start();
//si la ariable de sesion no existe
if (!isset($_SESSION["idpersonal"]))
{
  header("Location: login.html");
}
else
{
require 'modulos/header.php';
$idpersonal=$_SESSION["idpersonal"];

$busqueda=mysqli_query($conexion,"SELECT per.idpersonal,per.fecha_hora,per.nombre, td.nombre as tipo_documento,per.num_documento, per.telefono,per.telefono2,per.email,
p.nombre as pais,per.departamento,per.ciudad,per.direccion,per.fecha_cumple,per.cargo,per.imagen,per.condicion,per.idpais,per.idtipo_documento,per.imagen
FROM personal per INNER JOIN tipo_documento td ON td.idtipo_documento = per.idtipo_documento
INNER JOIN pais p ON p.idpais = per.idpais WHERE idpersonal='$idpersonal'");

$buslogin=mysqli_query($conexion,"SELECT idusuario,login,clave FROM usuario WHERE idpersonal='$idpersonal'");

//Usuario revisa el contenido
if ($_SESSION['inicio']==1)

{
?>
<!--Contenido-->
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="modal-content"  id="myModal" tabindex="-1" role="dialog">
      <br>
      <!-- form -->
      <form class="form-horizontal" role="form" name="formulario" id="formulario" method="POST">

        <div class="modal-header" style="background:#151e38; color:white">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br>
          <h4 class="modal-title text-center"> Datos Personales</h4>
        </div>

        <div class="modal-body"> 
        <?php while ($resultado = mysqli_fetch_assoc($busqueda)){ ?>
          <div class="row" style="padding: 0px 50px">
            <div class="col-md-3 col-xs-12" style="padding: 50px 50px;text-align:center;">
              <img style="border-radius: 50% !important;width: 280px;height: 280px;" src='../files/personal/<?php echo  $resultado["imagen"]; ?>'>
            </div> 

            <div class="col-md-6 col-xs-12" style="text-align:left;">
                <div class="form-group">          <br>      <br>                      
                  <label for="name" class="col-sm-8 control-label" >Fecha Ingreso al Sistema:</label>
                  <div class="col-sm-4 input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input style="border-color:#FFC7BB; text-align:center" class="form-control" type="text" value=" <?php echo  $resultado["fecha_hora"]; ?> ">
                    <input type="hidden" class="form-control" name="idpersonal" id="idpersonal" maxlength="100" value=" <?php echo  $resultado["idpersonal"]; ?> ">
                  </div>
                </div>
                <div class="form-group"  style="color:#111e42 ;">               
                  <div class="col-sm-9">                
                    <span style="font-weight: 600; font-size:22px"> <?php echo  $resultado["nombre"]; ?></span><br>
                    <span style="font-weight: 600;"> <?php echo  $resultado["cargo"]; ?></span><br>
                    <span style="font-weight: 600;"> <?php echo  $resultado["num_documento"]; ?></span><br><br>

                    <span> <i class="fa fa-envelope-o"></i>&nbsp;: &nbsp;&nbsp;</span><span style="font-size:16px"><?php echo  $resultado["email"]; ?> </span><br>
                    <span> <i class="fa fa-phone"></i>&nbsp;: &nbsp;&nbsp;</span><span style="font-size:16px"><?php echo  $resultado["telefono"]; ?> -  <?php echo  $resultado["telefono2"]; ?></span><br>
                    <span> <i class="fa fa-map"></i>&nbsp;: &nbsp;&nbsp;</span><span style="font-size:16px"><?php echo  $resultado["departamento"]; ?> - <?php echo  $resultado["ciudad"]; ?></span><br>
                    <span> <i class="fa fa-map-marker"></i>&nbsp;: &nbsp;&nbsp;&nbsp;</span style="font-size:16px"><span><?php echo  $resultado["direccion"]; ?> </span><br>
                    <span> <i class="fa fa-gift"></i>&nbsp;: &nbsp;&nbsp;</span><span style="font-size:16px"><?php echo  $resultado["fecha_cumple"]; ?> </span><br>

                      <div>
                        <br>
                        <h4> Datos de Usuario Login</h4>
                        <?php while ($resul = mysqli_fetch_assoc($buslogin)){ ?>

                          <div class="input-group margin-bottom-sm">
                          <input type="hidden" class="form-control" name="idusuario" id="idusuario"  value=" <?php echo  $resul["idusuario"]; ?>">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                            <input class="form-control" type="text" name="login" id="login" placeholder="Usuario">
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                            <input class="form-control" type="password" name="clave" id="clave" placeholder="Password">
                          </div>                        
                          <p style="color:#b8022c "> Login antiguo: </span><span> <?php echo  $resul["login"]; ?> </p>
                          <div class="modal-footer">
                            <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Cambiar contraseña</button>
                          </div>
                       
                        <?php } ?>
                      </div>
                  </div> 
                </div>              
               
            </div>

            <div class="col-md-3 col-xs-12">
            </div> 

          </div>            
        <?php } ?> 
        </div>      
      </form>        
    </div>
</div>
<!-- Fin modal -->
<?php
}
else
{
  require 'notieneacceso.php';
}
require 'modulos/footer.php';
?>
<script type="text/javascript" src="js/perfil.js"></script>

<?php 
}
ob_end_flush();
?>

