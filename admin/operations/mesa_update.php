<?php
ob_start();
include( '../config/conexion.php' );

$id = $_POST['id'];
$capacidad = $_POST['capacidad'];
$zona = $_POST['zona'];

$consulta = "UPDATE `mesas` SET  `id`='$id',`tipo`='$zona',`capacidad`='$capacidad' WHERE id='$id'";
$ejecutar_consulta = $conexion->query( ( $consulta ) );
if ( $ejecutar_consulta ) {
    header( 'Location: ../mesas.php?error=no_up');
} else {
    header( 'Localtion: ../mesas.php?error=si' );
}
?>
