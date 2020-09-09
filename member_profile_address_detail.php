<?php 

include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: member_login.php");
   
$member_id = $_SESSION["sess_memid"]; 

$result = mysqli_query($conn, "select * from member where member_id = $member_id");
$row = mysqli_fetch_assoc($result);
 
?>

<body class="body_pf">
<?php include 'header.php'; ?>
					<?php
					$address_id = $_REQUEST["address_id"];
					$all_result_address = mysqli_query($conn , "select * from address where address_member_id = $member_id and address_id= $address_id");
					$add=mysqli_fetch_assoc($all_result_address)
					
					?>
						<div class="cc">
								<form name="pop_out_add_form" method="post" action="">
									<div class="member_profile_address_detail_title">
										<p>Edit Address</p>
									</div>
									
									<div class="content_address_detail">
										<p><div class="member_profile_address_detail_content">Name :</div>
											<input type="text" name="profile_address_name" value="<?php echo $add['address_name'];?>" pattern="[A-Za-z\s]{5,20}" title="Must contain Alphabet only)" class="input_type_profile_address" required>
										</p>
										<p><div class="member_profile_address_detail_content">Phone :</div>
											<input type="text" name="profile_address_phone" value="<?php echo $add['address_phone'];?>" pattern="[0-9]{9,}" title = "Must contain number only" class="input_type_profile_address" required>
										</p>
										<p><div class="member_profile_address_detail_content">Address :</div>
											<input type="text" name="profile_address_address" value="<?php echo $add['address_content'];?>" class="input_type_profile_address" required>
										</p>
										<p><div class="member_profile_address_detail_content">Postcode :</div>
											<input type="text" name="profile_address_postcode" value="<?php echo $add['address_postcode'];?>" pattern="[0-9]{5,5}" class="input_type_profile_address" required>
										</p>
										<p><div class="member_profile_address_detail_content">City :</div>
											<input type="text" name="profile_address_city" value="<?php echo $add["address_city"];?>" class="input_type_profile_address" required>
										</p>
										<p><div class="member_profile_address_detail_content">State :</div>
											<select class="input_type_profile_address" name="profile_address_state" required>
												<option value="" disabled selected >Select your region</option>
												<option value="Perlis" <?php if($add["address_state"] == "Perlis") echo "selected";?>>Perlis</option>
												<option value="Kedah" <?php if($add["address_state"] == "Kedah") echo "selected";?>>Kedah</option>
												<option value="Penang" <?php if($add["address_state"] == "Penang") echo "selected";?>>Penang</option>
												<option value="Perak" <?php if($add["address_state"] == "Perak") echo "selected";?>>Perak</option>
												<option value="Selangor" <?php if($add["address_state"] == "Selangor") echo "selected";?>>Selangor</option>
												<option value="Negeri Sembilan" <?php if($add["address_state"] == "Negeri Sembilan") echo "selected";?>>Negeri Sembilan</option>
												<option value="Melaka" <?php if($add["address_state"] == "Melaka") echo "selected";?>>Melaka</option>
												<option value="Johor" <?php if($add["address_state"] == "Johor") echo "selected";?>>Johor</option>
												<option value="Pahang" <?php if($add["address_state"] == "Pahang") echo "selected";?>>Pahang</option>
												<option value="Terengganu" <?php if($add["address_state"] == "Terengganu") echo "selected";?>>Terengganu</option>
												<option value="Kelantan" <?php if($add["address_state"] == "Kelantan") echo "selected";?>>Kelantan</option>
												<option value="Sabah" <?php if($add["address_state"] == "Sabah") echo "selected";?>>Sabah</option>
												<option value="Sarawak" <?php if($add["address_state"] == "Sarawak") echo "selected";?>>Sarawak</option>
												<option value="Kuala Lumpur" <?php if($add["address_state"] == "Kuala Lumpur") echo "selected";?>>Kuala Lumpur</option>
												<option value="Putrajaya" <?php if($add["address_state"] == "Putrajaya") echo "selected";?>>Putrajaya</option>
												<option value="Labuan" <?php if($add["address_state"] == "Labuan") echo "selected";?>>Labuan</option></select>
											</select>
										</p>
									</div>
										<input type="submit" name="member_profile_address_updatebtn" Value="UPDATE" class="member_profile_address_btn">
								</form>
						</div>
</body>

<?php include 'footer.php'; ?>
<script>
function confirmation()
{
		answer = confirm("Are you sure want to delete this Card?");
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


if (isset($_POST["member_profile_edit_submitbtn"]))
{
	$name = $_POST["member_profile_name"];  		
	$email = $_POST["member_profile_email"]; 
	$gender = $_POST["member_profile_gender"];
	$phone = $_POST["member_profile_phonenum"];
	$date = $_POST["member_profile_dob"];
	
	mysqli_query($conn, "update member set member_name='$name',member_email='$email',member_gender='$gender',member_dob='$date',member_phone='$phone' where member_id = $member_id");
	
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
	$c_exp_month = $_POST["card_exp_month"];
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