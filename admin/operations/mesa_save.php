<?php
ob_start();
include( '../config/conexion.php' );

$id = $_POST['id'];
$capacidad = $_POST['capacidad'];
$zona = $_POST['zona'];

$consulta = "INSERT INTO  mesas VALUES ('$id','$zona','$capacidad','0')";
$ejecutar_consulta = $conexion->query( ( $consulta ) );
if ( $ejecutar_consulta ) {
    header( 'Location: ../mesas.php?error=no' );
} else {
    header( 'Localtion: ../mesas.php?error=si' );
}
?>