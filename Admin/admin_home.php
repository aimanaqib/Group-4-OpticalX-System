<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>
<title>HomePage</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">

	<div class="admin_home_wrapper">

		<div class="admin_home_title">
			Update Slide Show HomePage
		</div>

		<div class="admin_home">
			<div class="admin_home_button">
				<input type="button" class="admin_hmoebtn_cls" onclick="slide_1()" value="Slide 1">
				<input type="button" class="admin_hmoebtn_cls" onclick="slide_2()" value="Slide 2">
				<input type="button" class="admin_hmoebtn_cls" onclick="slide_3()" value="Slide 3">
				<input type="button" class="admin_hmoebtn_cls" onclick="slide_4()" value="Slide 4">
			</div>
		</div>
		
		<div class="admin_update_slide" id="slide_1_1">
			<form method="post" action="" enctype="multipart/form-data">
			<?php
				$slide1_sql = mysqli_query($conn, "select * from home where home_id = 1");
				$row_slide1_sql = mysqli_fetch_assoc($slide1_sql);
			?>
				<img src="<?php echo '../'.$row_slide1_sql["home_slide"];?>">
				
				<input type="file" class="input_home_slide" name="admin_home_slide1" accept="image/*" onchange="preview_image1(event)" required><br>
				<span class="notification_admin_home"><small>*recommended 1200x500pixel</small></span>
				
				<div class="admin_home_slide"><img id="output_image1"/></div>
				
				<input type="submit" class="update_home_slidebtn" name="update_home_slide1" value="UPDATE">
			</form>
		</div>
		
		<div class="admin_update_slide" id="slide_2_2">
			<form method="post" action="" enctype="multipart/form-data">
			<?php
				$slide2_sql = mysqli_query($conn, "select * from home where home_id = 2");
				$row_slide2_sql = mysqli_fetch_assoc($slide2_sql);
			?>
				<img src="<?php echo '../'.$row_slide2_sql["home_slide"];?>">
				
				<input type="file" class="input_home_slide" name="admin_home_slide2" accept="image/*" onchange="preview_image2(event)" required><br>
				<span class="notification_admin_home"><small>*recommended 1200x500pixel</small></span>
				<div class="admin_home_slide"><img id="output_image2"/></div>
				
				<input type="submit" class="update_home_slidebtn" name="update_home_slide2" value="UPDATE">
			</form>
		</div>
		
		<div class="admin_update_slide" id="slide_3_3">
			<form method="post" action="" enctype="multipart/form-data">
			<?php
				$slide3_sql = mysqli_query($conn, "select * from home where home_id = 3");
				$row_slide3_sql = mysqli_fetch_assoc($slide3_sql);
			?>
				<img src="<?php echo '../'.$row_slide3_sql["home_slide"];?>">
				
				<input type="file"  class="input_home_slide" name="admin_home_slide3" accept="image/*" onchange="preview_image3(event)" required><br>
				<span class="notification_admin_home"><small>*recommended 1200x500pixel</small></span>
				<div class="admin_home_slide"><img id="output_image3"/></div>
				
				<input type="submit" class="update_home_slidebtn" name="update_home_slide3" value="UPDATE">
			</form>
		</div>
		
		<div class="admin_update_slide" id="slide_4_4">
			<form method="post" action="" enctype="multipart/form-data">
			<?php
				$slide4_sql = mysqli_query($conn, "select * from home where home_id = 4");
				$row_slide4_sql = mysqli_fetch_assoc($slide4_sql);
			?>
				<img src="<?php echo '../'.$row_slide4_sql["home_slide"];?>">
				
				<input type="file"  class="input_home_slide" name="admin_home_slide4" accept="image/*" onchange="preview_image4(event)" required><br>
				<span class="notification_admin_home"><small>*recommended 1200x500pixel</small></span>
				<div class="admin_home_slide"><img id="output_image4"/></div>
				
				<input type="submit" class="update_home_slidebtn" name="update_home_slide4" value="UPDATE">
			</form>
		</div>
	</div>
</div>

<?php

if (isset($_POST["update_home_slide1"])) 
{
	$slide_1 = "images/member/".basename($_FILES['admin_home_slide1']['name']);
	
	mysqli_query($conn,"update home set home_slide='$slide_1' where home_id = 1");
	
	echo "<script>location.href='admin_home.php'</script>";
}

if (isset($_POST["update_home_slide2"])) 
{
	$slide_2 = "images/member/".basename($_FILES['admin_home_slide2']['name']);
	
	mysqli_query($conn,"update home set home_slide='$slide_2' where home_id = 2");
	
	echo "<script>location.href='admin_home.php'</script>";
}
if (isset($_POST["update_home_slide3"])) 
{
	$slide_3 = "images/member/".basename($_FILES['admin_home_slide3']['name']);
	
	mysqli_query($conn,"update home set home_slide='$slide_3' where home_id = 3");
	
	echo "<script>location.href='admin_home.php'</script>";
}
if (isset($_POST["update_home_slide4"])) 
{
	$slide_4 = "images/member/".basename($_FILES['admin_home_slide4']['name']);
	
	mysqli_query($conn,"update home set home_slide='$slide_4' where home_id = 4");
	
	echo "<script>location.href='admin_home.php'</script>";
}


?>

<script>

function slide_1(){
	document.getElementById('slide_1_1').style.display ='block';
	document.getElementById('slide_2_2').style.display ='none';
	document.getElementById('slide_3_3').style.display ='none';	
	document.getElementById('slide_4_4').style.display ='none';
}

function slide_2(){
	document.getElementById('slide_1_1').style.display ='none';
	document.getElementById('slide_2_2').style.display ='block';
	document.getElementById('slide_3_3').style.display ='none';	
	document.getElementById('slide_4_4').style.display ='none';
}

function slide_3(){
	document.getElementById('slide_1_1').style.display ='none';
	document.getElementById('slide_2_2').style.display ='none';
	document.getElementById('slide_3_3').style.display ='block';	
	document.getElementById('slide_4_4').style.display ='none';
}

function slide_4(){
	document.getElementById('slide_1_1').style.display ='none';
	document.getElementById('slide_2_2').style.display ='none';
	document.getElementById('slide_3_3').style.display ='none';	
	document.getElementById('slide_4_4').style.display ='block';
}

function preview_image1(event) 
{
	var reader = new FileReader();
	reader.onload = function()
	{
		var output = document.getElementById('output_image1');
		output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]); 
}
function preview_image2(event) 
{
	var reader = new FileReader();
	reader.onload = function()
	{
		var output = document.getElementById('output_image2');
		output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]); 
}
function preview_image3(event) 
{
	var reader = new FileReader();
	reader.onload = function()
	{
		var output = document.getElementById('output_image3');
		output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]); 
}
function preview_image4(event) 
{
	var reader = new FileReader();
	reader.onload = function()
	{
		var output = document.getElementById('output_image4');
		output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]); 
}

</script>
