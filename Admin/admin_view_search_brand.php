<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>
<title>View Search Brand</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="view_brand_wrapper">

		<div class="admin_title">
			<p>View Brand</p>
		</div>
		
		<ul class="admin_view_brand_top_link">
			<a href="admin_add_brand.php" />
				<li class="admin_view_brand_link">
					Add New Brand
				</li>
			</a>
			
			<a href="admin_trashed_brand.php" />
				<li class="admin_view_brand_link">
					Trashed Brand
				</li>
			</a>
			
		</ul>
		
		<div class="admin_search_product">
				<form name="product_search" action="admin_view_search_brand.php" method="post">
					<ul class="search_wrapper_product">
						<li class="product_top_search_left">
							<input type="text" name="search" autocomplete="off" class="product_top_searching_bar" placeholder="search by brand id and brand name">
						</li>
						<li class="product_top_search_right">
							<button type="submit" name="search_btn" class="search_brand_button">
								<img src="../images/admin/search.png" class="imgase_search"/>
							</button>
						</li>
					</ul>
				</form>
		</div>
		
		<div class="view_brand_small_wrapper">

			<ul class="admin_view_brand_ul">
					<li class="admin_view_brand_li">Brand ID</li>
					<li class="admin_view_brand_li">Images</li>
					<li class="admin_view_brand_li">Brand Name</li>
					<li class="admin_view_brand_li">Brand date</li>
					<li class="admin_view_brand_li">Brand Top</li>
					<li class="admin_view_brand_li">Action</li>
			</ul>
			
<?php
if(isset($_POST['search_btn']))
{ 
   $search = $_POST['search'];
   $query = mysqli_query($conn, "select * from brand where (brand_id like '%$search%' and brand_trash = '0') or (brand_name like '%$search%' and brand_trash = '0') OR (brand_cooperation_date like '%$search%' and brand_trash = '0')");
   $count = mysqli_num_rows($query);
   if($count == 0) 
   { 
	?>
		<div class="no_record_brand">No Brand Record</div>
	<?php
   }
   else
   {		
		while($row = mysqli_fetch_assoc($query))
		{
		?>		
			<ul class="admin_view_brand_ul2">
						<li class="admin_view_brand_li"><?php echo $row["brand_id"]; ?></li>
						<li class="admin_view_brand_li"><img src="../<?php echo $row["brand_image"];?>"></li>
						<li class="admin_view_brand_li"><?php echo $row["brand_name"]; ?></li>
						<li class="admin_view_brand_li"><?php echo $row["brand_cooperation_date"]; ?></li>
						<li class="admin_view_brand_li"><?php echo $row["brand_top"]; ?></li>
						
						<li class="admin_view_brand_li2">
							<a href = "admin_update_brand_detail.php?brandid=<?php echo $row['brand_id']; ?>">Edit</a>
						</li>
						
						<li class="admin_view_brand_li2">
							<a href = "admin_view_brand.php?bid=<?php echo $row['brand_id']; ?>" onclick="return confirmation();">Trash</a>
						</li>
			</ul>
		<?php
				
		}
	}
}
				?>
		</div>
	</div>
</div>




	

<?php

	
if (isset($_REQUEST["bid"])) 
{	$brand_id = $_REQUEST["bid"]; 
	mysqli_query($conn, "update brand set brand_trash='1' where brand_id = $brand_id");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Brand has been Trash');
        window.location.replace(\"admin_view_brand.php\");
		</SCRIPT>";
}

?>

<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to trash this brand?");
		return answer;
}
</script>