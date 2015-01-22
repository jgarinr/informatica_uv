<?php

require_once('../data/conexion_bd.php');

$tipo = $_POST['tipopersona'];
$idPer = $_POST['idAyu'];
$url_foto = $_POST['newUrl'];

switch ($tipo) {
	case 'AYU':
		foto_ayudante($url_foto,$idPer);	
	break;
	case 'ACA':
		
	break;
	case 'ADM':
		
	break;	
}

function foto_ayudante($foto, $idpersona){
	$consulta = new conexionBD;
	$rs1 = $consulta->consultar("UPDATE `ayudante` SET `urlFoto`='$foto' WHERE `idayudante`='$idpersona'");
}

?>