<?php 
ob_start();
include("../config/conexion.php");

$user_id = $_POST["user_id"];

	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM insumos WHERE id='$user_id'";
	$ejecutar_consulta = $conexion->query($consulta);
	$row = mysqli_fetch_array($ejecutar_consulta);
	echo json_encode($row);  
 ?>