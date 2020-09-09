<?php include("connection.php"); ?>

<title>About Us</title>

<?php include 'header.php'; ?>

<div class="about_us_wrapper">
	<div class="page_title">
		<p>About Us</p>
	</div>
	
	<div class="about_us_small_wrapper">
		
		<div class="row">
			<div class="twelve columns">
				<div class="about_us_small_title">
					<p>Optical X</p>
				</div>
				
				<div class="about_us_banner">
					<img src="images/member/aboutus_banner1.jpg">
				</div>
				
				<div class="about_us_content">
					<?php
						$sql_about_us1= mysqli_query($conn, "select * from about_us where id = '1' ");
						$row_sql_about_us1 = mysqli_fetch_assoc($sql_about_us1);
					?>
					<p> 
						<?php echo $row_sql_about_us1['about_us_detail']; ?>
					</p>
				</div>

				<div class="about_us_banner">
					<img src="images/member/aboutus_banner2.jpg">
				</div>
				
				
				<?php
					$sql_about_us2 = mysqli_query($conn, "select * from about_us where id = '2' ");
					$row_sql_about_us2 = mysqli_fetch_assoc($sql_about_us2);
				?>
				
				<?php echo $row_sql_about_us2['about_us_detail']; ?>
			</div>
		</div>
	
	</div>
</div>

<?php include 'footer.php'; ?>
