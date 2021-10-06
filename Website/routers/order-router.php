<?php
include '../includes/connect.php';
include '../includes/wallet.php';
$total = 0;
$tablenumber = htmlspecialchars($_POST['tablenumber']);
$description =  htmlspecialchars($_POST['description']);
$total = $_POST['total'];
	$sql = "INSERT INTO orders (user_id, tablenumber, total, description) VALUES ($user_id, '$tablenumber', $total, '$description')";
	if ($con->query($sql) === TRUE){
		$order_id =  $con->insert_id;
		foreach ($_POST as $key => $value)
		{
			if(is_numeric($key)){
			$result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
			while($row = mysqli_fetch_array($result))
			{
				$price = $row['price'];
			}
				$price = $value*$price;
			$sql = "INSERT INTO order_details (order_id, item_id, quantity, price) VALUES ($order_id, $key, $value, $price)";
			$con->query($sql) === TRUE;		
			}
		}
			header("location: ../orders.php");
	}
if(mysqli_query($con, $sql)){
	header("location: ../admin-page.php");
    echo "Records added successfully.";
		}else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
?>