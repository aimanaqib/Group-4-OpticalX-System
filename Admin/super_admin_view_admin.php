<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   

?>
<title>View Admin</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="super_admin_view_profile_wrapper">

		<div class="admin_title">
			<p>View Admin Details</p>
		</div>
		
		<div class="view_admin_prouct_top_title">
			
			<ul class="top_btn_view_product">
				<a href="super_admin_add_admin.php" />
					<li class="admin_view_prod_link">
						Add New Admin
					</li>
				</a>	
				
				<a href="super_admin_trashed_admin.php" />
					<li class="admin_view_prod_link">
						Trashed Admin
					</li>
				</a>
			</ul>
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
			<div class="super_admin_view_admin_xs_wrapper">
				<?php
				$page = $_GET["admin"];
					
				if($page == "" || $page == "1")
				{ $page1 = 0;
				}
				else
				{ $page1 = ($page-1)*1;
				}
					
				$result = mysqli_query($conn, "select * from admin where admin_trash = '0' limit $page1,1");
				
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
				$result_admin = mysqli_query($conn, "select * from admin where admin_trash = '0'");
				$count_admin = mysqli_num_rows($result_admin);
					
				$a = ceil($count_admin/1);
					
				?>
				<div class="pagination_wrapper_div">
					<ul class="pagination_padding">
						<?php
						for($b=1; $b<=$a; $b++)
						{ ?>
							<a href="super_admin_view_admin.php?admin=<?php echo $b; ?>">
								<li class="pagination">
									<?php echo $b. " " ?>
								</li>
							</a>
						 <?php
					}					
					?>
					</ul>
				</div>
		</div>
	</div>
</div>

<?php

	
if (isset($_REQUEST["admin_id"])) 
{	$admin_id = $_REQUEST["admin_id"]; 
	mysqli_query($conn, "update admin set admin_trash='1' where admin_id = $admin_id");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Admin has been Trash');
        window.location.replace(\"http://localhost/fyp/Admin/super_admin_view_admin.php?admin=1\");
		</SCRIPT>";
}

?>

<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to trash this Admin?");
		return answer;
}
</script>