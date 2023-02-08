<?php
if (strlen(session_id()) < 1) 
  session_start();

  require_once "../modelos/Consultas.php";
  $consulta = new Consultas();  

  $idpersonal=$_SESSION["idpersonal"];
  ini_set('date.timezone','America/Lima');  
  $fecha = date('d/m');    

  $rsptac = $consulta->notificacioncumplehoy($fecha,$idpersonal);
  $regc=$rsptac->fetch_object();
  $cantidadcum=$regc->cantidad;


  // CUENTA DE CANTIDAD DE VISTA PARA MATRICULAS
  $rsptav = $consulta->cantidadpendienteenviodigitalpersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadPF=$regv->cantidad; 

  $rsptav = $consulta->cantidadpendienteenviofisicopersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadPD=$regv->cantidad;  

  $rsptav = $consulta->cantidadreclamospendientespersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadRP=$regv->cantidad;  

  $rsptav = $consulta->cantidadsatisfaccionclientepersonal($idpersonal);
  $regv=$rsptav->fetch_object();
  $cantidadSP=$regv->cantidad;  

  
    // ---------------------------   VISTA INICIO ENVIO --------------------------- ///
// CUENTA DE CANTIDAD DE VISTA PARA ENVIOS 
$rsptav = $consulta->cantidadpendienteenvios();
$regv=$rsptav->fetch_object();
$cantidadPEnvio=$regv->cantidad; 

        // ---------------------------   VISTA INICIO GENERAL --------------------------- ///
// CUENTA DE CANTIDAD DE VISTA PARA MATRICULAS
$rsptav = $consulta->cantidadpendienteenviodigitalgeneral();
$regv=$rsptav->fetch_object();
$cantidadPDG=$regv->cantidad; 

$rsptav = $consulta->cantidadpendienteenviofisigeneral();
$regv=$rsptav->fetch_object();
$cantidadEPG=$regv->cantidad;  

$rsptav = $consulta->cantidadreclamospendientesgeneral();
$regv=$rsptav->fetch_object();
$cantidadRPG=$regv->cantidad;  

