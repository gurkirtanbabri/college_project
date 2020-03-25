<?php
require_once ('../cart/cart_support.php');
if(!isset($_SESSION['admin'])){
	echo "<script>window.location.replace('../index.php')</script>";}
else{
	$admin=$_SESSION['admin'];
}
$sql="select * from current_order";
$res=ordersql($sql);




function ordersql($sql){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}/* */



$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$r=[];

while($row = $result->fetch_assoc()) {

array_push($r, $row);
}
return($r);

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>work area</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css">
	<link rel="stylesheet" type="text/css" href="order.css">

</head>
<body>
<div class="container-fluid ">


	<div  class="bar">

		<a href="../" class="brand">Appetizer</a>

		<a  id='o1'>Administration</a>
		<a  id='o2'>Kitchen</a>
		<a id='o3'>Delivery</a>
		<ul class="navbar-nav">
	<li class="nav-item">
		<a href='./' class="nav-link bg-dark">go to admin panel</a></li>
</ul>
	</div>



</div>
<div class='container shadow-lg py-3-' id="main">
	
</div>
	<script type="text/javascript" src="../jq.js"></script>
	<script type="text/javascript" src="../bootstrap/bootstrap.js"></script>
		
			<script type="text/javascript" src="order.js"></script>
</body>
</html>