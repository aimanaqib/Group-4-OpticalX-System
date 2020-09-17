<?php include("connection.php"); ?>

<title>Product Detail</title>

<?php include 'header.php'; 


	$pid = $_REQUEST["pid"]; 		
	$result = mysqli_query($conn,"select * from product where product_id = $pid");
	$row = mysqli_fetch_assoc($result);
	$product_price = $row["product_price"];
	$sql_img = mysqli_query($conn, "select * from image where image_product_id = $pid and image_trash='0'");
	$row_pic = mysqli_num_rows($sql_img);
	$row_img = mysqli_fetch_assoc($sql_img);
	$sql_brand = mysqli_query($conn, "select * from brand,product where product_brand_id = brand_id and product_id = $pid and brand_trash='0' ");
	$row_brand = mysqli_fetch_assoc($sql_brand);	
?>
<form name="purchasefrm" method="post" action="">
	<div id="product_details_wrapper">
		<div class="row">
			<div class="five columns">
				<div class="product_details_img">
					<?php
					
					?>
					<div class="gallery_wrapper">
					<?php
					if($row_pic == 0)
					{	
					?><img src="images/brand/no_img.jpg" id="expandedImg"> <?php
					}
					else
					{
					?>
					  <img src="<?php echo $row_img["image_img"];?>" id="expandedImg"> 
					  <?php
					}
					?>
					</div>
						
					<ul class="pd_gallery_row">
					<?php
					$sql_img = mysqli_query($conn, "select * from image where image_product_id = $pid and image_trash='0'");
					$row_pic = mysqli_num_rows($sql_img);
					while($row_img = mysqli_fetch_assoc($sql_img))
					{
					?>
						 <li class="pd_gallery_small">
						 <?php
						if($row_pic == 0 )
						{	
						?>
							<img src="images/brand/no_img.jpg" style="width:100%" onclick="pd_gallery_change(this);">
						<?php
						}
						else
						{
						?>
							<img src="<?php echo $row_img["image_img"];?>" style="width:100%" onclick="pd_gallery_change(this);">
						<?php
						}
						?>
						 </li> 
					<?php
					}
					?>
					</ul>
				</div>
			</div>
			
			
			<div class="seven columns">
				<div class="product_details">
					<div class="pd_brand_name"><?php echo $row_brand["brand_name"]; ?></div>
					<div class="pd_product_name"><?php echo $row["product_name"]; ?></div>
					<div class="pd_price">RM <?php echo $row["product_price"];?></div>
					<div class="pd_qty">Quantity : <input type="number" name="product_quantity" min="0" max="<?php echo $row["product_stock"]; ?>" class="input_quantity_detail" required></div>
					<div class="pd_option_p"> Kindly select your purchase options </div>
						<div class="input_type_radio">
							<input type="radio" name="check_frame" value="no_power" onclick="no_power();" checked="checked"/ required> Frame Only
							<input type="radio" name="check_frame" value="power" onclick="have_power();" /> Frame With Power
						</div>
						
						<div id="frame_power" class="with_frame_power">
							<form name="frame_power_form">
								<span class="left_power">Left Power  : <input type='number' max="1000" name='left_power' size='5' class="power_detail"> </span>
								<span class="right_power">Right Power : <input type='number' max="1000" name='right_power' size='5' class="power_detail" ></span>
							</form>
						</div>
						
					<div>
						<input type="submit"  value="Add to Cart" name="purchasebtn" class="pd_add_cart" />
						<input type="submit"  value="Add to Wishlist" name="wishlistbtn" class="pd_add_cart" />
					</div>
					
				</div>
				
				<input type="button" class="product_details_description product_details_description_add" onclick="description()" value="Description">

			<!--	<input type="button" class="product_details_description" onclick="addtional_information()" value="Addtional Information"> -->

				<input type="button" class="product_details_description" onclick="review()" value="Addtional Review">

				
				<div class="description_details_content" id="description_details">
					<p><?php echo $row["product_description"];?></p> 
					
					
				</div>
				
				<div class="add_info_content" id="add_info_details">
				
					<div class="add_info_content_design">
						<p><?php echo $row["product_additional_information"];?></p>
					</div>
					
				</div>
				
				<div class="review_details_content" id="review_details">
				   
				   
				   <div id="one_review">
						<?php 
						$review = mysqli_query($conn,"select * from member, review, product where review_product_id = product_id And review_member_id=member_id And product_id = $pid");
						$all_review = mysqli_fetch_assoc($review);	
						$count_review = mysqli_num_rows($review);	
						
						if($count_review != 0)
						{
							?>
							<fieldset class="review_field_set">
								<legend class="title_review"><span><?php echo $all_review["member_name"];?></span></legend>
								<div class="comment_content">
									<p><?php echo $all_review["review_content"];?></p>
									<p class="review_date"><?php echo $all_review["review_date"]; ?></p>
								</div>
							</fieldset>
							
							<?php
							if($count_review >= 2)
							{
								?>
								<div class="review_view_more">
									<button type="button" class="view_more_button" onclick="review_view_more()">View More</button>
								</div>
								<?php
							}
							
						}
						else
						{
							echo "";
						}

						?>
				   </div>
				   
				   <div id="all_review">
						<?php 
					   $review = mysqli_query($conn,"select * from member, review, product where review_product_id = product_id And review_member_id=member_id And product_id = $pid");
						$count_review = mysqli_num_rows($review);

						if($count_review !=0 )
						{
							while($all_review = mysqli_fetch_assoc($review))
							{
								?>
							<fieldset class="review_field_set">
								<legend class="title_review"><span><?php echo $all_review["member_name"];?></span></legend>
								<div class="comment_content">
									<p><?php echo $all_review["review_content"];?></p>
									<p class="review_date"><?php echo $all_review["review_date"]; ?></p>
								</div>
							</fieldset>
<?php
							}
							?>
							<div class="review_view_more">
								<button type="button" class="view_more_button" onclick="review_view_Less()">View Less</button>
							</div>
							<?php
							
						}
						else
						{
							echo "";	
						}
							?>
					</div>
					
					<form method="post" action="">
						<textarea class="textarea_review" name="review_content" rows="3" cols="40" placeholder="Please Comment After You Have Received The Product (Maximun 500 Words)"></textarea>
						<div class="input_review_div"><input type="submit" name="review_submit" class="review_submit" value="Submit"></div>
					</form>
				</div>
					
				
				
			</div>
			
		</div>
	</div>
