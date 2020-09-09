<?php 

include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: member_login.php");
   
$member_id = $_SESSION["sess_memid"]; 

$result = mysqli_query($conn, "select * from member where member_id = $member_id");
$row = mysqli_fetch_assoc($result);
 
?>

<title>Profile</title>


<div class="body_pf">

<?php include 'header.php'; ?>


<div id="member_profile_wrapper">
	<div class="row">
		<div class="four columns member_profile_left">
			<ul class="member_profile_pic_name">
				<li class="member_profile_pic">
					<img src="<?php echo $row["member_image"]; ?>">
				</li>
				
				<li class="member_profile_word">
					<p><?php echo $row["member_name"];?></p>
					<!--
						<ul>
							<li><a href="#"><img src="images/edit_profile.png"></li>
							<li><span onclick="profile()">Edit Profile<span> </a> </li> 
						</ul>
					-->
				</li>
			</ul>
			
			<div class="customer_profile_side_menu">
				<div class="side_menu">
					<!-- <button class="dropdown-btn"> My Account </button> -->
						<!-- <div class="dropdown-"> -->
						<div class="profile_my_account"> My Account </div>
							<p><button type="button" value="profile" onclick="profile()" class="profile_button">Profile</button></p>
							<p><button type="button" value="address" onclick="address()" class="profile_button">Addresses</button></p>
							<p><button type="button" value="chgpass" onclick="chgpass()" class="profile_button">Change Password</button></p>
							<p><button type="button" value="card" onclick="card()" class="profile_button">Card Manage</button></p>

						<!-- </div> -->
					<!--
					<button class="dropdown-btn">My Purchase</button>
						<div class="dropdown-container">
							<p><button type="button" value="pendprod" onclick="pendprod()" class="profile_button">Tracking Order</button></p>
							<p><button type="button" value="receiveprod" onclick="receiveprod()" class="profile_button">Recieved Product</button></p>
						</div>
					-->
				</div>

			</div>
		</div>		
	<div class="eight columns">
		<div class="profile_details_info">
			<div id="Profile">
			
				<div class="profile_describtion">
					<p class="profile_describtion_title">My Profile</p>
					<p class="profile_describtion_small">Manage and Protect your account</p>
				</div>
				
				<form name="member_profile" method="post" enctype="multipart/form-data">
					<div class="content_profile">
						<div class="profile_image">
							<img src="<?php echo $row["member_image"]; ?>">
						</div>
						<p><div class="profile_spacing">Image</div>
							<input type="file" class="input_profile" name="member_profile_image" onchange="preview_image(event)" >
							<div class="member_update_image">
								<img id="output_image"/>
							</div>
						</p>
						
						<p><div class="profile_spacing">Name</div>
							<input type="text" value="<?php echo $row["member_name"];?>" name="member_profile_name" pattern="[A-Za-z\s]{5,20}" title="Must contain Alphabet only)" class="input_profile" required>
						</p>
						
						<p><div class="profile_spacing">Phone-Number</div>
							<input type="text" value="<?php echo $row["member_phone"];?>" name="member_profile_phonenum" pattern="[0-9]{9,}" title = "Must contain number only" class="input_profile" required>
						</p>
						
						<p><div class="profile_spacing">Email</div>
							<input type="email" value="<?php echo $row["member_email"];?>" name="member_profile_email" pattern="[a-z0-9._]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="input_profile" required>
						</p>
						
						<p><div class="profile_spacing2">Gender</div>
							<input type="radio" name="member_profile_gender" value="Male" class="input_profile2"<?php if($row["member_gender"] == "Male") echo "checked";?>> Male 
							<input type="radio" name="member_profile_gender" value="Female" <?php if($row["member_gender"] == "Female") echo "checked=\"checked\" ";?>> Female
						</p>
						
						<p><div class="profile_spacing">Date of Birth</div>
						
							<input type="date" name="member_profile_dob" value="<?php echo $row["member_dob"]; ?>" class="input_profile" required>
						</p>
						<div class="member_profile_div">
							<input type="submit" name="member_profile_edit_submit_button" Value="UPDATE" class="member_profile_edit_submitbtn">
						</div>
					</div>
				</form>			
			</div>
	
			<form name="member_profile_edit_address" method="post" action="">			
				<div id="Address">
				
					<div class="profile_describtion">
						<p class="profile_describtion_title profile_padding">My Addresses</p>
						<p class="profile_describtion_small">Maximun Up To Three Address Can be Added</p>
						<?php
						$result_address = mysqli_query($conn , "select * from address where address_member_id = $member_id ");
						$count_add = mysqli_num_rows($result_address);
						if($count_add >= 3)
						{
							echo "";
						}
						else
						{
						?>
							<input type="button" name="add_new_add" value="Add New Address" class="member_profile_add_address" onclick="javascript:show_pop()">
						<?php
						}
						?>
					</div>
					
					<div class="content_address">
						<form name="profile_address">
						<?php
						
						if($count_add == 0)
						{
							echo "<div class='address_member_no_add'>No Address</div>";
						}
						else
						{
						$x=0;
							while($row_address = mysqli_fetch_assoc($result_address))
							{
								?>
								<div class="profile_address_new_list">
				
									<div class="num_address"> Address <?php echo $x+1;?></div>
									
									<div class="profile_address_header">
										<div class="address_wrapper">
											<div class="address_text">Delivery Name  :</div>
											<div class="profile_address_content"><?php echo $row_address["address_name"];?></div>
										</div>
										
										<div class="address_wrapper">
											<div class="address_text">Delivery Phone  :</div>
											<div class="profile_address_content"><?php echo '+60'.$row_address["address_phone"]; ?></div>
										</div>
										
										<div class="address_wrapper">
											<div class="address_text">Delivery Address  :</div>
											<div class="profile_address_content"><?php echo $row_address["address_content"]." ".$row_address["address_postcode"]." ".$row_address["address_city"]." ".$row_address["address_state"];?></div>
										</div>
									</div>
									
									<div class="address_wrapper">
											<div class="address_text">Action  :</div>
											<div class="profile_address_content">
												<a href="member_profile_address_detail.php?address_id=<?php echo $row_address['address_id'];?>">Edit</a>
												<a class="address_padding_link" href="member_profile.php?address_id=<?php echo $row_address['address_id'];?>" class="delete_detail_address" onclick="return confirmation1();">Delete</a>
											</div>
									</div>
								</div>
								<?php
								$x++;
							}
						}
							?>
					</div>
	</form>
							
					
				</div>
	<form name="member_profile_edit_password" method="post" action="">						
				<div id="Change_password">
					<div class="profile_describtion">
						<p class="profile_describtion_title">Change Password</p>
						<p class="profile_describtion_small">For your account's security, do not share your password with anyone else</p>
					</div>
					
					<div class="content_chgpass">
						<form name="change_pass">
							<input type="hidden" name="member_pass"  value="<?php echo $row["member_password"];?>" class="input_profile">
			
							<p><div class="profile_spacing">Current Password</div>
									<input type="password" name="change_pass_current_pass" class="input_profile" required>
							</p>
							
							<p><div class="profile_spacing">New Password</div>
									<input type="password" name="change_pass_new_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="input_profile" required>
							</p>
							
							<p><div class="profile_spacing">Confirm Password</div>
									<input type="password" name="change_pass_confirm_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="input_profile" required>
							</p>
							
							<!--
							<p><div class="profile_spacing">Captcha</div>
									<input type="text" name="change_pass_current_pass" class="input_profile">
							</p>
							-->
							
							<input type="submit" name="member_profile_chgpass_submitbtn" Value="CHANGE PASSWORD " class="member_profile_edit_submitbtn">
						</form>
					</div>
				</div>
			
	</form>
	<form name="member_profile_edit_card" method="post" action="">					
					<div id="Card">
						<div class="profile_describtion">
							<p class="profile_describtion_title profile_padding">My Card</p>
							<p class="profile_describtion_small">Maximum up to three card can be added</p>
						</div>
						<?php
							$result_cart = mysqli_query($conn , "select * from card_detail where card_member_id = $member_id ");
							$row_check_card =mysqli_num_rows($result_cart);
							$row_card = mysqli_fetch_assoc($result_cart);
							?>
							<form name="profile_card" class="add_new_card_form2">
							<div class="card_from_wrapper">
								<p>
									<div class="profile_spacing3">Card Type</div>
									<div class="radio_Card">
										<input type="radio" name="card_type" value="credit card" required>Credit Card
										<input type="radio" name="card_type" value="debit card">Debit Card
									</div>	
								</p>
								<input type="text" name="card_holder_name" class="card_input" placeholder="Name on Card"  pattern="^[a-zA-Z\s]+$" required>
								<input type="text" name="card_no" class="card_input" placeholder="Card No. (exp: xxxx xxxx xxxx xxxx)" pattern="[0-9]{4}\s*[0-9]{4}\s *[0-9]{4}\s *[0-9]{4}" title="example ( xxxx xxxx xxxx xxxx )" required>
								<p class="add_card_p">Expires On <span> CVV </span> </p>
								<input type="text" name="card_exp_month" class="card_input2" placeholder="MM" min="01" max="12" title="Please Enter correct Month" required>
								<input type="text" name="card_exp_year" class="card_input2" placeholder="YYYY" min="<?=$currentDate?>" pattern="[0-9]{4,4}" title="Please Enter correct Year" required>
								<input type="password" name="card_cvv" class="card_input2" placeholder="000" pattern="[0-9]{3,3}" required>
								<div class="button_submit_card">
									<input type="submit" name="member_profile_add_card" class="member_profile_edit_submitbtn" value="SAVE">
								</div>
							</div>
							</form>	
							<div class="content_card">
								<?php
								$card_detail = mysqli_query($conn , "select * from card_detail where card_member_id = $member_id ");
								$y=0;
								while($row_cardtype = mysqli_fetch_assoc($card_detail))
								{ 
									if( $row_cardtype["card_type"] == "credit card")
										$card = "Credit Card";
									elseif($row_cardtype["card_type"] == "debit card")
										$card = "Debit Card";
								?>
									<div class="profile_card_new_list">
										<div class="card_title_profile"> Card <?php echo $y+1;?> 
											<a href="member_profile.php?card_detail_id=<?php echo $row_cardtype['card_detail_id'];?>" class="delete_detail_card" onclick="return confirmation();">Remove</a>
										</div>
										<div class="profile_card_header">
											<div class="card_name_profile"><?php echo $row_cardtype["card_holder_name"];?></div>
											<div class="card_type_profile"><?php echo $card;?></div>
											<div class="card_no_profile"><?php echo $row_cardtype["card_no"];?></div>
											<div class="card_month_year_profile"><?php echo "<small>VALID THRU</small> ".$row_cardtype["card_expired_month"]. "/".$row_cardtype["card_expired_year"]; ?></div>
										</div>

									</div>
								<?php
									$y++;
								}
								?>	
							</div>
					</div>
			</div>
		</div>
	</form>
			<!--
			
				<div id="Received_product">
				
				<div class="profile_describtion">
					<p class="profile_describtion_title">Received Order</p>
					<p class="profile_describtion_small">For you to view your's order history</p>
				</div>
				
					<ul class="order_history_title">
						<li class="header_oh">Order ID</li>
						<li class="header_oh">Items</li>
						<li class="header_oh">Order Placed</li>
						<li class="header_oh"> </li>
					</ul>
					
					<ul class="order_history_details">
						<li class="details_oh">M1231235</li>
						<li class="details_oh">2Items</li>
						<li class="details_oh">28-07-2018</li>
						<li class="details_oh"><input type="button"  value="More Details" class="oh_more_details"></li>
					</ul>
					
				</div>
				
				<div id="Pending_product">
				
				<div class="profile_describtion">
					<p class="profile_describtion_title">Tracking Order</p>
					<p class="profile_describtion_small">For you to check your order here</p>
				</div>
				
					<ul class="pending_product_ul">
						<li class="header_ppul">Order ID</li>
						<li class="header_ppul">Items</li>
						<li class="header_ppul">Order Placed</li>
						<li class="header_ppul">Status</li>
						<li class="header_ppul"> </li>
					</ul>
					
					<ul class="pending_product_details">
						<li class="pending_product_li">M1231235</li>
						<li class="pending_product_li">2Items</li>
						<li class="pending_product_li">28-07-2018</li>
						<li class="pending_product_li">Delivering</li>
						<li class="pending_product_li"><input type="button" onclick="show_pop_track_order()" value="More Details" class="pending_product_more_details"></li>
					</ul>
					
				</div>
			
			-->
			</div>
		</div>
	</div>	
