<?php
session_start();
$con=null;
require('php/pdflib/fpdf.php');
require('php/DB_Connect.php');



//bigay nalng ng query for getting information
//pwedeng href gamitin or ajax na post

class PDF extends FPDF{
    function Header()
    {
        $this->Image('img/HIS logo blue.png',10,6,50);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,15,'Sto. Rosario Rural Health Center');
        $this->Ln(40);
    }
    //WORDWRAP FUNCTION
    function myCell($w,$h,$x,$t){
        $height = $h/3;
        $first = $height+2;
        $second = $height+$height+$height+3;
        $len = strlen($t);
        if($len>15){
            $txt = str_split($t,15);
            $this->SetX($x);
            $this->Cell($w,$first,$txt[0],'','','');
            $this->SetX($x);
            $this->Cell($w,$second,$txt[1],'','','');
            $this->SetX($x);
            $this->Cell($w,$h,'','',0,'L',0);

        }
        else{
            $this->SetX($x);
            $this->Cell($w,$h,$t,'');
        }
    }
}

$datetoday = Date("M-d-Y");
$pdf = new PDF('p');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Text(10,40,"Electronic Medical Record");
$pdf->Text(170,40,"$datetoday");
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(18);

$pdf->Cell(35,10, $_SESSION['active_emr_account']['name'],0,0,'C');

$pdf->SetFont('Arial','',14);
$pdf->Ln(15);
$pdf->Cell(1);
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,"Patient Information",0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(70,10,"Age: ".$_SESSION['active_emr_account']['age'],"T",0,"L");
$pdf->Cell(50,10,"Type: ".$_SESSION['active_emr_account']['patient_type'],"T",0,"L");
$pdf->Cell(70,10,"Gender: ".$_SESSION['active_emr_account']['gender'],"T",1,"L");
$pdf->Cell(70,10,"Occupation: ".$_SESSION['active_emr_account']['occupation'],0,0,"L");
$pdf->Cell(50,10,"Blood Type: ".$_SESSION['active_emr_account']['blood_type'],0,0,"L");
$pdf->Cell(50,10,"Height: ".$_SESSION['active_emr_account']['height']."       Weight: ".$_SESSION['active_emr_account']['weight'],0,1,"L");
$pdf->Cell(0,10,"Address: ".$_SESSION['active_emr_account']['address'],0,1,"L");

$w = 45;
$h = 16;



//-----Vaccination Record
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,"Vaccination Record",0);
$pdf->SetFont('Arial','',14);

//row header
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Name");
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Type");
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Date Given");
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Description");
$pdf->Ln();


//values per row
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"asdadasdsadasdaasdadadasda");
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"asdadasdsadasdaasdadadasda");
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"asdadasdsadasdaasdadadasda");
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"asdadasdsadasdaasdadadasda");
$pdf->Ln();

//-----Medication Record
//title
$pdf->Ln(40);
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,"Medication Record",0);
$pdf->SetFont('Arial','',14);

//row header
$pdf->Cell(50,10,"Name","T",0,"L");
$pdf->Cell(30,10,"Type","T",0,"L");
$pdf->Cell(40,10,"Date Given	","T",0,"L");
$pdf->Cell(60,10,"Description","T",1,"L");

foreach ( $_SESSION['active_emr_medication'] as $item){
    //values per row
    $x = $pdf->GetX();
    $pdf->myCell($w,$h,$x,$item['name']);
    $x = $pdf->GetX();
    $pdf->myCell($w,$h,$x,$item['type']);
    $x = $pdf->GetX();
    $pdf->myCell($w,$h,$x,$item['date']);
    $x = $pdf->GetX();
    $pdf->myCell($w,$h,$x,$item['description']);
    $pdf->Ln();
}

$pdf->Output('I',"Sample EMR");

return $pdf->Output('doc.pdf', 'S');