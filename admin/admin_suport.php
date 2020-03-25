<?php
session_start();

function additem(){
	$head='ADD ITEM';
	$item_name='';
	$item_price='';
	$item_ingredients='';
$discount='';
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

$sql = "SELECT * FROM category_detail;";

$result = $conn->query($sql);


	$html="<div id='add_item_main_div'>
	<h1>$head</h1>
	<div id='image_upload_div'>
<img src='../image/upload.jpg' id='image_upload'>
<input type='file' id='upload_file' >
	</div>
	<div id='add_item_div'>
<input type='text' id='add_item_name' placeholder='enter item name' value='$item_name'>
<input type='text' id='add_item_price' placeholder='enter item price' value='$item_price'>
<input type='text' id='add_item_ingredients' placeholder='enter ingredients' value='$item_ingredients'>
<input type='text' id='add_item_discount' placeholder='enter discount percentage' value='$discount'>
<select id='type'>
  <option value='veg'>veg</option>
  <option value='non-veg'>non-veg</option>
 
</select>
<select id='cat'>
";
echo $html;
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
	$ca_name=$row['cat_name'];
	echo "<option value='$ca_name'>$ca_name</option>
	";
}
}

echo "</select>

<button id='add_item_submit'>submit</button>

</div>
	</div>
	<script>add_evt_lsn();
function add_evt_lsn(){
	$('#image_upload').on('click',function(evt){
		console.log('ck');
$('#upload_file').click();
	});
}


$('#upload_file').change(function() {
  readURL(this);
});

	$('#add_item_name,#add_item_ingredients').on('change',function(){
		
		alphacheckfun(this,this.value);

	});

$('#add_item_price,#add_item_discount').on('change',function(){
		
		numcheckfun(this,this.value);

	});
$('#add_item_submit').on('click',function(){
		add_item_final();

	});

	</script>
	";

	
}
//update item //
//geting valid items
function valid_item(){
$vcat=fetch_cat();
$item_arr=[];
foreach ($vcat as $cat) {
	$it=fetch_item($cat['cat_name']);
	array_push($item_arr,$it);

}
return($item_arr);

}
//fetch cat
function fetch_cat(){
	
	
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

$sql = "SELECT * FROM category_detail;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$r=[];

while($row = $result->fetch_assoc()) {
	if($row['cat_items']>0){
array_push($r, $row);
}}
return($r);

}
}
//fetch item//
function fetch_item($i){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$cat_name=$i;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}/* */

$sql = "SELECT * FROM item_detail where item_cat='$cat_name';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$r=[];

while($row = $result->fetch_assoc()) {
array_push($r, $row);
}}
return($r);

}


//update item
function update_item(){

/*$test=valid_item();

$test1=$test[0];

$test2=$test[1];*/
$vcat=fetch_cat();
echo"<div id='update_main_div'>";
foreach ($vcat as $cat_head) {
	$cname=$cat_head['cat_name'];
	echo "<h1>$cname</h1>
<div id='update_main_div2'>
	";
$it=fetch_item($cat_head['cat_name']);
	
foreach ($it as $valid_it) {
	$path=$valid_it['item_img'];
	$type='../image/veg.png';
	$name=$valid_it['item_name'];
$id=$valid_it['item_id'];
	$price=$valid_it['item_price'];
	$discount=$valid_it['item_discount'];
	$ing=$valid_it['item_ing'];
	if($valid_it['item_type']=='non-veg'){
		$type='../image/nonveg.png';
	}
	$q='"';
	echo "
<div class='update_items' >

<img src='$path' height='200' class='item_image' width='200'> 
	

	<p class='item_name'>$name</p>
	<img src='$type' height='48' width='48' class='type_logo'>
	</tr>
	<tr>
<p class='price'>Rs.$price</p>
<p class='discount'>$discount %discount</p>

<tr>
<p class='ing' >$ing</p>

<button type='button' onclick=".$q."edit_item('$cname',$id)".$q.">edit </button>
<button type='button' onclick=".$q."del_item('$cname',$id)".$q.">delete </button>


	</div>";

}
echo "</div>";



}
echo "
</div>";
echo "<script>
function edit_item(i,j){main_edit_item(i,j)};
function del_item(i,j){main_del_item(i,j)};
</script>";


}
                                            //del_item 

