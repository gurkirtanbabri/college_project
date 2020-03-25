<?php
session_start();
$name=$_POST['name'];
$pass=$_POST['pass'];

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

$sql = "SELECT admin_name FROM admin_detail WHERE admin_name = '$name' AND admin_pass= '$pass';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $_SESSION['admin']=$row["admin_name"];
        echo "logged in";
    }
} else {
    echo "wrong password";
}
$conn->close();

?>