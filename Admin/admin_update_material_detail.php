<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$materialid = $_REQUEST["materialid"];
$result = mysqli_query($conn, "select * from material where material_id = $materialid");
$row = mysqli_fetch_assoc($result);
?>
<title>Update Material Detail</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_edit_colour_wrapper">
		<div class="admin_title">
			Update Material
		</div>
		
		<div class="admin_add_new_colour">
			<form name="admin_add_colour" method="post" action="">
	
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Material Name</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="update_material_name" value="<?php echo $row['material_name'];?>" class="input_colour" required>
				</div>
			</div>
			
			
				<p><input type="submit" name="update_material_btn" Value="UPDATE" class="colour_btn"></p>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST["update_material_btn"]))
{	
	$material_name = $_POST["update_material_name"];    		

	$colour_update_result = mysqli_query($conn,"update material set material_name='$material_name' where material_id = $materialid");			
	
	echo "<SCRIPT type='text/javascript'>
        alert('Material Updated');
        window.location.replace(\"admin_view_material.php?page=1\");
    </SCRIPT>";
}
?>