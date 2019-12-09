<?php
ob_start();
include( '../config/conexion.php' );

$proveedor = $_POST['proveedor'];
$fecha = $_POST['fecha'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
$precio_compra = $_POST['precio_compra'];
$total = $_POST['total'];


$forma_pago = $_POST['forma_pago'];
$total_compra = $_POST['total_compra'];

for ( $i = 0; $i <count( $id_producto );$i++ ) {
    $consulta = "INSERT INTO  compras VALUES (NULL,'$proveedor','$fecha',$id_producto[$i],'$cantidad[$i]','$precio_compra[$i]','$total[$i]')";
    $consulta2 = "UPDATE `insumos` SET `existencias` = `existencias` + $cantidad[$i] WHERE `id` = $id_producto[$i];";
    $ejecutar_consulta = $conexion->query( ( $consulta ) );
    $ejecutar_consulta2 = $conexion->query( ( $consulta2 ) );
}
if ($forma_pago==2) {
    $consulta4 = "UPDATE proveedores SET credito=(credito+$total_compra);";
    $ejecutar_consulta4 = $conexion->query( ( $consulta4 ) );
}else if($forma_pago==1){
    $consulta3="INSERT INTO resumen_compra VALUES (NULL,'$proveedor','$forma_pago','$total_compra',NOW())";
    $ejecutar_consulta3=$conexion->query( ( $consulta3 ) );
}

if ( $ejecutar_consulta &&  $ejecutar_consulta2) {
    header( 'Location: ../compras.php?error=no' );
} else {
    header( 'Localtion: ../compras.php?error=si' );
}
?>