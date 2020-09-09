<?php include("connection.php"); ?>

<title>Login</title>

<?php include 'header.php'; ?>

<div id="Login_wrapper">
	<div class="page_title">
		<p>Login</p>
	</div>
	
	<div class="Login_small_wrapper">
		<div class="row">
			<div class="twelve columns">
				<div class="small_title_login">
					<p>REGISTERED CUSTOMERS</p>
				</div>
				
				<div class="login_p">
					<p>If you have an account with us, please log in.</p>
				</div>
			
				<form name="login_form"  method="post" action="">
					<p class="login_form_p">Email Address </p>
					<input type="email" class="login_details" name="login_email">
					
					<p class="login_form_p">Password </p>
					<input type="password" class="login_details" name="login_pass" >
					
					<p><a class="login_forgot_pass" href="forgot_password.php">Forgot Your Password ? </a><input type="submit" name="loginacc" value="Login" class="btn_login"></p>
					
					<div class="small_title_login">
						<p>NEW CUSTOMERS</p>
					</div>
					
					<div class="login_p">
						<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple 
						shipping addresses, view and track your orders in your account and more.</p>
					</div>
					
					<a href="member_register.php"> <button type="button" name="loginbtn" class="login_create">CREATE AN ACCOUNT</button> </a>
					
				</form>
			</div>
		</div>
	</div>
</div>


<div class="pop_wrapper">
	<div id="forget_pop_content" class="popup_container">
        <span onclick="close_pop()" class="pop_close_button">&times;</span>
		<form name="pop_out_add_form" method="post" action="">
		
			<div class="title_pop_add">
				<p>Forget Password</p>
			</div>
				<p><div class="profile_spacing">Email</div>
					<input type="text" name="forget_pass" class="input_profile" required>
				
				<input type="submit" name="btnPass" Value="SAVE" class="member_profile_edit_submitbtn">
		</form>
	</div>
</div>
<!--<form name="pop_out_add_form" method="post" action="">
	<div class="title_pop_add">
		<p>Forget Password</p>
	</div>
	<p><div class="profile_spacing">Email</div>
		<input type="text" name="forget_pass" class="input_profile" required>
		<input type="submit" name="btnPass" Value="Submit" class="member_profile_edit_submitbtn">
</form>!-->

<?php include 'footer.php'; ?>
<script type="text/javascript">
function show_pop(){
	document.getElementById('forget_pop_content').style.display ='block';
	document.getElementById('Login_wrapper').style.opacity ='0.2';
}
function close_pop(){
	document.getElementById('forget_pop_content').style.display ='none';
	document.getElementById('Login_wrapper').style.opacity ='1';

}
</script>
<?php
if(isset($_POST["btnPass"]))
{	
	 $email = mysqli_real_escape_string($conn, $_POST["forget_pass"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
		 ?>
		<script type = "text/javascript">
			alert("Invalid email address please type a valid email!!");
		</script>
	<?php
    }
    else
    {
        $query = "SELECT member_id FROM member where member_email='".$email."'";
        $result = mysqli_query($conn,$query);
        $Results = mysqli_fetch_array($result);
		$member_id = $result["member_email"];
        if(count($Results)>=1)
        {
            $encrypt = md5(1290*3+$Results['member_id']);
			
			require 'php-mailer-master/PHPMailerAutoload.php';
            $emailBody='Hi, <br/> <br/>Your Membership ID is '.$Results['member_id'].' <br><br>Click here to reset your password http://localhost/member_reset_password.php?encrypt='.$encrypt.'&action=reset   <br/> <br><br></p>Regards,<br> Admin.';

			$mail = new PHPMailer;
	
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'opticalx2709@gmail.com';                 // SMTP username
			$mail->Password = 'Opticalx!@#';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('opticalx2709@gmail.com', 'OpticalX Official Mail');
			$mail->addAddress('$member_id', 'Dear Member');     // Add a recipient

			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Forget Password';
			$mail->Body    = $emailBody;
			
        }
        else
        {
            ?>
		<script type = "text/javascript">
			alert("Account not found please signup now!!");
		</script>
	<?php
        }
    }
}

if (isset($_POST["loginacc"])) 	
{
	$email = $_POST["login_email"];    		
	$pword = md5($_POST["login_pass"]);  
	// encrypt the password so that it can be compared
	// the database keeps the encrypted version of the password
	
	$result = mysqli_query($conn, "select * from member where member_email = '$email' and member_password = '$pword'");
	$row = mysqli_fetch_assoc($result);
	
	if (mysqli_num_rows($result) != 1) // if no records are found
	{
	?>
		<script type = "text/javascript">
			alert("Wrong Email Address or Password");
		</script>
	<?php
		$_SESSION["loggedin"] = 0;
	}
	else
	{	session_start();
		$_SESSION["sess_memid"] = $row["member_id"]; // keep the PK as session
		$_SESSION["sess_email"] = $row["member_email"];
		$_SESSION["sess_pass"] = $row["member_password"];
		$_SESSION["sess_name"] = $row["member_name"];
		$_SESSION["loggedin"] = 1; // keep the login status as session
		echo "<script>location.href='member_home.php'</script>";
	}
	
	mysqli_close($conn);
}
?>

