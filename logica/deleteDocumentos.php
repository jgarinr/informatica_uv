<?php

require_once('../data/conexion_bd.php');

$idDoc = $_POST['idEliminar'];

$consulta = new conexionBD;

$rs2 = $consulta->consultar("SELECT `url` FROM `descargas` WHERE idDescargas='$idDoc'");
$record2 = $rs2->fetch(PDO::FETCH_ASSOC);

if(unlink($record2['url'])){
	$rs1 = $consulta->consultar("DELETE FROM descargas WHERE idDescargas='$idDoc'");	
	$count1 = $rs1->rowCount();
	echo $count1;
}else{
	echo 0;
}

?>