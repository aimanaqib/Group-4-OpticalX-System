 <?php include("connection.php"); ?>

 <title>Product Detail</title>


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
		
		<div class="nine columns">
			
				<select name="sortMyData" class="product_page_sort" onchange="location = this.value;">
								<option value="" disabled selected>Sorting</option>
								<option value="member_sorting_asc.php?page=1">Name A to Z</option>
								<option value="member_sorting_desc.php?page=1">Name Z to A</option>
								<option value="member_sorting_brand_asc.php?page=1">Brand A to Z</option>
								<option value="member_sorting_brand_desc.php?page=1">Brand Z to A</option>
								<option value="member_sorting_low.php?page=1">Price Low to High</option>
								<option value="member_sorting_high.php?page=1">Price High to Low</option>
				</select>
			
			<ul class="product_ul">
			<?php
			$page = $_GET["page"];
				
				if($page == "" || $page == "1")
				{ $page1 = 0;
			    }
				else
				{ $page1 = ($page - 1) * 16;
				}
			$result1 = mysqli_query($conn,"select * from product where product_trash='0' ORDER BY `product`.`product_price` desc limit $page1,16");
			while($row1 = mysqli_fetch_assoc($result1))
			{
			$prod_id = $row1["product_id"];
			$sql_img = mysqli_query($conn, "select * from image where image_product_id = $prod_id and image_trash='0'");
			$row_img = mysqli_fetch_assoc($sql_img);	
			$sql_brand = mysqli_query($conn, "select * from brand,product where product_brand_id = brand_id and product_id = $prod_id and brand_trash='0' ");
			$row_brand = mysqli_fetch_assoc($sql_brand);					
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $row1["product_id"];?>">
						<div class="product_details">
							<img src="<?php echo $row_img["image_img"];?>">
							<p class="product_brand"><?php echo $row_brand["brand_name"]; ?></p>
							<p class="product_title"><?php echo $row1["product_name"]; ?></p>
							<p class="product_price">RM <?php echo number_format($row1["product_price"],2); ?></p>
						</div>	
					</a>
				</li>
			<?php
			}
			
			$product = mysqli_query($conn,"select * from product where product_trash='0' ORDER BY `product`.`product_price` desc");
			$count = mysqli_num_rows($product);
			$a = ceil($count/16);
			?>
			<div class="pagination_product">
			<?php
			for($b=1; $b<=$a; $b++)
			{ ?><div class="pagination">
					<a href="member_sorting_high.php?page=<?php echo $b; ?>"><?php echo $b. " " ?></a>
				</div><?php
			}	
			?>	
			</div>
			</ul>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
