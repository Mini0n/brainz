<?php 
if(!session_id()) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php';

//configuración de la aplicación
$fb = new Facebook\Facebook([
  'app_id' => '133364597074539',
  'app_secret' => '2aa730016db2be4435ceaee548f0d3ca',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'public_profile']; // optional
//,'user_birthday'

$loginUrl = $helper->getLoginUrl('http://prueba1.brainssolvers.com/facebook/login-callback.php', $permissions);

echo '<a class="boton_login" href="' . $loginUrl . '"><img src="../img/facebook.png"></a>';


//hacer request a facebook

// Send a GET request
//$response = $fb->get('/me');

//$user = $response->getGraphUser();

//echo 'Name: ' . $user['name'];

?>
