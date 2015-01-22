<?php

require_once('../data/conexion_bd.php');

$mencion_obtenida = $_POST['mencion'];

$consulta = new conexionBD;
$rs = $consulta->consultar("SELECT * FROM asig_mencion WHERE mencion_idMencion='$mencion_obtenida'");
$count = $rs->rowCount();

$resultado = "";
while($record = $rs->fetch(PDO::FETCH_ASSOC)){
	$resultado = $resultado.$record['nombre']."||";
	$resultado = $resultado.$record['descripcion_corta']."||";
	$resultado = $resultado.$record['descripcion_larga']."||";
	$resultado = $resultado.$record['profesor']."||";
	$resultado = $resultado.$record['idCodigo']."||";
	$resultado = $resultado.$record['estado']."|+|";
	
}
echo $resultado;

?>