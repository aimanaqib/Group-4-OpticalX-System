<?php include("connection.php"); 

$member_id = $_SESSION["sess_memid"];

$purchase_id = $_REQUEST["purchase_id"];

$sql_purchase = mysqli_query($conn, "select * from purchase,shopping_cart,member 
									where purchase_shopping_cart_id = shopping_cart_id 
									AND shopping_cart_member_id = member_id
									AND purchase_id = $purchase_id
									AND member_id = $member_id");
$result_purchase = mysqli_fetch_assoc($sql_purchase);
?>

<title>Order Detail</title>

<?php include 'header.php'; ?>

<div class="order_detail_wrapper">
	<div class="row">
		<div class="twelve columns">
			<div class="member_order_detail_title">
				<p>ORDER DETAIL</p>
			</div>
		
			<div class="member_order_detail_content">
				<div class="member_order_detail_content1">
					<div class="member_order_detail1">
						ORDER ID
					</div>
					<div class="member_order_detail2">
						<span class="member_order_detail2_span">:</span>
						<?php echo "00".$purchase_id?>
					</div>
				</div>
				
				<div class="member_order_detail_content1">
					<div class="member_order_detail1">
						Order Date And Time
					</div>
					<div class="member_order_detail2">
						<span class="member_order_detail2_span">:</span>
						<?php echo $result_purchase["purchase_time"];?>
					</div>
				</div>
				
				<div class="member_order_detail_content1">
					<div class="member_order_detail1">
						 Delivery Name
					</div>
					<div class="member_order_detail2">
						<span class="member_order_detail2_span">:</span>
						<?php echo $result_purchase["purchase_ship_name"];?>
					</div>
				</div>
				
				<div class="member_order_detail_content1">
					<div class="member_order_detail1">
						 Delivery Phone
					</div>
					<div class="member_order_detail2">
						<span class="member_order_detail2_span">:</span>
						<?php echo $result_purchase["purchase_phone"];?>
					</div>
				</div>
				
				<div class="member_order_detail_content1">
					<div class="member_order_detail1">
						 Delivery Address
					</div>
					<div class="member_order_detail2">
						<span class="member_order_detail2_span">:</span>
						<?php echo $result_purchase["purchase_address"]." ". $result_purchase["purchase_postcode"]." ". $result_purchase["purchase_city"]." ". $result_purchase["purchase_state"];?>
					</div>
				</div>
				
				<div class="member_order_detail_content1">
					<div class="member_order_detail1">
						 Total Payment
					</div>
					<div class="member_order_detail2">
						<span class="member_order_detail2_span">:</span>
						<?php echo "RM".$result_purchase["purchase_total"];?>
					</div>
				</div>
				
				<div class="member_order_detail_content1">
					<div class="member_order_detail1">
						 Status
					</div>
					<div class="member_order_detail2">
						<span class="member_order_detail2_span">:</span>
						<?php echo $result_purchase["purchase_status"];?>
					</div>
				</div>
				
			</div>
			
			<div class="member_order_detail_product">
			
				<ul class="member_order_detail_product_ul">
					<li class="member_order_detail_product_li">Product Image</li>
					<li class="member_order_detail_product_li">Product Name</li>
					<li class="member_order_detail_product_li2">Power</li>
					<li class="member_order_detail_product_li2">Quantity</li>
					<li class="member_order_detail_product_li2">Price</li>
				</ul>
				
				<?php
					$sql_product = mysqli_query($conn, "select * from purchase,shopping_cart,product_shopping_cart,product where
														purchase_shopping_cart_id = shopping_cart_id
														AND shopping_cart_id = product_shopping_cart_shopping_cart_id
														AND product_shopping_cart_product_id = product_id
														AND purchase_id = $purchase_id");
					while($row_product = mysqli_fetch_assoc($sql_product))
					{
					$product_id = $row_product["product_id"];
					$sql_image = mysqli_query($conn, "select * from image where image_product_id = $product_id");
					$row_img = mysqli_fetch_assoc($sql_image);
				?>		
					<ul class="member_order_detail_product_ul2">
						<li class="member_order_detail_product_li"><img src="<?php echo $row_img['image_img']; ?>"></li>
						<li class="member_order_detail_product_li magic_for_prodct_order_detail"> <?php echo $row_product["product_name"];?></li>
						<li class="member_order_detail_product_li2 magic_for_prodct_order_detail">
							<ul class="member_order_detail_power_ul">
								<?php
									$left_power = $row_product["product_shopping_cart_power_left"];
									$right_power = $row_product["product_shopping_cart_power_right"];
									if($left_power == 0 and $right_power == 0)
									{
										echo "<li>No Power</li>";
									}
									else
									{
								?>
								<li class="member_order_detail_power_li"><?php echo 'Left <span class="checkout_special">:</span> '.$row_product["product_shopping_cart_power_left"];?></li>
								<li class="member_order_detail_power_li"><?php echo 'Right : '.$row_product["product_shopping_cart_power_right"];?></li>
								<?php
									}
								?>
							</ul>
						</li>
						<li class="member_order_detail_product_li2 magic_for_prodct_order_detail"><?php echo $row_product["product_shopping_cart_quantity"];?></li>
						<li class="member_order_detail_product_li2 magic_for_prodct_order_detail"><?php echo "RM ".$row_product["product_price"];?></li>
					</ul>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>