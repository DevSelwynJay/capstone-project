<?php
$con = null;
require ('../pdflib/fpdf.php');
require ('../DB_Connect.php');

$type = $_GET['type'];
if(isset($_GET['daily'])){
    $time = '1 day';
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and DATE_FORMAT(`dateadded`,"%Y %M %d") = DATE_FORMAT(NOW(),"%Y %M %d") ';
}
elseif(isset($_GET['weekly'])){
    $time = '1 week';
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and yearweek(`dateadded`) = yearweek(NOW())';

}
elseif(isset($_GET['monthly'])){
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and MONTH(`dateadded`) = MONTH(NOW())';
    //MONTH(`dateadded`) = MONTH(NOW())
    $time = '1 month';
}
elseif(isset($_GET['quarterly'])){
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and QUARTER(`dateadded`) = QUARTER(NOW())';
    $time = '1 quarter';
}
elseif(isset($_GET['annually'])){
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and YEAR(`dateadded`) = YEAR(NOW())';
    //YEAR(`dateadded`) = YEAR(NOW())
    $time = '1 year';
}
elseif(isset($_GET['customdate'])){
    $date = $_GET['customdate'];
    $datearr = explode(',',$date);
    $date1 = $datearr[0];
    $startdate = date("Y-m-d", strtotime($date1));
    $date2 = $datearr[1];
    $enddate = date("Y-m-d", strtotime($date2));
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and date(dateadded) BETWEEN date("'.$startdate.'") and date("'.$enddate.'")';
}


$pdfquery = $sql;

$record = mysqli_query($con,$pdfquery);

if($type == 'Medicine'){
    $type = "Medicine Released";
}
elseif($type == 'Vaccine'){
    $type = "Vaccine Released";
}
else{
    $type = $type;
}

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
$datetoday = Date("M-d-Y");
$pdf = new PDF('p');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Text(10,40,"Medicine Reports (".$type.")");
$pdf->Text(170,40,"$datetoday");
$pdf->Cell(35,10,"Medicine ID",0,0,'C');
$pdf->Cell(50,10,"Medicine Name",0,0,'C');
$pdf->Cell(0,10,"Medicine Description",0,1,'C');


$pdf->SetFont('Arial','',14);
while($row = mysqli_fetch_assoc($record)){
    $pdf->Cell(35,10,$row['id'],"T",0,'C');
    $pdf->Cell(50,10,$row['name']." (".$row['dosage'].")","T",0,'C');
    $pdf->MultiCell(0,10,"Category: ".$row['category']."\nStocks: ".$row['stock'] ."\nDate: " .$row['mfgdate'] ."-". $row['expdate'],"LT",'C');



}

$pdf->Output('D','Report-'.$type.'-'.$datetoday.'.pdf');
