<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");		

$admin_id = $_SESSION["sess_adid"]; 

$result = mysqli_query($conn, "select * from admin where admin_id = $admin_id");
$row = mysqli_fetch_assoc($result);


?>
<title>Dashboard</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="admin_dashboard_wrapper">
		<div class="row">
			<div class="twelve columns">
				<div class="dashboard_left">
					<div class="dashboard_top">
						<div class="dashboard_top_name">
						<?php

							echo "<p>Current Admin : ".$row['admin_name']."</p>";
						?>
						</div>
					
						<div class="dashboard_top_date_time">
							<?php
								date_default_timezone_set("Asia/Kuala_Lumpur"); 
								echo "<p> Date : ".date('Y-m-d')." Time :  <span id='time'></span></p>";
							?>
								
						</div>
					</div>
					
					<div class="dashboard_wrapper">
						<ul class="dashboard_right">
							<li class="dashboard_small_board">
								<div class="dashboard_small_board_left">
									<img src="../images/admin/total_member_icon.png">
								</div>
								
								<div class="dashboard_small_board_right">
									<?php
										$result_member = mysqli_query($conn, "select * from member");
										$count_member = mysqli_num_rows($result_member);
										echo $count_member ;
									?>
								</div>
								
								<p>TOTAL MEMBER</p>
							</li>
						
							<li class="dashboard_small_board">
								<div class="dashboard_small_board_left">
									<img src="../images/admin/product_icon.png">
								</div>

								<div class="dashboard_small_board_right">
									<?php
										$result_product = mysqli_query($conn, "select * from product");
										$count_product = mysqli_num_rows($result_product);
										echo $count_product ;
									?>
								</div>
								
								<p>TOTAL PRODUCT</p>
							</li>
							
							<li class="dashboard_small_board">
								<div class="dashboard_small_board_left">
									<img src="../images/admin/comment_icon.png">
								</div>
								
								<div class="dashboard_small_board_right">
									<?php
										$result_review = mysqli_query($conn, "select * from review");
										$count_review = mysqli_num_rows($result_review);
										echo $count_review ;
									?>
								</div>
								
								<p>TOTAL REVIEW</p>
							</li>
						
							<li class="dashboard_small_board">
								<div class="dashboard_small_board_left">
									<img src="../images/admin/order_icon.png">
								</div>

								<div class="dashboard_small_board_right">
									<?php
										$result_order = mysqli_query($conn, "select * from purchase,shopping_cart,member where purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'delivered'");
										$count_order = mysqli_num_rows($result_order);
										echo $count_order ;
									?>
								</div>
								
								<p>TOTAL ORDER</p>
							</li>					
						</ul>
					</div>	
						
					<div class="dashboard_bottom">
						<div class="dashboard_button">
							<input type="button" class="dashboard_button_cls" onclick="outstanding_order()" value="Outstanding Orders">
							<input type="button" class="dashboard_button_cls" onclick="out_of_stock()" value="Out Of Stock">
							<input type="button" class="dashboard_button_cls" onclick="product_review()" value="Product Review">
						</div>
					</div>
				</div>
			
				<div class="admin_dashboard_box" id="dashboard_outstanding_order">
					<?php
						$sql_order = mysqli_query($conn, "select * from purchase,shopping_cart,member 
									where purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'processing'");
						$count_order = mysqli_num_rows($sql_order);
						if($count_order == 0)
						{
							echo"<div class='no_record_dashboard'>No Outstanding Order</div>";
						}
						else
						{
						?>
							<ul class="outstanding_order_ul">
								<li class="outstanding_order_li">Order ID</li>
								<li class="outstanding_order_li">Member ID</li>
								<li class="outstanding_order_li">Purchase Date</li>
								<li class="outstanding_order_li">Action</li>
							</ul>	
						<?php
							while($row_order = mysqli_fetch_assoc($sql_order))
							{
						?>
							<ul class="outstanding_order_ul">
								<li class="outstanding_order_li"><?php echo $row_order['purchase_id'];?></li>
								<li class="outstanding_order_li"><?php echo $row_order['member_id'];?></li>
								<li class="outstanding_order_li"><?php echo $row_order['purchase_time'];?></li>
								<li class="outstanding_order_li"><a href="admin_view_uncomplete_order_detail.php?purchase_id=<?php echo $row_order['purchase_id'];?>">UPDATE</a></li>
							</ul>	
						<?php
							}
						}
					?>
						
				</div>
				
				<div class="admin_dashboard_box" id="dashboard_out_of_stock">
				<?php
					$sql_out_of_stock = mysqli_query($conn, "select * from product where product_stock <= 5");
					$count_out_of_stock = mysqli_num_rows($sql_out_of_stock);
					if($count_out_of_stock ==0)
					{
						echo"<div class='no_record_dashboard'>No Out Of Stock Product</div>";
					}
					else
					{
					?>
						<ul class="outstanding_order_ul">
							<li class="outstanding_order_li">Product ID</li>
							<li class="outstanding_order_li">Product Name</li>
							<li class="outstanding_order_li">Product Stock</li>
							<li class="outstanding_order_li">Action</li>
						</ul>	
					<?php
						while($result_out_of_stock = mysqli_fetch_assoc($sql_out_of_stock))
						{
					?>
						<ul class="outstanding_order_ul">
							<li class="outstanding_order_li"><?php echo $result_out_of_stock['product_id'];?></li>
							<li class="outstanding_order_li"><?php echo $result_out_of_stock['product_name'];?></li>
							<li class="outstanding_order_li"><?php echo $result_out_of_stock['product_stock'];?></li>
							<li class="outstanding_order_li"><a href="admin_view_product_detail.php?pid=<?php echo $result_out_of_stock['product_id'];?>">UPDATE</a></li>
						</ul>	
					<?php
						}
					}
				?>
						
				</div>
				
				<div class="admin_dashboard_box" id="dashboard_product_review">
					<?php
					$sql_review = mysqli_query($conn, "select * from review,product, member where review_member_id=member_id And review_product_id=product_id");
					$count_review = mysqli_num_rows($sql_review);
					if($count_review ==0)
					{
						echo"<div class='no_record_dashboard'>No Review Found</div>";
					}
					else
					{
					?>
						<ul class="outstanding_order_ul">
							<li class="outstanding_order_li_review">Product</li>
							<li class="outstanding_order_li_review">Reviewer</li>
							<li class="outstanding_order_li_review">Date</li>
							<li class="outstanding_order_li_special_review">Review</li>
							<li class="outstanding_order_li_review">Status</li>
						</ul>	
					<?php
						while($result_review = mysqli_fetch_assoc($sql_review))
						{
					?>
						<ul class="outstanding_order_ul">
							<li class="outstanding_order_li_review"><?php echo $result_review['product_name'];?></li>
							<li class="outstanding_order_li_review"><?php echo $result_review['member_name'];?></li>
							<li class="outstanding_order_li_review"><?php echo $result_review['review_date'];?></li>
							<li class="outstanding_order_li_special_review short_review"><?php echo $result_review['review_content'];?></li>
							<li class="outstanding_order_li_review">
								<a href="admin_view_product_review_detail.php?review_id=<?php echo $result_review['review_id'];?>">
									View Detail
								</a>
							</li>
						</ul>	
					<?php
						}
					}
				?>
				</div>
			</div>
		</div>	
	</div>
</div>


<script>

function setTime() {
var d = new Date(),
  el = document.getElementById("time");

  el.innerHTML = formatAMPM(d);

setTimeout(setTime, 1000);
}

function formatAMPM(date) {
  var hours = date.getHours(),
    minutes = date.getMinutes(),
    seconds = date.getSeconds(),
    ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
  return strTime;
}

setTime();

function outstanding_order(){
	document.getElementById('dashboard_outstanding_order').style.display ='block';
	document.getElementById('dashboard_out_of_stock').style.display ='none';
	document.getElementById('dashboard_product_review').style.display ='none';
}

function out_of_stock(){
	document.getElementById('dashboard_outstanding_order').style.display ='none';
	document.getElementById('dashboard_out_of_stock').style.display ='block';
	document.getElementById('dashboard_product_review').style.display ='none';	
}

function product_review(){
	document.getElementById('dashboard_outstanding_order').style.display ='none';
	document.getElementById('dashboard_out_of_stock').style.display ='none';
	document.getElementById('dashboard_product_review').style.display ='block';	
}

</script>