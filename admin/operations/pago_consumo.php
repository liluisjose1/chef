<?php
require('../config/conexion.php');

$mesa = $_POST["mesa"];
$cliente = $_POST["cliente"];
$monto = $_POST["monto"];



$sql1="SELECT SUM(c.cantidad*r.precio_venta) total FROM recetas r, cuentas c WHERE c.id_receta = r.id AND c.cliente='$cliente' AND c.mesa='$mesa' AND fecha=CURRENT_DATE() GROUP BY c.cliente";
$ejecutar_sql1 = $conexion->query($sql1);
$data1 = $ejecutar_sql1->fetch_row();
$totalfinal=$data1[0];

$sql2="INSERT INTO ventas VALUES (NULL,'$cliente','$totalfinal',NOW())";
$ejecutar_pago = $conexion->query($sql2);

$data_receta="UPDATE mesas SET estado=0 WHERE id=$mesa";
$ejecutar_receta = $conexion->query($data_receta);
echo $sql1;
echo "<br>";
echo $sql2;
echo "<br>";
echo $data_receta;
echo "<br>";

if ( $ejecutar_pago && $ejecutar_receta ) {
    header( 'Location: ../caja.php?error=no'.'&cambio='.($totalfinal-$monto));
} else {
    header( 'Localtion: ../caja.php?error=si' );
}

?>