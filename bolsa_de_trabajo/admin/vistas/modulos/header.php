<?php
if (strlen(session_id()) < 1) 
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Escritorio</title>
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
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

    <!-- sweetalert2 -->
  <link rel="stylesheet" href="../public/css/sweetalert.min.css" />

  </head>
  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini" style="font-size:12px"><b>ENCAP</b></span>
          <b > ENCAP</b>
          <!-- logo for regular state and mobile devices -->
          <!-- <img src="../files/AgroNegocios.png"> -->
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/personal/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs" style="font-size:12px"><?php echo $_SESSION['nombre']; ?></span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../controladores/usuario.php?op=salir" class="btn btn-default btn-flat"><i class="fa fa-lock"></i> Cerrar sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              

            </ul>
          </div>
        </nav>
      </header>
      
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../files/personal/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info" style="font-size:12px">
              <p><?php echo $_SESSION['nombre']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>


          <!-- sidebar menu: : style can be found in sidebar.less -->
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
            <li class="header">MENÚ DE NAVEGACIÓN</li>

            <?php 
            if ($_SESSION['inicio']==1)
            {
              echo '<li id="mInicio">
              <a href="empleo.php">
                <i class="fa fa-file text-cyan"></i> <span>Empleos</span>
              </a>
            </li>';
            }
            ?>
            <?php
            if ($_SESSION['inicio'] == 1) {
                echo '<li id="mInicio">
                    <a href="anuncios.php">
                        <i class="fa fa-bullhorn text-cyan"></i> <span>Anuncios</span>
                    </a>
                </li>';
            }
            ?>
            </ul>


            <ul class="sidebar-menu">
            <?php 
            if ($_SESSION['personal']==1)
            {
              echo '<li id="mInicio">
              <a href="empleado.php">
                <i class="fa fa-user"></i> <span>Personal</span>
              </a>
            </li>';
            }
            ?>
            </ul>

            <ul class="sidebar-menu">
            <?php 
            if ($_SESSION['personal']==1)
            {
              echo '<li id="mInicio">
              <a href="usuario.php">
                <i class="fa fa-users"></i> <span>Usuarios</span>
              </a>
            </li>';
            }
            ?>
            </ul>
      

            </ul>


        </section>
        <!-- /.sidebar -->
      </aside>
