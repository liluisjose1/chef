<?php
ob_start();
include( '../config/conexion.php' );

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$unidad = $_POST['unidad'];
$descripcion = $_POST['descripcion'];

$consulta = "UPDATE `insumos` SET `nombre`='$nombre',`unidad`='$unidad',`descripcion`='$descripcion' WHERE id='$id'";
$ejecutar_consulta = $conexion->query( ( $consulta ) );

if ( $ejecutar_consulta ) {
    header( 'Location: ../supplies.php?error=no_up');
} else {
    header( 'Localtion: ../supplies.php?error=si' );
}
?>
