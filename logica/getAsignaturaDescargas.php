<?php

require_once('../data/conexion_bd.php');

$malla = $_POST['malla'];

switch ($malla) {
	case 'comun':
		echo malla_comun();
		break;
	case 'ICI':
		echo malla_ICI();
		break;
	case 'IIN':
		echo malla_IIN();
		break;
	case 'IEJ':
		echo malla_IEJ();
		break;
}

function malla_comun(){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT `nombre`, `numero`, `malla_idMalla`,`semestre_semestre` FROM `asignatura` WHERE `semestre_semestre`<=4");
	$resultado = "<option value='0' style='display:none;'>Seleccione</option>";
	$control = false;
	$fase_sem = 0;
	while($record = $rs->fetch(PDO::FETCH_ASSOC)){
		if($record['semestre_semestre']>$fase_sem){
			if($record['semestre_semestre']==1){
				$resultado = $resultado."<optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}else{
				$resultado = $resultado."</optgroup><optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}
		}
		if($record['numero']!=205 && $record['numero']!=215){
			$resultado = $resultado."<option value='".$record['malla_idMalla']."_".$record['numero']."_".str_replace(' ', '-',$record['nombre'])."'>".$record['nombre']."</option>";
		}
	}
	$resultado = $resultado."</optgroup>";
	return  $resultado;
}

function malla_ICI(){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT `nombre`, `numero`, `malla_idMalla`,`semestre_semestre` FROM `asignatura` WHERE `semestre_semestre`>4 AND `malla_idMalla`='INC'");
	$resultado = "<option value='0' style='display:none;'>Seleccione</option>";
	$control = false;
	$fase_sem = 4;
	while($record = $rs->fetch(PDO::FETCH_ASSOC)){
		if($record['semestre_semestre']>$fase_sem){
			if($record['semestre_semestre']==5){
				$resultado = $resultado."<optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}else{
				$resultado = $resultado."</optgroup><optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}
		}
		$resultado = $resultado."<option value='".$record['malla_idMalla']."_".$record['numero']."_".str_replace(' ', '-',$record['nombre'])."'>".$record['nombre']."</option>";
	}
	$resultado = $resultado."</optgroup>";
	return  $resultado;
}

function malla_IIN(){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT `nombre`, `numero`, `malla_idMalla`,`semestre_semestre` FROM `asignatura` WHERE `semestre_semestre`>4 AND `malla_idMalla`='IIN'");
	$resultado = "<option value='0' style='display:none;'>Seleccione</option>";
	$control = false;
	$fase_sem = 4;
	while($record = $rs->fetch(PDO::FETCH_ASSOC)){
		if($record['semestre_semestre']>$fase_sem){
			if($record['semestre_semestre']==5){
				$resultado = $resultado."<optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}else{
				$resultado = $resultado."</optgroup><optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}
		}
		$resultado = $resultado."<option value='".$record['malla_idMalla']."_".$record['numero']."_".str_replace(' ', '-',$record['nombre'])."'>".$record['nombre']."</option>";
	}
	$resultado = $resultado."</optgroup>";
	return  $resultado;
}

function malla_IEJ(){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT `nombre`, `numero`, `malla_idMalla`,`semestre_semestre` FROM `asignatura` WHERE `semestre_semestre`>4 AND `malla_idMalla`='IEJ'");
	$resultado = "<option value='0' style='display:none;'>Seleccione</option>";
	$control = false;
	$fase_sem = 4;
	while($record = $rs->fetch(PDO::FETCH_ASSOC)){
		if($record['semestre_semestre']>$fase_sem){
			if($record['semestre_semestre']==5){
				$resultado = $resultado."<optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}else{
				$resultado = $resultado."</optgroup><optgroup label='Semestre ".$record['semestre_semestre']."'>";
				$fase_sem = $record['semestre_semestre'];
			}
		}
		$resultado = $resultado."<option value='".$record['malla_idMalla']."_".$record['numero']."_".str_replace(' ', '-',$record['nombre'])."'>".$record['nombre']."</option>";
	}
	$resultado = $resultado."</optgroup>";
	return  $resultado;
}


?>