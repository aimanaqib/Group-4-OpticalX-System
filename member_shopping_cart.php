<?php 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: member_login.php");
   
$member_id = $_SESSION["sess_memid"]; 

$result_take = mysqli_query($conn, "select * from product, shopping_cart, product_shopping_Cart, member
									where product_shopping_cart_shopping_cart_id = shopping_cart_id
									AND product_shopping_cart_product_id = product_id
									AND shopping_cart_type = 'unpaid'
									AND member_id = $member_id
									AND shopping_cart_member_id = $member_id");	

//print_r($count_row);
//print_r($row_take["product_name"]);
//print_r($row_take["product_shopping_cart_quantity"]);

?>
<title>Shopping Cart</title>

<?php include 'header.php'; ?>

<form name="recordfrm" method="post" action=""> 
<div class="Shopping_cart_wrapper">
	<div class="page_title">
		<p>Shopping Cart</p>
	</div>

	
	<div class="Shopping_cart_small_wrapper">
		<div class="row">
			<ul class="shopping_cart_header_ul">
				<li class="shopping_cart_header_check">
					
				</li>
				
				<li class="shopping_Cart_big_head">
					<p>Product</p>
				</li>
				
				<li class="shopping_Cart_small_head">
					<p>Power</p>
				</li>
				
				<li class="shopping_Cart_small_head">
					<p>Unit Price</p>
				</li>
				
				<li class="shopping_Cart_small_head">
					<p>Quantity</p>
				</li>
				
				<li class="shopping_Cart_small_head">
					<p>Total Price</p>
				</li>
				
				<li class="shopping_Cart_small_head">
					<p>Actions</p>
				</li>
				
			</ul>
			
			<div class="shopping_cart_loop">
			<?php

			$x = 0;
			
			while ($row_take = mysqli_fetch_array($result_take))

			{
			$product_id_loop = $row_take["product_id"];
			$result_img = mysqli_query($conn, "select * from image where image_product_id = $product_id_loop ");
			$row_img = mysqli_fetch_assoc($result_img);
			?>			
			 	
			<!--
				<ul class="shopping_cart_merchant">
					<li class="shopping_cart_header_check">
						
					</li>
					
					<li class="shopping_Cart_merchant_name">
						<ul class="merchant_details">
							<li class="merchant_icon">
								<img src="Images/shop_icon.png">
							</li>
							
							<li class="merchant_info">
								<p><?php echo $row["purchase_product_brand"];?></p>
							</li>
						</ul>
					</li>
				</ul>
			-->
				<ul class="shopping_cart_product_details">
					<!--
						<li class="shopping_cart_header_check2">
							<form name="shopping_cart_checkbox">
								  <input type="checkbox" name="check_record[]" value="<?php echo $row_take['product_shopping_cart_id']; ?>">
							</form>
						</li>
					-->
					
					
					<li class="shopping_Cart_big_head">
						<ul class="shopping_cart_product">
							<li class="shopping_cart_product_left">
								<img src="<?php echo $row_img["image_img"];?>" >
							</li>
							<li class="shopping_cart_product_right">
								<p><?php echo $row_take["product_name"];?></p>
								<?php
								
								?>
							</li>
						</ul>
					</li>
					
					<li class="shopping_Cart_small_head2">
						<ul class="shopping_cart_power_ul">
						<?php
						$power_left = $row_take["product_shopping_cart_power_left"];
						$power_right = $row_take["product_shopping_cart_power_right"];
							if($power_left == 0 and $power_right == 0)
							{
						?>
								<li class="">
								<p>No Power</p>
								</li>
						<?php
							}
							else
							{
						?>
							<li class="shopping_cart_power_li"> <?php echo "Left <span class='span_special_shopping_cart'> : </span>".$row_take["product_shopping_cart_power_left"]; ?></li>
							<li class="shopping_cart_power_li"> <?php echo "Right  : ".$row_take["product_shopping_cart_power_right"]; ?> </li>
						<?php
							}
						?>
						</ul>
					</li>
					
					<li class="shopping_Cart_small_head2">
						<p><?php echo "RM ".number_format($row_take["product_shopping_cart_price"],2); ?></p>
					</li>
					
					<li class="shopping_Cart_small_head">
						<form name="shopping_cart_quantity">
							  <input type="number" name="quantity" class="number_qty_sc" value="<?php echo $row_take["product_shopping_cart_quantity"];?>" readonly>
						</form>
					</li>
					<?php
					$total = $row_take["product_shopping_cart_price"] * $row_take["product_shopping_cart_quantity"];
					?>
					<li class="shopping_Cart_small_head2">
						<p><?php echo "RM ".number_format($total,2) ?></p>
					</li>
					
					<li class="shopping_Cart_small_head2">
						<a href="member_shopping_cart.php?product_shopping_cart_id=<?php echo $row_take['product_shopping_cart_id']; ?>" class="sc_delete" onclick="return confirmation();">
						<img src="images/member/deleteicon.png" class="icon_delete" ></a>
					</li>
				</ul>
			<?php
			$x++;
			}	
			?>
				<p> Number of records : <?php echo $x; ?></p>
				<!--
					<input type="submit" name="delete_multiple" value="Delete Selected Records" onclick="return confirmation();" class="multiple_delete_cart"/>
				-->
				<a href="member_product_list.php?page=1"><input type="button" name="continue_shopping" value="Continue Shopping" class="multiple_delete_cart"/></a>
				<?php
				$counter = mysqli_num_rows($result_take);
				
				if($counter != 0)
				{
				?>
				<a href="member_checkout.php" /><button type="button" name="checkout_btn" class="sc_checkout">Checkout</button></a>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
</form>


<?php include 'footer.php'; ?>

<script type="text/javascript">
function confirmation()
{
		answer = confirm("Are you sure want to delete this record?");
		return answer;
}
</script>

<?php
 
if (isset($_REQUEST["product_shopping_cart_id"])) 
{	
	$product_shopping_cart_id = $_REQUEST["product_shopping_cart_id"]; 
	
	$member_id = $_SESSION["sess_memid"]; 

	$all_result = mysqli_query($conn, "select * from product, shopping_cart, product_shopping_Cart, member
									where product_shopping_cart_shopping_cart_id = shopping_cart_id
									AND product_shopping_cart_product_id = product_id
									AND shopping_cart_type = 'unpaid'
									AND member_id = $member_id
									AND shopping_cart_member_id = $member_id  And product_shopping_cart_id = $product_shopping_cart_id");	
									
	$row=mysqli_fetch_assoc($all_result);
	
	$product_id = $row["product_id"];
	$qty = $row["product_shopping_cart_quantity"];
	
	
	$product_result = mysqli_query($conn,"select * from product where product_id=$product_id");
	$rrow=mysqli_fetch_assoc($product_result);
	$stock = $rrow["product_stock"];
	
	$balance = $stock +$qty;
	
	mysqli_query($conn,"update product set product_stock=$balance where product_id=$product_id");
	
	mysqli_query($conn, "delete from product_shopping_cart where product_shopping_cart_id = $product_shopping_cart_id");
	

	
	
	echo '<script language="javascript">';
	echo "window.location.href='member_shopping_cart.php'";
	echo '</script>';
}
/*
if (isset($_POST["delete_multiple"])) 		
{
	$checkbox = $_POST["check_record"];		
	
	$count = count($_POST["check_record"]); 
	
	for($i=0; $i < $count; $i++) 
	{
		$del_id  = $checkbox[$i];	
		
		mysqli_query($conn, "delete from product_shopping_cart where product_shopping_cart_id = $del_id");
	}
	
	echo '<script language="javascript">';
	echo "window.location.href='member_shopping_cart.php'";
	echo '</script>';

}
*/
?>
