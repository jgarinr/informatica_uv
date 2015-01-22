<?php

require_once('../data/conexion_bd.php');

$nombre = $_POST['name_change'];
$url = $_POST['newUrl'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("UPDATE `asignatura` SET `foto`='$url' WHERE `nombre`='$nombre'");
$rs2 = $consulta->consultar("UPDATE `asig_mencion` SET `url_imagen`='$url' WHERE `nombre`='$nombre'");

?>