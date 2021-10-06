<?php  
session_start(); 
if(isset($_SESSION['admin_sid']) || isset($_SESSION['customer_sid']))
{
	header("location:index.php");
}
else{
	
?>
<?php include'includes/top.php';?>   
<br>
<br>
<br>
<form method="post" action="routers/register-router.php" class="login-form" id="formValidate">
    <div class="container-fluid">
      <div id="login-page" class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header">Register account</div>
                <div class="card-body" style="text-align:center;">
					
                    <div class="form-group row">
                        <label for="username" class="col-12">Username</label>
                        <div class="col-12">
                            <input name="username" pattern="[A-Za-z0-9]+" title="Username should only contain Upper/Lower case letters, and numbers" id="username" type="text" maxlength="20" required>
                        </div>
                    </div> 
					
					<div class="form-group row">
                        <label for="username" class="col-12">Name</label>
                        <div class="col-12">
                            <input name="name" pattern="[A-Za-z\s]+" title="Name shoul only contain Upper/Lower case letters" id="username" type="text" maxlength="20" required>
                        </div>
                    </div>
					
					<div class="form-group row">
                        <label for="username" class="col-12">Email</label>
                        <div class="col-12">
                            <input name="email"  title="example@email.domain" id="username" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100" required>
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
                            <input name="phone"  id="username" type="text" title="please enter a valid UK phone number"
								   pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" maxlength="11" required>
                        </div>
                    </div>
					
					<div class="form-group row">
                        <label for="username" class="col-12">Address</label>
                        <div class="col-12">
                            <input name="address"  id="username" type="text" maxlength="100" required>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
						<div class="col-12">
							<button class="btn waves-effect waves-light col-2" type="submit" name="action">Submit</button>
						</div>
                    </div>
					
                    <div class="form-group row">
						<div class="col-12">
							<p class="margin medium-small" style="text-align:center;">Already have an account?</p>
							<p class="margin medium-small" style="text-align:center;"><a href="login.php" style="color: #121212">Login Now!</a></p>
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
                minlength: 5
            },
            name: {
                required: true,
                minlength: 5				
            },
			password: {
				required: true,
				minlength: 5
			},
            phone: {
				required: true,
				minlength: 4
			},
        },
        messages: {
            username: {
                required: "Enter username",
                minlength: "Minimum 5 characters are required."
            },
            name: {
                required: "Enter name",
                minlength: "Minimum 5 characters are required."
            },
			password: {
				required: "Enter password",
				minlength: "Minimum 5 characters are required."
			},
            phone:{
				required: "Specify contact number.",
				minlength: "Minimum 4 characters are required."
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
?>