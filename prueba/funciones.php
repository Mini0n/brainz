<?php

function connect_db ($servername, $username, $password){
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;	 
}

function hombresymujeres($conn,$span){ //agregar cliente
	$fecha_inicio = $span[0];
	$fecha_fin = $span[1];
	
	$querym = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$queryf = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	
	$nmale = $querym->num_rows;
	$nfemale = $queryf->num_rows;
	$total = $nmale+$nfemale;
	$response = array($nmale, $nfemale, $total);
	return $response;		
}

function poredades_m($conn,$span){ //agregar cliente
	$fecha_inicio = $span[0];
	$fecha_fin = $span[1];
	
	$query_maj60_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>60 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));	
	$query_50_60_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=50 && edad<=60 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_43_49_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=43 && edad<=49 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_38_42_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=38 && edad<=42 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_33_37_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=33 && edad<=37 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_27_32_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=27 && edad<=32 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_23_26_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=23 && edad<=26 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_18_22_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=18 && edad<=22 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_13_17_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad>=13 && edad<=17 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	$query_min13_m = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='male' && edad<13 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
	
	$resultado_m = array ($query_maj60_m->num_rows,$query_50_60_m->num_rows,$query_43_49_m->num_rows,$query_38_42_m->num_rows,$query_33_37_m->num_rows,$query_27_32_m->num_rows,$query_23_26_m->num_rows,$query_18_22_m->num_rows,$query_13_17_m->num_rows,$query_min13_m->num_rows,);
	return $resultado_m;
}

function poredades_f($conn,$span){ //agregar cliente
	$fecha_inicio = $span[0];
	$fecha_fin = $span[1];

	$query_maj60_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>60 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_50_60_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=50 && edad<=60 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_43_49_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=43 && edad<=49 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_38_42_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=38 && edad<=42 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_33_37_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=33 && edad<=37 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_27_32_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=27 && edad<=32 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_23_26_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=23 && edad<=26 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_18_22_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=18 && edad<=22 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_13_17_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad>=13 && edad<=17 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));
        $query_min13_f = ($conn->query("SELECT * FROM radius.usuarios WHERE genero='female' && edad<13 && date BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."';"));

	$resultado_f = array ($query_maj60_f->num_rows,$query_50_60_f->num_rows,$query_43_49_f->num_rows,$query_38_42_f->num_rows,$query_33_37_f->num_rows,$query_27_32_f->num_rows,$query_23_26_f->num_rows,$query_18_22_f->num_rows,$query_13_17_f->num_rows,$query_min13_f->num_rows,);
	return $resultado_f;
}

function recurrentes($conn,$span){ //agregar span y cliente
	$query = "SELECT username FROM radius.radcheck;";
	$result = mysqli_query($conn, $query);
	$store_array = Array ();
	$contador_r = 0;
	$contador_n = 0;
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
		$store_array[]=$row[0];
	}
	foreach ($store_array as $user){
		$query_r = ($conn->query("SELECT * FROM radius.radpostauth WHERE username='".$user."';"));
		if ($query_r->num_rows > 1){
			$contador_r++;
		} elseif ($query_r->num_rows == 1){
			$contador_n++;
		}
	}
	$resultado = array ($contador_r, $contador_n);
	return $resultado;
}

function visitas_cliente ($conn, $span){ //agregar span y cliente
	$query = "SELECT username FROM radius.radcheck;";
        $result = mysqli_query($conn, $query);
        $store_array = Array ();
        $contador_1 = 0;
        $contador_2 = 0;
	$contador_3 = 0;
	$contador_4 = 0;
	$contador_5 = 0;
	$contador_6 = 0;
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                $store_array[]=$row[0];
        }
	foreach ($store_array as $user){
                $query_r = ($conn->query("SELECT * FROM radius.radpostauth WHERE username='".$user."';"));
		switch ($query_r->num_rows){
			case 0:
				break;
			case 1:
				$contador_1++;
				break;
			case 2:
				$contador_2++;
				break;
			case 3:
				$contador_3++;
				break;
			case 4:
				$contador_4++;
				break;
			case 5:
				$contador_5++;
				break;
			default:
				$contador_6++;
				break;
		}
        }
	$resultado = array ($contador_1, $contador_2, $contador_3, $contador_4, $contador_5, $contador_6);
	return $resultado;

}

function rangodefechas ($range){
	switch ($range){
		case 0: //caso treinta dias
			$fecha_fin = date("Y-m-d H:i:s");
			$fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m")-1,date("d"),date("Y")));
			$span = array ($fecha_inicio, $fecha_fin);
			return $span;
			break;
		case 1: //caso sesenta dias
			$fecha_fin = date("Y-m-d H:i:s");
                        $fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m")-2,date("d"),date("Y")));
			$span = array ($fecha_inicio, $fecha_fin);
                        return $span;
			break;
		case 2: //caso noventa dias
			$fecha_fin = date("Y-m-d H:i:s");
			$fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m")-3,date("d"),date("Y")));
			$span = array ($fecha_inicio, $fecha_fin);
			return $span;
                        break;
		case 3: //caso seis meses
			$fecha_fin = date("Y-m-d H:i:s");
			$fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m")-6,date("d"),date("Y")));
			$span = array ($fecha_inicio, $fecha_fin);
			return $span;
		case 4: //caso doce meses
                        $fecha_fin = date("Y-m-d H:i:s");
                        $fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")-1));
                        $span = array ($fecha_inicio, $fecha_fin);
                        return $span;
		case 5: //desde el inicio
			$fecha_fin = date("Y-m-d H:i:s");
                        $fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),1900));
                        $span = array ($fecha_inicio, $fecha_fin);
                        return $span;
	}
}


$conn = connect_db ("localhost","radius","radpass");
$arreglo = recurrentes($conn);
print_r(array_values($arreglo));

//echo "treinta dias";
//echo "\t";
//echo rangodefechas(0)[0];
//echo "\t";
//echo rangodefechas(0)[1];
//echo "\n";

//echo "sesenta dias";
//echo "\t";
//echo rangodefechas(1)[0];
//echo "\t";
//echo rangodefechas(1)[1];
//echo "\n";

//echo "tres meses";
//echo "\t";
//echo rangodefechas(2)[0];
//echo "\t";
//echo rangodefechas(2)[1];
//echo "\n";

//echo "seis meses";
//echo "\t";
//echo rangodefechas(3)[0];
//echo "\t";
//echo rangodefechas(3)[1];
//echo "\n";

//echo "doce meses";
//echo "\t";
//echo rangodefechas(4)[0];
//echo "\t";
//echo rangodefechas(4)[1];
//echo "\n";

//echo "comienzo";
//echo "\t";
//echo rangodefechas(5)[0];
//echo "\t";
//echo rangodefechas(5)[1];
//echo "\n";
?>
