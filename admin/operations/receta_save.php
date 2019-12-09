<?php
ob_start();
include( '../config/conexion.php' );

$nombre = $_POST['nombre'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
$precio_venta = $_POST['precio_venta'];


$consulta1 = "SELECT * FROM recetas WHERE nombre='$nombre'";
$ejecutar_consulta1 = $conexion->query( ( $consulta1 ) );
$data1 = $ejecutar_consulta1-> fetch_row();

$consulta4 = "SELECT id FROM recetas ORDER BY id DESC LIMIT 1";
$ejecutar_consulta4 = $conexion->query( ( $consulta4 ) );
$data2 = $ejecutar_consulta4-> fetch_row();


if ($data1) {
	// ya existe receta
	header( 'Location: ../prescription.php?error=si_exis' );

} else {
	//no existe receta
	$consulta2 = "INSERT INTO recetas VALUES (NULL,'$nombre','$precio_venta',NOW(),NULL)";
	$ejecutar_consulta1 = $conexion->query( ( $consulta2 ) );
	for ( $i = 0; $i <count( $id_producto );$i++ ) {

		$consulta3 = "INSERT INTO  recetas_detalle VALUES (NULL,$data2[0]+1,$id_producto[$i],'$cantidad[$i]')";
		$ejecutar_consulta = $conexion->query( ( $consulta3 ) );
	}
}

if ( $ejecutar_consulta ) {
    header( 'Location: ../prescription.php?error=no' );
} else {
    header( 'Localtion: ../prescription.php?error=si' );
}
?>