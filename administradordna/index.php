<?php 
include("config.php");//BD
if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      //$_SESSION['loggedin_time'] = time(); 
      
      $sql = "SELECT id FROM admin WHERE user = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
		if($count == 1) { //si se autentico bien
         //session_register("myusername");
      	session_start(); //empiece sesión
         $_SESSION['login_user'] = $myusername; 
         header("location: home.php"); //sitio a donde envía despues de login exitoso
      	}else {
         echo "<div class='error'><p>El usuario o la contraseña son incorrectos</p></div>";  //mensaje de error
      		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>DNA Login</title>
	<meta charset="UTF-8">
	<!--favicon-->
	<link rel="icon" href="img/favicon.png" type="image/gif" sizes="16x16">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--font menu-->
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<!--ESTILOS-->
	<link rel="stylesheet" type="text/css" href="login.css">

</head>
<body>
	<div id="wrapper">
		<div id="foto_izq">
			<img src="logo.png"><!--LOGO ESTABLECIMIENTO-->
		</div><!--foto_izq-->
		<div id="log">
			<div id="sup">
				<img src="img/herramienta_completo.png">
			</div><!--sup-->
			<div id="inf">
				<form method="post" id="login" action="">
					<div id="usuario">
						<img src="img/usuario.png">
						<input type="text" name="username" id="username" placeholder="Usuario">
					</div>
					<hr>
					<div id="pass">
						<img src="img/pass.png">
						<input type="password" name="password" id="password" placeholder="Contraseña">
					</div>
					<input type="submit" class="boton" name="enviar" value="Entrar">
				</form>
			</div><!--inf-->
		</div><!--log-->
	</div><!--wrapper-->
	

</body>
</html>