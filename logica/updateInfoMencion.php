<?php

require_once('../data/conexion_bd.php');

$info = $_POST['descrip'];
$mencion = $_POST['mencion'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("UPDATE `mencion` SET `descrip`='$info' WHERE `idMencion`='$mencion'");
$count1 = $rs1->rowCount();

if($count1!=0){
	echo "ok";
}else{
	echo "error";
}

?>