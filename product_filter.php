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
if(isset($_POST['gender_male']))
{
	$query = mysqli_query($conn, "Select * from product,brand where product_gender = 'Male' and product_brand_id = brand_id");
	$count = mysqli_num_rows($query);
	if($count ==0) 
	{
	?>
		<div class="nine columns">
			<p><?php echo 'There was no Result'; ?></p>
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
				$row_img = mysqli_fetch_assoc($sql_img);	
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $product_id;?>">
						<div class="product_details">
							<img src="<?php echo $row_img["image_img"];?>">
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

if(isset($_POST['gender_female']))
{
	$query = mysqli_query($conn, "Select * from product,brand where product_gender = 'Female' and product_brand_id = brand_id");
	$count = mysqli_num_rows($query);
	if($count ==0) 
	{
	?>
		<div class="nine columns">
			<p><?php echo 'There was no Result'; ?></p>
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
				$row_img = mysqli_fetch_assoc($sql_img);	
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $product_id;?>">
						<div class="product_details">
							<img src="<?php echo $row_img["image_img"];?>">
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

if(isset($_POST['gender_unisex']))
{
	$query = mysqli_query($conn, "Select * from product,brand where product_gender = 'Unisex' and product_brand_id = brand_id");
	$count = mysqli_num_rows($query);
	if($count ==0) 
	{
	?>
		<div class="nine columns">
			<p><?php echo 'There was no Result'; ?></p>
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
				$row_img = mysqli_fetch_assoc($sql_img);	
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $product_id;?>">
						<div class="product_details">
							<img src="<?php echo $row_img["image_img"];?>">
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

if(isset($_POST['Sunglasses']))
{
	$query = mysqli_query($conn, "Select * from product,brand where product_type = 'Sunglasses' and product_brand_id = brand_id");
	$count = mysqli_num_rows($query);
	if($count ==0) 
	{
	?>
		<div class="nine columns">
			<p><?php echo 'There was no Result'; ?></p>
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
				$row_img = mysqli_fetch_assoc($sql_img);	
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $product_id;?>">
						<div class="product_details">
							<img src="<?php echo $row_img["image_img"];?>">
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

if(isset($_POST['Eyeglasses']))
{
	$query = mysqli_query($conn, "Select * from product,brand where product_type = 'Eyeglasses' and product_brand_id = brand_id");
	$count = mysqli_num_rows($query);
	if($count ==0) 
	{
	?>
		<div class="nine columns">
			<p><?php echo 'There was no Result'; ?></p>
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
				$row_img = mysqli_fetch_assoc($sql_img);	
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $product_id;?>">
						<div class="product_details">
							<img src="<?php echo $row_img["image_img"];?>">
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

if(isset($_POST['Contact_Lenses']))
{
	$query = mysqli_query($conn, "Select * from product,brand where product_type = 'Contact Lenses' and product_brand_id = brand_id");
	$count = mysqli_num_rows($query);
	if($count ==0) 
	{
	?>
		<div class="nine columns">
			<p><?php echo 'There was no Result'; ?></p>
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
				$row_img = mysqli_fetch_assoc($sql_img);	
			?>
				<li class="product_li">
					<a href="member_product_details.php?pid=<?php echo $product_id;?>">
						<div class="product_details">
							<img src="<?php echo $row_img["image_img"];?>">
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
								
$sql_brand_take = mysqli_query($conn, "select * from brand");
while($row_brand_take = mysqli_fetch_assoc($sql_brand_take))
{
	$brand_id = $row_brand_take['brand_id'];
	$brand_id_name = "A".$brand_id;
		if(isset($_POST[$brand_id_name]))
		{
			$query = mysqli_query($conn, "Select DISTINCT * from product,brand where product_brand_id = brand_id and brand_id = '$brand_id' ");
			$count = mysqli_num_rows($query);
			if($count ==0) 
			{
			?>
				<div class="nine columns">
					<p><?php echo 'There was no Result'; ?></p>
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
						$sql_img = mysqli_query($conn, "select DISTINCT * from image where image_product_id = $product_id and image_trash='0'");
						$row_img = mysqli_fetch_assoc($sql_img);	
					?>
						<li class="product_li">
							<a href="member_product_details.php?pid=<?php echo $product_id;?>">
								<div class="product_details">
									<img src="<?php echo $row_img["image_img"];?>">
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
}

$sql_shape_take = mysqli_query($conn, "select * from shape");
while($row_shape_take = mysqli_fetch_assoc($sql_shape_take))
{
	$shape_id = $row_shape_take['shape_id'];
	$shape_id_name = "B".$shape_id;
		if(isset($_POST[$shape_id_name]))
		{	
			$query = mysqli_query($conn, "Select DISTINCT * from product,shape,brand where 
											product_shape_id = shape_id 
											AND shape_id = '$shape_id'
											AND product_brand_id = brand_id");
			$count = mysqli_num_rows($query);
			if($count ==0) 
			{
			?>
				<div class="nine columns">
					<p><?php echo 'There was no Result'; ?></p>
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
						$sql_img = mysqli_query($conn, "select DISTINCT * from image where image_product_id = $product_id and image_trash='0'");
						$row_img = mysqli_fetch_assoc($sql_img);	
					?>
						<li class="product_li">
							<a href="member_product_details.php?pid=<?php echo $product_id;?>">
								<div class="product_details">
									<img src="<?php echo $row_img["image_img"];?>">
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
}

$sql_colour_take = mysqli_query($conn, "select * from colour");
while($row_colour_take = mysqli_fetch_assoc($sql_colour_take))
{
	$colour_id = $row_colour_take['colour_id'];
	$colour_id_name = "C".$colour_id;
		if(isset($_POST[$colour_id_name]))
		{	
			$query = mysqli_query($conn, "Select DISTINCT * from product,brand,colour,product_lens_colour where 
											colour_id = product_lens_colour_colour_id
											AND product_id = product_lens_colour_product_id
											AND colour_id = $colour_id
											AND product_brand_id = brand_id");
			$count = mysqli_num_rows($query);
			if($count ==0) 
			{
			?>
				<div class="nine columns">
					<p><?php echo 'There was no Result'; ?></p>
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
						$sql_img = mysqli_query($conn, "select DISTINCT * from image where image_product_id = $product_id and image_trash='0'");
						$row_img = mysqli_fetch_assoc($sql_img);	
					?>
						<li class="product_li">
							<a href="member_product_details.php?pid=<?php echo $product_id;?>">
								<div class="product_details">
									<img src="<?php echo $row_img["image_img"];?>">
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
}

$sql_material_take = mysqli_query($conn, "select * from material");
while($row_material_take = mysqli_fetch_assoc($sql_material_take))
{
	$material_id = $row_material_take['material_id'];
	$material_id_name = "D".$material_id;
		if(isset($_POST[$material_id_name]))
		{	
			$query = mysqli_query($conn, "Select DISTINCT * from product,brand,material,product_material where 
											material_id = product_material_material_id
											AND product_id = product_material_product_id
											AND material_id = $material_id
											AND product_brand_id = brand_id");
			$count = mysqli_num_rows($query);
			if($count ==0) 
			{
			?>
				<div class="nine columns">
					<p><?php echo 'There was no Result'; ?></p>
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
						$sql_img = mysqli_query($conn, "select DISTINCT * from image where image_product_id = $product_id and image_trash='0'");
						$row_img = mysqli_fetch_assoc($sql_img);	
					?>
						<li class="product_li">
							<a href="member_product_details.php?pid=<?php echo $product_id;?>">
								<div class="product_details">
									<img src="<?php echo $row_img["image_img"];?>">
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
}

$sql_colour_take = mysqli_query($conn, "select * from colour");
while($row_colour_take = mysqli_fetch_assoc($sql_colour_take))
{
	$colour_id = $row_colour_take['colour_id'];
	$colour_id_name = "E".$colour_id;
		if(isset($_POST[$colour_id_name]))
		{	
			$query = mysqli_query($conn, "Select DISTINCT * from product,brand,colour,product_frame_colour where 
											colour_id = product_frame_colour_colour_id
											AND product_id = product_frame_colour_product_id
											AND colour_id = $colour_id
											AND product_brand_id = brand_id");
			$count = mysqli_num_rows($query);
			if($count == 0) 
			{
			?>
				<div class="nine columns">
					<p><?php echo 'There was no Result'; ?></p>
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
						$sql_img = mysqli_query($conn, "select DISTINCT * from image where image_product_id = $product_id and image_trash='0'");
						$row_img = mysqli_fetch_assoc($sql_img);	
					?>
						<li class="product_li">
							<a href="member_product_details.php?pid=<?php echo $product_id;?>">
								<div class="product_details">
									<img src="<?php echo $row_img["image_img"];?>">
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
}

?>
	</div>
</div>

<?php include 'footer.php'; ?>

