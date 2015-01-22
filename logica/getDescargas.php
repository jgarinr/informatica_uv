<?php

require_once('../data/conexion_bd.php');

$codigo = $_POST['codigoRamo'];
$periodo = $_POST['year'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("SELECT titulo,url,abstract,autor FROM descargas WHERE idCodigo='$codigo' AND estado=1 AND anio='$periodo'");
$count1 = $rs1->rowCount();

$resultado = '';
while($record1 = $rs1->fetch(PDO::FETCH_ASSOC)){
	$resultado = $resultado.$record1['titulo']."++";
	$resultado = $resultado.$record1['url']."++";
	$resultado = $resultado.$record1['autor']."++";
	$resultado = $resultado.$record1['abstract']."||";
}

echo $resultado;

?>