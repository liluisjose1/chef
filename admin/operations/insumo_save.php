<?php
ob_start();
include( '../config/conexion.php' );

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$unidad = $_POST['unidad'];

$consulta = "INSERT INTO  insumos VALUES (NULL,'$nombre','$descripcion',0,'$unidad',NULL,NULL)";
$ejecutar_consulta = $conexion->query( ( $consulta ) );
print $consulta;
if ( $ejecutar_consulta ) {
    header( 'Location: ../supplies.php?error=no' );
} else {
    header( 'Localtion: ../supplies.php?error=si' );
}
?>