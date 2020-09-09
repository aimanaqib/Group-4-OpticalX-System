<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
   
$pid = $_REQUEST["pid"];

$result_sunglasses = mysqli_query($conn,"select * from product,shape,material,product_material,colour,product_frame_colour,product_lens_colour where 
									product_id = product_material_product_id
								AND product_shape_id = shape_id
								AND material_id = product_material_material_id
								AND colour_id = product_frame_colour_colour_id
								AND product_id = product_frame_colour_product_id
								AND colour_id = product_lens_colour_colour_id
								AND product_id = product_lens_colour_product_id
								AND product_id = $pid");
								
$row_sunglasses = mysqli_fetch_assoc($result_sunglasses);


$result_eyesglasses = mysqli_query($conn,"select * from product,shape,material,product_material,colour,product_frame_colour where 
									product_id = product_material_product_id
								AND product_shape_id = shape_id
								AND material_id = product_material_material_id
								AND colour_id = product_frame_colour_colour_id
								AND product_id = product_frame_colour_product_id
								AND product_id = $pid");
								
$row_eyesglasses = mysqli_fetch_array($result_eyesglasses);
	

$result_contact_lenses = mysqli_query($conn,"select * from product,colour,product_lens_colour where 
								    colour_id = product_lens_colour_colour_id
								AND product_id = product_lens_colour_product_id
								AND product_id = $pid");
								
				

$result_biasa = mysqli_query($conn,"select * from product,brand,image where
									product_brand_id = brand_id
								AND image_product_id = product_id
								AND product_id = $pid");
								
$row_biasa = mysqli_fetch_assoc($result_biasa);
?>
<title>Update Product Detail</title>
<?php include 'side_menu_admin.php'; ?>

<div class="admin_all_wrapper">
	<div class="add_edit_product_wrapper">

		<div class="admin_title">
			<p>Update Product</p>
		</div>

		<div class="admin_edit_product_small_wrapper">

			<form name="edit_product" method="post" action="" enctype="multipart/form-data">
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Product Images : </div> 
				<img src="<?php echo "../".$row_biasa['image_img'];?>" class="admin_edit_prod_title_img">
			</div>

			<div class="admin_edit_product_ss_wrapper">	
				<div class="admin_edit_prod_title">Product Name : </div> 
				<input type="text" class="admin_edit_prod_input" name="admin_productname" value="<?php echo $row_biasa['product_name'];?>" required>
			</div>

			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Product Brand : </div> 
				<select class="admin_edit_prod_input" name="admin_productbrand" required>
					<option value="" disabled selected>-- Select Product Brand --</option>
					<?php
						$brand = mysqli_query($conn, "select * from brand where brand_id >= 2");
						while($row_brand = mysqli_fetch_assoc($brand))
						{
					?>
						<option value="<?php echo $row_brand['brand_id']; ?>"<?php if($row_brand["brand_id"] == $row_biasa["product_brand_id"]) echo "selected" ?>><?php echo $row_brand['brand_name'] ?></option>
					<?php
						}
					?>
				</select>
			</div>	

			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Product Price : </div>
				<input type="number" step="0.01" min="0" class="admin_edit_prod_input" name="admin_productprice" pattern="\d+(,\d{2})?" title="Must contain price format" value="<?php echo $row_biasa['product_price'];?>" required>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Type of Usage : </div>
				<input type="radio" name="admin_producttype" value="Sunglasses"<?php if($row_biasa["product_type"] == "Sunglasses") echo "checked";?>> Sunglasses
				<input type="radio" name="admin_producttype" value="Eyeglasses"<?php if($row_biasa["product_type"] == "Eyeglasses") echo "checked";?>> Eyeglasses
				<input type="radio" name="admin_producttype" value="Contact Lenses"<?php if($row_biasa["product_type"] == "Contact Lenses") echo "checked";?>> Contact Lenses	
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Gender : </div> 
				<select class="admin_edit_prod_input" name="admin_productgender" required>
					<option value="" disabled selected>-- Select Gender --</option>
					<option value="Male"<?php if($row_biasa["product_gender"] == "Male") echo "selected";?>>Male</option>
					<option value="Female"<?php if($row_biasa["product_gender"] == "Female") echo "selected";?>>Female</option>
					<option value="Unisex"<?php if($row_biasa["product_gender"] == "Unisex") echo "selected";?>>Unisex</option>
				</select>
			</div>
			
			<?php if($row_biasa["product_type"] == "Sunglasses")
			{
			?>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Frame Shape : </div> 
				<select class="admin_edit_prod_input" name="admin_productshape" >
					<option value="" disabled selected>-- Select Frame Shape --</option>
					<?php
						$shape = mysqli_query($conn, "select * from shape where shape_id >= 2 ");
						while($row_shape = mysqli_fetch_assoc($shape))
						{
					?>
						<option value="<?php echo $row_shape['shape_id']; ?>"<?php if($row_shape["shape_id"] == $row_biasa["product_shape_id"] ) echo "selected" ?>><?php echo $row_shape['shape_content'] ?></option>
					<?php
						}
					?>
				</select>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Current Frame Material : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
						$sql_material_from_db_sg = mysqli_query($conn,"SELECT *
														FROM product_material
														right JOIN material ON material_id = product_material_material_id
														INNER JOIN product ON product_material_product_id = product_id
														where product_id = $pid");
							while($row_material_from_db_sg = mysqli_fetch_assoc($sql_material_from_db_sg))
							{
									
							?>
							<input type="checkbox" name="" value="<?php echo $row_material_from_db_sg['material_id']; ?>" <?php if($row_material_from_db_sg["material_id"] == $row_material_from_db_sg["product_material_material_id"]) echo "checked" ?> disabled="disabled" ><?php echo $row_material_from_db_sg['material_name'] ?>
							<?php
							}
						?>							
					</div>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Latest Frame Material : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
							$material = mysqli_query($conn, "select * from material where material_id >= 2");
							while($row_material = mysqli_fetch_assoc($material))
							{
								?>
								<input type="checkbox" name="admin_productmaterial[]" value="<?php echo $row_material['material_id']; ?>"><?php echo $row_material['material_name'] ?>
								<?php
							}
						?>
					</div>
			</div>	
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Current Lens Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
						$sql_colour_from_db_sg = mysqli_query($conn,"SELECT *
														FROM product_lens_colour
														right JOIN colour ON colour_id = product_lens_colour_colour_id
														INNER JOIN product ON product_lens_colour_product_id = product_id
														where product_id = $pid");
							while($row_colour_from_db_sg = mysqli_fetch_assoc($sql_colour_from_db_sg))
							{
									
							?>
							<input type="checkbox" name="" value="<?php echo $row_colour_from_db_sg['colour_id']; ?>" <?php if($row_colour_from_db_sg["colour_id"] == $row_colour_from_db_sg["product_lens_colour_colour_id"]) echo "checked" ?> disabled="disabled" ><?php echo $row_colour_from_db_sg['colour_name'] ?>
							<?php
							}
						?>							
					</div>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Latest Lens Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
							$colour = mysqli_query($conn, "select * from colour where colour_id >= 2");
							while($row_colour = mysqli_fetch_assoc($colour))
							{
						?>
							<input type="checkbox" name="admin_productlenscolor[]" value="<?php echo $row_colour['colour_id']; ?>"><?php echo $row_colour['colour_name'] ?>
						<?php
							}
						?>
					</div>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Current Frame Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
						$sql_colour_from_db_sg = mysqli_query($conn,"SELECT *
														FROM product_frame_colour
														right JOIN colour ON colour_id = product_frame_colour_colour_id
														INNER JOIN product ON product_frame_colour_product_id = product_id
														where product_id = $pid");
							while($row_colour_from_db_sg = mysqli_fetch_assoc($sql_colour_from_db_sg))
							{
									
							?>
							<input type="checkbox" name="" value="<?php echo $row_colour_from_db_sg['colour_id']; ?>" <?php if($row_colour_from_db_sg["colour_id"] == $row_colour_from_db_sg["product_frame_colour_colour_id"]) echo "checked" ?> disabled="disabled" ><?php echo $row_colour_from_db_sg['colour_name'] ?>
							<?php
							}
						?>							
					</div>
			</div>
			
			<div class="admin_edit_product_ss_wrapper" id="admin_frame">
				<div class="admin_edit_prod_title">Latest Frame Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
							$colour = mysqli_query($conn, "select * from colour where colour_id >= 2 ");
							while($row_colour = mysqli_fetch_assoc($colour))
							{
						?>
							<input type="checkbox" name="admin_productframecolor[]" value="<?php echo $row_colour['colour_id']; ?>"<?php if($row_colour["colour_id"] == $row_sunglasses["product_frame_colour_colour_id"]) echo "checked" ?>><?php echo $row_colour['colour_name'] ?>

						<?php
							}
						?>
					</div>
			</div>
					
			<?php
			}
			else if ($row_biasa["product_type"] == "Eyeglasses")
			{
			?>
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Frame Shape : </div>
				<select class="admin_edit_prod_input" name="admin_productshape" >
					<option value="" disabled selected>-- Select Frame Shape --</option>
					<?php
						$shape = mysqli_query($conn, "select * from shape where shape_id >= 2 ");
						while($row_shape = mysqli_fetch_assoc($shape))
						{
					?>
						<option value="<?php echo $row_shape['shape_id']; ?>"<?php if($row_shape["shape_id"] == $row_biasa["product_shape_id"] ) echo "selected" ?>><?php echo $row_shape['shape_content'] ?></option>
					<?php
						}
					?>
				</select>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Current Frame Material : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
						$sql_material_from_db_fc = mysqli_query($conn,"SELECT *
														FROM product_material
														right JOIN material ON material_id = product_material_material_id
														INNER JOIN product ON product_material_product_id = product_id
														where product_id = $pid");
							while($row_material_from_db_fc = mysqli_fetch_assoc($sql_material_from_db_fc))
							{
									
							?>
							<input type="checkbox" name="" value="<?php echo $row_material_from_db_fc['material_id']; ?>" <?php if($row_material_from_db_fc["material_id"] == $row_material_from_db_fc["product_material_material_id"]) echo "checked" ?> disabled="disabled" ><?php echo $row_material_from_db_fc['material_name'] ?>
							<?php
							}
						?>							
					</div>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Lastest Frame Material : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
							$material = mysqli_query($conn, "select * from material where material_id>=2");
							while($row_material = mysqli_fetch_assoc($material))
							{
						?>
							<input type="checkbox" name="admin_productmaterial[]" value="<?php echo $row_material['material_id']; ?>"><?php echo $row_material['material_name'] ?>
						<?php
							}
						?>
					</div>
			</div>	
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Current Frame Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
						$sql_colour_from_db_fc = mysqli_query($conn,"SELECT *
														FROM product_frame_colour
														right JOIN colour ON colour_id = product_frame_colour_colour_id
														INNER JOIN product ON product_frame_colour_product_id = product_id
														where product_id = $pid");
							while($row_colour_from_db_fc = mysqli_fetch_assoc($sql_colour_from_db_fc))
							{
									
							?>
							<input type="checkbox" name="" value="<?php echo $row_colour_from_db_fc['colour_id']; ?>" <?php if($row_colour_from_db_fc["colour_id"] == $row_colour_from_db_fc["product_frame_colour_colour_id"]) echo "checked" ?> disabled="disabled" ><?php echo $row_colour_from_db_fc['colour_name'] ?>
							<?php
							}
						?>							
					</div>
			</div>
			
			<div class="admin_edit_product_ss_wrapper" id="admin_frame">
				<div class="admin_edit_prod_title">Latest Frame Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
							$colour = mysqli_query($conn, "select * from colour where colour_id >= 2 ");
							while($row_colour = mysqli_fetch_assoc($colour))
							{
						?>
							<input type="checkbox" name="admin_productframecolor[]" value="<?php echo $row_colour['colour_id']; ?>"><?php echo $row_colour['colour_name'] ?>

						<?php
							}
						?>
					</div>
			</div>

			<?php
			}
			else if ($row_biasa["product_type"] == "Contact Lenses")
			{
			?>
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Current Lens Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
						$sql_colour_from_db_cl = mysqli_query($conn,"SELECT *
														FROM product_lens_colour
														right JOIN colour ON colour_id = product_lens_colour_colour_id
														INNER JOIN product ON product_lens_colour_product_id = product_id
														where product_id = $pid");
							while($row_colour_from_db_cl = mysqli_fetch_assoc($sql_colour_from_db_cl))
							{
									
							?>
							<input type="checkbox" name="" value="<?php echo $row_colour_from_db_cl['colour_id']; ?>" <?php if($row_colour_from_db_cl["colour_id"] == $row_colour_from_db_cl["product_lens_colour_colour_id"]) echo "checked" ?> disabled="disabled" ><?php echo $row_colour_from_db_cl['colour_name'] ?>
							<?php
							}
						?>							
					</div>
			</div>
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Latest Lens Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
						
													
							$colour = mysqli_query($conn, "select * from colour where colour_id >= 2");
							
							$row_contact_lenses = mysqli_fetch_assoc($result_contact_lenses);
							
							while($row_colour = mysqli_fetch_assoc($colour))
							{
									
						?>
								<input type="checkbox" name="admin_productlenscolor[]" value="<?php echo $row_colour['colour_id']; ?>"><?php echo $row_colour['colour_name'] ?>
						<?php
							}
						?>
					</div>
			</div>
			<?php
			}
			?>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Product Stock : </div> 
				<input type="number" min="0" class="admin_edit_prod_input" name="admin_productstock" value="<?php echo $row_biasa['product_stock'];?>" required>
			</div>
			
			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Product Top Sales : </div> 
					<input type="radio" name="admin_producttop" value="yes" <?php if($row_biasa["product_top"] = "yes") echo "checked";?> > Yes
					<input type="radio" name="admin_producttop" value="no" <?php if($row_biasa["product_top"] = "no") echo "checked";?>> No
			</div>

			<div class="admin_edit_product_ss_wrapper">
				<div class="admin_edit_prod_title">Product Desciption : </div> 
				<textarea cols="60" rows="4" class="admin_edit_prod_input" name="admin_productdescription"><?php echo $row_biasa['product_description'];?></textarea>
			</div>
			
				<p><input type="submit" value="Update" class="admin_edit_product_submit" name="update_product"></p>
			</form>
			
	</div>
</div>
</body>

<?php

if (isset($_POST["update_product"]))
{	
	$name = $_POST["admin_productname"];    		
	$price = $_POST["admin_productprice"];
	$gender = $_POST["admin_productgender"];
	$type = $_POST["admin_producttype"];
	$brand = $_POST["admin_productbrand"];
	$stock = $_POST["admin_productstock"];
	$top = $_POST["admin_producttop"];
	$description = $_POST["admin_productdescription"];
	
	mysqli_query($conn," update product set 
						product_name='$name', 
						product_price= $price, 
						product_gender= '$gender',
						product_type= '$type',
						product_brand_id= $brand,
						product_stock= $stock,
						product_top= '$top',
						product_description = '$description'
						where product_id = $pid");		
						
						
						 			
			
	if ($type == "Sunglasses")
		{
			$shape = $_POST["admin_productshape"];
			
			mysqli_query($conn," update product set 
								product_shape_id = $shape
								where product_id = $pid");

			
			
			
			
			if( $_POST["admin_productlenscolor"] != '' )
			{
				mysqli_query($conn, "delete from product_lens_colour where product_lens_colour_product_id = $pid");
				$result_colour_insert = mysqli_query($conn, "select * from colour");
				while($row_lens_colour_insert = mysqli_fetch_assoc($result_colour_insert))
				{
					$lens_colour = $_POST["admin_productlenscolor"];
					foreach ($lens_colour as $betul) 
					{
						$result_lc = $row_lens_colour_insert['colour_id'];
						if($betul == $result_lc )
						{
							mysqli_query($conn,"insert into product_lens_colour (product_lens_colour_product_id,product_lens_colour_colour_id) values ('$pid','$betul')");
						}
					}
				}
			}
			else
			{
				
			}
			
			if( $_POST["admin_productframecolor"] != '' )
			{
				mysqli_query($conn, "delete from product_frame_colour where product_frame_colour_product_id = $pid");
				$result_colour_insert2 = mysqli_query($conn, "select * from colour");
				while($row_lens_colour_insert2 = mysqli_fetch_assoc($result_colour_insert2))
				{
					$frame_colour = $_POST["admin_productframecolor"];
					foreach ($frame_colour as $betul) 
					{
						$result_fc = $row_lens_colour_insert2['colour_id'];
						if($betul == $result_fc )
						{
							mysqli_query($conn,"insert into product_frame_colour (product_frame_colour_product_id,product_frame_colour_colour_id) values ('$pid','$betul')");
						}
					}
				}
			}
			else
			{
				
			}
			
			if( $_POST["admin_productmaterial"] != '' )
			{
				mysqli_query($conn, "delete from product_material where product_material_product_id = $pid");
				$result_material_insert = mysqli_query($conn, "select * from material where material_id >= 2");
				while($row_material_insert = mysqli_fetch_assoc($result_material_insert))
				{
					$material = $_POST["admin_productmaterial"];
					foreach ($material as $betul) 
					{
						$result_pm = $row_material_insert['material_id'];
						if($betul == $result_pm )
						{
							mysqli_query($conn,"insert into product_material (product_material_product_id,product_material_material_id) values ('$pid','$betul')");
						}
					}
				}
			}
			else
			{
				
			}
			
		}
	else if ($type == "Eyeglasses")
		{
			$shape = $_POST["admin_productshape"];

			mysqli_query($conn," update product set 
								product_shape_id = $shape
								where product_id = $pid");
								
			if( $_POST["admin_productframecolor"] != '' )
			{
				mysqli_query($conn, "delete from product_frame_colour where product_frame_colour_product_id = $pid");
				$result_colour_insert2 = mysqli_query($conn, "select * from colour");
				while($row_lens_colour_insert2 = mysqli_fetch_assoc($result_colour_insert2))
				{
					$frame_colour = $_POST["admin_productframecolor"];
					foreach ($frame_colour as $betul) 
					{
						$result_fc = $row_lens_colour_insert2['colour_id'];
						if($betul == $result_fc )
						{
							mysqli_query($conn,"insert into product_frame_colour (product_frame_colour_product_id,product_frame_colour_colour_id) values ('$pid','$betul')");
				
						}
					}
				}
			}
			else
			{
				
			}
			
			if( $_POST["admin_productmaterial"] != '' )
			{
				mysqli_query($conn, "delete from product_material where product_material_product_id = $pid");
				$result_material_insert = mysqli_query($conn, "select * from material where material_id >= 2");
				while($row_material_insert = mysqli_fetch_assoc($result_material_insert))
				{
					$material = $_POST["admin_productmaterial"];
					foreach ($material as $betul) 
					{
						$result_pm = $row_material_insert['material_id'];
						if($betul == $result_pm )
						{
							mysqli_query($conn,"insert into product_material (product_material_product_id,product_material_material_id) values ('$pid','$betul')");
						}
					}
				}
			}
			else
			{
				
			}
		}
	else if ($type == "Contact Lenses")
		{
			if( $_POST["admin_productlenscolor"] != '' )
			{
			mysqli_query($conn, "delete from product_lens_colour where product_lens_colour_product_id = $pid");
			
				$result_colour_insert = mysqli_query($conn, "select * from colour");
				while($row_lens_colour_insert = mysqli_fetch_assoc($result_colour_insert))
				{
					$lens_colour = $_POST["admin_productlenscolor"];
					foreach ($lens_colour as $betul) 
					{	
						$result_lc = $row_lens_colour_insert['colour_id'];
						if($betul == $result_lc )
						{
							mysqli_query($conn,"insert into product_lens_colour (product_lens_colour_product_id,product_lens_colour_colour_id) values ('$pid','$betul')");
							print_r("insert into product_lens_colour (product_lens_colour_product_id,product_lens_colour_colour_id) values ('$pid','$betul')");
						}
					}
				}
			}
			else
			{
				
			}
			
		}




			echo '<script language="javascript">';
			echo 'alert("Product Updated")';
			echo '</script>';
			$link="admin_view_product_detail.php?pid=".$row_biasa["product_id"];
			echo "<script>location.href='$link'</script>";
	
		
	?>
<?php
}
?>
