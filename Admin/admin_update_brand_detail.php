<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$brandid = $_REQUEST["brandid"];
$result = mysqli_query($conn,"select * from brand where brand_id = $brandid");
$row = mysqli_fetch_assoc($result);

?>
<title>Update Brand Detail</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="add_edit_brand_wrapper">
		<div class="admin_title">
			<p>Update Brand</p>
		</div>
		
		<div class="add_edit_brand_small_wrapper">

			<form name="edit_brand" method="post" action="" enctype="multipart/form-data">
			
			<div class="admin_edit_brand_ss_wrapper">
				<div class="admin_edit_brand_title">Brand Images </div> <span class="admin_edit_brand_special">:</span>
				<img src="../<?php echo $row['brand_image'];?>" class="admin_edit_brand_title_img">
			</div>
				
			<input type="file"  name="admin_edit_brand_image" class="admin_edit_brand_change_image" accept="image/*" onchange="preview_image(event)" ><br>
			<span class="notification_color notification_margin"><small>*recommend 500x500pixel Image</small></span>
			<img id="output_image"/>
			
			<div class="admin_edit_brand_ss_wrapper">	
				<div class="admin_edit_brand_title">Brand Name </div> <span class="admin_edit_brand_special">:</span>
				<input type="text" class="admin_edit_brand_input" name="admin_brand_name" value="<?php echo $row['brand_name'];?>" required>
			</div>

			<div class="admin_edit_brand_ss_wrapper">
				<div class="admin_edit_brand_title">Brand Cooperation Date</div> <span class="admin_edit_brand_special">:</span>
				<?php echo $row['brand_cooperation_date'];?>
			</div>
									
			<div class="admin_edit_brand_ss_wrapper">
				<div class="admin_edit_brand_title">Brand Top Sales</div> <span class="admin_edit_brand_special">:</span>
					<input type="radio" name="admin_brand_top" value="yes" <?php if($row["brand_top"] == "yes") echo "checked";?>> Yes
					<input type="radio" name="admin_brand_top" value="no" <?php if($row["brand_top"] == "no") echo "checked";?>> No
			</div>


				<p><input type="submit" value="Update" class="admin_edit_brand_submit" name="savebtn" onclick="reloadpage()"></p>
			</form>

		</div>
	</div>
</div>


<?php

if (isset($_POST["savebtn"]))
{	
	$brand_name = $_POST["admin_brand_name"];    		
	$brand_top = $_POST["admin_brand_top"];
	
	if($_FILES['admin_edit_brand_image']['name'] == "") {
		$ad_update_result = mysqli_query($conn,"update brand set brand_name='$brand_name',brand_top='$brand_top' where brand_id = $brandid");	
	}
	else{
		$images = "images/brand/".basename($_FILES['admin_edit_brand_image']['name']);  		
		$ad_update_result = mysqli_query($conn,"update brand set brand_image='$images',brand_name='$brand_name',brand_top='$brand_top' where brand_id = $brandid");			
	}
	
	if($ad_update_result !=''){
		echo '<script language="javascript">';
		echo 'alert("Brand Updated")';
		echo '</script>';
	}
	
	echo "<script>location.href='admin_view_brand.php?page=1'</script>";
	
	?>

	
	<?php
}
?>

<script>

function reloadpage() {
	location.reload(true)
}


function preview_image(event) 
{
	var reader = new FileReader();
	reader.onload = function()
{
	var output = document.getElementById('output_image');
	output.src = reader.result;
}
	reader.readAsDataURL(event.target.files[0]);
}
</script>