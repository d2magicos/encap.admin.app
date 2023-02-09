<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Convocatorias ENCAP </title>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
		
	<!-- Custom stlyles  -->
	<link rel="stylesheet" type="text/css" href="css/index.css">

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
	
	<!-- Favicon -->
	<link rel="icon" href="../files/ENCAP.ico">
	
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
</head>

<body>
	<!-- cabezera d ela pagina  -->
	<?php include("layouts/_main-header.php"); ?>
	<?php include("servicios/_conexion.php"); ?>

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Inicio</a></li>							
							<li class="active" ><a href="#" id="idmarca">Empleos</a></li>							
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

							<!-- SEARCH BAR -->
							<div class="row">
						<div class="col-md-2 col-sm-1 col-xs-1">
						</div> 

						<div class="col-md-8 col-sm-10 col-xs-10">
							<div class="header-search" class="col-md-8 col-sm-12 col-xs-12">
							<div class="clock" >
						    	<ul>
						    	     <li class="icon-datos"><i class="fa fa-calendar"></i> <span  id="Date"> </span></li>&nbsp;&nbsp;
						    	   &nbsp;
								 	<i class="fa fa-clock-o"></i> &nbsp;
									<li id="hours"></li>
									<li id="point">:</li>
									<li id="min"></li>
									<li id="point">:</li>
									<li id="sec"></li>
								</ul>
							</div>
								<div class="formbus" class="col-md-8 col-sm-12 col-xs-12">															
									<input class="input" type="text" id="idbusqueda" placeholder="Coloca el perfil que estás buscando..." value="<?php if(isset($_GET['text'])){echo $_GET['text'];}else{echo '';} ?>">
									<button class="search-btn" onclick="search_producto()" aria-hidden="true">Buscar</button>	
									<br>
								<div style="text-align: left; padding: 10px 0px 0px 0px;">
									<a href="index.php"><button class="regresar-btn"><i class="fa fa-reply"></i> Regresar a la lista de empleos</button></a>
								</div>	
								</div>								
							</div>
						</div>

						<div class="col-md-2 col-sm-1 col-xs-1">
						</div>
					</div>

					<!-- /SEARCH BAR -->

	<!-- SECTION Smartphones-->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
<!-- SECTION PRODUCTOS -->	
				<div class="row">
					<div class="main-content">
						<div class="content-page">
							<div class="title-section" id="palabra" style="display:none"><?php echo $_GET['text']; ?></div>

							<div class="products-list" id="space-list">
								
							</div>
						</div>
					</div>
				</div>
<!-- /SECTION PRODUCTOS -->	
			<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Entérate de Nuestras Mejores <strong>Ofertas</strong></p>
		
							<ul class="newsletter-follow">
								<li>
									<a href="https://www.facebook.com/www.encap.edu.pe" target="_blank"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="https://wa.link/gq6z5w" target="_blank"><i class="fa fa-whatsapp"></i></a>
								</li>
								<li>
									<a href="https://www.instagram.com/encap_capacitaciones/" target="_blank"><i class="fa fa-instagram"></i></a>
								</li>	
								<li>
									<a href="https://www.youtube.com/c/ENCAPCAPACITACIONES" target="_blank"><i class="fa fa-youtube"></i></a>
								</li>								
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

	<?php include("layouts/_footer.php"); ?>

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
	
	<script type="text/javascript" src="js/main-scripts.js"></script>
	<script type="text/javascript">
		var text="<?php echo $_GET['text']; ?>";
		var prov="<?php echo $_GET['prov']; ?>";
		$(document).ready(function(){
			$.ajax({
				url:'servicios/empleos/get_all_results.php',
				type:'POST',
				data:{
					text:text,
					prov:prov
				},
				success:function(data){
					console.log(data);
					let html="<h3>Se encontraron "+data.datos.length+" resultados para \""+text+"\"</h3>";
					for (var i = 0; i < data.datos.length; i++) {
						html+=
					'<div class="col-md-12 col-sm-12 col-xs-12">'+				
						'<div class="product">'+
							'<div class="row">'+
								'<h3 class="product-name"><a href="producto.php?p='+data.datos[i].codpro+'">'+data.datos[i].nompro+'</h3>'+
								'<h5 style="color:#000;">ENTIDAD: <strong class="entidad">'+data.datos[i].empresa+'</strong></h5></a><br>'+
								'<div class="col-md-2 col-xs-12">'+
									'<div class="product-img">'+
										'<a href="producto.php?p='+data.datos[i].codpro+'">'+
										'<br>'+
										'<img src="assets/encap.png">'+												
										'</a>'+	
									'</div>'+
								'</div>'+

							'<div class="col-md-7 col-xs-12">'+
								'<div class="product-body">'+
									'<p class="icon-datos"><a><i class="fa fa-map-marker"></i></a> Ubicación: <span class="datos">'+data.datos[i].ubicacion+'</span> </p>'+
									'<p class="icon-datos"><a><i class="fa fa-users"></i></a> Cantidad de Vacantes: <span class="datos"> '+data.datos[i].nvacantes+' </span> </p>'+
									'<p class="icon-datos"><a><i class="fa fa-usd"></i></a> Remuneración: <span class="datos"> S/.'+data.datos[i].renumeracion+' </span> </p>'+
									'<p class="icon-datos"><a><i class="fa fa-calendar"></i></a> Fecha Inicio de Publicación: <span class="datos">'+data.datos[i].fechainicio+' </span> </p>'+
									'<p class="icon-datos"><a><i class="fa fa-calendar-times-o"></i></a> Fecha Fin de Publicación: <span class="datos">'+data.datos[i].fechafin+'</span> </p>'+
								'</div>'+
							'</div>'+

							'<div class="col-md-2 col-xs-12">'+				
								'<div class="add-to-cart">'+
										'<button class="add-to-cart-btn"><a href="producto.php?p='+data.datos[i].codpro+'"><i class="fa fa-eye"></i> Ver más</a></button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+	
				'</div>';
					}
					if (html=='') {
						document.getElementById("space-list").innerHTML="No hay resultados";
					}else{
						document.getElementById("space-list").innerHTML=html;
					}
				},
				error:function(err){
					console.error(err);
				}
			});
		});		
	</script>
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
</body>
</html>