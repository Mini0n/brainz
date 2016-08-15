<?php
	session_start();
	// ini_set('display_errors', 'On'); //show errors
	// error_reporting(E_ALL | E_STRICT); //report level: show notices E_ALL |
?>

<!DOCTYPE html>
<html>
<head>
	<title>DNA Wi-Fi Landing Page</title>
	<meta charset="UTF-8">
	<link rel="icon" href="img/favicon.png" type="image/gif" sizes="16x16">
	<!--favicon-->
	<link rel="stylesheet" type="text/css" href="estilos.css"><!--estilos de sitio-->
	<!--<link rel="stylesheet" type="text/css" href="media.css">--><!--estilos media-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--tipografía-->
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
</head>
<body>

<!-- ===========================================================================
mac handling code
============================================================================ -->

<?php

	include ($_SERVER['DOCUMENT_ROOT'] . '/landing/radius_vars.php');

	save_radius_vars_to_session();
	// print_radius_vars();

?>

<?php

	function checkmac($mac){

	}
	// $challenge	=	$_GET['challenge'];
	// $userurl		=	$_GET['userurl'];
	// $origen			= $_GET['called'];
	// $res				=	$_GET['res'];
	// $mac				=	$_GET['mac'];

	//include 'RADIUSVars.php';

	//saveRADIUSVarsToSESSION();
	//printRADIUSVars();


	if ($res=='success') {
		header("Location: $userurl");
		print("\n</html>");
	}

	if ($res=='failed') {
		header("Location: failed.php");
		print("\n</html>");
	}

//hacer usuario con mac address del client

?>
<!-- ===========================================================================
mac handling code
============================================================================ -->

<div id="wrapper">
	<div id="header">
		<?php include 'establecimiento.php'; ?>
	</div><!--header-->
	<div id="divisor">
		<img src="img/banderin.png" class="banderin">
	</div><!--divisor-->
	<div id="conexiones">
		<ul>
			<li class="centro"><!--redes sociales-->
				<h1>Inicia sesión con una red social</h1>
				<div class="centrar">
					<div class="facebook">
						<?php include 'facebook/login_facebook.php'; ?>
					</div><!--facebook-->
					<div class="twitter">
						<?php include 'twitter/index.php'; ?>
					</div><!--twitter-->
					<div class="google">
						<?php include 'google/index.php'; ?>
					</div><!--google-->
				</div><!--centrar-->
			</li>
			<li class="izq"><!--formulario-->
				<h1>Contesta el formulario</h1>
				<?php include 'formulario.php'; ?>
			</li>
		</ul>
	</div><!--conexiones-->
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
