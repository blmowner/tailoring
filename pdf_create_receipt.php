<?php

include("inc/conn.php");
require("fpdf/receipt.php");

$user_id = $_GET['user_id'];


function getTextBetweenTags($tag, $html, $strict=0)
{
    $dom = new domDocument;

    if($strict==1)
    {
        $dom->loadXML($html);
    }
    else
    {
        $dom->loadHTML($html);
    }

    $dom->preserveWhiteSpace = false;

    $content = $dom->getElementsByTagname($tag);

    $out = array();
    foreach ($content as $item)
    {
        $out[] = $item->nodeValue;
    }

    return $out;
}


$varHeader=array("Bil","Tarikh","ID Tempahan","Jenis Pakaian", "Kuantiti","Harga (RM)","Status Pembayaran","Status Tempahan","Status Tenunan");
$varColWidth=array(7,16,18,40,12,18,30,50,40);	  				
/*$varHeader=array("No","Student Name", "Matric No","Thesis Date","Thesis/Project ID","Thesis Type","Thesis/Project Title", "Senate Decision (Please Tick)");
$varColWidth=array(7,45,20,18,22,18,55,45);*/

$varDetail=array();

$varHeader2=array("test");

## SET OF VARIABLES(FOR INGREDIENTS)...
$setOfIngres = array();
$setOfIngres2 = array();
$Ingres = array();

if($user_id == 'admin')
{
	$query_check_payment_status = "SELECT o.o_date,o.o_id,o.o_quantity,o.o_price,
								 o.o_payment_status,o.o_status,o.o_alter_status,
								 g.g_type FROM orders o
								 LEFT JOIN garment g 
								 ON o.g_id = g.g_id
								 WHERE o.o_payment_status = 'accepted'";
}
else
{
	$query_check_payment_status = "SELECT o.o_date,o.o_id,o.o_quantity,o.o_price,
								 o.o_payment_status,o.o_status,o.o_alter_status,
								 g.g_type FROM orders o
								 LEFT JOIN garment g 
								 ON o.g_id = g.g_id
								 WHERE o.o_payment_status = 'accepted'
								 AND o.c_id = '$user_id'";


}


$result = mysql_query($query_check_payment_status);

$no = 0;

$total_array    = array();
$price_array    = array();
$quantity_array = array();

while ($row2 = mysql_fetch_array($result))
{
	
	$date                = $row2['o_date'];
	$id_tempahan         = $row2['o_id'];
	$garment_type        = $row2['g_type'];
	$quantity            = $row2['o_quantity'];
	$price               = $row2['o_price'];
	$payment_status      = $row2['o_payment_status'];     
	$status_tempahan     = $row2['o_status'];
	$alter_status        = $row2['o_alter_status'];
    
    $price_array[$no]    = $price;
    $quantity_array[$no] = $quantity;
    $total_array[$no]    = $price_array[$no] * $quantity_array[$no];

	$no++;
	array_push($setOfIngres, array($no,$date,$id_tempahan,$garment_type,$quantity,$price,$payment_status,$status_tempahan,$alter_status));
}



class PDF extends FPDF
{
	function Header()
	{		
				
	}

	// Page footer
	function Footer()
	{
		$this->SetY(-15);// Position at 1.5 cm from bottom
		$this->SetFont('Arial','I',8);// Arial italic 8
		//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');// Page number
		//$this->Cell(0,10,'MSU',0,0,'C');
		$this->Ln();
		$this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'L');// Page number
	}

}



$pdf=new PDF_MC_Table_sr1("L","mm","letter");
//$pdf=new PDF();

//foreach($varDetail3Tab as $key3 => $value3)
//{
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',5); // Arial bold 15
	/*$pdf->Text(170,10,"Date Printed: ".date("F j, Y, h:i A"));
	$pdf->Text(170,12,"Printed By: ".$_SESSION['user_id']);
	$pdf->Text(170,14,"MSU/NT/012014/V1 - 01"); // Title*/
	$pdf->SetFont('Arial','B',10); // Arial bold 15
	$pdf->Ln(3);
	
	// --- TABLE HEADER (START) ---
	$pdf->SetFont('Arial','',7);
	$varLabelLength=148;
	$varValueLength=60;
	$varSpaceLength=25; //ngam2 size
	//$this->AddPage();
	
	
	$pdf->SetLineWidth(.1);
	$pdf->SetFont('','B',7);
	//$pdf->Ln();	
	$tw=0;
	$pdf->Cell(20,0,'',0,0,'L');///>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	foreach($varHeader as $key=>$value)
	{
		$pdf->SetFillColor(120,240,240);
		$pdf->Cell($varColWidth[$key],4,$value,1,0,'L',1);
		
	}

	
	$pdf->SetFont('','');
	$pdf->Ln(4.7);
	
	// --- TABLE HEADER (FINISH) ---

	
	$pdf->SetWidths($varColWidth);

	srand(microtime()*1000000);
    

	
	foreach($setOfIngres as $key => $value)
	{
		$pdf->Row($value);
	}
    
    $pdf->Ln(0);
    $pdf->Cell(20,0,'',0,0,'L');///>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    foreach($varHeader2 as $key => $value)
	{
		$pdf->SetFont('Arial','B',7);
		$pdf->SetFillColor(200,240,240);
		$pdf->Cell(41,4,'Jumlah Perlu Dibayar (RM) : '.array_sum($total_array),1,0,'L',1);
	}

   
		$pdf->Ln(10);
		$pdf->SetFont('','B');
		$pdf->Cell(20,0,'',0,0,'L');//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		$pdf->Cell(50,4,'Disediakan Untuk : '.$user_id,0,0,'L');
		$pdf->SetFont('','');





/*		$pdf->Ln(10);
		$pdf->SetFont('','B');
		$pdf->Cell(20,0,'',0,0,'L');//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		$pdf->Cell(50,4,'Prepared By: ',0,0,'L');
		$pdf->Cell(50,4,'Verified By: ',0,0,'L');	
		$pdf->Cell(50,4,'Endorsed By: ',0,0,'L');	
		$pdf->SetFont('','');
		
		$pdf->Ln(10);
		$pdf->Cell(20,0,'',0,0,'L');//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		$pdf->Cell(50,4,'.......................................................',0,0,'L');
		$pdf->Cell(50,4,'.......................................................',0,0,'L');
		$pdf->Cell(50,4,'.......................................................',0,0,'L');
		$pdf->Ln();
		$pdf->Cell(20,0,'',0,0,'L');//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		$pdf->Cell(50,4,'Name: ',0,0,'L');
		$pdf->Cell(51,4,'Name:',0,0,'L');
		$pdf->Cell(50,4,'Name: Professor Tan Sri Dato Wira',0,1,'L');
		$pdf->Cell(20,0,'',0,0,'L');//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		$pdf->Cell(50,4,'Staff ID: ',0,0,'L');
		$pdf->Cell(50,4,'Staff ID: ',0,0,'L');
		$pdf->Cell(50,4,' Dr. Mohd Shukri Ab Yajid, President of MSU',0,1,'L');
		$pdf->Cell(20,0,'',0,0,'L');//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		$pdf->Cell(50,4,'Date:',0,0,'L');
		$pdf->Cell(50,4,'Date:',0,0,'L');
		$pdf->Cell(50,4,' Date:',0,0,'L');
		$pdf->SetDisplayMode(50);*/
	/*}
	else
	{
	
	}*/
//}
$pdf->Output();
?>