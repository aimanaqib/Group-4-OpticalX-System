<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>

<title>Add Product</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="add_new_product_wrapper">
	
		<div class="admin_title">
			<p>Add New Product</p>
		</div>
		
		<div class="back_button_adding">
			<a href="admin_view_product.php?page=1">View Product</a>
		</div>
		
		<div class="admin_add_new_prod_small_wrapper">

			<form name="new_product" method="post" action="">
			
			
				
			<div class="admin_add_new_prod_ss_wrapper">
				<div class="admin_add_product_div">Product Name : </div>
				<input type="text" class="admin_add_new_product_input" name="admin_productname" required>
			</div>
			
			<div class="admin_add_new_prod_ss_wrapper">
				<div class="admin_add_product_div">Product Price : </div>
				<input type="number" step="0.01" min="0" class="admin_add_new_product_input" name="admin_productprice" pattern="\d+(,\d{2})?" title="Must contain price format" required>
			</div>	
			
			<div class="admin_add_new_prod_ss_wrapper">
				<div class="admin_add_product_div">Type of Usage : </div>
					<input type="radio" name="admin_producttype" value="Sunglasses" onclick="admin_product_type_sun()" checked required> Sunglasses
					<input type="radio" name="admin_producttype" value="Eyeglasses" onclick="admin_product_type_eye()"> Eyeglasses
					<input type="radio" name="admin_producttype" value="Contact Lenses" onclick="admin_product_type_con()" > Contact Lenses	
			</div>	
			
			<div class="admin_add_new_prod_ss_wrapper">
				<div class="admin_add_product_div">Gender : </div>
				<select class="admin_add_new_product_input" name="admin_productgender" required>
					<option value="" disabled selected>-- Select Gender --</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Unisex">Unisex</option>
				</select>
			<!--
				<input type="radio" name="admin_productgender" value="male" required> Male
					<input type="radio" name="admin_productgender" value="female"> Female
					<input type="radio" name="admin_productgender" value="unisex"> Unisex
			-->
			</div>
		
			
			<div class="admin_add_new_prod_ss_wrapper" id="admin_frame_shape">
				<div class="admin_add_product_div">Frame Shape : </div>
				<select class="admin_add_new_product_input" name="admin_productshape">
					<option value="" disabled selected>-- Select Frame Shape --</option>
					<?php
						$result_shape = mysqli_query($conn, "select * from shape where shape_id >= 2");
						while($row_shape = mysqli_fetch_assoc($result_shape))
						{
					?>
						<option value="<?php echo $row_shape['shape_id']; ?>"><?php echo $row_shape['shape_content'] ?></option>
					<?php
						}
					?>
				</select>
			</div>
				
			<div class="admin_add_new_prod_ss_wrapper">	
				<div class="admin_add_product_div">Brand : </div>
				<select class="admin_add_new_product_input" name="admin_productbrand"  required>
					<option value="" disabled selected>-- Select Product Brand --</option>
					<?php
						$result_brand = mysqli_query($conn, "select * from brand where brand_id >= 2");
						while($row_brand = mysqli_fetch_assoc($result_brand))
						{
					?>
						<option value="<?php echo $row_brand['brand_id']; ?>"><?php echo $row_brand['brand_name'] ?></option>
					<?php
						}
					?>
					
				</select>
			</div>	
			
			<div class="admin_add_new_prod_ss_wrapper">
				<div class="admin_add_product_div">Product Stock : </div>
				<input type="number" min="0" class="admin_add_new_product_input" name="admin_productstock" required>
			</div>	
			
			
			<div class="admin_add_new_prod_ss_wrapper" id="admin_frame">
				<div class="admin_add_product_div">Frame Colour : </div>
					<div class="admin_product_checkbox_wraper">
					<?php
						$result_colour = mysqli_query($conn, "select * from colour where colour_id >= 2 ");
						while($row_colour = mysqli_fetch_assoc($result_colour))
						{
					?>
						<input type="checkbox" name="admin_productframecolor[]" value="<?php echo $row_colour['colour_id']; ?>"><?php echo $row_colour['colour_name'] ?>

					<?php
						}
					?>
					</div>
			</div>
			
			<div class="admin_add_new_prod_ss_wrapper" id="admin_frame_material">
				<div class="admin_add_product_div">Frame Material : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
							$result_material = mysqli_query($conn, "select * from material where material_id >= 2");
							while($row_material = mysqli_fetch_assoc($result_material))
							{
						?>
							<input type="checkbox" name="admin_productmaterial[]" value="<?php echo $row_material['material_id']; ?>"><?php echo $row_material['material_name'] ?>
						<?php
							}
						?>
					</div>
			</div>	
			
			<div class="admin_add_new_prod_ss_wrapper" id="admin_lens_colour">
				<div class="admin_add_product_div">Lens Colour : </div>
					<div class="admin_product_checkbox_wraper">
						<?php
							$result_colour = mysqli_query($conn, "select * from colour where colour_id >= 2");
							while($row_colour = mysqli_fetch_assoc($result_colour))
							{
						?>
							<input type="checkbox" name="admin_productlenscolor[]" value="<?php echo $row_colour['colour_id']; ?>"><?php echo $row_colour['colour_name'] ?>
						<?php
							}
						?>
					</div>
			</div>
			
			
			<div class="admin_add_new_prod_ss_wrapper">
				<div class="admin_add_product_div">Product Top Sales : </div>
					<input type="radio" name="admin_producttop" value="yes" required> Yes
					<input type="radio" name="admin_producttop" value="No"> No
			</div>			
			
			<div class="admin_add_new_prod_ss_wrapper">
				<div class="admin_add_product_div">Product Desciption : </div>
				<textarea cols="60" rows="4" class="admin_add_new_product_input" name="admin_productdescription" required></textarea>
			</div>	

			<div>
				<input type="submit" value="Add Product" class="admin_add_product_submit" name="admin_submit">
			</div>
			
			</form>

		</div>
	</div>
