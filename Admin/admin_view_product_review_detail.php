<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>
<title>View Product Review Detail</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_review_product_detail">
	
		<div class="admin_title">
			<p>Review Detail</p>
		</div>
		
		<div class="back_button_review">
			<a href="admin_dashboard.php">Back</a>
		</div>
			
		<div class="admin_view_product_review_detail_small_wrapper">

			<?php

			$review_id = $_REQUEST["review_id"];
			
			$sql_review = mysqli_query($conn,"Select * from review,product,member,image where 
									review_product_id = product_id AND
									review_member_id = member_id AND
									image_product_id = product_id AND
									review_id = $review_id");
									
			$row_review = mysqli_fetch_assoc($sql_review);
			$product_id = $row_review["product_id"];
			$member_id = $row_review["member_id"];
			
			$sql_order_id = mysqli_query($conn,"Select * from purchase,shopping_cart,member,product,product_shopping_cart where
												purchase_shopping_cart_id = shopping_cart_id AND
												purchase_status = 'delivered' AND
												shopping_cart_member_id = member_id AND
												product_shopping_cart_shopping_cart_id = shopping_cart_id AND
												product_shopping_cart_review_status = 'Completed' AND
												product_shopping_cart_product_id = product_id AND
												product_id = $product_id AND
												member_id = $member_id
												");
			$row_order_id = mysqli_fetch_assoc($sql_order_id);
			
			
			?>
			<div class="wrapper_small_Content_review">
				<div class="review_small_title">
					Product Image :
				</div>
				<div class="review_small_contant">
					<img src="<?php echo '../'.$row_review["image_img"]; ?>">
				</div>
			</div>
			
			<div class="wrapper_small_Content_review">
				<div class="review_small_title">
					Product Name :
				</div>
				<div class="review_small_contant">
					<?php echo $row_review["product_name"]; ?>
				</div>
			</div>
			
			<div class="wrapper_small_Content_review">
				<div class="review_small_title">
					Product Price :
				</div>
				<div class="review_small_contant">
					<?php  echo $row_review["product_price"]; ?>
				</div>
			</div>
			
			<div class="wrapper_small_Content_review">
				<div class="review_small_title">
					Order ID :
				</div>
				<div class="review_small_contant">
					<?php  echo $row_order_id["purchase_id"];?>
				</div>
			</div>
			
			<div class="wrapper_small_Content_review">
				<div class="review_small_title">
					Member Name :
				</div>
				<div class="review_small_contant">
					<?php  echo $row_review["member_name"];?>
				</div>
			</div>
			
			<div class="wrapper_small_Content_review">
				<div class="review_small_title">
					Member Review :
				</div>
				<div class="review_small_contant">
					<?php  echo $row_review["review_content"]; ?>
				</div>
			</div>
	</div>
</div>