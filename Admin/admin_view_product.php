<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)

?>		
<title>View Product</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_view_new_product_wrapper">

		<div class="admin_title">
			<p>View Product</p>
		</div>
		
		<div class="view_admin_prouct_top_title">
			
			<ul class="top_btn_view_product">
				<a href="admin_add_product.php" />
					<li class="admin_view_prod_link">
						Add New Product
					</li>
				</a>
				
				<a href="admin_trashed_product.php" />
					<li class="admin_view_prod_link">
						Trashed Product
					</li>
				</a>
			</ul>
		</div>
		
		<div class="admin_search_product">
				<form name="product_search" action="admin_view_search_product.php" method="post">
					<ul class="search_wrapper_product">
						<li class="product_top_search_left">
							<input type="text" name="search" autocomplete="off" class="product_top_searching_bar" placeholder='search by product id or product name'>
						</li>
						<li class="product_top_search_right">
							<button type="submit" name="search_btn" class="img_search" >
								<img src="../images/admin/search.png" class="imgase_search"/>
							</button>
						</li>
					</ul>
				</form>
		</div>
		
		<div>
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
					$page = $_GET["page"];
					
					if($page == "" || $page == "1")
					{ $page1 = 0;
					}
					else
					{ $page1 = ($page-1)*10;
					}
					
					$result_product = mysqli_query($conn ,"select * from product where product_trash = '0' limit $page1,10");	
				
					while($row_product = mysqli_fetch_assoc($result_product))
					{	
						$prodid =$row_product["product_id"];
						$result_image = mysqli_query($conn ,"select * from image,product where image_product_id = '$prodid' and image_trash='0'");	
						$row_image = mysqli_fetch_assoc($result_image);
						$check_img_exist = $row_image["image_img"];
						
					?>		
					<ul class="admin_view_product_ul2">
						<li class="admin_view_product_li"><?php echo $row_product["product_id"]; ?></li>
						<li class="admin_view_product_li">
							<?php
								if($check_img_exist != "")
								{
							?>
								<img src="../<?php echo $check_img_exist ;?>">
							<?php
								}
								else if($check_img_exist == "")
								{
							?>
								<img src="../images/product/no_img.jpg">
							<?php
								}
							?>
						</li>
						<li class="admin_view_product_li"><?php echo $row_product["product_name"]; ?></li>
						<li class="admin_view_product_li">RM <?php echo number_format($row_product["product_price"],2); ?></li>
						<li class="admin_view_product_li"><?php echo $row_product["product_stock"]; ?></li>
						
						<li class="admin_view_product_li2">
							<a href = "admin_view_product_detail.php?pid=<?php echo $row_product['product_id']; ?>">View</a>
						</li>
						
						<li class="admin_view_product_li2">
							<a href = "admin_view_product.php?pid=<?php echo $row_product['product_id']; ?>" onclick="return confirmation();">Trash</a>
						</li>
							
						<!--
						<li class="admin_view_product_li2">
							<a href = "admin_update_product_detail.php?pid=<?php echo $row_product['product_id']; ?>">Edit</a>
						</li>
						-->
					</ul>
					
					<?php
					
					}
					
					$product = mysqli_query($conn ,"select * from product where product_trash = '0' ");
					$count = mysqli_num_rows($product);
					
					$a = ceil($count/10);
					
					?>
					<div class="pagination_wrapper_div">
						<ul class="pagination_padding">
							<?php
							for($b=1; $b<=$a; $b++)
							{ ?>
								<a href="admin_view_product.php?page=<?php echo $b; ?>">
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

	
if (isset($_REQUEST["pid"])) 
	
{	$product_id = $_REQUEST["pid"]; 
	mysqli_query($conn, "update product set product_trash='1' where product_id = $product_id");
	
	
	echo "<SCRIPT type='text/javascript'>
        alert('Product has been Trash');
        window.location.replace(\"admin_view_product.php?page=1\");
		</SCRIPT>";
}

?>