<?php include'includes/top.php';?> 
<?php
	$name = $_POST['fname'];
	$surname = $_POST['sname'];
	$email = $_POST['email'];
	$comment = $_POST['comments'];
	$formcontent =" From: $name \n Email: $email \n Comment: $comment";
	$recipient = "manege2618@iludir.com";
	$subject = "Contact Form";
	$mailheader = "From: $email \r\n";
	mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
?>
<br>
<br>
<br>
<div class="container-fluid">
	<div id="login-page" class="row justify-content-center" style="margin: 200px">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">Thank you for your message!</div>
			<div class="card-body" style="text-align:center;">
				<div class="form-group row">
					<div class="col-12">
						<p>We will be in touch soon.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<br>
<br>
<br>
<meta http-equiv="refresh" content="3;http://halfmoontearoom.infinityfreeapp.com/index.php" />
<?php include'includes/bot.php';?> 