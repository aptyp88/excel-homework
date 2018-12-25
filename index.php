<?php

require_once 'vendor/autoload.php';

//классы для записи
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//классы для чтения
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$products = [
	['product1', 100, 'category1'],
	['product2', 50, 'category2'],
	['product3', 20, 'category1'],
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet -> getActiveSheet();
$sheet -> setCellValue('A1', '№');
$sheet -> setCellValue('B1', 'Название');
$sheet -> setCellValue('C1', 'Цена');
$sheet -> setCellValue('D1', 'Категория');

for($i = 0; $i < count($products); $i++)
{
    $sheet->setCellValue('A'.($i+2), ($i+1));
    $sheet->setCellValue('B'.($i+2), $products[$i][0]);
    $sheet->setCellValue('C'.($i+2), $products[$i][1]);
    $sheet->setCellValue('D'.($i+2), $products[$i][2]);
}

$writer = new Xlsx($spreadsheet);
$writer -> save('test.xlsx');

$reader = new Xlsx();

$sp = $reader -> load('test.xlsx');
$cells = $sp -> getActiveSheet() -> getCellCollection();

echo $cells;