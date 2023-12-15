<?php 
include('config.php');
?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$contactno=$_POST['contactno'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
if($query)
{
	echo "<script>alert('Estás registrado con éxito');</script>";
}
else{
echo "<script>alert('No registrar algo salió mal');</script>";
}
}
// Code for User login
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="mi_carrito.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
exit();
}
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Menu</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assetss/vendor/aos/aos.css" rel="stylesheet">
  <link href="assetss/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assetss/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assetss/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assetss/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assetss/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assetss/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->



  
</head>

<body>


<style>

  #texto{

    color: white !important;
    font-family: Arial, Helvetica, sans-serif !important;
  }
  #texto:hover{
    color:#106eea !important;
  }
  #input{

    font-size: 14px !important;
  }
  nav{

    border-radius: 1px !important;
  }
</style>

  <!-- ======= Top Bar ======= -->
  <nav class=" navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block " id="templatemo_nav_top">
  <div class="container text-light">
            <div class="w-100 d-flex justify-content-between mt-3">
              <div  class="d-flex justify-content-center" >
      <?php if(strlen($_SESSION['login']))
    {   ?>
      <i class="bi bi-envelope d-flex align-items-center ms-4">
        <a id="texto" class="navbar-sm-brand text-light text-decoration-none" href="">Bienvenido-<?php echo htmlentities($_SESSION['username']);?></a></i>
      <?php } ?>


        <i class="fa fa-user d-flex align-items-center ms-4">
          <a id="texto"href="mi_cuenta.php">Mi Cuenta</a></i>

     <br>
     
    
       <!---"bi bi-heart d-flex align-items-center ms-4---->
      <i class="fa fa-user d-flex align-items-center ms-4">
          <a id="texto"href="lista_deseos.php">Lista de Deseos </a>
        </i>
          


        <i class="bi bi-shopping-cart d-flex align-items-center ms-4">
          <a id="texto"href="mi_carrito.php">Mi Carrito</a></i>
        <?php if(strlen($_SESSION['login'])==0)
        {   ?>
            <i class="fa fa-user d-flex align-items-center ms-4">
              <a id="texto"href="login.php">Iniciar Sesion</a></i>
            <?php }
else{ ?>
        <i class="fa fa-user d-flex align-items-center ms-4"><a id="texto"href="cerrar_sesion.php">Cerrar Sesion</a></i>
        <?php } ?>
      </div>




      <div class="social-links d-none d-md-flex align-items-center">
        
        <a id="texto"href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a id="texto"href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a id="texto"href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a id="texto"href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
</nav>





  <!---Inicio DE BUSQUEDA--->
  <?php 

if(isset($_Get['action'])){
   if(!empty($_SESSION['cart'])){
   foreach($_POST['quantity'] as $key => $val){
     if($val==0){
       unset($_SESSION['cart'][$key]);
     }else{
       $_SESSION['cart'][$key]['quantity']=$val;
     }
   }
   }
 }
?>
 
 
 
 
 <!--FIN-->







  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">Omega<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Inicio</a></li>

          
              <li class="dropdown"><a href="#"><span>Categorias</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                <?php $sql=mysqli_query($con,"select id,categoryName  from categoria");
while($row=mysqli_fetch_array($sql))
{
    ?>
                  <li><a href="categoria.php?cid=<?php echo $row['id'];?>"> <?php echo $row['categoryName'];?></a></li>
                  <?php } ?>
                  <!---
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
-->
                </ul>
              </li>


          <li><a class="nav-link scrollto" href="servicios.php">Servicios</a></li>
          <li><a class="nav-link scrollto " href="sobre_nosotros.php">Sobre Nosotros</a></li>

         
          </li>
          <li><a class="nav-link scrollto" href="contactos.php">Contacto</a></li>

          <li><form name="search" method="post" action="resultado_busqueda.php">
      
       


      
  
         
            <!---<label for="exampleFormControlInput1" class="form-label">Email address</label>-->
            <input  id="buscar"type="text" name="product"class="form-control" id="exampleFormControlInput1" placeholder="Buscar">
          
          




      
        </form>
  </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>


<style>
  #buscar{

    font-size: 15px !important;
  }
</style>





        
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  



  <!-- Modal BUSCADOR -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form name="search" method="post" action="search-result.php">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Iniciar Busqueda</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      


      
        <div class="mb-6 form-control">
         
            <!---<label for="exampleFormControlInput1" class="form-label">Email address</label>-->
            <input type="text" name="product"class="form-control" id="exampleFormControlInput1" placeholder="Buscar">
          
          </div>




        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="search" class="btn btn-primary">Buscar</button>
        </div>
        </form>
      </div>
    </div>
  </div>



  <!--FIN-->


  <main id="main">

   
    

  </main><!-- End #main -->



  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assetss/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assetss/vendor/aos/aos.js"></script>
  <script src="assetss/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assetss/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assetss/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assetss/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assetss/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assetss/vendor/php-email-form/validate.js"></script>

  <!-- Template Main sJS File -->
  <script src="assetss/js/main.js"></script>


<!---MODAL--->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>