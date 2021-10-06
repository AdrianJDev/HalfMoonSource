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

<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown">Profile</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="routers/logout.php">Logout</a>
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

<!--Start Section-->
<section id="content" style="color:#fff;">
	<!--Start Container-->
	<div class="container">
		
		<br><br>
			<div class="divider"></div>
		<div id="editableTable" class="section">
			
			<!--editable start-->
			<form class="formValidate" id="formValidate1" method="post" action="routers/user-router.php" novalidate="novalidate">
				<div class="row">
					<div class="col s12 m4 l3">
						<h4 class="header">List of users</h4>
						<p class="caption">Enable, Disable or Verify Users.</p>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th data-field="names">Name</th>
									<th data-field="email">Email</th>
									<th data-field="contact">Contact</th>
									<th data-field="role">Role</th>
									<th data-field="verified">Verified</th>
									<th data-field="deleted">Enable</th>					
								</tr>
							</thead>

							<tbody>
								<?php
									$result = mysqli_query($con, "SELECT * FROM users ORDER BY role, name;");
									while($row = mysqli_fetch_array($result))
									{
									echo '<tr><td><div class="input-field col s12"><label for="'.$row["id"].'_name"></label>';
									echo '<input value="'.$row["name"].'" id="'.$row["id"].'_name" name="'.$row['id'].'_name" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';

									echo '<td><div class="input-field col s12"><label for="'.$row["id"].'_email"></label>';
									echo '<input value="'.$row["email"].'" id="'.$row["id"].'_email" name="'.$row['id'].'_email" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';

									echo '<td><div class="input-field col s12"><label for="'.$row["id"].'_name"></label>';
									echo '<input value="'.$row["contact"].'" id="'.$row["id"].'_contact" name="'.$row['id'].'_contact" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';

									echo '<td><select name="'.$row['id'].'_role">
									<option value="Administrator"'.($row['role']=='Administrator' ? 'selected' : '').'>Administrator</option>
									<option value="Chef"'.($row['role']=='Chef' ? 'selected' : '').'>Chef</option>
									<option value="Waiter"'.($row['role']=='Waiter' ? 'selected' : '').'>Waiter</option>
									</select></td>';

									echo '<td><select name="'.$row['id'].'_verified">
									<option value="1"'.($row['verified'] ? 'selected' : '').'>Verified</option>
									<option value="0"'.(!$row['verified'] ? 'selected' : '').'>Not Verified</option>
									</select></td>';	
									echo '<td><select name="'.$row['id'].'_deleted">
									<option value="1"'.($row['deleted'] ? 'selected' : '').'>Disable</option>
									<option value="0"'.(!$row['deleted'] ? 'selected' : '').'>Enable</option>
									</select></td>';

									$key = $row['id'];
									$sql = mysqli_query($con,"SELECT * from wallet WHERE customer_id = $key;");
									if($row1 = mysqli_fetch_array($sql)){
									$wallet_id = $row1['id'];
									$sql1 = mysqli_query($con,"SELECT * from wallet_details WHERE wallet_id = $wallet_id;");
									if($row2 = mysqli_fetch_array($sql1)){
									$balance = $row2['balance'];
									}
									}		
									}
								?>
							</tbody>
						</table>
					</div>
					<div class="input-field col s12">
						<br>
						<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Modify
						<i class="mdi-content-send right"></i>
						<br>
						</button>
					</div>
				</div>
			</form>
</section>
		<br>
<section id="content" style="color:#fff;">
	<div class="container">
		<div class="section">
			<!--add user start-->
			<form class="formValidate" id="formValidate" method="post" action="routers/add-users.php" novalidate="novalidate">
				<div class="row">
					<div class="col s12 m4 l3">
						<br>
						<h4 class="header">Add User</h4>
					</div>
					<br>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th data-field="username">Username</th>
									<th data-field="password">Password</th>							
									<th data-field="name">Name</th>
									<th data-field="email">Email</th>
									<th data-field="contact">Phone number</th>
									<th data-field="role">Role</th>
									<th data-field="verified">Verified</th>
									<th data-field="deleted">Enable</th>		
								</tr>
							</thead>

							<tbody>
							<?php
								echo '<tr><td><input id="username" name="username" type="text" data-error=".errorTxt02" required><div class="errorTxt02"></div></td>';

								echo '<td><input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter" data-error=".errorTxt03" required><div class="errorTxt03"></div></td>';

								echo '<td><input id="name" name="name" type="text" data-error=".errorTxt04" required><div class="errorTxt04"></div></td>';

								echo '<td><input id="email" name="email" type="email" required></td>';

								echo '<td><input id="contact" name="contact" type="number" title="please enter a valid UK phone number"
								   pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" maxlength="11" data-error=".errorTxt05"><div class="errorTxt05" required></div></td>';  


								echo '<td><select name="role">
								<option value="Administrator">Administrator</option>
								<option value="Waiter" selected>Waiter</option>
								<option value="Chef" selected>Chef</option>
								</select></td>';

								echo '<td><select name="verified">
								<option value="1">Verified</option>
								<option value="0" selected>Not Verified</option>
								</select></td>';	

								echo '<td><select name="deleted">
								<option value="1">Disable</option>
								<option value="0" selected>Enable</option>
								</select></td></tr>';					
								?>
							</tbody>
						</table>
					</div>
					<div class="input-field col s12">
						<br>
							<button class="btn cyan waves-effect waves-light right" type="submit" name="action">Add
								<i class="mdi-content-send right"></i>
							</button>
						<br>
					</div>
				</div>
			<br>
			</form>			
			<div class="divider"></div>
		</div>
	</div>
</section>
<br>
<br>
<br>
<?php include 'includes/bot.php';?>

<!--form validation-->
<script type="text/javascript" src="js/custom-script.js">
    $("#formValidate").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
            },
            password: {
                required: true,
                minlength: 5,
            },
            name: {
                required: true,
                minlength: 5,
			},
            contact: {
                required: true,
                minlength: 4,			
		},
        messages: {
           username:{
                required: "Enter a username",
                minlength: "Enter at least 5 characters"
            },	
           password:{
                required: "Provide a prove",
                minlength: "Password must be atleast 5 characters long",
            },	
           address:{
                minlength: "Address must be atleast 10 characters long",		
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
<?php
	}
	else
	{
		if($_SESSION['customer_sid']==session_id())
		{
			header("location:index.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>