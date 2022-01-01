<?php
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
}

$datetoday = Date("M-d-Y");
$pdf = new PDF('p');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Text(10,40,"Electronic Medicine Record");
$pdf->Text(170,40,"$datetoday");
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(18);
$pdf->Cell(35,10,"Sample Name Lang",0,0,'C');
$pdf->SetFont('Arial','',14);
$pdf->Ln(15);
$pdf->Cell(1);
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,"Patient Information",0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(70,10,"Age: 13","T",0,"L");
$pdf->Cell(50,10,"Type: Minor","T",0,"L");
$pdf->Cell(70,10,"Gender: Male","T",1,"L");
$pdf->Cell(70,10,"Occuputaion: Sales Lady",0,0,"L");
$pdf->Cell(50,10,"Blood Type: O",0,0,"L");
$pdf->Cell(50,10,"Height: 169       Weight: 50",0,1,"L");
$pdf->Cell(0,10,"Address: Purok 1, 1 Sto. Rosario Paombong Bulacan",0,1,"L");
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,"Medication/Vaccination History",0);
$pdf->SetFont('Arial','',14);
$pdf->Cell(50,10,"Name","T",0,"L");
$pdf->Cell(30,10,"Type","T",0,"L");
$pdf->Cell(40,10,"Date Given	","T",0,"L");
$pdf->Cell(60,10,"Description","T",1,"L");

$pdf->Cell(50,10,"PROBLEMSADI",0,0,"L");
$pdf->Cell(30,10,"IDK",0,0,"L");
$pdf->Cell(40,10,"Date Given	",0,0,"L");
$pdf->MultiCell(60,10,"MAY SAKIT DAHIL MAY SAKIT",0,'J');

$pdf->Output('I',"Sample EMR");
