<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>Trashed Colour</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Trashed Colour
		</div>
		
		<ul class="btn_top_admin_view_colour">
			<a href="admin_view_colour.php?page=1" />
				<li class="admin_view_colour_link">
					View Colour
				</li>
			</a>
		</ul>

		<div class="admin_view_colour_small_wrapper">
			
			<ul class="colour_title_ul">
				<li class="colour_title_li">Colour ID</li>
				<li class="colour_title_li">Colour Name</li>
				<li class="colour_title_li">Colour Code</li>
				<li class="colour_title_li">Action</li>
			</ul>
			
			<?php
					
				$result_take = mysqli_query($conn, "select * from colour where colour_trash = '1'");
				
				$count=mysqli_num_rows($result_take);
				
				if($count>=1)
				{
					while($row_colour = mysqli_fetch_assoc($result_take))
					{

				?>
					<ul class="colour_content_ul">
						<li class="colour_content_li"><?php echo $row_colour["colour_id"]; ?></li>
						<li class="colour_content_li"><?php echo $row_colour["colour_name"]; ?></li>
						<li class="colour_content_li"><?php echo $row_colour["colour_code"]; ?></li>
						<li class="colour_content_li">
							<a href = "admin_trashed_colour.php?cid=<?php echo $row_colour['colour_id']; ?>" onclick="return restore_confirmation();">Restore</a>
						</li>
					</ul>
				
				<?php
					}
				}
				else
				{
					?>
						<div class="no_record">No Trashed Colour</div>
					<?php
				}
			?>
		</div>
		
	</div>
</div>
<script type="text/javascript">

function restore_confirmation()
{
		answer = confirm("Are you sure want to Resore this Colour?");
		return answer;
}
</script>

<?php
	
if (isset($_REQUEST["cid"])) 
{	$colour_id = $_REQUEST["cid"]; 
	mysqli_query($conn, "update colour set colour_trash='0' where colour_id = $colour_id");
	
	echo "<SCRIPT type='text/javascript'> 
        alert('Colour has been Restore');
        window.location.replace(\"admin_trashed_colour.php\");
		</SCRIPT>";
}

?>