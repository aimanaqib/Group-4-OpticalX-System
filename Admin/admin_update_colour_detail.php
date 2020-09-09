<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$colourid = $_REQUEST["colourid"];
$result = mysqli_query($conn, "select * from colour where colour_id = $colourid");
$row = mysqli_fetch_assoc($result);
?>
<title>Update Colour Detail</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_edit_colour_wrapper">
		<div class="admin_title">
			Update Colour
		</div>
		
		<div class="admin_add_new_colour">
			<form name="admin_add_colour" method="post" action="">
	
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Colour Name</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="update_colour_name" value="<?php echo $row['colour_name'];?>" class="input_colour" required>
				</div>
			</div>
			
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Colour Code</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="update_colour_code" value="<?php echo $row['colour_code'];?>" max="6" class="input_colour" required>
				</div>
				
			</div>
			
				<p><input type="submit" name="update_colour_btn" Value="UPDATE" class="colour_btn"></p>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST["update_colour_btn"]))
{	
	$colour_name = $_POST["update_colour_name"];    		
	$colour_code = $_POST["update_colour_code"]; 

	$colour_update_result = mysqli_query($conn,"update colour set colour_name='$colour_name',colour_code='$colour_code' where colour_id = $colourid");			
	
	echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('Colour Updated');
        window.location.replace(\"admin_view_colour.php?page=1\");
    </SCRIPT>";
}
?>