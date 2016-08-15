<?php
session_start();
/*
 * @author Puneet Mehta
 * @website: http://www.PHPHive.info
 * @facebook: https://www.facebook.com/pages/PHPHive/1548210492057258
 */
require_once 'config.php'; //conexion con BD
//if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
  // user already logged in the site
  //header("location:".SITE_URL . "home.php");
//}

// $challenge	=	$_GET['challenge'];
// $userurl		=	$_GET['userurl'];
// $origen			= $_GET['called'];
// $res				=	$_GET['res'];
// $mac				=	$_GET['mac'];
//
// $twitterURL = 'twitter/twitter_login.php';
// $twitterURL .= '?challenge='.urlencode($challenge);
// $twitterURL .= '&userurl='.urlencode($userurl);
// $twitterURL .= '&called='.urlencode($origen);
// $twitterURL .= '&res='.urlencode($res);
// $twitterURL .= '&mac='.urlencode($mac);

?>

<!--
<a class="btn btn-block btn-social btn-twitter" href="<?php echo($twitterURL)?>">
-->

<a class="btn btn-block btn-social btn-twitter" href="twitter/twitter_login.php">
  <img src="../landing/img/twitter.png">
</a>