</form>


<?php include 'footer.php'; ?>


<script>
function no_power(){
	document.getElementById('frame_power').style.display ='none';
}
function have_power(){
	document.getElementById('frame_power').style.display = 'block';
}
function description(){
	document.getElementById('description_details').style.display ='block';
//	document.getElementById('add_info_details').style.display ='none';
	document.getElementById('review_details').style.display ='none';
}
function review_view_more(){
	document.getElementById('one_review').style.display ='none';
	document.getElementById('all_review').style.display ='block';
}
function review_view_Less(){
	document.getElementById('one_review').style.display ='block';
	document.getElementById('all_review').style.display ='none';
}

//function addtional_information(){
//	document.getElementById('description_details').style.display ='none';
//	document.getElementById('add_info_details').style.display ='block';
//	document.getElementById('review_details').style.display ='none';
//}

function review(){
	document.getElementById('description_details').style.display ='none';
//	document.getElementById('add_info_details').style.display ='none';
	document.getElementById('review_details').style.display ='block';
}
function pd_gallery_change(imgs) {
	var expandImg = document.getElementById("expandedImg");
    expandImg.src = imgs.src;
    expandImg.parentElement.style.display = "block";
}
</script>

<?php
if(isset($_POST["purchasebtn"]))
{	
	if($_SESSION["loggedin"] == 0)
	{
		echo "<script>alert('Please Register and Login before adding product to the shopping cart')</script>";
		echo "<script>location.href='member_login.php'</script>";
	}
	else 
	{	$member_id = $_SESSION["sess_memid"]; 
		$prod_id = $_REQUEST["pid"]; 
		$left_power = $_POST["left_power"];
		$right_power = $_POST["right_power"];
		$prod_quantity = $_POST["product_quantity"];
		$radio_check = $_POST["check_frame"];
		$qty = $_POST["product_quantity"];
		
		$sql_shopping_cart =  mysqli_query($conn ,"select * from shopping_cart where shopping_cart_member_id = $member_id and shopping_cart_type = 'unpaid'");
		$row_shopping_cart = mysqli_fetch_assoc($sql_shopping_cart);	
		$shopping_cart_id = $row_shopping_cart['shopping_cart_id'];
		
		
		$result = mysqli_query($conn,"select * from product where product_id = $prod_id");
		$row = mysqli_fetch_assoc($result);
		$stock = $row["product_stock"];
		$balance = $stock - $qty;
		if($stock == 0 && $prod_quantity == 0)
		{	echo "<script>alert('Sorry, The Product s Out Of Stock')</script>";
			echo "<script>location.href='member_product_details.php?pid=$prod_id'</script>";
		}
		else if($prod_quantity == 0)
		{	echo "<script>alert('Please select the quantity')</script>";
			echo "<script>location.href='member_product_details.php?pid=$prod_id'</script>";
		}
		else
		{
		mysqli_query($conn,"update product set product_stock=$balance where product_id = $prod_id");
		
		print_r($radio_check);
		print_r($product_price);
		if( $radio_check =='no_power')
			{
				mysqli_query($conn, "insert into product_shopping_cart (product_shopping_cart_quantity,product_shopping_cart_price,product_shopping_cart_power_left,product_shopping_cart_power_right,product_shopping_cart_product_id,product_shopping_cart_shopping_cart_id,product_shopping_cart_review_status) values ('$prod_quantity',$product_price,'0','0','$prod_id','$shopping_cart_id','cannot')");
			}
		elseif($radio_check == 'power')
			{
				mysqli_query($conn, "insert into product_shopping_cart (product_shopping_cart_quantity,product_shopping_cart_price,	product_shopping_cart_power_left,product_shopping_cart_power_right,product_shopping_cart_product_id,product_shopping_cart_shopping_cart_id,product_shopping_cart_review_status) values ('$prod_quantity',$product_price,'$left_power','$right_power','$prod_id','$shopping_cart_id','cannot')");
			}
		?>
		<script type="text/javascript">
			alert("Product has been add succesfully");
		</script>
		<?php	
		}
	}
}

