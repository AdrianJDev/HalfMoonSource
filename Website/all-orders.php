<?php
session_start();
include'includes/top.php';

include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id())
	{
$result = mysqli_query($con,"SELECT name FROM users");
?>

<br>
<div class="container-fluid">
	<div class="col-12">
	<div class="page-header">
		<?php
        while($row = mysqli_fetch_field($result))
		{
			echo "<h1> Welcome: " . htmlspecialchars($_SESSION['name']) . "</h1>";
		}
		?>
    </div>
	</div>
</div>
<br><br>


<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown">Profile</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="routers/logoutmod.php">Logout</a>
            </div>
    </li>
    
    <li class="nav-item">
        <a href="users.php" class="nav-link active">Users</a>
    </li>
    
    <li class="nav-item">
        <a href="admin-page.php" class="nav-link active">Food Menu</a>
    </li>
    
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle active" data-toggle="dropdown">Orders</a>
        <div class="dropdown-menu">
            <a href="all-orders.php" class="dropdown-item">All Orders</a>
                <?php
                    $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
                    while($row = mysqli_fetch_array($sql)){
                    echo '<a class="dropdown-item" href="all-orders.php?status='.$row['status'].'">'.$row['status'].'</a>'; }
                ?>
        </div>
    </li>    
</ul>
<br>
<br>
      <!-- START CONTENT -->
      <section id="content" style="color:#fff;">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">All Orders</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
<div class="container">
    <p class="caption">List of orders by customers with details</p>
    <br>
            <div id="work-collections" class="seaction">         
					<?php
					if(isset($_GET['status'])){
						$status = $_GET['status'];
					}
					else{
						$status = '%';
					}
					$sql = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE '$status';");
					echo '<div class="row">
                <div class="container">
                    <ul id="issues-collection" class="collection" style="list-style: none;">';
					while($row = mysqli_fetch_array($sql))
					{
						$status = $row['status'];
						$deleted = $row['deleted'];
						echo '<li class="collection-item avatar">
                              <h3>Order No. '.$row['id'].'</h3>
                              <p><strong>Date:</strong> '.$row['date'].'</p>							  
							  <p><strong>Status:</strong> '.($deleted ? $status : '
							  <form method="post" action="routers/edit-orders.php">
							    <input type="hidden" value="'.$row['id'].'" name="id">
								<select name="status">
								<option value="Waiting to be Served!" '.($status=='Waiting Top be Served!' ? 'selected' : '').'>Waiting Top be Served!</option>
								<option value="Ordered!" '.($status=='Ordered!' ? 'selected' : '').'>Ordered!</option>
								<option value="In Kitchen!" '.($status=='In Kitchen!' ? 'selected' : '').'>In Kitchen!</option>
								<option value="Cancelled!" '.($status=='Cancelled!' ? 'selected' : '').'>Cancelled!</option>								
								</select>
							  ').'</p>
                              <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              
                              </li>';
                            if(!$deleted){
								echo '<button class="btn waves-effect waves-light left submit" type="submit" name="action">Change Status
                                              <i class="mdi-content-clear right"></i> 
										</button>
                                        <br><br>
										</form>';
								}
						$order_id = $row['id'];
						$customer_id = $row['customer_id'];
						$sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
						$sql3 = mysqli_query($con, "SELECT * FROM users WHERE id = $customer_id;");
							while($row3 = mysqli_fetch_array($sql3))
							{
							echo '<li class="collection-item avatar">
                            <h3>Contact Info</h3>
                            <div class="container-fluid">
							<p><strong>Name: </strong>'.$row3['name'].'</p>
							<p><strong>Table Number: </strong>'.$row['tablenumber'].'</p>	
							'.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'
                            </li>
                            <hr class="style1">';							
							}
						while($row1 = mysqli_fetch_array($sql1))
						{
							$item_id = $row1['item_id'];
							$sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
							while($row2 = mysqli_fetch_array($sql2))
								$item_name = $row2['name'];
							echo '<li class="collection-item">
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
                            </li>';
						}
								echo'<li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title"> Total</p>
                                            </div>
                                            <div class="col s2">
											<span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span><strong>£ '.$row['total'].'</strong></span>
                                                
                                            </div>
											';										

								echo'</div></li><hr class="style1"><br><br><br>';
					}
					?>
					</ul>
                </div>
              </div>
            </div>
        </div>
</section>
<?php include'includes/bot.php';?>
<?php
	}
	else
	{
		if($_SESSION['customer_id']==session_id())
		{
			header("location:orders.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>