<?php
include 'includes/connect.php';
include 'includes/wallet.php';

$continue=0;
$total = 0;
if($_SESSION['customer_sid']==session_id())
{
		if($_POST['payment_type'] == 'Wallet'){
		$_POST['cc_number'] = str_replace('-', '', $_POST['cc_number']);
		$_POST['cc_number'] = str_replace(' ', '', $_POST['cc_number']); 
		$_POST['cvv_number'] = (int)str_replace('-', '', $_POST['cvv_number']);
		$sql1 = mysqli_query($con, "SELECT * FROM wallet_details where wallet_id = $wallet_id");
		while($row1 = mysqli_fetch_array($sql1)){
			$card = $row1['number'];
			$cvv = $row1['cvv'];
			if($card == $_POST['cc_number'] && $cvv==$_POST['cvv_number'])
			$continue=1;
			else
				header("location:index.php");
		}
		}
		else
			$continue=1;
}

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
	$name = $row['name'];
}

if($continue){
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
					$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE customer_id = $user_id;");
			?>
        </div>
    </li>
</ul>
<br>
      <!-- START CONTENT -->
      <section id="content">
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
		  
<div class="container" style="color: #fff;">
<p class="caption">Receipt</p>

	<div id="work-collections" class="seaction">
	<ul id="issues-collection" class="collection">
	<?php
		echo '
			<p><strong>Name: </strong>'.$name.'</p>
			<p><strong>Table Number:</strong>'.$tablenumber.'</p>';

		foreach ($_POST as $key => $value)
		{
			if(is_numeric($key)){		
			$result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
			while($row = mysqli_fetch_array($result))
			{
				$price = $row['price'];
				$item_name = $row['name'];
				$item_id = $row['id'];
			}
				$price = $value*$price;
					echo '
			<div class="row">
				<div class="col s7">
					<p class="collections-title"><strong>#'.$item_id.' </strong>'.$item_name.'</p>
				</div>
				<div class="col s2">
					<span>'.$value.' Pieces</span>
				</div>
				<div class="col s3">
					<span>£'.$value*$price.'</span>
				</div>
			</div>';
			$total = $total + $price;
		}
		}
		echo '<div class="row">
				<div class="col s7">
					<p class="collections-title"> Total</p>
				</div>
				<div class="col s2">
					<span>&nbsp;</span>
				</div>
				<div class="col s3">
					<span><strong>£'.$total.'</strong></span>
				</div>
			</div>';
		if(!empty($_POST['description']))
			echo '<li class="collection-item avatar"><p><strong>Note: </strong>'.htmlspecialchars($_POST['description']).'</p></li>';
		if($_POST['payment_type'] == 'Wallet')
		echo '<div id="basic-collections" class="section">
			<div class="row">
				<div class="collection">
					<a href="#" class="collection-item">
						<div class="row"><div class="col s7">Current Balance</div><div class="col s3">'.$balance.'</div></div>
					</a>
					<a href="#" class="collection-item active">
						<div class="row"><div class="col s7">Balance after purchase</div><div class="col s3">'.($balance-$total).'</div></div>
					</a>
				</div>
			</div>
		</div>';
	?>
	<form action="routers/order-router.php" method="post">
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
		<div class="input-field col s12">
			<button class="btn cyan waves-effect waves-light right" type="submit" name="action" <?php if($_POST['payment_type'] == 'Wallet') {if ($balance-$total < 0) {echo 'disabled'; }}?>>Confirm Order
			</button>
		</div>
	</form>
</ul>
</section>
</div>
</div>

<?php include'includes/bot.php';?>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:admin-page.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>
