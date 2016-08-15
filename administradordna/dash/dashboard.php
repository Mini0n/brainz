<?php 
	session_start();
	//autenticación de paginas
	include ('../session.php');
	//expiración de sesión
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 30 minutes ago(min*60)
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="UTF-8">
	<!--favicon-->
	<link rel="icon" href="../img/favicon.png" type="image/gif" sizes="16x16">
	<!--estilos-->
	<link rel="stylesheet" type="text/css" href="estilos_dash.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--font menu-->
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<!--font tabla-->
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600' rel='stylesheet' type='text/css'>

</head>
<body>
<!--<?php //include ('session.php'); //sesion de usuario ?> -->
	<div id="menu">
		<div id="herramienta">
			<img src="../img/herramienta.png" alt="logo_herramienta">
		</div><!--herramienta-->
		<ul>
			<a href="../home.php"><li>HOME</li></a>
			<a href="../dash/dashboard.php" ><li>DASHBOARD</li></a>
			<a href="../info_clientes/clienesbd.php" ><li>INFORMACIÓN DE CLIENTES</li></a>
			<a href = "logout.php"><li>LOGOUT</li></a>
		</ul>
	</div><!--menu-->

	<div id="header">
		<h4>DASHBOARD</h4>
		<!--<div id="fechahora">
			<p><?php //echo $_SESSION['login_user']; ?></p>
		</div>--><!--fechayhora-->
	</div><!--header-->
	<div id="wrapper">
		<div id="establecimiento">
			<img src="../logo.png" class="establecimiento"><!--logo 
			restaurante-->
		</div><!--establecimiento-->

		<!--MENU SECCIONES FIXED-->
		<div id="graf_botones">
			<a href="#ahora" class="larga"><p>Este momento</p></a>
			<a href="#edad" class="larga"><p>Edad y género</p></a>
			<a href="#lealtad" class="normal"><p>Lealtad</p></a>
			<a href="#visitas" class="normal"><p>Visitas</p></a>
			<a href="#acceso" class="normal"><p>Acceso</p></a>
		</div><!--graf_botones-->

		<div class="evil" id="ahora"></div>
		<div class="titulo">
			<h3>ESTE MOMENTO</h3>
		</div><!--tit-->
		<div id="cont_graf1" class="graf"></div><!--cont_graf-->

		<div class="evil" id="edad"></div>
		<div class="titulo" >
			<h3>EDAD Y GÉNERO DE CLIENTES</h3>
		</div><!--tit-->
		<div id="cont_graf2" class="graf"></div><!--cont_graf-->

		<div class="evil" id="lealtad"></div>
		<div class="titulo">
			<h3>LEALTAD</h3>
		</div><!--tit-->
		<div id="cont_graf3" class="graf"></div><!--cont_graf-->

		<div class="evil" id="visitas"></div>
		<div class="titulo">
			<h3>VISITAS</h3>
		</div><!--tit-->
		<div id="cont_graf4" class="graf"></div><!--cont_graf-->

		<div class="evil" id="acceso"></div>
		<div class="titulo">
			<h3>ACCESO</h3>
		</div><!--tit-->
		<div id="cont_graf5" class="graf"></div><!--cont_graf-->

	</div><!--wrapper-->
	
	<div id="footer">
		<div id="creado">
			<img src="../img/herramienta.png" class="herramienta">
			<h2>Powered by</h2>
				<a href="http://www.brains.mx">
					<img src="../img/brains.png" class="brains">
				</a>
				<a href="http://www.grupolirun.com.mx">
					<img src="../img/lirun.png" class="lirun">
				</a>
		</div><!--creado-->
	</div><!--footer-->

</body>
</html>