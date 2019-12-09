<?php 
ob_start();
include("../config/conexion.php");

$usuario = $_POST["usuario"];
$nombre = $_POST["nombre"];
$tipo_usuario = $_POST["tipo_usuario"];
$password= $_POST["contra"];
$activo= $_POST["estado"];
//$date = Date("Y-m-d");


	/* Verificamos que el usuario que se quiere crear no exista ya en la base de datos. */
	$consulta = "SELECT * FROM usuario WHERE usuario='$usuario'";
	$ejecutar_consulta = $conexion->query($consulta);
	$num_regs = $ejecutar_consulta->num_rows;

	/*Si no hay registros, el usuario no existe. */
	if($num_regs==0){

			/* Si coinciden, guardamos la información en nuestra base de datos. */
			$consulta = "INSERT INTO  `usuario`(`usuario`,`tipo`, `nombre`, `password`, `fecha`,`estado`) VALUES ('$usuario','$tipo_usuario','$nombre', SHA1('$password'), curdate(),$activo)";
			$ejecutar_consulta = $conexion->query(($consulta));
			print $consulta;
			/* Si se ejecutó la consulta, redirigimos al archivo del formulario con una clave de que se ejecutó correctamente. */
			if($ejecutar_consulta){
				header("Location: ../users.php?error=no");
			}
		
	}
	/* Si existen registros, indicamos que el usuario a crear ya existe. */
	else{
			header("Localtion: ../users.php?error=si");
		}
 ?>