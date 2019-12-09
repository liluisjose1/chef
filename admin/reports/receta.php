<?php
require('./fpdf/fpdf.php');
require('../config/conexion.php');

$id = $_GET["id"];
$sql1="SELECT * FROM recetas WHERE id='$id'";
$resultado1 = $conexion->query($sql1);
$data_r1 = $resultado1->fetch_row();

$sql="SELECT * FROM recetas_detalle WHERE id_receta='$id'";
$resultado = $conexion->query($sql);
$data_r = $resultado->fetch_row();


$sql = "SELECT * from settings";
$ejecutar = $conexion->query($sql);
$data = $ejecutar->fetch_row();

$data_receta = "SELECT i.id,i.nombre,rd.cantidad FROM recetas_detalle rd, recetas r, insumos i WHERE r.id=rd.id_receta and i.id=rd.id_producto AND r.id=$id";
$ejecutar_receta = $conexion->query($data_receta);


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
$pdf->Cell(0,0, 'Detalle de receta: '.$data_r1[1],0,1,'C');
$pdf->Ln(5);


$pdf->SetX(25);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,6,'ID',1,0,'C',1);
$pdf->Cell(100,6,'INSUMO',1,0,'C',1);
$pdf->Cell(40,6,'CANTIDAD',1,1,'C',1);


$pdf->SetFont('Arial','',10);
 while($row = $ejecutar_receta->fetch_assoc())
 {
    $pdf->SetX(25);
    $pdf->Cell(20,6,utf8_decode($row['id']),1,0,'C');
    $pdf->Cell(100,6,utf8_decode($row['nombre']),1,0,'');;
    $pdf->Cell(40,6,utf8_decode($row['cantidad']),1,1,'C');
}

$pdf->Output();
?>