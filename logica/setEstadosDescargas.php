<?php

require_once('../data/conexion_bd.php');

$id_consulta = $_POST['idDownload'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("UPDATE `descargas` SET `estado`='1' WHERE `idDescargas`='$id_consulta'");
$count1 = $rs1->rowCount();

echo $count1;

?>