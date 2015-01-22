<?php

require_once('../data/conexion_bd.php');

$id_consulta = $_POST['idDownload'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("SELECT titulo,abstract,autor FROM descargas WHERE idDescargas='$id_consulta'");
$count1 = $rs1->rowCount();

$record1 = $rs1->fetch(PDO::FETCH_ASSOC);

$resultado = $record1['titulo']."||";
$resultado = $resultado.$record1['abstract']."||";
$resultado = $resultado.$record1['autor'];

echo $resultado;

?>