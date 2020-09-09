<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Trashed Shape</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Trashed Shape
		</div>
		
		<ul class="btn_top_admin_view_colour">
			<a href="admin_view_shape.php?page=1" />
				<li class="admin_view_colour_link">
					View Shape
				</li>
			</a>
		</ul>

		<div class="admin_view_colour_small_wrapper">
			
			<ul class="shape_title_ul">
				<li class="shape_title_li">Shape ID</li>
				<li class="shape_title_li">Shape Name</li>
				<li class="shape_title_li">Action</li>
			</ul>
			
			<?php
					
				$result_take = mysqli_query($conn, "select * from shape where shape_trash = '1'");
				
				$count=mysqli_num_rows($result_take);
				
				if($count>=1)
				{
					while($row_shape = mysqli_fetch_assoc($result_take))
					{

				?>
					<ul class="shape_content_ul">
						<li class="shape_content_li"><?php echo $row_shape["shape_id"]; ?></li>
						<li class="shape_content_li"><?php echo $row_shape["shape_content"]; ?></li>
						<li class="shape_content_li">
							<a href = "admin_trashed_shape.php?shapeid=<?php echo $row_shape['shape_id']; ?>" onclick="return restore_confirmation();">Restore</a>
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
	
if (isset($_REQUEST["shapeid"])) 
{	$shape_id = $_REQUEST["shapeid"]; 

	mysqli_query($conn, "update shape set shape_trash='0' where shape_id = $shape_id");
	
	echo "<SCRIPT type='text/javascript'> 
        alert('Shape has been Restore');
        window.location.replace(\"admin_trashed_shape.php\");
		</SCRIPT>";
}

?>