<?php
$con = null;
require ('../pdflib/fpdf.php');
require '../DB_Connect.php';


if(isset($_GET['daily'])){
    $time = '1 day';
}
elseif(isset($_GET['weekly'])){
    $time = '1 week';
}
elseif(isset($_GET['monthly'])){
    $time = '1 month';
}
elseif(isset($_GET['quarterly'])){
    $time = '1 quarter';
}
elseif(isset($_GET['annually'])){

    $time = '1 year';
}

    $type = $_GET['type'];

$pdfquery = 'Select * from `medreport` where `type` = "'.$type.'" and `dateadded` > NOW()- interval '.$time.' ';

$record = mysqli_query($con,$pdfquery);

class PDF extends FPDF{
    function Header()
    {
        $this->Image('../../img/HIS logo blue.png',10,6,30);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Sto. Rosario Rural Health Center');
        $this->Ln(20);
    }
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

}

$pdf = new FPDF('p');
$pdf->AliasNbPages();
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
