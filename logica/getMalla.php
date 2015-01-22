<?php

require_once('../data/conexion_bd.php');

$var = $_POST['malla'];
switch ($var) {
	case 'ICI':
		mallaICI();
		break;
	case 'IIN':
		mallaIIN();
		break;
	case 'IEJ':
		mallaIEJ();
		break;
	case 'ICIOB':
		mallaICIOB();
		break;
	case 'IINOB':
		mallaIINOB();
		break;
	case 'IEJOB':
		mallaIEJOB();
		break;
	
}


function mallaICI(){ 
		$consulta = new conexionBD;
		$asignaturas = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC'");
		$requisitos = ""; 
		$info_asig = "";
		$res_final = "";

		while($record_asignatura = $asignaturas->fetch(PDO::FETCH_ASSOC)) {
			$info_asig = $info_asig.$record_asignatura['malla_idMalla'].$record_asignatura['numero']."++".$record_asignatura['nombre']."||";
			
			$tmp = $record_asignatura['id'];
			$req = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
			
			while($record_req = $req->fetch(PDO::FETCH_ASSOC)) {	
				$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
			}
			$requisitos = $requisitos."|+|";
		}

		/*$requisitos = $requisitos."|+||+||+||+||+|";
		$requisitos_op = $consulta->consultar("SELECT * FROM `asignatura_has_requisito` WHERE `asignatura_id` between '5' and '62'");
		$control = 0;
		while($record_req = $requisitos_op->fetch(PDO::FETCH_ASSOC)){
			$tmp = $record_req['asignatura_id'];
			if($control == 0){
				$control = $tmp;
				$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
			}else{
				if($control == $tmp){
					$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
				}else{
					$requisitos = $requisitos."|+|";
					$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
					$control = $tmp;
				}
			}

		}*/

		$res_final = $info_asig."|-|".$requisitos;
		
		$consulta = null;
		$asignaturas = null;
		$req = null;
		echo $res_final;
		//echo $info_asig;



		/*$consulta = new conexionBD;
		$s1 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '104'");
		$s2 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '110' and '114'");
		$s3 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '200' and '205'");
		$s4 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '210' and '215'");
		$s5 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '300' and '305'");
		$s6 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '310' and '315'");
		$s7 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '400' and '405'");
		$s8 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '410' and '415'");
		$s9 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '500' and '505'");
		$s10 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '510' and '515'");
		$s11 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '600' and '602'");
		$s12 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '610' and '611'");
		//echo "<tr>";
			//echo "<td>".$sem1['malla_idMalla'].$sem1['numero']." ".$sem1['nombre']."</td>";
			//echo "<td>R: </td>\n";
			//echo "<td>".$sem2['malla_idMalla'].$sem2['numero']." ".$sem2['nombre']."</td>";
			$resultado = " <table class='tabla_malla'>
				  	<tr>
				    <th colspan='3'><a id='year_1' class='btn btn-primary btn-block btn-warning boton_year'>Primer Año</a></th>
				    <th colspan='4'><a id='year_2' class='btn btn-primary btn-block btn-warning boton_year'>Segundo Año</a></th>		
				    <th colspan='4'><a id='year_3' class='btn btn-primary btn-block btn-warning boton_year'>Tercer Año</a></th>
				    <th colspan='4'><a id='year_4' class='btn btn-primary btn-block btn-warning boton_year'>Cuarto Año</a></th>
				    <th colspan='4'><a id='year_5' class='btn btn-primary btn-block btn-warning boton_year'>Quinto Año</a></th>
				    <th colspan='4'><a id='year_6' class='btn btn-primary btn-block btn-warning boton_year'>Sexto Año</a></th>
				  </tr>
				  <tr>
				    <td><a id='sem_1' class='btn btn-primary btn-block btn-danger boton_semestre'>1º Semestre</a></td>
				    <td colspan='2'><a id='sem_2' class='btn btn-primary btn-block btn-danger boton_semestre'>2º Semestre</a></td>		
				    <td colspan='2'><a id='sem_3' class='btn btn-primary btn-block btn-danger boton_semestre'>3º Semestre</a></td>
				    <td colspan='2'><a id='sem_4' class='btn btn-primary btn-block btn-danger boton_semestre'>4º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_5' class='btn btn-primary btn-block btn-danger boton_semestre'>5º Semestre</a></td>
				    <td colspan='2'><a id='sem_6' class='btn btn-primary btn-block btn-danger boton_semestre'>6º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_7' class='btn btn-primary btn-block btn-danger boton_semestre'>7º Semestre</a></td>
				    <td colspan='2'><a id='sem_8' class='btn btn-primary btn-block btn-danger boton_semestre'>8º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_9' class='btn btn-primary btn-block btn-danger boton_semestre'>9º Semestre</a></td>
				    <td colspan='2'><a id='sem_10' class='btn btn-primary btn-block btn-danger boton_semestre'>10º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_11' class='btn btn-primary btn-block btn-danger boton_semestre'>11º Semestre</a></td>
				    <td colspan='2'><a id='sem_12' class='btn btn-primary btn-block btn-danger boton_semestre'>12º Semestre</a></td>	
				  </tr>";
			while($sem3 = $s3->fetch(PDO::FETCH_ASSOC)) {
				$sem4 = $s4->fetch(PDO::FETCH_ASSOC);
				$sem5 = $s5->fetch(PDO::FETCH_ASSOC);
				$sem6 = $s6->fetch(PDO::FETCH_ASSOC);
				$sem7 = $s7->fetch(PDO::FETCH_ASSOC);
				$sem8 = $s8->fetch(PDO::FETCH_ASSOC);
				$sem9 = $s9->fetch(PDO::FETCH_ASSOC);
				$sem10 = $s10->fetch(PDO::FETCH_ASSOC);
				$sem1 = $s1->fetch(PDO::FETCH_ASSOC);
				$sem2 = $s2->fetch(PDO::FETCH_ASSOC);
				$sem11 = $s11->fetch(PDO::FETCH_ASSOC);
				$sem12 = $s12->fetch(PDO::FETCH_ASSOC);
				$resultado = $resultado."<tr>";
				if($sem1){
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_1' id='celdaSem1_".$sem1['malla_idMalla'].$sem1['numero']."||++'>".$sem1['malla_idMalla'].$sem1['numero']."<br>".$sem1['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem1['malla_idMalla']."_".$sem1['numero']."'>Ver Informacion</a></td>";
					$r2 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp2 = "";
					while($rr2 = $r2->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr2['numero']."\n";
						$tmp2 = $tmp2.$rr2['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_2' id='celdaSem2_".$sem2['malla_idMalla'].$sem2['numero']."||".$tmp2."'>".$sem2['malla_idMalla'].$sem2['numero']."<br>".$sem2['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem2['malla_idMalla']."_".$sem2['numero']."'>Ver Informacion</a></td>";
				}else {
					$resultado = $resultado."<td style='border:none;'></td>\n";
					$resultado = $resultado."<td style='border:none;'></td>\n";
					$resultado = $resultado."<td style='border:none;'></td>\n";
				}
				$r3 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp3 = "";
				while($rr3 = $r3->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr3['numero']."\n";
					$tmp3 = $tmp3.$rr3['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_3' id='celdaSem3_".$sem3['malla_idMalla'].$sem3['numero']."||".$tmp3."'>".$sem3['malla_idMalla'].$sem3['numero']."<br>".$sem3['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem3['malla_idMalla']."_".$sem3['numero']."'>Ver Informacion</a></td>";
				$r4 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp4 = "";
				while($rr4 = $r4->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr4['numero']."\n";
					$tmp4 = $tmp4.$rr4['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_4' id='celdaSem4_".$sem4['malla_idMalla'].$sem4['numero']."||".$tmp4."'>".$sem4['malla_idMalla'].$sem4['numero']."<br>".$sem4['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem4['malla_idMalla']."_".$sem4['numero']."'>Ver Informacion</a></td>";
				$r5 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp5 = "";	
					while($rr5 = $r5->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr5['numero']."\n";
						$tmp5 = $tmp5.$rr5['numero']."++";
					}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_5' id='celdaSem5_".$sem5['malla_idMalla'].$sem5['numero']."||".$tmp5."'>".$sem5['malla_idMalla'].$sem5['numero']."<br>".$sem5['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem5['malla_idMalla']."_".$sem5['numero']."'>Ver Informacion</a></td>";
				$r6 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp6 = "";	
					while($rr6 = $r6->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr6['numero']."\n";
						$tmp6 = $tmp6.$rr6['numero']."++";
					}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_6' id='celdaSem6_".$sem6['malla_idMalla'].$sem6['numero']."||".$tmp6."'>".$sem6['malla_idMalla'].$sem6['numero']."<br>".$sem6['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem6['malla_idMalla']."_".$sem6['numero']."'>Ver Informacion</a></td>";
				$r7 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp7 = "";
					while($rr7 = $r7->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr7['numero']."\n";
						$tmp7 = $tmp7.$rr7['numero']."++";
					}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_7' id='celdaSem7_".$sem7['malla_idMalla'].$sem7['numero']."||".$tmp7."'>".$sem7['malla_idMalla'].$sem7['numero']."<br>".$sem7['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem7['malla_idMalla']."_".$sem7['numero']."'>Ver Informacion</a></td>";
				$r8 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp8= "";
					while($rr8 = $r8->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr8['numero']."\n";
						$tmp8 = $tmp8.$rr8['numero']."++";
					}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_8' id='celdaSem8_".$sem8['malla_idMalla'].$sem8['numero']."||".$tmp8."'>".$sem8['malla_idMalla'].$sem8['numero']."<br>".$sem8['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem8['malla_idMalla']."_".$sem8['numero']."'>Ver Informacion</a></td>";
				$r9 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem9[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$count = $r9->rowCount();
				$tmp9 = "";
				if($count > 2){
					$resultado = $resultado."\nAD\nHOC\n";
				}else {
					while($rr9 = $r9->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr9['numero']."\n";
						$tmp9 = $tmp9.$rr9['numero']."++";
					}
					
				}
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_9' id='celdaSem9_".$sem9['malla_idMalla'].$sem9['numero']."||".$tmp9."'>".$sem9['malla_idMalla'].$sem9['numero']."<br>".$sem9['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem9['malla_idMalla']."_".$sem9['numero']."'>Ver Informacion</a></td>";
				$r10 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem10[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$count = $r10->rowCount();
				$tmp10 =  "";
				if($count > 3){
					$resultado = $resultado."\nAD\nHOC\n";
				}else {
					while($rr10 = $r10->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr10['numero']."\n";
						$tmp10 = $tmp10.$rr10['numero']."++";
					}
					
				}
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_10' id='celdaSem10_".$sem10['malla_idMalla'].$sem10['numero']."||".$tmp10."'>".$sem10['malla_idMalla'].$sem10['numero']."<br>".$sem10['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem10['malla_idMalla']."_".$sem10['numero']."'>Ver Informacion</a></td>";
				if($sem11){
					$r11 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem11[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r11->rowCount();
					$tmp11 = "";
					if($count > 2){
						if($sem11['numero'] == 601) $resultado = $resultado."\n5°\nAÑO\nAPR\n";
						else $resultado = $resultado."\nAD\nHOC\n";
					}else {
						while($rr11 = $r11->fetch(PDO::FETCH_ASSOC)){
							$resultado = $resultado."\n".$rr11['numero']."\n";
							$tmp11 = $tmp11.$rr11['numero']."++";
						}
					
					}
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_6 sem_11' id='celdaSem11_".$sem11['malla_idMalla'].$sem11['numero']."||".$tmp11."'>".$sem11['malla_idMalla'].$sem11['numero']."<br>".$sem11['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem11['malla_idMalla']."_".$sem11['numero']."'>Ver Informacion</a></td>";
				}else {
					//$resultado = $resultado."<td> </td>\n";
					//$resultado = $resultado."<td> </td>\n";
				}
				if($sem12){
					$r12 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem12[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp12 = "";
					while($rr12 = $r12->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr12['numero']."\n";
						$tmp12 = $tmp12.$rr12['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_6 sem_12' id='celdaSem12_".$sem12['malla_idMalla'].$sem12['numero']."||".$tmp12."'>".$sem12['malla_idMalla'].$sem12['numero']."<br>".$sem12['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem12['malla_idMalla']."_".$sem12['numero']."'>Ver Informacion</a></td>";
				}else {
					//$resultado = $resultado."<td> </td>\n";
					//$resultado = $resultado."<td> </td>\n";
				}
				$resultado = $resultado."</tr>";
			}

		$consulta = null;
		echo $resultado."</table>";*/
}

