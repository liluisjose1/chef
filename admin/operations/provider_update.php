<?php
ob_start();
include( '../config/conexion.php' );

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$core = $_POST['core'];
$direccion = $_POST['direccion'];

$consulta = "UPDATE `proveedores` SET  `nombre`='$nombre',`tel1`='$tel1',`tel2`='$tel2',email='$core',direccion='$direccion' WHERE id='$id'";
$ejecutar_consulta = $conexion->query( ( $consulta ) );
print $consulta;
if ( $ejecutar_consulta ) {
    header( 'Location: ../providers.php?error=no_up' );
} else {
    header( 'Localtion: ../providers.php?error=si' );
}
?>
