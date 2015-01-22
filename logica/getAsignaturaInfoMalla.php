<?php

require_once('../data/conexion_bd.php');

$consulta = new conexionBD;
$asignatura = $_POST['asignatura'];
$malla = $_POST['malla'];
$codigo = $_POST['malla'].$_POST['asignatura'];
$nombre_obj = str_replace("-", " ", $_POST['nombresearch']);

$rs = $consulta->consultar("SELECT nombre,descrip,profesor,foto,semestre_semestre FROM asignatura WHERE numero='$asignatura' AND malla_idMalla='$malla'");
$rs2 = $consulta->consultar("SELECT descrip FROM objetivo WHERE nombre_asig='$nombre_obj' AND estado='visible'");

$count = $rs->rowCount();
$objetives = "";
while ($record2 = $rs2->fetch(PDO::FETCH_ASSOC)) {
	$objetives = $objetives.$record2['descrip']."++";
}

$record = $rs->fetch(PDO::FETCH_ASSOC);

$resultado = $record['nombre']."||";
$resultado = $resultado.$record['profesor']."||";
$resultado = $resultado.$record['foto']."||";
$resultado = $resultado.$record['semestre_semestre']."||";
$resultado = $resultado.$record['descrip']."||".$objetives;

echo $resultado;

?>