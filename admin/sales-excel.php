<?php
require '../config/functions.php';
require '../config/phpspreadsheet/vendor/autoload.php';
$from   = urldecode($_GET['from']);
$to     = urldecode($_GET['to']);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$counter = get_all_payments($from,$to)->num_rows;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

for($i=0;$i<=$counter;$i++) {
    $d = $i == 0 ? 1 : $i+1;
    $sheet->mergeCells('A'.$d.':C'.$d);
    $sheet->mergeCells('D'.$d.':E'.$d);
    $sheet->mergeCells('F'.$d.':I'.$d);
    $sheet->mergeCells('J'.$d.':K'.$d);
}

$sheet->setCellValue('A1', 'Customer');
$sheet->setCellValue('D1', 'Product');
$sheet->setCellValue('F1', 'Reference');
$sheet->setCellValue('J1', 'Date');
$sheet->setCellValue('L1', 'Price');
$sheet->setCellValue('M1', 'Quantity');
$sheet->setCellValue('N1', 'Total');
$j=2;
$total=0;
foreach(get_all_order_details($from,$to) as $data) {
    $total += $data['price'] * $data['quantity'];
    $row = account_details($data['accounts_id'])->fetch_assoc();
    $sheet->setCellValue('A'.$j, $row['firstname'].' '.$row['surname']);
    $sheet->setCellValue('D'.$j, $data['product']);
    $sheet->setCellValue('F'.$j, $data['reference']);
    $sheet->setCellValue('J'.$j, date('Y-m-d h:i:s',strtotime($data['created_at'])));
    $sheet->setCellValue('L'.$j, 'P'.number_format($data['price'],2));
    $sheet->setCellValue('M'.$j, $data['quantity']);
    $sheet->setCellValue('N'.$j, 'P'.number_format($data['price'] * $data['quantity'],2));
    $j++;
}



$fileName = 'sales-report-'.date('Y-m-d').'.xlsx';

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
$writer->save('php://output');