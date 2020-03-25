<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("paytm/lib/config_paytm.php");
require_once("paytm/lib/encdec_paytm.php");
require_once("cart_support.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
//	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		//echo "<b>Transaction status is success</b>" . "<br/>";
		$name=$_SESSION['cust_name'];
		$cust=$_SESSION['cust_ph'];
		$amount=$_POST['TXNAMOUNT'];
		$order=$_POST['ORDERID'];
		$t_id=$_POST['TXNID'];

date_default_timezone_set("Asia/Calcutta");
$now=new DateTime('now');
		$date=$_POST['TXNDATE'];
		
order();
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		//echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		
	}
	

}
else {
	//echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>










<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>payment status</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
	<style type="text/css">
		.table{
  width:60%;
text-transform:capitalize;
display:block;
margin:auto;
padding:50px;
font-size:1.55rem
}
h1{
  text-align:center;

}
div{
 
  display:flex;
  justify-content:space-evenly;
  padding:10px;

}
a{
  text-decoration:none;
  
  text-transform:capitalize;
  font-size:1.2rem;
  color:white;
  background-color:var(--primary);
  padding:10px
}
a:hover{
	background-color: var(--dark);
	color:white;
	text-decoration:none;
}


	</style>
</head>
<body>
	
	<?php
	if ($_POST["STATUS"] == "TXN_SUCCESS" )
	{ 
$element="


<h1 class='s'>order placed</h1>
<table class=\"table able-bordered  table-dark\">

<tr>
<td>Name</td>
<td>$name</td>
</tr>

<tr>
<td>Order id</td>
<td>$order</td>
</tr>

<tr>
<td> Transaction id</td>
<td>$t_id</td>
</tr>

<tr>
<td>Amount</td>
<td>$amount</td>
</tr>

<tr>
<td>Date</td>
<td>$date</td>
</tr>

</table>




<div >
<a href='../user/user.php'> view your orders </a>
<a href='../'> go to home </a>
</div>



";	
echo $element;
	}

else{
	$element="<h1>Transaction failed</h1>

<div >
<a href='../user/user.php'> view your orders </a>
<a href='../'> go to home </a>
</div>


	";
echo $element;
}



	?>
	<script type="text/javascript" src='../jq.js'></script>
	<script type="text/javascript">
		jquery.jQuery(document).ready(function($) {
			function preventBack() {
    window.history.forward();
}
 window.onunload = function() {
    null;
};
setTimeout("preventBack()", 0);
			
		});
  
</script>
</body>
</html>

<?php

function order(){
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
values('$oder_id','$json' ,'order placed', 'online' ,$ph,$total) ";
sqlrunpro($sql);
$sql="delete from $table";
sqlrun($sql);

}
?>