<?php
require '../config/functions.php';
require '../config/fpdf/fpdf.php';
$from   = urldecode($_GET['from']);
$to     = urldecode($_GET['to']);

$pdf = new FPDF( 'L', 'mm', 'LEGAL' );
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'Customer');
$pdf->Cell(100,10,'Email');
$pdf->Cell(60,10,'Contact');
$pdf->Cell(50,10,'Birthday');
$pdf->Cell(30,10,'Age');
$pdf->SetFont('Arial','',16);

foreach(get_all_customer($from,$to) as $data) {
    $pdf->Ln();
    $pdf->Cell(80,10,$data['firstname'] == '' ? 'NA' : $data['firstname'].' '.$data['surname']);
    $pdf->Cell(100,10,$data['email']);
    $pdf->Cell(60,10,$data['contact'] == '' ? 'NA' : $data['contact']);
    $pdf->Cell(50,10,$data['birthday'] == '' ? 'NA' : $data['birthday']);
    $pdf->Cell(30,10,$data['age'] == '' ? 'NA' : $data['age']);
}

$pdf->Output();
?>