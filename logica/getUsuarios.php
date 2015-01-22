<?php

require_once('../data/conexion_bd.php');

$consulta = new conexionBD;
$rs = $consulta->consultar("SELECT `rut`, `nombre`, `apellido`, `mail`, `nickname` FROM `usuario_administrador` WHERE `tipo`='admin'");

$respuesta = "";
while ($record = $rs->fetch(PDO::FETCH_ASSOC)) {
	$respuesta = $respuesta.$record['rut']."++".$record['nombre']."++".$record['apellido']."++".$record['mail']."++".$record['nickname']."||";
}

echo $respuesta;

?>