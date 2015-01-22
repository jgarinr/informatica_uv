<?php

require_once('../data/conexion_bd.php');

$consulta = new conexionBD;
$rs = $consulta->consultar("SELECT `nombre`,`numero`,`malla_idMalla`,`semestre_semestre` FROM `asignatura` WHERE academico_idacademico IS NULL GROUP BY nombre ORDER BY `asignatura`.`numero` ASC");
//$rs1 = $consulta->consultar("SELECT `nombre`,`numero`,`malla_idMalla`,`semestre_semestre` FROM `asignatura` WHERE academico_idacademico IS NULL AND `malla_idMalla`='IIN'");
//$rs2= $consulta->consultar("SELECT `nombre`,`numero`,`malla_idMalla`,`semestre_semestre` FROM `asignatura` WHERE academico_idacademico IS NULL AND `malla_idMalla`='IEJ'");
$rs3 = $consulta->consultar("SELECT nombre, idCodigo, mencion_idMencion FROM asig_mencion WHERE academico_idacademico IS NULL");

$asigICI = "";
$asigIIN = "";
$asigIEJ = "";
$asig_m = "";

while($record = $rs->fetch(PDO::FETCH_ASSOC)){
	$asigICI = $asigICI.$record['nombre']."++".$record['numero']."++".$record['malla_idMalla']."++".$record['semestre_semestre']."||";
}

/*while($record1 = $rs1->fetch(PDO::FETCH_ASSOC)){
	$asigIIN = $asigIIN.$record1['nombre']."++".$record1['numero']."++".$record1['malla_idMalla']."++".$record1['semestre_semestre']."||";
}

while($record2 = $rs2->fetch(PDO::FETCH_ASSOC)){
	$asigIEJ = $asigIEJ.$record2['nombre']."++".$record2['numero']."++".$record2['malla_idMalla']."++".$record2['semestre_semestre']."||";
}*/

while($record3 = $rs3->fetch(PDO::FETCH_ASSOC)){
	$asig_m = $asig_m.$record3['nombre']."++".$record3['idCodigo']."++".$record3['mencion_idMencion']."||";
}

//$respuesta = $asigICI."|+|".$asigIIN."|+|".$asigIEJ."|+|".$asig_m;
$respuesta = $asigICI."|+|".$asig_m;
echo $respuesta;

?>