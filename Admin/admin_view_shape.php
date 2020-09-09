<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

?>
<title>View Shape</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_colour_wrapper">
	
		<div class="admin_title">
			Shape
		</div>
		
		<ul class="btn_top_admin_view_colour">
			<a href="admin_add_shape.php" />
				<li class="admin_view_colour_link">
					Add New Shape
				</li>
			</a>
			
			<a href="admin_trashed_shape.php" />
				<li class="admin_view_colour_link">
					Trashed Shape
				</li>
			</a>
		</ul>
		
		<div class="admin_search_colour">
			<form name="colour_search" action="admin_view_search_shape.php" method="post">
				<ul class="search_wrapper_colour">
					<li class="colour_top_search_left">
						<input type="text" name="search" autocomplete="off" class="colour_top_searching_bar" placeholder="search by shape id and name">
					</li>
					<li class="colour_top_search_right">
						<button type="submit" name="search_btn" class="button_shape_search">
							<img src="../images/admin/search.png" class="imgase_search"/>
						</button>
					</li>
				</ul>
			</form>
		</div>
		
		<div class="admin_view_colour_small_wrapper">
			
			<ul class="shape_title_ul">
				<li class="shape_title_li">Shape ID</li>
				<li class="shape_title_li">Shape Name</li>
				<li class="shape_title_li">Action</li>
			</ul>
			
			<?php
				$page = $_GET["page"];
				
				if($page == "" || $page == "1")
				{ $page1 = 0;
			    }
				else
				{ $page1 = ($page - 1) * 10;
				}
				
				$result_take = mysqli_query($conn, "select * from shape where shape_trash = '0' limit $page1,10");
				
				$count=mysqli_num_rows($result_take);
				
				if($count>=1)
				{
					while($row_shape = mysqli_fetch_assoc($result_take))
					{

				?>
					<ul class="shape_content_ul">
						<li class="shape_content_li"><?php echo $row_shape["shape_id"]; ?></li>
						<li class="shape_content_li"><?php echo $row_shape["shape_content"]; ?></li>
						<li class="shape_content_li2">
							<a href = "admin_update_shape_detail.php?shapeid=<?php echo $row_shape['shape_id']; ?>">Edit</a></a>
						</li>
						
						<li class="shape_content_li2">
							<a href = "admin_view_shape.php?shapeid=<?php echo $row_shape['shape_id']; ?>" onclick="return confirmation();">Trash</a>
						</li>
					</ul>
				
				<?php
					}
				}
				else
				{
					?>
						<div class="no_record">No Shape</div>
					<?php
				}
			?>
		</div>
		<?php
				$shape = mysqli_query($conn, "select * from shape where shape_trash = '0'");
				
				$count_shape = mysqli_num_rows($shape);
				$a = ceil($count_shape/10);
				?>
				<div class="pagination_wrapper_div">
					<ul class="pagination_padding">
					 <?php
						for($b=1; $b<=$a; $b++)
						{ ?>
							<a href="admin_view_shape.php?page=<?php echo $b; ?>">
								<li class="pagination">
									<?php echo $b. " " ?>
								</li>
							</a>
						<?php
						}		
						?>
					</ul>
				</div>
	</div>
</div>
<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to trash this Shape?");
		return answer;
}
	
</script>
<?php

	
if (isset($_REQUEST["shapeid"])) 
{	$shape_id = $_REQUEST["shapeid"]; 
	mysqli_query($conn, "update shape set shape_trash='1' where shape_id = $shape_id");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Shape has been Trash');
        window.location.replace(\"admin_view_shape.php?page=1\");
		</SCRIPT>";
}

?>