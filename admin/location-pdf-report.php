<?php
require '../config/functions.php';
require '../config/fpdf/fpdf.php';
$from   = urldecode($_GET['from']);
$to     = urldecode($_GET['to']);

$pdf = new FPDF( 'L', 'mm', 'LEGAL' );
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'Location');
$pdf->Cell(30,10,'Count');
$pdf->SetFont('Arial','',16);

foreach(get_locations($from,$to) as $data) {
    $pdf->Ln();
    $pdf->Cell(80,10,$data['city']);
    $pdf->Cell(30,10,$data['count']);
}

$pdf->Output();
?>