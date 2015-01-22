<?php

$path = "../images/asignaturas/";
if (!is_dir($path)){
 	mkdir($path,0777,true);
 	chmod($path, 0777);
}

$comprobar = '';

foreach ($_FILES as $key) {
	$nombre = $key['name'];
	$temporal = $key['tmp_name'];
	$destino = $path.$nombre;
	move_uploaded_file($temporal,$destino);
		
	if($key['error']==''){
		$comprobar = "ok";
	}
	if($key['error']!=''){
		$comprobar = "no";
	}
}
	echo $comprobar;


?>