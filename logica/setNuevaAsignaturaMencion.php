<?php

require_once('../data/conexion_bd.php');

$nombre = $_POST['name'];
$corta = $_POST['corta'];
$larga = $_POST['larga'];
$profe = $_POST['profe'];
$mencion = $_POST['mencion'];
$codigo = $_POST['code'];
$newUrl = "/tallerapp/images/asignaturas/".$_POST['urlEnvio'];

$consulta = new conexionBD;
$rs1 = $consulta->consultar("INSERT INTO `asig_mencion`(`profesor`, `descripcion_corta`, `descripcion_larga`, `url_imagen`, `mencion_idMencion`, `nombre`, `idCodigo`, `estado`) VALUES ('$profe','$corta','$larga','$newUrl','$mencion','$nombre','$codigo','No Visible')");
$count1 = $rs1->rowCount();

if($count1!=0){
	echo "ok";
}else{
	echo "error";
}

?>