$rsptav = $consulta->cantidadsatisfaccionclientegeneral();
$regv=$rsptav->fetch_object();
$cantidadSPG=$regv->cantidad;  

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SIS - ENCAP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

    <link rel="stylesheet" type="text/css" href="../public/css/ocultarheader.css">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="../public/css/sweetalert.min.css" />
    
    <!-- Favicon -->
    <link rel="icon" href="../files/ENCAP.ico">

    <style>
    [type="search"]::-webkit-search-cancel-button {
        -webkit-appearance: none;
        appearance: none;
        height: 10px;
        width: 10px;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjEyMy4wNXB4IiBoZWlnaHQ9IjEyMy4wNXB4IiB2aWV3Qm94PSIwIDAgMTIzLjA1IDEyMy4wNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTIzLjA1IDEyMy4wNTsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPHBhdGggZD0iTTEyMS4zMjUsMTAuOTI1bC04LjUtOC4zOTljLTIuMy0yLjMtNi4xLTIuMy04LjUsMGwtNDIuNCw0Mi4zOTlMMTguNzI2LDEuNzI2Yy0yLjMwMS0yLjMwMS02LjEwMS0yLjMwMS04LjUsMGwtOC41LDguNQ0KCQljLTIuMzAxLDIuMy0yLjMwMSw2LjEsMCw4LjVsNDMuMSw0My4xbC00Mi4zLDQyLjVjLTIuMywyLjMtMi4zLDYuMSwwLDguNWw4LjUsOC41YzIuMywyLjMsNi4xLDIuMyw4LjUsMGw0Mi4zOTktNDIuNGw0Mi40LDQyLjQNCgkJYzIuMywyLjMsNi4xLDIuMyw4LjUsMGw4LjUtOC41YzIuMy0yLjMsMi4zLTYuMSwwLTguNWwtNDIuNS00Mi40bDQyLjQtNDIuMzk5QzEyMy42MjUsMTcuMTI1LDEyMy42MjUsMTMuMzI1LDEyMS4zMjUsMTAuOTI1eiIvPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=);
        background-size: 10px 10px;
      }

    </style>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ENCAP</b></span>
          <b>Sistema ENCAP</b>
          <!-- logo for regular state and mobile devices -->
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <ul class="nav navbar-nav" class="clockk">
              <li class="clock" >							
				          <span class="icon-datos"><i class="fa fa-calendar"></i> &nbsp; <span  id="Date"> </span> </span>
									<ul > <i class="fa fa-clock-o"></i> &nbsp;
										<li id="hours"></li>
										<li id="point">:</li>
										<li id="min"></li>
										<li id="point">:</li>
										<li id="sec"></li>
									</ul>
				        </li>
          </ul>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <?php 
                if ($_SESSION['administrativa']==1)
                {
                echo '                
              <li class="notifi">
                <a href="inicio.php#tbllistadpendienteenviodigitalgeneral_wrapper"><span><i class="fa fa-clipboard"></i> <span class="notinumero" > ';?> <?php echo $cantidadPDG; ?>  <?php   echo' </span></span>  </a> 
                <p> Envios digitales</p>
              </li>
              
              <li class="notifi">
                <a href="inicio.php#tbllistapendienteenviosfisicosgeneral_wrapper"><span><i class="fa fa-ambulance"></i> <span class="notinumero" > ';?> <?php echo $cantidadEPG; ?> <?php   echo' </span></span>  </a> 
                <p> Envios fisicos</p>
              </li>

              <li class="notifi">
                <a href="gestionreclamos.php"><span><i class="fa fa-question"></i> <span class="notinumero" > ';?> <?php echo $cantidadRPG; ?> <?php   echo' </span></span>  </a> 
                <p> Reclamos</p>
               </li>

              <li class="notifi">
                <a href="listasatisfacion.php"><span><i class="fa fa-smile-o"></i> <span class="notinumero" > ';?> <?php echo $cantidadSPG; ?> <?php   echo' </span></span>  </a> 
                <p> Satisfacción </p>
              </li>

              <li class="notifi">
                <a ><span> </span> </a> 
              </li>
              ';
                }elseif ($_SESSION['matricula']==1)
                  {
                  echo '
                <li class="notifi">
                  <a  ><span><i class="fa fa-clipboard"></i> <span class="notinumero" > ';?> <?php echo $cantidadPF; ?>  <?php   echo' </span></span>  </a> 
                  <p> Envios digitales</p>
                </li>
                
                <li class="notifi">
                  <a><span><i class="fa fa-ambulance"></i> <span class="notinumero" > ';?> <?php echo $cantidadPD; ?> <?php   echo' </span></span>  </a> 
                  <p> Envios fisicos</p>
                </li>
  
                <li class="notifi">
                  <a ><span><i class="fa fa-question"></i> <span class="notinumero" > ';?> <?php echo $cantidadRP; ?> <?php   echo' </span></span>  </a> 
                  <p> Reclamos</p>
                </li>
  
                <li class="notifi">
                  <a href="#" ><span><i class="fa fa-smile-o"></i> <span class="notinumero" > ';?> <?php echo $cantidadSP; ?> <?php   echo' </span></span>  </a> 
                  <p> Satisfacción </p>
                </li>
                
                <li class="notifi">
                <a ><span>  </span> </a> 
              </li>';
              }elseif ($_SESSION['envios']==1)
              {
                echo '
                    <li class="notifi">
                      <a ><span><i class="fa fa-ambulance"></i> <span class="notinumero" > ';?> <?php echo $cantidadPEnvio; ?> <?php   echo' </span></span>  </a> 
                      <p> Envios fisicos</p>
                    </li>

                    <li class="notifi">
                      <a ><span>  </span> </a> 
                    </li>
              ';
              }   
              ?>    

              <li class="notificacion">
                <a href="listacump.php" title="Notificaciones de cumpleaños"><span><i class="fa fa-gift"></i> <span class="notinum" > <?php echo $cantidadcum; ?> </span></span>  </a> 
              </li>
               <!-- Bottones de Seccion -->               
              <li class="dropdown user user-menu">                  
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/personal/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo substr( $_SESSION['nombre'],-15); ?></span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">                    
                    <div class="pull-right">
                      <ul style="list-style: none;">
                        <li>
                        <a href="perfil.php" class="btn  btn-flat" style="border-bottom-color: #85c1e9;"><i class="fa fa-user fa-fw"></i> Mi perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                        <a href="../controladores/usuario.php?op=salir" class="btn btn-flat" style="border-bottom-color: #85c1e9;"><i class="fa fa-lock"></i> Cerrar sesión</a>
                        </li>
                      </ul>           
                     
                    
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Bottones de Seccion  -->              

            </ul>
          </div>
        </nav>
      </header>
      
      <!-- Left side column. contains the logo and sidebar style="position: fixed;"-->
      <aside class="main-sidebar" >
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../files/personal/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p class="hidden-xs"><?php echo substr($_SESSION['nombre'],-15); ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input id="searchbar" type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form>

          <script>
            function search_options() {
                let input = document.getElementById('searchbar').value
                input=input.toLowerCase();
                let x = document.getElementsByClassName('animals');
                  
                for (i = 0; i < x.length; i++) { 
                    if (!x[i].innerHTML.toLowerCase().includes(input)) {
                        x[i].style.display="none";
                    }
                    else {
                        x[i].style.display="list-item";                 
                    }
                }
            }

          </script>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          
               <!--<i class="fa fa-bars"></i> -->
         <ul class="sidebar-menu">
            
            <?php 
            if ($_SESSION['inicio']==1)
            {
              echo '<li id="mInicio">
              <a href="inicio.php">
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>
            </li>';
            }
            ?>
          </ul>      
          
          <ul class="sidebar-menu">
            <li class="header" style="background:  #85c1e9 ;color: #17202a ">OPERACIONES</li>    

          <ul class="sidebar-menu">
            
             <?php 
            if ($_SESSION['matricula']==1)
            {
              echo '<li class="treeview">
              <a href="matricula.php">
              &nbsp<i class="fa fa-book fa-fw"></i>
                <span>Gestión Comercial</span>        
              </a>              
            </li>';
            }
            ?>
          </ul> 

         
          <ul class="sidebar-menu">            
            <?php 
           if ($_SESSION['administrativa']==1)
           {
             echo '<li class="treeview">
             <a href="listamatricula.php">
             &nbsp<i class="fa fa-clipboard"></i>
               <span>Gestión Administrativa</span>        
             </a>              
           </li>';
           }

           if ($_SESSION['docentes']==1)
           {
            echo '<li class="treeview">
              <a href="matriculadocentes.php">
              &nbsp<i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>Matricula de Docentes</span>        
              </a>              
            </li>';
             echo '<li class="treeview">
             <a href="listadocentes.php">
             &nbsp<i class="fa fa-th" aria-hidden="true"></i>
               <span>Gestión de Docentes</span>        
             </a>              
           </li>';
           }
           ?>
         </ul>        

        <ul class="sidebar-menu">                    
           <?php 
           if ($_SESSION['envios']==1)
           {
             echo '<li class="treeview">
             <a href="#">
             &nbsp<i class="fa fa-ambulance"></i>
              <span>Gestión Envios</span>
              <i class="fa fa-angle-left pull-right"></i>
             </a>
             <ul class="treeview-menu">
               <li><a href="gestionenvios.php">&nbsp&nbsp<i class="fa fa-envelope-o fa-fw"></i> Gestión Envios</a></li>
               <li><a href="listadeenvios.php">&nbsp&nbsp<i class="fa fa-list-ol"></i> Lista de Envios Realizados </a></li>
             </ul>
           </li>';
           }
           ?>
          </ul>           

          <ul class="sidebar-menu">                    
           <?php 
           if ($_SESSION['reclamos']==1)
           {
             echo '<li class="treeview">
             <a href="#">
             &nbsp<i class="fa fa-question-circle"></i>
           <span>Gestión Reclamos</span>
              <i class="fa fa-angle-left pull-right"></i>
             </a>
             <ul class="treeview-menu">
               <li><a href="gestionreclamos.php">&nbsp&nbsp<i class="fa fa-question"></i> Gestión Reclamos</a></li>';
              }
              ?>

               <?php 
               if ($_SESSION['reclamos']==1)
               {
                 echo '
               <li><a href="verlistadereclamos.php">&nbsp&nbsp<i class="fa fa-list-ol"></i> Ver Lista de Reclamos </a></li>';
              }
              ?>
               <?php 
               if ($_SESSION['administrativa']==1)
               {
                 echo '
               <li><a href="listadereclamos.php">&nbsp&nbsp<i class="fa fa-list-ol"></i> Lista de Reclamos Realizados</a></li>

             </ul>
           </li>';
           }
           ?>
          </ul>

          
        <ul class="sidebar-menu">            
            <?php 
           if ($_SESSION['administrativa']==1)
           {
             echo '<li class="treeview">
             <a href="listasatisfacion.php">
             &nbsp<i class="fa fa-smile-o"></i>
               <span>Satisfacción del Cliente </span>        
             </a>              
           </li>';
           }
           ?>
         </ul> 
        <ul class="sidebar-menu">            
         <?php 
           if ($_SESSION['inicio']==1)
           {
             echo '<li class="treeview">
             <a href="consultaenviolista.php">
             &nbsp<i class="fa fa-list"></i>
               <span>Consulta de ciudades</span>        
             </a>              
           </li>';
           }
           ?>
         </ul> 
                 

          <ul class="sidebar-menu">
            <li class="header" style="background:  #85c1e9 ;color: #17202a ">ADMINISTRACIÓN</li>          
           
          <?php 
            if ($_SESSION['participantes']==1)
            {
              echo '<li class="treeview">
              <a href="participantes.php">
              &nbsp<i class="fa fa-users"></i>
                <span>Participantes</span>                
              </a>              
            </li>';

            echo '<li class="treeview">
              <a href="docentes.php">
              &nbsp<i class="fa fa-users"></i>
                <span>Docentes</span>                
              </a>              
            </li>';
            }
            ?>  
            
            <?php 
            if ($_SESSION['cursos']==1)
            {
              echo '<li class="treeview">
              <a href="curso.php">
              &nbsp<i class="fa fa-th"></i>
                <span>Cursos</span>
              </a>                
            </li>';
            echo '<li class="treeview">
            <a href="certificados.php">
            &nbsp<i class="fa fa-file"></i>
              <span>Plantillas</span>
            </a>                
          </li>';
            }
            ?>
          
            <?php 
            if ($_SESSION['personal']==1)
            {
              echo '<li class="treeview">
              <a href="#">
              &nbsp<i class="fa fa-user"></i> <span>Personal</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="empleado.php">&nbsp&nbsp<i class="fa fa-user-plus"></i> Personal</a></li>
                <li><a href="usuario.php">&nbsp&nbsp<i class="fa fa-users"></i> Usuarios</a></li>                
              </ul>
            </li>';
            }
            ?>
            </ul>
        

          <ul class="sidebar-menu">                    
           <?php 
           if ($_SESSION['reportes']==1)
           {
             echo '<li class="treeview">
             <a href="#"><i class="fa fa-bar-chart"></i>
           <span>Reportes ENCAP</span>
               <i class="fa fa-angle-left pull-right"></i>
             </a>
             <ul class="treeview-menu">
               <li><a href="reportematricula1.php">&nbsp&nbsp<i class="fa fa-line-chart"></i> Reporte de Matricula </a> </li>  
               <li><a href="reportematriculadetallado.php">&nbsp&nbsp<i class="fa fa-area-chart"></i> Reporte Detallado</a></li>             
               <li><a href="reporteenvio.php">&nbsp&nbsp<i class="fa fa-pie-chart"></i> Reporte de Envios</a></li>  
               <li><a href="reportereclamos.php">&nbsp&nbsp<i class="fa fa-bar-chart"></i> Reporte de Reclamos</a></li>  
               <li><a href="reportesatisfaccion.php">&nbsp&nbsp<i class="fa fa-signal"></i> Reporte de Satisfacción</a></li>  
               <li><a href="reporteparticipantes.php">&nbsp&nbsp<i class="fa fa-signal"></i> Reporte de Participantes</a></li> 
             </ul>
           </li>';
           }
           ?> 
         
          <?php 
            if ($_SESSION['configuracion']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i>
                <span>Configuración</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="categoria.php">&nbsp&nbsp<i class="fa fa-cogs"></i> Tipo de Cursos</a></li>
                <li><a href="subtipocurso.php">&nbsp&nbsp<i class="fa fa-cogs"></i> Sub tipo de Cursos</a></li>
                <li><a href="courier.php">&nbsp&nbsp<i class="fa fa-truck"></i> Courier</a></li> 
                <li><a href="mediospagos.php">&nbsp&nbsp<i class="fa fa-credit-card"></i> Medios de Pagos</a></li>     
                <li><a href="procedimiento.php">&nbsp&nbsp<i class="fa fa-bookmark-o"></i> Forma de Recaudación</a></li>    
                <li><a href="pais.php">&nbsp&nbsp<i class="fa fa-map-o"></i> País</a></li>  
                <li><a href="tipodocumento.php">&nbsp&nbsp<i class="fa fa-file-text-o"></i> Tipo de Documento</a></li>   
                <li><a href="trafico.php">&nbsp&nbsp<i class="fa fa-facebook"></i> Medio de Trafico</a></li>       
                <li><a href="asunto.php">&nbsp&nbsp<i class="fa fa-commenting-o"></i> Asuntos - Reclamos</a></li>  
                <li><a href="subasunto.php">&nbsp&nbsp<i class="fa fa-commenting-o"></i> Sub categorias asuntos </a></li>  
                <li><a href="videostutorial.php">&nbsp&nbsp<i class="fa fa-commenting-o"></i> Videos tutorial</a></li>  
                <li><a href="consultaenvio.php">&nbsp&nbsp<i class="fa fa-car"></i> Ciudades de envios </a></li>  
              </ul>   
            </li>';
            }
            ?>  
          
          
          <?php 
            if ($_SESSION['configuracion']==1)
            {
              echo '<li class="treeview">
              <a href="copiaseguridadbd.php">
              <i class="fa fa-cloud-download"></i>
                <span>Backup BD</span>
                <small class="label pull-right bg-green">SQL</small>
              </a>                
            </li>';
            }
            ?>

          <?php 
            if ($_SESSION['configuracion']==1)
            {
              echo '<li class="treeview">
              <a href="presencial.php" target"_blanck">
              <i class="fa fa-desktop"></i>
                <span>Matriculas presencial</span>
                <small class="label pull-right bg-yellow">PRE</small>
              </a>                
            </li>';
            }
            ?>
            </ul> 
          

          <ul class="sidebar-menu">
            <li class="header" style="background:  #85c1e9 ;color: #17202a ">DOCUMENTACIÓN</li>
            <li>
              <a href="ayudavideos.php" >
                <i class="fa fa-info-circle treeview active"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">MPG4</small>
              </a>
            </li> 

            <li>
              <a href="acerca.php">
                <i class="fa fa-info-circle treeview active" id="liAcerca"></i> <span>Acerca de...</span>
                <small class="label pull-right bg-yellow">?</small>
              </a>
            </li>                        
          </ul> 
        </section>
        <!-- /.sidebar -->
      </aside>

    
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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