</div>


<div class="pop_wrapper">
	<div id="pop_content" class="popup_container">
        <span onclick="close_pop()" class="pop_close_button">&times;</span>
		<form name="pop_out_add_form" method="post" action="">
		
			<div class="title_pop_add">
				<p>Add New Address</p>
			</div>
				<p><div class="profile_spacing">Name</div>
					<input type="text" name="profile_address_name" pattern="[A-Za-z\s]{5,20}" title="Must contain Alphabet only)" class="input_profile" required>
				</p>
				<p><div class="profile_spacing">Phone</div>
					<input type="text" name="profile_address_phone" pattern="[0-9]{9,}" title = "Must contain number only" class="input_profile" required>
				</p>
				<p><div class="profile_spacing">Address </div>
					<input type="text" name="profile_address_address" class="input_profile" required>
				</p>
				<p><div class="profile_spacing">Postcode</div>
					<input type="text" name="profile_address_postcode" pattern="[0-9]{5,5}" class="input_profile" required>
				</p>
				<p><div class="profile_spacing">City</div>
					<input type="text" name="profile_address_city" class="input_profile" required>
				</p>
				<p><div class="profile_spacing">State</div>
					<select class="input_profile" name="profile_address_state" required>
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

</form>

</div>

<?php include 'footer.php'; ?>
<script>
function confirmation()
{
		answer = confirm("Are you sure want to Remove this Card?");
		return answer;
}
function confirmation1()
{
		answer = confirm("Are you sure want to delete this Address?");
		return answer;
}

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

