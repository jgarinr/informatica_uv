<?php

$var = explode("_", $_POST['tipoMalla']);
$datos = $_POST['llevar_malla'];

$estilo = "<html><head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
	<style>
	body {
	  padding-top: 80px;
	  <!--color: #34495e;>
	  background: #f5f5f5;
	  font-family: 'Roboto', sans-serif;
	  font-weight: 300;
	}
	#header{text-align: center;}
	.caja_celda{
		font-size: 10px;
		padding: 6px;
		border-radius: 10px;
		width: 115px;
		height: 90px;
		text-align: center;
	}

	.requisito_celda{
		font-size: 12px;
	}

	.btn-block {
		width: 100%;
		padding-right: 0;
		padding-left: 0;
	}

	.btn-warning {
		color: #fff;
		background-color: #f0ad4e;
		border-color: #eea236;
	}

	.btn-danger {
		color: #fff;
		background-color: #d9534f;
		border-color: #d43f3a;
	}

	.btn {
		display: inline-block;
		padding: 6px 12px;
		margin-bottom: 0;
		font-size: 14px;
		font-weight: normal;
		line-height: 1.428571429;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		cursor: pointer;
		border: 1px solid transparent;
		border-radius: 4px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		-o-user-select: none;
		user-select: none;
	}

	.boton_ver_info_asignatura{
		display:none;
	}

	.caja_no_pintada{
	  border: 1px solid #75889B;
	}	

	.caja_pintada {
		background-color: #2ecc71;
		color: #f5f5f5;
	}

	.caja_click {
		color: #fff;
		background-color: #f0ad4e;
	}

	.caja_avance {
		background-color: #81DAF5;
	}

	.boton_year{
		background: #f5f5f5;
		color:#fff;background-color:#f0ad4e;border-color:#eea236;
	}
	.boton_semestre{
		color:#fff;background-color:#d9534f;border-color:#d43f3a;
	}
	</style>
	</head>";
	
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	switch ($var[0]) {
		case 'ICI':
			$dompdf->set_paper("c2","landscape");
			if($var[1]=="SIM"){
				$dompdf->load_html($estilo."<body>".utf8_encode("<img src='../images/pdf/logo_uv.png'><img src='../images/pdf/header_decom.png'  style='position: absolute; right: 420px;'><h1 align='center'>Simulador de Avance Académico: Ingeniería Civil en Informática<br>Realizado el ".date("d/m/Y").' - '.date("H:i:s")."</h1>".utf8_decode($datos)).utf8_encode("<br><h1>OBJETIVO</h1><p>Esta aplicación tiene por objetivo simular el avance académico de un alumno para que pueda visualizar su estado actual y futuro.</p><h1>INDICACIONES</h1><p>Los colores representan lo siguiente:</p><ul><li><strong>SIN PINTAR:</strong> Son las asignaturas no consideradas en la simulación</li><li><strong>NARANJA:</strong> Son las asignaturas que son objeto de simulación</li><li><strong>VERDES:</strong> Son las asignaturas necesarias para poder cursar las asignaturas pintadas en naranjo</li><li><strong>CELESTE:</strong> Son las asignaturas que se pueden inscribir si es que se han aprobado las asignaturas en naranjo</li></ul>")."</body></html>");
			}else{
				$dompdf->load_html($estilo."<body>".utf8_encode("<img src='../images/pdf/logo_uv.png'><img src='../images/pdf/header_decom.png'  style='position: absolute; right: 420px;'><h1 align='center'>Objetivos en Común: Ingeniería Civil en Informática<br>Realizado el ".date("d/m/Y").' - '.date("H:i:s")."</h1>".utf8_decode($datos)).utf8_encode("<br><h1>OBJETIVO</h1><p>Esta aplicación tiene por objetivo mostrar como las asignaturas se relacionan y refuerzan entre si a medida que el alumno va adquiriendo sus conocimientos y aprobando sus objetivos</p><h1>INDICACIONES</h1><p>Los colores representan lo siguiente:</p><ul><li><strong>SIN PINTAR:</strong> Son las asignaturas no consideradas en el ejemplo</li><li><strong>NARANJA:</strong> Es la asigntura a la cual se desea saber sus relaciones y fortelezas</li><li><strong>VERDES:</strong> Son las asignaturas que se ven fortalecidas al adquirir los objetivos de la asignatura pintada en naranja</li><li><strong>CELESTE:</strong> Son las asignaturas que se verán beneficiadas al adquirir los objetivos aprendidos en la asignatura en naranjo.</li></ul>")."</body></html>");
			}	
		break;
		case 'IIN':
			$dompdf->set_paper("c2","landscape");
			if($var[1]=="SIM"){
				$dompdf->load_html($estilo."<body>".utf8_encode("<img src='../images/pdf/logo_uv.png'><img src='../images/pdf/header_decom.png'  style='position: absolute; right: 420px;'><h1 align='center'>Simulador de Avance Académico: Ingeniería en Informática<br>Realizado el ".date("d/m/Y").' - '.date("H:i:s")."</h1>".utf8_decode($datos)).utf8_encode("<br><h1>OBJETIVO</h1><p>Esta aplicación tiene por objetivo simular el avance académico de un alumno para que pueda visualizar su estado actual y futuro.</p><h1>INDICACIONES</h1><p>Los colores representan lo siguiente:</p><ul><li><strong>SIN PINTAR:</strong> Son las asignaturas no consideradas en la simulación</li><li><strong>NARANJA:</strong> Son las asignaturas que son objeto de simulación</li><li><strong>VERDES:</strong> Son las asignaturas necesarias para poder cursar las asignaturas pintadas en naranjo</li><li><strong>CELESTE:</strong> Son las asignaturas que se pueden inscribir si es que se han aprobado las asignaturas en naranjo</li></ul>")."</body></html>");
			}else{
				$dompdf->load_html($estilo."<body>".utf8_encode("<img src='../images/pdf/logo_uv.png'><img src='../images/pdf/header_decom.png'  style='position: absolute; right: 420px;'><h1 align='center'>Objetivos en Común: Ingeniería en Informática<br>Realizado el ".date("d/m/Y").' - '.date("H:i:s")."</h1>".utf8_decode($datos)).utf8_encode("<br><h1>OBJETIVO</h1><p>Esta aplicación tiene por objetivo mostrar como las asignaturas se relacionan y refuerzan entre si a medida que el alumno va adquiriendo sus conocimientos y aprobando sus objetivos</p><h1>INDICACIONES</h1><p>Los colores representan lo siguiente:</p><ul><li><strong>SIN PINTAR:</strong> Son las asignaturas no consideradas en el ejemplo</li><li><strong>NARANJA:</strong> Es la asigntura a la cual se desea saber sus relaciones y fortelezas</li><li><strong>VERDES:</strong> Son las asignaturas que se ven fortalecidas al adquirir los objetivos de la asignatura pintada en naranja</li><li><strong>CELESTE:</strong> Son las asignaturas que se verán beneficiadas al adquirir los objetivos aprendidos en la asignatura en naranjo.</li></ul>")."</body></html>");
			}
		break;
		case 'IEJ':
			$dompdf->set_paper("a3","landscape");
			if($var[1]=="SIM"){
				$dompdf->load_html($estilo."<body>".utf8_encode("<img src='../images/pdf/logo_uv.png'><img src='../images/pdf/header_decom.png'  style='position: absolute; right: 420px;'><h1 align='center'>Simulador de Avance Académico: Ingeniería en Ejecución en Informática<br>Realizado el ".date("d/m/Y").' - '.date("H:i:s")."</h1>".utf8_decode($datos)).utf8_encode("<br><h1>OBJETIVO</h1><p>Esta aplicación tiene por objetivo simular el avance académico de un alumno para que pueda visualizar su estado actual y futuro.</p><h1>INDICACIONES</h1><p>Los colores representan lo siguiente:</p><ul><li><strong>SIN PINTAR:</strong> Son las asignaturas no consideradas en la simulación</li><li><strong>NARANJA:</strong> Son las asignaturas que son objeto de simulación</li><li><strong>VERDES:</strong> Son las asignaturas necesarias para poder cursar las asignaturas pintadas en naranjo</li><li><strong>CELESTE:</strong> Son las asignaturas que se pueden inscribir si es que se han aprobado las asignaturas en naranjo</li></ul>")."</body></html>");
			}else{
				$dompdf->load_html($estilo."<body>".utf8_encode("<img src='../images/pdf/logo_uv.png'><img src='../images/pdf/header_decom.png'  style='position: absolute; right: 420px;'><h1 align='center'>Objetivos en Común: Ingeniería en Ejecución en Informática<br>Realizado el ".date("d/m/Y").' - '.date("H:i:s")."</h1>".utf8_decode($datos)).utf8_encode("<br><h1>OBJETIVO</h1><p>Esta aplicación tiene por objetivo mostrar como las asignaturas se relacionan y refuerzan entre si a medida que el alumno va adquiriendo sus conocimientos y aprobando sus objetivos</p><h1>INDICACIONES</h1><p>Los colores representan lo siguiente:</p><ul><li><strong>SIN PINTAR:</strong> Son las asignaturas no consideradas en el ejemplo</li><li><strong>NARANJA:</strong> Es la asigntura a la cual se desea saber sus relaciones y fortelezas</li><li><strong>VERDES:</strong> Son las asignaturas que se ven fortalecidas al adquirir los objetivos de la asignatura pintada en naranja</li><li><strong>CELESTE:</strong> Son las asignaturas que se verán beneficiadas al adquirir los objetivos aprendidos en la asignatura en naranjo.</li></ul>")."</body></html>");
			}
		break;
	}
	$dompdf->render();
	$pdf = $dompdf->output();
	if($var[1]=="SIM"){
		$filename = 'malla'.$var[0].'-'.date("Y-m-d").'-'.date("H-i-s").'.pdf';
	}else{
		$filename = 'malla'.$var[0].'-OB-'.date("Y-m-d").'-'.date("H-i-s").'.pdf';
	}
	/*if($var[1]=="SIM"){
		file_put_contents("../static/simulacion/".$filename, $pdf);
	}*/
	$dompdf->stream($filename, array("Attachment" => 0));

?>