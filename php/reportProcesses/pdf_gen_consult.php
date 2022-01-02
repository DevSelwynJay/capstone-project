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

$pdfquery = 'Select * from `medication_record` where `patient_type` = "'.$type.'" and `date_given` > NOW()- interval '.$time.' ';

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


}

$pdf = new PDF('p');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$datetoday = Date("M-d-Y");
$pdf->Text(170,40,"$datetoday");
$pdf->Text(10,40,"Consultation Reports (".$type.")");
$pdf->Cell(50,10,"Patient Name",0,0,'C');
$pdf->Cell(0,10,"Patient Description",0,1,'C');

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

            $pdf->Cell(50,10,"$pat_name","T",0,'C');
            $pdf->MultiCell(0,10,"Address: ".$comaddress ."\nBirthday: ".$bday."\nGender: " .$gender."\n Consultation Date: ".$date_given,"LT",'C');

        }



}

$pdf->Output('D','Consulation-'.$datetoday.'.pdf');