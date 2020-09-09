
<link type="text/css" rel="stylesheet" href="Css/style.css">
<link rel="stylesheet" href="Css/owl.carousel.min.css">
<link rel="stylesheet" href="Css/owl.theme.default.min.css">
<link href='https://fonts.googleapis.com/css?family=Alegreya SC' rel='stylesheet'>
<!--
<script src="Javascript/bootstrap.min.js"></script>
<script src="Javascript/jquery-1.10.2.min.js"></script>
<script src="Javascript/jquery-ui.js"></script>
-->

<body>
<div class="row">
	<div class="twelve columns">
		<div class="top_left_info">
			<ul class="top_left_info_ul">
				<li class="top_left_info_li">
					<div class="top_left_details">
						<a href="mailto:opticalx2709@gmail.com"><img src="Images/member/envelop.png" class="top_icon icon_padding">opticalx2709@gmail.com</a>
					</div>	
				</li>
				
				<li class="top_left_info_li">
					<div class="top_left_details">
						<span><img src="Images/member/telephone.png" class="top_icon"><span class="telephone_num">06 9530221</span></span>
					</div>	
				</li>
			</ul>
		</div>
		
		<div class="top_right_info">
			<ul class="top_right_info_ul">
					<?php
					
					if(isset($_SESSION['sess_name']))	
					{  
					?>
					
					
				<li class="top_right_info_li">
					<div class="top_right_details">
						<div class="profile_dropdown">
						  <button class="profile_dropbtn"><img src="Images/member/people.png" class="top_icon"><?php echo $_SESSION["sess_name"];?></a></button>
						  <div class="profile_dropdown_content">
						    <a href="member_profile.php">My Profile</a>
							<a href="member_wishlist.php">Wishlist</a>
							<a href="member_track_order.php">Track Order </a>
							<a href="member_logout.php"> Log Out </a>
						  </div>
						</div>	
					</div>
				</li>
				<li class="top_right_info_li">
					<div class="top_right_details">
						<a href="member_shopping_cart.php"><img src="Images/member/my_cart_icon.png" class="top_icon">My Cart </a>
					</div>
				</li>
					<?php
					}
					else
					{
					?>
				<li class="top_right_info_li">
					<div class="top_right_details">
						<a href="member_login.php"><img src="Images/member/people.png" class="top_icon">Login</a>
					</div>
				</li>
				<li class="top_right_info_li">
					<div class="top_right_details">
						<a href="member_register.php"><img src="Images/member/lock.png" class="top_icon">Create an Account</a>
					</div>	
				</li>
					<?php
					}
					?>
			</ul>
		</div>
	</div>
</div>

<div class="top_below">
	<div class="row">
		<div class="twelve columns">
			<ul class="menu_bar">
				<li class="menu_bar_li menu_bar_logo">
					<img src="Images/logo_opticalx.png">
				</li>
				<li class="menu_bar_li">
					<a href="member_home.php">Home</a>
				</li>
				
				<li class="header_drop_wrapper menu_bar_li ">
					 <div class="header_drop">
						<a href="member_product_list.php?page=1">Product</a>
					 </div>
						<!-- <div class="header_drop_content">
							Sunglasses
							<a href="#">Eyeglasses</a>
							<a href="#">Contact Lenses</a>
						</div> -->
				</li>

				<li class="menu_bar_li">
					<a href="member_about_us.php">About Us</a>
				</li>
				<li class="menu_bar_li">
					<a href="member_contact_us.php">Contact Us</a>
				</li>
				
				<li class="menu_bar_li">
					<form name="top_search" action="member_search.php" method="post">
						<ul class="top_search_wrapper">
							<li class="top_search_left">
								<input type="text" name="search" autocomplete="off" class="top_searching_bar" placeholder="Search in Optical-X">
							</li>
							<li class="top_search_right">
								<button type="submit" class="search_button_header" name="search_btn" ><img src="images/member/search_icon.png"></button>
							</li>
						</ul>
					</form>
				</li>
		</div>
	</div>
</div>
