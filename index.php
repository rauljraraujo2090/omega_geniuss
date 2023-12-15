<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] == "add") {
	$id = intval($_GET['id']);
	if (isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]['quantity']++;
	} else {
		$sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p);
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
		} else {
			$message = "El producto ha sido añadido al carrito.";
		}
	}
	echo "<script>alert('Product has been added to the cart')</script>";
	echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">

	<title>Omega Genius</title>

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Customizable CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/green.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

	<!-- Demo Purpose Only. Should be removed in production -->
	<link rel="stylesheet" href="assets/css/config.css">

	<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


	<!---ESTILOS AÑADIDOS RECIENTEMENTE--->
	<link rel="stylesheet" href="estilos.css">

</head>

<body class="cnt-home">



	<!-- ============================================== HEADER ============================================== -->
	<header class="header-style-1">
		<?php include('includes/top-header.php'); ?>

	</header>
	<!-- ======= Hero  portada Section ======= -->
	<section id="hero" class="d-flex align-items-center">
		<div class="container" data-aos="zoom-out" data-aos-delay="100">
			<h1> Bienvenido a <span>Omega Genius</span></h1>
			<h2>We are team of talented designers making websites with Bootstrap</h2>
			<div class="d-flex">
				<a id="buton" href="#about" class="btn-get-started scrollto">Get Started</a>
				<a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Ver Video</span></a>
			</div>
		</div>
	</section><!-- End Hero -->




	<!-- ======= Featured Services Section ======= -->
	<section id="featured-services" class="featured-services">
		<div class="container" data-aos="fade-up">

			<div class="row">
				<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
						<div class="icon"><i class="fa fa-check  m-0 mr-3"></i></div>
						<h4 class="title"><a href="">Producto de Calidad</a></h4>
						<p class="description">Ofrecemos Productos de una Calidad muy alta y seguro</p>
					</div>
				</div>

				<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
						<div class="icon"><i class="bx bx-file"></i></div>
						<h4 class="title"><a href="">Envio Gratis</a></h4>
						<p class="description">Ofrecemos envios Gratis en las mayorias de los Productos </p>
					</div>
				</div>

				<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="300">
						<div class="icon"><i class="bx bx-tachometer"></i></div>
						<h4 class="title"><a href="">Regreso en 14 Días</a></h4>
						<p class="description">Cuando Los Productos llegan en mal estado o con alguna falla se hace la devolucion en 14 dias previa evaluación</p>
					</div>
				</div>

				<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="400">
						<div class="icon"><i class="bx bx-world"></i></div>
						<h4 class="title"><a href="">Soporte 24 horas al día, 7 días a la semana</a></h4>
						<p class="description">Estamos Activos las 24 horas del dia para cualquier consulta del cliente</p>
					</div>
				</div>

			</div>

		</div>
	</section><!-- End Featured Services Section -->

	<!-- ============================================== HEADER : END ============================================== -->
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
		<div class="container">
			<div class="furniture-container homepage-container">
				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
						<!-- ================================== TOP NAVIGATION ================================== -->

						<!-- ================================== TOP NAVIGATION : END ================================== -->
					</div><!-- /.sidemenu-holder -->

					<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
						<!-- ========================================== SECTION – HERO ========================================= -->



						<!-- ========================================= SECTION – HERO : END ========================================= -->
						<!-- ============================================== INFO BOXES ============================================== -->

						<!-- ============================================== INFO BOXES : END ============================================== -->
					</div><!-- /.homebanner-holder -->

				</div><!-- /.row -->

				<!-- ============================================== SCROLL TABS ============================================== -->


				<!-- ============================================== TABS ============================================== -->
				<div class="sections prod-slider-small outer-top-small">
					<div class="row">












						<div class="tab-pane in active" id="all">
							<div class="product-slider">
								<h3 id="letra" class="section-title">LAPTOPS</h3>
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
									<?php
									$ret = mysqli_query($con, "select * from producto where category=10");
									while ($row = mysqli_fetch_array($ret)) {
										# code...


									?>

										<div id="espacio" class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<div class="image">
															<a href="detalle_producto.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img id="imagen" src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="280" height="300" alt=""></a>
														</div><!-- /.image -->


													</div><!-- /.product-image -->


													<div id="color" class="product-info text-left">
														<h3 class="name"><a href="detalle_producto.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['nombre_producto']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																S/.<?php echo htmlentities($row['precio_producto']); ?> </span>
															<span class="price-before-discount">S/.<?php echo htmlentities($row['producto_antes_descuento']); ?> </span>

														</div><!-- /.product-price -->

													</div><!-- /.product-info -->
													<?php if ($row['disponibilidad_producto'] == 'In Stock') { ?>
														<div class="action"><a id="buton" href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">AGREGARrS AL CARRITO</a></div>
													<?php } else { ?>
														<div class="action" style="color:red">Out of Stock</div>
													<?php } ?>
												</div><!-- /.product -->

											</div><!-- /.products -->
										</div><!-- /.item -->
									<?php } ?>

								</div><!-- /.home-owl-carousel -->
							</div><!-- /.product-slider -->
						</div>





						<!-------SECCION DE COMPUTADOR---->





						<style>
							#letra {
								color: #106eea !important;
							}
						</style>
						<div class="tab-pane in active" id="all">
							<div class="product-slider">
								<br>
								<br>
								<h3 id="letra" class="section-title">COMPUTADORAS</h3>
								<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
									<?php
									$ret = mysqli_query($con, "select * from producto where category=11");
									while ($row = mysqli_fetch_array($ret)) {
										# code...


									?>

										<div id="espacio" class="item item-carousel">
											<div class="products">

												<div class="product">
													<div class="product-image">
														<div class="image">
															<a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
																<img id="imagen" src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="280" height="300" alt=""></a>
														</div><!-- /.image -->


													</div><!-- /.product-image -->
													<style>
														#espacio {

															margin-left: 23px !important;
															margin-bottom: 33px !important;
														}
													</style>

													<div id="color" class="product-info text-left">
														<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['nombre_producto']); ?></a></h3>
														<div class="rating rateit-small"></div>
														<div class="description"></div>

														<div class="product-price">
															<span class="price">
																S/.<?php echo htmlentities($row['precio_producto']); ?> </span>
															<span class="price-before-discount">S/.<?php echo htmlentities($row['producto_antes_descuento']); ?> </span>

														</div><!-- /.product-price -->

													</div><!-- /.product-info -->
													<?php if ($row['disponibilidad_producto'] == 'In Stock') { ?>
														<div class="action"><a id="buton" href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">AGREGAR AL CARRITO</a></div>
													<?php } else { ?>
														<div class="action" style="color:red">Out of Stock</div>
													<?php } ?>
												</div><!-- /.product -->

											</div><!-- /.products -->
										</div><!-- /.item -->
									<?php } ?>

								</div><!-- /.home-owl-carousel -->
							</div><!-- /.product-slider -->
						</div>




















					</div>
				</div>
				<br>
				<br>
				<?php include('includes/footer.php'); ?>

				<script src="assets/js/jquery-1.11.1.min.js"></script>

				<script src="assets/js/bootstrap.min.js"></script>

				<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
				<script src="assets/js/owl.carousel.min.js"></script>

				<script src="assets/js/echo.min.js"></script>
				<script src="assets/js/jquery.easing-1.3.min.js"></script>
				<script src="assets/js/bootstrap-slider.min.js"></script>
				<script src="assets/js/jquery.rateit.min.js"></script>
				<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
				<script src="assets/js/bootstrap-select.min.js"></script>
				<script src="assets/js/wow.min.js"></script>
				<script src="assets/js/scripts.js"></script>

				<!-- For demo purposes – can be removed on production -->

				<script src="switchstylesheet/switchstylesheet.js"></script>

				<script>
					$(document).ready(function() {
						$(".changecolor").switchstylesheet({
							seperator: "color"
						});
						$('.show-theme-options').click(function() {
							$(this).parent().toggleClass('open');
							return false;
						});
					});

					$(window).bind("load", function() {
						$('.show-theme-options').delay(2000).trigger('click');
					});
				</script>
				<!-- For demo purposes – can be removed on production : End -->

				<!--MODAL DE BUSCADOR--->


</body>

</html>