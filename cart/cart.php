<?php
session_start();
if(isset($_SESSION['cust_name'])){
$cust=$_SESSION['cust_name'];
$cust_ph=$_SESSION['cust_ph'];
$table="cust".$cust_ph;
$cart_items=fetch_cart($table);}
else {
	echo "<script>window.location.replace('../user/useraccount.php')</script>";
}
$grandtotal=0;
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CART</title>
	<link rel="stylesheet" type="text/css" href="cart.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css">
</head>
<body>

<div class="bar">
	<a href="../">home</a>
	<a id='account' href="../user/useraccount.php">account</a>
	<div>
		<img src="../image/cart.svg">
		<p id="count"></p>
	</div>
</div>

<?php
cart_row($cart_items);

?>




</table>
<script type="text/javascript" src='../jq.js'></script>
<script type="text/javascript" src="cart.js"></script>

</body>
</html>
<?php

function fetch_cart($tablename){
	
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}/* */

$sql = "SELECT * FROM $tablename;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$r=[];

while($row = $result->fetch_assoc()) {

array_push($r, $row);
}
return($r);

}
}

function cart_row($arr){

	if (!empty($arr)){
		echo "<table>
	<tr>
		<th>sr.no</th>
		<th>item name</th>
		<th>item price</th>
		<th>item quantity</th>
		<th>item total</th>
		<th>remove</th>
	</tr>
";
	$i=0;
	$grandtotal=0;
	foreach ($arr as $value) {
		$id=$value['citem'];
		$name=$value['cname'];
		$price=$value['cprice'];
		$quantity=$value['cquntity'];
		$item_total=$quantity*$price;
		$i=$i+1;
		$grandtotal=$grandtotal+$item_total;

$element1="

<tr>
<td>$i</td>
<td>$name</td>
<td>$price</td>
<td>
<button id=\"$id\" class=\"counter_btn_minus\">-</button>

<input type=\"text\" value=\"$quantity\" class=\"quantity_input\" disabled=\"true\">

<button id=\"$id\" class=\"counter_btn_plus\">+</button>
</td>
<td>$item_total</td>
<td><button id=\"$id\" class=\"remove_cart_item hvr-buzz-out\" onclick=\"remove_c(this.id)\">remove</button></td>
</tr>

";

echo $element1;

}


	}
	else
{
	echo "<h1 class=\"empty_cart \">cart is empty!</h1>";
	$grandtotal=0;
}

	$GLOBALS['total'] = $grandtotal;
	

}
$g=floatval($GLOBALS['total']);
if($g>0){
echo gtotal($GLOBALS['total']);}
function gtotal($value){
	$element="<div class=\"grandprice\">
	
<p>total amount:- $value</p>
	
	
	<div>
	<select id='t_mode'>
	<option>cash on delivery</option>
	<option>pay online </option>

	</select>
	<button id='checkout' onclick=\"chekout()\" class=\"hvr-grow\">checkout</button>
	</div>

</div>

";
return $element;
}

?>