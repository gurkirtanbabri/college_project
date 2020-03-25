<?php

require_once 'admin_suport.php';


//main
if(isset($_POST['edit_item'])){
$itemid=$_POST['edit_item'];
$item_cat=$_POST['edit_item_cat'];





function getcat(){



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

$sql = "SELECT cat_name FROM category_detail;";

$result = $conn->query($sql);
$earr=[];

while($row = $result->fetch_assoc()) {
	array_push($earr,$row);

}
return ($earr);

}

getcat();
function edit_compo($id,$cat){
	$place=egetitem($id);
$name=$place['item_name'];
$price=$place['item_price'];
$im=$place['item_img'];
$ing=$place['item_ing'];
$dis=$place['item_discount'];

$html="<div id='eitem_div'>
<h3> edit $name</h3>

<input type='text' placeholder='current name is $name' id='ename' value='$name' >
<input type='text' id='eprice' placeholder='current price is $price' value='$price' >

<input type='text' id='eing' placeholder=' current ingredients $ing' value='$ing' >

<input type='text' id='edis' placeholder='current discount is $dis' value='$dis' >
<select id='etype'>
  <option value='veg'>veg</option>
  <option value='non-veg'>non-veg</option>
";
echo $html;

echo"
</select>


<button id='submit' onclick=".$q."eedit_item($id,'$cat')".$q.">submit</button>
<button id='ecancel' >cancel</button>

";




echo "<script>$('#ecancel').on('click',()=>{

		$('#eitem_div').remove();});

$('#eimg').on('click',()=>{
$('#efile').click();
	
	});


$('#ename,#eing').on('change',function(){
		
		alphacheckfun(this,this.value);

	});

$('#edis,eprice').on('change',function(){
		
		numcheckfun(this,this.value);

	});



		</script>";




}



edit_compo($itemid,$item_cat);

}

function egetitem($id){
	$servername="localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}/* */

$sql = "SELECT * FROM item_detail where item_id=$id;";
$ar=[];
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {

$ar=$row;
}
return ($ar);
}


//eddit item request//
if(isset($_POST['edit_item_data'])){

$id=$_POST['edit_item_data'];
$name=$_POST['name'];
$price=$_POST['price'];
$dis=$_POST['dis'];
$ing=$_POST['ing'];
$type=$_POST['type'];
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

$sql = "Update item_detail set item_name='$name', item_price=$price ,item_discount=$dis, item_ing='$ing' ,item_type='$type' WHERE item_id=$id";

if ($conn->query($sql) === TRUE) {
    echo 'true';
} else {
    echo "false";
}

}




?>