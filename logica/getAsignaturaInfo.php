<?php

require_once('../data/conexion_bd.php');

$asignatura = $_POST['asignatura'];

$consulta = new conexionBD;
if(!isset($_POST['malla'])){
	$rs = $consulta->consultar("SELECT nombre,descrip,profesor,foto FROM asignatura WHERE numero='$asignatura'");
}else{
	$malla = $_POST['malla'];
	$codigo = $_POST['malla'].$_POST['asignatura'];
	$nombre_obj = str_replace("-", " ", $_POST['nombre_obj']);	
	$rs = $consulta->consultar("SELECT nombre,descrip,profesor,foto FROM asignatura WHERE numero='$asignatura' AND malla_idMalla='$malla'");
	$rs2 = $consulta->consultar("SELECT idobjetivo,descrip,estado FROM objetivo WHERE nombre_asig='$nombre_obj'");
}

$objetivos = "";
while ($record2 = $rs2->fetch(PDO::FETCH_ASSOC)) {
	$objetivos = $objetivos.$record2['idobjetivo']."++";
	$objetivos = $objetivos.$record2['estado']."++";
	$objetivos = $objetivos.$record2['descrip']."|+|";
}

$count = $rs->rowCount();

$record = $rs->fetch(PDO::FETCH_ASSOC);

$resultado = $record['nombre']."||";
$resultado = $resultado.$record['profesor']."||";
$resultado = $resultado.$record['foto']."||";
$resultado = $resultado.$record['descrip']."||".$objetivos;

echo $resultado;

?>