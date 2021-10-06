<?php
session_start();
include'includes/top.php';

include 'includes/connect.php';

if($_SESSION['chef_sid']==session_id())
	{
$result = mysqli_query($con,"SELECT name FROM users");
?>

<br>
<section id="content" class="login-form" style="color:#fff;">
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

	<ul class="nav nav-tabs justify-content-center">
		<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle active" data-toggle="dropdown">Profile</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="details-chef.php">Edit Account Details</a>
				<a class="dropdown-item" href="routers/logoutmod.php">Logout</a>
			</div>
		</li>

		<li class="nav-item">
			<a href="cheffood.php" class="nav-link active">Food Menu</a>
		</li>

		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle active" data-toggle="dropdown">Orders</a>
			<div class="dropdown-menu">
				<a href="loginchef.php" class="dropdown-item">All Orders</a>
				<?php
				$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
				while($row = mysqli_fetch_array($sql)){
				echo '<a class="dropdown-item" href="loginchef.php?status='.$row['status'].'">'.$row['status'].'</a>'; }
				?>
			</div>
		</li>    
	</ul>

	<div class="container">
		<br><br>
		<div class="divider"></div>
		<!--editableTable-->
		<div id="editableTable" class="section";>
			<form class="formValidate" id="formValidate1" method="post" action="routers/menu-router-chef.php" novalidate="novalidate">
			<div class="row">
				<div class="col s12 m4 l3">
					<h4 class="header">All Tea Items</h4>
				</div>

				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Food Type</th>
								<th>Item Price/Piece</th>
								<th>Available</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$result = mysqli_query($con, "SELECT * FROM items ORDER BY foodtype, name");
							while($row = mysqli_fetch_array($result))
							{
							echo '<tr><td><div class="input-field col s12"><label for="'.$row["id"].'_name"></label>';
							echo '<input required value="'.$row["name"].'" id="'.$row["id"].'_name" name="'.$row['id'].'_name" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';

							echo '<td><select name="'.$row['id'].'_foodtype">
									<option value="Tea"'.($row['foodtype']=='Tea' ? 'selected' : '').'>Tea</option>
									<option value="Dessert"'.($row['foodtype']=='Dessert' ? 'selected' : '').'>Dessert</option>
									<option value="Side"'.($row['foodtype']=='Side' ? 'selected' : '').'>Side</option>
									</select></td>';

							echo '<td><div class="input-field col s12 "><label for="'.$row["id"].'_price"></label>';
							echo '<input required value="'.$row["price"].'" id="'.$row["id"].'_price" name="'.$row['id'].'_price" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>'; 

							echo '<td>';
							if($row['deleted'] == 0){
							$text1 = 'selected';
							$text2 = '';
							}
							else{
							$text1 = '';
							$text2 = 'selected';						
							}
							echo '<select name="'.$row['id'].'_hide">
							<option value="1"'.$text1.'>Available</option>
							<option value="2"'.$text2.'>Not Available</option>
							</select></td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="input-field col s12">
					<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update!
					<i class="mdi-content-send right"></i>
					</button>
				</div>
				</form>
				<div class="divider"></div>
			</div>
		</div>
	</div>
</section>
<br>
<section id="content" style="color:#fff;">
	<div class="container">
		<div class="section">
		<form class="formValidate" id="formValidate" method="post" action="routers/additem.php" novalidate="novalidate">
				<div class="col s12 m4 l3">
				<br>
				<h4 class="header">Add Item</h4>
				</div>
			<br>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th data-field="id">Name</th>
								<th data-field="foodtype">Food Type</th>
								<th data-field="name">Item Price/Piece</th>
								<th data-field="name">Avaliability</th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							echo '<tr><td><div class="input-field col s12"><label for="name"></label>';
							echo '<input id="name" name="name" type="text" pattern="[A-Za-z]+" title="Name should only contain Upper/Lower case letters" data-error=".errorTxt01" required><div class="errorTxt01"></div></td>';

							echo '<td><select name="foodtype">
								<option value="Tea">Tea</option>
								<option value="Dessert" selected>Dessert</option>
								<option value="Side">Side</option>
								</select></td>'; 

							echo '<td><div class="input-field col s12 "><label for="price" class=""></label>';
							echo '<input id="price" name="price" type="number" data-error=".errorTxt02" required><div class="errorTxt02"></div></td>';                   
							
							echo '<td><select name="'.$row['id'].'_deleted">
									<option value="1"'.($row['deleted'] ? 'selected' : '').'>Unavaliable</option>
									<option value="0"'.(!$row['deleted'] ? 'selected' : '').'>Avaliable</option>
									</select></td></tr>';	
							?>
						</tbody>
					</table>
				</div>	
			<div class="input-field col s12">
				<br>
					<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Add
					</button>
				<br>
			</div>
		<br>
		</form>		
	</div>
	</div>
</section>


<script type="text/javascript">
    $("#formValidate").validate({
        rules: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items");
			while($row = mysqli_fetch_array($result))
			{
				echo $row["id"].'_name:{
				required: true,
				minlength: 5,
				maxlength: 20 
				},';
				echo $row["id"].'_price:{
				required: true,	
				min: 0
				},';				
			}
		echo '},';
		?>
        messages: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items");
			while($row = mysqli_fetch_array($result))
			{  
				echo $row["id"].'_name:{
				required: "Ener item name",
				minlength: "Minimum length is 5 characters",
				maxlength: "Maximum length is 20 characters"
				},';
				echo $row["id"].'_price:{
				required: "Ener price of item",
				min: "Minimum item price is Rs. 0"
				},';				
			}
		echo '},';
		?>
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
    </script>
    <script type="text/javascript">
    $("#formValidate1").validate({
        rules: {
		name: {
				required: true,
				minlength: 5
			},
		price: {
				required: true,
				min: 0
			},
	},
        messages: {
		name: {
				required: "Enter item name",
				minlength: "Minimum length is 5 characters"
			},
		 price: {
				required: "Enter item price",
				minlength: "Minimum item price is Rs.0"
			},
	},
		errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
    </script>
<?php include'includes/bot.php';?>
<?php
	}
	else
	{
		if($_SESSION['waiter_sid']==session_id())
		{
			header("location:index.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>