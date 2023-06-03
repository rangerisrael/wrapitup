<?php
require '../config/functions.php';
require '../config/phpspreadsheet/vendor/autoload.php';
$from   = urldecode($_GET['from']);
$to     = urldecode($_GET['to']);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$counter = get_all_customer($from,$to)->num_rows;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'Marital');
$sheet->setCellValue('B1', 'Count');
$j=2;
foreach(get_maritals($from,$to) as $data) {
    $sheet->setCellValue('A'.$j, $data['marital']);
    $sheet->setCellValue('B'.$j, $data['count']);
    $j++;
}



$fileName = 'marital-report-'.date('Y-m-d').'.xlsx';

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
$writer->save('php://output');