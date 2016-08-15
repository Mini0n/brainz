<?php
if(!session_id()) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php';

# login-callback.php
$fb = new Facebook\Facebook([
  'app_id' => '133364597074539',
  'app_secret' => '2aa730016db2be4435ceaee548f0d3ca',
  'default_graph_version' => 'v2.5',]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

//accesstoken

  if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  } else {
    // getting short-lived access token
    $_SESSION['facebook_access_token'] = (string) $accessToken;
      // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();
    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  }

// getting basic info about user
  try {
    //información de perfil
    $profile_request = $fb->get('/me?fields=id,name,first_name,last_name,age_range,email,gender,link,locale,location,timezone');
    //picture
    $requestPicture = $fb->get('/me/picture?redirect=false&height=300'); //getting user picture
    $picture = $requestPicture->getGraphUser();
    $profile = $profile_request->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    // Sitio de redirección
    header("Location: ./");
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

// printing $profile array on the screen which holds the basic info about user
  //print_r($profile);
  //echo $profile['name'];
  //echo $profile['birthday'];
  //echo $profile['gender'];

// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']

//definición de variables
  $date = date('Y-m-d H:i:s'); //hora de envío de información a BD
  $id = $profile['id'];
  $nombre_completo = $profile['name'];
  $nombre = $profile['first_name'];
  $apellido = $profile['last_name'];
  //$birhDate = $profile['birthday']; //special permission
  $email = $profile['email'];
  $genero = $profile['gender'];
  $rango = $profile['age_range'];
  //imagen de perfil
  $picture_perfil = $picture['url'];
  $link = $profile['link'];
  $locale = $profile['locale'];
  $location = $profile['location'];
  $timezone = $profile['timezone'];


//radius functions
include ($_SERVER['DOCUMENT_ROOT'] . '/landing/radius_vars.php');
//radius vars passing through session
$challenge = $_SESSION['challenge'];
$userurl   = $_SESSION['userurl'];
$origen    = $_SESSION['origen'];
$res       = $_SESSION['res'];
$mac       = $_SESSION['mac'];
$device    = getUserAgent();

//crear conexion con BD
$host_name  = "74.208.234.185";
$database   = "radius";
$user_name  = "radius";
$password   = "radpass";

$connect = mysqli_connect($host_name, $user_name, $password, $database);

//insertar informacion en BD
$sql = "INSERT INTO usuarios (recepcion, metodo_autent, id_autent, nombre_completo , nombre, apellido, email, genero, picture,link,zona_horaria,localidad, mac, origen, dispositivo ) VALUES ('$date','facebook', '$id', '$nombre_completo' ,'$nombre','$apellido' ,'$email', '$genero', '$picture_perfil', '$link','$timezone','$location', '$mac', '$origen', '$dispositivo')";

  if ($connect->query($sql) === TRUE) {
      //echo "New record created successfully"; //mensaje
      //BANDERA
  } else {
      echo "Error: " . $sql . "<br>" . $connect->error;
  }

$connect->close();

?>

<!DOCTYPE html>
<html>
<head>
  <title>DNA Wi-Fi Facebook</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../img/favicon.png" type="image/gif" sizes="16x16">
  <link rel="stylesheet" type="text/css" href="../estilos_like.css"><!--estilos de sitio-->
  <link rel="stylesheet" type="text/css" href="../estilos_footer.css">
</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.6&appId=133364597074539";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div id="wrapper">
        <div id="header">
            <div id="tit">
                <h1>¡Felicidades! ya tienes Wi-Fi gratis</h1>
                <h2>Síguenos en nuestras redes sociales</h2>
            </div>
            <div id="img">
                <img src="../restaurante/logo.png">
            </div>
        </div><!--header-->
        <div id="sigue">
            <ul>
              <li id="like_face_solo">
                <div id="cont_face" class="red_solo">
                  <img src="../img/like.png">
                </div>
                <div id="face_bt" class="fb-like" data-href="https://facebook.com/brainssolvers" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
              </li>
            </ul>
        </div><!--sigue-->
        <div id="nogracias" class="nogracias">
          <a href="http://www.ardente.com.mx">Siguiente</a>
        </div><!--nogracias-->
        <div id="footer">
          <div id="creado">
            <div id="herr">
              <img src="../img/herramienta.png" class="herramienta">
            </div><!--herr-->
            <div id="powered">
            <h2>Powered by</h2>
                <a href="http://www.brains.mx">
                  <img src="../img/brains.png" class="brains">
                </a>
                <a href="http://www.grupolirun.com.mx">
                  <img src="../img/lirun.png" class="lirun">
                </a>
              </div><!--powered-->
          </div><!--creado-->
        </div><!--footer-->
    </div><!--wrapper-->
</body>
</html>