function profile(){
	document.getElementById('Profile').style.display ='block';
	document.getElementById('Address').style.display ='none';
	document.getElementById('Change_password').style.display ='none';
	document.getElementById('Card').style.display ='none';
	//document.getElementById('Received_product').style.display ='none';
	//document.getElementById('Pending_product').style.display ='none';

}
function address(){
	document.getElementById('Profile').style.display ='none';
	document.getElementById('Address').style.display ='block';
	document.getElementById('Change_password').style.display ='none';
	document.getElementById('Card').style.display ='none';
	//document.getElementById('Received_product').style.display ='none';
	//document.getElementById('Pending_product').style.display ='none';


}
function chgpass(){
	document.getElementById('Profile').style.display ='none';
	document.getElementById('Address').style.display ='none';
	document.getElementById('Change_password').style.display ='block';
	document.getElementById('Card').style.display ='none';
	//document.getElementById('Received_product').style.display ='none';
	//document.getElementById('Pending_product').style.display ='none';
}
function card(){
	document.getElementById('Profile').style.display ='none';
	document.getElementById('Address').style.display ='none';
	document.getElementById('Change_password').style.display ='none';
	document.getElementById('Card').style.display ='block';
	//document.getElementById('Received_product').style.display ='none';
	//document.getElementById('Pending_product').style.display ='none';
}
/* function receiveprod(){
	document.getElementById('Profile').style.display ='none';
	document.getElementById('Address').style.display ='none';
	document.getElementById('Change_password').style.display ='none';
	document.getElementById('Received_product').style.display ='block';
	document.getElementById('Pending_product').style.display ='none';


}
function pendprod(){
	document.getElementById('Profile').style.display ='none';
	document.getElementById('Address').style.display ='none';
	document.getElementById('Change_password').style.display ='none';
	document.getElementById('Received_product').style.display ='none';	
	document.getElementById('Pending_product').style.display ='block';

} */

 function show_pop(){
	document.getElementById('pop_content').style.display ='block';
	document.getElementById('member_profile_wrapper').style.opacity ='0.2';
}
function close_pop(){
	document.getElementById('pop_content').style.display ='none';
	document.getElementById('member_profile_wrapper').style.opacity ='1';

}

 function profile_show_pop(){
	document.getElementById('edit_pop_content').style.display ='block';
	document.getElementById('member_profile_wrapper').style.opacity ='0.2';
}
function profile_close_pop(){
	document.getElementById('edit_pop_content').style.display ='none';
	document.getElementById('member_profile_wrapper').style.opacity ='1';

}
/* function show_pop_track_order(){
	document.getElementById('pop_content_track_order').style.display ='block';
	document.getElementById('member_profile_wrapper').style.opacity ='0.2';

}
function close_pop_track_order(){
	document.getElementById('pop_content_track_order').style.display ='none';
	document.getElementById('member_profile_wrapper').style.opacity ='1';

} */ 

