<?php
$con = null;
require_once '../pdflib/fpdf.php';
require '../DB_Connect.php';



$pdfquery = 'Select * from `medreport`';

$record = mysqli_query($con,$pdfquery);

$pdf = new FPDF('l','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Cell(35,10,"Medicine ID",1,0,'C');
$pdf->Cell(50,10,"Medicine Name",1,0,'C');
$pdf->Cell(50,10,"Medicine Category",1,0,'C');
$pdf->Cell(50,10,"Medicine Stocks",1,0,'C');
$pdf->Cell(50,10,"Medicine MFG-Date",1,0,'C');
$pdf->Cell(50,10,"Medicine Exp-Date",1,1,'C');


$pdf->SetFont('Arial','',14);
while($row = mysqli_fetch_assoc($record)){
    $pdf->Cell(35,10,$row['id'],1,0,'C');
    $pdf->Cell(50,10,$row['name'],1,0,'C');
    $pdf->Cell(50,10,$row['category'],1,0,'C');
    $pdf->Cell(50,10,$row['stock'],1,0,'C');
    $pdf->Cell(50,10,$row['mfgdate'],1,0,'C');
    $pdf->Cell(50,10,$row['expdate'],1,1,'C');

}

$pdf->Output('D','Report.pdf');
