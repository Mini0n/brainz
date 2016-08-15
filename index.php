<html>
	<?php

		function checkmac($mac){

		}
		$challenge=$_GET['challenge'];
		$res=$_GET['res'];
		$userurl=$_GET['userurl'];
		$origen = $_GET['called'];
		$mac=$_GET['mac'];

		//print('ola k ase?');
		//print($mac);
		//print($origen);

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
	<h3>Bienvenido</h3>
	<img src="soldier.jpg" alt="tu mama"/>
	<form action="login.php" method="POST">
		<input type="hidden" name="challenge" value="<?php echo($challenge)?>"/>
		<input type="hidden" name="mac"       value="<?php echo($mac)?>"/>
		<input type="hidden" name="userurl"   value="<?php echo($userurl)?>"/>
		<p>Nombre: <input type="text" name="nombre"/></p>
		<p>Apellido: <input type="text" name="apellido"/></p>
		<p>Correo: <input type="text" name="correo"/></p>
		<p>Cumple: <input type="text" name="cumple"/></p>
		<p>Genero: <input type="text" name="genero"/></p>
		<p><input type="submit" value="Login" /></p>
	</form>
</html>
