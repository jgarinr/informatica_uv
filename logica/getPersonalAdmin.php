<?php

require_once('../data/conexion_bd.php');

$var = $_POST['obtener'];
switch ($var) {
	case 'tabla':
		armarTabla();
	break;
	case 'ayudante':
		$idSend = $_POST['idPerson'];
		infoAyudante($idSend);
	break;
	case 'administrativo':
		$idSend = $_POST['idPerson'];
		infoAdministrativo($idSend);
	break;
}

function armarTabla(){
	$consulta = new conexionBD;	
	$rs1 = $consulta->consultar("SELECT `idacademico`, `nombre` FROM `academico`");

	$per_academico = "";
	while($record1 = $rs1->fetch(PDO::FETCH_ASSOC)){
		$per_academico = $per_academico.$record1['idacademico']."++".$record1['nombre']."||";
	}
	$per_academico = $per_academico."|+|";

	$rs2 = $consulta->consultar("SELECT `idayudante`, `nombre` FROM `ayudante`");
	$per_ayudante = "";
	while($record2 = $rs2->fetch(PDO::FETCH_ASSOC)){
		$per_ayudante = $per_ayudante.$record2['idayudante']."++".$record2['nombre']."||";
	}
	$per_ayudante = $per_ayudante."|+|";

	$rs3 = $consulta->consultar("SELECT `idadministrativo`, `nombre` FROM `administrativo`");
	$per_administrativo = "";
	while($record3 = $rs3->fetch(PDO::FETCH_ASSOC)){
		$per_administrativo = $per_administrativo.$record3['idadministrativo']."++".$record3['nombre']."||";
	}

	$resultado = $per_academico.$per_ayudante.$per_administrativo;
	echo $resultado;
}

function infoAyudante($id_ayudante){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT `nombre`, `correo`, `urlFoto`, `estado` FROM `ayudante` WHERE `idayudante`='$id_ayudante'");
	$record = $rs->fetch(PDO::FETCH_ASSOC);
	echo $record['nombre']."++".$record['correo']."++".$record['urlFoto']."++".$record['estado'];	
}

function infoAdministrativo($id_administrativo){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT `nombre`, `cargo`, `correo`, `urlfoto`, `estado` FROM `administrativo` WHERE `idadministrativo`='$id_administrativo' ");
	$record = $rs->fetch(PDO::FETCH_ASSOC);
	echo $record['nombre']."++".$record['cargo']."++".$record['correo']."++".$record['urlfoto']."++".$record['estado'];	
}


?>