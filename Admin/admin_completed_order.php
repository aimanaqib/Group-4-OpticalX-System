<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		
?>
<title>Completed Order</title>
<?php include 'side_menu_admin.php'; ?>


<div class="admin_all_wrapper">
	<div class="admin_view_uncomplete_order">
	
		<div class="admin_title">
			Order History
		</div>
		<form method="post" action="pdf.php"  target="_blank">
			<div class="convert_pdf">
				<div class="month_year_div">
					Key in the year and month :<input type="text" name="year_month_pdf"  autocomplete="off" class="year_month_pdf" pattern="[0-9]{6}" Placeholder="Enter the Year And Month" required><br>
					<span class="notification_color"><small>*Example Generate 2018 January report Enter 201801</small></span>
				</div>
				<input type="submit" name="btnpdf" value="Generate Report" class="ppdf" />
			</div>
		</form>
		
		<div class="admin_search_product">
				<form name="product_search" action="admin_completed_order_search.php" method="post">
					<ul class="search_wrapper_product">
						<li class="product_top_search_left">
							<input type="text" name="search" autocomplete="off" class="product_top_searching_bar" placeholder="search by order id , member id , status , order date">
						</li>
						<li class="product_top_search_right">
							<button type="submit" name="search_btn" class="class_button_search_complete_order">
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
		$page = $_GET["page"];
				
		if($page == "" || $page == "1")
		{ $page1 = 0;
		}
		else
		{ $page1 = ($page - 1) * 7;
		}
				
		$sql_purchase = mysqli_query($conn, "select * from purchase,shopping_cart,member where 
									(purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'delivered') 	
									OR (purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'cancelled') limit $page1,7");


		$count_completed_purchase = mysqli_num_rows($sql_purchase);
	
		if($count_completed_purchase == 0)
		{
			?>
			<div class='no_completed_purchase'>NO COMPLETED ORDER</div>
			<?php
		}
		else
		{	
			while($result_purchase = mysqli_fetch_assoc($sql_purchase))
			{
			?>
			<ul class="admin_view_uncomplete_order_content_ul">
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase['purchase_id'];?></li>
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase["member_id"];?></li>
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase["purchase_time"];?></li>
				<li class="admin_view_uncomplete_order_content_li"><?php echo $result_purchase["purchase_status"];?></li>
				<li class="admin_view_uncomplete_order_content_li"><a href="admin_view_completed_order_detail.php?purchase_id=<?php echo $result_purchase['purchase_id'];?>">View Details</a></li>
			</ul>
			<?php
			}
		}
				
			$sql_page_purchase = mysqli_query($conn, "select * from purchase,shopping_cart,member where 
									(purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'delivered') 	
									OR (purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'cancelled')");


			$count_page_completed_purchase = mysqli_num_rows($sql_page_purchase);
			
			$a = ceil($count_page_completed_purchase/7);
			?>
			<div class="pagination_wrapper_div">
				<div class="pagination_padding">
				<?php
				for($b=1; $b<=$a; $b++)
				{ 
					?>
					<a href="admin_completed_order.php?page=<?php echo $b; ?>">
						<div class="pagination">
							<?php echo $b. " " ?>
						</div>
					</a>
					<?php
				}		
				?>
				</div>
			</div>
</div>