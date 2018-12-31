<?php

require_once 'vendor/autoload.php';

//классы для записи
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$products = [
	['product1', 100, 'category1'],
	['product2', 50, 'category2'],
	['product3', 30, 'category1'],
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

// echo '<a href="load.php">Load excel file</a>';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;
use PhpOffice\PhpSpreadsheet\IOFactory;

$reader = new Reader(); 
$spreadsheet = $reader->load('test.xlsx');

$cells = $spreadsheet->getActiveSheet()->getCellCollection();
echo '<table border="1">';
for ($row = 1; $row <= $cells->getHighestRow(); $row++)
{
    echo '<tr>';
    for ($col = 'A'; $col <= 'D'; $col++)
    {
        $cell = $cells->get($col.$row);
        if($cell)
        {
            echo '<td>' . $cell->getValue() . '</td>';
        }
    }
    echo  '</tr>';
}

echo '</table>';