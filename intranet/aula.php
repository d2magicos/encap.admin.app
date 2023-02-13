<?php require "../configuraciones/Conexion.php"; ?>

<?php
session_start();
if (isset($_GET['consultarid'])) {
    $doc = $_GET['consultarid'];
    $num = $_SESSION['idper'];
    $validacion = mysqli_query($conexion, "SELECT p.num_documento,a.telefono as asesor_telefono
        FROM matricula m
        INNER JOIN persona p ON p.idpersona= m.idparticipante
        INNER JOIN personal a ON a.idpersonal=m.idpersonal
        WHERE m.idcurso='" . $doc . "' AND p.num_documento='" . $num . "'");
    $consultaa = mysqli_fetch_array($validacion);
    $row_cnt = $validacion->num_rows;

    if ($row_cnt > 0) {
        if ($doc != null) {
            /* Get student */
            $resultadop = mysqli_query($conexion, "SELECT a.idcurso,a.nombre, a.docente,a.idsubcategoria, c.nombre as categoria,a.vistas as vistas,
            a.examen,a.cursoenvivo,a.walink
                                                        FROM cursos a
                                                        INNER JOIN categoria c ON c.idcategoria=a.idcategoria
                                                      
                                                        WHERE idcurso='" . $doc . "'");

                                                        

            $resultadot = mysqli_query($conexion, "SELECT m.idmodulo as idmodulo ,m.nombre as modulo 
                
                FROM  modulos m 
                INNER JOIN cursos b ON b.idcurso = m.idcurso
              
                WHERE b.idcurso='" . $doc . "' ORDER BY m.idmodulo ASC");

            $resultadoc = mysqli_query($conexion, "SELECT l.idlecciones,l.nombre as nombrelec,b.docente as docente,b.nombre as categoria ,l.codigohtml as html ,
                l.link_video,l.link_material,l.link_examen
                            
                FROM  lecciones l
                INNER JOIN modulos m ON m.idmodulo = l.idmodulo
                INNER JOIN cursos b ON b.idcurso = m.idcurso
               
                WHERE b.idcurso='" . $doc . "' ORDER BY l.idlecciones ASC");

            $consultap = mysqli_fetch_array($resultadop);

        } else {
            echo "Error al mostrar la pagina.";
            return false;
        }
    } else {
        echo "No esta matriculado en este curso.";

        return false;
    }

} else {
    $doc = null;
    echo "Error al mostrar";
    return false;
}






?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENCAP | Intranet</title>
    <!-- bootstrap 5.2.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../public/css/sweetalert.min.css" /> -->
    <link rel="stylesheet" href="./css/resetcss.css">
    <link rel="stylesheet" href="./css/custom-style.css">
    <link rel="stylesheet" href="./css/modal-style.css">
    <link rel="stylesheet" href="./css/stars.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/cdnjs.css" />
</head>

<body>
    <header class="header">
        <div class="container header-container">
            <nav class="main-menu">
                <a href="./intranet2.php?consultarid=<?= $doc; ?>"><img class="logo-encap"
                        src="../files/encap blanco.png" alt="logo encap"></a>
                <ul>
                    <li class="actived"><a href="./intranet2.php?consultarid=<?= $doc; ?>">Inicio</a></li>
                    <li class="menu-item"><a href="./ayuda.php?consultarid=<?= $doc; ?>">Ayuda</a></li>
                    <li class="menu-item"><a href="../intranet/">Salir</a></li>
                </ul>
            </nav>
            <div class="help-container text-center">
                <!-- <div class="aula-virtual-letrero">
                    <nav class="help-title pt-2 pb-1" style="font-size: 18px;">Aula Virtual</nav>
                    <div class="pt-1"><a href="https://aula.encap.edu.pe/" target="_blank"><nav class="aula-link">Ingrese aquí <i class="fa-solid fa-arrow-up-right-from-square"></i></nav></a></div>
                </div> -->
                <a href="https://wa.link/io5yae" target="_blank">
                    <div class="numbers">
                        <nav class="help-title">Si necesitas ayuda, comunícate con nosotros</nav>
                        <div class="pt-1">
                            <nav class="number-1"><i class="fa-solid fa-phone mx-2"></i>925 248 166</nav>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </header>
    <main class="container pt-3 pb-4">
        <div class="row">
            <div class="col-lg-7">
                <div class="px-2">
                    <div class="user-info">
                        <form class="form-horizontal" role="form" name="formulario" id="formulario" method="post">
                            <input style="display:none" id="idcurso" name="idcurso" value="<?php echo $doc; ?>"></input>
                        </form>


                        <div class="video-container" id="details">

                            <?php

                            $consulta = mysqli_fetch_array($resultadoc);

                            if ($consulta != null) {
                                echo htmlspecialchars_decode(stripslashes($consulta["html"]));

                            } else {
                                echo "<h3>El curso no cuenta con modulos creados.</h3>";
                            }





                            ?>




                        </div>

                        <div class="tab">
                            <button class="tablinks" onclick="openTab(event, 'London')">Sobre el curso</button>
                            <?php

                            if (!empty($consulta["link_video"]) || !empty($consulta["link_material"])) {
                                echo '  <button id="mat" class="tablinks" onclick="openTab(event, \'Paris\')">Materiales</button>';
                            } else {
                                echo '  <button id="mat" class="tablinks" style="display:none" onclick="openTab(event, \'Paris\')">Materiales</button>';
                            }
                            ?>

                            <button class="tablinks" onclick="openTab(event, 'Tokyo')">Comentarios</button>
                        </div>

                        <!-- Tab content -->
                        <div id="London" class="tabcontent" style="display:block">

                            <div class="details2" id="details2">
                                <form class="form-horizontal" style="display:none" role="form" name="formulario2"
                                    id="formulario2" method="post">
                                    <input id="idmatricula" name="idmatricula" value=""></input>
                                    <input id="idcursoa" name="idcursoa"
                                        value="<?php echo $_GET["consultarid"] ?>"></input>
                                    <input id="idlecciones" name="idlecciones" value=""></input>
                                </form>
                                <h4 id="leccionname" class="title-company">
                                    <?php 
                                    
                                    if($consulta!=null){
                                        echo "1.1. " . $consulta["nombrelec"];
                                        echo "<p style='float:right;margin-top:8px'><i style='font-size:10px;' class='fa-solid fa-eye'></i> " . $consultap["vistas"] . " vistas</p>";
                                     
                                    }else{
                                        echo "No se han creado lecciones todavia en este curso.";
                                    }
                                    ?>

                                </h4><br>
                                <span>
                                    <?php echo "<p>" . $consultap["categoria"] . " - " . $consultap["nombre"] . "</p>"; ?>
                                </span><br><br>
                                <span>
                                    <?php 
                                    
                                    if (!empty($consultap["imagen"])){
                                        "<img src='../files/docentes/".$consultap["imagen"]."' height='50px' width='50px' >";
                                    }else{
                                        "<img src='../files/docentes/404img.jpg' height='50px' width='50px' >";
                                    }
				                    
                                    echo $consultap["docente"]; 
                                    ?>
                                </span>
                            </div>
                        </div>

                        <div id="Paris" class="tabcontent">
                            <div class="details2" id="recursos">
                                <p>Aqui encontraras archivos, enlaces y descargas del curso que haya dejado el profesor.
                                </p><br>
                                <?php
                                if (!empty($consulta["link_video"])) {

                                    echo ' <a style="width:100%" href="#"  onclick="window.open(\'' . $consulta["link_video"] . '\',\'_blank\')"><i class="fa-solid fa-video"></i>&nbsp;  Descargar Video</a>';
                                }

                                if (!empty($consulta["link_material"])) {
                                    echo '<p>&nbsp;</p><a style="width:100%" href="#" onclick="window.open(\'' . $consulta["link_material"] . '\',\'_blank\')"><i class="fa-solid fa-folder"></i>&nbsp; Descargar Material</a>';

                                } else if (!empty($consulta["link_examen"])) {
                                    echo '<p>&nbsp;</p><a style="width:100%" href="#" onclick="window.open(\'' . $consulta["link_examen"] . '\',\'_blank\')"><i class="fa-solid fa-file"></i>&nbsp;&nbsp; Examen</a>';

                                }
                                ?>



                            </div>
                        </div>

                        <div id="Tokyo" class="tabcontent">
                            <div class="details" id="details3">
                                <!-- <h5  class="title-company">Comentarios</h5>
                                <br>-->

                                <p id="minombre"></p>
                                <form method="post" id="formulario3">
                                    <input style="display:none" id="idpersona" name="idpersona"></input>
                                    <input style="display:none" id="idcursob" name="idcursob"
                                        value="<?php echo $_GET["consultarid"]; ?>"></input>
                                    <input style="display:none" id="idleccionb" name="idleccionb"></input>
                                    <textarea style="width:100%;height:100px" id="comentario" name="comentario"
                                        placeholder="Dejanos un comentario"></textarea>
                                    <button type="button" class="btnMateriales" onclick="EnviarComentario()">Enviar
                                        comentario</button>

                                </form>
                                <hr>
                                <div id="deadpool">

                                </div>

                            </div>
                        </div>




                    </div>
                    <div class="links-container">
                        <h3 class="py-4 text-center">Links de interés</h3>
                        <div class="row links">
                            <div class="col-xl-3 col-lg-4 col-md-4 text-center link">
                                <div class="card-link text-center">
                                    <a href="https://sistemas.encap.edu.pe/certificados/" target="_blank">
                                        <h4 class="link-title">Validación de certificados</h4>
                                        <div class="link-img p-2">
                                            <img class="link-img" src="./img/diploma.png" alt="" width="60px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-4 link">
                                <div class="card-link text-center">
                                    <a href="https://sistemas.encap.edu.pe/tracking/" target="_blank">
                                        <h4 class="link-title">Seguimiento de envío<br /> (Certificados físicos)</h4>
                                        <div class="link-img p-1">
                                            <img class="link-img" src="./img/camion.png" alt="" width="55px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-4 link">
                                <div class="card-link text-center">
                                    <a href="https://sistemas.encap.edu.pe/bolsa_de_trabajo/" target="_blank">
                                        <h4 class="link-title">Convocatoria de trabajo</h4>
                                        <div class="link-img">
                                            <img class="link-img" src="./img/work-tools.png" alt="" width="70px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-4 link">
                                <div class="card-link text-center">
                                    <a href="https://chat.whatsapp.com/Jly7TX1qmPVGUXIb8bkTQh" target="_blank">
                                        <h4 class="link-title">Ver más cursos</h4>
                                        <div class="link-img p-2 m-1">
                                            <img class="link-img" src="./img/whatsapp.png" alt="" width="50px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aula-mobile-container text-center">
                <a href="https://wa.link/io5yae" target="_blank">
                    <div class="aula-mobile-button my-4">
                        <div class="py-2">
                            <nav class="help-title">Comunícate con el Área de Soporte</nav>
                            <div class="pt-1">
                                <nav class="number-1"><i class="fa-solid fa-phone mx-2"></i>925 248 166</nav>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5">
                <div class="details">
                    <div class="tab">
                        <button class="tablinks2" onclick="openTab2(event, 'Temario')">Temario</button>


                        <?php
                        if (!empty($consultap["examen"])) {

                            echo '  <button class="tablinks2" onclick="openTab2(event, \'Examen\')">Examen</button>';

                        }




                        if (!empty($consultap["cursoenvivo"])) {

                            echo '  <button class="tablinks2" onclick="openTab2(event, \'Vivo\')">Proximos en Vivo</button>';

                        }

                        ?>


                    </div>

                    <!-- Tab content -->
                    <div id="Temario" class="tabcontent2" style="display:block">

                        <div class="accordion px-2" id="accordionExample">
                            <h4 style="margin:10px">Temario</h4>
                            <h6 style="margin:10px" id="progress"><progress id="progreso" max="100" value="70">
                                </progress>&nbsp;&nbsp;&nbsp;<label> 70% completado</label></h6>

                            <?php
                            $contm = 0;
                            $contl = 0;
                            $contlt = 0;
                            $contltc = 0;
                            $num_rows = 0;
                            while ($row = mysqli_fetch_array($resultadot)) {
                                $contm++;
                                $resultadol = mysqli_query($conexion, "SELECT a.idlecciones, a.nombre, a.codigohtml, a.link_video,a.link_material,a.link_examen,
                                a.duracion
                                FROM lecciones a                   
                                INNER JOIN modulos m ON m.idmodulo = a.idmodulo
                              
                                WHERE a.idmodulo='" . $row['idmodulo'] . "' ORDER BY a.idlecciones ASC");


                                if ($contm == 1) {
                                    echo ' <div class="accordion-item">' .
                                        '<h2 class="accordion-header" id="heading' . $contm . '">' .
                                        '<button class="accordion-button" type="button" data-bs-toggle="collapse"' .
                                        'data-bs-target="#collapse' . $contm . '" aria-expanded="true" aria-controls="collapse"' . $contm . '>' .
                                        $row['modulo'] .
                                        '</button>' .
                                        '</h2>' .
                                        '<div id="collapse' . $contm . '" class="accordion-collapse collapse show" aria-labelledby="heading' . $contm . '"' .
                                        'data-bs-parent="#accordionExample">' .
                                        '<div class="accordion-body">';
                                } else {
                                    echo ' <div class="accordion-item">' .
                                        '<h2 class="accordion-header" id="heading' . $contm . '">' .
                                        '<button class="accordion-button" type="button" data-bs-toggle="collapse"' .
                                        'data-bs-target="#collapse' . $contm . '" aria-expanded="false" aria-controls="collapse"' . $contm . '>' .
                                        $row['modulo'] .
                                        '</button>' .
                                        '</h2>' .
                                        '<div id="collapse' . $contm . '" class="accordion-collapse collapse" aria-labelledby="heading' . $contm . '"' .
                                        'data-bs-parent="#accordionExample">' .
                                        '<div class="accordion-body">';
                                }




                                while ($rowl = mysqli_fetch_array($resultadol)) {
                                    $contl++;
                                    $contltc++;
                                    $namel = $contm . "." . $contl . ". " . $rowl['nombre'];



                                    $resultadopgr = mysqli_query($conexion, "SELECT a.idlecciones
                                            FROM lecciones a                               
                                            INNER JOIN progreso p ON p.idlecciones = a.idlecciones
                                            WHERE p.idlecciones='" . $rowl['idlecciones'] . "'");
                                    $num_rows = mysqli_num_rows($resultadopgr);

                                    if ($contl == 1 && $contm == 1) {
                                        echo "<script>document.getElementById('idleccionb').value=" . $rowl["idlecciones"] . "</script>";
                                    }

                                    if ($num_rows <= 0) {
                                        echo '<div style="display:flex"><a id="' . $rowl["idlecciones"] . '" style="width:100%;color:black" href="#" onclick="Cargarleccion(\'' . $rowl["idlecciones"] . '\',\'' . $namel . '\',\'' . ($rowl['codigohtml']) . '\',\'' . $rowl['link_video'] . '\',\'' . $rowl['link_material'] . '\',\'' . $rowl['link_examen'] . '\')">' . $namel . '</a><p style="color:gray">' . $rowl['duracion'] . '</p><br></div>';
                                    } else {
                                        $contlt++;

                                        echo '<div style="display:flex"><a id="' . $rowl["idlecciones"] . '" style="width:100%;color:gray" href="#" onclick="Cargarleccion(\'' . $rowl["idlecciones"] . '\',\'' . $namel . '\',\'' . ($rowl['codigohtml']) . '\',\'' . $rowl['link_video'] . '\',\'' . $rowl['link_material'] . '\',\'' . $rowl['link_examen'] . '\')">' . $namel . '</a><p style="color:gray">' . $rowl['duracion'] . '</p><br></div>';
                                    }


                                }
                                $progreso = ($contlt / $contltc) * 100;
                                $progreso = round($progreso, 2);

                                echo '<script>document.getElementById("progress").innerHTML="";document.getElementById("progress").innerHTML=\'<progress lecm="' . $contlt . '" lecc="' . $contltc . '" id="progreso" max="100" value="' . $progreso . '"></progress>&nbsp;&nbsp;&nbsp;<label>' . $progreso . '% completado</label>\'</script>';
                                $contl = 0;

                                echo '</div>' .
                                    '</div>' .
                                    '</div>';

                            }

                            ?>


                        </div>

                    </div>




                    <div id="Examen" class="tabcontent2" style="min-height:150px;">
                        <div class="details2" id="recursos">
                            <p>Aqui encontraras el enlace de tu examen.</p><br>
                            <?php
                            echo '<p>&nbsp;</p><a style="width:100%" href="#" onclick="window.open(\'' . $consultap["examen"] . '\',\'_blank\')"><i class="fa-solid fa-file"></i>&nbsp;&nbsp; Examen del Curso</a>';

                            ?>
                        </div>
                    </div>









                    <div id="Vivo" class="tabcontent2" style="min-height:400px;">
                        <div class="details2">
                            <p>Aqui encontraras los proximos cursos en vivo.</p><br>

                            <?php echo "<p id='url' style='display:none'>" . $consultap["cursoenvivo"] . "</p>"; ?>

                            <p id="converted_url"></p>

                        </div>
                    </div>
                  <div class="user-info">

                      

                            <style>
                                    .textTarget {
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3; /* number of lines to show */
                                            line-clamp: 3; 
                                    -webkit-box-orient: vertical;
                                    font-size: small;
                                    text-align: justify;
                                    }

                                    .imgcur{
                                        width:140px;
                                        border-radius: 10px;
                                    }

                                    .titcur{
                                        line-height: 25px;
                                    }


                            </style>

                            <?php
                            $scat = $consultap["idsubcategoria"];
                            $idact = $consultap["idcurso"];
                            $numeroasesor = $consultaa["asesor_telefono"];
                          
                            
                            $resultadocr = mysqli_query($conexion, "SELECT nombre,imagen_curso,descripcion_curso,vistas,walink FROM cursos where idsubcategoria=$scat AND idcurso !=$idact  ORDER BY rand()  LIMIT 5");

                           

                            echo '<div class="details">';
                            echo '<h4>Cursos recomendados</h4><hr>';

                           

                            while ($row = mysqli_fetch_array($resultadocr)) {
                                $mensaje = "Hola vengo del *AULA VIRTUAL* estoy interesado en el curso de *".$row["nombre"]."* podria darme mas información";
                                $url = "https://api.whatsapp.com/send/?phone=51".$numeroasesor."&text=".$mensaje;
                                echo "<ul>";
                                echo "<li style='list-style: none'><target style='display:flex'><div style='text-align:center'><a style='font-size:12px' href='".$url."' target='_blank'><img class='imgcur' src='../Imagenes_cursos/".$row["imagen_curso"]."'></img></a></div><div style='padding:10px'><a style='font-size:12px' href='".$url."' target='_blank'><h6 class='titcur'>" . $row["nombre"] . "</h6></a><p class='textTarget'>". $row["descripcion_curso"] . "</p></div></target></li>";
                                echo "</ul><hr>";
                            }


                            ?>


                        </div>

                    </div>

                </div>




                <br>

            </div>
            <div class="links-container-mobile">
                <h3 class="py-4 text-center">Links de interés</h3>
                <div class="row links">
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://sistemas.encap.edu.pe/certificados/" target="_blank">
                                <h4 class="link-title">Validación de certificados</h4>
                                <div class="link-img p-2">
                                    <img class="link-img" src="./img/diploma.png" alt="" width="60px">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://sistemas.encap.edu.pe/tracking/" target="_blank">
                                <h4 class="link-title">Seguimiento de envío<br /> (Certificados físicos)</h4>
                                <div class="link-img p-1">
                                    <img class="link-img" src="./img/camion.png" alt="" width="55px">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://sistemas.encap.edu.pe/bolsa_de_trabajo/" target="_blank">
                                <h4 class="link-title">Convocatoria de trabajo</h4>
                                <div class="link-img">
                                    <img class="link-img" src="./img/work-tools.png" alt="" width="70px">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col mx-3 my-3 link">
                        <div class="card-link text-center">
                            <a href="https://chat.whatsapp.com/Jly7TX1qmPVGUXIb8bkTQh" target="_blank">
                                <h4 class="link-title">Ver más cursos</h4>
                                <div class="link-img p-2 m-1">
                                    <img class="link-img" src="./img/whatsapp.png" alt="" width="50px">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-text text-center py-2">
            © Todos los derechos reservados
            <?= date("Y"); ?>
        </div>
    </footer>

    <?php require_once('./resources/detailsModal.php'); ?>
    <?php require_once('./resources/encuestaModal.php'); ?>

    <script>const personid = "<?= $_GET["consultarid"] ?>";</script>
    <script>
        resetButton = () => {
            if ($('input:radio[name=estrellas]').is(':checked')) {
                $('input:radio[name=estrellas]').prop('checked', false)
                document.getElementById('qualification').value = '';
                document.getElementById('txtRespuesta').innerHTML = '';
            }
        }
    </script>
    <!-- jQuery -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script src="../public/js/sweetalert.min.js"></script> -->
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/75ab5a9917.js" crossorigin="anonymous"></script>
    <!-- bootstrap 5.2.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>

    <!-- DATATABLES -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>
    <!-- <script src="../public/datatables/dataTables.buttons.min.js"></script> -->
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <!-- <script src="../public/datatables/pdfmake.min.js"></script> -->
    <script src="../public/datatables/vfs_fonts.js"></script>

    <script src="./js/intranet.js"></script>
    <script src="./js/aula.js"></script>
    <script src="./js/tabs.js"></script>
    <!-- <script src="./js/tabla.js"></script> -->
    <script src="./js/details.js"></script>
    <script src="./js/toggle.js"></script>
    <script src="./js/survey.js"></script>
    <script src="https://cdn.plyr.io/3.6.3/demo.js"></script>
</body>

</html>