<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Add Colour</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_add_colour_wrapper">
	
		<div class="admin_title">
			Add New Colour
		</div>
		
		<div class="back_button_adding">
			<a href="admin_view_colour.php?page=1">View Colour</a>
		</div>
		
		<div class="admin_add_new_colour">
			<form name="admin_add_colour" method="post" action="">
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Colour Name</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="new_colour_name" placeholder="Enter New Colour Name" class="input_colour" required>
				</div>
			</div>
			
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Colour Code</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="new_colour_code" placeholder="Enter New Colour Code" max="6" class="input_colour" required>
				</div>
				
			</div>
			
				<p><input type="submit" name="new_colour_btn" Value="ADD COLOUR" class="colour_btn"></p>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST["new_colour_btn"])) 
{
	$colour_name=$_POST["new_colour_name"];
	$colour_code=$_POST["new_colour_code"];

	$check_exist = "select * from colour where colour_name = '$colour_name' or colour_code = '$colour_code'"; 
	$result_check_exist = mysqli_query($conn, $check_exist);

	
	if (mysqli_num_rows($result_check_exist) != 0) 
	{
		
	echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Colour Code or Colour Name already existed');
        window.location.replace(\"admin_add_colour.php\");
    </SCRIPT>";


	}
	else
	{
	$result_insert = mysqli_query($conn,"insert into colour (colour_name,colour_code,colour_trash) values ('$colour_name','$colour_code',0)");
	
	
	echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Colour Added');
        window.location.replace(\"admin_view_colour.php?page=1\");
    </SCRIPT>";
	}
}
?>