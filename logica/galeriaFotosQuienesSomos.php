<?php

$files = array_diff( scandir("../images/personas"), array(".", "..") );
$respuesta = "";
for ($i=2; $i < sizeof($files)+2; $i++) { 
	$respuesta = $respuesta."/informatica_uv/images/personas/".$files[$i]."||";
}

echo $respuesta;


?>