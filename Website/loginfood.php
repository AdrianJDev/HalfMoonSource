<?php
include 'includes/connect.php';


	if($_SESSION['customer_sid']==session_id())
	{
		$result = mysqli_query($con,"SELECT name FROM users");
		?>
<?php include'includes/top.php';?>   
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

<div class="container" style="color:white;">
    <br><br>
		  <form class="formValidate" id="formValidate" method="post" action="place-order.php" novalidate="novalidate">
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="header">Order Food</h4>
              </div>
<div class="table-responsive">
    <table id="data-table-customer" class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Item Price/Piece</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>

                    <tbody>
				<?php
				$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
				while($row = mysqli_fetch_array($result))
				{
					echo '<tr><td>'.$row["name"].'</td><td>£'.$row["price"].'</td>';                      
					echo '<td><div class="input-field col s12"><label for='.$row["id"].' class="">Quantity &nbsp;</label>';
					echo '<input id="'.$row["id"].'" name="'.$row['id'].'" type="number" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td></tr>';
				}
				?>
                    </tbody>
    </table>
	<div class="container-fluid col-12"><label for="description" class="">Any note(optional)</label></div>
		<div class="input-field col-12">
              <textarea id="description" name="description" class="materialize-textarea"></textarea>
		</div>
</div>

    <div class="input-field col s12"><br>
        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Order
        </button>
        <br>
        <br>
        <br>
    </div>
</form>
</div>
</div>


    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
			while($row = mysqli_fetch_array($result))
			{
				echo $row["id"].':{
				min: 0,
				max: 10
				},
				';
			}
		echo '},';
		?>
        messages: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
			while($row = mysqli_fetch_array($result))
			{  
				echo $row["id"].':{
				min: "Minimum 0",
				max: "Maximum 10"
				},
				';
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
<?php include'includes/bot.php';?>   