//item_count
function item_count($cat_v,$op){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$cat_d=$cat_v;
$opr=$op;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "Update category_detail set cat_items=cat_items $opr 1 WHERE cat_name='$cat_d'";

if ($conn->query($sql) === TRUE) {
    return (TRUE);
} else {
    return (FALSE);
}

}

//delitem//
function item_del($cat_v){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$del_i=$cat_v;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM item_detail WHERE item_id=$del_i";

if ($conn->query($sql) === TRUE) {
    return(true);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

//






switch (true) {
	case isset($_POST["logout"]):
	session_destroy();
	echo "logout done";

		# code...
		break;
		/*category*/
	case isset($_POST['catagires']):
	

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

$sql = "SELECT * FROM category_detail;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
echo "<div id='cats'>
<div id='cat_head'>
<p id='cat_h1'>categories</p>
<p id='cat_h2'>item count</p>
<p id='cat_h3'>action</p>
</div>


";
    while($row = $result->fetch_assoc()) {
    	$id=$row['cat_id'];
    	$q='"';
    	$cclick="onclick="."$q"."cedit($id)".$q;
    	$dclick="onclick="."$q"."cdel($id)".$q;

echo "<div class='cat_items'>
<div class = 'item-info'>
<p class='cat_name'>".$row['cat_name']."</p>
<div class='cat_count_div'>
<p class='cat_count'>".$row['cat_items']."</p>
</div>
</div>
<div class='item_btn'>

<button class='cat_btn edit' id=".$id." ".$cclick." >edit "."</button>
<button class='cat_btn delete' id=".$id." ".$dclick."  > delete  "."</button>
</div>
</div>

";



}};

echo "<button id='add_cat'>add category</button>";
echo"

<div id='add_cat_div'>
<h2 id='x'>x<h2>
<input type='text' id='add_cat_input'  placeholder='enter category'>
<br/>
<button id='add_cat_btn'>add </button>
</div>
<script>$('#add_cat_div').hide();</script>
               <script>
               //hide and show//
               //show and hide efunction for poupup//
               
$('#add_cat').on('click',function(){
	$('#add_cat_div').show();
		});
$('#x').on('click',()=>{
$('#add_cat_div').hide();
});

$('#add_cat_btn').on('click',function(){
	console.log($('#add_cat_btn').val());
	var add_cat_value=$('#add_cat_input').val();
		
	cat_add(add_cat_value);

}
);
// event lissener//
function cedit(id){
	cat_edit(id);
}
function cdel(id){
	cat_del(id);
}

</script>
";
echo "</div>";

		# code...

		break;
	case isset($_POST['add_cat']):
$add_cat=$_POST['add_cat'];

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

$sql = "INSERT INTO category_detail(cat_name, cat_items)
VALUES ('$add_cat', 0)";

if ($conn->query($sql) === TRUE) {
    echo "created";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

	break;

	case isset($_POST['del_cat']):
	$del_cat=$_POST['del_cat'];

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

$sql = "DELETE FROM category_detail WHERE cat_id=$del_cat";

if ($conn->query($sql) === TRUE) {
    echo "deleted";
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


	break;
	case isset($_POST['edit_cat']):
$edit_id=$_POST['edit_cat'];
$edit_value=$_POST['value'];
	
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

$sql = "Update category_detail set cat_name='$edit_value' WHERE cat_id=$edit_id";

if ($conn->query($sql) === TRUE) {
    echo "edited";
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


	break;
	case isset($_POST['add_item']):
	additem();
	


	break;
	case isset($_POST['update_item']):

	update_item();
	break;
	case isset($_POST['del_item']):
	$itd=$_POST['subt_cat'];
	$idt=$_POST['del_item'];
	
	$res=item_del($idt);
	if($res===true){
	$res=item_count($itd,'-');
	if($res){
		echo "deleted";
	}
	else
	{
		echo'not_done';
	}
}
	break;

	case isset($_POST['TRANSECTION']):

$ele="
<div class='trandiv shadow-lg p-3 mb-5 bg-white'>
<h1 class='tran'>transection detail</h1>
<input id='tran_id' placeholder='enter order id' type='text' >
<button type='button' class='hvr-grow' onclick='getdetail()'>get detail</button>
<div class='trandetail'>
</div>
</div>
";
echo $ele;


		# code...
		break;
	default:
		# code...
		break;
}


?>