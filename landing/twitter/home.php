<?php
session_start();
/*
 * @author Puneet Mehta
 * @website: http://www.PHPHive.info
 * @facebook: https://www.facebook.com/pages/PHPHive/1548210492057258
 */


require_once 'config.php';
if (!isset($_SESSION["user_id"]) && $_SESSION["user_id"] == "") {
  // user already logged in the site
  //redireccion a formulario de Twitter para completar datos
  header("location: http://www.dnawifi.mx/landing/twitter/formulario_tw.php "); //. SITE_URL);
}
//include 'header.php';
?>
<!--creacion de formulario adicional-->
