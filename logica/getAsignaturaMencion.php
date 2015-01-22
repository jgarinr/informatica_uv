<?php

require_once('../data/conexion_bd.php');

$mencion = $_POST['mencion'];

switch ($mencion) {
	case 'redes':
		echo getAsigRedes();
		break;	
	case 'software':
		echo getAsigSw();
		break;

	case 'database':
		echo getAsigBD();
		break;
	case 'informacion':
		echo obtenerInfoRamoMencion($_POST['codigo'],$_POST['linea'],$_POST['nom']);
		break;
	case 'foto':
		echo obtenerFotoMencion($_POST['codigo'],$_POST['linea'],$_POST['nom']);
		break;
}


function getAsigRedes(){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT profesor,descripcion_corta,nombre,idCodigo,url_imagen FROM asig_mencion WHERE mencion_idMencion='RED' AND estado='Visible'");
	$count = $rs->rowCount();

	$respuesta = "";

	while($record = $rs->fetch(PDO::FETCH_ASSOC)){
		$respuesta = $respuesta.$record['profesor']."++";
		$respuesta = $respuesta.$record['descripcion_corta']."++";
		$respuesta = $respuesta.$record['nombre']."++";
		$respuesta = $respuesta.$record['url_imagen']."++";
		$respuesta = $respuesta.$record['idCodigo']."||";
	}

	return $respuesta;

}

function getAsigSw(){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT profesor,descripcion_corta,nombre,idCodigo,url_imagen FROM asig_mencion WHERE mencion_idMencion='SOF' AND estado='Visible'");
	$count = $rs->rowCount();

	$respuesta = "";

	while($record = $rs->fetch(PDO::FETCH_ASSOC)){
		$respuesta = $respuesta.$record['profesor']."++";
		$respuesta = $respuesta.$record['descripcion_corta']."++";
		$respuesta = $respuesta.$record['nombre']."++";
		$respuesta = $respuesta.$record['url_imagen']."++";
		$respuesta = $respuesta.$record['idCodigo']."||";
	}

	return $respuesta;	
}

function getAsigBD(){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT profesor,descripcion_corta,nombre,idCodigo,url_imagen FROM asig_mencion WHERE mencion_idMencion='BD' AND estado='Visible'");
	$count = $rs->rowCount();

	$respuesta = "";

	while($record = $rs->fetch(PDO::FETCH_ASSOC)){
		$respuesta = $respuesta.$record['profesor']."++";
		$respuesta = $respuesta.$record['descripcion_corta']."++";
		$respuesta = $respuesta.$record['nombre']."++";
		$respuesta = $respuesta.$record['url_imagen']."++";
		$respuesta = $respuesta.$record['idCodigo']."||";
	}

	return $respuesta;
}

function obtenerInfoRamoMencion($codigo,$mencion,$nombre){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT profesor,descripcion_larga,nombre,url_imagen,descripcion_corta,idCodigo FROM asig_mencion WHERE mencion_idMencion='$mencion' AND idCodigo='$codigo' AND nombre='$nombre'");
	$count = $rs->rowCount();

	$record = $rs->fetch(PDO::FETCH_ASSOC);
	$respuesta = $record['descripcion_corta']."++";
	$respuesta = $respuesta.$record['nombre']."++";
	$respuesta = $respuesta.$record['descripcion_larga']."++";
	$respuesta = $respuesta.$record['profesor']."++";
	$respuesta = $respuesta.$record['idCodigo']."++";
	$respuesta = $respuesta.$record['url_imagen'];
	
	return $respuesta;	
}

function obtenerFotoMencion($codigo,$mencion,$nombre){
	$consulta = new conexionBD;
	$rs = $consulta->consultar("SELECT url_imagen FROM asig_mencion WHERE mencion_idMencion='$mencion' AND idCodigo='$codigo' AND nombre='$nombre'");
	$count = $rs->rowCount();

	$record = $rs->fetch(PDO::FETCH_ASSOC);
	$respuesta = $record['url_imagen'];
	
	return $respuesta;
}

?>