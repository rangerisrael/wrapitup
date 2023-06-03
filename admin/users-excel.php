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


$sheet->setCellValue('A1', 'Customer');
$sheet->setCellValue('B1', 'Email');
$sheet->setCellValue('C1', 'Contact');
$sheet->setCellValue('D1', 'Birthday');
$sheet->setCellValue('E1', 'Age');
$j=2;
foreach(get_all_customer($from,$to) as $data) {
    $sheet->setCellValue('A'.$j, $data['firstname'] == '' ? 'NA' : $data['firstname'].' '.$data['surname']);
    $sheet->setCellValue('B'.$j, $data['email']);
    $sheet->setCellValue('C'.$j, $data['contact'] == '' ? 'NA' : $data['contact']);
    $sheet->setCellValue('D'.$j, $data['birthday'] == '' ? 'NA' : $data['birthday']);
    $sheet->setCellValue('E'.$j, $data['age'] == '' ? 'NA' : $data['age']);
    $j++;
}



$fileName = 'users-report-'.date('Y-m-d').'.xlsx';

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
$writer->save('php://output');