<?php
ob_start();
include( '../config/conexion.php' );

$id = $_POST['id'];
$espacio = $_POST['espacio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$consulta = "UPDATE `reservaciones` SET  `espacio`='$espacio',`fecha`='$fecha $hora' WHERE id='$id'";
$ejecutar_consulta = $conexion->query( ( $consulta ) );
print $consulta;
if ( $ejecutar_consulta ) {
    header( 'Location: ../reservaciones.php?error=no_up');
} else {
    header( 'Localtion: ../reservaciones.php?error=si' );
}
?>
