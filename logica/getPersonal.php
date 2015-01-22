<?php

require_once('../data/conexion_bd.php');

	$consulta = new conexionBD;	
	$rs1 = $consulta->consultar("SELECT `idacademico`, `nombre`, `tipo`, `correo`, `web`, `fono`, `urlfoto` FROM `academico` WHERE `estado`=1");

	while($record1 = $rs1->fetch(PDO::FETCH_ASSOC)){
		echo "<li class='portfolio-item academico'><div class='item-inner'><img src='".$record1['urlfoto']."' ><h5 align='center'>".$record1['nombre']."</h5><div class='overlay'><button class='preview btn btn-danger personal_academico'  id='academico_".$record1['idacademico']."' href='".$record1['urlfoto']."'><i class='fa fa-eye'></i></button></div></div></li>";
	}

	$rs2 = $consulta->consultar("SELECT `nombre`, `correo`, `urlFoto` FROM `ayudante` WHERE `estado`=1");

	while($record2 = $rs2->fetch(PDO::FETCH_ASSOC)){
		echo "<li class='portfolio-item ayudante'><div class='item-inner'><img src='".$record2['urlFoto']."' ><h5 align='center'>".$record2['nombre']."</h5><div class='overlay'><a class='preview btn btn-danger' href='".$record2['urlFoto']."' rel='prettyPhoto' title='".$record2['nombre']."<br>".$record2['correo']."'><i class='fa fa-eye'></i></a></div></div></li>";
	}

	$rs3 = $consulta->consultar("SELECT `nombre`, `cargo`, `correo`, `urlfoto` FROM `administrativo` WHERE `estado`=1");

	while($record3 = $rs3->fetch(PDO::FETCH_ASSOC)){
		echo "<li class='portfolio-item adm'><div class='item-inner'><img src='".$record3['urlfoto']."' ><h5 align='center'>".$record3['nombre']."</h5><div class='overlay'><a class='preview btn btn-danger' href='".$record3['urlfoto']."' rel='prettyPhoto' title='".$record3['nombre']."<br>".$record3['cargo']."<br>".$record3['correo']."'><i class='fa fa-eye'></i></a></div></div></li>";
	}

?>