
<style>

	#header{

		background-color: #106eea !important;
	}
	#color{

		color: white !important;
	}
	#administrador{

color: white !important;

	}
	#administrador:hover{

color: black !important;

	}

	#mini-menu{
background-color: white !important;
		color: black !important;
	}
	
</style>
<div class="navbar navbar-fixed-top">
		<div id="header"class="navbar-inner">
			<div id="header"class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a  id="color"class="brand" href="">
			  		Omega Genius | Administrador
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
					<ul class="nav pull-right">
						<li><a id="administrador" href="#">
							Administrador
						</a></li>
						<li class="nav-user dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="images/alfonso.png" class="nav-avatar" />
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a id="mini-menu"href="cambiar_contrasena.php">Cambiar Contraseña</a></li>
								<li class="divider"></li>
								<li><a  id="mini-menu"href="cerrar_sesion.php">Cerrar Sesion</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
