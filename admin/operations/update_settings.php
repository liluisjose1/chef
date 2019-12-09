<?php
ob_start();
include("../config/conexion.php");

$nombre = $_POST["nombre"];
$tel = $_POST["tel"];
$nit = $_POST["nit"];
$nrc = $_POST["nrc"];
$dir = $_POST["dir"];
$stock = $_POST["stock"];
$imagen =$_FILES["icon"]["name"];
$ruta = $_FILES["icon"]["tmp_name"];
$destino="../assets/images/".$imagen;
$ruta_final="assets/images/".$imagen;



$consulta = "UPDATE `settings` SET stock='$stock',`name`='$nombre',`tel`='$tel',`nit`='$nit',`nrc`='$nrc',`address`='$dir',`icon`='$ruta_final' WHERE 1";
$ejecutar_consulta = $conexion->query(($consulta));
if ($ejecutar_consulta) {
	copy($ruta,$destino);
	header("Location: ../settings.php?error=no");
} else {
	header("Localtion: ../settings.php?error=si");
}
