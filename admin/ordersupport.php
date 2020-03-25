<?php

require_once ('../cart/cart_support.php');
if(!isset($_SESSION['admin'])){
	echo "<script>window.location.replace('../index.php')</script>";}
else{
	$admin=$_SESSION['admin'];
}
function change_status($id,$status){

$sql="update current_order set status = '$status' where order_id = '$id' ";
echo "$sql";
	sqlrunpro($sql);
}
function script(){
	echo "
	<script>
	$('.conform').click(function(){
		var id= this.id;
conform_order(id);

		});
		$('.cancel').click(function(){

var id= this.id;
cancel_order(id);
			});

$('.Completed').click(function(){

	var id= this.id;
	console.log(id);
com(id);
	});



$('.Delivered').click(function(){

	var id= this.id;
	console.log(id);
deliver(id);
	});
	</script>
	";
}



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
$r=array_reverse($r);
return($r);

}
}
switch (true) {



                          //current order//


	case (isset($_POST['con'])):
	$sql="select * from current_order  WHERE status = 'order placed'";
$res=ordersql($sql);
if(!empty($res)){

echo "<table class=\"table table-bordered\">
<tr>
<th>ORDER ID</th>
<th> ORDER</th>
<th>Total</th>
<th>Mode</th>
<th>Conform</th>
<th>cancel</th>
</tr>

";
foreach ($res as $res1) {

		$id=$res1['order_id'];
	$order=$res1['cust_order'];
	$total=$res1['totalamount'];
	$mode=$res1['tran_moode'];
	$ph=$res1['cust_ph'];
	echo "
<tr>
<td>$id</td>
<td>
	";
	$order=json_decode($order,true);
	foreach ($order as $key => $value) {
echo "$key :  $value <br/>";
		# code...
	}

echo "</td>
<td>$total</td>
<td>$mode</td>
<td><button id=\"$id\" class=\"conform btn-primary hvr-shadow\">Conform</td>
<td><button id=\"$id\" class=\"cancel btn-red hvr-buzz\">Cancel</td>

";

}


		# code...
	echo "
</table>";
script();
}
else{
	echo "<h1 style=\"text-align:center\">Don't have any order</h1>";
}
	break;



                               //for baking//




	case (isset($_POST['bake'])):
	$sql="select * from current_order WHERE status = 'conformed'";
$res=ordersql($sql);
if(!empty($res)){
echo "<table class=\"table table-bordered\">
<tr>
<th>ORDER ID</th>
<th> ORDER</th>

<th>Completed</th>
</tr>

";
foreach ($res as $res1) {

		$id=$res1['order_id'];
	$order=$res1['cust_order'];
	$total=$res1['totalamount'];
	$mode=$res1['tran_moode'];
	$ph=$res1['cust_ph'];
	echo "
<tr>
<td>$id</td>
<td>
	";
	$order=json_decode($order,true);
	foreach ($order as $key => $value) {
echo "$key :  $value <br/>";
		# code...
	}

echo "</td>

<td><button id=\"$id\" class=\"Completed btn-primary hvr-shadow\" onclick=\"com(this.id)\">Completed</td>

";

}
		# code...
	echo "
</table>


";}
else{
	echo "<h1 style=\"text-align:center\">Don't have any order</h1>";
}
	break;    


                        //for delivery//


		case (isset($_POST['daliver'])):
	$sql="select * from current_order  WHERE status = 'On The Way'";
$res=ordersql($sql);

if(!empty($res)){


echo "<table class=\"table table-bordered\">
<tr>
<th>ORDER ID</th>
<th> ORDER</th>
<th>Total</th>
<th>Mode</th>
<th>Name</th>
<th>Address</th>
<th>Phone</th>
<th>Deliver</th>
</tr>

";
foreach ($res as $res1) {

		$id=$res1['order_id'];

	$order=$res1['cust_order'];
	$total=$res1['totalamount'];
	$mode=$res1['tran_moode'];
	$ph=$res1['cust_ph'];
	$sql = "SELECT * FROM cust_detail WHERE cust_ph = '$ph'";


$cust= ordersql($sql);
$cust=$cust[0];
$name=$cust['cust__name'];
$addr=$cust['cust_addr'];
	echo "
<tr>
<td>$id</td>
<td>
	";
	$order=json_decode($order,true);
	foreach ($order as $key => $value) {
echo "$key :  $value <br/>";
		# code...
	}

echo "</td>
<td>$total</td>
<td>$mode</td>
<td>$name</td>
<td>$addr</td>
<td>$ph</td>
<td><button id=\"$id\" class=\"Delivered btn-red hvr-buzz\">Delivered</td>

";

}


		# code...
	echo "
</table>
";
script();
}
else{
	echo "<h1 style=\"text-align:center\">Don't have any order</h1>";
}
 break;

case isset($_POST['conform']):

     $id=$_POST['conform'];
     if(change_status($id,'conformed')){
     	echo "done";
     }

	# code...
	break;

case isset($_POST['completed']):

     $id=$_POST['completed'];
     echo $id;
     change_status($id,'On The Way');
     	echo "done";

   

	# code...
	break;

	                             //cencel//
	case isset($_POST['cancel']):
	$cid=$_POST['cancel'];
$sql="select * from current_order where order_id = '$cid'";
	$res1=ordersql($sql);

	$res1=$res1[0];
		$id=$res1['order_id'];
	$order=$res1['cust_order'];
	$total=$res1['totalamount'];
	$mode=$res1['tran_moode'];
	$ph=$res1['cust_ph'];

	date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");
$sql="insert into old_order values('$cid','$ph','canceled','$mode','$timestamp','$order',$total)";
sqlrunpro($sql);
$sql = "delete from current_order where order_id = '$cid'";
sqlrunpro($sql);
	

	break;
	                        //dalived//

	case isset($_POST['Delivered']):
	$cid=$_POST['Delivered'];
$sql="select * from current_order where order_id = '$cid'";
	$res1=ordersql($sql);

	$res1=$res1[0];
		$id=$res1['order_id'];
	$order=$res1['cust_order'];
	$total=$res1['totalamount'];
	$mode=$res1['tran_moode'];
	$ph=$res1['cust_ph'];

	date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");
$sql="insert into old_order values('$cid','$ph','Delivered','$mode','$timestamp','$order','$total')";
sqlrunpro($sql);
$sql = "delete from current_order where order_id = '$cid'";
sqlrunpro($sql);
	

	break;


	case (isset($_POST['current'])):
	$ph=$_SESSION['cust_ph'];
	$sql="select * from current_order where cust_ph = '$ph'";
$res=ordersql($sql);
if(!empty($res)){

echo "<table class=\"table table-bordered\">
<tr>
<th>ORDER ID</th>
<th> ORDER</th>
<th>Total</th>
<th>Mode</th>
<th>Status</th>
</tr>

";
foreach ($res as $res1) {
$status=$res1['status'];
		$id=$res1['order_id'];
	$order=$res1['cust_order'];
	$total=$res1['totalamount'];
	$mode=$res1['tran_moode'];
	$ph=$res1['cust_ph'];
	echo "
<tr>
<td>$id</td>
<td>
	";
	$order=json_decode($order,true);
	foreach ($order as $key => $value) {
echo "$key :  $value <br/>";
		# code...
	}

echo "</td>
<td>$total</td>
<td>$mode</td>
<td>$status</td>


";

}


		# code...
	echo "
</table>";
script();
}
else{
	echo "<h1 style=\"text-align:center\">Don't have any order</h1>";
}
	break;

	case (isset($_POST['old'])):
	$ph=$_SESSION['cust_ph'];
	$sql="select * from old_order where cust_ph = '$ph'";
$res=ordersql($sql);
if(!empty($res)){

echo "<table class=\"table table-bordered\">
<tr>
<th>ORDER ID</th>
<th> ORDER</th>
<th>Total</th>
<th>Mode</th>
<th>Status</th>
</tr>

";
foreach ($res as $res1) {
$status=$res1['status'];
		$id=$res1['order_id'];
	$order=$res1['cust_order'];
$time=$res1['time'];
	$mode=$res1['mode'];
	$ph=$res1['cust_ph'];
	$total=$res1['total'];
	echo "
<tr>
<td>$id</td>
<td>
	";
	$order=json_decode($order,true);
	foreach ($order as $key => $value) {
echo "$key :  $value <br/>";
		# code...
	}

echo "</td>
<td>$total</td>
<td>$mode</td>
<td>$status at $time</td>


";

}


		# code...
	echo "
</table>";
script();
}
else{
	echo "<h1 style=\"text-align:center\">Don't have any order</h1>";
}
	break;
	
	default:
		# code...
		break;
}


?>