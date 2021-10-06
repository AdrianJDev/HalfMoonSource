<?php
include 'includes/connect.php';
include 'includes/wallet.php';

	if($_SESSION['customer_sid']==session_id())
	{
?>
<?php include'includes/top.php';?>   
<br>
<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown">Profile</a>
            <div class="dropdown-menu">
				<a class="dropdown-item" href="details.php">Edit Account Details</a>
                <a class="dropdown-item" href="routers/logout.php">Logout</a>
            </div>
    </li>
    
    <li class="nav-item">
        <a href="loginfood.php" class="nav-link active">Menu</a>
    </li>
    
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle active" data-toggle="dropdown">Orders</a>
        <div class="dropdown-menu">
            <a href="orders.php" class="dropdown-item">Past Orders</a>
			<?php
					$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE user_id = $user_id;");
			?>
        </div>
    </li>
</ul>

        <!--start container-->
<div class="container" style="color: #fff;">
	<div id="work-collections" class="seaction">
             
					<?php
					if(isset($_GET['status'])){
						$status = $_GET['status'];
					}
					else{
						$status = '%';
					}
					$sql = mysqli_query($con, "SELECT * FROM orders WHERE user_id = $user_id AND status LIKE '$status';;");
					echo '  <div class="row">
					<div class="container">
					<br>
                    <h1 class="header">List</h1>
                    <ul id="issues-collection" class="collection">
					<p class="caption">List of your past orders with details</p><br>';
					while($row = mysqli_fetch_array($sql))
					{
						$status = $row['status'];
						echo '
                              <h2>Order No. '.$row['id'].'</h2>
							  <p><strong>Table Number: </strong>'.$row['tablenumber'].'</p>							  
                              <p><strong>Status: </strong> '.($status=='Paused' ? 'Paused <a  data-position="bottom" data-delay="50" data-tooltip="Please contact administrator for further details." class="btn-floating waves-effect waves-light tooltipped cyan">Â Â Â Â ?</a>' : $status).'</p>							  
							  '.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'						                               
							  <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li>							<hr class="style1" style="width:100%;">';
						$order_id = $row['id'];
						$sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
						while($row1 = mysqli_fetch_array($sql1))
						{
							$item_id = $row1['item_id'];
							$sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
							while($row2 = mysqli_fetch_array($sql2)){
								$item_name = $row2['name'];
							}
							echo '
                            <div class="row">
                            <div class="col s7">
                            <p class="collections-title"><strong>#'.$row1['item_id'].'</strong> '.$item_name.'</p>
                            </div>
                            <div class="col s2">
                            <span>'.$row1['quantity'].' Pieces</span>
                            </div>
                            <div class="col s3">
                            <span>£ '.$row1['price'].'</span>
                            </div>
                            </div>';
							$id = $row1['order_id'];
						}
								echo'
                                        <div class="row">
                                            <div class="col-8">
                                                <p class="collections-title"> Total</p>
                                            </div>
                                            <div class="col-2">
                                                <span><strong>£ '.$row['total'].'</strong></span>
                                            </div>';
								if(!preg_match('/^Cancelled/', $status)){
									if($status != 'Delivered'){
								echo '<form action="routers/cancel-order.php" method="post">
										<input type="hidden" value="'.$id.'" name="id">
										<input type="hidden" value="Cancelled by Customer" name="status">	
										<input type="hidden" value="'.$row['payment_type'].'" name="payment_type">											
										<button class="btn waves-effect waves-light right submit" type="submit" name="action">Cancel Order
										</button>
										</form>';
								}
								}
								echo'</div><hr class="style1" style="width:100%;"></li><br>';

					}
					?>
                </div>
              </div>
              </div>
              </div>

<?php include'includes/bot.php';?>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:all-orders.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>