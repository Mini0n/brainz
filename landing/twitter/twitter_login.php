<?php

session_start(); //para almacenar información en sesion
/*
 * @author Puneet Mehta
 * @website: http://www.PHPHive.info
 * @facebook: https://www.facebook.com/pages/PHPHive/1548210492057258
 */

require('http.php');
require('oauth_client.php');
require('config.php');

//require('config.php');


$client = new oauth_client_class;
$client->debug = 1;
$client->debug_http = 1;
$client->redirect_uri = REDIRECT_URL;
//$client->redirect_uri = 'oob';

$client->client_id = CLIENT_ID;
$application_line = __LINE__;
$client->client_secret = SECRET_KEY;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
  die('Please go to Twitter Apps page https://dev.twitter.com/apps/new , ' .
          'create an application, and in the line ' . $application_line .
          ' set the client_id to Consumer key and client_secret with Consumer secret. ' .
          'The Callback URL must be ' . $client->redirect_uri . ' If you want to post to ' .
          'the user timeline, make sure the application you create has write permissions');

if (($success = $client->Initialize())) {
  if (($success = $client->Process())) {
    if (strlen($client->access_token)) {
      $success = $client->CallAPI(
              'https://api.twitter.com/1.1/account/verify_credentials.json', 'GET', array(), array('FailOnAccessError' => true), $user);
    }
  }
  $success = $client->Finalize($success);
}
//definicion de variables

date_default_timezone_set('America/Mexico_City'); //definion de zona horaria
$date = date('Y-m-d H:i:s'); //hora de envío de información

if ($client->exit)
  exit;
if ($success) {

//definicion y almacenado en sesion de variables
$_SESSION['seguidores'] = $user->followers_count;
$_SESSION['picture']    = $user->profile_image_url;
$_SESSION['usuario']    = $user->screen_name;
$_SESSION['nombre']     = $user->name;
$_SESSION['id']         = $user->id;





      // New user, Insert in database
      /*$sql = "INSERT INTO usuarios (recepcion, metodo_autent, nombre, id_autent, picture, usuario, seguidores) VALUES " . "('$date', 'twitter', :name, :id, :picture, :usuario, :seguidores)";*/
      /*
      //forma que funciona
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":name", $user->name);
      $stmt->bindValue(":id", $user->id);
      $stmt->bindValue(":picture", $user->profile_image_url);
      $stmt->bindValue(":usuario", $user->screen_name);
      $stmt->bindValue(":seguidores", $user->followers_count);
      $stmt->execute();
      $result = $stmt->rowCount();

      if ($result > 0) {
        $_SESSION["name"] = $user->name;
        $_SESSION["id"] = $user->id;
        $_SESSION["picture"] = $user->profile_image_url;
        $_SESSION["usuario"] = $user->screen_name;
        $_SESSION["seguidores"] = $user->followers_count;

        $_SESSION["new_user"] = "yes";
        $_SESSION["e_msg"] = "";
      }
  */

  }
header("location: http://www.dnawifi.mx/landing/twitter/home.php");
exit;
?>
