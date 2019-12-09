<?php
ob_start();
include( '../config/conexion.php' );

$id = $_POST['id_user'];

$sql = "DELETE FROM `insumos` WHERE `id`='$id'";
$ejecutar_consulta = $conexion->query( ( $sql ) );
if ( $ejecutar_consulta ) {
    header( 'Location: ../supplies.php?error=no_d' );
} else {
    header( 'Localtion: ../supplies.php?error=si' );
}

?>