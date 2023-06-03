<?php
require '../config/functions.php';
require '../config/fpdf/fpdf.php';
$from   = urldecode($_GET['from']);
$to     = urldecode($_GET['to']);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'Method of Payment');
$pdf->Cell(40,10,'Times Used');
$pdf->SetFont('Arial','',16);

foreach(get_all_payments($from,$to) as $data) {
    $pdf->Ln();
    $pdf->Cell(80,10,$data['method_of_payment']);
    $pdf->Cell(40,10,$data['items']);
}

$pdf->Output();
?>