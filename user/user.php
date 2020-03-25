<?php
session_start();


if(!isset($_SESSION['cust_name'])){
	echo "<script>window.location.replace('useraccount.php')</script>";

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php $_SESSION['cust_name']?></title>
	<link rel="stylesheet" type="text/css" href="user.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css">
	<link rel="stylesheet" type="text/css" href="../font.css">
		<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css">
</head>
<body>
<div id="main">
	<div id="greet">
		<h2>hello  <?php echo $_SESSION['cust_name']?></h2>
	</div>
	<div id="action">
		<a class="hvr-pulse" href="../">home</a>
		<a  class="hvr-pulse" id='cur'>current orders</a>
		<a  class="hvr-pulse" id='old'>old orders</a>
		<a class="hvr-shrink" id='logout'>logout</a>
	</div>
</div>
<div class="container" id='con'></div>
	<script type="text/javascript" src='../jq.js'></script>
<script type="text/javascript" src='userorders.js'></script>
<script type="text/javascript">





$('#logout').on('click',()=>{
		$.post({
		type:'post',
		url:'usersupport.php',
		data:{
			logout:''

		},
		success:function(data){
console.log(data);
	window.location.replace('useraccount.php');
		}});


	});
jQuery(document).ready(function($) {
	current();
	
});

function current(){
		let v= '';
	$.ajax({
		url: '../admin/ordersupport.php',
		type: 'POST',

		data: {current:v},
		success:function(data){
			$('#con').html(data);
		}

	});
}

$('#cur').click(function(event) {
	/* Act on the event */
	current();
});
$('#old').click(function(event) {
		let v= '';
	$.ajax({
		url: '../admin/ordersupport.php',
		type: 'POST',

		data: {old:v},
		success:function(data){
			$('#con').html(data);
		}

	});
	/* Act on the event */

});

</script>
</body>
</html>