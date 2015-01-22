<?php

require_once('../data/conexion_bd.php');

$id_consulta = $_POST['idDownload'];
$nuevo_titulo = $_POST['title'];
$nuevo_autor = $_POST['autor'];
$nuevo_abstract = $_POST['coment'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("UPDATE descargas SET titulo='$nuevo_titulo', abstract='$nuevo_autor', autor='$nuevo_abstract' WHERE idDescargas='$id_consulta'");
$count1 = $rs1->rowCount();

echo $count1;

?>