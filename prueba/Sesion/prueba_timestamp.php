<?php

$fecha_de_prueba = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
echo $fecha_de_prueba;
echo "\n";
$date = date_create_from_format("Y-m-d H:i:s", $fecha_de_prueba);
echo $date->gettimestamp();
echo "\n";

?>
