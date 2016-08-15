<?php

//testing mstring module
// $mbstringvar = mb_substr('ola k ase', 0, 3);
// echo '<br><br>' . $mbstringvar;

//radius vars passing through session
function save_radius_vars_to_session(){
  // if (isset($_SESSION[''])){ //just avoiding stupid warnings
    $_SESSION['challenge'] = ($_GET['challenge'] != '' ? $_GET['challenge'] : 'cha-vacio');
    $_SESSION['userurl']   = ($_GET['userurl']   != '' ? $_GET['userurl']   : 'url-vacio');
    $_SESSION['origen']    = ($_GET['called']    != '' ? $_GET['called']    : 'NAS-vacio');
    $_SESSION['res']       = ($_GET['res']       != '' ? $_GET['res']       : 'res-vacio');
    $_SESSION['mac']       = ($_GET['mac']       != '' ? $_GET['mac']       : 'MAC-vacio');
  // }
}

function print_radius_vars(){
  echo '<pre>';
  echo '-[radius vars]---------';
  echo '<br>'.$_SESSION['challenge'];
  echo '<br>'.$_SESSION['userurl'];
  echo '<br>'.$_SESSION['origen'];
  echo '<br>'.$_SESSION['res'];
  echo '<br>'.$_SESSION['mac'];
  echo '<br>-[radius vars]---------';
  echo '</pre>';
}

function check_radius_res(){
  if ($res=='success'){
    header("Location: $userurl");
  } else if ($res=='failed'){
    header("Location: failed.php");
  }
  // if ($res=='success') {
	// 	header("Location: $userurl");
	// 	print("\n</html>");
	// }
  //
	// if ($res=='failed') {
	// 	header("Location: failed.php");
	// 	print("\n</html>");
	// }
}

function validate_radius(){
  // save_radius_vars_to_session();

  $challenge =$_SESSION['challenge'];
  $userurl = $_SESSION['userurl'];
  $user = $_SESSION['mac'];
  //$pass = $_SESSION['mac'];
  // $pass = 'brainz';

  // $user = 'chillispot';
  $pass = 'chillispot';

  $router = '192.168.3.1';
  $port = '3990';

  $enc_pwd=return_new_pwd($pass,$challenge);

  //$dir          = '/json/logon';

  $dir    = '/logon';
  $target = "http://$router".':'.$port.$dir."?username=$user&password=$enc_pwd&userurl=$userurl";

  echo '<br><br>' . $target . '<br><br>';

  header("Location: $target");
}

function create_radcheck(){
  //crear conexion con BD
  $host = "74.208.234.185";
  $data = "radius";
  $user = "radius";
  $pass = "radpass";

  $mac = $_SESSION['mac'];
  $sec = 'chillispot';

  $connect = mysqli_connect($host, $user, $pass, $data);
  //Insert new user into redcheck. Needs validation first
  $sql2 = "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$mac', 'Cleartext-Password', ':=', '$sec')";
  if ($connect->query($sql2) === TRUE){
    echo 'radcheck created';
  } else {
    echo 'Error: ' . $sql2 . '<br>' . $connect->error;
  }
  $connect->close();
}


function redirect_radius(){
  //perhaps to be done: recheck ...html/index|login|failed .php
}

function getUserAgent(){
  $agent = ''.$_SERVER['HTTP_USER_AGENT'];
  $agent = ($agent == '' ? 'user agent vacio' : $agent);
  return $agent;
}


//de prueba
// $target     = "http://$server_ip".':'.$port.$dir."?username=$username&password=$enc_pwd&userurl=$redir";

//header("Location: $target");
//
function return_new_pwd($pwd,$challenge){
              $uamsecret = 'secretodeamor';    //Must be the same phrase coova chilli uses
              $hex_chal  = pack('H32', $challenge);
              $newchal    = pack('H*', md5($hex_chal.$uamsecret));    //Add it to with $uamsecret (shared between chilli an this script)
              $response   = md5("\0" . $pwd . $newchal);              //md5 the lot
              $newpwd     = pack('a32', $pwd);                //pack again
              $password   = implode ('', unpack('H32', ($newpwd ^ $newchal))); //unpack again
              return $password;
         }


//----- t e s t i n g - m e t h o d s ------------------------------------------

 // save_radius_vars_to_session();
 // print_radius_vars();
 // create_radcheck();

?>
