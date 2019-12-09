<?php 
ob_start();
include("../config/conexion.php");

$id = $_POST["id_user"];

$sql = "DELETE FROM `reservaciones` WHERE `id`='$id'";
		$ejecutar_consulta = $conexion->query(($sql));
		print($sql);
			if($ejecutar_consulta){
				header("Location: ../reservaciones.php?error=no_d");
			}
			else{
				header("Localtion: ../reservaciones.php?error=si");
			}

 ?>