</div>
</body>

<?php

if (isset($_POST["admin_submit"])) 	
{

	$name = $_POST["admin_productname"];    		
	$price = $_POST["admin_productprice"];
	$brand = $_POST["admin_productbrand"];
	$stock = $_POST["admin_productstock"];
	$gender = $_POST["admin_productgender"];
	$description = $_POST["admin_productdescription"];
	$top = $_POST["admin_producttop"];
	$answer = $_POST['admin_producttype'];

	
	
		
		
 if ($answer =="Sunglasses")
	{		
	$shape = $_POST['admin_productshape'];
	
		$result_insert = mysqli_query($conn,"insert into product (product_name,product_price,product_gender,product_type,product_stock,product_top,product_description,product_shape_id,product_brand_id,product_trash)
		values ('$name','$price','$gender','$answer','$stock','$top','$description','$shape','$brand','0')");
		
		$product_id = mysqli_insert_id($conn);
		
		$result_colour_insert = mysqli_query($conn, "select * from colour");
		while($row_lens_colour_insert = mysqli_fetch_assoc($result_colour_insert))
		{
			$lens_colour = $_POST['admin_productlenscolor'];
			foreach ($lens_colour as $betul) 
			{
				$result_lc = $row_lens_colour_insert['colour_id'];
				if($betul == $result_lc )
				{
					mysqli_query($conn,"insert into product_lens_colour (product_lens_colour_product_id,product_lens_colour_colour_id) values ('$product_id','$betul')");
				}
			}
		}
		
		$result_colour_insert2 = mysqli_query($conn, "select * from colour");
		while($row_lens_colour_insert2 = mysqli_fetch_assoc($result_colour_insert2))
		{
			$frame_colour = $_POST['admin_productframecolor'];
			foreach ($frame_colour as $betul) 
			{
				$result_fc = $row_lens_colour_insert2['colour_id'];
				if($betul == $result_fc )
				{
					mysqli_query($conn,"insert into product_frame_colour (product_frame_colour_product_id,product_frame_colour_colour_id) values ('$product_id','$betul')");
				}
			}
		}
		
		$result_material_insert = mysqli_query($conn, "select * from material where material_id >= 2");
		while($row_material_insert = mysqli_fetch_assoc($result_material_insert))
		{
			$material = $_POST['admin_productmaterial'];
			foreach ($material as $betul) 
			{
				$result_pm = $row_material_insert['material_id'];
				if($betul == $result_pm )
				{
					mysqli_query($conn,"insert into product_material (product_material_product_id,product_material_material_id) values ('$product_id','$betul')");
				}
			}
		}
		
		if($result_insert == 1)  
		   {  
			  echo'<script>alert("Product Sunglasses Saved")</script>';  
		   }  
		else  
		   {  
			  echo'<script>alert("Product Sunglasses Failed To Insert")</script>';   
		   }  

	}
 else if ($answer == "Eyeglasses")
	{ 
		$shape = $_POST['admin_productshape'];
	
		$result_insert = mysqli_query($conn,"insert into product (product_name,product_price,product_gender,product_type,product_stock,product_top,product_description,product_shape_id,product_brand_id,product_trash)
		values ('$name','$price','$gender','$answer','$stock','$top','$description','$shape','$brand','0')");
		
		$product_id = mysqli_insert_id($conn);
		
		mysqli_query($conn,"insert into product_lens_colour (product_lens_colour_product_id,product_lens_colour_colour_id) values ('$product_id','1')");


		$result_colour_insert2 = mysqli_query($conn, "select * from colour");
		while($row_lens_colour_insert2 = mysqli_fetch_assoc($result_colour_insert2))
		{
			$frame_colour = $_POST['admin_productframecolor'];
			foreach ($frame_colour as $betul) 
			{
				$result_fc = $row_lens_colour_insert2['colour_id'];
				if($betul == $result_fc )
				{
				mysqli_query($conn,"insert into product_frame_colour (product_frame_colour_product_id,product_frame_colour_colour_id) values ('$product_id','$betul')");
				}
			}
		}
		
		$result_material_insert = mysqli_query($conn, "select * from material where material_id >= 2");
		while($row_material_insert = mysqli_fetch_assoc($result_material_insert))
		{
			$material = $_POST['admin_productmaterial'];	
			foreach ($material as $betul) 
			{
				$result_pm = $row_material_insert['material_id'];
				if($betul == $result_pm )
				{
					mysqli_query($conn,"insert into product_material (product_material_product_id,product_material_material_id) values ('$product_id','$betul')");
				}
			}
		}
		
		if($result_insert == 1)  
		{  
		    echo'<script>alert("Product Eyeglasses Saved")</script>';  
		}  
		else  
		{  
			echo'<script>alert("Product Eyeglasses Failed To Insert")</script>';   
		}  

	}
 else if ($answer == "Contact Lenses")
	{	
		$result_insert = mysqli_query($conn,"insert into product (product_name,product_price,product_gender,product_type,product_stock,product_top,product_description,product_shape_id,product_brand_id,product_trash)
		values ('$name','$price','$gender','$answer','$stock','$top','$description','1','$brand','0')");
		
		$product_id = mysqli_insert_id($conn);
		
		$result_colour_insert = mysqli_query($conn, "select * from colour");
		while($row_lens_colour_insert = mysqli_fetch_assoc($result_colour_insert))
		{
			$lens_colour = $_POST['admin_productlenscolor'];

			foreach ($lens_colour as $betul) 
			{
				$result_lc = $row_lens_colour_insert['colour_id'];
				if($betul == $result_lc )
				{
					mysqli_query($conn,"insert into product_lens_colour (product_lens_colour_product_id,product_lens_colour_colour_id) values ('$product_id','$betul')");
				}
			}
		}
		
		mysqli_query($conn,"insert into product_frame_colour (product_frame_colour_product_id,product_frame_colour_colour_id) values ('$product_id','1')");

		mysqli_query($conn,"insert into product_material (product_material_product_id,product_material_material_id) values ('$product_id','1')");

		if($result_insert == 1)  
		   {  
			  echo'<script>alert("Product Contact Lenses Saved")</script>';  
		   }  
		else  
		   {  
			  echo'<script>alert("Product Contact Lenses Failed To Insert")</script>';   
		   }  
	}
	
	echo "<script>location.href='admin_view_product.php?page=1'</script>";
}
?>

<script>


function admin_product_type_con()
{
	document.getElementById('admin_lens_colour').style.display ='block';	
	document.getElementById('admin_frame').style.display ='none';
	document.getElementById('admin_frame_shape').style.display ='none';	
	document.getElementById('admin_frame_material').style.display ='none';	
}
function admin_product_type_eye()
{

	document.getElementById('admin_frame').style.display ='block';
	document.getElementById('admin_lens_colour').style.display ='none';
	document.getElementById('admin_frame_shape').style.display ='block';	
	document.getElementById('admin_frame_material').style.display ='block';	

}
function admin_product_type_sun()
{

	document.getElementById('admin_lens_colour').style.display ='block';
	document.getElementById('admin_frame').style.display ='block';
	document.getElementById('admin_frame_shape').style.display ='block';	
	document.getElementById('admin_frame_material').style.display ='block';	

}

</script>
