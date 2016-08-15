<?php

  $user_agent = getenv("HTTP_USER_AGENT");

  echo '<pre>';
  echo '--[Detecting User Agent]--------------';
  echo '<br>';
  echo $user_agent;
  echo '</pre>';

?>
