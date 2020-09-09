<?php include("connection.php"); ?>
<title>Add Admin</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_register_wrapper">

		<div class="admin_title">
			<p>Add New Admin</p>
		</div>
		
		<div class="back_button_adding">
			<a href="super_admin_view_admin.php?admin=1">View All Admin</a>
		</div>
		
		<div class="admin_register_small_wrapper">

			<form name="new_admin" method="post" action="" enctype="multipart/form-data">
			
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Image</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="file"  name="admin_image" accept="image/*" onchange="preview_image(event)" required><br>
				<span class="notification_admin_add_admin"><small>*recommended 200x200pixel</small></span>
				<div class="admin_add_admin_img"><img id="output_image"/></div>
			</div>
			
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Name</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="text" class="add_new_admin_input" name="admin_name" required>
			</div>
				
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Email</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="email" class="add_new_admin_input" name="admin_email" required>
			</div>
			
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Gender</div>
				<div class="add_new_admin_speacial">:</div>
				<select class="add_new_admin_input" name="admin_gender" required>
					<option value="" disabled selected>select gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			</div>
				
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Date of Birth</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="date" class="add_new_admin_input" name="admin_date" required>
			</div>
			
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Password</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="password" class="add_new_admin_input" name="admin_pass" required>
			</div>
			
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Phone No.</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="text" class="add_new_admin_input" name="admin_phone" required>
			</div>

			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Address </div>
				<div class="add_new_admin_speacial">:</div>
				<input type="tel" class="add_new_admin_input" name="admin_address" required>
			</div>
			

			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">Postcode</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="text" class="add_new_admin_input" name="admin_postcode" required>
			</div>
			
			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">City</div>
				<div class="add_new_admin_speacial">:</div>
				<input type="text" class="add_new_admin_input" name="admin_city" required>
			</div>

			<div class="admin_register_ss_wrapper">
				<div class="add_new_admin_text">State</div>
				<div class="add_new_admin_speacial">:</div>
				<select class="add_new_admin_input" name="admin_state" required>
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
			</div>
			
				<p><input type="submit" value="Register" class="admin_register_submit" name="admin_submit"></p>
			</form>

		</div>
	</div>
</div>

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

<?php

if (isset($_POST["admin_submit"])) 	
{
	$image = "images/admin/".basename($_FILES['admin_image']['name']);
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
	
 	$sql = "select * from admin where admin_name = '$name'"; 
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) != 0) // make sure no 2 member uses tha same email address
	{
	?>
		<script type = "text/javascript">
			alert("Username already existed");
		</script>
	<?php
	}
	else
	{
		mysqli_query($conn,"insert into admin (admin_image,admin_name, admin_email, admin_gender, admin_password, admin_date, admin_phone,admin_address, admin_postcode,admin_city,admin_state,admin_trash) 
							values ('$image','$name','$email','$gender','$mpword','$date',$phone,'$address',$postcode,'$city','$state','0')");

		?>
		<script type = "text/javascript">
			alert("<?php echo $name .'has successful registration'; ?>");
		</script>
		<?php	
	}
	
	mysqli_close($conn);
}
?>