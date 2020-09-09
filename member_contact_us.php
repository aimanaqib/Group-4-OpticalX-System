<?php include("connection.php"); ?>

<?php include 'header.php'; ?>

<title>Contact Us</title>
<div class="contact_us_wrapper">
	<div class="page_title">
		<p>Contact Us</p>
	</div>
	
	<div class="contact_us_banner">
		<img src="images/member/contactus_banner1.jpg">
	</div>
	
	<div class="contact_us_small_wrapper">
		<div class="row">
			<div class="twelve columns contact_us_column_wrapper">
				<div class="eight columns">
					<form name="contact_us_form" class="contact_us_form" method="post" action="">
						<p class="contact_us_form_title">KEEP IN TOUCH WITH US</p>
						<p><input type="text" name="contact_name" class="contact_us_input"  placeholder="Name" required></p>
						<p><input type="email" name="contact_email" class="contact_us_input"  placeholder="Email" required></p>
						<p><input type="text" name="contact_subject" class="contact_us_input" placeholder="Subject" required></p>
						<p><input type="text" name="contact_message" class="contact_us_input" placeholder="Message" required></p>
						<input type="submit" name="contact_submitbtn" class="contact_submit" value="SUBMIT">
					</form>
				</div>	
				
				<div class="four columns contact_four_border">
					<?php
						$result = mysqli_query($conn,"select * from contact_us");
						$row = mysqli_fetch_assoc($result)
					?>
					<?php echo $row["contact_us_detail"];?>
						
						
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="contact_us_map">
		<p> <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3352.437851406357!2d102.27669969106137!3d2.249769368762062!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e56b9710cf4b%3A0x66b6b12b75469278!2sMultimedia+University!5e0!3m2!1sen!2smy!4v1516214005364" allowfullscreen></iframe></p>
	</div>

<?php include 'footer.php'; ?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST["contact_submitbtn"]))
{	$name = $_POST["contact_name"];
	$email =  $_POST["contact_email"];
	$subject =  $_POST["contact_subject"];
	$messej =  $_POST["contact_message"];
	
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
	
	$mail->setFrom($email,$name);
	$mail->addAddress('opticalx2709@gmail.com');  
	
	$mail->isHTML(true);      
	$mail->Subject = $subject;
	$mail->Body = '<p> Name : '.$name.'</p><p>Email : '.$email.'</p><p>Subject : '.$subject.'</p><p>Messej : '.$messej.'</p>';
	
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$mail->send();
	
	?>
	<script type = "text/javascript">
		alert("<?php echo 'Thank you for your inquiry'; ?>");
	</script>
	<?php	
	echo "<script>location.href='member_contact_us.php'</script>";
}