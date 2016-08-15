<?php
$servername = "localhost";
$username = "radius";
$password = "radpass";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

function hombresymujeres($conn){
	$querym = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male';"));
	$queryf = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female';"));
	$nmale = $querym->num_rows;
	$nfemale = $queryf->num_rows;
	$total = $nmale+$nfemale;
	$response = array($nmale, $nfemale, $total);
	return $response;		
}

function poredades_m($conn){
	$query_maj60_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>60;"));	
	$query_50_60_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=50 && edad<=60;"));
	$query_43_49_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=43 && edad<=49;"));
	$query_38_42_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=38 && edad<=42;"));
	$query_33_37_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=33 && edad<=37;"));
	$query_27_32_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=27 && edad<=32;"));
	$query_23_26_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=23 && edad<=26;"));
	$query_18_22_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=18 && edad<=22;"));
	$query_13_17_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=13 && edad<=17;"));
	$query_min13_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad<13;"));
	
	$resultado_m = array ($query_maj60_m->num_rows,$query_50_60_m->num_rows,$query_43_49_m->num_rows,$query_38_42_m->num_rows,$query_33_37_m->num_rows,$query_27_32_m->num_rows,$query_23_26_m->num_rows,$query_18_22_m->num_rows,$query_13_17_m->num_rows,$query_min13_m->num_rows,);

	return $resultado_m;

}

function poredades_f($conn){
	$query_maj60_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>60;"));
        $query_50_60_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=50 && edad<=60;"));
        $query_43_49_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=43 && edad<=49;"));
        $query_38_42_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=38 && edad<=42;"));
        $query_33_37_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=33 && edad<=37;"));
        $query_27_32_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=27 && edad<=32;"));
        $query_23_26_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=23 && edad<=26;"));
        $query_18_22_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=18 && edad<=22;"));
        $query_13_17_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=13 && edad<=17;"));
        $query_min13_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad<13;"));

	$resultado_f = array ($query_maj60_f->num_rows,$query_50_60_f->num_rows,$query_43_49_f->num_rows,$query_38_42_f->num_rows,$query_33_37_f->num_rows,$query_27_32_f->num_rows,$query_23_26_f->num_rows,$query_18_22_f->num_rows,$query_13_17_f->num_rows,$query_min13_f->num_rows,);

	return $resultado_f;
}

//$resultado = ($conn->query("SELECT * FROM radius.usuarios WHERE metodo_autent='formulario' && genero='male';"));

//while ($fila = $resultado->fetch_row()) {
//       printf ("%s (%s)\n", $fila[0], $fila[1]);
//   }

$resultado_m = poredades_m($conn);
$resultado_f = poredades_f($conn);

foreach ($resultado_m as $valor){
	echo $valor;
	echo ("\n");
}

foreach ($resultado_f as $valor){
        echo $valor;
        echo ("\n");
}

//echo ($resultado[0].' '. $resultado[1].' '. $resultado[2]);
//echo ("\n");
?>
