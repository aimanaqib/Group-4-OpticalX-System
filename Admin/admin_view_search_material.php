<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>View Search Material</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Material
		</div>
		<ul class="btn_top_admin_view_colour">
			<a href="admin_add_material.php" />
				<li class="admin_view_colour_link">
					Add New Material
				</li>
			</a>
			
			<a href="admin_trashed_material.php" />
				<li class="admin_view_colour_link">
					Trashed Material
				</li>
			</a>
			
		</ul>
		
		<div class="admin_search_colour">
			<form name="colour_search" action="admin_view_search_material.php" method="post">
				<ul class="search_wrapper_colour">
					<li class="colour_top_search_left">
						<input type="text" name="search" autocomplete="off" class="colour_top_searching_bar" placeholder="search by material name and id">
					</li>
					<li class="colour_top_search_right">
						<button type="submit" name="search_btn" class="button_search_material">
							<img src="../images/admin/search.png" class="imgase_search"/>
						</button>
					</li>
				</ul>
			</form>
		</div>
		
		<div class="admin_view_colour_small_wrapper">
			<ul class="shape_title_ul">
				<li class="shape_title_li">Material ID</li>
				<li class="shape_title_li">Material Name</li>
				<li class="shape_title_li">Action</li>
			</ul>
			
<?php
if(isset($_POST['search_btn']))
{ 
   $search = $_POST['search'];
   $query = mysqli_query($conn, "select * from material where (material_id like '%$search%' and material_trash = '0') or (material_name like '%$search%' and material_trash = '0') ");
   $count = mysqli_num_rows($query);
   if($count == 0) 
   { 
	?>
		<div class="no_record">No Record Found</div>
	<?php
   }
   else
   {		
		while($row_material = mysqli_fetch_assoc($query))
		{
		?>
			<ul class="shape_content_ul">
						<li class="shape_content_li"><?php echo $row_material["material_id"]; ?></li>
						<li class="shape_content_li"><?php echo $row_material["material_name"]; ?></li>
						<li class="shape_content_li2">
							<a href = "admin_update_material_detail.php?materialid=<?php echo $row_material['material_id']; ?>">Edit</a></a>
						</li>
						
						<li class="shape_content_li2">
							<a href = "admin_view_material.php?materialid=<?php echo $row_material['material_id']; ?>" onclick="return confirmation();">Trash</a>
						</li>
			</ul>
				
		<?php
		}
	}
}
?>
	</div>
</div>
<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to trash this Material?");
		return answer;
}
	
</script>
<?php

	
if (isset($_REQUEST["materialid"])) 
{	$materialid = $_REQUEST["materialid"]; 
	mysqli_query($conn, "update material set material_trash='1' where material_id = $materialid");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Material has been Trash');
        window.location.replace(\"admin_view_material.php?page=1\");
		</SCRIPT>";
}

?>