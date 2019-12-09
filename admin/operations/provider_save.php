<?php
ob_start();
include( '../config/conexion.php' );

$nombre = $_POST['nombre'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$core = $_POST['core'];
$direccion = $_POST['direccion'];

$consulta = "INSERT INTO  proveedores VALUES (NULL,'$nombre','$tel1','$tel2','$core','$direccion',0)";
$ejecutar_consulta = $conexion->query( ( $consulta ) );
if ( $ejecutar_consulta ) {
    header( 'Location: ../providers.php?error=no' );
} else {
    header( 'Localtion: ../providers.php?error=si' );
}
?>