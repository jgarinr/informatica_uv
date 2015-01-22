<?php

require_once('../data/conexion_bd.php');

$mencion_obtenida = $_POST['mencion'];

$consulta = new conexionBD;
$rs = $consulta->consultar("SELECT descrip FROM mencion WHERE idMencion='$mencion_obtenida'");
$count = $rs->rowCount();

$record = $rs->fetch(PDO::FETCH_ASSOC);
$resultado = $record['descrip'];
	
echo $resultado;

?>