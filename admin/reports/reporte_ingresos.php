<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

$fecha_desde=$_POST["fecha_desde"];
$fecha_hasta=$_POST["fecha_hasta"];

$sql = "SELECT * from settings";
$ejecutar = $conexion->query($sql);
$data = $ejecutar->fetch_row();

$data_receta = "SELECT * FROM `ventas` WHERE fecha BETWEEN '$fecha_desde 00:00:00' AND '$fecha_hasta 23:59:59'";
$ejecutar_receta = $conexion->query($data_receta);

$totsql = "SELECT SUM(total) FROM `ventas` WHERE fecha BETWEEN '$fecha_desde 00:00:00' AND '$fecha_hasta 23:59:59'";
$ex_tot = $conexion->query($totsql);
$dat_tot = $ex_tot->fetch_row();


class PDF extends FPDF
{
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I', 8);
        $this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
    }
}

$pdf = new PDF('P','mm','A4');
//$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

setlocale(LC_TIME, "spanish");
$pdf->Image('../'.$data[6], 5, 5, 30 );
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,0, $data[1],0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0, $data[5],0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0, "NIT: ".$data[3]." NRC: ".$data[4],0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0, "Telefono: ".$data[2],0,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0, 'Reporte de Ventas desde: '.$fecha_desde.' Hasta: '.$fecha_hasta,0,1,'C');
$pdf->Ln(5);


$pdf->SetX(15);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,6,'N',1,0,'C',1);
$pdf->Cell(100,6,'Cliente',1,0,'C',1);
$pdf->Cell(40,6,'Fecha/Hora',1,0,'C',1);
$pdf->Cell(20,6,'Total',1,1,'C',1);


$pdf->SetFont('Arial','',10);
$cont=1;
 while($row = $ejecutar_receta->fetch_assoc())
 {
    $pdf->SetX(15);
    $pdf->Cell(20,6,$cont,1,0,'C');
    $pdf->Cell(100,6,utf8_decode($row['cliente']),1,0,'');;
    $pdf->Cell(40,6,utf8_decode($row['fecha']),1,0,'C');
    $pdf->Cell(20,6,"$ ".utf8_decode($row['total']),1,1,'R');
    $cont++;
}
$pdf->SetX(15);
$pdf->Cell(160,6,"Total",1,0,'R');;
$pdf->Cell(20,6,"$ ".utf8_decode($dat_tot[0]),1,1,'R');

$pdf->Output();
?>