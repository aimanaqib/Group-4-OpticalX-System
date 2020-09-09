<?php include("connection.php"); ?>

<title>Search</title>

<?php include 'header.php'; ?>

<div id="product_page_wrapper">
	<div class="row">
		<div class="three columns">
			<form name="categories_form" method="post" action="product_filter.php">
				<div class="product_categories">
					<div class="product_categories_content">
						<div class="product_categories_content_title">Gender</div>
							<div class="product_categories_content_content">
								<input type="submit" name="gender_male" value="Male" class="product_filter_btn">
								<input type="submit" name="gender_female" value="Female" class="product_filter_btn">
								<input type="submit" name="gender_unisex" value="Unisex" class="product_filter_btn">
							</div>
					</div>
					
					<div class="product_categories_content">
						<div class="product_categories_content_title">Type of Usage</div>
							<div class="product_categories_content_content">
								<input type="submit" name="Sunglasses" value="Sunglasses" class="product_filter_btn">
								<input type="submit" name="Eyeglasses" value="Eyeglasses" class="product_filter_btn">
								<input type="submit" name="Contact_Lenses" value="Contact Lenses" class="product_filter_btn">
							</div>
					</div>
					
					<div class="product_categories_content">
						<div class="product_categories_content_title">Brand</div>
							<div class="product_categories_content_content">
							
								<?php
								$sql_brand = mysqli_query($conn, "select * from brand where brand_id >=2 ");
								while($row_brand = mysqli_fetch_assoc($sql_brand))
									{
								?>
									<!-- <input type="checkbox" name="brand" value="<?php echo $row_brand["brand_id"]; ?>"><?php echo $row_brand["brand_name"]; ?><br> -->
									<input type="submit" name="<?php echo 'A'.$row_brand["brand_id"]; ?>" value="<?php echo $row_brand["brand_name"]; ?>" class="product_filter_btn">
								<?php
									}
								?>
								
							</div>
					</div>
					
					<div class="product_categories_content">
						<div class="product_categories_content_title">Frame Shape</div>
							<div class="product_categories_content_content">
								<?php
								$sql_shape = mysqli_query($conn, "select * from shape where shape_id >=2 ");
								while($row_shape = mysqli_fetch_assoc($sql_shape))
									{
								?>
									<!-- <input type="checkbox" name="shape" value="<?php echo $row_shape["shape_id"]; ?>"><?php echo $row_shape["shape_content"]; ?><br> -->
									<input type="submit" name="<?php echo 'B'.$row_shape["shape_id"]; ?>" value="<?php echo $row_shape["shape_content"]; ?>" class="product_filter_btn">

								<?php
									}
								?>
							</div>
					</div>
					
					<div class="product_categories_content">
						<div class="product_categories_content_title">Lens Colour</div>
							<div class="product_categories_content_content">
								<?php
								$sql_colour = mysqli_query($conn, "select * from colour where colour_id >=2 ");
								while($row_colour = mysqli_fetch_assoc($sql_colour))
									{
								?>
									<!-- <input type="checkbox" name="lens_colour" value="<?php echo $row_colour["colour_id"]; ?>"><?php echo $row_colour["colour_name"]; ?><br> -->
									<input type="submit" name="<?php echo 'C'.$row_colour["colour_id"]; ?>" value="<?php echo $row_colour["colour_name"]; ?>" class="product_filter_btn">
									
								<?php
									}
								?>
							</div>
					</div>
					
					<div class="product_categories_content">
						<div class="product_categories_content_title">Frame Material</div>
							<div class="product_categories_content_content">
								<?php
								$sql_material = mysqli_query($conn, "select * from material where material_id >=2 ");
								while($row_material = mysqli_fetch_assoc($sql_material))
									{
								?>
									<!-- <input type="checkbox" name="frame_material" value="<?php echo $row_material["material_id"]; ?>"><?php echo $row_material["material_name"]; ?><br> -->
									<input type="submit" name="<?php echo 'D'.$row_material["material_id"]; ?>" value="<?php echo $row_material["material_name"]; ?>" class="product_filter_btn">

								<?php
									}
								?>
							</div>
					</div>
					
					<div class="product_categories_content">
						<div class="product_categories_content_title">Frame Colour</div>
							<div class="product_categories_content_content">
								<?php
								$sql_frame = mysqli_query($conn, "select * from colour where colour_id >=2 ");
								while($row_frame = mysqli_fetch_assoc($sql_frame))
									{
								?>
									<!-- <input type="checkbox" name="frame_colour" value="<?php echo $row_frame["colour_id"]; ?>"><?php echo $row_frame["colour_name"]; ?><br> -->
									<input type="submit" name="<?php echo 'E'.$row_frame["colour_id"]; ?>" value="<?php echo $row_frame["colour_name"]; ?>" class="product_filter_btn">

								<?php
									}
								?>
							</div>
					</div>
				</div>
			</form>
		</div>




<?php
if(isset($_POST['search_btn']))
{
	$search = $_POST['search']; 

	$query = mysqli_query($conn, "Select * from product,brand where (product_name like '%$search%' and product_brand_id = brand_id and product_trash='0') or (brand_name like '%$search%' and product_brand_id = brand_id and brand_trash='0')");
	$count = mysqli_num_rows($query);
	if($count ==0) 
	{
	?>
		<div class="nine columns">
			<p><?php echo 'There was no search Result'; ?></p>
		</div>
	<?php
	}	
	else
	{	
	?>	
		<div class="nine columns">
			<ul class="product_ul">
			<?php
			while($rowsearch = mysqli_fetch_array($query)) 
			{	$product_id = $rowsearch["product_id"];
				$sql_img = mysqli_query($conn, "select * from image where image_product_id = $product_id and image_trash='0'");
				$row = mysqli_num_rows($sql_img);
				$row_img = mysqli_fetch_assoc($sql_img);	
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $product_id;?>">
						<div class="product_details">
						<?php
						if($row  == 0)
						{	
					?>
					<img src="images/brand/no_img.jpg">
					<?php
						}
						else
						{
						?>
							<img src="<?php echo $row_img["image_img"];?>">
							<?php
						}
						?>
							<p class="product_brand"><?php echo $rowsearch['brand_name']; ?></p>
							<p class="product_title"><?php echo $rowsearch['product_name']; ?></p>
							<p class="product_price">RM <?php echo number_format($rowsearch['product_price'],2); ?></p>
						</div>	
					</a>
				</li>
			<?php
			}
			?>
			</ul>
		</div>
	<?php
	}
}
?>
	</div>
</div>

<?php include 'footer.php'; ?>

