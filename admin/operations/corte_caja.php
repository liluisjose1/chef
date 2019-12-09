<?php
require('../config/conexion.php');

$caja = $_POST["caja"];
$tipo = $_POST["tipo"];
$monto = $_POST["monto"];


if ($tipo==1) {
    $sql0="SELECT id FROM cortes_caja WHERE caja='$caja' AND fecha=CURRENT_DATE()";
    $ejecutar_sql0 = $conexion->query($sql0);
    $data = $ejecutar_sql0->fetch_row();

    if ($data) {
        header( 'Location: ../caja.php?error=no_x');
    } else {
        $sql1="INSERT INTO cortes_caja VALUES (NULL,'$caja','$monto',NULL,NULL,CURRENT_DATE())";
        $ejecutar_sql1 = $conexion->query($sql1);
        header( 'Location: ../caja.php?error=si_x');
    }
} else {
    $sql2="UPDATE cortes_caja SET cortez='$monto',diferencia=(cortex-cortez) WHERE caja='$caja' AND fecha=CURRENT_DATE()";
    $ejecutar_sql2 = $conexion->query($sql2);
    header( 'Location: ../caja.php?error=si_z');
}

?>