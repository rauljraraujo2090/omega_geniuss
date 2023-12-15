<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] == "add") {
	$id = intval($_GET['id']);
	if (isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]['quantity']++;
	} else {
		$sql_p = "SELECT * FROM producto WHERE id={$id}";
		$query_p = mysqli_query($con, $sql_p);
		if (mysqli_num_rows($query_p) != 0) {
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['precio_producto']);
			echo "<script>alert('El producto ha sido añadido al carrito.')</script>";
			echo "<script type='text/javascript'> document.location ='mi_carrito.php'; </script>";
		} else {
			$message = "Product ID is invalid";
		}
	}
}
$pid = intval($_GET['pid']);
if (isset($_GET['pid']) && $_GET['action'] == "wishlist") {
	if (strlen($_SESSION['login']) == 0) {
		header('location:login.php');
	} else {
		mysqli_query($con, "insert into lista_deseos(userId,productId) values('" . $_SESSION['id'] . "','$pid')");
		echo "<script>alert('Producto añadido a la lista de deseos.');</script>";
		header('location:lista_deseos.php');
	}
}
if (isset($_POST['submit'])) {
	$qty = $_POST['quality'];
	$price = $_POST['price'];
	$value = $_POST['value'];
	$name = $_POST['name'];
	$summary = $_POST['summary'];
	$review = $_POST['review'];
	mysqli_query($con, "insert into productreviews(productId,quality,price,value,name,summary,review) values('$pid','$qty','$price','$value','$name','$summary','$review')");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">
	<title>Detalles del producto </title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/green.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="assets/css/config.css">

	<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!---ESTILOS AÑADIDOS RECIENTEMENTE
	<link rel="stylesheet" href="estilos.css">

	--->
</head>

<body class="cnt-home">

	<header class="header-style-1">

		<!-- ============================================== TOP MENU ============================================== -->
		<?php include('includes/top-header.php'); ?>
		<!-- ============================================== TOP MENU : END ============================================== -->

		<!-- ============================================== NAVBAR : END ============================================== -->

	</header>

	
	<div class="body-content outer-top-xs">
		<div class='container'>
			<div class='row single-product outer-bottom-sm '>
				<div class='col-md-3 sidebar'>
					<div class="sidebar-module-container">


						
						<!-- ============================================== CATEGORY : END ============================================== --> <!-- ============================================== HOT DEALS ============================================== -->
						<div class="sidebar-widget hot-deals wow fadeInUp">
							<h3 class="section-title">LAS MEJORES OFERTAS</h3>
							<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">

								<?php
								$ret = mysqli_query($con, "select * from producto order by rand() limit 4 ");
								while ($rws = mysqli_fetch_array($ret)) {

								?>


									<div class="item">
										<div class="products">
											<div class="hot-deal-wrapper">
												<div class="image">
													<img src="admin/productimages/<?php echo htmlentities($rws['id']); ?>/<?php echo htmlentities($rws['productImage1']); ?>" width="270" height="300" alt="">
												</div>

											</div><!-- /.hot-deal-wrapper -->

											<div class="product-info text-left m-t-20">
												<h3 class="name"><a id="nombres"href="detalle_producto.php?pid=<?php echo htmlentities($rws['id']); ?>"><?php echo htmlentities($rws['nombre_producto']); ?></a></h3>
												<div class="rating rateit-small"></div>

												<div class="product-price">
													<span class="price">
														S/. <?php echo htmlentities($rws['precio_producto']); ?>.00
													</span>

													<span class="price-before-discount">S/.<?php echo htmlentities($row['producto_antes_descuento']); ?></span>

												</div><!-- /.product-price -->

											</div><!-- /.product-info -->

											<div class="cart clearfix animate-effect">
												<div class="action">

													<div class="add-cart-button btn-group">
														<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
															<?php if ($row['disponibilidad_producto'] == 'In Stock') { ?>
																<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
																	<i class="fa fa-shopping-cart"></i>
																</button>
																<a href="categoria.php?page=product&action=add&id=<?php echo $row['id']; ?>">
																	<button class="btn btn-primary" type="button">AGREGAR AL CARRITO</button></a>
															<?php } else { ?>
																<div class="action" style="color:white">AGOTADO</div>
															<?php } ?>

													</div>

												</div><!-- /.action -->
											</div><!-- /.cart -->
										</div>
									</div>
								<?php } ?>


							</div><!-- /.sidebar-widget -->
						</div>

						<!-- ============================================== COLOR: END ============================================== -->
					</div>
				</div><!-- /.sidebar -->
				<?php
				$ret = mysqli_query($con, "select * from producto where id='$pid'");
				while ($row = mysqli_fetch_array($ret)) {

				?>


					<div class='col-md-9'>
						<div class="row  wow fadeInUp">
							<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
								<div class="product-item-holder size-big single-product-gallery small-gallery">

									<div id="owl-single-product">

										<div class="single-product-gallery-item" id="slide1">
											<a data-lightbox="image-1" data-title="<?php echo htmlentities($row['nombre_producto']); ?>" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="370" height="350" />
											</a>
										</div>




										<div class="single-product-gallery-item" id="slide1">
											<a data-lightbox="image-1" data-title="<?php echo htmlentities($row['nombre_producto']); ?>" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="370" height="350" />
											</a>
										</div><!-- /.single-product-gallery-item -->

										<div class="single-product-gallery-item" id="slide2">
											<a data-lightbox="image-1" data-title="Gallery" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>" />
											</a>
										</div><!-- /.single-product-gallery-item -->

										<div class="single-product-gallery-item" id="slide3">
											<a data-lightbox="image-1" data-title="Gallery" href="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>">
												<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>" />
											</a>
										</div>

									</div><!-- /.single-product-slider -->


									<div class="single-product-gallery-thumbs gallery-thumbs">

										<div id="owl-single-product-thumbnails">
											<div class="item">
												<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
													<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>" />
												</a>
											</div>

											<div class="item">
												<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
													<img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage2']); ?>" />
												</a>
											</div>
											<div class="item">

												<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="3" href="#slide3">
													<img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage3']); ?>" height="200" />
												</a>
											</div>




										</div><!-- /#owl-single-product-thumbnails -->



									</div>

								</div>
							</div>




							<div class='col-sm-6 col-md-7 product-info-block'>
								<div class="product-info">
									<h1 id="nombre" class="name"><?php echo htmlentities($row['nombre_producto']); ?></h1>
									<?php $rt = mysqli_query($con, "select * from productreviews where productId='$pid'");
									$num = mysqli_num_rows($rt); {
									?>
										<div class="rating-reviews m-t-20">
											<div class="row">
												<div class="col-sm-3">
													<div class="rating rateit-small"></div>
												</div>
												<div class="col-sm-8">
													<div class="reviews">
														<a href="#" class="lnk">(<?php echo htmlentities($num); ?> Comentarios)</a>
													</div>
												</div>
											</div><!-- /.row -->
										</div><!-- /.rating-reviews -->
									<?php } ?>
									<div class="stock-container info-container m-t-10">
										<div class="row">
											<div class="col-sm-3">
												<div class="stock-box">
													<span class="label">Disponibilidad:</span>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="stock-box">
													<span class="value"><?php echo htmlentities($row['disponibilidad_producto']); ?></span>
												</div>
											</div>
										</div><!-- /.row -->
									</div>



									<div class="stock-container info-container m-t-10">
										<div class="row">
											<div class="col-sm-3">
												<div class="stock-box">
													<span class="label"> Marca:</span>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="stock-box">
													<span class="value"><?php echo htmlentities($row['producto_empresa']); ?></span>
												</div>
											</div>
										</div><!-- /.row -->
									</div>
<style>
#description{
font-size: 16px !important;

}
	span{

		color:black !important;
		
	}
	#nombre{
		color:black !important;
	}
	#nombres{
		color:black !important;
	}
	#nombres:hover{
		color: #106eea !important;
	}
	#btn-detalles {

		background-color: #106eea !important;
	}
	#agregar{
		font-size: 14px !important;
	}
	a#btn-detalles::after{

		color: #106eea !important;

	}
	.single-product .product-tabs .nav.nav-tabs.nav-tab-cell li.active a:after{

		border-color:rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #106eea;
	}
	#compartir{
		color: #106eea !important;
	}

	li{

		font-size: 15px !important;
	}
	.price{
		color:black !important;
	}
	button{

font-size: 14px !important;
background-color: #106eea !important;
}
button:hover{

font-size: 14px !important;

}


	
	

