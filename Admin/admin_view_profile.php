<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$admin_id = $_SESSION["sess_adid"]; 

$result = mysqli_query($conn, "select * from admin where admin_id = $admin_id");
$row = mysqli_fetch_assoc($result);

?>
<title>View Profile</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_view_profile_wrapper">

		<div class="admin_title">
			<p>My Profile</p>
		</div>
		
		<div class="admin_view_profile_small_wrapper">

			<form name="new_admin" method="post" action="">
			
				<ul class="super_admin_view_profile_ss_wrapper">
					<li class="super_admin_view_profile">Image </li> 
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"><img src="../<?php echo $row["admin_image"]; ?>"></li>
				</ul>
				
				<ul class="admin_view_profile_ss_wrapper">
					<li class="admin_view_profile">Name </li> 
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_name"]; ?></li>
				</ul>
				
				<ul class="admin_view_profile_ss_wrapper"> 
					<li class="admin_view_profile">Email </li>
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_email"]; ?></li>
				</ul>
				
				<ul class="admin_view_profile_ss_wrapper"> 
					<li class="admin_view_profile">Gender </li>
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_gender"]; ?></li>
				</ul>
	
				<ul class="admin_view_profile_ss_wrapper"> 
					<li class="admin_view_profile">Date of Birth </li>
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_date"]; ?></li>
				</ul>
				
				<ul class="admin_view_profile_ss_wrapper">
					<li class="admin_view_profile">Phone No. </li>
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_phone"]; ?></li>
				</ul>
				
				<ul class="admin_view_profile_ss_wrapper"> 
					<li class="admin_view_profile">Address  </li> 
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_address"]; ?></li>
				</ul>
	
				<ul class="admin_view_profile_ss_wrapper"> 
					<li class="admin_view_profile">Postcode </li>
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_postcode"]; ?></li>
				</ul>
				
				<ul class="admin_view_profile_ss_wrapper"> 
					<li class="admin_view_profile">City </li>
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_city"]; ?></li>
				</ul>
				
				<ul class="admin_view_profile_ss_wrapper"> 
					<li class="admin_view_profile">State </li>
					<li class="admin_view_profile_special">:</li> 
					<li class="admin_view_profile_detail"> <?php echo $row["admin_state"]; ?></li>
				</ul>
				
			</form>

		</div>
	</div>
</div>