if(isset($_POST["review_submit"]))
{
	$comment = $_POST["review_content"];
	$comment = mysqli_real_escape_string($conn, $comment);
	$member_id = $_SESSION["sess_memid"]; 
	$prod_id = $_REQUEST["pid"]; 
	$date = date("Y-m-d");
	$sql_review = mysqli_query($conn, "Select * from product,shopping_cart,product_shopping_cart,purchase,member where
										product_id = product_shopping_cart_product_id 
										AND shopping_cart_id = product_shopping_cart_shopping_cart_id
										AND purchase_shopping_cart_id = shopping_cart_id
										AND shopping_cart_member_id = member_id
										AND product_id = $prod_id
										AND member_id = $member_id
										AND shopping_cart_type = 'paid'
										AND product_shopping_cart_review_status = 'havent'
										AND purchase_status = 'delivered'" );
	$count_sql_review = mysqli_num_rows($sql_review);
	$row_sql_review = mysqli_fetch_assoc($sql_review);
	
	$product_shopping_cart_id = $row_sql_review["product_shopping_cart_id"];
	
	if($count_sql_review != 0)
	{
		mysqli_query($conn, "INSERT INTO `review`(`review_content`, `review_product_id`, `review_member_id`, `review_date`) VALUES ('$comment','$prod_id','$member_id','$date')");
		$review_id = mysqli_insert_id($conn);
		
		mysqli_query($conn, "update product_shopping_cart set product_shopping_cart_review_status = 'Completed' where product_shopping_cart_id = $product_shopping_cart_id");
		
		echo "<SCRIPT type='text/javascript'>alert('Thankyou For Your Comment for the product ');
		window.location.replace(\"member_product_details.php?pid=$prod_id\");</SCRIPT>";
	}
	else
	{
		echo "<SCRIPT type='text/javascript'>alert('Please Comment after you have received the product');</SCRIPT>";
	}
	
}
if(isset($_POST["wishlistbtn"]))
{ 	
	if($_SESSION["loggedin"] == 0)
	{
		echo "<script>alert('Please Register and Login before adding product to the Wishlist')</script>";
		echo "<script>location.href='member_login.php'</script>";
	}
	else
	{
		$member_id = $_SESSION["sess_memid"]; 
		$prod_id = $_REQUEST["pid"]; 
		
		$sql_wishlist =  mysqli_query($conn ,"select * from wishlist where wishlist_member_id = $member_id");
		$row_wishlist = mysqli_fetch_assoc($sql_wishlist);	
		$wishlist_id = $row_wishlist['wishlist_id'];

		$sql_wishlist_product = "select * from wishlist,wishlist_product where 
									wishlist_product_wishlist_id = $wishlist_id 
								and wishlist_product_product_id = $prod_id";
		$result_sql_wishlist_product = mysqli_query($conn, $sql_wishlist_product);

		if(mysqli_num_rows($result_sql_wishlist_product) != 0)
		{
			echo "<SCRIPT type='text/javascript'>
			alert('Product Already Added To The Wishlist');
			</SCRIPT>";
		}
		else
		{
			mysqli_query($conn,"INSERT INTO `wishlist_product`(`wishlist_product_wishlist_id`, `wishlist_product_product_id`) VALUES ($wishlist_id,$prod_id)");
			
			echo "<SCRIPT type='text/javascript'>
			alert('Product add to Wishlist succesfully');
			</SCRIPT>";
			
		}
	}
}
?>
