<!--CONEXION CON BASE DE DATOS-->
<?php
$mac = $_GET['mac'];

echo '<br> MAC:' . $mac . '<br> <br>';


//crear conexion con BD
$host_name  = "74.208.234.185";
$database   = "radius";
$user_name  = "radius";
$password   = "radpass";

$connect = mysqli_connect($host_name, $user_name, $password, $database);

//crear nuevo usuario en radcheck
$sql = "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$mac','Cleartext-Password', ':=' , '$mac')";

/*
	if ($connect->query($sql) === TRUE) {
		echo "New record created successfully Wuuu"; //mensaje
	    //BANDERA
	} else {
	    echo "Error: " . $sql . "<br>" . $connect->error;
	}
*/

$connect->close();

echo '<br><br> connection closed';

//print_r($_GET);

$username=''.$mac;
$password=''.$mac;

$challenge=$_POST['challenge'];
$redir=$_POST['userurl'];
//
$enc_pwd=return_new_pwd($password,$challenge);
$server_ip='192.168.3.1';
$port='3990';
//$dir          = '/json/logon';
$dir            = '/logon';
$target     = "http://$server_ip".':'.$port.$dir."?username=$username&password=$enc_pwd&userurl=$redir";

echo '<br><br>' . $targer . '<br><br>';

//de prueba
// $target     = "http://$server_ip".':'.$port.$dir."?username=$username&password=$enc_pwd&userurl=$redir";

header("Location: $target");
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


?>
