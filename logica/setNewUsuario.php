<?php

require_once('../data/conexion_bd.php');

$nombre = $_POST['first'];
$apellido = $_POST['last'];
$rut = $_POST['rut'];
$correo = $_POST['correo'];
$apodo = $_POST['apodo'];

$contraseña = explode("-", $_POST['rut']);

$consulta = new conexionBD;
$rs2 = $consulta->consultar("SELECT * FROM `usuario_administrador` WHERE rut='$rut'");
$count2 = $rs2->rowCount();

if($count2 !=0){
	echo "existe";
}else{
	$rs1 = $consulta->consultar("INSERT INTO `usuario_administrador`(`rut`, `nombre`, `apellido`, `mail`, `password`, `nickname`, `tipo`) VALUES ('$rut','$nombre','$apellido','$correo','$contraseña[0]','$apodo','admin')");
	$count1 = $rs1->rowCount();

	if($count1 == 0){
		echo "error";
	}else{
		echo "ok";
	}
}

?>