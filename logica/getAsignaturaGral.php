<?php

require_once('../data/conexion_bd.php');

$malla = $_POST['malla'];
$numero = $_POST['number'];
$name_asignatura = $_POST['asig'];

$codigo = $malla.$numero;

$consulta = new conexionBD;
$rs = $consulta->consultar("SELECT nombre,semestre_semestre FROM asignatura WHERE numero='$numero' AND malla_idMalla='$malla' ");
$rs1 = $consulta->consultar("SELECT titulo,url,abstract,autor FROM descargas WHERE nombre='$name_asignatura' AND estado=1 AND anio='".date("Y")."' ");
$rs2 = $consulta->consultar("SELECT anio FROM descargas WHERE nombre='$name_asignatura' AND estado=1 GROUP BY anio DESC");
$count = $rs->rowCount();
$count1 = $rs1->rowCount();
$count2 = $rs2->rowCount();

$control_no_download = 0;
while ($count1 == 0 && $control_no_download<=5) {
	$fecha = date('Y');
	$nuevafecha = strtotime ( '-1 year' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y' , $nuevafecha );
	$rs1 = $consulta->consultar("SELECT titulo,url,abstract,autor FROM descargas WHERE nombre='$name_asignatura' AND estado=1 AND anio='".$nuevafecha."' ");
	$count1 = $rs1->rowCount();
	$control_no_download = $control_no_download + 1;
}

$record = $rs->fetch(PDO::FETCH_ASSOC);
$periodos = "";
$descargas = "";

if($control_no_download != 5){
	while($record2 = $rs2->fetch(PDO::FETCH_ASSOC)){
		$periodos = $periodos.$record2['anio']."++";
	}

	while($record1 = $rs1->fetch(PDO::FETCH_ASSOC)){
		$descargas = $descargas.$record1['titulo']."++";
		$descargas = $descargas.$record1['url']."++";
		$descargas = $descargas.$record1['abstract']."++";
		$descargas = $descargas.$record1['autor']."|+|";
	}
}

$respuesta = $record['nombre']."||";
$respuesta = $respuesta.$periodos."||";
$respuesta = $respuesta.$record['semestre_semestre']."||";
$respuesta = $respuesta.$descargas."";

echo $respuesta;

?>