function mallaICIOB(){

	$consulta = new conexionBD;
	$asignaturas = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC'");
	$requisitos = ""; 
	$info_asig = "";
	$objet_asig = "";
	$res_final = "";

	while($record_asignatura = $asignaturas->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignatura['malla_idMalla'].$record_asignatura['numero']."++".$record_asignatura['nombre']."||";
		
		$tmp = $record_asignatura['id'];
		$req = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		$objet = $consulta->consultar("SELECT `relacion_cod_malla` FROM `asignatura_has_relacion` WHERE `asignatura_id`='$tmp'");
		
		while($record_objet = $objet->fetch(PDO::FETCH_ASSOC)) {	
			$objet_asig = $objet_asig.substr($record_objet['relacion_cod_malla'], 3)."++";
		}
		$objet_asig = $objet_asig."|.|";

		while($record_req = $req->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}
	$res_final = $info_asig."|-|".$requisitos."|-|".$objet_asig;
	
	$consulta = null;
	$asignaturas = null;
	$req = null;
	echo $res_final;

	/*
		$consulta = new conexionBD;
		$s1 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '104'");
		$s2 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '110' and '114'");
		$s3 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '200' and '205'");
		$s4 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '210' and '215'");
		$s5 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '300' and '305'");
		$s6 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '310' and '315'");
		$s7 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '400' and '405'");
		$s8 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '410' and '415'");
		$s9 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '500' and '505'");
		$s10 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '510' and '515'");
		$s11 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '600' and '602'");
		$s12 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '610' and '611'");
		//echo "<tr>";
			//echo "<td>".$sem1['malla_idMalla'].$sem1['numero']." ".$sem1['nombre']."</td>";
			//echo "<td>R: </td>\n";
			//echo "<td>".$sem2['malla_idMalla'].$sem2['numero']." ".$sem2['nombre']."</td>";
			$resultado = " <table class='tabla_malla'>
				  	<tr>
				    <th colspan='3'><a id='year_1' class='btn btn-primary btn-block btn-warning boton_year'>Primer Año</a></th>
				    <th colspan='4'><a id='year_2' class='btn btn-primary btn-block btn-warning boton_year'>Segundo Año</a></th>		
				    <th colspan='4'><a id='year_3' class='btn btn-primary btn-block btn-warning boton_year'>Tercer Año</a></th>
				    <th colspan='4'><a id='year_4' class='btn btn-primary btn-block btn-warning boton_year'>Cuarto Año</a></th>
				    <th colspan='4'><a id='year_5' class='btn btn-primary btn-block btn-warning boton_year'>Quinto Año</a></th>
				    <th colspan='4'><a id='year_6' class='btn btn-primary btn-block btn-warning boton_year'>Sexto Año</a></th>
				  </tr>
				  <tr>
				    <td><a id='sem_1' class='btn btn-primary btn-block btn-danger boton_semestre'>1º Semestre</a></td>
				    <td colspan='2'><a id='sem_2' class='btn btn-primary btn-block btn-danger boton_semestre'>2º Semestre</a></td>		
				    <td colspan='2'><a id='sem_3' class='btn btn-primary btn-block btn-danger boton_semestre'>3º Semestre</a></td>
				    <td colspan='2'><a id='sem_4' class='btn btn-primary btn-block btn-danger boton_semestre'>4º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_5' class='btn btn-primary btn-block btn-danger boton_semestre'>5º Semestre</a></td>
				    <td colspan='2'><a id='sem_6' class='btn btn-primary btn-block btn-danger boton_semestre'>6º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_7' class='btn btn-primary btn-block btn-danger boton_semestre'>7º Semestre</a></td>
				    <td colspan='2'><a id='sem_8' class='btn btn-primary btn-block btn-danger boton_semestre'>8º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_9' class='btn btn-primary btn-block btn-danger boton_semestre'>9º Semestre</a></td>
				    <td colspan='2'><a id='sem_10' class='btn btn-primary btn-block btn-danger boton_semestre'>10º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_11' class='btn btn-primary btn-block btn-danger boton_semestre'>11º Semestre</a></td>
				    <td colspan='2'><a id='sem_12' class='btn btn-primary btn-block btn-danger boton_semestre'>12º Semestre</a></td>	
				  </tr>";
			while($sem3 = $s3->fetch(PDO::FETCH_ASSOC)) {
				$sem4 = $s4->fetch(PDO::FETCH_ASSOC);
				$sem5 = $s5->fetch(PDO::FETCH_ASSOC);
				$sem6 = $s6->fetch(PDO::FETCH_ASSOC);
				$sem7 = $s7->fetch(PDO::FETCH_ASSOC);
				$sem8 = $s8->fetch(PDO::FETCH_ASSOC);
				$sem9 = $s9->fetch(PDO::FETCH_ASSOC);
				$sem10 = $s10->fetch(PDO::FETCH_ASSOC);
				$sem1 = $s1->fetch(PDO::FETCH_ASSOC);
				$sem2 = $s2->fetch(PDO::FETCH_ASSOC);
				$sem11 = $s11->fetch(PDO::FETCH_ASSOC);
				$sem12 = $s12->fetch(PDO::FETCH_ASSOC);
				$resultado = $resultado."<tr>";
				if($sem1){
					$objetivo1 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem1[id]'");
					$vo1 = "";
					while($res1 = $objetivo1->fetch(PDO::FETCH_ASSOC)){
						$vo1 = $vo1.$res1['numero']."++";
					}
					$objetivo1 = null;
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_1' id='celdaSem1_".$sem1['malla_idMalla'].$sem1['numero']."||".$vo1."'>".$sem1['malla_idMalla'].$sem1['numero']."<br>".$sem1['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem1['malla_idMalla']."_".$sem1['numero']."'>Ver Informacion</a></td>";
					$r2 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp2 = "";
					$objetivo2 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'");
					$vo2 = "";
					while($res2 = $objetivo2->fetch(PDO::FETCH_ASSOC)){
						$vo2 = $vo2.$res2['numero']."++";
					}
					$objetivo2 = null;
					while($rr2 = $r2->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr2['numero']."\n";
						$tmp2 = $tmp2.$rr2['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_2' id='celdaSem2_".$sem2['malla_idMalla'].$sem2['numero']."||".$vo2."'>".$sem2['malla_idMalla'].$sem2['numero']."<br>".$sem2['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem2['malla_idMalla']."_".$sem2['numero']."'>Ver Informacion</a></td>";
					$r2 = null;
				}else {
					$resultado = $resultado."<td style='border:none;'></td>\n";
					$resultado = $resultado."<td style='border:none;'></td>\n";
					$resultado = $resultado."<td style='border:none;'></td>\n";
				}
				$r3 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp3 = "";
				$objetivo3 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'");
					$vo3 = "";
					while($res3 = $objetivo3->fetch(PDO::FETCH_ASSOC)){
						$vo3 = $vo3.$res3['numero']."++";
					}
				$objetivo3 = null;
				while($rr3 = $r3->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr3['numero']."\n";
					$tmp3 = $tmp3.$rr3['numero']."++";
				}
				$r3 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_3' id='celdaSem3_".$sem3['malla_idMalla'].$sem3['numero']."||".$vo3."'>".$sem3['malla_idMalla'].$sem3['numero']."<br>".$sem3['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem3['malla_idMalla']."_".$sem3['numero']."'>Ver Informacion</a></td>";
				$r4 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp4 = "";
				$objetivo4 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'");
					$vo4 = "";
					while($res4 = $objetivo4->fetch(PDO::FETCH_ASSOC)){
						$vo4 = $vo4.$res4['numero']."++";
					}
				$objetivo4 = null;
				while($rr4 = $r4->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr4['numero']."\n";
					$tmp4 = $tmp4.$rr4['numero']."++";
				}
				$r4 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_4' id='celdaSem4_".$sem4['malla_idMalla'].$sem4['numero']."||".$vo4."'>".$sem4['malla_idMalla'].$sem4['numero']."<br>".$sem4['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem4['malla_idMalla']."_".$sem4['numero']."'>Ver Informacion</a></td>";
				$r5 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp5 = "";
				$objetivo5 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'");
					$vo5 = "";
					while($res5 = $objetivo5->fetch(PDO::FETCH_ASSOC)){
						$vo5 = $vo5.$res5['numero']."++";
					}
				$objetivo5 = null;	
					while($rr5 = $r5->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr5['numero']."\n";
						$tmp5 = $tmp5.$rr5['numero']."++";
					}
				$r5 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_5' id='celdaSem5_".$sem5['malla_idMalla'].$sem5['numero']."||".$vo5."'>".$sem5['malla_idMalla'].$sem5['numero']."<br>".$sem5['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem5['malla_idMalla']."_".$sem5['numero']."'>Ver Informacion</a></td>";
				$r6 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp6 = "";
				$objetivo6 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'");
					$vo6 = "";
					while($res6 = $objetivo6->fetch(PDO::FETCH_ASSOC)){
						$vo6 = $vo6.$res6['numero']."++";
					}
				$objetivo6 = null;
					while($rr6 = $r6->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr6['numero']."\n";
						$tmp6 = $tmp6.$rr6['numero']."++";
					}
				$r6 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_6' id='celdaSem6_".$sem6['malla_idMalla'].$sem6['numero']."||".$vo6."'>".$sem6['malla_idMalla'].$sem6['numero']."<br>".$sem6['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem6['malla_idMalla']."_".$sem6['numero']."'>Ver Informacion</a></td>";
				$r7 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp7 = "";
				$objetivo7 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'");
					$vo7 = "";
					while($res7 = $objetivo7->fetch(PDO::FETCH_ASSOC)){
						$vo7 = $vo7.$res7['numero']."++";
					}
				$objetivo7 = null;
					while($rr7 = $r7->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr7['numero']."\n";
						$tmp7 = $tmp7.$rr7['numero']."++";
					}
				$r7 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_7' id='celdaSem7_".$sem7['malla_idMalla'].$sem7['numero']."||".$vo7."'>".$sem7['malla_idMalla'].$sem7['numero']."<br>".$sem7['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem7['malla_idMalla']."_".$sem7['numero']."'>Ver Informacion</a></td>";
				$r8 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp8= "";
				$objetivo8 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'");
					$vo8 = "";
					while($res8 = $objetivo8->fetch(PDO::FETCH_ASSOC)){
						$vo8 = $vo8.$res8['numero']."++";
					}
				$objetivo8 = null;
					while($rr8 = $r8->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr8['numero']."\n";
						$tmp8 = $tmp8.$rr8['numero']."++";
					}
				$r8 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_8' id='celdaSem8_".$sem8['malla_idMalla'].$sem8['numero']."||".$vo8."'>".$sem8['malla_idMalla'].$sem8['numero']."<br>".$sem8['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem8['malla_idMalla']."_".$sem8['numero']."'>Ver Informacion</a></td>";
				$r9 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem9[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$count = $r9->rowCount();
				$tmp9 = "";
				$objetivo9 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem9[id]'");
					$vo9 = "";
					while($res9 = $objetivo9->fetch(PDO::FETCH_ASSOC)){
						$vo9 = $vo9.$res9['numero']."++";
					}
				$objetivo9 = null;
				if($count > 2){
					$resultado = $resultado."\nAD\nHOC\n";
				}else {
					while($rr9 = $r9->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr9['numero']."\n";
						$tmp9 = $tmp9.$rr9['numero']."++";
					}
				}
				$r9 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_9' id='celdaSem9_".$sem9['malla_idMalla'].$sem9['numero']."||".$vo9."'>".$sem9['malla_idMalla'].$sem9['numero']."<br>".$sem9['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem9['malla_idMalla']."_".$sem9['numero']."'>Ver Informacion</a></td>";
				$r10 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem10[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$count = $r10->rowCount();
				$tmp10 =  "";
				$objetivo10 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem10[id]'");
					$vo10 = "";
					while($res10 = $objetivo10->fetch(PDO::FETCH_ASSOC)){
						$vo10 = $vo10.$res10['numero']."++";
					}
				$objetivo10 = null;
				if($count > 3){
					$resultado = $resultado."\nAD\nHOC\n";
				}else {
					while($rr10 = $r10->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr10['numero']."\n";
						$tmp10 = $tmp10.$rr10['numero']."++";
					}
				}
				$r10 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_10' id='celdaSem10_".$sem10['malla_idMalla'].$sem10['numero']."||".$vo10."'>".$sem10['malla_idMalla'].$sem10['numero']."<br>".$sem10['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem10['malla_idMalla']."_".$sem10['numero']."'>Ver Informacion</a></td>";
				if($sem11){
					$r11 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem11[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r11->rowCount();
					$tmp11 = "";
					$objetivo11 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem11[id]'");
					$vo11 = "";
					while($res11 = $objetivo11->fetch(PDO::FETCH_ASSOC)){
						$vo11 = $vo11.$res11['numero']."++";
					}
				$objetivo11 = null;
					if($count > 2){
						if($sem11['numero'] == 601) $resultado = $resultado."\n5°\nAÑO\nAPR\n";
						else $resultado = $resultado."\nAD\nHOC\n";
					}else {
						while($rr11 = $r11->fetch(PDO::FETCH_ASSOC)){
							$resultado = $resultado."\n".$rr11['numero']."\n";
							$tmp11 = $tmp11.$rr11['numero']."++";
						}
					}
				$r11 = null;
				$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_6 sem_11' id='celdaSem11_".$sem11['malla_idMalla'].$sem11['numero']."||".$vo11."'>".$sem11['malla_idMalla'].$sem11['numero']."<br>".$sem11['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem11['malla_idMalla']."_".$sem11['numero']."'>Ver Informacion</a></td>";
				}else {
					//$resultado = $resultado."<td> </td>\n";
					//$resultado = $resultado."<td> </td>\n";
				}
				if($sem12){
					$r12 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem12[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp12 = "";
					$objetivo12 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem12[id]'");
					$vo12 = "";
					while($res12 = $objetivo12->fetch(PDO::FETCH_ASSOC)){
						$vo12 = $vo12.$res12['numero']."++";
					}
				$objetivo12 = null;
					while($rr12 = $r12->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr12['numero']."\n";
						$tmp12 = $tmp12.$rr12['numero']."++";
					}
					$r12 = null;
					$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_6 sem_12' id='celdaSem12_".$sem12['malla_idMalla'].$sem12['numero']."||".$vo12."'>".$sem12['malla_idMalla'].$sem12['numero']."<br>".$sem12['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem12['malla_idMalla']."_".$sem12['numero']."'>Ver Informacion</a></td>";
				}else {
					//$resultado = $resultado."<td> </td>\n";
					//$resultado = $resultado."<td> </td>\n";
				}
				$resultado = $resultado."</tr>";
			}

		$consulta = null;
		echo $resultado."</table>";

		*/
}

function mallaIIN(){

	$consulta = new conexionBD;
	$asignaturas = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN'");
	$asignaturasComun = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '215'");
	$requisitos = ""; 
	$info_asig = "";
	$res_final = "";

	while($record_asignaturaComun = $asignaturasComun->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignaturaComun['malla_idMalla'].$record_asignaturaComun['numero']."++".$record_asignaturaComun['nombre']."||";
		$tmp = $record_asignaturaComun['id'];
		$reqComun = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		
		while($record_reqComun = $reqComun->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_reqComun['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}	


	while($record_asignatura = $asignaturas->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignatura['malla_idMalla'].$record_asignatura['numero']."++".$record_asignatura['nombre']."||";
		
		$tmp = $record_asignatura['id'];
		$req = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		
		while($record_req = $req->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}
	$res_final = $info_asig."|-|".$requisitos;
	
	$consulta = null;
	$asignaturas = null;
	$req = null;
	echo $res_final;

	/*	$consulta = new conexionBD;
		$s1 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '104'");
		$s2 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '110' and '114'");
		$s3 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '200' and '205'");
		$s4 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '210' and '215'");
		$s5 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '300' and '305'");
		$s6 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '310' and '314'");
		$s7 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '400' and '404'");
		$s8 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '410' and '414'");
		$s9 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '500' and '503'");
		$s10 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '510' and '511'");
		$resultado = " <table class='tabla_malla'>
				  	<tr>
				    <th colspan='3'><a id='year_1' class='btn btn-primary btn-block btn-warning boton_year'>Primer Año</a></th>
				    <th colspan='4'><a id='year_2' class='btn btn-primary btn-block btn-warning boton_year'>Segundo Año</a></th>		
				    <th colspan='4'><a id='year_3' class='btn btn-primary btn-block btn-warning boton_year'>Tercer Año</a></th>
				    <th colspan='4'><a id='year_4' class='btn btn-primary btn-block btn-warning boton_year'>Cuarto Año</a></th>
				    <th colspan='4'><a id='year_5' class='btn btn-primary btn-block btn-warning boton_year'>Quinto Año</a></th>
				  </tr>
				  <tr>
				    <td><a id='sem_1' class='btn btn-primary btn-block btn-danger boton_semestre'>1º Semestre</a></td>
				    <td colspan='2'><a id='sem_2' class='btn btn-primary btn-block btn-danger boton_semestre'>2º Semestre</a></td>		
				    <td colspan='2'><a id='sem_3' class='btn btn-primary btn-block btn-danger boton_semestre'>3º Semestre</a></td>
				    <td colspan='2'><a id='sem_4' class='btn btn-primary btn-block btn-danger boton_semestre'>4º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_5' class='btn btn-primary btn-block btn-danger boton_semestre'>5º Semestre</a></td>
				    <td colspan='2'><a id='sem_6' class='btn btn-primary btn-block btn-danger boton_semestre'>6º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_7' class='btn btn-primary btn-block btn-danger boton_semestre'>7º Semestre</a></td>
				    <td colspan='2'><a id='sem_8' class='btn btn-primary btn-block btn-danger boton_semestre'>8º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_9' class='btn btn-primary btn-block btn-danger boton_semestre'>9º Semestre</a></td>
				    <td colspan='2'><a id='sem_10' class='btn btn-primary btn-block btn-danger boton_semestre'>10º Semestre</a></td>	    
				  </tr>";
		while($sem3 = $s3->fetch(PDO::FETCH_ASSOC)) {
				$sem4 = $s4->fetch(PDO::FETCH_ASSOC);
				$sem5 = $s5->fetch(PDO::FETCH_ASSOC);
				$sem6 = $s6->fetch(PDO::FETCH_ASSOC);
				$sem7 = $s7->fetch(PDO::FETCH_ASSOC);
				$sem8 = $s8->fetch(PDO::FETCH_ASSOC);
				$sem9 = $s9->fetch(PDO::FETCH_ASSOC);
				$sem10 = $s10->fetch(PDO::FETCH_ASSOC);
				$sem1 = $s1->fetch(PDO::FETCH_ASSOC);
				$sem2 = $s2->fetch(PDO::FETCH_ASSOC);
				$resultado = $resultado."<tr>";
				if($sem1){
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_1' id='celdaSem1_".$sem1['malla_idMalla'].$sem1['numero']."||++'>".$sem1['malla_idMalla'].$sem1['numero']."<br>".$sem1['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem1['malla_idMalla']."_".$sem1['numero']."'>Ver Informacion</a></td>";
					$r2 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp2 = "";
					while($rr2 = $r2->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr2['numero']."\n";
						$tmp2 = $tmp2.$rr2['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_2' id='celdaSem2_".$sem2['malla_idMalla'].$sem2['numero']."||".$tmp2."'>".$sem2['malla_idMalla'].$sem2['numero']."<br>".$sem2['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem2['malla_idMalla']."_".$sem2['numero']."'>Ver Informacion</a></td>";
				}else {
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
				}
				$r3 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp3 = "";
				while($rr3 = $r3->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr3['numero']."\n";
					$tmp3 = $tmp3.$rr3['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_3' id='celdaSem3_".$sem3['malla_idMalla'].$sem3['numero']."||".$tmp3."'>".$sem3['malla_idMalla'].$sem3['numero']."<br>".$sem3['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem3['malla_idMalla']."_".$sem3['numero']."'>Ver Informacion</a></td>";
				$r4 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp4 = "";
				while($rr4 = $r4->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr4['numero']."\n";
					$tmp4 = $tmp4.$rr4['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_4' id='celdaSem4_".$sem4['malla_idMalla'].$sem4['numero']."||".$tmp4."'>".$sem4['malla_idMalla'].$sem4['numero']."<br>".$sem4['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem4['malla_idMalla']."_".$sem4['numero']."'>Ver Informacion</a></td>";
				$r5 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp5 = "";
					while($rr5 = $r5->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr5['numero']."\n";
						$tmp5 = $tmp5.$rr5['numero']."++";
					}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_5' id='celdaSem5_".$sem5['malla_idMalla'].$sem5['numero']."||".$tmp5."'>".$sem5['malla_idMalla'].$sem5['numero']."<br>".$sem5['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem5['malla_idMalla']."_".$sem5['numero']."'>Ver Informacion</a></td>";
				
				if($sem6){
					$r6 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp6 = "";
					while($rr6 = $r6->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr6['numero']."\n";
						$tmp6 = $tmp6.$rr6['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_6' id='celdaSem6_".$sem6['malla_idMalla'].$sem6['numero']."||".$tmp6."'>".$sem6['malla_idMalla'].$sem6['numero']."<br>".$sem6['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem6['malla_idMalla']."_".$sem6['numero']."'>Ver Informacion</a></td>";
					$r7 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp7 = "";
					while($rr7 = $r7->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr7['numero']."\n";
						$tmp7 = $tmp7.$rr7['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_7' id='celdaSem7_".$sem7['malla_idMalla'].$sem7['numero']."||".$tmp7."'>".$sem7['malla_idMalla'].$sem7['numero']."<br>".$sem7['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem7['malla_idMalla']."_".$sem7['numero']."'>Ver Informacion</a></td>";
					$r8 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp8 = "";
					while($rr8 = $r8->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr8['numero']."\n";
						$tmp8 = $tmp8.$rr8['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_8' id='celdaSem8_".$sem8['malla_idMalla'].$sem8['numero']."||".$tmp8."'>".$sem8['malla_idMalla'].$sem8['numero']."<br>".$sem8['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem8['malla_idMalla']."_".$sem8['numero']."'>Ver Informacion</a></td>";
				}else {
					
				}
				if($sem9){
					$r9 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem9[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r9->rowCount();
					if($count > 1){
						$resultado = $resultado."\n4°\nAÑO\nAPR\n";
					}else {
						$tmp9 = "";
						while($rr9 = $r9->fetch(PDO::FETCH_ASSOC)){
							$resultado = $resultado."\n".$rr9['numero']."\n";
							$tmp9 = $tmp9.$rr9['numero']."++";
						}
					}
					$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_9' id='celdaSem9_".$sem9['malla_idMalla'].$sem9['numero']."||".$tmp9."'>".$sem9['malla_idMalla'].$sem9['numero']."<br>".$sem9['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem9['malla_idMalla']."_".$sem9['numero']."'>Ver Informacion</a></td>";
				}else {
					
				}
				if($sem10){
					$r10 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem10[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r10->rowCount();
					$tmp10 = "";
					while($rr10 = $r10->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr10['numero']."\n";
						$tmp10 = $tmp10.$rr10['numero']."++";
					}
					$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_10' id='celdaSem10_".$sem10['malla_idMalla'].$sem10['numero']."||".$tmp10."'>".$sem10['malla_idMalla'].$sem10['numero']."<br>".$sem10['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem10['malla_idMalla']."_".$sem10['numero']."'>Ver Informacion</a></td>";
				}else {}
					
				$resultado = $resultado."</tr>";
			}
			$consulta = null;
			echo $resultado."</table>";

			*/
}

function mallaIINOB(){

	$consulta = new conexionBD;
	$asignaturas = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN'");
	$asignaturasComun = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '215'");
	$requisitos = ""; 
	$info_asig = "";
	$objet_asig = "";
	$res_final = "";

	while($record_asignaturaComun = $asignaturasComun->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignaturaComun['malla_idMalla'].$record_asignaturaComun['numero']."++".$record_asignaturaComun['nombre']."||";
		$tmp = $record_asignaturaComun['id'];
		$reqComun = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		$objet = $consulta->consultar("SELECT `relacion_cod_malla` FROM `asignatura_has_relacion` WHERE `asignatura_id`='$tmp'");
		
		while($record_objet = $objet->fetch(PDO::FETCH_ASSOC)) {	
			$objet_asig = $objet_asig.substr($record_objet['relacion_cod_malla'], 3)."++";
		}
		$objet_asig = $objet_asig."|.|";
		
		while($record_reqComun = $reqComun->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_reqComun['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}


	while($record_asignatura = $asignaturas->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignatura['malla_idMalla'].$record_asignatura['numero']."++".$record_asignatura['nombre']."||";
		
		$tmp = $record_asignatura['id'];
		$req = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		$objet = $consulta->consultar("SELECT `relacion_cod_malla` FROM `asignatura_has_relacion` WHERE `asignatura_id`='$tmp'");
		
		while($record_objet = $objet->fetch(PDO::FETCH_ASSOC)) {	
			$objet_asig = $objet_asig.substr($record_objet['relacion_cod_malla'], 3)."++";
		}
		$objet_asig = $objet_asig."|.|";

		while($record_req = $req->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}
	$res_final = $info_asig."|-|".$requisitos."|-|".$objet_asig;
	
	$consulta = null;
	$asignaturas = null;
	$req = null;
	echo $res_final;

	/*

		$consulta = new conexionBD;
		$s1 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '104'");
		$s2 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '110' and '114'");
		$s3 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '200' and '205'");
		$s4 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '210' and '215'");
		$s5 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '300' and '305'");
		$s6 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '310' and '314'");
		$s7 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '400' and '404'");
		$s8 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '410' and '414'");
		$s9 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '500' and '503'");
		$s10 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IIN' and numero between '510' and '511'");
		$resultado = " <table class='tabla_malla'>
				  	<tr>
				    <th colspan='3'><a id='year_1' class='btn btn-primary btn-block btn-warning boton_year'>Primer Año</a></th>
				    <th colspan='4'><a id='year_2' class='btn btn-primary btn-block btn-warning boton_year'>Segundo Año</a></th>		
				    <th colspan='4'><a id='year_3' class='btn btn-primary btn-block btn-warning boton_year'>Tercer Año</a></th>
				    <th colspan='4'><a id='year_4' class='btn btn-primary btn-block btn-warning boton_year'>Cuarto Año</a></th>
				    <th colspan='4'><a id='year_5' class='btn btn-primary btn-block btn-warning boton_year'>Quinto Año</a></th>
				  </tr>
				  <tr>
				    <td><a id='sem_1' class='btn btn-primary btn-block btn-danger boton_semestre'>1º Semestre</a></td>
				    <td colspan='2'><a id='sem_2' class='btn btn-primary btn-block btn-danger boton_semestre'>2º Semestre</a></td>		
				    <td colspan='2'><a id='sem_3' class='btn btn-primary btn-block btn-danger boton_semestre'>3º Semestre</a></td>
				    <td colspan='2'><a id='sem_4' class='btn btn-primary btn-block btn-danger boton_semestre'>4º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_5' class='btn btn-primary btn-block btn-danger boton_semestre'>5º Semestre</a></td>
				    <td colspan='2'><a id='sem_6' class='btn btn-primary btn-block btn-danger boton_semestre'>6º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_7' class='btn btn-primary btn-block btn-danger boton_semestre'>7º Semestre</a></td>
				    <td colspan='2'><a id='sem_8' class='btn btn-primary btn-block btn-danger boton_semestre'>8º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_9' class='btn btn-primary btn-block btn-danger boton_semestre'>9º Semestre</a></td>
				    <td colspan='2'><a id='sem_10' class='btn btn-primary btn-block btn-danger boton_semestre'>10º Semestre</a></td>	    
				  </tr>";
		while($sem3 = $s3->fetch(PDO::FETCH_ASSOC)) {
				$sem4 = $s4->fetch(PDO::FETCH_ASSOC);
				$sem5 = $s5->fetch(PDO::FETCH_ASSOC);
				$sem6 = $s6->fetch(PDO::FETCH_ASSOC);
				$sem7 = $s7->fetch(PDO::FETCH_ASSOC);
				$sem8 = $s8->fetch(PDO::FETCH_ASSOC);
				$sem9 = $s9->fetch(PDO::FETCH_ASSOC);
				$sem10 = $s10->fetch(PDO::FETCH_ASSOC);
				$sem1 = $s1->fetch(PDO::FETCH_ASSOC);
				$sem2 = $s2->fetch(PDO::FETCH_ASSOC);
				$resultado = $resultado."<tr>";
				if($sem1){
					$objetivo1 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem1[id]'");
					$vo1 = "";
					while($res1 = $objetivo1->fetch(PDO::FETCH_ASSOC)){
						$vo1 = $vo1.$res1['numero']."++";
					}
					$objetivo1 = null;
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_1' id='celdaSem1_".$sem1['malla_idMalla'].$sem1['numero']."||".$vo1."'>".$sem1['malla_idMalla'].$sem1['numero']."<br>".$sem1['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem1['malla_idMalla']."_".$sem1['numero']."'>Ver Informacion</a></td>";
					$r2 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp2 = "";
					$objetivo2 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'");
					$vo2 = "";
					while($res2 = $objetivo2->fetch(PDO::FETCH_ASSOC)){
						$vo2 = $vo2.$res2['numero']."++";
					}
					$objetivo2 = null;
					while($rr2 = $r2->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr2['numero']."\n";
						$tmp2 = $tmp2.$rr2['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_2' id='celdaSem2_".$sem2['malla_idMalla'].$sem2['numero']."||".$vo2."'>".$sem2['malla_idMalla'].$sem2['numero']."<br>".$sem2['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem2['malla_idMalla']."_".$sem2['numero']."'>Ver Informacion</a></td>";
				}else {
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
				}
				$r3 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp3 = "";
				$objetivo3 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'");
					$vo3 = "";
					while($res3 = $objetivo3->fetch(PDO::FETCH_ASSOC)){
						$vo3 = $vo3.$res3['numero']."++";
					}
					$objetivo3 = null;
				while($rr3 = $r3->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr3['numero']."\n";
					$tmp3 = $tmp3.$rr3['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_3' id='celdaSem3_".$sem3['malla_idMalla'].$sem3['numero']."||".$vo3."'>".$sem3['malla_idMalla'].$sem3['numero']."<br>".$sem3['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem3['malla_idMalla']."_".$sem3['numero']."'>Ver Informacion</a></td>";
				$r4 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp4 = "";
				$objetivo4 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'");
					$vo4 = "";
					while($res4 = $objetivo4->fetch(PDO::FETCH_ASSOC)){
						$vo4 = $vo4.$res4['numero']."++";
					}
					$objetivo4 = null;
				while($rr4 = $r4->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr4['numero']."\n";
					$tmp4 = $tmp4.$rr4['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_4' id='celdaSem4_".$sem4['malla_idMalla'].$sem4['numero']."||".$vo4."'>".$sem4['malla_idMalla'].$sem4['numero']."<br>".$sem4['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem4['malla_idMalla']."_".$sem4['numero']."'>Ver Informacion</a></td>";
				$r5 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp5 = "";
					$objetivo5 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'");
					$vo5 = "";
					while($res5 = $objetivo5->fetch(PDO::FETCH_ASSOC)){
						$vo5 = $vo5.$res5['numero']."++";
					}
					$objetivo5 = null;
					while($rr5 = $r5->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr5['numero']."\n";
						$tmp5 = $tmp5.$rr5['numero']."++";
					}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_5' id='celdaSem5_".$sem5['malla_idMalla'].$sem5['numero']."||".$vo5."'>".$sem5['malla_idMalla'].$sem5['numero']."<br>".$sem5['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem5['malla_idMalla']."_".$sem5['numero']."'>Ver Informacion</a></td>";
				
				if($sem6){
					$r6 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp6 = "";
					$objetivo6 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'");
					$vo6 = "";
					while($res6 = $objetivo6->fetch(PDO::FETCH_ASSOC)){
						$vo6 = $vo6.$res6['numero']."++";
					}
					$objetivo6 = null;
					while($rr6 = $r6->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr6['numero']."\n";
						$tmp6 = $tmp6.$rr6['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_6' id='celdaSem6_".$sem6['malla_idMalla'].$sem6['numero']."||".$vo6."'>".$sem6['malla_idMalla'].$sem6['numero']."<br>".$sem6['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem6['malla_idMalla']."_".$sem6['numero']."'>Ver Informacion</a></td>";
					$r7 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp7 = "";
					$objetivo7 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'");
					$vo7 = "";
					while($res7 = $objetivo7->fetch(PDO::FETCH_ASSOC)){
						$vo7 = $vo7.$res7['numero']."++";
					}
					$objetivo7 = null;
					while($rr7 = $r7->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr7['numero']."\n";
						$tmp7 = $tmp7.$rr7['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_7' id='celdaSem7_".$sem7['malla_idMalla'].$sem7['numero']."||".$vo7."'>".$sem7['malla_idMalla'].$sem7['numero']."<br>".$sem7['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem7['malla_idMalla']."_".$sem7['numero']."'>Ver Informacion</a></td>";
					$r8 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp8 = "";
					$objetivo8 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'");
					$vo8 = "";
					while($res8 = $objetivo8->fetch(PDO::FETCH_ASSOC)){
						$vo8 = $vo8.$res8['numero']."++";
					}
					$objetivo8 = null;
					while($rr8 = $r8->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr8['numero']."\n";
						$tmp8 = $tmp8.$rr8['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_8' id='celdaSem8_".$sem8['malla_idMalla'].$sem8['numero']."||".$vo8."'>".$sem8['malla_idMalla'].$sem8['numero']."<br>".$sem8['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem8['malla_idMalla']."_".$sem8['numero']."'>Ver Informacion</a></td>";
				}else {
					
				}
				if($sem9){
					$r9 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem9[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r9->rowCount();
					$objetivo9 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem9[id]'");
					$vo9 = "";
					while($res9 = $objetivo9->fetch(PDO::FETCH_ASSOC)){
						$vo9 = $vo9.$res9['numero']."++";
					}
					$objetivo9 = null;
					if($count > 1){
						$resultado = $resultado."\n4°\nAÑO\nAPR\n";
					}else {
						$tmp9 = "";
						while($rr9 = $r9->fetch(PDO::FETCH_ASSOC)){
							$resultado = $resultado."\n".$rr9['numero']."\n";
							$tmp9 = $tmp9.$rr9['numero']."++";
						}
					}
					$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_9' id='celdaSem9_".$sem9['malla_idMalla'].$sem9['numero']."||".$vo9."'>".$sem9['malla_idMalla'].$sem9['numero']."<br>".$sem9['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem9['malla_idMalla']."_".$sem9['numero']."'>Ver Informacion</a></td>";
				}else {
					
				}
				if($sem10){
					$r10 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem10[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r10->rowCount();
					$tmp10 = "";
					$objetivo10 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem10[id]'");
					$vo10 = "";
					while($res10 = $objetivo10->fetch(PDO::FETCH_ASSOC)){
						$vo10 = $vo10.$res10['numero']."++";
					}
					$objetivo10 = null;
					while($rr10 = $r10->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr10['numero']."\n";
						$tmp10 = $tmp10.$rr10['numero']."++";
					}
					$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_5 sem_10' id='celdaSem10_".$sem10['malla_idMalla'].$sem10['numero']."||".$vo10."'>".$sem10['malla_idMalla'].$sem10['numero']."<br>".$sem10['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem10['malla_idMalla']."_".$sem10['numero']."'>Ver Informacion</a></td>";
				}else {}
					
				$resultado = $resultado."</tr>";
			}
			$consulta = null;
			echo $resultado."</table>";

			*/
}

function mallaIEJ(){

	$consulta = new conexionBD;
	$asignaturas = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ'");
	$asignaturasComun = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '215'");
	$requisitos = ""; 
	$info_asig = "";
	$res_final = "";

	while($record_asignaturaComun = $asignaturasComun->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignaturaComun['malla_idMalla'].$record_asignaturaComun['numero']."++".$record_asignaturaComun['nombre']."||";
		$tmp = $record_asignaturaComun['id'];
		$reqComun = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		
		while($record_reqComun = $reqComun->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_reqComun['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}	


	while($record_asignatura = $asignaturas->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignatura['malla_idMalla'].$record_asignatura['numero']."++".$record_asignatura['nombre']."||";
		
		$tmp = $record_asignatura['id'];
		$req = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		
		while($record_req = $req->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}
	$res_final = $info_asig."|-|".$requisitos;
	
	$consulta = null;
	$asignaturas = null;
	$req = null;
	echo $res_final;

	/*
		$consulta = new conexionBD;
		$consulta2 = new conexionBD;
		$s1 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '104'");
		$s2 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '110' and '114'");
		$s3 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '200' and '205'");
		$s4 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '210' and '215'");
		$s5 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '300' and '304'");
		$s6 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '310' and '314'");
		$s7 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '400' and '404'");
		$s8 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '410' and '411'");
		//echo "<tr>";
			//echo "<td>".$sem1['malla_idMalla'].$sem1['numero']." ".$sem1['nombre']."</td>";
			//echo "<td>R: </td>\n";
			//echo "<td>".$sem2['malla_idMalla'].$sem2['numero']." ".$sem2['nombre']."</td>";
			$resultado = " <table class='tabla_malla'>
				  	<tr>
				    <th colspan='3'><a id='year_1' class='btn btn-primary btn-block btn-warning boton_year'>Primer Año</a></th>
				    <th colspan='4'><a id='year_2' class='btn btn-primary btn-block btn-warning boton_year'>Segundo Año</a></th>		
				    <th colspan='4'><a id='year_3' class='btn btn-primary btn-block btn-warning boton_year'>Tercer Año</a></th>
				    <th colspan='4'><a id='year_4' class='btn btn-primary btn-block btn-warning boton_year'>Cuarto Año</a></th>
				    </tr>
				  <tr>
				    <td><a id='sem_1' class='btn btn-primary btn-block btn-danger boton_semestre'>1º Semestre</a></td>
				    <td colspan='2'><a id='sem_2' class='btn btn-primary btn-block btn-danger boton_semestre'>2º Semestre</a></td>		
				    <td colspan='2'><a id='sem_3' class='btn btn-primary btn-block btn-danger boton_semestre'>3º Semestre</a></td>
				    <td colspan='2'><a id='sem_4' class='btn btn-primary btn-block btn-danger boton_semestre'>4º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_5' class='btn btn-primary btn-block btn-danger boton_semestre'>5º Semestre</a></td>
				    <td colspan='2'><a id='sem_6' class='btn btn-primary btn-block btn-danger boton_semestre'>6º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_7' class='btn btn-primary btn-block btn-danger boton_semestre'>7º Semestre</a></td>
				    <td colspan='2'><a id='sem_8' class='btn btn-primary btn-block btn-danger boton_semestre'>8º Semestre</a></td>	    
				  </tr>";

			while($sem3 = $s3->fetch(PDO::FETCH_ASSOC)) {
				$sem4 = $s4->fetch(PDO::FETCH_ASSOC);
				$sem5 = $s5->fetch(PDO::FETCH_ASSOC);
				$sem6 = $s6->fetch(PDO::FETCH_ASSOC);
				$sem7 = $s7->fetch(PDO::FETCH_ASSOC);
				$sem8 = $s8->fetch(PDO::FETCH_ASSOC);
				$sem1 = $s1->fetch(PDO::FETCH_ASSOC);
				$sem2 = $s2->fetch(PDO::FETCH_ASSOC);
				$resultado = $resultado."<tr>";
				if($sem1){
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_1' id='celdaSem1_".$sem1['malla_idMalla'].$sem1['numero']."||++'>".$sem1['malla_idMalla'].$sem1['numero']."<br>".$sem1['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem1['malla_idMalla']."_".$sem1['numero']."'>Ver Informacion</a></td>";
					$r2 = $consulta2->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp2 = "";
					while($rr2 = $r2->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr2['numero']."\n";
						$tmp2 = $tmp2.$rr2['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_2' id='celdaSem2_".$sem2['malla_idMalla'].$sem2['numero']."||".$tmp2."'>".$sem2['malla_idMalla'].$sem2['numero']."<br>".$sem2['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem2['malla_idMalla']."_".$sem2['numero']."'>Ver Informacion</a></td>";
				}else {
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
				}
				$r3 = $consulta2->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp3 = "";
				while($rr3 = $r3->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr3['numero']."\n";
					$tmp3 = $tmp3.$rr3['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_3' id='celdaSem3_".$sem3['malla_idMalla'].$sem3['numero']."||".$tmp3."'>".$sem3['malla_idMalla'].$sem3['numero']."<br>".$sem3['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem3['malla_idMalla']."_".$sem3['numero']."'>Ver Informacion</a></td>";
				$r4 = $consulta2->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp4 = "";
				while($rr4 = $r4->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr4['numero']."\n";
					$tmp4 = $tmp4.$rr4['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_4' id='celdaSem4_".$sem4['malla_idMalla'].$sem4['numero']."||".$tmp4."'>".$sem4['malla_idMalla'].$sem4['numero']."<br>".$sem4['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem4['malla_idMalla']."_".$sem4['numero']."'>Ver Informacion</a></td>";
				if($sem5){
					$r5 = $consulta2->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp5 = "";
					while($rr5 = $r5->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr5['numero']."\n";
						$tmp5 = $tmp5.$rr5['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_5' id='celdaSem5_".$sem5['malla_idMalla'].$sem5['numero']."||".$tmp5."'>".$sem5['malla_idMalla'].$sem5['numero']."<br>".$sem5['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem5['malla_idMalla']."_".$sem5['numero']."'>Ver Informacion</a></td>";
					$r6 = $consulta2->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp6 = "";
					while($rr6 = $r6->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr6['numero']."\n";
						$tmp6 = $tmp6.$rr6['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_6' id='celdaSem6_".$sem6['malla_idMalla'].$sem6['numero']."||".$tmp6."'>".$sem6['malla_idMalla'].$sem6['numero']."<br>".$sem6['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem6['malla_idMalla']."_".$sem6['numero']."'>Ver Informacion</a></td>";
					$r7 = $consulta2->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp7 = "";
					while($rr7 = $r7->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr7['numero']."\n";
						$tmp7 = $tmp7.$rr7['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_7' id='celdaSem7_".$sem7['malla_idMalla'].$sem7['numero']."||".$tmp7."'>".$sem7['malla_idMalla'].$sem7['numero']."<br>".$sem7['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem7['malla_idMalla']."_".$sem7['numero']."'>Ver Informacion</a></td>";
				}else{}
				if($sem8){	
					$r8 = $consulta2->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r8->rowCount();
					if($count > 1){
						$resultado = $resultado."\n7°\nSEM\nAPR\n";
					}else {
						$tmp8 = "";
						while($rr8 = $r8->fetch(PDO::FETCH_ASSOC)){
							$resultado = $resultado."\n".$rr8['numero']."\n";
							$tmp8 = $tmp8.$rr8['numero']."++";
						}
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_8' id='celdaSem8_".$sem8['malla_idMalla'].$sem8['numero']."||".$tmp8."'>".$sem8['malla_idMalla'].$sem8['numero']."<br>".$sem8['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem8['malla_idMalla']."_".$sem8['numero']."'>Ver Informacion</a></td>";
				}else {
					
				}
									
				$resultado = $resultado."</tr>";
			}
	
			$consulta = null;
			$consulta2 = null;
			echo $resultado."</table>";

		*/
}

function mallaIEJOB(){

	$consulta = new conexionBD;
	$asignaturas = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ'");
	$asignaturasComun = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '215'");
	$requisitos = ""; 
	$info_asig = "";
	$objet_asig = "";
	$res_final = "";

	while($record_asignaturaComun = $asignaturasComun->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignaturaComun['malla_idMalla'].$record_asignaturaComun['numero']."++".$record_asignaturaComun['nombre']."||";
		$tmp = $record_asignaturaComun['id'];
		$reqComun = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		$objet = $consulta->consultar("SELECT `relacion_cod_malla` FROM `asignatura_has_relacion` WHERE `asignatura_id`='$tmp'");
		
		while($record_objet = $objet->fetch(PDO::FETCH_ASSOC)) {	
			$objet_asig = $objet_asig.substr($record_objet['relacion_cod_malla'], 3)."++";
		}
		$objet_asig = $objet_asig."|.|";
		
		while($record_reqComun = $reqComun->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_reqComun['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}

	while($record_asignatura = $asignaturas->fetch(PDO::FETCH_ASSOC)) {
		$info_asig = $info_asig.$record_asignatura['malla_idMalla'].$record_asignatura['numero']."++".$record_asignatura['nombre']."||";
		
		$tmp = $record_asignatura['id'];
		$req = $consulta->consultar("SELECT `requisito_cod_malla` FROM `asignatura_has_requisito` WHERE `asignatura_id`='$tmp'");
		$objet = $consulta->consultar("SELECT `relacion_cod_malla` FROM `asignatura_has_relacion` WHERE `asignatura_id`='$tmp'");
		
		while($record_objet = $objet->fetch(PDO::FETCH_ASSOC)) {	
			$objet_asig = $objet_asig.substr($record_objet['relacion_cod_malla'], 3)."++";
		}
		$objet_asig = $objet_asig."|.|";

		while($record_req = $req->fetch(PDO::FETCH_ASSOC)) {	
			$requisitos = $requisitos.substr($record_req['requisito_cod_malla'], 3)."++";
		}
		$requisitos = $requisitos."|+|";
	}
	$res_final = $info_asig."|-|".$requisitos."|-|".$objet_asig;
	
	$consulta = null;
	$asignaturas = null;
	$req = null;
	echo $res_final;

	/*

		$consulta = new conexionBD;
		$s1 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '100' and '104'");
		$s2 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '110' and '114'");
		$s3 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '200' and '205'");
		$s4 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='INC' and numero between '210' and '215'");
		$s5 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '300' and '304'");
		$s6 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '310' and '314'");
		$s7 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '400' and '404'");
		$s8 = $consulta->consultar("SELECT id, malla_idMalla, numero, nombre from asignatura where malla_idMalla='IEJ' and numero between '410' and '411'");
		//echo "<tr>";
			//echo "<td>".$sem1['malla_idMalla'].$sem1['numero']." ".$sem1['nombre']."</td>";
			//echo "<td>R: </td>\n";
			//echo "<td>".$sem2['malla_idMalla'].$sem2['numero']." ".$sem2['nombre']."</td>";
			$resultado = " <table class='tabla_malla'>
				  	<tr>
				    <th colspan='3'><a id='year_1' class='btn btn-primary btn-block btn-warning boton_year'>Primer Año</a></th>
				    <th colspan='4'><a id='year_2' class='btn btn-primary btn-block btn-warning boton_year'>Segundo Año</a></th>		
				    <th colspan='4'><a id='year_3' class='btn btn-primary btn-block btn-warning boton_year'>Tercer Año</a></th>
				    <th colspan='4'><a id='year_4' class='btn btn-primary btn-block btn-warning boton_year'>Cuarto Año</a></th>
				    </tr>
				  <tr>
				    <td><a id='sem_1' class='btn btn-primary btn-block btn-danger boton_semestre'>1º Semestre</a></td>
				    <td colspan='2'><a id='sem_2' class='btn btn-primary btn-block btn-danger boton_semestre'>2º Semestre</a></td>		
				    <td colspan='2'><a id='sem_3' class='btn btn-primary btn-block btn-danger boton_semestre'>3º Semestre</a></td>
				    <td colspan='2'><a id='sem_4' class='btn btn-primary btn-block btn-danger boton_semestre'>4º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_5' class='btn btn-primary btn-block btn-danger boton_semestre'>5º Semestre</a></td>
				    <td colspan='2'><a id='sem_6' class='btn btn-primary btn-block btn-danger boton_semestre'>6º Semestre</a></td>	    
				    <td colspan='2'><a id='sem_7' class='btn btn-primary btn-block btn-danger boton_semestre'>7º Semestre</a></td>
				    <td colspan='2'><a id='sem_8' class='btn btn-primary btn-block btn-danger boton_semestre'>8º Semestre</a></td>	    
				  </tr>";

			while($sem3 = $s3->fetch(PDO::FETCH_ASSOC)) {
				$sem4 = $s4->fetch(PDO::FETCH_ASSOC);
				$sem5 = $s5->fetch(PDO::FETCH_ASSOC);
				$sem6 = $s6->fetch(PDO::FETCH_ASSOC);
				$sem7 = $s7->fetch(PDO::FETCH_ASSOC);
				$sem8 = $s8->fetch(PDO::FETCH_ASSOC);
				$sem1 = $s1->fetch(PDO::FETCH_ASSOC);
				$sem2 = $s2->fetch(PDO::FETCH_ASSOC);
				$resultado = $resultado."<tr>";
				if($sem1){
					$objetivo1 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem1[id]'");
					$vo1 = "";
					while($res1 = $objetivo1->fetch(PDO::FETCH_ASSOC)){
						$vo1 = $vo1.$res1['numero']."++";
					}
					$objetivo1 = null;
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_1' id='celdaSem1_".$sem1['malla_idMalla'].$sem1['numero']."||".$vo1."'>".$sem1['malla_idMalla'].$sem1['numero']."<br>".$sem1['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem1['malla_idMalla']."_".$sem1['numero']."'>Ver Informacion</a></td>";
					$r2 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp2 = "";
					$objetivo2 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem2[id]'");
					$vo2 = "";
					while($res2 = $objetivo2->fetch(PDO::FETCH_ASSOC)){
						$vo2 = $vo2.$res2['numero']."++";
					}
					$objetivo2 = null;
					while($rr2 = $r2->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr2['numero']."\n";
						$tmp2 = $tmp2.$rr2['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_1 sem_2' id='celdaSem2_".$sem2['malla_idMalla'].$sem2['numero']."||".$vo2."'>".$sem2['malla_idMalla'].$sem2['numero']."<br>".$sem2['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem2['malla_idMalla']."_".$sem2['numero']."'>Ver Informacion</a></td>";
				}else {
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
					$resultado = $resultado."<td> </td>\n";
				}
				$r3 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp3 = "";
				$objetivo3 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem3[id]'");
					$vo3 = "";
					while($res3 = $objetivo3->fetch(PDO::FETCH_ASSOC)){
						$vo3 = $vo3.$res3['numero']."++";
					}
					$objetivo3 = null;
				while($rr3 = $r3->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr3['numero']."\n";
					$tmp3 = $tmp3.$rr3['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_3' id='celdaSem3_".$sem3['malla_idMalla'].$sem3['numero']."||".$vo3."'>".$sem3['malla_idMalla'].$sem3['numero']."<br>".$sem3['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem3['malla_idMalla']."_".$sem3['numero']."'>Ver Informacion</a></td>";
				$r4 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'"); 
				$resultado = $resultado."<td class='requisito_celda'>R:";
				$tmp4 = "";
				$objetivo4 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem4[id]'");
					$vo4 = "";
					while($res4 = $objetivo4->fetch(PDO::FETCH_ASSOC)){
						$vo4 = $vo4.$res4['numero']."++";
					}
					$objetivo4 = null;
				while($rr4 = $r4->fetch(PDO::FETCH_ASSOC)){
					$resultado = $resultado."\n".$rr4['numero']."\n";
					$tmp4 = $tmp4.$rr4['numero']."++";
				}$resultado = $resultado."</td>\n";
				$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_2 sem_4' id='celdaSem4_".$sem4['malla_idMalla'].$sem4['numero']."||".$vo4."'>".$sem4['malla_idMalla'].$sem4['numero']."<br>".$sem4['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem4['malla_idMalla']."_".$sem4['numero']."'>Ver Informacion</a></td>";
				if($sem5){
					$r5 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp5 = "";
					$objetivo5 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem5[id]'");
					$vo5 = "";
					while($res5 = $objetivo5->fetch(PDO::FETCH_ASSOC)){
						$vo5 = $vo5.$res5['numero']."++";
					}
					$objetivo5 = null;
					while($rr5 = $r5->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr5['numero']."\n";
						$tmp5 = $tmp5.$rr5['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_5' id='celdaSem5_".$sem5['malla_idMalla'].$sem5['numero']."||".$vo5."'>".$sem5['malla_idMalla'].$sem5['numero']."<br>".$sem5['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem5['malla_idMalla']."_".$sem5['numero']."'>Ver Informacion</a></td>";
					$r6 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp6 = "";
					$objetivo6 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem6[id]'");
					$vo6 = "";
					while($res6 = $objetivo6->fetch(PDO::FETCH_ASSOC)){
						$vo6 = $vo6.$res6['numero']."++";
					}
					$objetivo6 = null;
					while($rr6 = $r6->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr6['numero']."\n";
						$tmp6 = $tmp6.$rr6['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_3 sem_6' id='celdaSem6_".$sem6['malla_idMalla'].$sem6['numero']."||".$vo6."'>".$sem6['malla_idMalla'].$sem6['numero']."<br>".$sem6['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem6['malla_idMalla']."_".$sem6['numero']."'>Ver Informacion</a></td>";
					$r7 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$tmp7 = "";
					$objetivo7 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem7[id]'");
					$vo7 = "";
					while($res7 = $objetivo7->fetch(PDO::FETCH_ASSOC)){
						$vo7 = $vo7.$res7['numero']."++";
					}
					$objetivo7 = null;
					while($rr7 = $r7->fetch(PDO::FETCH_ASSOC)){
						$resultado = $resultado."\n".$rr7['numero']."\n";
						$tmp7 = $tmp7.$rr7['numero']."++";
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_7' id='celdaSem7_".$sem7['malla_idMalla'].$sem7['numero']."||".$vo7."'>".$sem7['malla_idMalla'].$sem7['numero']."<br>".$sem7['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem7['malla_idMalla']."_".$sem7['numero']."'>Ver Informacion</a></td>";
				}else{}
				if($sem8){	
					$r8 = $consulta->consultar("select r.numero from requisito as r join asignatura as asig join asignatura_has_requisito as a where a.requisito_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'"); 
					$resultado = $resultado."<td class='requisito_celda'>R:";
					$count = $r8->rowCount();
					$objetivo8 = $consulta->consultar("select r.numero from relacion as r join asignatura as asig join asignatura_has_relacion as a where a.relacion_cod_malla=r.cod_malla and asig.id=a.asignatura_id and asig.id='$sem8[id]'");
					$vo8 = "";
					while($res8 = $objetivo8->fetch(PDO::FETCH_ASSOC)){
						$vo8 = $vo8.$res8['numero']."++";
					}
					$objetivo8 = null;
					if($count > 1){
						$resultado = $resultado."\n7°\nSEM\nAPR\n";
					}else {
						$tmp8 = "";
						while($rr8 = $r8->fetch(PDO::FETCH_ASSOC)){
							$resultado = $resultado."\n".$rr8['numero']."\n";
							$tmp8 = $tmp8.$rr8['numero']."++";
						}
					}$resultado = $resultado."</td>\n";
					$resultado = $resultado."<td><div class='caja_celda caja_no_pintada year_4 sem_8' id='celdaSem8_".$sem8['malla_idMalla'].$sem8['numero']."||".$vo8."'>".$sem8['malla_idMalla'].$sem8['numero']."<br>".$sem8['nombre']."</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='".$sem8['malla_idMalla']."_".$sem8['numero']."'>Ver Informacion</a></td>";
				}else {
					
				}
									
				$resultado = $resultado."</tr>";
			}
	
			$consulta = null;
			echo $resultado."</table>";

		*/
}

?>