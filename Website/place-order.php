<?php
include 'includes/connect.php';
$continue=0;
$total = 0;
	if($_SESSION['customer_sid']==session_id())
	{
		$result1 = mysqli_query($con,"SELECT name FROM users");
		$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
		while($row = mysqli_fetch_array($result)){
		$user_id = $row['id'];
		$name = $row['name'];	
		$verified = $row['verified'];
		}
	}
?>

<?php include'includes/top.php';?>   
<br>
<div class="container-fluid">
		<div class="col-12">
			<div class="page-header">
			<?php
			while($row = mysqli_fetch_field($result1))
			{
			echo "<h1> Welcome: " . htmlspecialchars($_SESSION['name']) . "</h1>";
			}
			?>
			</div>
		</div>
</div>
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
					$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE user_id = $users_id;");
			?>
        </div>
    </li>
</ul>
      <!-- START CONTENT -->
      <section id="content">
<br>
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Provide Order Details</h5>
              </div>
            </div>
          </div>
        </div>
		  
        <div class="container"  style="color: #fff;">
          <p class="caption">Estimated Receipt</p>
          <!--editableTable-->
<div id="work-collections" class="seaction">
<ul id="issues-collection" class="collection">
<?php
	foreach ($_POST as $key => $value)
	{
		if($value == ''){
			break;
		}
		if(is_numeric($key)){
		$result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
		while($row = mysqli_fetch_array($result))
		{
			$price = $row['price'];
			$item_name = $row['name'];
			$item_id = $row['id'];
		}
			$price = $value * $price;
			$total = $total + $price;
			    echo '
        <div class="row">
            <div class="col s7">
                <p class="collections-title"><strong>#'.$item_id.' </strong>'.$item_name.'</p>
            </div>
            <div class="col s2">
                <span>'.$value.' Items</span>
            </div>
            <div class="col s3">
                <span>£'.$value * $price.'</span>
            </div>
        </div>';
		}
	}
    echo '
        <div class="row">
            <div class="col s7">
                <p class="collections-title"> Total</p>
            </div>
            <div class="col s2">
                <span>&nbsp;</span>
            </div>
            <div class="col s3">
                <span>£'.$total.'</span>
            </div>
        </div>'	;
		if(!empty($_POST['description']))
		echo '<p><strong>Note: </strong>'.htmlspecialchars($_POST['description']).'</p>';
?>
</ul>
	
		<div class="container col-12">
			<h4 class="header">Table Number</h4>
                <div class="card-panel">
                    <form class="formValidate col s12 m12 l6" id="formValidate" method="post" action="confirm-order.php" novalidate="novalidate">
						<br>
						<?php
							foreach ($_POST as $key => $value)
							{
								if(is_numeric($key)){
									echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
								}
							}
						?>
						<input type="hidden" name="tablenumber" value="<?php echo htmlspecialchars($_POST['tablenumber']);?>">
						<?php if (isset($_POST['description'])) { echo'<input type="hidden" name="description" value="'.htmlspecialchars($_POST['description']).'">';}?>
						<input type="hidden" name="total" value="<?php echo $total;?>">
                      <div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th data-field="tablenumber">Table Number</th>
								</tr>
							</thead>

							<tbody>
								<?php
								echo '<tr><td><select name="tablenumber">
									<option value="1">1</option>
									<option value="2" selected>2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">Table Five</option>
									<option value="6">Table Six</option>
									</select></td></tr>'; 
								?>
							</tbody>
						</table>
					  <?php
					  	foreach ($_POST as $key => $value)
						{
							if($key == 'action' || $value == ''){
								break;
							}
							echo '<input name="'.$key.'" type="hidden" value="'.$value.'">';
						}
					  ?>
					  <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Order</button>
                    </form>
                </div>
           </div>
      </div>
  </div>
</div>

		  
<?php include'includes/bot.php';?>   
		  