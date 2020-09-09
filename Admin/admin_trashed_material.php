<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Trashed Material</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Trashed Material
		</div>
		
		<ul class="btn_top_admin_view_colour">
			<a href="admin_view_material.php?page=1"/>
				<li class="admin_view_colour_link">
					View Material
				</li>
			</a>
		</ul>

		<div class="admin_view_colour_small_wrapper">
			
			<ul class="shape_title_ul">
				<li class="shape_title_li">Material ID</li>
				<li class="shape_title_li">Material Name</li>
				<li class="shape_title_li">Action</li>
			</ul>
			
			<?php
					
				$result_take = mysqli_query($conn, "select * from material where material_trash = '1'");
				
				$count=mysqli_num_rows($result_take);
				
				if($count>=1)
				{
					while($row_material = mysqli_fetch_assoc($result_take))
					{

				?>
					<ul class="shape_content_ul">
						<li class="shape_content_li"><?php echo $row_material["material_id"]; ?></li>
						<li class="shape_content_li"><?php echo $row_material["material_name"]; ?></li>
						<li class="shape_content_li">
							<a href = "admin_trashed_material.php?materialid=<?php echo $row_material['material_id']; ?>" onclick="return restore_confirmation();">Restore</a>
						</li>
					</ul>
				
				<?php
					}
				}
				else
				{
					?>
						<div class="no_record">No Trashed Shape</div>
					<?php
				}
			?>
		</div>
		
	</div>
</div>
<script type="text/javascript">

function restore_confirmation()
{
		answer = confirm("Are you sure want to Resore this Shape?");
		return answer;
}
</script>

<?php
	
if (isset($_REQUEST["materialid"])) 
{	$material_id = $_REQUEST["materialid"]; 

	mysqli_query($conn, "update material set material_trash ='0' where material_id = $material_id");
	
	echo "<SCRIPT type='text/javascript'> 
        alert('Material has been Restore');
        window.location.replace(\"admin_trashed_material.php\");
		</SCRIPT>";
}

?>