<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Update Image Detail</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_add_colour_wrapper">
	
		<div class="admin_title">
			Edit Image
		</div>
		<?php
		$imageid = $_REQUEST["imageid"];
		$result = mysqli_query($conn,"select * from image where image_id = $imageid");
		$row_image = mysqli_fetch_assoc($result);
		
		?>
		<div class="admin_add_new_colour">
			<form name="admin_add_colour" method="post" action="" enctype="multipart/form-data">
			<div class="admin_add_colour_small_wrapper">
				
				<img src="../<?php echo $row_image['image_img'] ?>" class="image_edit_img">
				<div class="add_colour_div1">
					<p class="admin_add_img_p">Image</p>
				</div>
				
				<div class="add_colour_div2">
				<input type="file"  name="admin_update_img" accept="image/*" onchange="preview_image(event)"><br>
				<span class="notification_color"><small>*recommend 800x800pixel Image</small></span>
				
				<div class="admin_Add_img_img"><img id="output_image"/></div>
				</div>
			</div>
			
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p class="admin_add_img_p">Product</p>
				</div>
				
				<div class="add_colour_div2">
					<select class="admin_add_new_product_input" name="admin_select_prod_id" required>
						<option value="" disabled selected>-- This Image For Product  --</option>
						<?php
							$result_product = mysqli_query($conn, "select * from product");
							while($row_product = mysqli_fetch_assoc($result_product))
							{
						?>
							
							<option value="<?php echo $row_product['product_id']; ?>"<?php if($row_product["product_id"] == $row_image["image_product_id"]) echo "selected" ?>><?php echo $row_product['product_id'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " . $row_product['product_name'] ?></option>
						<?php
							}
						?>
					</select>
				</div>
				
			</div>
			
				<p><input type="submit" name="edit_image_btn" Value="Update" class="colour_btn"></p>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST["edit_image_btn"])) 
{
	
	$img_prod_id = $_POST["admin_select_prod_id"];

	$check_record_database = "select *from image where image_product_id = '$img_prod_id' and image_trash='0' ";
	$result_check_record_database = mysqli_query($conn, $check_record_database);	
	if (mysqli_num_rows($result_check_record_database) < 4) 
		{	
			if($_FILES['admin_update_img']['name'] == "") {
				
				mysqli_query($conn,"update image set image_product_id='$img_prod_id' where image_id = $imageid");
				
			}
			else {
				$images = "images/product/".basename($_FILES['admin_update_img']['name']);
					
				mysqli_query($conn,"update image set  image_img = '$images', image_product_id = '$img_prod_id' where image_id = $imageid");
			}
			
			echo "<SCRIPT type='text/javascript'> //not showing me this
				alert('Detail Updated');
				window.location.replace(\"admin_view_Image.php?page=1\");
			</SCRIPT>";
		}
	else
		{
			echo "<SCRIPT type='text/javascript'> //not showing me this
				alert('You Have Already Reach The Limit <br/> (Limit = 4 image per product ) ');
				window.location.replace(\"admin_update_image_detail.php\");
			</SCRIPT>";
		}
	
}
?>

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