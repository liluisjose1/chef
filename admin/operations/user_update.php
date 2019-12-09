<?php 
ob_start();
include("../config/conexion.php");

$usuario = $_POST["usuario"];
$nombre = $_POST["nombre"];
$tipo_usuario = $_POST["tipo_usuario"];
$password= $_POST["contra"];
$activo= $_POST["estado"];

			/* Si coinciden, guardamos la información en nuestra base de datos. */
			$consulta = "UPDATE `usuario` SET `usuario`='$usuario',`nombre`='$nombre',`estado`='$activo',`tipo`='$tipo_usuario',`password`=SHA1('$password') WHERE usuario='$usuario'";
			$ejecutar_consulta = $conexion->query(($consulta));
			
			/* Si se ejecutó la consulta, redirigimos al archivo del formulario con una clave de que se ejecutó correctamente. */
			if($ejecutar_consulta){
				header("Location: ../users.php?error=no_up");
			}
	/* Si existen registros, indicamos que el usuario a crear ya existe. */
	else{
			header("Localtion: ../users.php?error=si");
		}
