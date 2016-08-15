<?php


//radius vars passing through session
function saveRADIUSVarsToSESSION(){
  $_SESSION['challenge'] = ($_GET['challenge'] == '' ? 'vacio' : $_GET['challenge']);
  $_SESSION['userurl']   = ($_GET['userurl']   == '' ? 'vacio' : $_GET['userurl']);
  $_SESSION['origen']    = ($_GET['called']    == '' ? 'vacio' : $_GET['called']);
  $_SESSION['res']       = ($_GET['res']       == '' ? 'vacio' : $_GET['res']);
  $_SESSION['mac']       = ($_GET['mac']       == '' ? 'vacio' : $_GET['mac']);
}

function printRADIUSVars(){
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

?>
