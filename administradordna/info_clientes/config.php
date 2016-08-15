<?php
   define('DB_SERVER', '74.208.234.185');
   define('DB_USERNAME', 'ftpuser');
   define('DB_PASSWORD', 'radpass');
   define('DB_DATABASE', 'radius');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>