<?php include("connection.php"); ?>

<?php include 'header.php'; ?>

<title>Register</title>

<?php
//Random Number Generation
$rand=substr(rand(),0,4); //only show 4 numbers
?>
<div class="register_wrapper">
	<div class="page_title">
		<p>Register</p>
	</div>
	
	<div class="register_small_wrapper">
		<div class="row">
			<div class="twelve columns">
				<form name="register_form" onsubmit="return validateForm()" method="post" action="" enctype="multipart/form-data">
					
					<p class="register_form_p">Name</p>
					<input type="text" class="register_blank" name="register_name"  title="Must contain Alphabet only)" required>
					<span id="name" class="error_color"></span>
					
					<p class="register_form_p">Email</p>
					<input type="email" class="register_blank" name="register_email" pattern="[a-z0-9._]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
					<span id="email" class="error_color"></span>
					
					<p class="register_form_p">Gender </p>
					<select class="register_blank" name="register_gender" title="Please Choose a gender" required>
						<option value="" disabled selected>-- Select Your Gender --</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>	
					<span id="gender" class="error_color"></span>
					
					<p class="register_form_p">Date of Birth</p>
					<input type="date" class="register_blank" name="register_date" max=<?php echo date('Y-m-d') ?> required>
					<span id="date" class="error_color"></span>
					
					<p class="register_form_p">Password</p>
					<input type="password" class="register_blank" name="register_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
					<span id="passw" class="error_color"></span>
					
					<p class="register_form_p">Confirm Password</p>
					<input type="password" class="register_blank" name="register_confirm_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
					<span id="cpassw" class="error_color"></span>
					
					<p class="register_form_p">Phone No.</p>
					<input type="tel" class="register_blank" name="register_phone" pattern="[0-9]{9,}" title = "Must contain number only" required>	
					<span id="phone" class="error_color"></span>
					
					<div class="captcha_design_div">
						<p class="captcha_new_register_form_p">
							Enter The Number <input type="text" class="new_register_blank" name="chk" id="chk" required>
							<span id="error" class="error_color"> 
						</p>

						<p class="new_register_form_p">
							<input type="text" value="<?=$rand?>" id="ran" readonly="readonly" class="captcha">
							<button type="button" value="Referesh" onclick="captch()" class="captcha_refresh">
								<img src="images/member/refresh_icon.png" class="img_member"/>
							</button>
						</p>				
					</div>
					
					<p><input type="submit" value="SUBMIT" class="register_submit" name="register_submit" onclick="return validation();"></p>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
//Javascript Referesh Random String
function captch() 
{   var x = document.getElementById("ran")
    x.value = Math.floor((Math.random() * 10000) + 1);
}
//Javascript Captcha validation
function validation()
{ 	
	if(document.register_form.register_name.value=="")
	{
		document.getElementById("name").innerHTML="*Enter your Name!";
		document.register_form.name.focus();
		return false;
	}
	if(document.register_form.register_email.value=="")
	{
		document.getElementById("email").innerHTML="*Enter your Email!";
		document.register_form.email.focus();
		return false;
	}
	
	if(document.register_form.register_gender.value=="")
	{
		document.getElementById("gender").innerHTML="*Select your gender!";
		document.register_form.gender.focus();
		return false;
	}
	
	if(document.register_form.register_date.value=="")
	{
		document.getElementById("date").innerHTML="*Enter your Date Of Birth!";
		document.register_form.date.focus();
		return false;
	}
	
	if(document.register_form.register_pass.value=="")
	{
		document.getElementById("passw").innerHTML="*Enter your Password!";
		document.register_form.passw.focus();
		return false;
	}
	
	if(document.register_form.register_confirm_pass.value=="")
	{
		document.getElementById("cpassw").innerHTML="*Enter your Confirm Password!";
		document.register_form.cpassw.focus();
		return false;
	}
	
	if(document.register_form.register_phone.value=="")
	{
		document.getElementById("phone").innerHTML="*Enter your Phone!";
		document.register_form.phone.focus();
		return false;
	}
	
	if(document.register_form.chk.value=="")
	{
		document.getElementById("error").innerHTML="*Please Enter Captcha Number!";
		document.register_form.phone.focus();
		return false;
	}
	
	//if(document.register_form.register_pass.valu!=document.register_form.register_confirm_pass.value)
	//{	document.getElementById("passw").innerHTML="*Password Not Matched!";
	//	document.getElementById("cpassw").innerHTML="*Confirm Password Not Matched!";
	//	document.register_form.chk.focus();
	//	return false;
	//}
	
	
	if(document.register_form.ran.value!=document.register_form.chk.value)
	{
		document.getElementById("error").innerHTML="*Captcha Not Matched!";
		document.register_form.chk.focus();
		return false;
	}
	return true;
}

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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["register_submit"])) 	
{
	date_default_timezone_set("Asia/Kuala_Lumpur"); 
	$images = "images/member/people.jpg";
	$name = $_POST["register_name"];  		
	$email = $_POST["register_email"]; 
	$gender = $_POST["register_gender"];
	$mdob = $_POST["register_date"];
	$mpword = md5($_POST["register_pass"]); // encrypt the password
	$mconfirm_pword = md5($_POST["register_confirm_pass"]);  
	$phone = $_POST["register_phone"];
	$register_date = date("Y-m-d H:i:s");
	
	
	if( $mpword == $mconfirm_pword)
	{
		$sql = "select * from member where member_email = '$email'"; 
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) != 0) 
		{	echo"<script>alert('Email already existed')</script>";
		}
		else
		{
			$result_insert = mysqli_query($conn, "INSERT INTO `member`(`member_image`,`member_name`, `member_email`, `member_password`, `member_dob`, `member_phone`, `member_gender`, `member_register_date`) VALUES ('$images','$name','$email','$mpword','$mdob','$phone','$gender','$register_date')");
			
			$member_id = mysqli_insert_id($conn);

			$result_insert2 = mysqli_query($conn, "INSERT INTO `shopping_cart`(`shopping_cart_member_id`, `shopping_cart_type`) VALUES ($member_id,'unpaid')");
			$result_insert3 = mysqli_query($conn, "INSERT INTO `wishlist`(`wishlist_member_id`) VALUES ($member_id)");
			
			if($result_insert == 1 && $result_insert2 == 1 && $result_insert3 == 1)
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
				$mail->Subject = 'Register Succesfully';
				$mail->Body    = '<p style="padding-bottom:20px;">Dear '.$name.', <br><br><br> Welcome To OPTICALX ONLINE SHOP <br><br><br> Thank you for registering <b>Opticalx Online Shop</b>. <br>You can enjoy shopping as a link as below : </p><a href = "http://localhost/fyp/member_home.php">LOGIN HERE</a>';

				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				$mail->send();
				
				?>
				<script type = "text/javascript">
					alert("<?php echo 'Thank you '.$name.'. Your registration is successful'; ?>");
				</script>
				<?php	
				echo "<script>location.href='member_login.php'</script>";
			 }
		}
	}
	else
	{	echo"<script>alert('Your Password and Confirm Password are not the same')</script>";
	}
}
?>

