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
//Usuario revisa el contenido
if ($_SESSION['configuracion']==1)
{
?>

<!--Contenido-->
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->

      <section class="content">  
         <div class="row">
                 <div class="col-md-12 col-lg-12 col-xs-12">
                     <div class="box box-primary">

              
                        <div class="box-body">                                        
                            <div class="modal-header" style="background:#151e38; color:white">
                                <h4 class="modal-title text-center">Crear y restaurar copias de seguridad </h4>
                            </div> 
                                
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12 modal-body">
                                <div class="form-group text-center">

            <?php
            include 'Connet.php';
            $day=date("d");
            $mont=date("m");
            $year=date("Y");
            $hora=date("H-i-s");
            $fecha=$day.'_'.$mont.'_'.$year;
            $DataBASE=$fecha."_(".$hora."_hrs).sql";
            $tables=array();
            $result=SGBD::sql('SHOW TABLES');
            if($result){
                while($row=mysqli_fetch_row($result)){
                $tables[] = $row[0];
                }
                $sql='SET FOREIGN_KEY_CHECKS=0;'."\n\n";
                $sql.='CREATE DATABASE IF NOT EXISTS '.BD.";\n\n";
                $sql.='USE '.BD.";\n\n";;
                foreach($tables as $table){
                    $result=SGBD::sql('SELECT * FROM '.$table);
                    if($result){
                        $numFields=mysqli_num_fields($result);
                        $sql.='DROP TABLE IF EXISTS '.$table.';';
                        $row2=mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE '.$table));
                        $sql.="\n\n".$row2[1].";\n\n";
                        for ($i=0; $i < $numFields; $i++){
                            while($row=mysqli_fetch_row($result)){
                                $sql.='INSERT INTO '.$table.' VALUES(';
                                for($j=0; $j<$numFields; $j++){
                                    $row[$j]=addslashes($row[$j]);
                                    $row[$j]=str_replace("\n","\\n",$row[$j]);
                                    if (isset($row[$j])){
                                        $sql .= '"'.$row[$j].'"' ;
                                    }
                                    else{
                                        $sql.= '""';
                                    }
                                    if ($j < ($numFields-1)){
                                        $sql .= ',';
                                    }
                                }
                                $sql.= ");\n";
                            }
                        }
                        $sql.="\n\n\n";
                    }else{
                        $error=1;
                    }
                }
                if($error==1){
                    echo '
                    <div class="col-md-12 col-lg-12 col-xs-12 form-group text-center">
                            
                            <h3>      Ocurrio un error inesperado al crear la copia de seguridad </h3>
                                 <a href="copiaseguridadbd.php" class="btn btn-warning" style="font-size:25px; border-radius: 20px;"><i class="fa fa-arrow-circle-left" ></i> Regresar </a> <br><br>
    
                    </div> 
                        ';
                }else{
                    chmod(BACKUP_PATH, 0777);
                    $sql.='SET FOREIGN_KEY_CHECKS=1;';
                    $handle=fopen(BACKUP_PATH.$DataBASE,'w+');
                    if(fwrite($handle, $sql)){
                        fclose($handle);
                        echo '
                 
                        <div class="col-md-12 col-lg-12 col-xs-12 form-group">
                        
                            <h3> Copia de seguridad se realizo con exito!!! </h3>
                             <a href="copiaseguridadbd.php" class="btn btn-warning" style="font-size:25px; border-radius: 20px;"><i class="fa fa-arrow-circle-left" ></i> Regresar </a> <br><br>
                        </div>
                        ';
                            }else{
                                echo '
                                <div class="col-md-12 col-lg-12 col-xs-12 form-group">
                                 <h3>  Ocurrio un error inesperado al crear la copia de seguridad </h3>
                                 <a href="copiaseguridadbd.php" class="btn btn-warning" style="font-size:25px; border-radius: 20px;"><i class="fa fa-arrow-circle-left" ></i> Regresar </a> <br><br>
                                 </div>
                               ';
                            }
                        }
                    }else{
                        echo '
                        <div class="col-md-12 col-lg-12 col-xs-12 form-group">
                                    <h3>   Ocurrio un error inesperado </h3>
                                 <a href="copiaseguridadbd.php" class="btn btn-warning" style="font-size:25px; border-radius: 20px;"><i class="fa fa-arrow-circle-left" ></i> Regresar </a> <br><br>
                                 </div>
                       ';
                    }
                    mysqli_free_result($result);
                    
                ?>
                                  
      </section>
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

<?php 
}
ob_end_flush();
?>