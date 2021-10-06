<?php
define('DB_SERVER', 'sql112.epizy.com');
define('DB_SERVER_USER', 'epiz_28425586');
define('DB_SERVER_PASS', 'vrxS0BLwo0');
define('DB_DBNAME', 'epiz_28425586_halfmoon');

$db = mysqli_connect(DB_SERVER, DB_SERVER_USER, DB_SERVER_PASS, DB_DBNAME);
if($db === false){
    die("ERROR: Could not connect. " . $con->connect_error);
}


$name = $_POST['name'];
$price = $_POST['price'];
$deleted = $_POST['deleted'];
$foodtype = $_POST['foodtype'];
$sql = "INSERT INTO items (name, price, deleted, foodtype) VALUES ('$name', '$price', '$deleted', '$foodtype')";

if(mysqli_query($db, $sql)){
	header("location: ../admin-page.php");
    echo "Records added successfully.";
		}else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}

header("location: ../admin-page.php");
?>