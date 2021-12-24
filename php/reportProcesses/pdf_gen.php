<?php
$con = null;
require ('../pdflib/fpdf.php');
require ('../DB_Connect.php');


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
        $this->Image('HIS logo blue.png',10,6,50);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,15,'Sto. Rosario Rural Health Center');
        $this->Ln(37);
    }


}

$pdf = new PDF('p');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Text(10,40,"Medicine Reports (".$type.")");
$pdf->Cell(35,10,"Medicine ID",0,0,'C');
$pdf->Cell(50,10,"Medicine Name",0,0,'C');
$pdf->Cell(0,10,"Medicine Description",0,1,'C');


$pdf->SetFont('Arial','',14);
while($row = mysqli_fetch_assoc($record)){
    $pdf->Cell(35,10,$row['id'],"T",0,'C');
    $pdf->Cell(50,10,$row['name']." (".$row['dosage'].")","T",0,'C');
    $pdf->MultiCell(0,10,"Category: ".$row['category']."Stocks: ".$row['stock'] ." Date: " .$row['mfgdate'] ."-". $row['expdate'],"T",'C');



}

$pdf->Output('D','Report.pdf');
