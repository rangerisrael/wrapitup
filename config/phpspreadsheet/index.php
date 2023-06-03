<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

for($i=1;$i<=10;$i++) {
    $sheet->mergeCells('A'.$i.':B'.$i);
    $sheet->mergeCells('C'.$i);
}

for($j=1;$j<=10;$j++) {
    if($j==1) {
        $sheet->setCellValue('A'.$j, 'Method of Payment');
        $sheet->setCellValue('C'.$j, 'Count');
    } else {
        $sheet->setCellValue('A'.$j, 'Stripe');
        $sheet->setCellValue('C'.$j, '2');
    }
}



$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
