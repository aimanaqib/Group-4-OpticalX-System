<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   

?>
<title>Trashed Admin</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="super_admin_view_profile_wrapper">

		<div class="admin_title">
			<p>Trashed Admin</p>
		</div>
		
		<div class="view_admin_prouct_top_title">
			
			<ul class="top_btn_view_product">
				<li class="admin_view_prod_link_trashed">
					<a href="super_admin_view_admin.php?admin=1" />View Admin Details</a>
				</li>
			</ul>
		</div>
		
		
		<div class="admin_search_admin">
			<ul class="admin_wrapper">
						
			</ul>
		</div>
		
		<div class="super_admin_view_profile_small_wrapper">

				<?php
				
				$result = mysqli_query($conn, "select * from admin where admin_trash = '1'");
				$count=mysqli_num_rows($result);
				
				if($count>=1)
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
					
					<ul class="super_admin_view_profile_ss_wrapper"> 
						<li class="super_admin_view_profile">Action </li>
						<li class="super_admin_view_profile_special">:</li> 
						<li class="super_admin_view_profile_detail"><a href = "super_admin_trashed_admin.php?adminid=<?php echo $row['admin_id']; ?>" onclick="return restore_confirmation();">Restore</a></li>
					</ul>
					
					<div class="super_admin_hr"></div>
					
					</form>
					
					<?php
					
					}	
				}
				else
				{
					?>
						<div class="no_trashed_admin">No Trashed Record</div>
					<?php
				}
					?>
		</div>
	</div>
</div>

<script type="text/javascript">

function restore_confirmation()
{
		answer = confirm("Are you sure want to Restore this Admin?");
		return answer;
}
</script>

<?php
	
if (isset($_REQUEST["adminid"])) 
{	$admin_id = $_REQUEST["adminid"]; 

	mysqli_query($conn, "update admin set admin_trash ='0' where admin_id = $admin_id");
	
	echo "<SCRIPT type='text/javascript'> 
        alert('Admin has been Restore');
        window.location.replace(\"super_admin_trashed_admin.php\");
		</SCRIPT>";
}

?>