.owl-prev{
    background-color: black !important;


}
.owl-next{
    background-color: black !important;


}
.owl-prev:hover{
    background-color: #106eea !important;


}
.owl-next:hover{
    background-color: #106eea !important;


}

  
	
</style>

									<div class="stock-container info-container m-t-10">
										<div class="row">
											<div class="col-sm-3">
												<div class="stock-box">
													<span class="label">COSTO DE ENVÍO :</span>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="stock-box">
													<span class="value"><?php if ($row['shippingCharge'] == 0) {
																			echo "Gratis";
																		} else {
																			echo htmlentities($row['shippingCharge']);
																		}

																		?></span>
												</div>
											</div>
										</div><!-- /.row -->
									</div>

									<div class="price-container info-container m-t-20">
										<div class="row">
											<style>
												.price {
													color:#106eea !important;
												}
											</style>

											<div class="col-sm-6">
												<div class="price-box">
													<span class="price">S/. <?php echo htmlentities($row['precio_producto']); ?></span>
													<span class="price-strike">S/.<?php echo htmlentities($row['producto_antes_descuento']); ?></span>
												</div>
											</div>




											<div class="col-sm-6">
												<div class="favorite-button m-t-10">
													<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="detalle_producto.php?pid=<?php echo htmlentities($row['id']) ?>&&action=wishlist">
														<i class="fa fa-heart"></i>
													</a>

													</a>
												</div>
											</div>

										</div><!-- /.row -->
									</div><!-- /.price-container -->






									<div class="quantity-container info-container">
										<div class="row">

											<div class="col-sm-2">
												<span class="label">CANTIDAD:</span>
											</div>

											<div class="col-sm-2">
												<div class="cart-quantity">
													<div class="quant-input">
														<div class="arrows">
															<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
															<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
														</div>
														<input type="text" value="1">
													</div>
												</div>
											</div>

											<div class="col-sm-7">
												<?php if ($row['disponibilidad_producto'] == 'In Stock') { ?>
													<a id="agregar" href="detalle_producto.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> AGREGAR AL CARRITO</a>
												<?php } else { ?>
													<div class="action" style="color:red">Out of Stock</div>
												<?php } ?>
											</div>


										</div><!-- /.row -->
									</div><!-- /.quantity-container -->

									<div class="product-social-link m-t-20 text-right">
										<span class="social-label">Compartir :</span>
										<div class="social-icons">
											<ul class="list-inline">
												<li><a id="compartir"class="fa fa-facebook" href="#"></a></li>
												<li><a id="compartir"class="fa fa-twitter" href="#"></a></li>
												<li><a id="compartir"class="fa fa-linkedin" href="#"></a></li>
												<li><a id="compartir"class="fa fa-rss" href="#"></a></li>
												<li><a id="compartir"class="fa fa-pinterest" href="#"></a></li>
											</ul><!-- /.social-icons -->
										</div>
									</div>




								</div><!-- /.product-info -->
							</div><!-- /.col-sm-7 -->
						</div><!-- /.row -->


						<div class="product-tabs inner-bottom-xs  wow fadeInUp">
							<div class="row">
								<div class="col-sm-3">
									<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
										<li class="active"><a id="btn-detalles"  >DESCRIPCION</a></li>
										<!---<li><a  data-toggle="tab" href="#review">REVISAR</a></li>--->
									</ul><!-- /.nav-tabs #product-tabs -->
								</div>
								<div class="col-sm-9">

									<div class="tab-content">

										<div id="description" class="tab-pane in active">
											<div class="product-tab">
												<p class="text"><?php echo $row['descripcion_producto']; ?></p>
											</div>
										</div><!-- /.tab-pane -->

										<div id="review" class="tab-pane">
											<div class="product-tab">

												<div class="product-reviews">
													<h4 class="title">OPINIONES DE LOS USUARIOS</h4>
													<?php $qry = mysqli_query($con, "select * from productreviews where productId='$pid'");
													while ($rvw = mysqli_fetch_array($qry)) {
													?>

														<div class="reviews" style="border: solid 1px #000; padding-left: 2% ">
															<div class="review">
																<div class="review-title"><span class="summary"><?php echo htmlentities($rvw['summary']); ?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo htmlentities($rvw['reviewDate']); ?></span></span></div>

																<div class="text">"<?php echo htmlentities($rvw['review']); ?>"</div>
																<div class="text"><b>Quality :</b> <?php echo htmlentities($rvw['quality']); ?> Star</div>
																<div class="text"><b>Price :</b> <?php echo htmlentities($rvw['price']); ?> Star</div>
																<div class="text"><b>value :</b> <?php echo htmlentities($rvw['value']); ?> Star</div>
																<div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name"><?php echo htmlentities($rvw['name']); ?></span></div>
															</div>

														</div>
													<?php } ?><!-- /.reviews -->
												</div><!-- /.product-reviews -->
												<form role="form" class="cnt-form" name="review" method="post">


													<div class="product-add-review">
														<h4 class="title">ESCRIBE TU PROPIA RESEÑA</h4>
														<div class="review-table">
															<div class="table-responsive">
																<table class="table table-bordered">
																	<thead>
																		<tr>
																			<th class="cell-label">&nbsp;</th>
																			<th>1 Estrella</th>
																			<th>2 Estrella</th>
																			<th>3 Estrella</th>
																			<th>4 Estrella</th>
																			<th>5 Estrella</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td class="cell-label">Calidad</td>
																			<td><input type="radio" name="quality" class="radio" value="1"></td>
																			<td><input type="radio" name="quality" class="radio" value="2"></td>
																			<td><input type="radio" name="quality" class="radio" value="3"></td>
																			<td><input type="radio" name="quality" class="radio" value="4"></td>
																			<td><input type="radio" name="quality" class="radio" value="5"></td>
																		</tr>
																		<tr>
																			<td class="cell-label">Precio</td>
																			<td><input type="radio" name="price" class="radio" value="1"></td>
																			<td><input type="radio" name="price" class="radio" value="2"></td>
																			<td><input type="radio" name="price" class="radio" value="3"></td>
																			<td><input type="radio" name="price" class="radio" value="4"></td>
																			<td><input type="radio" name="price" class="radio" value="5"></td>
																		</tr>
																		<tr>
																			<td class="cell-label">Valor</td>
																			<td><input type="radio" name="value" class="radio" value="1"></td>
																			<td><input type="radio" name="value" class="radio" value="2"></td>
																			<td><input type="radio" name="value" class="radio" value="3"></td>
																			<td><input type="radio" name="value" class="radio" value="4"></td>
																			<td><input type="radio" name="value" class="radio" value="5"></td>
																		</tr>
																	</tbody>
																</table><!-- /.table .table-bordered -->
															</div><!-- /.table-responsive -->
														</div><!-- /.review-table -->

														<div class="review-form">
															<div class="form-container">


																<div class="row">
																	<div class="col-sm-6">
																		<div class="form-group">
																			<label for="exampleInputName">Su Nombre <span class="astk">*</span></label>
																			<input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="name" required="required">
																		</div><!-- /.form-group -->
																		<div class="form-group">
																			<label for="exampleInputSummary">Resumen <span class="astk">*</span></label>
																			<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="" name="summary" required="required">
																		</div><!-- /.form-group -->
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<label for="exampleInputReview">Revisar <span class="astk">*</span></label>

																			<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="review" required="required"></textarea>
																		</div><!-- /.form-group -->
																	</div>
																</div><!-- /.row -->

																<div class="action text-right">
																	<button name="submit" class="btn btn-primary btn-upper">ENVIAR OPINION</button>
																</div><!-- /.action -->

												</form><!-- /.cnt-form -->
											</div><!-- /.form-container -->
										</div><!-- /.review-form -->

									</div><!-- /.product-add-review -->

								</div><!-- /.product-tab -->
							</div><!-- /.tab-pane -->



						</div><!-- /.tab-content -->
					</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.product-tabs -->

	<?php $cid = $row['category'];
					$subcid = $row['subCategory'];
				} ?>


	

	<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

	</div><!-- /.col -->
	<div class="clearfix"></div>
	</div>
	<?php include('includes/brands-slider.php'); ?>
	</div>
	</div>
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



</body>

</html>