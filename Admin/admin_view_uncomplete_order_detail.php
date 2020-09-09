<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$purchase_id = $_REQUEST["purchase_id"];

$sql_purchase = mysqli_query($conn, "select * from purchase,shopping_cart,member 
									where purchase_shopping_cart_id = shopping_cart_id 
									AND shopping_cart_member_id = member_id
									AND purchase_id = $purchase_id")

?>
<title>View Uncompleted Order Detail</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_uncomplete_order_detail">
	
		<div class="admin_title">
			Processing Order Detail
		</div>
		
		<div class="back_button_completed">
			<a href="admin_uncomplete_order.php?page=1">Back</a>
		</div>
		<?php
		while($result_purchase = mysqli_fetch_assoc($sql_purchase))
		{	
		?>
			<div class="admin_view_uncomplete_order_detail_big_wrapper1">
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Order ID </div>
					<div class="uncomplete_order_detail_info"> 
						<span> : </span>
						<?php echo $purchase_id;?>
					</div>
				</div>
				
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Order Date And Time </div>
					<div class="uncomplete_order_detail_info"> 
						<span> : </span>
						<?php echo $result_purchase["purchase_time"];?>
					</div>
				</div>
				
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Customer ID </div>
					<div class="uncomplete_order_detail_info"> 
						<span> : </span>
						<?php echo $result_purchase["member_id"];?>
					</div>
				</div>
				
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Delivery Name </div>
					<div class="uncomplete_order_detail_info"> 
						<span> : </span>
						<?php echo $result_purchase["purchase_ship_name"];?>
					</div>
				</div>
				
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Delivery Phone </div>
					<div class="uncomplete_order_detail_info"> 
						<span> : </span>
						<?php echo $result_purchase["purchase_phone"];?>
					</div>
				</div>
				
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Delivery Address </div>
					<div class="uncomplete_order_detail_info"> 
						<span> : </span>
						<?php echo $result_purchase["purchase_address"]." ". $result_purchase["purchase_postcode"]." ". $result_purchase["purchase_city"]." ". $result_purchase["purchase_state"];?>
					</div> 
				</div>
				
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Total Payment</div>
					<div class="uncomplete_order_detail_info"> 
						<span> : </span>
						<?php echo "RM".$result_purchase["purchase_total"];?>
					</div>
				</div>
				
				<div class="admin_view_uncomplete_order_detail_small_wrapper">
					<div class="uncomplete_order_detail_title"> Status</div>
					<div class="uncomplete_order_detail_info"> 
						<ul class="update_order_detail">
						<li>
							<span> : </span>
						</li>
				<form name="update_order" method="post" action="" >
						<li>
							<select class="update_order_select" name="product_status">
								<option value="processing" <?php if($result_purchase["purchase_status"] == "processing") echo "selected";?>>Processing</option>
								<option value="shipped" <?php if($result_purchase["purchase_status"] == "shipped") echo "selected";?>>Shipped</option>
								<option value="delivered" <?php if($result_purchase["purchase_status"] == "delivered") echo "selected";?>>Delivered</option>
								<option value="cancelled" <?php if($result_purchase["purchase_status"] == "cancelled") echo "selected";?>>Cancelled</option>
							</select>
						</li>
						</ul>
					</div>
				</div>
			
					<input type="submit" name="update_order_btn" class="order_update_btn" value="UPDATE">
				</form>
			</div>
		<?php
		}
		?>
		<table class="admin_view_uncomplete_order_detail_table" border="1">
			<tr class="admin_view_uncomplete_order_detail_table_tr1">
				<td class="admin_view_uncomplete_order_detail_table_td1" style="width:15%;"> Product Image </td>
				<td class="admin_view_uncomplete_order_detail_table_td1" style="width:45%;"> Product Name </td>
				<td class="admin_view_uncomplete_order_detail_table_td1" style="width:13.33%;"> Power </td>
				<td class="admin_view_uncomplete_order_detail_table_td1" style="width:13.33%;"> Product Quantity </td>
				<td class="admin_view_uncomplete_order_detail_table_td1" style="width:13.33%;"> Product Price </td>
			</tr>
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
			<tr class="admin_view_uncomplete_order_detail_table_tr">
				<td class="admin_view_uncomplete_order_detail_table_td"> <img src="../<?php echo $row_img['image_img']; ?>"> </td>
				<td class="admin_view_uncomplete_order_detail_table_td"> <?php echo $row_product["product_name"];?> </td>
				<td class="admin_view_uncomplete_order_detail_table_td"> 
					<ul class="order_detail_power_ul">
						<li class="order_detail_power_li"><?php echo 'Left <span class="order_special_detail">:</span>'.$row_product["product_shopping_cart_power_left"];?></li>
						<li class="order_detail_power_li"><?php echo 'Right :'.$row_product["product_shopping_cart_power_right"];?></li>
					</ul>
				</td>
				<td class="admin_view_uncomplete_order_detail_table_td"> <?php echo $row_product["product_shopping_cart_quantity"];?> </td>
				<td class="admin_view_uncomplete_order_detail_table_td">  <?php echo $row_product["product_price"];?> </td>
			</tr>
		<?php
		}
		?>
		</table>
		
	</div>
</div>

<?php

if (isset($_POST["update_order_btn"]))
{
	$product_status = $_POST["product_status"];
	
	$result_insert = mysqli_query($conn," update purchase set purchase_status = '$product_status' where purchase_id = $purchase_id");		
	
	if($result_insert == 1)
	{
		echo "<script>alert('Update Status Successful')</script>";
		echo "<script>location.href='admin_uncomplete_order.php?page=1'</script>";
	}
}
?>