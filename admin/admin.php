<?php
session_start();
if(!isset($_SESSION['admin'])){
	echo "<script>window.location.replace('../index.php')</script>";}
else{
	$admin=$_SESSION['admin'];
}
?>
<!DOCTYPE html>
<html>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $admin;?></title>
	<link rel="stylesheet" type="text/css" href="admin.css">
	<link rel="stylesheet" type="text/css" href="../font.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css"></head>
<body>
	<div id="top">
		<div id="logo">
			<p id="logo-name">appetizer</p>
		</div>
		<div id="logout">

			<p id="admin-name"><?php echo $admin;?></p>
					<a href='orders.php' >Work area</a>
			<button id="logout_btn" type="button">logout</button>
			
		</div>
	</div>
	<div id="menu">
		<div id="mdiv">
		<p id="menuheading">menu</p>
</div>
		<ul id="list">

			<li id="item-1" class="items">catagories</li>
			<li id="item-2" class="items">add item</li>
			<li id="item-3" class="items">update item</li>
			<li id="item-4" class="items">transections</li>
	
		</ul>
		</div>
	</div>
	<div id="main">
		<div id="empty">


		</div>	
		




</div>
	
<script type="text/javascript" src="../jq.js"></script>

<script type="text/javascript" src="admin.js">

	</script>
	



</body>
</html>