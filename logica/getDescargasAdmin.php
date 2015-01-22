<?php

require_once('../data/conexion_bd.php');

//$malla = $_POST['malla'];
//$ramo = $_POST['ramo'];
$nombre_ramo = $_POST['nombre'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("SELECT titulo,url,abstract,autor,estado,anio,idDescargas FROM descargas WHERE nombre='$nombre_ramo'");
$count1 = $rs1->rowCount();

$aprobados = '';
$no_aprobados = '';
while($record1 = $rs1->fetch(PDO::FETCH_ASSOC)){
	if($record1['estado'] == 0){
		$no_aprobados = $no_aprobados.$record1['titulo']."++";
		$no_aprobados = $no_aprobados.$record1['url']."++";
		$no_aprobados = $no_aprobados.$record1['autor']."++";
		$no_aprobados = $no_aprobados.$record1['anio']."++";
		$no_aprobados = $no_aprobados.$record1['idDescargas']."++";
		$no_aprobados = $no_aprobados.$record1['abstract']."||";
	}
	if($record1['estado'] == 1){
		$aprobados = $aprobados.$record1['titulo']."++";
		$aprobados = $aprobados.$record1['url']."++";
		$aprobados = $aprobados.$record1['autor']."++";
		$aprobados = $aprobados.$record1['anio']."++";
		$aprobados = $aprobados.$record1['idDescargas']."++";
		$aprobados = $aprobados.$record1['abstract']."||";
	}
}

echo $aprobados."|-|".$no_aprobados;

?>