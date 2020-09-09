<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>View Search Colour</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Colour
		</div>
		
		<ul class="btn_top_admin_view_colour">
		
			<a href="admin_add_colour.php" />
				<li class="admin_view_colour_link">
					Add New Colour
				</li>
			</a>	
			
			<a href="admin_trashed_colour.php" />
				<li class="admin_view_colour_link">
					Trashed Colour
				</li>
			</a>
		</ul>
		
		<div class="admin_search_colour">
				<form name="colour_search" action="admin_view_search_colour.php" method="post">
					<ul class="search_wrapper_colour">
						<li class="colour_top_search_left">
							<input type="text" name="search" autocomplete="off" class="colour_top_searching_bar" placeholder="search by colour id and name">
						</li>
						<li class="colour_top_search_right">
							<button type="submit" name="search_btn" class="admin_search_colour_button">
								<img src="../images/admin/search.png" class="imgase_search"/>
							</button>
						</li>
					</ul>
				</form>
		</div>
		
		<div class="admin_view_colour_small_wrapper">
			
			<ul class="colour_title_ul">
				<li class="colour_title_li">Colour ID</li>
				<li class="colour_title_li">Colour Name</li>
				<li class="colour_title_li">Colour Code</li>
				<li class="colour_title_li">Action</li>
			</ul>
			
<?php
if(isset($_POST['search_btn']))
{ 
   $search = $_POST['search'];
   $query = mysqli_query($conn, "select * from colour where (colour_id like '%$search%' and colour_trash = '0') or (colour_name like '%$search%' and colour_trash = '0') OR (colour_code like '%$search%' and colour_trash = '0')");
   $count = mysqli_num_rows($query);
   if($count == 0) 
   { 
	?>
		<div class="no_record">No Record Found</div>
	<?php
   }
   else
   {		
		while($row_colour = mysqli_fetch_assoc($query))
		{
		?>
			<ul class="colour_content_ul">
						<li class="colour_content_li"><?php echo $row_colour["colour_id"]; ?></li>
						<li class="colour_content_li"><?php echo $row_colour["colour_name"]; ?></li>
						<li class="colour_content_li"><?php echo $row_colour["colour_code"]; ?></li>
						<li class="colour_content_li2">
							<a href = "admin_update_colour_detail.php?colourid=<?php echo $row_colour['colour_id']; ?>">Edit</a></a>
						</li>
						
						<li class="colour_content_li2">
							<a href = "admin_view_colour.php?colourid=<?php echo $row_colour['colour_id']; ?>" onclick="return confirmation();">Trash</a>
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
		answer = confirm("Are you sure want to trash this Colour?");
		return answer;
}
	
</script>
<?php

	
if (isset($_REQUEST["colourid"])) 
{	$colour_id = $_REQUEST["colourid"]; 
	mysqli_query($conn, "update colour set colour_trash='1' where colour_id = $colour_id");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Colour has been Trash');
        window.location.replace(\"admin_view_colour.php?page=1\");
		</SCRIPT>";
}

?>