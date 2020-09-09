<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Add Shape</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_add_colour_wrapper">
	
		<div class="admin_title">
			Add New Shape
		</div>
		
		<div class="back_button_adding">
			<a href="admin_view_shape.php?page=1">View Shape</a>
		</div>
		
		<div class="admin_add_new_colour">
			<form name="admin_add_colour" method="post" action="">
			<div class="admin_add_colour_small_wrapper">
				<div class="add_colour_div1">
					<p>Shape Name</p>
				</div>
				
				<div class="add_colour_div2">
					<input type="text" name="new_shape_name" placeholder="Enter New Shape Name" class="input_colour" required>
				</div>
			</div>
			
			
				<p><input type="submit" name="new_shape_btn" Value="ADD Shape" class="colour_btn"></p>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST["new_shape_btn"])) 
{
	$shape_name=$_POST["new_shape_name"];

	$shape_sql = mysqli_query($conn,"select * from shape where shape_content = '$shape_name'"); 
	$count = mysqli_num_rows($shape_sql);
	if ( $count != 0) 
	{
		
		echo "<SCRIPT type='text/javascript'> //not showing me this
			alert('Shape Name already existed');
			window.location.replace(\"admin_add_shape.php\");
			</SCRIPT>";
	}
	elseif ($count == 0)
	{
		
	$result_insert = mysqli_query($conn,"insert into shape (shape_content,shape_trash) values ('$shape_name',0)");
	
	echo "<SCRIPT type='text/javascript'>
        alert('Shape Added');
        window.location.replace(\"admin_view_shape.php?page=1\");
		</SCRIPT>";
	}
}
?>