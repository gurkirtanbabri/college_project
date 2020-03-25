<?php
session_start();
if(isset($_SESSION['cust_name'])){
	echo "<script>window.location.replace(\"user.php\")</script>";}
?>




<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<title>account</title>
	<link rel="stylesheet" type="text/css" href="verifyotp.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css">
</head>
<body>
	<div class="mainverify">
		
		<div class="mindiv" id="guestdata">
			<div id='data'>
			<h2 class="loghead">sign up</h2>
			
			<input type="text" id='guestph' placeholder="phone number" class="guestin" value="">
			<input type="text" id= 'guestname' placeholder='full name' class="guestin" value=''>
			<input type="password" id='guestpass' placeholder="password" class="guestin" value=''>
			<input type="text" id='guestaddress' placeholder='address' class="guestin" value=''>
			<button type="button" id='guest_submit' class='user_btn hvr-grow'> submit</button>
		</div>
		</div>
		<div class="mindiv" id="user-verify">
			<h2 class="loghead">login</h2>
				<input type="text" id= 'userph' placeholder='phone number' class="guestin">
			<input type="password" id='userpass' placeholder="password" class="guestin">
			<button type="button" class='hvr-grow' id='user_check'> login</button>
		</div>
	<div class="mindiv" id='slide'>
		<div id='slide_info1'>
		<h3 id='dont'>don't have account?</h3>
			
			<button type="button" id='hha' class='hvr-buzz-out'> signup</button>
		</div>
		<div id='slide_info2'>
		<h3 id='have'> already user</h3>

			<button type="button" id='nha'  class='hvr-buzz-out'> login</button>
		</div>
	</div> 

	</div>

	<script type="text/javascript" src='../jq.js'></script>
	<script type="text/javascript" src='user.js'></script>
</body>
</html>