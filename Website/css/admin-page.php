<?php include'includes/top.php';?>
<?php include 'includes/connect.php';


	if($_SESSION['admin_sid']==session_id())
	{
		?>


<br>
<div class="container-fluid">
	<div class="col-12">
	<div class="page-header">
        <h1>Hi, <b><?php echo $role?></b></h1>
    </div>
	</div>
</div>
<br><br>

<div id="container-fluid">
    <div class="row">
        <div class="col-12 ml-3">
        <div class="btn-group btn-block">
            <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="routers/logout.php">Logout</a>
                </div>
            </div>
            
            <a href="index.php" class="btn btn-primary">Food Menu</a>

            <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Orders
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="all-orders.php" class="dropdown-item">All Orders</a>
                    <?php
                        $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
                        while($row = mysqli_fetch_array($sql)){
                        echo '<a class="dropdown-item" href="all-orders.php?status='.$row['status'].'">'.$row['status'].'</a>'; }
                    ?>
                </div>
            </div>
            
            <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tickets
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="all-orders.php" class="dropdown-item">All tickets</a>
                    <?php
                        $sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets;");
				        while($row = mysqli_fetch_array($sql)){
                        echo '<a class"dropdown-item" href="all-tickets.php?status='.$row['status'].'">'.$row['status'].'</a>';}
				    ?>
                </div>
            </div>
	
            <button href="users.php" class="btn btn-primary">Users</button>
        
            <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </div>
    </div>     
</div>
</div>

        <!--breadcrumbs start-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-auto">
            <form class="formValidate" id="formValidate" method="post" action="routers/menu-router.php" novalidate="novalidate">
                <table id="data-table-admin" class="responsive-table display" cellspacing="0">
                    <h5 class="breadcrumbs-title">Food Menu</h5>
                    <p class="caption">Add, Edit or Remove Menu Items.</p>
                    <h4 class="header">Order Food</h4>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Item Price/Piece</th>
                                <th>Available</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $result = mysqli_query($con, "SELECT * FROM items");
                                while($row = mysqli_fetch_array($result))
                                {
                                    echo '<tr><td><div class="input-field col s12"><label for="'.$row["id"].'_name"></label>';
                                    echo '<input value="'.$row["name"].'" id="'.$row["id"].'_name" name="'.$row['id'].'_name" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';					
                                    echo '<td><div class="input-field col s12 "><label for="'.$row["id"].'_price"></label>';
                                    echo '<input value="'.$row["price"].'" id="'.$row["id"].'_price" name="'.$row['id'].'_price" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';                   
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
                      <div class="input-field col s12">
                                      <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Modify
                                        <i class="mdi-content-send right"></i>
                                      </button>
                                    </div>
            </div>
                    </form>
                  <form class="formValidate" id="formValidate1" method="post" action="routers/add-item.php" novalidate="novalidate">
                    <div class="row">
                      <div class="col s12 m4 l3">
                        <h4 class="header">Add Item</h4>
                      </div>
                      <div>
        <table>
                            <thead>
                              <tr>
                                <th data-field="id">Name</th>
                                <th data-field="name">Item Price/Piece</th>
                              </tr>
                            </thead>

                            <tbody>
                        <?php
                            echo '<tr><td><div class="input-field col s12"><label for="name">Name</label>';
                            echo '<input id="name" name="name" type="text" data-error=".errorTxt01"><div class="errorTxt01"></div></td>';					
                            echo '<td><div class="input-field col s12 "><label for="price" class="">Price</label>';
                            echo '<input id="price" name="price" type="text" data-error=".errorTxt02"><div class="errorTxt02"></div></td>';                   
                            echo '<td></tr>';
                        ?>
                            </tbody>
        </table>
                      </div>
                      <div class="input-field col s12">
                                      <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Add
                                        <i class="mdi-content-send right"></i>
                                      </button>
                                    </div>
                    </div>
                    </form>			
                    <div class="divider"></div>

          </div>
        <!--end container-->
    </div>
      <!-- END CONTENT -->
</div>
    <!-- END WRAPPER -->


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
		if($_SESSION['customer_sid']==session_id())
		{
			header("location:index.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>