<?php

require_once('../data/conexion_bd.php');

$linea = $_POST['mencion'];
$codigo = $_POST['code'];
$name = $_POST['nombre_ramo'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("DELETE FROM `asig_mencion` WHERE mencion_idMencion='$linea' AND nombre='$name' AND idCodigo='$codigo'");
$count1 = $rs1->rowCount();

if($count1!=0){
	echo "ok";
}else{
	echo "error";
}

?>