<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Trashed Image</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Trashed Image
		</div>
		<ul class="btn_top_admin_view_colour">
			<a href="admin_view_image.php?page=1" />
				<li class="admin_view_colour_link">
					View Image
				</li>
			</a>
		</ul>
		
		<div class="admin_view_colour_small_wrapper">
			
			<ul class="colour_title_ul">
				<li class="colour_title_li">Image ID</li>
				<li class="colour_title_li"></li>
				<li class="colour_title_li">Product ID</li>
				<li class="colour_title_li">Action</li>
			</ul>
			
			<?php
					
				$result_take = mysqli_query($conn, "select * from image where image_trash = '1'");
				
				$count=mysqli_num_rows($result_take);
				
				if($count>=1)
				{
					while($row_image = mysqli_fetch_assoc($result_take))
					{

				?>
					<ul class="colour_content_ul">
						<li class="colour_content_li"><?php echo $row_image["image_id"]; ?></li>
						<li class="colour_content_li"><img src="../<?php echo $row_image['image_img']; ?>" class="admin_view_manage_image_img"></li>
						<li class="colour_content_li"><?php echo $row_image["image_product_id"]; ?></li>
						<li class="colour_content_li">
							<a href = "admin_trashed_image.php?imageid=<?php echo $row_image['image_id']; ?>">Recover</a></a>
						</li>

					</ul>
				
				<?php
					}
				}
				else
				{
					?>
						<div class="no_record">No Image</div>
					<?php
				}
			?>
		</div>
		
	</div>
</div>
<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to Recover this Image?");
		return answer;
}
	
</script>
<?php

	
if (isset($_REQUEST["imageid"])) 
{	
	$imgid = $_REQUEST["imageid"];
	$check_record_database = "select *from image where image_product_id =$imgid and image_trash='0' ";
	$result_check_record_database = mysqli_query($conn, $check_record_database);
	
	if (mysqli_num_rows($result_check_record_database) < 4) 
		{
			$image_id = $_REQUEST["imageid"]; 
			mysqli_query($conn, "update image set image_trash='0' where image_id = $image_id");
			
			
			echo "<SCRIPT type='text/javascript'>
				alert('Image has been Recover');
				window.location.replace(\"admin_trashed_image.php\");
				</SCRIPT>";
		}
	else 
		{
			echo "<SCRIPT type='text/javascript'> //not showing me this
				alert('You Have Already Reach The Limit <br/> (Limit = 4 image per product ) ');
				window.location.replace(\"admin_trashed_image.php\");
			</SCRIPT>";
		}
}

?>