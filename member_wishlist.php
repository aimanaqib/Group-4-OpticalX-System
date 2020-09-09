<?php 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: member_login.php");
   
$member_id = $_SESSION["sess_memid"]; 

$result_take = mysqli_query($conn, "select * from product,wishlist_product,wishlist,member
									where wishlist_product_wishlist_id = wishlist_id 
									AND wishlist_product_product_id = product_id 
									AND member_id = $member_id 
									AND wishlist_member_id = $member_id");
?>

<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure to remove this product ?");
		return answer;
}
</script>

<title>Wishlist</title>

<?php include 'header.php'; ?>

<div class="wishlist_wrapper">
	<div class="page_title">
		<p>Wishlist</p>
	</div>

	<ul class="member_wishlist_title_ul">
					<li class="member_wishlist_title_li">Product Images</li>
					<li class="member_wishlist_title_li">Product Brand</li>
					<li class="member_wishlist_title_li">Product Name</li>
					<li class="member_wishlist_title_li">Product Price</li>
					<li class="member_wishlist_title_li">Action</li>
	</ul>
	<?php
	if(mysqli_num_rows($result_take) != 0)
	{
		while ($row_take = mysqli_fetch_assoc($result_take))
		{ 	$product_id_loop = $row_take["product_id"];
			$product_brand_id_loop = $row_take["product_brand_id"];
			$result_img = mysqli_query($conn, "select * from image, brand where image_product_id = $product_id_loop AND brand_id = $product_brand_id_loop");
			$row_img = mysqli_fetch_assoc($result_img);
		?>	
		<ul class="member_wishlist_content_ul">
						<li class="member_wishlist_content_li"><img src="<?php echo $row_img["image_img"];?>"></li>
						<li class="member_wishlist_content_li"><?php echo $row_img["brand_name"];?></li>
						<li class="member_wishlist_content_li"><?php echo $row_take["product_name"];?></li>
						<li class="member_wishlist_content_li"><?php echo "RM ".number_format($row_take["product_price"],2); ?></li>
						<li class="member_wishlist_content_li"><a href="member_product_details.php?pid=<?php echo $row_take["product_id"];?>">View Detail</a> 
															   <a class="wishlist_remove" href="member_wishlist.php?wishlist_product_id=<?php echo $row_take["wishlist_product_id"];?>" class="wishlist_remove" onclick="return confirmation();">Remove</a></li>
		</ul>
		<?php
		}
	}
	else
	{	
		?>
		<div class="new_content">
			<p>No Records Found</p>
			<a href="member_product_list.php?page=1">SHOPPING NOW</a>
		</div>
		<?php
	}
	?>
		
</div>

<?php include 'footer.php'; ?>	

<?php
if (isset($_REQUEST["wishlist_product_id"])) 
{	$wishlist_product_id = $_REQUEST["wishlist_product_id"]; 
	mysqli_query($conn, "delete from wishlist_product where wishlist_product_id = $wishlist_product_id");
	
	echo '<script language="javascript">';
	echo "window.location.href='member_wishlist.php'";
	echo '</script>';
}	
?>

