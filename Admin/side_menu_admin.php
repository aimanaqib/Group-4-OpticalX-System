<link type="text/css" rel="stylesheet" href="Css/style_admin.css">
<script src="ckeditor/ckeditor.js"></script>

<body>
<?php
$admin_id = $_SESSION["sess_adid"]; 
?>
		
		<div class="side_menu">
		
			<div class="admin_side_menu_img">
				<?php 
					$sql = mysqli_query($conn, "select * from admin where admin_id = $admin_id");
					$row_sql = mysqli_fetch_assoc($sql);
				?>
				<img src="<?php echo '../'.$row_sql["admin_image"];?>">
			</div>
		
			<div class="side_menu_admin_special">
				<a href="admin_dashboard.php" >Dashboard</a>
			</div>
			<button class="dropdown-btn side_menu_admin_special" >Manage Product</button>
				<div class="dropdown-container">
					<a href="admin_view_product.php?page=1">Product</a>
					<a href="admin_view_image.php?page=1">Image</a>
					<a href="admin_view_brand.php?page=1">Brand</a>
					<a href="admin_view_colour.php?page=1">Colour</a>
					<a href="admin_view_shape.php?page=1">Shape</a>
					<a href="admin_view_material.php?page=1">Material</a>
				</div>
				
			<button class="dropdown-btn side_menu_admin_special">Pages</button>
				<div class="dropdown-container">
					<a href="admin_home.php">Home</a>
					<a href="admin_contact_us.php">Contact Us</a>	
					<a href="admin_about_us.php">About Us</a>
				</div>
				
			<button class="dropdown-btn side_menu_admin_special">Order</button>
				<div class="dropdown-container">
					<a href="admin_uncomplete_order.php?page=1">Processing Order</a>
					<a href="admin_completed_order.php?page=1">Order History</a>
				</div>
				
			<button class="dropdown-btn side_menu_admin_special">Admin</button>
				<div class="dropdown-container">
					<a href="admin_view_profile.php">View Profile</a>
					<a href="admin_update_profile.php">Edit Profile</a>
				</div>
				
			<?php
				if($admin_id == 1)
				{
			?>
			<button class="dropdown-btn side_menu_admin_special">Setting</button>
				<div class="dropdown-container">
					<a href="super_admin_view_admin.php?admin=1">View Admin Detail</a>
					<a href="super_admin_add_admin.php">Add new admin</a>	
				</div>
			<?php
				}
				else
				{
					echo "";
				}
			?>
			<div class="side_menu_admin_special">	
				<a href="admin_logout.php">LogOut</a>
			</div>
		</div>	
	
<script>

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

</script>
