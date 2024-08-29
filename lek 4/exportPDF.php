<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$txtFile = 'results.txt';

if(file_exists($txtFile)) {

    $txtContent = file_get_contents($txtFile);

    $pdf->MultiCell(0, 10, $txtContent);

    $pdf->Output('D', 'results.pdf');
} else {
    echo "File not found!";
}
?>