<?php

require_once('../data/conexion_bd.php');

$nuevos_datos = $_POST['data'];
$asignatura = $_POST['ramo'];
$tipo = $_POST['tipo'];

$consulta = new conexionBD;
		if($tipo == "foto"){
			$nuevos_datos = "/informatica_uv/images/asignaturas/".$nuevos_datos;
			$rs = $consulta->consultar("UPDATE asignatura SET $tipo = '$nuevos_datos' WHERE nombre='$asignatura'");
		}else{
			$rs = $consulta->consultar("UPDATE asignatura SET $tipo = '$nuevos_datos' WHERE nombre='$asignatura'");
		}
		$count = $rs->rowCount();
		if($count == 0){
			echo "error";
		}else{
			if($tipo == "foto"){
				echo "ok||".$nuevos_datos;
			}else{
				echo "ok";
			}
		}


?>