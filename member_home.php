<?php include("connection.php"); ?>
<title>Home</title>
<?php include 'header.php'; ?>

<div class="home_wrapper">
			<div class="home_slide_show">
			<?php
				$sql1 = mysqli_query($conn, "select * from home where home_id = 1");
				$sql2 = mysqli_query($conn, "select * from home where home_id = 2");
				$sql3 = mysqli_query($conn, "select * from home where home_id = 3");
				$sql4 = mysqli_query($conn, "select * from home where home_id = 4");
				
				$row_sql1 = mysqli_fetch_assoc($sql1);
				$row_sql2 = mysqli_fetch_assoc($sql2);
				$row_sql3 = mysqli_fetch_assoc($sql3);
				$row_sql4 = mysqli_fetch_assoc($sql4);
			?>
				<!--
				<img class="slideshow" src="<?php echo $row_sql1["home_slide"];?>">
				<img class="slideshow" src="<?php echo $row_sql2["home_slide"];?>">
				<img class="slideshow" src="<?php echo $row_sql3["home_slide"];?>">
				<img class="slideshow" src="<?php echo $row_sql4["home_slide"];?>">
				-->
				
				<div class="slideshow_container_home">

					<div class="mySlides_home home_fade">
					  <img src="<?php echo $row_sql1["home_slide"];?>">
					</div>

					<div class="mySlides_home home_fade">
					  <img src="<?php echo $row_sql2["home_slide"];?>">
					</div>

					<div class="mySlides_home home_fade">
					  <img src="<?php echo $row_sql3["home_slide"];?>">
					</div>

					<div class="mySlides_home home_fade">
					  <img src="<?php echo $row_sql4["home_slide"];?>">
					</div>

				</div>
					
				<br>
				
				<div style="text-align:center;margin-top:-50px;">
					<span class="dot_home"></span> 
					<span class="dot_home"></span> 
					<span class="dot_home"></span> 
					<span class="dot_home"></span> 
				</div>		
				
			</div>

	<div class="home_text_top clearfix">
		<ul>
			<li>
				<img src="images/member/home_vision_mission.png">
				<span class="htt_title">VISION & MISSION</span>
				<div class="htt_content">Our vision is to achieve an annual the turnover of RM100 million by Year 2023 and establish a strong brand as a leading Optical.</div>

			</li>
			<li>
				<img src="images/member/home_slogan.png">
				<span class="htt_title">MISSION</span>
				<div class="htt_content">Our mission is to reduce the people's chance that people become short-sighted.</div>
				
			</li>
			<li>
				<img src="images/member/home_core_value.png">
				<span class="htt_title">CORE VALUES</span>
				<div class="htt_content">PERSISTENT</br>(People, Emphasis, Respect, Sensity, Innovation, Safety, Technology, Efficiency, Notability, Teamwork)</div>
			</li>
		</ul>
    </div>
	
	<div class="home_top_img">
		<div class="home_top_word">
			<p class="top_home_word_title">This is Optical-X</p>
			<p class="top_home_word_p">Goggles or safety glasses are forms of protective eyeswear that 
										usually enclose or protect the area surrounding the eye in order 
										to prevent particulates.
			</p>
		</div>
	</div>
	
	<div class="home_top_sales">
		<div class="row">
			<div class="twelve columns">
				<div class="home_top_title">
					<p>Top Sales</p>
				</div>
				<div class="home_top_sales_product">
					<div id="demos">
						<div class="owl-carousel owl-theme">	
						
							<?php					
							$result1 = mysqli_query($conn,"select * from product where product_top='yes' and product_trash = '0' ");
							
							while($row1 = mysqli_fetch_assoc($result1))
							{		
							$prod_id = $row1["product_id"];
							$sql_take = mysqli_query($conn, "select * from image,brand,product where 
																image_product_id = $prod_id 
															AND product_brand_id = brand_id
															AND image_trash = '0' 
															AND brand_trash = '0'
															AND product_trash = '0'
															AND product_id = $prod_id");
							$row_take = mysqli_fetch_assoc($sql_take);	
			
							?>
								<div class="home_top_product">
									<a href="member_product_details.php?pid=<?php echo $prod_id;?>">
										<div class="product_details">
											<img src="<?php echo $row_take["image_img"];?>">
											<p class="product_brand"><?php echo $row_take["brand_name"]; ?></p>
											<p class="product_title"><?php echo $row1["product_name"]; ?></p>
											<p class="product_price">RM <?php echo number_format($row1["product_price"],2); ?></p>
										</div>	
									</a>
								</div>
							<?php
							}
							?>
							
							
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>	
	
		<div class="home_top_brand">
		<div class="row">
			<div class="twelve columns">
				<div class="home_top_title">
					<p>Top Brand</p>
				</div>
				<div class="home_top_brand_img">
					<div class="owl-carousel owl-theme">						
					
						<?php					
							$result2 = mysqli_query($conn,"select * from brand where brand_top='yes' and brand_trash = '0' ");
							while($row2 = mysqli_fetch_assoc($result2))
							{				
							?>
								<div class="top_brand_logo">
									<img src="<?php echo $row2["brand_image"];?>"></a>
								</div>
							<?php
							}
							?>
					</div> 
				</div>
				</div>
			</div>
		</div>
	</div>	
		
</div>

<?php include 'footer.php'; ?>
<script>
var slideIndex_home = 0;
showSlides();

function showSlides() {
    var i_home;
    var slides_home = document.getElementsByClassName("mySlides_home");
    var dots_home = document.getElementsByClassName("dot_home");
    for (i_home = 0; i_home < slides_home.length; i_home++) {
       slides_home[i_home].style.display = "none";  
    }
    slideIndex_home++;
    if (slideIndex_home > slides_home.length) {slideIndex_home = 1}    
    for (i_home = 0; i_home < dots_home.length; i_home++) {
        dots_home[i_home].className = dots_home[i_home].className.replace(" home_active", "");
    }
    slides_home[slideIndex_home-1].style.display = "block";  
    dots_home[slideIndex_home-1].className += " home_active";
    setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>

<script>
$(document).ready(function() {
  var owl = $('.owl-carousel');
  owl.owlCarousel({
	items: 5,
	loop: true,
	margin: 10,
	autoplay: true,
	autoplayTimeout: 3000,
	autoplayHoverPause: true
  });
})
</script>
