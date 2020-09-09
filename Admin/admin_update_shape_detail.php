<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$shape_id = $_REQUEST["shapeid"];
$result = mysqli_query($conn, "select * from shape where shape_id = $shape_id");
$row = mysqli_fetch_assoc($result);
?>
<title>Update Shape Detail</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_edit_colour_wrapper">
		<div class="admin_title">
			Update Shape
		</div>
		
		<div class="admin_add_new_colour">
			<form name="admin_add_colour" method="post" action="">
	
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Shape Name</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="update_shape_name" value="<?php echo $row['shape_content'];?>" class="input_colour" required>
				</div>
			</div>
			
			
				<p><input type="submit" name="update_shape_btn" Value="UPDATE" class="colour_btn"></p>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST["update_shape_btn"]))
{	
	$shape_name = $_POST["update_shape_name"];    		

	$colour_update_result = mysqli_query($conn,"update shape set shape_content='$shape_name' where shape_id = $shape_id");			
	
	echo "<SCRIPT type='text/javascript'>
        alert('Shape Updated');
        window.location.replace(\"admin_view_shape.php?page=1\");
    </SCRIPT>";
}
?>