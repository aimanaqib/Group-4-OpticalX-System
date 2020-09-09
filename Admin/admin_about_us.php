<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>
<title>About Us</title>
<?php include 'side_menu_admin.php';?>
<div class="admin_all_wrapper">
		<div class="admin_about_us_detail">
			<p>About US Top Details</p>
		</div>	
		<?php	
			$sql = "select * from about_us where id = '1' "; 
			$result = mysqli_query($conn,$sql);
			$row = (mysqli_fetch_array($result));
			$sql2 = "select * from about_us where id = '2' "; 
			$result2 = mysqli_query($conn,$sql2);
			$row2 = (mysqli_fetch_array($result2));
			
			if ($row != 0 && $row2 !=0)
			{
		?>
			<form action="" method="post">
					<textarea class="ckeditor" name="editor1"><?php echo $row["about_us_detail"]; ?></textarea>
					
			<div class="admin_about_us_detail">
				<p>About US Bottom Details</p>
			</div>
					<textarea class="ckeditor" name="editor2"><?php echo $row2["about_us_detail"]; ?></textarea>
					<input type="submit" value="Submit" class="admin_about_us_sbmit" name="admin_about_us_submit2">
			</form>
					
		<?php
			}
			else
			{
		?>
			<form action="" method="post">
				<textarea class="ckeditor" name="editor1"></textarea>
				
				<div class="admin_about_us_detail">
					<p>About US Bottom Details</p>
				</div>
				<textarea class="ckeditor" name="editor2"></textarea>
				<input type="submit" value="Submit" class="admin_about_us_sbmit" name="admin_about_us_submit1">
			</form>
						
		<?php
			}
		?>
		
		
</div>
</body>
<?php
if (isset($_POST["admin_about_us_submit1"])) 	
	{
		$text = $_POST["editor1"];
		$text = mysqli_real_escape_string($conn, $text);
		$result_insert = mysqli_query($conn,"insert into about_us VALUES('','$text')");
		$result_insert = mysqli_real_escape_string($conn, $result_insert);
		
		$text2 = $_POST["editor2"];
		$text2 = mysqli_real_escape_string($conn, $text2);
		$result_insert2 = mysqli_query($conn,"insert into about_us VALUES('','$text2')");
		$result_insert2 = mysqli_real_escape_string($conn, $result_insert2);

		echo '<script type="text/javascript">';
		echo 'alert("About Us Detail Added")';
		echo '</script>';
		
	echo "<script>location.href='admin_about_us.php'</script>";

	}

if (isset($_POST["admin_about_us_submit2"])) 	
	{
		$text = $_POST["editor1"];
		$text = mysqli_real_escape_string($conn, $text);
		$result_insert = mysqli_query($conn,"update about_us set about_us_detail='$text' where id = '1'");
		$result_insert = mysqli_real_escape_string($conn, $result_insert);

		$text2 = $_POST["editor2"];
		$text2 = mysqli_real_escape_string($conn, $text2);
		$result_insert2 = mysqli_query($conn,"update about_us set about_us_detail='$text2' where id = '2' ");
		$result_insert2 = mysqli_real_escape_string($conn, $result_insert2);
		
		echo '<script type="text/javascript">';
		echo 'alert("About Us detail Uploaded")';
		echo '</script>';

	echo "<script>location.href='admin_about_us.php'</script>";
	}
?>

