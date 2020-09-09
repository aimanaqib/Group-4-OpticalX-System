<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)

?>		
<title>Trashed Product</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_view_new_product_wrapper">

		<div class="admin_title">
			<p>Trashed Product</p>
		</div>
		
		<div class="view_admin_prouct_top_title">
			
			<ul class="top_btn_view_product">
				<li class="admin_view_prod_link">
					<a href="admin_view_product.php?page=1" />View Product</a>
				</li>
			
			</ul>

			
		</div>
		

		
		<div class="admin_view_new_product_small_wrapper">

			<ul class="admin_view_product_ul">
					<li class="admin_view_product_li">Product ID</li>
					<li class="admin_view_product_li">Images</li>
					<li class="admin_view_product_li">Product Name</li>
					<li class="admin_view_product_li">Product Price</li>
					<li class="admin_view_product_li">Product Stock</li>
					<li class="admin_view_product_li">Action</li>
			</ul>
			
			
			
			
				<?php
				$result_product = mysqli_query($conn ,"select * from product where product_trash = '1'");	
				
				$count=mysqli_num_rows($result_product);
				
				if($count>=1)
				{
					
					while($row_product = mysqli_fetch_assoc($result_product))
					{	
						$prodid =$row_product["product_id"];
						$result_image = mysqli_query($conn ,"select * from image,product where image_product_id = '$prodid' and image_trash='0'");	
						$row_image = mysqli_fetch_assoc($result_image);
						$count = mysqli_num_rows($result_image);
					?>		
					<ul class="admin_view_product_ul2">
						<li class="admin_view_product_li"><?php echo $row_product["product_id"]; ?></li>
						<?php
						if($count==0)
						{
						?>
						<li class="admin_view_product_li"><img src="../images/brand/no_img.jpg"></li>
						<?php
						}
						else
						{
						?>
						<li class="admin_view_product_li"><img src="../<?php echo $row_image["image_img"];?>"></li>
						<?php
						}
						
						?>
						<li class="admin_view_product_li"><?php echo $row_product["product_name"]; ?></li>
						<li class="admin_view_product_li">RM <?php echo number_format($row_product["product_price"],2); ?></li>
						<li class="admin_view_product_li"><?php echo $row_product["product_stock"]; ?></li>
						
						<li class="admin_view_product_li">
							<a href = "admin_trashed_product.php?pid=<?php echo $row_product['product_id']; ?>">Restore</a>
						</li>
						<!--
						<li class="admin_view_product_li2">
							<a href = "admin_view_product.php?pid=<?php echo $row_product['product_id']; ?>" onclick="return confirmation();">Trash</a>
						</li>	
						
						<li class="admin_view_product_li2">
							<a href = "admin_update_product_detail.php?pid=<?php echo $row_product['product_id']; ?>">Edit</a>
						</li>
						-->
					</ul>
					<?php
					
					}
				}
				else
				{
					?>
						<div class="no_record_brand">No Product</div>
					<?php
				}
				
				?>
			
		</div>	
	</div>
</div>


<?php
 
if (isset($_REQUEST["pid"])) 
{
	$pid = $_REQUEST["pid"]; 
	mysqli_query($conn, "update product set product_trash='0' where product_id = $pid");
	
	echo "<SCRIPT type='text/javascript'>
        alert('Product has been Restore');
        window.location.replace(\"admin_trashed_product.php\");
		</SCRIPT>";
}
?>