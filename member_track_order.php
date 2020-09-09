<?php include("connection.php"); 

$member_id = $_SESSION["sess_memid"];

			
?>

<title>Track Order</title>

<?php include 'header.php'; ?>

<div class="member_track_order_wrapper">
	<div class="row">
		<div class="twelve columns">	
			<ul class="member_track_ul">
				<li class="member_track_li"> <input type="button" class="member_track_button" value="Processing Order" onclick="processing()"> </li>
				<li class="member_track_li"> <input type="button" class="member_track_button" value="Completed Order" onclick="completed()"> </li>
			</ul>
			
			
			<div class="processing_wrapper" id="processing">
				<ul class="processing_wrapper_title_ul">
					<li class="processing_wrapper_content_li">Order Code</li>
					<li class="processing_wrapper_content_li">Order Date And Time</li>
					<li class="processing_wrapper_content_li">Order Status</li>
					<li class="processing_wrapper_content_li">Action</li>
				</ul>
				
			<?php
				$sql_track_processing = mysqli_query($conn, "select * from purchase,shopping_cart,member 
										where 
										(purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'processing' AND member_id = $member_id ) 	
										OR (purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'shipped' AND member_id = $member_id) ORDER BY `purchase`.`purchase_time` DESC");
				
				$count_processing = mysqli_num_rows($sql_track_processing);
				if($count_processing == 0)
				{
				?>
					<div class='no_detail'>NO PROCESSING OR SHIPPED ORDER</div>
				<?php
				}
				else
				{
				
					while($row_processing = mysqli_fetch_assoc($sql_track_processing))
					{
				?>	
					<ul class="processing_wrapper_title_ul">
						<li class="processing_wrapper_content_li"> <?php echo "00".$row_processing['purchase_id'];?></li>
						<li class="processing_wrapper_content_li"> <?php echo $row_processing['purchase_time'];?></li>
						<li class="processing_wrapper_content_li">	<?php echo $row_processing['purchase_status'];?></li>
						<li class="processing_wrapper_content_li"><a class="link_to_order_detail" href="member_view_order_detail.php?purchase_id=<?php echo $row_processing['purchase_id'];?>">View Details</a></li>
					</ul>
				<?php
					}
				}
				?>
				
			</div>
			
			<div class="completed_wrapper" id="completed">
				<ul class="processing_wrapper_title_ul">
					<li class="processing_wrapper_content_li_re">Order Code</li>
					<li class="processing_wrapper_content_li_re">Order Date And Time</li>
					<li class="processing_wrapper_content_li_re">Order Status</li>
					<li class="processing_wrapper_content_li_re">Action</li>
					<li class="processing_wrapper_content_li_re">Receipt</li>
				</ul>
				
			<?php
				$sql_track_completed = mysqli_query($conn, "select * from purchase,shopping_cart,member 
										where 
										(purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'delivered' AND member_id = $member_id ) 	
										OR (purchase_shopping_cart_id = shopping_cart_id AND shopping_cart_member_id = member_id AND purchase_status = 'cancelled' AND member_id = $member_id) ORDER BY `purchase`.`purchase_time` DESC");
				$count_completed = mysqli_num_rows($sql_track_completed);

				if($count_completed == 0)
				{
				?>
					<div class='no_detail'>NO COMPLETED OR CANCELLED ORDER</div>
				<?php
				}
				else
				{
					while($row_completed = mysqli_fetch_assoc($sql_track_completed))
					{
					
					?>	
					<ul class="processing_wrapper_title_ul">
						<li class="processing_wrapper_content_li_re"> <?php echo "00".$row_completed['purchase_id'];?></li>
						<li class="processing_wrapper_content_li_re"> <?php echo $row_completed['purchase_time'];?></li>
						<li class="processing_wrapper_content_li_re">	<?php echo $row_completed['purchase_status'];?></li>
						<li class="processing_wrapper_content_li_re"><a class="link_to_order_detail" href="member_view_order_detail.php?purchase_id=<?php echo $row_completed['purchase_id'];?>">View Details</a></li>
						<li class="processing_wrapper_content_li_re">
							<form method="post" action="member_pdf.php?purchaseid=<?php echo $row_completed['purchase_id']; ?>"  target="_blank" style="margin-bottom:0;">
								<div class="convert_pdf">
									<input type="submit" name="btnpdf" value="Receipt" class="ppdf" />
								</div>
							</form>
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

<?php include 'footer.php'; ?>


<script>
function processing(){
	document.getElementById('processing').style.display ='block';
	document.getElementById('completed').style.display ='none';
}
function completed(){
	document.getElementById('processing').style.display ='none';
	document.getElementById('completed').style.display ='block';
}


</script>