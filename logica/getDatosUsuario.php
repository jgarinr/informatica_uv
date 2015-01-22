<?php

require_once('../data/conexion_bd.php');

$rut = $_POST['rut'];

$consulta = new conexionBD;
$rs = $consulta->consultar("SELECT nombre,apellido,mail,password,nickname,rut FROM usuario_administrador WHERE rut='$rut'");
$count = $rs->rowCount();

$record = $rs->fetch(PDO::FETCH_ASSOC);

$resultado = $record['nombre']."||";
$resultado = $resultado.$record['apellido']."||";
$resultado = $resultado.$record['mail']."||";
$resultado = $resultado.$record['password']."||";
$resultado = $resultado.$record['rut']."||";
$resultado = $resultado.$record['nickname'];

echo $resultado;


?>