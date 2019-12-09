<?php
require('../admin/config/conexion.php');

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$mensaje = $_POST["mensaje"];


$sql="INSERT INTO reservas_online VALUES (NULL,'$nombre','$email','$tel','$mensaje','$fecha $hora')";
$ejecutar = $conexion->query($sql);

if($ejecutar){
    header( 'Location: ../index.php?error=no' );
}else{
    header( 'Location: ../index.php?error=si' );

}
?>