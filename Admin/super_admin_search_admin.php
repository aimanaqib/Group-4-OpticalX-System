<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   

?>
<title>Search Admin</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="super_admin_view_profile_wrapper">

		<div class="admin_title">
			<p>View Admin Details</p>
		</div>
		
		<div class="admin_search_admin">
				<form name="admin_search" action="super_admin_search_admin.php" method="post">
					<ul class="super_admin_wrapper_search">
						<li class="admin_top_search_left">
							<input type="text" name="search" class="admin_top_searching_bar" placeholder="search by admin name">
						</li>
						<li class="admin_top_search_right">
							<button type="submit" name="search_btn" class="super_admin_search_admin">	
								<img src="../images/admin/search.png" class="imgase_search"/>
							</button>
						</li>
					</ul>
				</form>
		</div>
		<div class="super_admin_view_profile_small_wrapper">
<?php
if(isset($_POST['search_btn']))
{ 
   $search = $_POST['search'];		
	$result = mysqli_query($conn, "select * from admin where admin_name like '%$search%' and admin_trash = '0' ");
    $count = mysqli_num_rows($result);
   if($count == 0) 
   { 
	?>
		<div class="no_record">No Record Found</div>
	<?php
   }
   else
   {		
				
	while($row = mysqli_fetch_assoc($result))
	{
				
				?>		
				<form name="new_admin" method="post" action="">
				
				<ul class="super_admin_view_profile_ss_wrapper">
					<li class="super_admin_view_profile">Image </li> 
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"><img src="../<?php echo $row["admin_image"]; ?>"></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper">
					<li class="super_admin_view_profile">Name </li> 
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_name"]; ?></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">Email </li>
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_email"]; ?></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">Gender </li>
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_gender"]; ?></li>
				</ul>
	
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">Date of Birth </li>
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_date"]; ?></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper">
					<li class="super_admin_view_profile">Phone No. </li>
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> &plus;60<?php echo $row["admin_phone"]; ?></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">Address</li> 
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_address"]; ?></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">Postcode </li>
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_postcode"]; ?></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">City </li>
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_city"]; ?></li>
				</ul>
				
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">State </li>
					<li class="super_admin_view_profile_special">:</li> 
					<li class="super_admin_view_profile_detail"> <?php echo $row["admin_state"]; ?></li>
				</ul>
				
				<?php
				if($row["admin_id"] !=1)
				{					
				?>
				<ul class="super_admin_view_profile_ss_wrapper"> 
					<li class="super_admin_view_profile">Action </li>
					<li class="super_admin_view_profile_special">:</li> 
					<a href = "super_admin_view_Admin.php?admin_id=<?php echo $row['admin_id']; ?>" onclick="return confirmation();">Trash</a>
				</ul>
				<?php
				}
				?>					
				
				<div class="super_admin_hr"></div>
				
				</form>
				
				<?php
				
	}
				
   }
}   
				?>
		</div>
	</div>
</div>

