<?php
$item_name=$_POST['item_name'];

$item_price=$_POST['item_price'];
$item_ingredients=$_POST['item_ingredients'];
$item_discount=$_POST['item_discount'];
$item_type=$_POST['item_type'];
$item_cat=$_POST['item_cat'];
$temp_img=$_FILES['image']['tmp_name'];
$name_img=$_FILES['image']['name'];
$target='../item_image/'.$name_img;


              if (file_exists($target)) 
               {
                $rand=rand(20,10000);
              $target='../item_image/'.$rand.$name_img;
                  
              } 
if(move_uploaded_file($temp_img,$target)){



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




$sql = "INSERT INTO item_detail(item_name,item_price,item_ing,item_discount,item_cat,item_type,item_img)
VALUES ('$item_name',$item_price,'$item_ingredients',$item_discount,'$item_cat','$item_type','$target')";

if ($conn->query($sql) === TRUE) {
    $sql = "Update category_detail set cat_items=cat_items+1 WHERE cat_name='$item_cat'";
    $conn->query($sql);
echo '<script>alert("item added")</script>';
} else {
    echo '<script>alert("item alredy exist")</script>';
}

	
}

?>