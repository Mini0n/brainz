<!--CONEXION CON BASE DE DATOS-->
<?php
session_start();
//definicion de variables
$date = date('Y-m-d H:i:s'); //hora de envío de información a BD
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$birthDate = $_POST['cumple'];
$genero = $_POST['genero'];
$email = $_POST['email'];
$agree = $_POST['agree'];
//Radius vars
// $mac = $_POST['macDir'];
// $challenge = $_POST['challenge'];
// $userurl = $_POST['userurl'];
// $origen = $_POST['origen'];


//radius functions
include ($_SERVER['DOCUMENT_ROOT'] . '/landing/radius_vars.php');
//radius vars passing through session
$challenge = $_SESSION['challenge'];
$userurl   = $_SESSION['userurl'];
$origen    = $_SESSION['origen'];
$res       = $_SESSION['res'];
$mac       = $_SESSION['mac'];
$device    = getUserAgent();

//$codigop = mysqli_real_escape_string($link, $_POST['codigop']);

//funcion para calculo de edad
$birthDate = explode("-", $birthDate);
  //get age from date or birthdate, no diferencia por mes y día; solo por año
  //$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
    //? ((date("Y") - $birthDate[0])-1)
    //: (date("Y") - $birthDate[0]));
//  echo "Age is:" . $age;

//funcion que calcula edad, tomando en cuenta dia,mes y año
//$dob=explode("-",$dob);
    $curMonth = date("m");
    $curDay = date("j");
    $curYear = date("Y");
    $age = $curYear - $birthDate[0]; //año-año
    if($curMonth<$birthDate[1] || ($curMonth==$birthDate[1] && $curDay<$birthDate[2]))
        $age--;
        //return $age;

//variables cumpleaños
$c_dia = $birthDate[2];
$c_mes = $birthDate[1];
$c_year = $birthDate[0];

//funcion para concatenar nombre completo
$nombre_completo = $nombre . ' ' . $apellido;

//crear conexion con BD
$host_name  = "74.208.234.185";
$database   = "radius";
$user_name  = "radius";
$password   = "radpass";

$connect = mysqli_connect($host_name, $user_name, $password, $database);

//insertar informacion en BD
$sql = "INSERT INTO usuarios (recepcion, metodo_autent, nombre_completo , nombre, apellido, email, genero, c_dia, c_mes, c_year, edad, terminos_check, mac, origen, dispositivo) VALUES ('$date','formulario', '$nombre_completo' ,'$nombre','$apellido' ,'$email', '$genero', '$c_dia', '$c_mes', '$c_year', '$age', '$agree', '$mac', '$origen', '$device')";

	if ($connect->query($sql) === TRUE) {
		echo "New record created successfully"; //mensaje

	} else {
	    echo "Error: " . $sql . "<br>" . $connect->error;
	}

$connect->close();


//Redirection to login.php (radcheck user creation and radius login)

$url_vars = 'mac='.urlencode($mac).'&challenge='.urlencode($challenge).'&userurl='.urlencode($userurl);

create_radcheck();
//header("Location:http://74.208.234.185/login.php?mac=".$url_vars);
validate_radius();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Callback</title>
	<meta charset="UTF-8">
	<link rel="icon" href="img/favicon.png" type="image/gif" sizes="16x16">
	<!--favicon-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--tipografía-->
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" type="text/css" href="estilos_like.css">-->
	<!--<link rel="stylesheet" type="text/css" href="estilos_footer.css">-->
</head>

<body>
<!--redireccionamiento a sitio de establecimiento-->
<script type="text/javascript">
  //window.location="http://74.208.234.185/login.php"; //create new user in radcheck table and login into radius
</script>

</body>



<!--
<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.6&appId=133364597074539";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>-->

	<!--<div id="wrapper">
		<div id="header">
			<div id="tit">
				<h1>Síguenos en nuestras redes sociales</h1>
			</div>
			<div id="img">
				<img src="restaurante/logo.png">
			</div>
		</div>--><!--header-->
		<!--<div id="sigue">
			<ul>
			<li id="like_face">
				<div id="cont_face" class="red">
					<img src="img/like.png">
				</div>
				<div id="face_bt" class="fb-like" data-href="https://facebook.com/brainssolvers" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
			</li>
			<li id="sigue_tw">
				<div id="tw" class="red">
					<img src="img/twitter.png">
				</div>
				<div id="tw_bt">
					<a href="https://twitter.com/BrainsSolvers" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @BrainsSolvers</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>
			</li>
			<li id="follow_insta">
				<div id="inst" class="red">
					<img src="img/instagram.png">
				</div>
				<div id="inst_bt">
					<a href="https://www.instagram.com/annaba09/?ref=badge" class="ig-b- ig-b-v-24"><img src="img/inst_follow.png" alt="Instagram" /></a>
				</div>
			</li>
			</ul>
		</div>--><!--sigue-->
		<!--<div id="footer">
			<div id="creado">
				<img src="img/herramienta.png" class="herramienta">
				<h2>Powered by</h2>
					<a href="http://www.brains.mx">
						<img src="img/brains.png" class="brains">
					</a>
					<a href="http://www.grupolirun.com.mx">
						<img src="img/lirun.png" class="lirun">
					</a>
			</div>--><!--creado-->
		<!--</div>--><!--footer-->
<!--	</div>--><!--wrapper-->


</html>
