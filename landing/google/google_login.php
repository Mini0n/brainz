<?php

session_start();

require('http.php');
require('oauth_client.php');
require('config.php');



//radius functions
include ($_SERVER['DOCUMENT_ROOT'] . '/landing/radius_vars.php');
//radius vars passing through session
$challenge = $_SESSION['challenge'];
$userurl   = $_SESSION['userurl'];
$origen    = $_SESSION['origen'];
$res       = $_SESSION['res'];
$mac       = $_SESSION['mac'];
$device    = getUserAgent();

$client = new oauth_client_class;

// set the offline access only if you need to call an API
// when the user is not present and the token may expire
$client->offline = FALSE;

$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = REDIRECT_URL;

$client->client_id = CLIENT_ID;
$application_line = __LINE__;
$client->client_secret = CLIENT_SECRET;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
  die('Please go to Google APIs console page ' .
          'http://code.google.com/apis/console in the API access tab, ' .
          'create a new client ID, and in the line ' . $application_line .
          ' set the client_id to Client ID and client_secret with Client Secret. ' .
          'The callback URL must be ' . $client->redirect_uri . ' but make sure ' .
          'the domain is valid and can be resolved by a public DNS.');

/* API permissions
 */
$client->scope = SCOPE;
if (($success = $client->Initialize())) {
  if (($success = $client->Process())) {
    if (strlen($client->authorization_error)) {
      $client->error = $client->authorization_error;
      $success = false;
    } elseif (strlen($client->access_token)) {
      $success = $client->CallAPI(
              'https://www.googleapis.com/oauth2/v1/userinfo', 'GET', array(), array('FailOnAccessError' => true), $user);
    }
  }
  $success = $client->Finalize($success);
}

//definicion de variables
date_default_timezone_set('America/Mexico_City'); //definion de zona horaria
$date = date('Y-m-d H:i:s'); //hora de envío de información


    /*
      //funcion para calculo de edad
      $birthDate = explode("-", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
          ? ((date("Y") - $birthDate[0]))
          : (date("Y") - $birthDate[0]));
      //  echo "Age is:" . $age;

      //variables cumpleaños
      $c_dia = $birthDate[0];
      $c_mes = $birthDate[1];
      $c_year = $birthDate[2];
      */

if ($client->exit)
  exit;
if ($success) {

  //$birthDate = $user->birthday;
      // New user, Insert in database
      $sql = "INSERT INTO usuarios (recepcion, metodo_autent, nombre_completo, nombre, apellido, email, genero, picture, link, mac, origen, dispositivo) VALUES " . "('$date', 'google', :namec, :name, :apellido, :email, :gender, :image, :url, :mac, :origen, :device)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":namec", $user->name); //nombre completo
      $stmt->bindValue(":name", $user->given_name); //nombre
      $stmt->bindValue(":apellido", $user->family_name); //apellido
      $stmt->bindValue(":email", $user->email);
      $stmt->bindValue(":gender", $user->gender);
      $stmt->bindValue(":image", $user->picture);
      $stmt->bindValue(":url", $user->url);
      $stmt->bindValue(":mac", $mac);
      $stmt->bindValue(":origen", $origen);
      $stmt->bindValue(":device", $device);

      //$stmt->bindValue(":birthday", $user->birthday); //cumpleaños

      $stmt->execute();
      $result = $stmt->rowCount();


      if ($result > 0) {
        $_SESSION["name"] = $user->name;
        $_SESSION["email"] = $user->email;
        $_SESSION["new_user"] = "yes";
        $_SESSION["e_msg"] = "";
      }

}
header("location:home.php");
exit;
?>
