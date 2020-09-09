<?php include("connection.php"); ?>
<link type="text/css" rel="stylesheet" href="Css/style_admin.css">

<!DOCTYPE html>
<html>
<head><title>Admin Login</title>
</head>
<body>
 
<div class="admin_login_wrapper">

	<div class="admin_login_small_wrapper">
		<div class="login_company_logo">
			<img src="images/logo_opticalx.png">
		</div>
		
		<div class="admin_login_details">
			<form name="admin_login" method="post" action="">
				<p><input type="text" name="admin_name" class="admin_input" placeholder="Enter Admin Username"></p>
				<p><input type="password" name="admin_pass" class="admin_input" placeholder="Enter Admin Password"></p>
				<p><input type="submit" name="login_btn" class="admin_login_btn" value="Login"></p>
			</form>
		</div>
		
	</div>

</div>

</body>
</html>

<?php


if (isset($_POST["login_btn"])) 	
{
	$aname = $_POST["admin_name"];    		
	$apword = $_POST["admin_pass"]; 
	
	$result = mysqli_query($conn, "select * from admin where admin_name = '$aname' and admin_password = '$apword' and admin_trash = '0' ");
	$row = mysqli_fetch_assoc($result);
	
	if (mysqli_num_rows($result) != 1)
	{
	?>
		<script type = "text/javascript">
			alert("Wrong Username or Password");
		</script>
	<?php
	}
	else
	{
		$_SESSION["loggedin"] = 1;
		
		$_SESSION["sess_adid"] = $row["admin_id"];
		header("Location: admin_dashboard.php");	
	}
	
}
?>