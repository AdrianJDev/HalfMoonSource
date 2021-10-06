<?php
include 'includes/connect.php';
$user_id = $_SESSION['user_id'];

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
$name = $row['name'];	
$address = $row['address'];
$contact = $row['contact'];
$email = $row['email'];
$username = $row['username'];
}
	if($_SESSION['chef_sid']==session_id())
	{
		?>
<?php include'includes/top.php';?>   
<br>
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
<br>
<br>
<br>
<form method="post" action="routers/detail-router-chef.php" class="login-form" id="formValidate">
    <div class="container-fluid">
      <div id="login-page" class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header">Edit Account Details</div>
                <div class="card-body" style="text-align:center;">
					
                    <div class="form-group row">
                        <label for="username" class="col-12">Username</label>
                        <div class="col-12">
                            <input name="username" pattern="[A-Za-z0-9]+" title="Username should only contain Upper/Lower case letters, and numbers" value="<?php echo $username; ?>" id="username" type="text" maxlength="20" required>
                        </div>
                    </div> 
					
					<div class="form-group row">
                        <label for="username" class="col-12">Name</label>
                        <div class="col-12">
                            <input name="name" pattern="[A-Za-z]+" title="Name should only contain Upper/Lower case letters" value="<?php echo $name; ?>" id="username" type="text" maxlength="20" required>
                        </div>
                    </div>
					
					<div class="form-group row">
                        <label for="username" class="col-12">Email</label>
                        <div class="col-12">
                            <input name="email" value="<?php echo $email; ?>" title="example@email.domain" id="username" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100" required>
                        </div>
                    </div>
					
					
                    <div class="form-group row">
                        <label for="password" class="col-12">Password</label>
                          <div class="col-12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter" name="password" id="password" type="password" maxlength="40" required>
                          </div>
                    </div>
					
					<div class="form-group row">
                        <label for="username" class="col-12">Contact</label>
                        <div class="col-12">
                            <input name="phone" value="<?php echo $contact; ?>" id="username" type="text" title="please enter a valid UK phone number"
								   pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" maxlength="11" required>
                        </div>
                    </div>
					
					<div class="form-group row">
                        <label for="username" class="col-12">Address</label>
                        <div class="col-12">
                            <input name="address" value="<?php echo $address; ?>" id="username" type="text" maxlength="100" required>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                    <div class="col-12">
                        <button class="btn waves-effect waves-light col-2" type="submit" name="action">Submit</button>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
<br>
<br>
<br>
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
				maxlength: 10
            },
            name: {
                required: true,
                minlength: 5,
				maxlength: 15
            },
            email: {
				required: true,
				maxlength: 35,
			},
			password: {
				required: true,
				minlength: 5,
				maxlength: 16,
			},
            phone: {
				required: true,
				minlength: 4,
				maxlength: 11
			},
			address: {
				required: true,
				minlength: 10,
				maxlength: 300
			},
        },
        messages: {
            username: {
                required: "Enter username",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 10 characters are required."				
            },
            name: {
                required: "Enter name",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 15 characters are required."
            },
            email: {
				required: "Enter email",
                maxlength: "Maximum 35 characters are required."				
			},
			password: {
				required: "Enter password",
				minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 16 characters are required."				
			},
            phone:{
				required: "Specify contact number.",
				minlength: "Minimum 4 characters are required.",
                maxlength: "Maximum 11 digits are accepted."				
			},	
            address:{
				required: "Specify address",
				minlength: "Minimum 10 characters are required.",
                maxlength: "Maximum 300 characters are accepted."				
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
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:admin-page.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>