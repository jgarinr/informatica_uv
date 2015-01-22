<?php

require_once('../data/conexion_bd.php');

$mencion_obtenida = $_POST['mencion'];
$codigo_obtenido = $_POST['code'];
$tipo_obtenido = $_POST['tipo'];
$nombreRamo = $_POST['nombre_ramo'];

$consulta = new conexionBD;

if($tipo_obtenido == "HAB"){
	$rs = $consulta->consultar("UPDATE `asig_mencion` SET `estado`='Visible' WHERE mencion_idMencion='$mencion_obtenida' AND idCodigo='$codigo_obtenido' AND nombre='$nombreRamo'");
}else{
	$rs = $consulta->consultar("UPDATE `asig_mencion` SET `estado`='No Visible' WHERE mencion_idMencion='$mencion_obtenida' AND idCodigo='$codigo_obtenido' AND nombre='$nombreRamo'");
}

$count = $rs->rowCount();
if($count!=0){
	echo "ok";
}else{
	echo "error";
}

?>