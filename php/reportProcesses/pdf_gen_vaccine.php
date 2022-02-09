<?php
session_start();
$con = null;
require ('../pdflib/fpdf.php');
require ('../DB_Connect.php');
$type = $_GET['type'];
$admin_id = $_SESSION['active_admin_name'];
if(isset($_GET['daily'])){
    $time = '1 day';
    $sql = 'Select * from `vaccination_record` where `patient_type` = "'.$type.'" and DATE_FORMAT(`date_given`,"%Y %M %d") = DATE_FORMAT(NOW(),"%Y %M %d")  ';
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
elseif(isset($_GET['customdate'])){
    $date = $_GET['customdate'];
    $datearr = explode(',',$date);
    $date1 = $datearr[0];
    $startdate = date("Y-m-d", strtotime($date1));
    $date2 = $datearr[1];
    $enddate = date("Y-m-d", strtotime($date2));
    $sql = 'Select * from `vaccination_record` where `patient_type` = "'.$type.'" and date(date_given) BETWEEN date("'.$startdate.'") and date("'.$enddate.'")';
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
    function Footer()
    {
        $datetoday = Date("M-d-Y");
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Date Created: '.$datetoday,0,0,'L');
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');

        if($this->isFinished){
            $this->SetY(-40);
            $admin_id = $_SESSION['active_admin_name'];
            $this->SetFont('Arial','I',12);
            $this->MultiCell(0,10,"\nGenerated by: ".$admin_id,0,'R');
        }

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
$pdf->isFinished = false;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$datetoday = Date("M-d-Y");
$pdf->Text(10,40,"Vaccination Reports (".ucfirst($type).")");
$pdf->Cell(50,10,"Patient Name",0,0,'L');
$pdf->Cell(0,10,"Patient Description",0,1,'C');
$w = 70;
$h = 16;
$pdf->SetFont('Arial','',10);
while($row1 = mysqli_fetch_assoc($record1)){
    $admin = $row1['admin_id'];
    $adminqry = 'Select * from `admin` where id = "'.$admin.'"';
    $adminrecord = mysqli_query($con,$adminqry);
    while($row2 = mysqli_fetch_assoc($adminrecord)) {
        $admin_name = $row2['first_name'] . ' ' . $row2['middle_name'] . ' ' . $row2['last_name'];
        $patient_id = $row1['patient_id'];
        $date_given = $row1['date_given'];
        $vaccine_name = $row1['vaccine_name'];
        $vaccine_dosage = $row1['vaccine_dosage'];
        $patqry = 'Select * from `walk_in_patient` where id = "' . $patient_id . '"';
        $record2 = mysqli_query($con, $patqry);
        while ($row3 = mysqli_fetch_assoc($record2)) {
            $lname = $row3['last_name'];
            $fname = $row3['first_name'];
            $mname = $row3['middle_name'];
            $pat_name = $fname . ' ' . $mname . ' ' . $lname;
            $bday = $row3['birthday'];
            $purok = $row3['purok'];
            $house_no = $row3['house_no'];
            $address = $row3['address'];
            $comaddress = 'Purok ' . $purok . ' House No.' . $house_no . ' ' . $address;
            $gender = $row3['gender'];
            $pdf->SetFont('Arial','',14);
            $x = $pdf->GetX();
            $pdf->myCell($w,$h,$x,$pat_name);
            $pdf->SetFont('Arial','',11);
            $pdf->MultiCell(0, 8, "Address: " . $comaddress . "\nBirthday: " . $bday . "\nGender: " . $gender . "\nVaccine Given: " . $vaccine_name . " (" . $vaccine_dosage . ")" . "\nAdministered By: ".$admin_name."\nConsultation Date: " . $date_given, "LT", 'L');
            $pdf->isFinished = false;
        }
    }
}
$pdf->isFinished = true;
$pdf->Output('D','Vaccine-'.$type.'-'.$datetoday.'.pdf');
