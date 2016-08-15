<?php 
	session_start();
	//autenticación de paginas
	include ('session.php');
	//expiración de sesión
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago(min*60)
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
<!DOCTYPE html>
<html>
<head>
	<title>DNA Home</title>
	<meta charset="UTF-8">
	<link rel="icon" href="img/favicon.png" type="image/gif" sizes="16x16">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="estilos_admin.css"><!--estilos-->
	<?php
		date_default_timezone_set('America/Mexico_City');
	 ?>
</head>
<body>

	<div id="menu">
		<div id="herramienta">
			<img src="img/herramienta.png" alt="logo_herramienta">
		</div><!--herramienta-->
		<ul>
			<a href="home.php"><li>HOME</li></a>
			<a href="dash/dashboard.php" ><li>DASHBOARD</li></a>
			<a href="info_clientes/clienesbd.php" ><li>INFORMACIÓN DE CLIENTES</li></a>
			<a href = "logout.php"><li>LOGOUT</li></a>
		</ul>
	</div><!--menu-->

	<div id="header">
		<h4 class="negro">BIENVENIDO</h4>
		<div id="establecimiento">
			<img src="logo.png" class="establecimiento">
		</div><!--establecimiento-->
		<div id="fechahora">
			<p><?php echo $_SESSION['login_user']; ?></p>
			<p><?php echo date("d/m/y"); ?></p><!--fecha-->
			<p>|</p>
			<p><?php echo date("h:i:sa"); ?></p><!--hora-->
		</div><!--fechahora-->
	</div><!--header-->
	<div id="wrapper">
		<div id="divisor">
			<h5>VISTAZO GENERAL</h5>
		</div><!--divisor-->

		<ul id="graficas">
			<li>
				<div class="imagen">
					<img src="img/usuariohome.png">
				</div>
				<div class="info">
					<p class="unalinea">Número de clientes registrados</p>
					<div class="dato">1,000</div>
				</div>
			</li>
			<li>
				<div class="imagen">
					<img src="img/usuariohome.png">
				</div>

				<div class="info">
					<p class="unalinea">Promedio de clientes por día</p>
					<div class="dato"></div>
				<div class="info">
			</li>
			<li>
				<div class="imagen">
					<img src="img/usuariohome.png">
				</div>
				<div class="info">
					<p class="unalinea">Promedio de clientes mensuales</p>
					<!--BD-->
				</div>
			</li>
			<li> 
				<div class="imagen">
					<img src="img/mujer.png" class="dos">
					<img src="img/hombre.png" class="dos">
				</div>
				<div class="info">
					<p class="doslineas">Género de clientes</p>
					<div class="datodos">
						<h3>58</h3>
						<h5>mujeres</h5>
					</div>
					<div class="datodos">
						<h3>23</h3>
						<h5>hombres</h5>
					</div>
				</div>
			</li>
			<li>
				<div class="imagen">
					<img src="img/age.png">
				</div>
				<div class="info">
					<p class="unalinea">Rango de edad más popular</p>
					<div class="dato"></div>
				</div>
			</li>
			<li>
				<div class="imagen">
					<img src="img/nuevo.png" class="dos">
					<img src="img/leal.png" class="dos">
				</div>
				<div class="info">
					<p class="doslineas">Lealtad de clientes</p>
					<div class="datodos">
						<h3>10</h3>
						<h5>clientes nuevos</h5>
					</div>
					<div class="datodos">
						<h3>9</h3>
						<h5>clientes recurrentes</h5>
					</div>
				</div>
			</li>
			<li>
				<div class="imagen">
					<img src="img/conexion.png">
				</div>
				<div class="info">
					<p class="unalinea">Conexiones totales</p>
					<div class="dato"></div>
				</div>
			</li>
			<li>
				<div class="imagen">
					<img src="img/conexion.png">
				</div>
				<div class="info">
					<p class="unalinea">Promedio de tiempo de conexión</p>
					<div class="dato"></div>
				</div>
			</li>
			<li>
				<div class="imagen">
					<img src="img/conexion.png">
				</div>
				<div class="info">
					<p class="unalinea">Falta</p>
					<div class="dato"></div>
				</div>
			</li>
		</ul>




		<div id="footer">
			<div id="creado">
				<img src="img/herramienta.png" class="herramienta">
				<h2>Powered by</h2>
					<a href="http://www.brains.mx">
						<img src="img/brains.png" class="brains">
					</a>
					<a href="http://www.grupolirun.com.mx">
						<img src="img/lirun.png" class="lirun">
					</a>
			</div><!--creado-->
		</div><!--footer-->
	</div><!--wrapper-->

</body>
</html>