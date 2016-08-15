<?php
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
echo "treinta dias";
echo "\t";
echo rangodefechas(0)[0];
echo "\t";
echo rangodefechas(0)[1];
echo "\n";

echo "sesenta dias";
echo "\t";
echo rangodefechas(1)[0];
echo "\t";
echo rangodefechas(1)[1];
echo "\n";

echo "tres meses";
echo "\t";
echo rangodefechas(2)[0];
echo "\t";
echo rangodefechas(2)[1];
echo "\n";

echo "seis meses";
echo "\t";
echo rangodefechas(3)[0];
echo "\t";
echo rangodefechas(3)[1];
echo "\n";

echo "doce meses";
echo "\t";
echo rangodefechas(4)[0];
echo "\t";
echo rangodefechas(4)[1];
echo "\n";

echo "comienzo";
echo "\t";
echo rangodefechas(5)[0];
echo "\t";
echo rangodefechas(5)[1];
echo "\n";
?>
