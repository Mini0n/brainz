<?php

/*
 * @author Puneet Mehta
 * @website: http://www.PHPHive.info
 * @facebook: https://www.facebook.com/pages/PHPHive/1548210492057258
 */

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();

define('PROJECT_NAME', 'Twitter login DNA');

define('DB_DRIVER', 'mysql');
define('DB_SERVER', '74.208.234.185');
define('DB_SERVER_USERNAME', 'radius');
define('DB_SERVER_PASSWORD', 'radpass');
define('DB_DATABASE', 'radius');


$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}


define("CLIENT_ID", "7WptFjuzVy284oFHGbpBj8Ng4");
define("SECRET_KEY", "20jHGUvVURbN4GSxtFh1m2xJkEgMM6IHwwtwcJwGqR6dSCbeD5");
/* make sure the url end with a trailing slash, give your site URL */
//define("SITE_URL", "http://www.dnawifi.mx/");
define("SITE_URL", "http://www.dnawifi.mx/");
/* the page where you will be redirected for authorization */
//define("REDIRECT_URL", SITE_URL."twitter/twitter_login.php"); //callback
define("REDIRECT_URL", SITE_URL."landing/twitter/twitter_login.php"); //callback

//define("LOGOUT_URL", SITE_URL."twitter/logout.php");
define("LOGOUT_URL", SITE_URL."landing/twitter/logout.php");
?>
