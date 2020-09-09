<title>Report</title>
<?php
include("connection.php"); 

if(isset($_POST["btnpdf"]))
{
	echo "succesful";
	require ('fpdf/fpdf.php');
	
	$purchase_id = $_REQUEST["purchaseid"];

	$product = mysqli_query($conn, "select * from purchase,shopping_cart,member 
									where purchase_shopping_cart_id = shopping_cart_id 
									AND shopping_cart_member_id = member_id
									AND purchase_id = $purchase_id");
	
	$pdf=new FPDF();
	
	$pdf->AddPage();
	
	while($sql = mysqli_fetch_assoc($product))
	{	$pdf->SetFont("","","10");
		$pdf->Cell(40,20,"Order ID ");
		$pdf->Cell(30,20," : ".$purchase_id);
		$pdf->Ln(6);
		$pdf->Cell(40,20,"Order Date And Time : ");
		$pdf->Cell(30,20," : ".$sql['purchase_time']);
		$pdf->Ln(6);
		$pdf->Cell(40,20,"Customer ID : ");
		$pdf->Cell(30,20," : ".$sql['member_id']);
		$pdf->Ln(6);
		$pdf->Cell(40,20,"Delivery Name : ");
		$pdf->Cell(30,20," : ".$sql['purchase_ship_name']);
		$pdf->Ln(6);
		$pdf->Cell(40,20,"Delivery Phone : ");
		$pdf->Cell(30,20," : ".$sql['purchase_phone']);
		$pdf->Ln(6);
		$pdf->Cell(40,20,"Delivery Address : ");
		$pdf->Cell(30,20," : ".$sql['purchase_address']." ".$sql['purchase_postcode']." ".$sql['purchase_city']." ".$sql['purchase_state']);
		$pdf->Ln(6);
		$pdf->Cell(40,20,"Total Payment : ");
		$pdf->Cell(30,20," : ".$sql['purchase_total']);
		$pdf->Ln(6);
		$pdf->Cell(40,20,"Status : ");
		$pdf->Cell(30,20," : ".$sql['purchase_status']);
		$pdf->Ln(30);
		
		
	}
	
	$product_new = mysqli_query($conn, "select * from purchase,shopping_cart,product_shopping_cart,product where
											purchase_shopping_cart_id = shopping_cart_id
											AND shopping_cart_id = product_shopping_cart_shopping_cart_id
											AND product_shopping_cart_product_id = product_id
											AND purchase_id = $purchase_id");
	$pdf->Ln(5);								
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(140,15,'Product Name',1,0,'C');
	$pdf->Cell(20,15,'Quantity',1,0,'C');
	$pdf->Cell(30,15,'Product Price',1,1,'C');
	
	$total =0;
	while($sql_new = mysqli_fetch_assoc($product_new))
	{	$pdf->SetFont('','',12);
		$pdf->Cell(140,10,$sql_new['product_name'],1,0);
		$pdf->Cell(20,10,$sql_new['product_shopping_cart_quantity'],1,0,'C');
		$pdf->Cell(30,10,"RM ".$sql_new['product_price'],1,1,'C');
		$total += $sql_new['product_price'];
	}
	
	$pdf->Cell(140);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,10,'Total',1,0,'C');
	$pdf->Cell(30,10,"RM " .number_format($total,2),1,1,'C');
	ob_end_clean();
	$pdf->Output();
}	

?>