<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>

<title>Add Brand</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="add_new_product_wrapper">
	
		<div class="admin_title">
			<p>Add New Brand</p>
		</div>
		
		<div class="back_button_adding">
			<a href="admin_view_brand.php?page=1">View Brand</a>
		</div>
		
		<div class="admin_add_new_brand_small_wrapper">

			<form name="new_product" method="post" action="" enctype="multipart/form-data">
			
			<div class="admin_add_new_brand_ss_wrapper">
				<div class="admin_add_brand_div">Brand Images : </div>
				<input type="file"  name="admin_brand_img" class="admin_add_img" accept="image/*" onchange="preview_image(event)" required><br>
				<span class="notification_color notification_margin	"><small>*recommend 500x500pixel Image</small></span>
				<img id="output_image"/>
			
			</div>
				
			<div class="admin_add_new_brand_ss_wrapper">
				<div class="admin_add_brand_div">Brand Name : </div>
				<input type="text" class="admin_add_new_brand_input" name="admin_brand_name" required>
			</div>	

			<div class="admin_add_new_brand_ss_wrapper">
				<div class="admin_add_brand_div">Brand Top Sales : </div>
					<input type="radio" name="admin_brand_top" value="yes" required> Yes 
					<input type="radio" name="admin_brand_top" value="no"> No

			</div>			
			
			
			
			<div>
				<input type="submit" value="Add Brand" class="admin_add_brand_submit" name="admin_submit">
			</div>
			
			</form>

		</div>
	</div>
</div>

<script>
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

<?php

if (isset($_POST["admin_submit"])) 	
{
	$images = "images/brand/".basename($_FILES['admin_brand_img']['name']);
	$name = $_POST["admin_brand_name"];    		
	$top = $_POST["admin_brand_top"];
	$date = date("Y-m-d H:i:s");  
	
	$check_exist = "select * from brand where brand_name = '$name'"; 
	$result_check_exist = mysqli_query($conn, $check_exist);
	
	if (mysqli_num_rows($result_check_exist) != 0)
	{	
		echo "<SCRIPT type='text/javascript'>	
				alert('Brand Already Exist');        
				window.location.replace(\"admin_add_brand.php\");
			</SCRIPT>";
	}
	else
	{
		mysqli_query($conn,"insert into brand (brand_name,brand_image,brand_cooperation_date,brand_trash,brand_top) values ('$name','$images','$date','0','$top')");
		
		echo "<SCRIPT type='text/javascript'>
				alert('Brand Added');        
				window.location.replace(\"admin_view_brand.php?page=1\");
			</SCRIPT>";
		
	}
}
?>
