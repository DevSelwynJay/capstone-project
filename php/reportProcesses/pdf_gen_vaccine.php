<?php
$con = null;
require ('../pdflib/fpdf.php');
require ('../DB_Connect.php');

$type = $_GET['type'];
if(isset($_GET['daily'])){
    $time = '1 day';
    $sql = 'Select * from `vaccination_record` where `patient_type` = "'.$type.'" and `date_given` > NOW()- interval '.$time.' ';
}
elseif(isset($_GET['weekly'])){
    $time = '1 week';
    $sql = 'Select * from `vaccination_record` where `patient_type` = "'.$type.'" and yearweek(`date_given`) = yearweek(NOW())';

}
elseif(isset($_GET['monthly'])){
    $sql = 'Select * from `vaccination_record` where `patient_type` = "'.$type.'" and MONTH(`date_given`) = MONTH(NOW())';
    //MONTH(`dateadded`) = MONTH(NOW())
    $time = '1 month';
}
elseif(isset($_GET['quarterly'])){
    $sql = 'Select * from `vaccination_record` where `patient_type` = "'.$type.'" and QUARTER(`date_given`) = QUARTER(NOW())';
    $time = '1 quarter';
}
elseif(isset($_GET['annually'])){
    $sql = 'Select * from `vaccination_record` where `patient_type` = "'.$type.'" and YEAR(`date_given`) = YEAR(NOW())';
    //YEAR(`dateadded`) = YEAR(NOW())
    $time = '1 year';
}

$pdfquery = $sql;

$record1 = mysqli_query($con,$pdfquery);

class PDF extends FPDF{
    function Header()
    {
        $this->Image('HIS logo blue.png',10,6,50);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,15,'Sto. Rosario Rural Health Center');
        $this->Ln(37);
    }
    function myCell($w,$h,$x,$t){
        $height = $h/3;
        $first = $height+2;
        $second = $height+$height+$height+3;
        $len = strlen($t);
        if($len>25){
            $txt = str_split($t,25);
            $this->SetX($x);
            $this->Cell($w,$first,$txt[0],'','','');
            $this->SetX($x);
            $this->Cell($w,$second,$txt[1],'','','');
            $this->SetX($x);
            $this->Cell($w,$h,'','T',0,'L',0);

        }
        else{
            $this->SetX($x);
            $this->Cell($w,$h,$t,'T');
        }
    }


}

$pdf = new PDF('p');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$datetoday = Date("M-d-Y");
$pdf->Text(170,40,"$datetoday");
$pdf->Text(10,40,"Vaccination Reports (".$type.")");
$pdf->Cell(50,10,"Patient Name",0,0,'C');
$pdf->Cell(0,10,"Patient Description",0,1,'C');
$w = 70;
$h = 16;
while($row1 = mysqli_fetch_assoc($record1)){
    $patient_id = $row1['patient_id'];
    $date_given = $row1['date_given'];
    $patqry = 'Select * from `walk_in_patient` where id = "'.$patient_id.'"';
    $record2 = mysqli_query($con,$patqry);
    while($row3 = mysqli_fetch_assoc($record2)){
        $lname = $row3['last_name'];
        $fname = $row3['first_name'];
        $mname = $row3['middle_name'];
        $pat_name = $fname .' '.$mname.' '.$lname;
        $bday = $row3['birthday'];
        $purok = $row3['purok'];
        $house_no = $row3['house_no'];
        $address = $row3['address'];
        $comaddress = 'Purok '.$purok.' House No.'.$house_no.' '.$address;
        $gender = $row3['gender'];

        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,$pat_name);
        $pdf->MultiCell(0,10,"Address: ".$comaddress ."\nBirthday: ".$bday."\nGender: " .$gender."\n Consultation Date: ".$date_given,"LT",'C');

    }



}

$pdf->Output('D','Vaccine-'.$datetoday.'.pdf');
