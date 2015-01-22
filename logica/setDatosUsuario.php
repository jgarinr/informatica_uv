<?php

require_once('../data/conexion_bd.php');

$nuevos_datos = $_POST['data'];
$rut = $_POST['rut'];
$tipo = $_POST['tipo'];

$consulta = new conexionBD;

		$rs = $consulta->consultar("UPDATE usuario_administrador SET $tipo = '$nuevos_datos' WHERE rut = '$rut'");		
		$count = $rs->rowCount();
		if($count == 0){
			echo 0;
		}else{
			echo 1;
		}


?>