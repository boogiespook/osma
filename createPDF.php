<?php
$id = "23";
// <= PHP 5
$page = file_get_contents('./OrangeLimeTheatreCompany.html', true);

require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$page);
$pdf->Output();
?>
