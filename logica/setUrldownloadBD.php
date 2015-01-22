<?php

include('../data/conexion_bd.php');

$consulta = new conexionBD;
$asignatura = $_POST['ramo'];
$nombres_archivos = $_POST['name'];
$nombre_ramo = $_POST['nombre_ramo'];

$nombres = explode("||",$nombres_archivos);
$cant_nombres = count($nombres)-1;
$temp = 0;
$url = "../static/documentos/".date("Y")."/";;

for ($i=0; $i < $cant_nombres; $i++) { 
	$datos = explode(".", $nombres[$i]);
	$data1 = $datos[0];
	$urldef = $url.$nombres[$i];
	$year = date('Y');
	$rs = $consulta->consultar("INSERT INTO `descargas` (`idDescargas`, `titulo`, `url`, `abstract`, `anio`, `estado`, `idCodigo`, `autor`,`nombre`) VALUES (NULL, '$data1', '$urldef' , 'Sin Comentarios', '$year','0', '$asignatura', 'Sin Autor','$nombre_ramo')");
	$count = $rs->rowCount();
}

?>