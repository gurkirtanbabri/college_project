<?php
session_start();
function send_otp($num,$otp1){

	$number=$num;
$otp=$otp1;



$field = array(
    "sender_id" => "FSTSMS",
    "language" => "english",
    "route" => "qt",
    "numbers" => $number,
    "message" => "23076",
    "variables" => "{#BB#}",
    "variables_values" => $otp
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    "authorization:PjSIN6nLu3AQUiFdoxlMvKOzyYmWR2kwCha0te8GZcTX1bsD5JjmQftaVJvIi6lAZYdL1WpTk3KzwbR9 ",
    "cache-control: no-cache",
    "accept: */*",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}

switch (true) {
	case isset($_POST['guestnm']):
	$_SESSION['guestnm']=$_POST['guestnm'];
	$_SESSION['guestph']=$_POST['guestph'];
	$_SESSION['guestpass']=$_POST['guestpass'];
	$_SESSION['guestaddr']=$_POST['guestaddr'];
	$otp=rand(111111,999999);
	$number=$_POST['guestph'];
	$_SESSION['otp']=$otp;
	$expire=time();
$expire=$expire+(2*60);
	$_SESSION['expire']=$expire;
	send_otp($number,$otp);
	//echo'{"return":true,"request_id":"3rijl0mg4psfcq9","message":["Message sent successfully"]}';
		break;
	case  isset($_POST['verify_otp']):
$votp=$_POST['verify_otp'];
$correct_otp=$_SESSION['otp'];
$now=time();
$expire=$_SESSION['expire'];
if($expire=$now){
	if($votp==$correct_otp){
		$gname=$_SESSION['guestnm'];
		$gaddr=$_SESSION['guestaddr'];
		$gph=$_SESSION['guestph'];
		$gpass=$_SESSION['guestpass'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO cust_detail(cust_ph, cust__name, cust_pass, cust_addr) VALUES ('$gph','$gname','$gpass','$gaddr')";

           if ($conn->query($sql) === TRUE) {
	echo 'account created';
    session_destroy();
            } else {
            	
            	echo "notdone";
   
                }

	      }
	else
	{
		echo 'incorrect';
	}
}
else{
	echo 'timeout';
}


break;

    case isset($_POST['userph']):
    $ph=$_POST['userph'];
    $pass=$_POST['userpass'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cust_detail WHERE cust_ph= $ph AND cust_pass= '$pass';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $_SESSION['cust_name']=$row["cust__name"];

        $_SESSION['cust_ph']=$row["cust_ph"];
        echo "logged in";
    }
} else {
    echo "wrong password";
}
$conn->close();

    	# code...
    	break;
      case isset($_POST['logout']):

      session_destroy();
      echo('done');
      break;
	default:
		# code...
		break;
}
?>