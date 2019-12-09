<?php
ob_start();
include( '../config/conexion.php' );

$id = $_POST['id'];
$monto = $_POST['monto'];

$consulta1 = "UPDATE proveedores SET credito=(credito-$monto) WHERE id='$id';";
$consulta2 = "INSERT INTO resumen_compra VALUES (NULL,'$id','2','$monto',NOW())";

$ejecutar_consulta1 = $conexion->query( ( $consulta1 ));
$ejecutar_consulta2 = $conexion->query( ( $consulta2 ) );

if ( $ejecutar_consulta1 &&  $ejecutar_consulta2 ) {
    header( 'Location: ../providers.php?error=no_a' );
} else {
    header( 'Localtion: ../providers.php?error=si_a' );
}
?>