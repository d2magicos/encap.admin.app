	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="<?php echo NAME_BUSINESS ?>">
		<meta name="author" content="<?php echo NAME_BUSINESS ?>">
		<meta name="keywords" content="<?php echo NAME_BUSINESS ?>">

		<title><?php echo NAME_BUSINESS ?></title>

		<link href="<?php echo URL; ?>public/plugins/bootstrap v5.1.1/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo URL; ?>public/css/app.css" rel="stylesheet">
		<link href="<?php echo URL; ?>public/css/aditional.css" rel="stylesheet">
		<!--LIBRERIAS-->
		<link href="<?php echo URL; ?>public/plugins/toast/jquery.toast.min.css" rel="stylesheet" />
		<link href="<?php echo URL; ?>public/plugins/select2/select2.min.css" rel="stylesheet" />
		<link href="<?php echo URL ?>public/plugins/font-awesome-6.2.1/css/all.min.css" rel="stylesheet">
		<link href="<?php echo URL ?>public/plugins/iziToast/iziToast.min.css" rel="stylesheet">
		<!-- LIBRERIAS CDN -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css" />
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

		<?php date_default_timezone_set("America/Lima"); ?>
		<input type="hidden" id="url" value="<?php echo URL; ?>">
	</head>

	<body class="bg-body">
		<header class="shadow-lg rounded position-fixed w-100 top-0">
			<div class="container py-3">
				<div class="row d-flex justify-content-between align-items-center">
					<?php if (in_array(explode("/", $_SERVER["REQUEST_URI"])[3], ["home", "", "contactos"]) && count(explode("/", $_SERVER["REQUEST_URI"])) <= 4) : ?>
						<?php
						$show_btn_contact = "";
						$search_top = false;
						$width_logo = "col-lg-3";
						?>
					<?php else : ?>
						<?php
						$show_btn_contact = "d-none";
						$search_top = true;
						$width_logo = "col-lg-1";
						?>
					<?php endif ?>
					<div class="col-md-auto <?php echo $width_logo ?> d-flex justify-content-center justify-content-md-start align-content-center px-0">
						<a href="<?php echo URL ?>" class="logo">
							<img style="width: 80px; height:auto ; padding: 5px;" class="img-fluid d-none d-md-block" src="<?php echo URL ?>public/image/encap_blanco.png" alt="Logo Comunicaciones Universo">
							<img style="width: 250px; height:auto ; padding: 5px;" class="img-fluid d-block d-md-none" src="<?php echo URL ?>public/image/logo.png" alt="Logo Comunicaciones Universo">
						</a>
					</div>
					<?php if ($search_top) : ?>
						<div class="col-md-8 col-lg-8 mt-2 d-none d-md-block">
							<!-- Componente buscador -->
							<?php include("views/templates/components/cmp_buscador.php") ?>
						</div>
					<?php endif ?>
					<div class="col-md-auto col-lg-auto d-none d-md-block">
						<div class="d-flex justify-content-end">
							<a href="<?php echo URL; ?>contactos" class="btn btn_contact me-3 <?php echo $show_btn_contact ?>">Contáctanos</a>
							<a href="<?php echo URL_CAPACITATE ?>" target="_blank" class="btn btn_capacitate">Capacítate</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<?php if (isset($this->css)) : ?>
			<?php foreach ($this->css as $css) : ?>
				<link rel="stylesheet" href="<?php echo URL; ?>views/<?php echo $css ?>">
			<?php endforeach ?>
		<?php endif ?>