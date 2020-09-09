<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Add Material</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_add_colour_wrapper">
	
		<div class="admin_title">
			Add New Material
		</div>
		
		<div class="back_button_adding">
			<a href="admin_view_material.php?page=1">View Material</a>
		</div>
		
		<div class="admin_add_new_colour">
			<form name="admin_add_colour" method="post" action="">
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Material Name</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="new_material_name" placeholder="Enter New Material Name" class="input_colour" required>
				</div>
			</div>
			
			
				<p><input type="submit" name="new_material_btn" Value="ADD Shape" class="colour_btn"></p>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST["new_material_btn"])) 
{
	$material_name=$_POST["new_material_name"];

	$check_exist = "select * from material where material_name = '$material_name'"; 
	
	$result_check_exist = mysqli_query($conn, $check_exist);

	
	if (mysqli_num_rows($result_check_exist) != 0) 
	{
		
	echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Material Name already existed');
        window.location.replace(\"admin_add_material.php\");
    </SCRIPT>";


	}
	else
	{
	$result_insert = mysqli_query($conn,"insert into material (material_name,material_trash) values ('$material_name',0)");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Material Added');
        window.location.replace(\"admin_view_material.php?page=1\");
    </SCRIPT>";
	}
}
?>