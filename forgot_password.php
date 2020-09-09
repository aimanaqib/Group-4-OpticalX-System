<?php include("connection.php"); ?>

<?php include 'header.php'; ?>

<title>Forget Password</title>

<div class="forget_password_wrapper">
	<div class="forget_password_wrapper_middle">
		<div class="title_reset_pass">
				<p>Reset Password</p>
		</div>
		
		<div class="some_content_reset_pass">
			Please enter your account email below to reset your password.<br/>
			If you do not wish to proceed, please <a href='member_login.php'>click here</a> to return to login.
		</div>
		
		<div class="forget_password_smallcontent">
			<form name="pass" method="post" action="">
				<div class="forget_pass_content">Your Email : </div>
				<div class="input_type_email"><input type="text" name="email"></div>
				<ul class="button_forget_pass_ul">
					<li class="button_forget_pass_li"><input type="submit" name="forgotPass" value="Submit" class="button_forget_pass"></li>
					<li class="button_forget_pass_li"><a href="member_login.php"><input type="button" value="Back to Login" class="button_forget_pass"></a></li>
					<li class="button_forget_pass_li"><a href="member_register.php"><input type="button" value="Sign-up" class="button_forget_pass"></a></li>
				</ul>
			</form>
		</div>
	</div>
</div>
	
<?php include 'footer.php'; ?>



<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	


if(isset($_POST["forgotPass"]))
{ $email =$_POST["email"];
  $sql = mysqli_query($conn,"select * from member where member_email = '$email'");
  $row = mysqli_fetch_assoc($sql);
  $pwd = bin2hex(openssl_random_pseudo_bytes(4));
  
  
  
  if(mysqli_num_rows($sql)==1)
  {
	$password = md5($pwd);
	$id = $row["member_id"];
	$name = $row["member_name"];
	mysqli_query($conn,"update  member set member_password = '$password' where member_id = $id");
    
    require_once 'PHPMailerAutoload.php';
	require 'src/Exception.php';
	require 'src/PHPMailer.php';
	require 'src/SMTP.php';
		//Load Composer's autoloader

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try 
	{
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'opticalx2709@gmail.com';                 // SMTP username
			$mail->Password = 'Opticalx!@#';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;    

			//Recipients这边起是有关于email的内容
			$mail->setFrom('opticalx2709@gmail.com', 'OpticalX Official Mail');
			$mail->addAddress($_POST["email"]);     // Add a recipient
			
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Reset Password';
			$mail->Body    = '<br>Hi , '.$name.'<br><br>Your New Password assigned to you as follow : <p style="padding-left:15px; font-size:20px;"><b>'.$pwd.' </b></p><br> You are required to reset the password after login';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			
			
			
	} 
	catch (Exception $e) 
	{ echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
	echo"<script>alert('Please Check You Emails, The new password sent to you already.')</script>";
	echo'<script>window.location="member_login.php"</script>';
  }
  else
  {  
	echo"<script>alert('Please Enter Valid Email')</script>";
	echo'<script>window.location="forgot_password.php"</script>';
  }	
}
?>