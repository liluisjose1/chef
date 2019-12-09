<?php
	function conectarse()
	{
		$servidor 	=	 "localhost";
		$usuario 	=	 "root";
		$password 	=	 "";
		$bd 		=	 "chef_gusteau";

		$conectar = new mysqli($servidor, $usuario, $password, $bd);
			$conectar->query("SET NAMES utf8");
			// NO afectará a $mysqli->real_escape_string();
			$conectar->query("SET CHARACTER SET utf8");
			// Pero esto sí afectará a $mysqli->real_escape_string();
			$conectar->set_charset('utf8');
			// Y esto NO le afectará (utf-8 frente a utf8) -- no emplee guiones aquí
			$conectar->set_charset('utf-8');
			return $conectar;
	}

	$conexion = conectarse();
?>