</script>

<?php

if (isset($_REQUEST["card_detail_id"])) 
{	$card_detail_id = $_REQUEST["card_detail_id"]; 
	mysqli_query($conn, "delete from card_detail where card_detail_id = $card_detail_id");
	
	echo '<script language="javascript">';
	echo "window.location.href='member_profile.php'";
	echo '</script>';
}

if (isset($_REQUEST["address_id"])) 
{	$address_id = $_REQUEST["address_id"]; 
	mysqli_query($conn, "delete from address where address_id = $address_id");
	
	echo '<script language="javascript">';
	echo "window.location.href='member_profile.php'";
	echo '</script>';
}

if (isset($_POST["member_profile_edit_submit_button"]))
{	
	$images = "images/member/".basename($_FILES['member_profile_image']['name']);
	$name = $_POST["member_profile_name"];  		
	$email = $_POST["member_profile_email"]; 
	$gender = $_POST["member_profile_gender"];
	$phone = $_POST["member_profile_phonenum"];
	$date = $_POST["member_profile_dob"];
	
	if($_FILES['member_profile_image']['name'] == "") 
	{
		mysqli_query($conn, "update member set member_name='$name',member_email='$email',member_gender='$gender',member_dob='$date',member_phone='$phone' where member_id = $member_id");
	}
	else
	{
		mysqli_query($conn, "update member set member_image='$images',member_name='$name',member_email='$email',member_gender='$gender',member_dob='$date',member_phone='$phone' where member_id = $member_id");
	}
	?>
	<script type="text/javascript">
		alert("Member profile already updated");
	</script>
	<?php
	echo '<script language="javascript">';
	echo "window.location.href='member_profile.php'";
	echo '</script>';
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
				window.location.replace(\"member_profile.php\");
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
	echo "window.location.href='member_profile.php'";
	echo '</script>';
	}
}

