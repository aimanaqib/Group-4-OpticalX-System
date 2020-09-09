<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>
<title>Trashed Brand</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="view_brand_wrapper">

		<div class="admin_title">
			<p>Trashed Brand</p>
		</div>
		
		<ul class="admin_view_brand_top_link">
		
			<a href="admin_view_brand.php?page=1" />
				<li class="admin_view_brand_link">
					View Brand
				</li>
			</a>

		</ul>
		
		
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

				$result = mysqli_query($conn, "select * from brand where brand_trash = '1' ");
				
				$count = mysqli_num_rows($result);
				
				if($count >=1)
				{
					while($row = mysqli_fetch_assoc($result))
					{
					
					?>		
					<ul class="admin_view_brand_ul2">
						<li class="admin_view_brand_li"><?php echo $row["brand_id"]; ?></li>
						<li class="admin_view_brand_li"><img src="<?php echo "../".$row["brand_image"];?>"></li>
						<li class="admin_view_brand_li"><?php echo $row["brand_name"]; ?></li>
						<li class="admin_view_brand_li"><?php echo $row["brand_cooperation_date"]; ?></li>
						<li class="admin_view_brand_li"><?php echo $row["brand_top"]; ?></li>
						<li class="admin_view_brand_li">
							<a href = "admin_trashed_brand.php?brandid=<?php echo $row['brand_id']; ?>" onclick="return confirmation();">Recover</a>
						</li>
						
					</ul>
					<?php
					}
				}
				else
				{
					?>
						<div class="no_record_brand">No Trashed Brand</div>
					<?php
				}
				?>
			
		</div>
	</div>
</div>




<?php

if (isset($_REQUEST["brandid"])) 
{
	$brand_id = $_REQUEST["brandid"]; 

	mysqli_query($conn, "UPDATE `brand` SET `brand_trash` = '0' WHERE brand_id = $brand_id;");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Brand has been Recover');
        window.location.replace(\"admin_trashed_brand.php\");
		</SCRIPT>";
}

?>

<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to Recover this brand?");
		return answer;
}
	
</script>