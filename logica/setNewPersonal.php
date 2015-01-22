<?php

require_once('../data/conexion_bd.php');

$tipo = $_POST['tipoPersonal'];

switch ($tipo) {
	case 'ayudante':
		$name = $_POST['nombreAyu'];
		$correo = $_POST['correoAyu'];
		$sexo = $_POST['sexoAyu'];
		$foto = $_POST['fotoAyu'];		
		insertAyudante($name,$correo,$sexo,$foto);
	break;
	case 'adm':
		$name = $_POST['nombreAdm'];
		$cargo = $_POST['cargoAdm'];
		$correo = $_POST['correoAdm'];
		$sexo = $_POST['sexoAdm'];
		$foto = $_POST['fotoAdm'];		
		insertAdm($name,$cargo,$correo,$sexo,$foto);
	break;
	case 'academico':
		$name = $_POST['nombreAca'];
		$tipo = $_POST['tipoAca'];
		$correo = $_POST['correoAca'];
		$web = $_POST['webAca'];
		$sexo = $_POST['sexoAca'];
		$foto = $_POST['fotoAca'];
		$fono = $_POST['fonoAca'];
		$titulo = $_POST['titulosAca'];
		$area = $_POST['areasAca'];
		$asignatura = $_POST['asigAca'];
		$asignatura_m = $_POST['asig_mAca'];
		insertAcademico($name,$tipo,$correo,$web,$sexo,$foto,$fono,$titulo,$area,$asignatura,$asignatura_m);
	break;
	
}

function insertAyudante($nombre_ayudante,$correo_ayudante,$sexo_ayudante,$foto_ayudante){
	$consulta = new conexionBD;
	
	$rs1 = $consulta->consultar("SELECT * FROM `ayudante` WHERE `nombre`='$nombre_ayudante'");
	$rs2 = $consulta->consultar("SELECT * FROM `ayudante` WHERE `correo`='$correo_ayudante'");	
	$count1 = $rs1->rowCount();
	$count2 = $rs2->rowCount();

	if($count1 == 1 || $count1 == 1){
		echo "existe";
		return false;
	}

	if($foto_ayudante == "sin_foto"){
		if($sexo_ayudante == "M"){
			$rs = $consulta->consultar("INSERT INTO `ayudante`(`idayudante`, `nombre`, `correo`, `urlFoto`, `estado`) VALUES (NULL,'$nombre_ayudante','$correo_ayudante','/tallerapp/images/personas/no_foto_male.jpg',1)");
		}else{
			$rs = $consulta->consultar("INSERT INTO `ayudante`(`idayudante`, `nombre`, `correo`, `urlFoto`, `estado`) VALUES (NULL,'$nombre_ayudante','$correo_ayudante','/tallerapp/images/personas/no_foto_female.jpg',1)");
		}
	}else{
		$rs = $consulta->consultar("INSERT INTO `ayudante`(`idayudante`, `nombre`, `correo`, `urlFoto`, `estado`) VALUES (NULL,'$nombre_ayudante','$correo_ayudante','/tallerapp/images/personas/$foto_ayudante',1)");
	}

	$count = $rs->rowCount();
	if($count == 0){
		echo "error";
	}else{
		echo "ok";
	}
}

function insertAdm($nombre_administrativo,$cargo_administrativo,$correo_administrativo,$sexo_administrativo,$foto_administrativo){
	$consulta = new conexionBD;
	
	$rs1 = $consulta->consultar("SELECT * FROM `administrativo` WHERE `nombre`='$nombre_administrativo'");
	$rs2 = $consulta->consultar("SELECT * FROM `administrativo` WHERE `correo`='$correo_administrativo'");	
	$count1 = $rs1->rowCount();
	$count2 = $rs2->rowCount();

	if($count1 == 1 || $count1 == 1){
		echo "existe";
		return false;
	}

	if($foto_administrativo == "sin_foto"){
		if($sexo_administrativo == "M"){
			$rs = $consulta->consultar("INSERT INTO `administrativo`(`idadministrativo`, `nombre`, `cargo`, `correo`, `urlfoto`, `estado`) VALUES (NULL,'$nombre_administrativo', '$cargo_administrativo','$correo_administrativo','/tallerapp/images/personas/no_foto_male.jpg',1)");
		}else{
			$rs = $consulta->consultar("INSERT INTO `administrativo`(`idadministrativo`, `nombre`, `cargo`, `correo`, `urlfoto`, `estado`) VALUES (NULL,'$nombre_administrativo', '$cargo_administrativo','$correo_administrativo','/tallerapp/images/personas/no_foto_female.jpg',1)");
		}
	}else{
		$rs = $consulta->consultar("INSERT INTO `administrativo`(`idadministrativo`, `nombre`, `cargo`, `correo`, `urlfoto`, `estado`) VALUES (NULL,'$nombre_administrativo', '$cargo_administrativo','$correo_administrativo','/tallerapp/images/personas/$foto_administrativo',1)");
	}

	$count = $rs->rowCount();
	if($count == 0){
		echo "error";
	}else{
		echo "ok";
	}
}

