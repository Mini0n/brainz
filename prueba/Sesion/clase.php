
<?php
class Sesion {
  //atributos
  public $cliente;
  public $timespan;

  private $conn;

  //////////////////////////////////CONSTRUCT/////////////////////////////////
  public function __construct($cliente, $timespan){
    $this->cliente = $cliente;
    $this->timespan = $timespan;
    $sql_svr = "localhost";
    $sql_usr = "radius";
    $sql_pass = "radpass";
    $this->conn = new mysqli ($sql_svr, $sql_usr, $sql_pass);
  }

  ////////////////////////FUNCIONES AUXILIARES////////////////////////////////
  public function generar_limites_temporales(){
    $timespan = $this->timespan;
    switch ($timespan){
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
        		break;
  		case 4: //caso doce meses
        		$fecha_fin = date("Y-m-d H:i:s");
        		$fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")-1));
        		$span = array ($fecha_inicio, $fecha_fin);
        		return $span;
        		break;
  		case 5: //desde el inicio
  			$fecha_fin = date("Y-m-d H:i:s");
        		$fecha_inicio = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),1900));
        		$span = array ($fecha_inicio, $fecha_fin);
        		return $span;
        		break;
  	}
  }

  public function usuarios_unicos(){
    $conn = $this->conn;
    $unique_users = Array ();
    $query_user = "SELECT DISTINCT callingstationid FROM radius.radacct_temporal;";
    $result_user = mysqli_query($conn,$query_user);
    while ($row = mysqli_fetch_array($result_user, MYSQLI_NUM)){
      $unique_users[]=$row[0];
    }
    return $unique_users;
  }

  public function dias($que_dia){
    //necesita el argumento que dia
    //el domingo es 0, el lunes 1 y asi. el sabado es 6
    $dias = Array();
    $fecha_inicio = self::generar_limites_temporales()[0];
    $fecha_de_prueba = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
    $indice = 0;

    $inicio_timestamp = date_create_from_format("Y-m-d H:i:s", $fecha_inicio)->getTimestamp();
    $prueba_timestamp = date_create_from_format("Y-m-d H:i:s", $fecha_de_prueba)->getTimestamp();

    while ($inicio_timestamp<$prueba_timestamp){
      $dia_de_semana = date ('w',$prueba_timestamp);
      if ($dia_de_semana == $que_dia){
        array_push($dias, $fecha_de_prueba);
      }
      $indice++;
      $fecha_de_prueba = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d")-$indice,date("Y")));
      $prueba_timestamp = date_create_from_format("Y-m-d H:i:s", $fecha_de_prueba)->getTimestamp();
    }
    return $dias;
  }
   
 
  ////////////////////GENERACION DE TABLAS TEMPORALES/////////////////////////
  public function generar_radacct(){
    $conn = $this->conn;
    $cliente = $this->cliente;
    //$timespan = $this->timespan;

    $fecha_inicio = self::generar_limites_temporales()[0];
    $fecha_fin = self::generar_limites_temporales()[1];

    $nas_ids = Array ();

    $query_nas = "SELECT nas FROM radius.clientes WHERE cliente = '".$cliente."';";
    $query_radacct = "CREATE TEMPORARY TABLE IF NOT EXISTS radius.radacct_temporal AS (SELECT * FROM radius.radacct WHERE acctstarttime BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' && (calledstationid = ";
    //generar string de query
    $result_nas = mysqli_query($conn, $query_nas);

    while ($row = mysqli_fetch_array($result_nas, MYSQLI_NUM)){
      $nas_ids[]=$row[0];
    }

    for ($i=0;$i<count($nas_ids);$i++){
      if ($i==0){
        $query_radacct=$query_radacct."'".$nas_ids[$i]."'";
      } else {
        $query_radacct=$query_radacct." || calledstationid = '".$nas_ids[$i]."'";
      }
    }

    $query_radacct=$query_radacct."));";
    echo $query_radacct;
    echo "\n";
    //string de query generado

    //crear tabla radacct temporal
    mysqli_query($conn, $query_radacct);
    echo "radacct";
    echo "\n";
  }

  public function generar_usuarios(){
    $conn = $this->conn;
    $cliente = $this->cliente;
    //$timespan = $this->timespan;

    //$fecha_inicio = self::generar_limites_temporales()[0];
    //$fecha_fin = self::generar_limites_temporales()[1];

    $nas_ids = Array ();

    $query_nas = "SELECT nas FROM radius.clientes WHERE cliente = '".$cliente."';";
    $query_usuarios = "CREATE TEMPORARY TABLE IF NOT EXISTS radius.usuarios_temporal AS (SELECT * FROM radius.usuarios WHERE origen = ";
    //generar string de query
    $result_nas = mysqli_query($conn, $query_nas);

    while ($row = mysqli_fetch_array($result_nas, MYSQLI_NUM)){
      $nas_ids[]=$row[0];
    }

    for ($i=0;$i<count($nas_ids);$i++){
      if ($i==0){
        $query_usuarios=$query_usuarios."'".$nas_ids[$i]."'";
      } else {
        $query_usuarios=$query_usuarios." || origen = '".$nas_ids[$i]."'";
      }
    }

    $query_usuarios=$query_usuarios.");";
    echo $query_usuarios;
    echo "\n";
    //string de query generado

    //crear tabla usuarios temporal
    mysqli_query($conn, $query_usuarios);
    echo "usuarios";
    echo "\n";
  }

  public function generar_usuarios_eneltiempo(){
    //self::generar_usuarios();
    //self::generar_radacct();
    $conn = $this->conn;
    $unique_users = self::usuarios_unicos();

    $query_usuarios_eet = "CREATE TEMPORARY TABLE IF NOT EXISTS radius.usuarios_eet_temporal AS (SELECT * FROM radius.usuarios_temporal WHERE mac = ";

    for ($i=0;$i<count($unique_users);$i++){
      if ($i==0){
        $query_usuarios_eet=$query_usuarios_eet."'".$unique_users[$i]."'";
      } else {
        $query_usuarios_eet=$query_usuarios_eet." || mac = '".$unique_users[$i]."'";
      }
    }

    $query_usuarios_eet=$query_usuarios_eet.");";
    echo $query_usuarios_eet;
    echo "\n";
    //string de query generado

    //crear tabla usuarios temporal
    mysqli_query($conn, $query_usuarios_eet);
    echo "ueel";
    echo "\n";
  }


 ///////////////GENERACION DE ARREGLOS PARA GRAFICAS/////////////////////////
 public function g1_hombresymujeres(){
    $conn = $this->conn;

    $contador_m = 0;
    $contador_f = 0;

    $unique_users = Array ();

    $query_user = "SELECT DISTINCT callingstationid FROM radius.radacct_temporal;";

    $result_user = mysqli_query($conn,$query_user);

    while ($row = mysqli_fetch_array($result_user, MYSQLI_NUM)){
      $unique_users[]=$row[0];
    }

    foreach ($unique_users as $user){
      $query_genero = "SELECT genero FROM radius.usuarios_temporal WHERE mac = '".$user."';";
      $result_genero = mysqli_query($conn,$query_genero);
      $genero_de_user = mysqli_fetch_row($result_genero)[0];
      if ($genero_de_user=="male"){
        $contador_m++;
      } elseif ($genero_de_user == "female"){
        $contador_f++;
      }
    }

    $response = Array ($contador_m, $contador_f);
    return $response;
  }

  public function g2_poredades_m(){
    $conn = $this->conn;

    $query_maj60_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>60"));
    $query_50_60_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=50 && edad<=60"));
    $query_43_49_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=43 && edad<=49"));
    $query_38_42_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=38 && edad<=42"));
    $query_33_37_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=33 && edad<=37"));
    $query_27_32_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=27 && edad<=32"));
    $query_23_26_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=23 && edad<=26"));
    $query_18_22_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=18 && edad<=22"));
    $query_13_17_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=13 && edad<=17"));
    $query_min13_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad<13"));

    $resultado_m = array ($query_maj60_m->num_rows,$query_50_60_m->num_rows,$query_43_49_m->num_rows,$query_38_42_m->num_rows,$query_33_37_m->num_rows,$query_27_32_m->num_rows,$query_23_26_m->num_rows,$query_18_22_m->num_rows,$query_13_17_m->num_rows,$query_min13_m->num_rows,);
    return $resultado_m;
  }

  public function g2_poredades_f(){
    $conn = $this->conn;

    $query_maj60_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>60"));
    $query_50_60_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=50 && edad<=60"));
    $query_43_49_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=43 && edad<=49"));
    $query_38_42_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=38 && edad<=42"));
    $query_33_37_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=33 && edad<=37"));
    $query_27_32_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=27 && edad<=32"));
    $query_23_26_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=23 && edad<=26"));
    $query_18_22_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=18 && edad<=22"));
    $query_13_17_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad>=13 && edad<=17"));
    $query_min13_m = ($conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE genero='male' && edad<13"));

    $resultado_m = array ($query_maj60_m->num_rows,$query_50_60_m->num_rows,$query_43_49_m->num_rows,$query_38_42_m->num_rows,$query_33_37_m->num_rows,$query_27_32_m->num_rows,$query_23_26_m->num_rows,$query_18_22_m->num_rows,$query_13_17_m->num_rows,$query_min13_m->num_rows,);
    return $resultado_m;
  }

  public function g3_recurrentes(){
    $conn = $this->conn;
    $unique_users = self::usuarios_unicos();
    $contador_r = 0;
    $contador_n = 0;
    foreach ($unique_users as $user){
  		$query_r = ($conn->query("SELECT * FROM radius.radacct_temporal WHERE callingstationid='".$user."';"));
  		if ($query_r->num_rows > 1){
  			$contador_r++;
  		} elseif ($query_r->num_rows == 1){
  			$contador_n++;
  		}
    }
    $resultado = array ($contador_r, $contador_n);
    return $resultado;
  }

  public function g4_nvisitas_por_nclientes(){
    $conn = $this->conn;
    $unique_users = self::usuarios_unicos();
    $contador_1 = 0;
    $contador_2 = 0;
    $contador_3 = 0;
    $contador_4 = 0;
    $contador_5 = 0;
    $contador_6 = 0;
    foreach ($unique_users as $user){
    $query_r = ($conn->query("SELECT * FROM radius.radacct_temporal WHERE callingstationid='".$user."';"));
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

  public function g5_visitas_por_dia(){
    $conn = $this->conn;

    $domingos = self::dias(0);
    $luneses = self::dias(1);
    $marteses = self::dias(2);
    $miercoleses = self::dias(3);
    $jueveses = self::dias(4);
    $vierneses = self::dias(5);
    $sabados = self::dias(6);

    $acu_lun=0;
    $acu_mar=0;
    $acu_mie=0;
    $acu_jue=0;
    $acu_vie=0;
    $acu_sab=0;
    $acu_dom=0;

    for ($i=0; $i < count($domingos) ; $i++) {
      $query = $conn->query("SELECT * FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$domingos[$i]."';");
      $acu_dom = $acu_dom + $query->num_rows;
    }

    for ($i=0; $i < count($luneses) ; $i++) {
      $query = $conn->query("SELECT * FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$luneses[$i]."';");
      $acu_lun = $acu_lun + $query->num_rows;
    }

    for ($i=0; $i < count($marteses) ; $i++) {
      $query = $conn->query("SELECT * FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$marteses[$i]."';");
      $acu_mar = $acu_mar + $query->num_rows;
    }

    for ($i=0; $i < count($miercoleses) ; $i++) {
      $query = $conn->query("SELECT * FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$miercoleses[$i]."';");
      $acu_mie = $acu_mie + $query->num_rows;
    }

    for ($i=0; $i < count($jueveses) ; $i++) {
      $query = $conn->query("SELECT * FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$jueveses[$i]."';");
      $acu_jue = $acu_jue + $query->num_rows;
    }

    for ($i=0; $i < count($vierneses) ; $i++) {
      $query = $conn->query("SELECT * FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$vierneses[$i]."';");
      $acu_vie = $acu_vie + $query->num_rows;
    }

    for ($i=0; $i < count($sabados) ; $i++) {
      $query_dom = $conn->query("SELECT * FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$domingos[$i]."';");
      $acu_sab = $acu_sab + $query->num_rows;
    }
    $resultado = array ($acu_dom, $acu_lun, $acu_mar, $acu_mie, $acu_jue, $acu_vie, $acu_sab);
    return $resultado;
  }

  public function g6_tiempo_por_dia(){
    $conn = $this->conn;

    $domingos = self::dias(0);
    $luneses = self::dias(1);
    $marteses = self::dias(2);
    $miercoleses = self::dias(3);
    $jueveses = self::dias(4);
    $vierneses = self::dias(5);
    $sabados = self::dias(6);

    $tiempos_lunes = Array ();
    $tiempos_martes = Array ();
    $tiempos_miercoles = Array ();
    $tiempos_jueves = Array ();
    $tiempos_viernes = Array();
    $tiempos_sabados = Array();
    $tiempos_domingos = Array();


    for ($i=0; $i < count($domingos) ; $i++) {
      $tiempos = Array ();
      $query = "SELECT acctsessiontime FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$domingos[$i]."';";
      $result = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $tiempos[]=$row[0];
      }
      $tiempos_domingos = array_merge($tiempos_domingos,$tiempos);
    }

    for ($i=0; $i < count($luneses) ; $i++) {
      $tiempos = Array ();
      $query = "SELECT acctsessiontime FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$luneses[$i]."';";
      $result = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $tiempos[]=$row[0];
      }
      $tiempos_lunes = array_merge($tiempos_lunes,$tiempos);
    }

    for ($i=0; $i < count($marteses) ; $i++) {
      $tiempos = Array ();
      $query = "SELECT acctsessiontime FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$marteses[$i]."';";
      $result = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $tiempos[]=$row[0];
      }
      $tiempos_martes = array_merge($tiempos_martes,$tiempos);
    }

    for ($i=0; $i < count($miercoleses) ; $i++) {
      $tiempos = Array ();
      $query = "SELECT acctsessiontime FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$miercoleses[$i]."';";
      $result = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $tiempos[]=$row[0];
      }
      $tiempos_miercoles = array_merge($tiempos_miercoles,$tiempos);
    }

    for ($i=0; $i < count($jueveses) ; $i++) {
      $tiempos = Array ();
      $query = "SELECT acctsessiontime FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$jueveses[$i]."';";
      $result = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $tiempos[]=$row[0];
      }
      $tiempos_jueves = array_merge($tiempos_jueves,$tiempos);
    }

    for ($i=0; $i < count($vierneses) ; $i++) {
      $tiempos = Array ();
      $query = "SELECT acctsessiontime FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$vierneses[$i]."';";
      $result = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $tiempos[]=$row[0];
      }
      $tiempos_viernes = array_merge($tiempos_viernes,$tiempos);
    }

    for ($i=0; $i < count($sabados) ; $i++) {
      $tiempos = Array ();
      $query = "SELECT acctsessiontime FROM radius.radacct_temporal WHERE DATE(acctstarttime)= '".$sabados[$i]."';";
      $result = mysqli_query($conn,$query);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $tiempos[]=$row[0];
      }
      $tiempos_sabados = array_merge($tiempos_sabados,$tiempos);
    }

    $domingo_average = array_sum($tiempos_domingos) / count($tiempos_domingos);
    $lunes_average = array_sum($tiempos_lunes) / count($tiempos_lunes);
    $martes_average = array_sum($tiempos_martes) / count($tiempos_martes);
    $miercoles_average = array_sum($tiempos_miercoles) / count($tiempos_miercoles);
    $jueves_average = array_sum($tiempos_jueves) / count($tiempos_jueves);
    $viernes_average = array_sum($tiempos_viernes) / count($tiempos_viernes);
    $sabado_average = array_sum($tiempos_sabados) / count($tiempos_sabados);

    $resultado = array ($domingo_average, $lunes_average, $martes_average, $miercoles_average, $jueves_average, $viernes_average, $sabado_average);
    return $resultado;


  }

  public function g7_medio_de_acceso(){
    $conn = $this->conn;
    $query_fb = $conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE metodo_autent='facebook';");
    $query_tw = $conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE metodo_autent='twitter';");
    $query_go = $conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE metodo_autent='google';");
    $query_fo = $conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE metodo_autent='formulario';");

    $resultado = array ($query_fb->num_rows,$query_tw->num_rows,$query_go->num_rows,$query_fo->num_rows);
    return $resultado;
  }

  public function g8_dispositivos(){
    //tablet, telefono y computadora
    //corregir strings de busqueda
    $conn=$this->conn;
    $query_tablet = $conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE dispositivo='tablet';");
    $query_telefono = $conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE dispositivo='telefono';");
    $query_computadora = $conn->query("SELECT * FROM radius.usuarios_eet_temporal WHERE dispositivo='computadora';");

    $resultado = array ($query_tablet->num_rows,$query_telefono->num_rows,$query_computadora->num_rows);
    return $resultado;
  } 

}

$sesion= new Sesion(":(","1");
$sesion->generar_radacct();

echo "\n";
echo "\n";

$sesion->generar_usuarios();

echo "\n";
echo "\n";

$sesion->generar_usuarios_eneltiempo();

echo "\n";
echo "\n";

$prueba1 = $sesion->g1_hombresymujeres();
print_r(array_values($prueba1));
echo "\n";

$prueba2 = $sesion->g2_poredades_m();
print_r(array_values($prueba2));
echo "\n";

$prueba3 = $sesion->g2_poredades_f();
print_r(array_values($prueba3));
echo "\n";

$prueba4 = $sesion->g3_recurrentes();
print_r(array_values($prueba4));
echo "\n";

$prueba5 = $sesion->g4_nvisitas_por_nclientes();
print_r(array_values($prueba5));
echo "\n";

$prueba6 = $sesion->g5_visitas_por_dia();
print_r(array_values($prueba6));
echo "\n";

$prueba7 = $sesion->g6_tiempo_por_dia();
print_r(array_values($prueba7));
echo "\n";

$prueba8 = $sesion->g7_medio_de_acceso();
print_r(array_values($prueba8));
echo "\n";

$prueba9 = $sesion->g8_dispositivos();
print_r(array_values($prueba9));
echo "\n";
?>
