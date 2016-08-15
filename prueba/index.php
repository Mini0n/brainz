<?php
$servername = "localhost";
$username = "radius";
$password = "radpass";
$basededatos = "radius";

echo $servername . ' - ' . $username . ' - ' . $password . ' - ' . $basededatos;

// Create connection
$conn = new mysqli($servername, $username, $password);

echo "\n connectado...";

echo $conn;

// Check connection
if ($conn->connect_error) {
 echo "oh, oh";   
 die("Connection failed: " . $conn->connect_error);
} else {
 echo "conectados a la DB";
}

echo ($conn);

?>
