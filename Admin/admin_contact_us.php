<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>
<title>Contact Us</title>
<?php include 'side_menu_admin.php';?>
<div class="admin_all_wrapper">

			<div class="admin_contact_us_detail">
				<p>Contact Detail</p>
			</div>
			
			<?php	
				$sql = "select * from contact_us where id = '1' "; 
				$result = mysqli_query($conn,$sql);
				$row = (mysqli_fetch_array($result));
				
				if ($row != 0)
				{
			?>
					<form action="" method="post">
							<textarea class="ckeditor" name="editor"><?php echo $row["contact_us_detail"]; ?></textarea>
							<input type="submit" value="Submit" class="admin_contact_submit" name="admin_contact_submit2">
					</form>
					
			<?php
				}
				else
				{
			?>
				<form action="" method="post">
					<textarea class="ckeditor" name="editor"></textarea>
					<input type="submit" value="Submit" class="admin_contact_submit" name="admin_contact_submit1">
				</form>
						
			<?php
				}
			?>

</div>
</body>
<?php
if (isset($_POST["admin_contact_submit1"])) 	
	{
		$text = $_POST["editor"];
		$text = mysqli_real_escape_string($conn, $text);
		$result_insert1 = mysqli_query($conn,"insert into contact_us VALUES('','$text')");
		$result_insert1 = mysqli_real_escape_string($conn, $result_insert1);
?>
		<script type="text/javascript">
			alert("Contact Us detail Added");
		</script>
<?php
	echo "<script>location.href='admin_contact_us.php'</script>";
	}
?>

<?php
if (isset($_POST["admin_contact_submit2"])) 	
	{
		$text = $_POST["editor"];
		$text = mysqli_real_escape_string($conn, $text);
		$result_insert2 = mysqli_query($conn,"update contact_us set contact_us_detail='$text'");
		$result_insert2 = mysqli_real_escape_string($conn, $result_insert2);
?>
		<script type="text/javascript">
		alert("Contact Us detail Uploaded");
		</script>
<?php

	echo "<script>location.href='admin_contact_us.php'</script>";
	}
?>