if(isset($_POST["member_profile_address_updatebtn"]))
{	
	$name = $_POST["profile_address_name"];
	$phone = $_POST["profile_address_phone"];
	$address = $_POST["profile_address_address"];
	$postcode = $_POST["profile_address_postcode"];
	$city = $_POST['profile_address_city'];
	$state = $_POST["profile_address_state"];
	
	mysqli_query($conn, "update  address set address_name = '$name',address_phone=$phone,address_content='$address',address_postcode='$postcode',address_city='$city',address_state='$state' where address_member_id = $member_id and address_id= $address_id");
	?>
	<script type="text/javascript">
		alert("Member address already Updated");
	</script>
	<?php
	echo '<script language="javascript">';
	echo "window.location.href='member_profile.php'";
	echo '</script>';
}

if(isset($_POST["member_profile_chgpass_submitbtn"]))
{	
	$current_pass = md5($_POST["change_pass_current_pass"]);
	$new_pass = md5($_POST["change_pass_new_pass"]);
	$confirm_pass = md5($_POST["change_pass_confirm_pass"]);
	$database_pass = $_POST["member_pass"];
	
	if($current_pass == $database_pass )
		{
			if( $new_pass == $confirm_pass)
				{
					mysqli_query($conn, "update  member set member_password = '$new_pass' where member_id = $member_id");
					echo'<script>alert("Your password has already Updated")</script>';  
				}
			else
				{
					echo'<script>alert("Your New Password and Confirm Password Not Match")</script>';  
				}
		}
	else 
		{
			echo'<script>alert("Wrong Current Password")</script>';  
		}
	

	echo '<script language="javascript">';
	echo "window.location.href='member_profile.php'";
	echo '</script>';
}

if(isset($_POST["member_profile_add_card"]))
{	
	$c_holder_name = $_POST["card_holder_name"];
	$c_no = $_POST["card_no"];
	$c_no = mysqli_real_escape_string($conn, $c_no);
	$c_exp_month = $_POST["card_exp_month"];
	$c_exp_month = mysqli_real_escape_string($conn, $c_exp_month);
	$c_exp_year = $_POST["card_exp_year"];
	$c_cvv = md5($_POST["card_cvv"]);
	$c_type = $_POST["card_type"];
	
	$count_no = mysqli_num_rows($card_detail);
	
	if($count_no>=3)
	{
		echo "<SCRIPT type='text/javascript'> //not showing me this
				alert('Sorry,The card already reach a maximum of 3');
				window.location.replace(\"member_profile.php\");
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
		echo "window.location.href='member_profile.php'";
		echo '</script>';
	}
}

?>		
<script>
function preview_image(event) 
{
	var reader = new FileReader();
	reader.onload = function()
	{
		var output = document.getElementById('output_image');
		output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]); 
}
</script>				