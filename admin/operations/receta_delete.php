<?php 
ob_start();
include("../config/conexion.php");

$id = $_POST["id_user"];

$sql = "DELETE FROM `recetas` WHERE `id`='$id'";
		$ejecutar_consulta = $conexion->query(($sql));
		print($sql);
			if($ejecutar_consulta){
				header("Location: ../prescription.php?error=no_d");
			}
			else{
				header("Localtion: ../prescription.php?error=si");
			}

 ?>