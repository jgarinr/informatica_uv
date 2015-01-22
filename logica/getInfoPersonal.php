<?php

require_once('../data/conexion_bd.php');

$id_academico = $_POST['idsent'];

$consulta = new conexionBD;	
$rs1 = $consulta->consultar("SELECT `nombre`, `tipo`, `correo`, `web`, `fono`, `urlfoto` FROM `academico` WHERE `idacademico`='$id_academico'");
$rs2 = $consulta->consultar("SELECT `titulo` FROM `titulo` WHERE `academico_idacademico`='$id_academico'");
$rs3 = $consulta->consultar("SELECT `area` FROM `area_trabajo_academico` WHERE `academico_idacademico`='$id_academico'");
$rs4 = $consulta->consultar("SELECT `nombre` FROM `asignatura` WHERE `academico_idacademico`='$id_academico' GROUP BY `nombre`");
$rs5 = $consulta->consultar("SELECT `nombre` FROM `asig_mencion` WHERE `academico_idacademico`='$id_academico'");

$record1 = $rs1->fetch(PDO::FETCH_ASSOC);
$datos_personales = $record1['nombre']."++".$record1['tipo']."++".$record1['correo']."++".$record1['web']."++".$record1['fono']."++".$record1['urlfoto']."||";

$titulos = "";
while($record2 = $rs2->fetch(PDO::FETCH_ASSOC)){
	$titulos = $titulos.$record2['titulo']."++";
}
$titulos = $titulos."||";

$areas = "";
while($record3 = $rs3->fetch(PDO::FETCH_ASSOC)){
	$areas = $areas.$record3['area']."++";
}
$areas = $areas."||";

$asignaturas = "";
while($record4 = $rs4->fetch(PDO::FETCH_ASSOC)){
	$asignaturas = $asignaturas.$record4['nombre']."++";
}
$asignaturas = $asignaturas."||";

$asig_mencion = "";
while($record5 = $rs5->fetch(PDO::FETCH_ASSOC)){
	$asig_mencion = $asig_mencion.$record5['nombre']."++";
}

$envio = $datos_personales.$titulos.$areas.$asignaturas.$asig_mencion;

echo $envio;

?>