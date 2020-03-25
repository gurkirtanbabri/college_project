<?php
session_start();
$cust='';
if(isset($_SESSION['cust_name'])){
 $cust=$_SESSION['cust_name'];}

if(isset($_SESSION['cart'])){
    $citems=sizeof($_SESSION['cart']);
   
}
else{
$citems=0;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Appetizer</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="font.css">
<link rel="stylesheet" type="text/css" href="css/hover.css">
<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
<link rel="stylesheet" href="index.css">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark  ">
		<a class="navbar-brand" href="#">Appetizer</a>
  </button>

    <ul class="navbar-nav ">

   <li class="nav-item  ">
        <a class="nav-link text-warning hvr-float " href=".">Home</a>
      </li>


       <li class="nav-item active">
        <a class="nav-link hvr-float" href="user/useraccount.php">ACCOUNT</a>
      </li>

   <li class="nav-item active">
        <a class="nav-link hvr-float" href="admin/">Admin</a>
      </li>


       <li class="nav-item active">
        <a class="nav-link hvr-float" href="#">ABOUT</a>
      </li>
</ul>

	</nav>





<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/bg.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="image/bg22.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="image/bg3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>









<div class="bar">
    <div class="type_div">
        <p>show both</p>
        <input type="checkbox" id='check_btn'>
        <p>only veg</p>
    </div>
     <p class="cust"><span>order your food!  </span> <a href="user/useraccount.php"><?php
        echo "   $cust";
        ?></a></p>
    <div class="cart">
       
   <a href="cart/cart.php"> <img src='image/cart.svg' height="40" width="48"></a>
    <p id='count'><?php echo $citems; ?></p>
</div>
</div>        
        <?php
        cat_div();
        ?>
<div class="footer">
    <h1>contact us </h1>
    <div class='we'>
        <div class="ram">
            <p>ram kumar</p>
            <p> rmaa50453@gmail.com</p>
            <p>+919780945123</p>
        </div>
        <div class="gurkirtan">
            <p>gurkirtan singh</p>
            <p>gurkirtans10@outlook.com</p>
            <p>+919877153094</p>
</div>
    </div>
    <div class="dev">
        <p class='develop'>
        design and developed by </br>
    gurkirtan singh  and ram kumar</br>
    at govt. college gurdaspur
        </p>
    </div>
</div>



        
       <script type="application/javascript" src="jq.js"></script>
    
       <script src='bootstrap/bootstrap.js'></script>
        <script type="application/javascript" src="index.js"></script>

</body>
</html>
<?php
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


function cat_div(){
    $catagires=fetch_cat();
  foreach ($catagires as $cats) {
    $category=$cats['cat_name'];
    $items=fetch_item($category);
      echo"
      <div class='cat_div'>
      <h1>  $category</h1>
      <div class='item_grid'>";
      //item starts from hare//
      foreach ($items as $item)
      { $path=$item['item_img'];
  $path="user/$path";
    $type='image/veg.png';
    $name=$item['item_name'];
$id=$item['item_id'];
    $price=$item['item_price'];
    $t=$item['item_type'];
    $discount=$item['item_discount'];
    $actual_price=$price-(floatval($price)*(floatval($discount))/100);
    $ing=$item['item_ing'];
    if($item['item_type']=='non-veg'){
        $type='image/nonveg.png';
    }
          
echo "<div class='item_div  $t'>
<img src='$path' class='item_img'>
<img src='$type' class='type' height='48' width='48'>
<p class='name' >$name</p>
<p class='price'>₹$actual_price</p>
<p class='discount'><strike>₹$price</strike></p>
<p class='dis_per'>$discount % discount</p>
<p class='ing'>$ing</p>
<button class='cart_btn hvr-float' onclick='addtocart($id)'>add to cart</button>
</div>
";
      }


    


echo"</div>
</div>";
      
  }

}

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







?>







