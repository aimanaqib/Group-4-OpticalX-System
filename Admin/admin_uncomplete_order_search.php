<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		
?>
<title>Uncompleted Order Search</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_view_uncomplete_order">
	
		<div class="admin_title">
			Processing Order
		</div>
		<form method="post" action="pdf.php"  target="_blank">
			<div class="convert_pdf">
				<input type="submit" name="btnpdf" value="Convert To PDF" class="ppdf" />
			</div>
		</form>
		
		<div class="admin_search_product">
				<form name="product_search" action="admin_uncomplete_order_search.php" method="post">
					<ul class="search_wrapper_product">
						<li class="product_top_search_left">
							<input type="text" name="search" autocomplete="off" class="product_top_searching_bar" placeholder="search by order id , member id , status , order date">
						</li>
						<li class="product_top_search_right">
							<button type="submit" name="btnsearch" class="uncomplete_order_search">
								<img src="../images/admin/search.png" class="imgase_search"/>
							</button>
						</li>
					</ul>
				</form>
		</div>
		
		<ul class="admin_view_uncomplete_order_title_ul">
			<li class="admin_view_uncomplete_order_title_li">Order Code</li>
			<li class="admin_view_uncomplete_order_title_li">Order Member ID</li>
			<li class="admin_view_uncomplete_order_title_li">Order Date And Time</li>
			<li class="admin_view_uncomplete_order_title_li">Order Status</li>
			<li class="admin_view_uncomplete_order_title_li">Action</li>
		</ul>
		<?php
if(isset($_POST['btnsearch']))
{ 
   $search = $_POST['search'];
   $query = mysqli_query($conn, "select * from purchase,shopping_cart,member where ((purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'processing') 	
									OR (purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'shipped')) And ((purchase_id like '%$search%') or (member_id like '%$search%') or (purchase_time like '%$search%') or (purchase_status like '%$search%'))");
   	$count_completed_purchase = mysqli_num_rows($query);
	
		if($count_completed_purchase == 0)
		{
			?>
			<div class='no_completed_purchase'>NO RECORD FOUND</div>
			<?php
		}
		else
		{	
			while($result_purchase = mysqli_fetch_assoc($query))
			{
			?>
			<ul class="admin_view_uncomplete_order_content_ul">
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase['purchase_id'];?></li>
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase["member_id"];?></li>
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase["purchase_time"];?></li>
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase["purchase_status"];?></li>
				<li class="admin_view_uncomplete_order_content_li"><a href="admin_view_uncomplete_order_detail.php?purchase_id=<?php echo $result_purchase['purchase_id'];?>">View Details</a></li>
			</ul>
			<?php
			}
		}
}	
			?>	
	</div>
</div>