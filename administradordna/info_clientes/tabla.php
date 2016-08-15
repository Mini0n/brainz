<meta charset="UTF-8">
<!--estilos-->
<link rel="stylesheet" type="text/css" href="estilos_clientes.css">

<?php //visualización de BD

header("Content-Type: text/html;charset=utf-8"); //para acentos

			$servername = '74.208.234.185';
			$username = 'radius';
			$password = 'radpass';
			$dbname = 'radius'; //base de datos
			
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			$acentos = $conn->query("SET NAMES 'utf8'"); //para acentos
			// Check connection
			if ($conn->connect_error) {
		    die("La conexión fallo: " . $conn->connect_error);
		} 
			//echo "Connected successfully";

		$sql = "SELECT * FROM usuarios";

		//$sql = "SELECT * FROM usuarios WHERE entrada>0 ORDER BY entrada ASC ";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {

			echo "<table>
					<thead>
						<tr class='header'>
							<th class='normal'>Id</th>
							<th class='normal'>Acceso</th>
							<th class='larga'>Inicio conexión</th>
							<th class='normal'>Foto Perfil</th>
							<th class='nombre'>Nombre</th>
							<th class='nombre'>Apellido</th>
							<th class='email'>Email</th>
							<th class='normal'>Género</th>
							<th class='normal'>Edad</th>
							<th class='normal'>Día</th>
							<th class='normal'>Mes</th>
							<th class='normal'>Año</th>
							<th class='normal'>Usuario twitter</th>
							<th class='mediana'>Seguidores twitter</th>
						</tr>
					</thead>";

		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    echo "<tr class='contenido'>";
		    echo "<td class='normal'>" . $row['id_tabla'] . "</td>";
		    echo "<td class='normal'>" . $row['metodo_autent'] . "</td>";
		    echo "<td class='larga'>" . $row['recepcion'] . "</td>";
		    echo "<td class='normal'><img src=" . $row['picture'] . "></td>";//imagen
		    echo "<td class='normal'>" . $row['nombre'] . "</td>";
		    echo "<td class='normal'>" . $row['apellido'] . "</td>";
		    echo "<td class='larga'>" . $row['email'] . "</td>";
		    echo "<td class='normal'>" . $row['genero'] . "</td>";
		    echo "<td class='normal'>" . $row['edad'] . "</td>";
		    echo "<td class='normal'>" . $row['c_dia'] . "</td>";
		    echo "<td class='normal'>" . $row['c_mes'] . "</td>";
		    echo "<td class='normal'>" . $row['c_year'] . "</td>";
		    echo "<td class='normal'>" . $row['usuario'] . "</td>";
		    echo "<td class='normal'>" . $row['seguidores'] . "</td>";
		    echo "</tr>";
		    }
		} else {
		    echo "<div class='no_resultados'>No existen resultados</div>";
		}
			echo "</table>";
		$conn->close();


		?>


