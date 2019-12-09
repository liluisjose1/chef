<?php
	ob_start();
	include("../config/conexion.php");

	$usuario = $_POST["user_txt"];
	$password = $_POST["password"];
	$consulta = "SELECT usuario, nombre,tipo FROM usuario WHERE usuario='$usuario' AND password=SHA1('$password')";
	$ejecutar_consulta= $conexion->query($consulta);
	$user = mysqli_fetch_row($ejecutar_consulta);
	//print_r($user);


	if ($user){
		session_start();
		$_SESSION["autentificado"]=true;
		$_SESSION["usuario"]=$user[0];
		$_SESSION["nombre"]=$user[1];
		$_SESSION["tipo"]=$user[2];
		setcookie("sesion",$_SESSION["autentificado"],time()+3600,"/");

		if ($_SESSION["tipo"]==1) {
			header("Location: ../dashboard.php");
		}
		else if ($_SESSION["tipo"]==2) {
			header("Location: ../supplies.php");
		}
		else if ($_SESSION["tipo"]==3) {
			header("Location: ../atencion.php");
		}
		else if ($_SESSION["tipo"]==4) {
			header("Location: ../caja.php");
		}
	}
	else
	{
		header("Location: ../index.php?error=si");
	}

?>