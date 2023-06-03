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
    $sheet->mergeCells('A'.$d.':B'.$d);
}

$sheet->setCellValue('A1', 'Method of Payment');
$sheet->setCellValue('C1', 'Count');
$j=2;
foreach(get_all_payments($from,$to) as $data) {
    $sheet->setCellValue('A'.$j, $data['method_of_payment']);
    $sheet->setCellValue('C'.$j, $data['items']);
    $j++;
}



$fileName = 'payment-report-'.date('Y-m-d').'.xlsx';

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
$writer->save('php://output');