<title>Report</title>
<?php
include("connection.php"); 

if(isset($_POST["btnpdf"]))
{
	
	$year_month = $_POST["year_month_pdf"];
	
	require ('fpdf/fpdf.php');
	
	$product = mysqli_query($conn, "select product_name,product_shopping_cart_quantity,product_shopping_cart_price,EXTRACT(YEAR_MONTH FROM purchase_time)
											from purchase,shopping_cart,product_shopping_cart,product where
											purchase_shopping_cart_id = shopping_cart_id
											AND shopping_cart_id = product_shopping_cart_shopping_cart_id
											AND product_shopping_cart_product_id = product_id
											AND EXTRACT(YEAR_MONTH FROM purchase_time) = '$year_month'");
	$count = mysqli_num_rows($product);
	
	
	$pdf=new FPDF();
	
	$pdf->AddPage();
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(150,10,'Product',1,0,'C');
	$pdf->Cell(21,10,'Quantity',1,0,'C');
	$pdf->Cell(22,10,'Amount',1,1,'C');
	
	$price=0;
	
	if($count == 0)
	{	$pdf->SetFont('Arial','',12);
		$pdf->Cell(193,8,"No Record Found",1,1,'C');
	}
	else
	{
		while($sql = mysqli_fetch_assoc($product))
		{
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(150,8,$sql['product_name'],1,0);
		$pdf->Cell(21,8,$sql['product_shopping_cart_quantity'],1,0,'C');
		$pdf->Cell(22,8,"RM " .$sql['product_shopping_cart_price'],1,1);
		$price += $sql['product_shopping_cart_price'];
		}
		
		$pdf->Cell(150);
		
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(21,10,'Grandtotal',1,0,'C');
		$pdf->Cell(22,10,"RM " .number_format($price,2),1,1,'C');
	}
	
	ob_end_clean();
	$pdf->Output();
}	

?>