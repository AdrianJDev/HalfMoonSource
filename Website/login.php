<?php  
session_start(); 
if(isset($_SESSION['customer_sid']))
{
	header("location:index.php");
}
else{
?>

<?php include'includes/top.php';?>   


<br>
<br>
<br>
<form method="post" action="routers/router.php" class="login-form" id="form">
    <div class="container-fluid">
      <div id="login-page" class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body" style="text-align:center;">
                    <div class="form-group row">
                        <label for="username" class="col-md-6 ml-5 col-form-label text-md-right">Username</label>
                        <div class="col-12">
                            <input name="username"  id="username" type="text" pattern="[A-Za-z0-9]{20}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-6 ml-5 col-form-label text-md-right">Password</label>
                          <div class="col-12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input pattern="[A-Za-z0-9]{20}" name="password" id="password" type="password" required>
                          </div>
                    </div>
                    
                    <div class="form-group row">
                    <div class="col-12">
                        <a href="javascript:void(0);" onclick="document.getElementById('form').submit();" class="btn waves-effect waves-light col s12" style="color: #121212">Login</a>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <div class="col-12">
                        <p class="margin medium-small" style="text-align:center;"><a href="register.php" style="color: #121212">Register Now!</a></p>
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
<?php include'includes/bot.php';?>   
<?php
}
?>