<?php 
 
include("connection.php"); 

if ($_SESSION["loggedin"] != 1)
	header("Location: admin_login.php");
?>
<title>View Product Detail</title>
<?php include 'side_menu_admin.php';?>

<div class="admin_all_wrapper">
	<div class="admin_view_product_details_wrapper">

		<div class="admin_title">
			<p>Product Detail</p>
		</div>
		
		<a href="admin_view_product.php?page=1" class="back_button_view_product">
			<input type="button" value="View All Product">
		</a>
		
		<div class="admin_view_product_details_small_wrapper">

			<?php

			$pid = $_REQUEST["pid"];

			$result = mysqli_query($conn, "select * from product where product_id = $pid");
			$sql_sun = mysqli_query($conn, "select * from product where product_id = $pid and product_type = 'Sunglasses'");
			$sql_eye = mysqli_query($conn,"select * from product where product_id = $pid and product_type = 'Eyeglasses'"); 
			$sql_con = mysqli_query($conn,"select * from product where product_id = $pid and product_type = 'Contact Lenses'"); 
			
			$sql_img = mysqli_query($conn, "select * from image where image_product_id = $pid ");
			$sql_brand = mysqli_query($conn, "select * from product,brand where product_id = $pid and product_brand_id = brand_id");
			$sql_frame_colour = mysqli_query($conn, "select * from product_frame_colour,product,colour where product_frame_colour_product_id = $pid and product_frame_colour_colour_id = colour_id  and product_frame_colour_product_id = product_id");
			$sql_lens_colour = mysqli_query($conn, "select * from product_lens_colour,product,colour where product_lens_colour_product_id = $pid and product_lens_colour_colour_id = colour_id  and product_lens_colour_product_id = product_id");
			$sql_shape = mysqli_query($conn, "select * from product,shape where product_id = $pid and product_shape_id = shape_id");
			$sql_material = mysqli_query($conn, "select * from product_material,product,material where product_material_product_id = $pid and product_material_material_id = material_id  and product_material_product_id = product_id");

			$row = mysqli_fetch_assoc($result);
			$row_sun =mysqli_num_rows($sql_sun);
			$row_eye =mysqli_num_rows($sql_eye);
			$row_con =mysqli_num_rows($sql_con);
			
			$row_img = mysqli_fetch_assoc($sql_img);
			$row_brand = mysqli_fetch_assoc($sql_brand);
			//$row_frame_colour = mysqli_fetch_assoc($sql_frame_colour);
			//$row_lens_colour = mysqli_fetch_assoc($sql_lens_colour);
			$row_shape = mysqli_fetch_assoc($sql_shape);
			//$row_material = mysqli_fetch_assoc($sql_material);

		
			//print_r($row2);
			//print_r($row3);
			//print_r($row4);
			
			if ($row_sun == '1')
			{
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product ID 	</div>   <div class='admin_view_prod_info'>:    ".$row["product_id"];  ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product images </div>   <div class='admin_view_prod_info'><span>:</span>   "?><img src="<?php echo "../".$row_img["image_img"];?>"> </div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product name	</div>   <div class='admin_view_prod_info'>:   ".$row["product_name"];  ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product price  </div>   <div class='admin_view_prod_info'>:   RM".number_format($row["product_price"],2); ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Gender         </div>   <div class='admin_view_prod_info'>:   ".$row["product_gender"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Type of Usage  </div> <div class='admin_view_prod_info'>:   ".$row["product_type"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product shape  </div>  <div class='admin_view_prod_info'>:   ".$row_shape["shape_content"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product brand  </div>  <div class='admin_view_prod_info'>:   ".$row_brand["brand_name"]; ?></div></div><?php
			
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product material </div>   <div class='admin_view_prod_info'>:   ";
			while($row_material = mysqli_fetch_assoc($sql_material))
			{ echo $row_material["material_name"]. " , ";
			}
			?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Frame color       </div>   <div class='admin_view_prod_info'>:   ";
			while($row_frame_colour = mysqli_fetch_assoc($sql_frame_colour))
			{ echo $row_frame_colour["colour_name"]. " , ";
			} 
			?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Lens color       </div>   <div class='admin_view_prod_info'>:   ";
			while($row_lens_colour = mysqli_fetch_assoc($sql_lens_colour))
			{ echo $row_lens_colour["colour_name"]. " , ";
			}
			?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Stock    </div>   <div class='admin_view_prod_info'>:  ".$row["product_stock"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Top Sales    </div>   <div class='admin_view_prod_info'>:   ".$row["product_top"];?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Description    </div>   <div class='admin_view_prod_info'>:   ".$row["product_description"];?></div></div><?php
			}
			
			else if ($row_eye == '1')
			{
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product ID 	</div>   <div class='admin_view_prod_info'>:    ".$row["product_id"];  ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product images </div>   <div class='admin_view_prod_info'><span>:</span>   "?><img src="<?php echo "../".$row_img["image_img"];?>"> </div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product name	</div>   <div class='admin_view_prod_info'>:   ".$row["product_name"];  ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product price  </div>   <div class='admin_view_prod_info'>:   RM".number_format($row["product_price"],2); ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Gender         </div>   <div class='admin_view_prod_info'>:   ".$row["product_gender"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Type of Usage  </div> <div class='admin_view_prod_info'>:   ".$row["product_type"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product shape  </div>  <div class='admin_view_prod_info'>:   ".$row_shape["shape_content"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product brand  </div>  <div class='admin_view_prod_info'>:   ".$row_brand["brand_name"]; ?></div></div><?php
			
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product material </div>   <div class='admin_view_prod_info'>:   ";
			while($row_material = mysqli_fetch_assoc($sql_material))
			{ echo $row_material["material_name"]. " , ";
			}
			?></div></div><?php
			
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Frame color       </div>   <div class='admin_view_prod_info'>:   ";
			while($row_frame_colour = mysqli_fetch_assoc($sql_frame_colour))
			{ echo $row_frame_colour["colour_name"]. " , ";
			} 
			?></div></div><?php
			
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Stock    </div>   <div class='admin_view_prod_info'>:  ".$row["product_stock"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Top Sales    </div>   <div class='admin_view_prod_info'>:   ".$row["product_top"];?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Description    </div>   <div class='admin_view_prod_info'>:   ".$row["product_description"];?></div></div><?php
			}
			
			else if ($row_con == '1')
			{
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product ID 	</div>   <div class='admin_view_prod_info'>:    ".$row["product_id"];  ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product images </div>   <div class='admin_view_prod_info'><span>:</span>   "?><img src="<?php echo "../".$row_img["image_img"];?>"> </div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product name	</div>   <div class='admin_view_prod_info'>:   ".$row["product_name"];  ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product price  </div>   <div class='admin_view_prod_info'>:   RM".number_format($row["product_price"],2); ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Gender         </div>   <div class='admin_view_prod_info'>:   ".$row["product_gender"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Type of Usage  </div> <div class='admin_view_prod_info'>:   ".$row["product_type"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product brand  </div>  <div class='admin_view_prod_info'>:   ".$row_brand["brand_name"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Lens color       </div>   <div class='admin_view_prod_info'>:   ";
			while($row_lens_colour = mysqli_fetch_assoc($sql_lens_colour))
			{ echo $row_lens_colour["colour_name"]. " , ";
			}
			?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Stock    </div>   <div class='admin_view_prod_info'>:  ".$row["product_stock"]; ?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Top Sales    </div>   <div class='admin_view_prod_info'>:   ".$row["product_top"];?></div></div><?php
			echo "<div class='admin_view_prod_detail'> <div class='admin_view_prod_title'>Product Description    </div>   <div class='admin_view_prod_info'>:   ".$row["product_description"];?></div></div><?php
			}
			?>
			<div class="admin_view_product_edit"><a href = "admin_update_product_detail.php?pid=<?php echo $row['product_id']; ?>">Edit Product</a></div>

		</div>
	</div>
</div>

