<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$admin_id = $_SESSION["sess_adid"]; 

$result = mysqli_query($conn, "select * from admin where admin_id = $admin_id");
$row = mysqli_fetch_assoc($result);

?>
<title>Update Profile</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="edit_product_wrapper">

		<div class="admin_title">
			<p>Edit Profile</p>
		</div>
		
		<div class="admin_edit_small_wrapper">

			<form name="new_admin" method="post" enctype="multipart/form-data" action="">
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Image</div>
				<div class="admin_edit_speacial">:</div>
				<img src="../<?php echo $row["admin_image"]; ?>">
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<input type="file"  name="admin_update_profile_img" accept="image/*" onchange="preview_image(event)" class="input_img_admin_update_profile">
				
				<div class="admin_update_img_display"><img id="output_image"/></div>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Name</div>
				<div class="admin_edit_speacial">:</div>
				<input type="text" class="admin_edit_input" name="admin_name" value="<?php echo $row["admin_name"]; ?>" required>
			</div>

			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Email</div>
				<div class="admin_edit_speacial">:</div>
				<input type="email" class="admin_edit_input" name="admin_email" value="<?php echo $row["admin_email"]; ?>" required>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Gender</div>
				<div class="admin_edit_speacial">:</div>
				<select class="admin_edit_input" name="admin_gender" required>
					<option value="" disabled selected>select your gender</option>
					<option value="Male" <?php if($row["admin_gender"] == "Male") echo "selected";?>>Male</option>
					<option value="Female" <?php if($row["admin_gender"] == "Female") echo "selected";?>>Female</option>
				</select>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Date of Birth</div>
				<div class="admin_edit_speacial">:</div>
				<input type="date" class="admin_edit_input" name="admin_date" value="<?php echo $row["admin_date"]; ?>" required>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Password</div>
				<div class="admin_edit_speacial">:</div>
				<input type="password" class="admin_edit_input" name="admin_pass" value="<?php echo $row["admin_password"]; ?>" required>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Phone No.</div>
				<div class="admin_edit_speacial">:</div>
				<input type="text" class="admin_edit_input" name="admin_phone" value="<?php echo $row["admin_phone"]; ?>" required>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Address</div>
				<div class="admin_edit_speacial">:</div>
				<input type="tel" class="admin_edit_input" name="admin_address"  value="<?php echo $row["admin_address"]; ?>"required>
			</div>

			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">Postcode</div>
				<div class="admin_edit_speacial">:</div>
				<input type="text" class="admin_edit_input" name="admin_postcode" value="<?php echo $row["admin_postcode"]; ?>" required>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">City</div>
				<div class="admin_edit_speacial">:</div>
				<input type="text" class="admin_edit_input" name="admin_city" value="<?php echo $row["admin_city"]; ?>" required>
			</div>
			
			<div class="admin_edit_ss_wrapper">
				<div class="edit_admin_text">State</div>
				<div class="admin_edit_speacial">:</div>
				<select class="admin_edit_input" name="admin_state" required>
					<option value="" disabled selected >Select your region</option>
					<option value="Perlis" <?php if($row["admin_state"] == "Perlis") echo "selected";?>>Perlis</option>
					<option value="Kedah" <?php if($row["admin_state"] == "Kedah") echo "selected";?>>Kedah</option>
					<option value="Penang" <?php if($row["admin_state"] == "Penang") echo "selected";?>>Penang</option>
					<option value="Perak" <?php if($row["admin_state"] == "Perak") echo "selected";?>>Perak</option>
					<option value="Selangor" <?php if($row["admin_state"] == "Selangor") echo "selected";?>>Selangor</option>
					<option value="Negeri Sembilan" <?php if($row["admin_state"] == "Negeri Sembilan") echo "selected";?>>Negeri Sembilan</option>
					<option value="Melaka" <?php if($row["admin_state"] == "Melaka") echo "selected";?>>Melaka</option>
					<option value="Johor" <?php if($row["admin_state"] == "Johor") echo "selected";?>>Johor</option>
					<option value="Pahang" <?php if($row["admin_state"] == "Pahang") echo "selected";?>>Pahang</option>
					<option value="Terengganu" <?php if($row["admin_state"] == "Terengganu") echo "selected";?>>Terengganu</option>
					<option value="Kelantan" <?php if($row["admin_state"] == "Kelantan") echo "selected";?>>Kelantan</option>
					<option value="Sabah" <?php if($row["admin_state"] == "Sabah") echo "selected";?>>Sabah</option>
					<option value="Sarawak" <?php if($row["admin_state"] == "Sarawak") echo "selected";?>>Sarawak</option>
					<option value="Kuala Lumpur" <?php if($row["admin_state"] == "Kuala Lumpur") echo "selected";?>>Kuala Lumpur</option>
					<option value="Putrajaya" <?php if($row["admin_state"] == "Putrajaya") echo "selected";?>>Putrajaya</option>
					<option value="Labuan" <?php if($row["admin_state"] == "Labuan") echo "selected";?>>Labuan</option></select>
				</select>
			</div>
			
				<p><input type="submit" value="Submit" class="admin_edit_submit" name="savebtn"></p>
			</form>

		</div>
	</div>
</div>


<?php

if (isset($_POST["savebtn"]))
{
	$name = $_POST["admin_name"];  		
	$email = $_POST["admin_email"]; 
	$gender = $_POST["admin_gender"];
	$date = $_POST["admin_date"];
	$mpword = $_POST["admin_pass"];  // encrypt the password
	$phone = $_POST["admin_phone"];
	$address = $_POST["admin_address"];
	$postcode = $_POST["admin_postcode"];
	$city = $_POST["admin_city"];
	$state = $_POST["admin_state"];
	
	
	if($_FILES['admin_update_profile_img']['name'] == "") 
	{
		mysqli_query($conn, "update admin set 
							admin_name='$name',
							admin_email='$email',
							admin_gender='$gender',
							admin_date='$date',
							admin_password='$mpword',
							admin_phone='$phone',
							admin_address='$address',
							admin_postcode=$postcode,
							admin_city='$city',
							admin_state='$state' where admin_id = $admin_id");	
	}
	else 
	{
		$image = "images/admin/".basename($_FILES['admin_update_profile_img']['name']);
					
		mysqli_query($conn, "update admin set 
							admin_image='$image',
							admin_name='$name',
							admin_email='$email',
							admin_gender='$gender',
							admin_date='$date',
							admin_password='$mpword',
							admin_phone='$phone',
							admin_address='$address',
							admin_postcode=$postcode,
							admin_city='$city',
							admin_state='$state' where admin_id = $admin_id");	
	}
		
	
	$link="admin_view_profile.php";
	echo "<script>location.href='$link'</script>";
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