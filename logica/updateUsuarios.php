<?php

require_once('../data/conexion_bd.php');
$funcion = $_POST['funcion'];
switch ($funcion) {
	case 'update':
		$rut = $_POST['rut'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['correo'];
		$nick = $_POST['nick'];
		updateUsuario($rut,$nombre,$apellido,$email,$nick);
		break;
	case 'delete':
		$tmp = $_POST['rut'];
		deleteUsuario($tmp);
		break;
}

function updateUsuario($rut_in,$nombre_in,$apellido_in,$email_in,$nick_in){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("UPDATE `usuario_administrador` SET `rut`='$rut_in',`nombre`='$nombre_in',`apellido`='$apellido_in',`mail`='$email_in',`nickname`='$nick_in' WHERE `rut`='$rut_in'");
	$count = $rs->rowCount();
	if($count == 0){
		echo "error";
	}else{
		echo "ok";
	}
}

function deleteUsuario($rut_in){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("DELETE FROM `usuario_administrador` WHERE `rut`='$rut_in'");
	$count = $rs->rowCount();
	if($count == 0){
		echo "error";
	}else{
		echo "ok";
	}
}

?>