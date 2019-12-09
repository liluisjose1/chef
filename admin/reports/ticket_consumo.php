<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

$mesa = $_GET["m"];
$cliente = $_GET["c"];



$sql = "SELECT * from settings";
$ejecutar = $conexion->query($sql);
$data = $ejecutar->fetch_row();

$data_receta="SELECT r.nombre,r.precio_venta,c.cantidad,(c.cantidad*r.precio_venta) total FROM recetas r, cuentas c WHERE c.id_receta = r.id AND c.cliente='$cliente' AND c.mesa='$mesa' AND fecha=CURRENT_DATE()";
$ejecutar_receta = $conexion->query($data_receta);

$sql1="SELECT SUM(c.cantidad*r.precio_venta) total FROM recetas r, cuentas c WHERE c.id_receta = r.id AND c.cliente='$cliente' AND c.mesa='$mesa' AND fecha=CURRENT_DATE() GROUP BY c.cliente";
$ejecutar_sql1 = $conexion->query($sql1);
$data1 = $ejecutar_sql1->fetch_row();


date_default_timezone_set('America/Guatemala');
$fecha  = date("Y-m-d H:i:s");



$pdf = new FPDF('P','mm',array(75,120));
//$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

setlocale(LC_TIME, "spanish");
$pdf->Image('../'.$data[6], 33, 6, 10 );
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0, $data[1],0,1,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0, $data[5],0,1,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0, "Telefono: ".$data[2],0,1,'C');
$pdf->Ln(3);
$pdf->SetFont('Arial','',6);
$pdf->Cell(0,0, $fecha,0,1,'C');
$pdf->Ln(4);

$pdf->SetX(8);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(10,4,'Cant',0,0,'C');
$pdf->Cell(30,4,'Producto',0,0,'');
$pdf->Cell(10,4,'P.U.',0,0,'C');
$pdf->Cell(10,4,'Total',0,0,'C');

$pdf->Ln(3);

$pdf->SetFont('Arial','',6);
while($row = $ejecutar_receta->fetch_assoc())
{
    $pdf->SetX(8);
    $pdf->Cell(10,4,utf8_decode($row['cantidad']),0,0,'C');
    $pdf->Cell(30,4,utf8_decode($row['nombre']),0,0,'');
    $pdf->Cell(10,4,"$ ".utf8_decode($row['precio_venta']),0,0,'C');
    $pdf->Cell(10,4,"$ ".utf8_decode($row['total']),0,1,'C');
}
$pdf->Ln(3);
$pdf->SetFont('Arial','B',6);
$pdf->SetX(40);
$pdf->Cell(0,4,'Total',0,0,'C');
$pdf->SetX(58);
$pdf->Cell(10,4,'$ '.$data1[0],0,0,'C');

$pdf->Output();
?>