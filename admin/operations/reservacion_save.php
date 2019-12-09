<?php
ob_start();
include( '../config/conexion.php' );

$cliente = $_POST['cliente'];
$espacio = $_POST['espacio'];
$anticipo = $_POST['anticipo'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$consulta = "INSERT INTO  reservaciones VALUES (NULL,'$cliente','$anticipo','$espacio','$fecha $hora')";
$ejecutar_consulta = $conexion->query( ( $consulta ) );
if ( $ejecutar_consulta ) {
    header( 'Location: ../reservaciones.php?error=no' );
} else {
    header( 'Localtion: ../reservaciones.php?error=si' );
}
?>