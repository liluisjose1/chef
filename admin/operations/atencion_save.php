<?php
ob_start();
include( '../config/conexion.php' );

$mesa = $_POST['mesa'];
$cliente = $_POST['cliente'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];

$pasa;
for ( $i = 0; $i <count( $id_producto ) ;$i++ ) {
    $sql1 = "SELECT IF((i.existencias-($cantidad[$i]*rd.cantidad))<=0,'No','Si') as realizable  FROM `recetas_detalle` rd, insumos i WHERE rd.id_receta=$id_producto[$i] AND rd.id_producto=i.id";
    $ejecutar = $conexion->query( ( $sql1 ) );
    while ( $reg = $ejecutar->fetch_assoc() ) {
        if ( $reg['realizable'] == 'No' ) {
            $pasa = false;
        } else {
            $sql2 = "INSERT INTO cuentas VALUES (NULL,'$mesa','$cliente','$id_producto[$i]','$cantidad[$i]',CURDATE())";
            $ejecutar2 = $conexion->query( ( $sql2 ) );
            $sql3= "UPDATE mesas SET estado=1 WHERE id=$mesa";
            $ejecutar3 = $conexion->query( ( $sql3 ) );
            $pasa = true;
        }
    }
}

if ( $pasa ) {
    header( 'Location: ../atencion.php?error=si' );
} else {
    header( 'Location: ../atencion.php?error=no' );
}
?>