//insertAcademico($name,$tipo,$correo,$web,$sexo,$foto,$fono,$titulo,$area,$asignatura,$asignatura_m);
function insertAcademico($var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11){
	$consulta = new conexionBD;
	
	$rs1 = $consulta->consultar("SELECT * FROM `academico` WHERE `nombre`='$var1'");
	$rs2 = $consulta->consultar("SELECT * FROM `academico` WHERE `correo`='$var3'");	
	$count1 = $rs1->rowCount();
	$count2 = $rs2->rowCount();

	if($count1 == 1 || $count1 == 1){
		echo "existe";
		return false;
	}

	if($var6 == "sin_foto"){
		if($var5 == "M"){
			$rs = $consulta->consultar("INSERT INTO `academico`(`idacademico`, `nombre`, `tipo`, `correo`, `web`, `fono`, `urlfoto`, `estado`) VALUES (NULL,'$var1','$var2','$var3','$var4','$var7','/tallerapp/images/personas/no_foto_male.jpg',1)");
		}else{
			$rs = $consulta->consultar("INSERT INTO `academico`(`idacademico`, `nombre`, `tipo`, `correo`, `web`, `fono`, `urlfoto`, `estado`) VALUES (NULL,'$var1','$var2','$var3','$var4','$var7','/tallerapp/images/personas/no_foto_female.jpg',1)");
		}
	}else{
		$rs = $consulta->consultar("INSERT INTO `academico`(`idacademico`, `nombre`, `tipo`, `correo`, `web`, `fono`, `urlfoto`, `estado`) VALUES (NULL,'$var1','$var2','$var3','$var4','$var7','/tallerapp/images/personas/$var5',1)");
	}	

	$rs4 = $consulta->consultar("SELECT `idacademico` FROM `academico` WHERE `nombre`='$var1'");
	$record = $rs4->fetch(PDO::FETCH_ASSOC);
	$id_encontrado = $record['idacademico'];

	$titulos_tmp = explode("||", $var8);
	$areas_tmp = explode("||", $var9);
	$asig_tmp = explode("||", $var10);
	$asig_m_tmp = explode("||", $var11);

	for ($i=0; $i < sizeof($titulos_tmp)-1 ; $i++){ 
		$rs3 = $consulta->consultar("INSERT INTO `titulo`(`idtitulo`, `titulo`, `academico_idacademico`) VALUES (NULL,'".$titulos_tmp[$i]."','$id_encontrado')");			
	}

	for ($i=0; $i < sizeof($areas_tmp)-1 ; $i++){
		$rs5 = $consulta->consultar("INSERT INTO `area_trabajo_academico`(`idarea_trabajo_academico`, `area`, `academico_idacademico`) VALUES (NULL,'".$areas_tmp[$i]."','$id_encontrado');");			
	}

	if($var10 != ""){
		for ($i=0; $i < sizeof($asig_tmp)-1 ; $i++){ 
			$rs6 = $consulta->consultar("UPDATE `asignatura` SET `academico_idacademico`= '$id_encontrado' WHERE `nombre`='".$asig_tmp[$i]."' ");			
		}
	}

	if($var11 != ""){
		for ($i=0; $i < sizeof($asig_m_tmp)-1 ; $i++){ 
			$rs7 = $consulta->consultar("UPDATE `asig_mencion` SET `academico_idacademico`='$id_encontrado' WHERE `nombre`='".$asig_m_tmp[$i]."'");			
		}
	}

	$count = $rs->rowCount();
	if($count == 0){
		echo "error";
	}else{
		echo "ok";
	}	

}

?>