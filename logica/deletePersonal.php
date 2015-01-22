<?php

require_once('../data/conexion_bd.php');

$tipo = $_POST['tipo'];
$iDs = $_POST['idPer'];

switch ($tipo) {
	case 'Ayudante':
		deleteAyudante($iDs);
	break;
	case 'Adm':
		deleteAdm($iDs);
	break;
	case 'Academico':
		deleteAcademico($iDs);
	break;
	
}

function deleteAyudante($id){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("DELETE FROM `ayudante` WHERE `idayudante`='$id'");
	$count = $rs->rowCount();

	if($count == 0){
		echo "error";
	}else{
		echo "ok";
	}	
}

function deleteAdm($id){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("DELETE FROM `administrativo` WHERE `idadministrativo`='$id'");
	$count = $rs->rowCount();

	if($count == 0){
		echo "error";
	}else{
		echo "ok";
	}	
}

function deleteAcademico($id){
	$consulta = new conexionBD;
	$rs1 = $consulta->consultar("DELETE FROM `titulo` WHERE `academico_idacademico`='$id'");
	$rs2 = $consulta->consultar("DELETE FROM `area_trabajo_academico` WHERE `academico_idacademico`='$id'");
	$rs3 = $consulta->consultar("UPDATE `asignatura` SET `academico_idacademico`= NULL WHERE `academico_idacademico`='$id'");
	$rs4 = $consulta->consultar("UPDATE `asig_mencion` SET `academico_idacademico`= NULL WHERE `academico_idacademico`='$id'");
	$rs5 = $consulta->consultar("DELETE FROM `academico` WHERE `idacademico`='$id'");
	
	$count1 = $rs1->rowCount();
	$count2 = $rs2->rowCount();
	$count3 = $rs3->rowCount();
	$count4 = $rs3->rowCount();
	$count5 = $rs3->rowCount();

	if($count1 == 0 && $count2 == 0 && $count3 == 0 && $count4 == 0 && $count5 == 0){
		echo "error";
	}else{
		echo "ok";
	}	
}

?>