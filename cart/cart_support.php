<?php
session_start();
define('servername','localhost');
define('username','root');
define('password','');
define('dbname','cart');
if(!isset($_SESSION['cart'])){
$_SESSION['cart']=[];
}


if(!isset($_SESSION['cart_items'])){
$_SESSION['cart_items']=0;
}
switch (true) {
	case isset($_POST['addtocart']):
		$id=$_POST['addtocart'];

if(isset($_SESSION['cust_name'])){
	$table="cust".$_SESSION['cust_ph'];
$sql="create table  IF NOT EXISTS  ". $table ."(citem varchar(25) primary key,
cquntity varchar(25),
cprice varchar(10),
cname varchar(25)
)";


sqlrun($sql);
$item=fetch_item($id);
$item=$item[0];
    $price=$item['item_price'];
    $t=$item['item_type'];
	$table="cust".$_SESSION['cust_ph'];
    $discount=$item['item_discount'];
    $name=$item['item_name'];
    $baseprice=$price-(floatval($price)*(floatval($discount))/100);
$sql="insert into ".$table." values($id,1,$baseprice,'$name')";
$alert=sqlrun($sql);
if ($alert){
echo 'added';
}
else{
echo 'already';
}
}
else {
	echo "signin";
}
		break;
	case isset($_POST['cart_value']):

if(isset($_SESSION['cust_name'])){
	
	$table="cust".$_SESSION['cust_ph'];
$sql= "SELECT count(*) FROM ".$table;
$rows=sqlres($sql);
$t_rows=$rows['count(*)'];
echo $t_rows;

}
else{
	echo "0";
}
		break;

		case isset($_POST['remove']):
		$remove_id=$_POST['remove'];
		$table="cust".$_SESSION['cust_ph'];
		$sql="delete from $table where citem = $remove_id";
		$dec=sqlrun($sql);
		if($dec){
			echo 'removed';
		}
		else{
			echo "notremoved";
		}
			# code...
			break;
			case isset ($_POST['update']):
			$table="cust".$_SESSION['cust_ph'];
			$qty=$_POST['value'];
			$id =$_POST['update'];
			$sql= "update $table set cquntity = $qty where citem = $id";
			$res=sqlrun($sql);
			if($res){
				echo "updated";
			}


			break;
			case isset($_POST['cod']):

$table="cust".$_SESSION['cust_ph'];
$ph=$_SESSION['cust_ph'];
$sql="select * from $table";
$temp=[];
$total=0;

$ar=fullres($sql);
foreach ($ar as $ar2) {
$name=$ar2['cname'];
$quantity=$ar2['cquntity'];
$total=$total+($quantity * floatval($ar2['cprice']));
$temp2 = array($name => $quantity);
$temp=array_merge($temp,$temp2);	
}
$json=json_encode($temp);
$t=time();
$oder_id= $_SESSION['cust_ph'].$t;
$sql="INSERT INTO current_order (order_id,cust_order,status,tran_moode,cust_ph,totalamount)
values('$oder_id','$json' ,'order placed', 'cod' ,$ph,$total) ";
sqlrunpro($sql);
$sql="delete from $table";
sqlrun($sql);
echo "order_placed";

/*
$ar=fullres($sql);
$temp['item']=$ar['cname'];
$temp['quantity']=$ar['cquntity'];
$json=json_encode($temp);
echo $json;*/
			break;
	default:
		# code...
		break;
}


function fetch_item($i){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$item_id=$i;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}/* */

$sql = "SELECT * FROM item_detail where item_id=$item_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$r=[];

$row = $result->fetch_assoc();
array_push($r, $row);}
return($r);

}
function addtocart($arr,$id){
if(isset($_SESSION['cust_name'])){
	$cust_id=$_SESSION['cust_ph'];
	$arr['quantity']=1;
$cart=sqlres('select * from cart where cust_id=$cust_id');
if(empty($cart)){
	$alert=sqlrun('insert into cart values($cust_ph,null,0,0)');

}
else{
	
}


}
}
/*	$sarry=$_SESSION['cart'];
$bool=array_key_exists($id,$_SESSION['cart']);
if($bool){
	 $citems=sizeof($_SESSION['cart']);
	    echo $citems;
}
else{
	$_SESSION['cart'][$id]=$arr;
	    $citems=sizeof($_SESSION['cart']);

	    echo $citems;
}*/


function sqlrun($query){
	$conn = new mysqli(servername, username, password, dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = $query;

if ($conn->query($sql) === TRUE) {
    return(true);
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
    return(false);
}
}

function sqlres($query){
		$conn = new mysqli(servername, username, password, dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$sql = $query;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
return($row);
}
}
}
function fullres($sql){
	
	
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



$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$r=[];

while($row = $result->fetch_assoc()) {

array_push($r, $row);
}
return($r);

}
}

function sqlrunpro($query){
	$conn = new mysqli(servername, username, password,'project');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = $query;

if ($conn->query($sql) === TRUE) {
    return(true);
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
    return(false);
}
}


	/*print_r($sarry);
if(!($arr,$sarry)){
	echo 'added';
	array_push($_SESSION['cart'], $arr);
	print_r($_SESSION['cart']);

}
else{
	echo In_array"not added";
	print_r($_SESSION['cart']);
}

}*/
?>


  