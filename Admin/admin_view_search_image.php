<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>View Search Image</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Image
		</div>
		
		<ul class="btn_top_admin_view_colour">
			<a href="admin_add_image.php" />
				<li class="admin_view_colour_link">
					Add New Image
				</li>
			</a>
			
			<a href="admin_trashed_image.php" />
				<li class="admin_view_colour_link">
					Trashed Image
				</li>
			</a>
		</ul>
		
		<div class="admin_search_colour">
			<form name="colour_search" action="admin_view_search_image.php" method="post">
				<ul class="search_wrapper_colour">
					<li class="colour_top_search_left">
						<input type="text" name="search" autocomplete="off" class="colour_top_searching_bar" placeholder="search by product id">
					</li>
					<li class="colour_top_search_right">
						<button type="submit" name="search_btn" class="admin_colour_search	">
							<img src="../images/admin/search.png" class="imgase_search"/>
						</button>
					</li>
				</ul>
			</form>
		</div>
		
		<div class="admin_view_colour_small_wrapper">
			
			<ul class="colour_title_ul">
				<li class="colour_title_li">Image ID</li>
				<li class="colour_title_li"></li>
				<li class="colour_title_li">Product ID</li>
				<li class="colour_title_li">Action</li>
			</ul>
			
<?php
if(isset($_POST['search_btn']))
{ 
   $search = $_POST['search'];
   $query = mysqli_query($conn, "select * from image where image_product_id like '%$search%' and image_trash = '0'");
   $count = mysqli_num_rows($query);
   if($count == 0) 
   { 
	?>
		<div class="no_record">No Image</div>
	<?php
   }
   else
   {
	   while($row_image = mysqli_fetch_assoc($query))
		{
			?>
			<ul class="colour_content_ul">
				<li class="colour_content_li"><?php echo $row_image["image_id"]; ?></li>
				<li class="colour_content_li"><img src="../<?php echo $row_image['image_img']; ?>" class="admin_view_manage_image_img"></li>
				<li class="colour_content_li"><?php echo $row_image["image_product_id"]; ?></li>
				<li class="colour_content_li2">
					<a href = "admin_update_image_detail.php?imageid=<?php echo $row_image['image_id']; ?>">Edit</a></a>
				</li>
				<li class="colour_content_li2">
					<a href = "admin_view_image.php?imageid=<?php echo $row_image['image_id']; ?>" onclick="return confirmation();">Trash</a>
				</li>
			</ul>
			<?php
		}
	}
}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to trash this Image?");
		return answer;
}
	
</script>
<?php

	
if (isset($_REQUEST["imageid"])) 
{	$image_id = $_REQUEST["imageid"]; 
	mysqli_query($conn, "update image set image_trash='1' where image_id = $image_id");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Image has been Trash');
        window.location.replace(\"admin_view_image.php?page=1\");
		</SCRIPT>";
}

?>