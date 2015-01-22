<?php

require_once('../data/conexion_bd.php');

$tipo = $_POST['tipo'];

switch ($tipo) {
	case 'INFO':
		$nombre = $_POST['nombre'];
		$nombre_esp = $_POST['name_esp'];
		$codigo = $_POST['des_corta'];
		$larga = $_POST['des_larga'];
		$profe = $_POST['new_profe'];
		$search = explode("||", $_POST['busqueda']);
		$consulta = new conexionBD;
		$rs1 = $consulta->consultar("UPDATE `asig_mencion` SET `profesor`='$profe',`descripcion_corta`='$nombre_esp',`descripcion_larga`='$larga',`nombre`='$nombre',`idCodigo`='$codigo' WHERE `nombre`='$search[0]'");
		$count1 = $rs1->rowCount();
		if($count1!=0){
			echo "ok";
		}else{
			echo "error";
		}
		break;
	case 'FOTO':
		$search = explode("||", $_POST['busqueda']);
		$newUrl = "/tallerapp/images/asignaturas/".$_POST['fotoname'];
		$consulta = new conexionBD;
		$rs1 = $consulta->consultar("UPDATE `asig_mencion` SET `url_imagen`='$newUrl' WHERE `nombre`='$search[0]'");
		$count1 = $rs1->rowCount();
		if($count1!=0){
			echo "ok||".$newUrl;
		}else{
			echo "error";
		}
		break;
}

?>