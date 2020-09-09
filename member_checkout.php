<?php 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: member_login.php");
   
$member_id = $_SESSION["sess_memid"]; 

$result_checkout = mysqli_query($conn, "select * from product, shopping_cart, product_shopping_cart, member
						where product_shopping_cart_shopping_cart_id = shopping_cart_id
						AND product_shopping_cart_product_id = product_id
						AND shopping_cart_type = 'unpaid'
						AND	shopping_cart_member_id = $member_id
						AND member_id = $member_id");
?>

<title>Checkout</title>

<?php include 'header.php'; ?>

<form method="post" action="">
	<div id="checkout_wrapper">
		<div class="row">
			<div class="twelve columns">
					<div class="checkout_title">
						<ul class="checked_title_ul">
							<li class="checked_title_li">Products Ordered</li>
							<li class="checked_title_li2">Power</li>
							<li class="checked_title_li2">Unit Price</li>
							<li class="checked_title_li2">Amount</li>
							<li class="checked_title_li2">Item Subtotal</li>
						</ul>
					</div>
					
					<div class="checkout_product">
						
						<?php
						$total = 0;
						$total_quantity =0;
						while($row_checkout = mysqli_fetch_assoc($result_checkout))
						{ 
							$product_id = $row_checkout["product_id"];
							$result_image = mysqli_query($conn, "select * from image where image_product_id = $product_id");	
							$row_image = mysqli_fetch_assoc($result_image);
							$subtotal = $row_checkout["product_shopping_cart_price"] * $row_checkout["product_shopping_cart_quantity"];
						?>
						<ul class="checkout_product_ul2">
							<li class="checkout_product_li"><img src="<?php echo $row_image["image_img"];?>"></li>
							<li class="checkout_product_li2"><?php echo $row_checkout["product_name"];?></li>
							<li class="checkout_product_li3">
								<ul class="checkout_power_ul">
								<?php
									$left_power = $row_checkout["product_shopping_cart_power_left"];
									$right_power = $row_checkout["product_shopping_cart_power_right"];
									if($left_power == 0 and $right_power == 0 )
									{
										echo "<li>No Power</li>";
									}
									else
									{
								?>
									<li class="checkout_power_li"><?php echo 'Left <span class="checkout_special">:</span> '.$row_checkout["product_shopping_cart_power_left"];?></li>
									<li class="checkout_power_li"><?php echo 'Right : '.$row_checkout["product_shopping_cart_power_right"];?></li>
								<?php
									}
								?>
								</ul>
							</li>
							<li class="checkout_product_li3"><?php echo "RM ".number_format($row_checkout["product_shopping_cart_price"],2);?></li>
							<li class="checkout_product_li3"><?php echo $row_checkout["product_shopping_cart_quantity"];?></li>
							<li class="checkout_product_li3"><?php echo "RM".number_format($subtotal,2);?></li>
						</ul>
						<?php
						$total += $subtotal;
						$total_quantity += $row_checkout["product_shopping_cart_quantity"];
						}
						?>
					</div>
					
					<div class="checkout_address">
						<p><img src="images/member/location_icon.png"><div class="title_of_ckadd"> Delivery Address </div></p>
						<?php
						$result_address = mysqli_query($conn, "select * from address where address_member_id = $member_id");
						$count_address = mysqli_num_rows($result_address);
						
						if($count_address == 0)
						{	
							?>
							<div class="address_button">
								<input type="button" name="add_new_add" value="Add New Address" class="member_profile_add_address" onclick="javascript:show_pop()">
							</div>
							<?php
						}
						else
						{ 
							while($row_address = mysqli_fetch_assoc($result_address))	
							{
							?>
								<p>
									<input type="radio" name="checkout_address" value="<?php echo $row_address["address_id"];?>" required> <span class="checkout_address_name">
										<?php echo $row_address["address_name"]."  +0".$row_address["address_phone"]; ?>
										<p class="add"><?php echo $row_address["address_content"]. ' ' .$row_address["address_postcode"]. ' ' .$row_address["address_city"]. ' ' .$row_address["address_state"];?></p></span> 
								</p>
								
								<p>
									<!-- <span class="checkout_address_num"><?php echo "+0".$row_address["address_phone"]." ".$row_address["address_content"]." " .$row_address["address_postcode"]. ' ' .$row_address["address_city"]. ' ' .$row_address["address_state"];?></span> --> 
									<!-- <span class="checkout_address_add"><?php echo $row_address["address_content"]. ' ,' .$row_address["address_postcode"]. ' ,' .$row_address["address_city"]. ' ,' .$row_address["address_state"];?></span> -->
								</p>
								
							<?php
							}	
							?>
							<div class="address_button">
								<input type="button" name="add_new_add" value="Add New Address" class="member_profile_add_address" onclick="javascript:show_pop()">
							</div>
							<?php
							
						}
							?>
						
					</div>
					<!--
					<div class="checkout_payment">
						<ul class="checkout_payment_ul">
							<li class="checkout_payment_li">Payment Method</li>
							<li class="checkout_payment_li2">
								<a	><img src="images/member/master_visa_payment.png" onclick="credit_debit_card()" alt="Credit/Debit Card"></a>
								
									<a><img src="images/payment_fpx_logo.png" onclick="fpx_banking()" alt="FPX"></a>
									<a><img src="images/online_banking_icon.png" onclick="online_banking()" alt="Online Banking / ATM "></a>
								
							</li>
						</ul>
					</div>
					-->
					<div class="payment_type_choosen">
						<div class="payment_type_visamaster_title">
							<p class="payment_type_choosen_title">Select Payment Card</p>
						</div>
						
						
						<div class="payment_type_visamaster" id="credit_debit_card">
							<?php
							$result_card = mysqli_query($conn, "select * from card_detail where card_member_id = $member_id");
							$y=0;
							$count_card = mysqli_num_rows($result_card);
							if($count_card == 0)
							{	
							?>
							<div class="card_button">
								<input type="button" name="add_new_add" value="Add New Card" class="member_profile_add_address" onclick="javascript:card_show_pop()">
							</div>
							<?php
							}
							else
							{ 
								while($row_card = mysqli_fetch_assoc($result_card))
								{	
									
									if( $row_card["card_type"] == "credit card")
										$card = "Credit Card";
									elseif($row_card["card_type"] == "debit card")
										$card = "Debit Card";
							?>
							<div class="radio_design">
								<div class="input_radio_div_checkout"><input type="radio" class="radio_checkout_card" name="checkout_card" value="<?php echo $row_card["card_detail_id"];?>" required> Card <?php echo $y+1;?></div>
								<div class="checkout_card">
									<div class="checkout_card_name"> <?php echo $row_card["card_holder_name"];?> </div>
									<div class="checkout_card_type"> <?php echo $card?> </div>
									<div class="checkout_card_no"> <?php echo $row_card["card_no"];?> </div>
									<div class="checkout_card_date"><?php echo "<small>VALID THRU</small> ".$row_card["card_expired_month"]."/".$row_card["card_expired_year"] ;?></div>						
								</div>
							</div>
							<?php
									$y++;
								}
							?>
						</div>
						<!--
						<div class="payment_type_fpx" id="fpx_banking">
							<img src="images/payment_fpx_logo.png">
								<form name="fpx_radio_btn">
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" value="Maybank">Maybank<br>
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" value="CIMB_Bank">CIMB Bank<br>
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" value="Public_Bank_Berhad">Public Bank Berhad<br>
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" value="RHB_Bank">RHB Bank<br>
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" value="Hong_Leong_Bank">Hong Leong Bank<br>
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" class="radio_fpx" value="AmBank">AmBank<br>
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" value="Bank_Rakyat">Bank Rakyat<br>
								  <input type="radio" name="payment_type_fpx" class="radio_fpx" value="OCBC_Bank">OCBC Bank<br>
								</form>
						</div>
						
							<div  id="online_banking">
								<ul class="payment_type_atm_online">
									<li class="atm_wrapper">
										<div class="atm_wrapper_left">
											<ul class="atm_wrapper_ul">
												<li class="atm_wrapper_li">
													<img src="images/cimb_icon.jpg">
												</li>
												<li class="atm_wrapper_li">
													<p>CIMB BANK</p>
												</li>
											</ul>
										</div>
										<div class="atm_wrapper_right">
											<p><div class="spacing_atm_wrapper">ACCOUNT NAME</div>: &nbsp;&nbsp;&nbsp;OPTICAL-X ONLINE </p>
											<p><div class="spacing_atm_wrapper">ACCOUNT NUMBER</div>: &nbsp;&nbsp;&nbsp;5133-4706-4251-06
										</div>
									</li>
									
									<li class="atm_wrapper">
										<div class="atm_wrapper_left">
											<ul class="atm_wrapper_ul">
												<li class="atm_wrapper_li">
													<img src="images/maybank_icon.jpg">
												</li>
												<li class="atm_wrapper_li">
													<p>MAYBANK</p>
												</li>
											</ul>
										</div>
										<div class="atm_wrapper_right">
											<p><div class="spacing_atm_wrapper">ACCOUNT NAME</div>: &nbsp;&nbsp;&nbsp;OPTICAL-X ONLINE </p>
											<p><div class="spacing_atm_wrapper">ACCOUNT NUMBER</div>: &nbsp;&nbsp;&nbsp;9642-3124-3562-24
										</div>
									</li>
									
									<li class="atm_wrapper">
										<div class="atm_wrapper_left">
											<ul class="atm_wrapper_ul">
												<li class="atm_wrapper_li">
													<img src="images/public_bank_icon.jpg">
												</li>
												<li class="atm_wrapper_li">
													<p>PUBLIC BANK BERHAD</p>
												</li>
											</ul>
										</div>
										<div class="atm_wrapper_right">
											<p><div class="spacing_atm_wrapper">ACCOUNT NAME</div>: &nbsp;&nbsp;&nbsp;OPTICAL-X ONLINE </p>
											<p><div class="spacing_atm_wrapper">ACCOUNT NUMBER</div>: &nbsp;&nbsp;&nbsp;2648-6420-9781-85
										</div>
									</li>
								</ul>
								<p class="upload_receipt_p">Please upload the receipt after u have transfer to us . Thankyou</p>
									<form name="upload_receipt_form">
										<label  class="upload_img_btn1">UPLOAD YOUR RECEIPT HERE
											<input type="file" accept="image/*" name="receipt_upload" class="upload_img_btn2">
										</label>
									</form>
							</div>
						-->
						<div class="checkout">
							
								<p>Confirm CVV : <input type="password" name="confirm_cvv" class="member_checkout_confirm_cvv" placeholder="Confirm The Cvv Of The Card That You Choose" required></p>
							
						</div>
					<div class="card_button">
							<input type="button" name="add_new_add" value="Add New Card" class="member_profile_add_address" onclick="javascript:card_show_pop()">
						</div>
						<?php
						}
						?>
					<div class="checkout_total_amount">
						<p><span class="checkout_total_amount_title">TOTAL PAYMENT</span>: &nbsp;&nbsp;&nbsp;&nbsp;<span class="checkout_total_amount_p"><?php  echo "RM".number_format($total,2);?></span></p>
					</div>
					
					<?php
						if($count_card == 0 or $count_address == 0 )
						{
							echo '';
						}
						else
						{
							echo "<p class='checkout_btn_position'><input type='submit' name='place_order_btn' value='PLACE ORDER' class='input_place_order'></p>";
						}
					?>		
				</div>
			</div>
		</div>
	</div>
</form>

<div class="pop_wrapper">
	<div id="pop_content" class="popup_container">
        <span onclick="close_pop()" class="pop_close_button">&times;</span>
		<form name="pop_out_add_form" method="post" action="">
		
			<div class="title_pop_add">
				<p>Add New Address</p>
			</div>
				<p><div class="profile_spacing">Name</div>
					<input type="text" name="profile_address_name" class="input_profile">
				</p>
				<p><div class="profile_spacing">Phone</div>
					<input type="text" name="profile_address_phone" class="input_profile">
				</p>
				<p><div class="profile_spacing">Address </div>
					<input type="text" name="profile_address_address" class="input_profile">
				</p>
				<p><div class="profile_spacing">Postcode</div>
					<input type="text" name="profile_address_postcode" class="input_profile">
				</p>
				<p><div class="profile_spacing">City</div>
					<input type="text" name="profile_address_city" class="input_profile">
				</p>
				<p><div class="profile_spacing">State</div>
					<select class="input_profile" name="profile_address_state" >
						<option value="" disabled selected >Select your region</option>
						<option value="Perlis">Perlis</option>
						<option value="Kedah">Kedah</option>
						<option value="Penang">Penang</option>
						<option value="Perak">Perak</option>
						<option value="Selangor">Selangor</option>
						<option value="Negeri Sembilan">Negeri Sembilan</option>
						<option value="Melaka">Melaka</option>
						<option value="Johor">Johor</option>
						<option value="Pahang">Pahang</option>
						<option value="Terengganu">Terengganu</option>
						<option value="Kelantan">Kelantan</option>
						<option value="Sabah">Sabah</option>
						<option value="Sarawak">Sarawak</option>
						<option value="Kuala Lumpur">Kuala Lumpur</option>
						<option value="Putrajaya">Putrajaya</option>
						<option value="Labuan">Labuan</option></select>
					</select>
				</p>
				<input type="submit" name="member_profile_address_submitbtn" Value="SAVE" class="member_profile_edit_submitbtn">
		</form>
	</div>
</div>


<div class="pop_wrapper">
	<div id="card_pop_content" class="popup_container">
        <span onclick="card_close_pop()" class="pop_close_button">&times;</span>
		<form name="profile_card" method="post" action="" class="add_new_card_form2">
			<p>
				<div class="profile_spacing3">Card Type</div>
				<div class="radio_Card">
					<input type="radio" name="card_type" value="credit card" required>Credit Card
					<input type="radio" name="card_type" value="debit card">Debit Card
				</div>	
			</p>
			<input type="text" name="card_holder_name" class="card_input" placeholder="Name on Card">
			<input type="text" name="card_no" class="card_input" placeholder="Card No.">
			<p class="add_card_p">Expires On <span> CVV </span> </p>
			<input type="text" name="card_exp_month" class="card_input2" placeholder="MM">
			<input type="text" name="card_exp_year" class="card_input2" placeholder="YYYY">
			<input type="password" name="card_cvv" class="card_input2" placeholder="000">
			<input type="submit" name="member_profile_add_card" class="member_profile_edit_submitbtn" value="SAVE">
		</form>	
	</div>
</div>

<?php include 'footer.php'; ?>

<script>
function credit_debit_card(){
	document.getElementById('credit_debit_card').style.display ='block';
	document.getElementById('fpx_banking').style.display ='none';
	document.getElementById('online_banking').style.display ='none';
}
function fpx_banking(){
	document.getElementById('credit_debit_card').style.display ='none';
	document.getElementById('fpx_banking').style.display ='block';
	document.getElementById('online_banking').style.display ='none';
}
function online_banking(){
	document.getElementById('credit_debit_card').style.display ='none';
	document.getElementById('fpx_banking').style.display ='none';
	document.getElementById('online_banking').style.display ='block';
}

 function show_pop(){
	document.getElementById('pop_content').style.display ='block';
	document.getElementById('checkout_wrapper').style.opacity ='1';
}
function close_pop(){
	document.getElementById('pop_content').style.display ='none';
	document.getElementById('checkout_wrapper').style.opacity ='1';

}
function card_show_pop(){
	document.getElementById('card_pop_content').style.display ='block';
	document.getElementById('checkout_wrapper').style.opacity ='1';
}
function card_close_pop(){
	document.getElementById('card_pop_content').style.display ='none';
	document.getElementById('checkout_wrapper').style.opacity ='1';

}
</script>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST["place_order_btn"])) 	
{
	$radio_address = $_POST["checkout_address"];
	$radio_card = $_POST["checkout_card"];
	$member_id = $_SESSION["sess_memid"]; 
	
	$address_insert = mysqli_query($conn,"select * from address where address_id = $radio_address");
	$result_address_insert = mysqli_fetch_assoc($address_insert);
	$card_insert = mysqli_query($conn, "select * from card_detail where card_detail_id = $radio_card");
	$result_card_insert = mysqli_fetch_assoc($card_insert);
	
	$card_cvv = $result_card_insert["card_cvv"];
	
	$confirm_cvv = md5($_POST["confirm_cvv"]);
	
	
	$ssql = mysqli_query($conn,"select * from member where member_id = $member_id");
	$rrow = mysqli_fetch_assoc($ssql);
	
	$email = $rrow["member_email"];
	$name = $rrow["member_name"];
	
	if($confirm_cvv == $card_cvv)
	{
	
	$result_checkout = mysqli_query($conn, "select * from product, shopping_cart, product_shopping_cart, member
						where product_shopping_cart_shopping_cart_id = shopping_cart_id
						AND product_shopping_cart_product_id = product_id
						AND shopping_cart_type = 'unpaid'
						AND	shopping_cart_member_id = $member_id
						AND member_id = $member_id");
	$row_checkout = mysqli_fetch_assoc($result_checkout);
		
		$name = $result_address_insert["address_name"];
		$phone = $result_address_insert["address_phone"];
		$address = $result_address_insert["address_content"];
		$postcode = $result_address_insert["address_postcode"];
		$city = $result_address_insert["address_city"];
		$state = $result_address_insert["address_state"];
		$shopping_cart_id = $row_checkout["shopping_cart_id"];
		$date = date("Y-m-d H:i:s");


		$insert_into_purchase = mysqli_query($conn, "INSERT INTO `purchase`(`purchase_time`,`purchase_quantity`, `purchase_total`, `purchase_ship_name`, `purchase_phone`, `purchase_address`, `purchase_postcode`, `purchase_city`, `purchase_state`, `purchase_shopping_cart_id`, `purchase_status`) 
												VALUES ( '$date',$total_quantity,$total,'$name','$phone','$address',$postcode,'$city','$state',$shopping_cart_id,'processing')");

		$purchase_id = mysqli_insert_id($conn);
		if($insert_into_purchase == 1)
		{
			//echo"<script>alert('insert_into_purchase successful')</script>";
			
		
			
			$date = date("Y-m-d H:i:s");
			$card_type = $result_card_insert["card_type"];
			$card_name = $result_card_insert["card_holder_name"];
			$card_no = $result_card_insert["card_no"];
			$card_month = $result_card_insert["card_expired_month"];
			$card_year = $result_card_insert["card_expired_year"];
			
			
			$insert_into_payment = mysqli_query($conn, "INSERT INTO `payment`(`payment_date`, `payment_total`, `payment_card_type`, `payment_card_holder_name`, `payment_card_no`, `payment_card_exp_month`, `payment_card_exp_year`, `payment_card_cvv`, `payment_purchase_id`) 
																				VALUES ('$date','$total','$card_type','$card_name','$card_no',$card_month,$card_year,'$card_cvv',$purchase_id)");

			
			if($insert_into_payment == 1)
			{
				//echo"<script>alert('insert_into_payment successful')</script>";
				
				$update_shopping_cart = mysqli_query($conn, "update shopping_cart set shopping_cart_type = 'paid' where shopping_cart_member_id = $member_id AND shopping_cart_type = 'unpaid'");
				$update_product_shopping_cart_review = mysqli_query($conn, "update product_shopping_cart set product_shopping_cart_review_status = 'havent' where product_shopping_cart_shopping_cart_id = $shopping_cart_id");
				
				if($update_shopping_cart == 1)
				{

					$add_new_shopping_cart = mysqli_query($conn, "INSERT INTO `shopping_cart`(`shopping_cart_member_id`, `shopping_cart_type`) VALUES ($member_id,'unpaid')");
					
					if($add_new_shopping_cart == 1)
					{	
						require_once 'PHPMailerAutoload.php';
						require 'src/Exception.php';
						require 'src/PHPMailer.php';
						require 'src/SMTP.php';
						
						$mail = new PHPMailer(true);  
				
						$mail->isSMTP();                                   
						$mail->Host = 'smtp.gmail.com';  
						$mail->SMTPAuth = true;                               
						$mail->Username = 'opticalx2709@gmail.com';                
						$mail->Password = 'Opticalx!@#';                          
						$mail->SMTPSecure = 'tls';                       
						$mail->Port = 587;    
							
						$mail->setFrom('opticalx2709@gmail.com', 'OpticalX Official Mail');
						$mail->addAddress($email);     
							
						$mail->isHTML(true);      
						$mail->Subject = 'Payment Succesfully';
						$mail->Body    = '<p style="padding-bottom:20px;">Dear '.$name.',</p> <br>Thank you for your successful your payment for the product RM '.number_format($total,2).'</p><br><h3>Your Order is 00<b>'.$purchase_id."</b></h3>";

						$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						$mail->send();
						?>
						<script type = "text/javascript">
							alert("<?php echo 'Place Order Successful \nEmail has been Sent to your mailbox' ?>");
						</script>
						<?php	
						echo "<script>location.href='member_track_order.php'</script>";
					}
					else
					{
						echo"<script>alert('add_new_shopping_cart unsuccessful <br> Please Connect To Our Customer Servise')</script>";
					}
				}
				else
				{
					echo"<script>alert('update_shopping_cart unsuccessful <br> Please Connect To Our Customer Servise')</script>";
				}
			}
			
			{
				echo"<script>alert('insert_into_payment unsuccessful <br> Please Connect To Our Customer Servise')</script>";
			}
			
		}
		else
		{
			echo"<script>alert('insert_into_purchase unsuccessful <br> Please Connect To Our Customer Servise')</script>";
		}
	}
	else
	{
		echo"<script>alert('Your CVV Number with your Card CVV are not match')</script>";
	}
}

if(isset($_POST["member_profile_address_submitbtn"]))
{	
	$name = $_POST["profile_address_name"];
	$phone = $_POST["profile_address_phone"];
	$address = $_POST["profile_address_address"];
	$postcode = $_POST["profile_address_postcode"];
	$city = $_POST['profile_address_city'];
	$state = $_POST["profile_address_state"];
	
	$count_address=mysqli_num_rows($result_address);
	if($count_address>=3)
	{	
		echo "<SCRIPT type='text/javascript'> //not showing me this
				alert('Sorry,The address already reach a maximum of 3');
				window.location.replace(\"member_checkout.php\");
				</SCRIPT>";
	}
	else
	{
			
	mysqli_query($conn, "INSERT INTO `address`(`address_name`, `address_phone`, `address_content`, `address_postcode`, `address_city`, `address_state`, `address_member_id`) 
	VALUES ('$name','$phone','$address',$postcode,'$city','$state',$member_id)");
	?>
	<script type="text/javascript">
		alert("Member address has been added");
	</script>
	<?php
	echo '<script language="javascript">';
	echo "window.location.href='member_checkout.php'";
	echo '</script>';
	}
}

if(isset($_POST["member_profile_add_card"]))
{	
	$c_holder_name = $_POST["card_holder_name"];
	$c_no = $_POST["card_no"];
	$c_exp_month = $_POST["card_exp_month"];
	$c_exp_year = $_POST["card_exp_year"];
	$c_cvv = md5($_POST["card_cvv"]);
	$c_type = $_POST["card_type"];
	
	$count_no = mysqli_num_rows($result_card);
	
	if($count_no>=3)
	{
		echo "<SCRIPT type='text/javascript'> //not showing me this
				alert('Sorry,The card already reach a maximum of 3');
				window.location.replace(\"member_checkout.php\");
				</SCRIPT>";
	}
	else
	{
		$result_insert_card = mysqli_query($conn, "INSERT INTO `card_detail`(`card_type`, `card_holder_name`, `card_no`, `card_expired_month`, `card_expired_year`, `card_cvv`, `card_member_id`) 
		VALUES ('$c_type','$c_holder_name','$c_no',$c_exp_month,'$c_exp_year','$c_cvv',$member_id)");
		
		if($result_insert_card == 1)
		{
			echo'<script>alert("Card has been Added")</script>';  
		}
		else
		{
			echo'<script>alert("Fail to Add Card ! There is something Wrong with your card detail")</script>';  
		}
		echo '<script language="javascript">';
		echo "window.location.href='member_checkout.php'";
		echo '</script>';
	}
}
?>