<?php
require_once('cart_support.php');
if(isset($_SESSION['cust_name'])){

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
$t=time();
$oder_id= $_SESSION['cust_ph'].$t;
echo $oder_id;

$json=json_encode($temp);
$sql="INSERT INTO current_order (cust_order,status,tran_moode,cust_ph,totalamount)
values('$json' ,'order placed', 'cod' ,$ph,$total) ";
$id=$_SESSION['cust_ph'];
/*sqlrunpro($sql);
$sql="delete from $table";
sqlrun($sql);*/
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<?php 
	$ele="<form method=\"post\" action=\"paytm/pgRedirect.php\" name=\"sub\">
	<input name=\"ORDER_ID\" tabindex=\"1\" maxlength=\"20\" size=\"20\" value=\"$oder_id\" type=\"hidden\">
	<input id=\"CUST_ID\" tabindex=\"2\" maxlength=\"12\" size=\"12\" name=\"CUST_ID\" autocomplete=\"off\" value=\"$id\" type=\"hidden\">
	<input id=\"INDUSTRY_TYPE_ID\" tabindex=\"4\" maxlength=\"12\" size=\"12\" name=\"INDUSTRY_TYPE_ID\" autocomplete=\"off\" value=\"Retail\" type=\"hidden\">
	<input id=\"CHANNEL_ID\" tabindex=\"4\" maxlength=\"12\" size=\"12\" name=\"CHANNEL_ID\" autocomplete=\"off\" value=\"WEB\" type=\"hidden\">
	<input title=\"TXN_AMOUNT\" tabindex=\"10\" type=\"text\" name=\"TXN_AMOUNT\" value=\"$total\">
				

</form>
	";
	echo $ele;

	?>

	<script type="text/javascript">
		document.sub.submit();
	</script>
</body>
</html>

