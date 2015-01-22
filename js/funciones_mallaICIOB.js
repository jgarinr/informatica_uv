$( document ).ready(function() {
	$.ajax({
	    url: '../logica/getMalla.php',
	    type: 'POST',
	    async: true,
	    data: 'malla=ICIOB',
	    success: function(datos_recibidos) {
	    		//RECIBIR MALLA CURRICULAR
				var tmp_grande = datos_recibidos.split("|-|");
	    		var asignatura_grande = tmp_grande[0].split("||");
	    		var requisitos_grande = tmp_grande[1].split("|+|");
	    		var objet_grande = tmp_grande[2].split("|.|");
	    		//alert(requisitos_grande);
	    		//alert(asignatura_grande.length);

	    		var tabla = "<table class='tabla_malla'><tr><th colspan='3'><a id='year_1' class='btn btn-primary btn-block btn-warning boton_year'>Primer Año</a></th><th colspan='4'><a id='year_2' class='btn btn-primary btn-block btn-warning boton_year'>Segundo Año</a></th><th colspan='4'><a id='year_3' class='btn btn-primary btn-block btn-warning boton_year'>Tercer Año</a></th><th colspan='4'><a id='year_4' class='btn btn-primary btn-block btn-warning boton_year'>Cuarto Año</a></th><th colspan='4'><a id='year_5' class='btn btn-primary btn-block btn-warning boton_year'>Quinto Año</a></th><th colspan='4'><a id='year_6' class='btn btn-primary btn-block btn-warning boton_year'>Sexto Año</a></th></tr><tr><td><a id='sem_1' class='btn btn-primary btn-block btn-danger boton_semestre'>1º Semestre</a></td><td colspan='2'><a id='sem_2' class='btn btn-primary btn-block btn-danger boton_semestre'>2º Semestre</a></td><td colspan='2'><a id='sem_3' class='btn btn-primary btn-block btn-danger boton_semestre'>3º Semestre</a></td><td colspan='2'><a id='sem_4' class='btn btn-primary btn-block btn-danger boton_semestre'>4º Semestre</a></td><td colspan='2'><a id='sem_5' class='btn btn-primary btn-block btn-danger boton_semestre'>5º Semestre</a></td><td colspan='2'><a id='sem_6' class='btn btn-primary btn-block btn-danger boton_semestre'>6º Semestre</a></td><td colspan='2'><a id='sem_7' class='btn btn-primary btn-block btn-danger boton_semestre'>7º Semestre</a></td><td colspan='2'><a id='sem_8' class='btn btn-primary btn-block btn-danger boton_semestre'>8º Semestre</a></td><td colspan='2'><a id='sem_9' class='btn btn-primary btn-block btn-danger boton_semestre'>9º Semestre</a></td><td colspan='2'><a id='sem_10' class='btn btn-primary btn-block btn-danger boton_semestre'>10º Semestre</a></td><td colspan='2'><a id='sem_11' class='btn btn-primary btn-block btn-danger boton_semestre'>11º Semestre</a></td><td colspan='2'><a id='sem_12' class='btn btn-primary btn-block btn-danger boton_semestre'>12º Semestre</a></td></tr><tr class='filaramos_1'></tr><tr class='filaramos_2'></tr><tr class='filaramos_3'></tr><tr class='filaramos_4'></tr><tr class='filaramos_5'></tr><tr class='filaramos_6'></tr><table>";
	    		$("#mallaICI").html(tabla);

	    		var control_posicion = 0;
	    		var control_sem = 10;
	    		var control_year = 1;
	    		var control_primer_sem = false;
	    		var conteo_sem = 1;
	    		var control_requisitos = 0;
	    		for (var i = 0; i<asignatura_grande.length-1; i++) {
	    			var asig = asignatura_grande[i].split("++");

	    			var tmp1 = asig[0].substring(0, 3);
	    			var tmp2 = asig[0].substring(3);

	    			var number = asig[0].substring(3, asig[0].length-1);
	    			var number_year = number.substring(0,1);
	    			
	    			var result_req = "";
	    			if(tmp2 == "501" || tmp2 == "502" || tmp2 == "511" || tmp2 == "512" || tmp2 == "600"){
	    				result_req = "AD\nHOC\n";
	    			}else{
	    				if(tmp2 == "601"){
	    					result_req = "5°\nAÑO\nAPR\n";
	    				}else{
	    					var obtain_req = requisitos_grande[control_requisitos].split("++");
							for (var x = 0; x<obtain_req.length-1;x++) {
									result_req = result_req+obtain_req[x]+"\n";
							}
	    				}
	    			}
					
					var name_malla = asig[1].replace(/\s/g,"-");

	    			if(number_year == control_year){
	    				if(number == control_sem){
		    				if(control_posicion == 0){
		    					if(!control_primer_sem){
		    						$(".filaramos_1").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_1").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}
		    					$(".filaramos_6").append("<td></td><td></td><td></td>");
			    			}
			    			if(control_posicion == 1){
			    				if(!control_primer_sem){
		    						$(".filaramos_2").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_2").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 2){
			    				if(!control_primer_sem){
		    						$(".filaramos_3").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_3").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 3){
			    				if(!control_primer_sem){
		    						$(".filaramos_4").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_4").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 4){
			    				if(!control_primer_sem){
		    						$(".filaramos_5").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_5").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 5){
			    				if(!control_primer_sem){
		    						$(".filaramos_6").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_6").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    					}
			    			}	
			    			control_posicion++;
			    			control_requisitos++;
		    			}else{
		    				control_primer_sem = true;
		    				control_posicion = 1;
		    				control_sem++;
		    				conteo_sem++;
		    				$(".filaramos_1").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
		    				control_requisitos++;
		    			}
	    			}else{
	    				control_year++;
	    				conteo_sem++;
	    				control_sem = control_sem + 9;
	    				control_posicion = 1;
	    				$(".filaramos_1").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+objet_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"_"+name_malla+"'>Ver Informacion</a></td>");
	    				control_requisitos++;
	    			}	
	    		}

	    		
				$("#llevar_malla").val($("#mallaICI").html());

				$("#boton_descargar_simulacion").click(function(){
					$(this).append(" <i class='fa fa-spinner fa-spin'></i>");
				});

				$("#boton_ayuda_malla_ob").click(function(){
					$(".modal-title").html("");
					$(".modal-body").html("<iframe width='890' height='452' class='js-player' src='http://www.powtoon.com/embed/dy5ORVEtu5G/?player=powtoon' frameborder='0'></iframe>");
					$(".modal-footer").html("<button type='button' class='btn btn-primary' id='closeTuto' data-dismiss='modal'><i class='fa fa-close'></i> Cerrar</button>");
					$('#myModal_mencion').modal({show:true,backdrop: 'static'});
					
					$("#closeTuto").click(function(){
						$(".modal-body").html("");
					});
				});

				$("#boton_reiniciar_simulacion").click(function(){

					swal({
				      title: "Simulador de Objetivos en Común",
				      text: "Desea reiniciar la simulación",
				      type: "info",
				      showCancelButton: true,
				      allowOutsideClick: true,
				      confirmButtonClass: 'btn-primary',
				      confirmButtonText: 'Ok',
				      cancelButtonText: "Cancelar",
				      closeOnConfirm: false
				    }, function(){
				    	$(".caja_celda").each(function(){
							$(this).removeClass("caja_pintada");
							$(this).removeClass("caja_avance");
							$(this).removeClass("caja_click");
							$(this).addClass("caja_no_pintada");
						});
						$("#llevar_malla").val($("#mallaICI").html());
  						swal("Reiniciado!", "Su simulación ha sido reiniciada", "success");
					});
				});

				$(".caja_celda").click(function() {
					$(".caja_celda").each(function(){
						$(this).removeClass("caja_pintada");
						$(this).removeClass("caja_avance");
						$(this).removeClass("caja_click");
						$(this).addClass("caja_no_pintada");
					});
					var contenido = $(this).attr("id").split("||");
					var tmp2 = contenido[0].split("_");
					var number = tmp2[1].substring(3);
					$(this).removeClass("caja_no_pintada");
					$(this).addClass("caja_click");
					$(".caja_celda").each(function(){
						
						var tmp1 = $(this).attr("id").split("||");
						var tmp2 = tmp1[0].split("_");
						var tmp3 = tmp2[1].substring(3);

						if(tmp3 != number){
							if(contenido[1].indexOf(tmp3) != -1){
								if(tmp3 < number){
									$(this).removeClass("caja_no_pintada");
									$(this).addClass("caja_pintada");
								}
								if(tmp3 > number){
									$(this).removeClass("caja_no_pintada");
									$(this).addClass("caja_avance");
								}
							}
						}
					});
					$("#llevar_malla").val($("#mallaICI").html());		
				});

				$(".boton_ver_info_asignatura").click(function(){
					var datos = $(this).attr("id").split("_");
					$.ajax({
					    url: '../logica/getAsignaturaInfoMalla.php',
					    type: 'POST',
					    async: true,
					    data: 'malla='+datos[0]+'&asignatura='+datos[1]+"&nombresearch="+datos[2],
					    success: function(datos_recibidos) {
					    		var from = datos_recibidos.split("||");
					    		var ano = (new Date).getFullYear();
					    		$(".modal-title").html("Semestre "+from[3]+"º - "+from[0]);
					    		$(".modal-body").html("<div class='row'><div class='col-sm-6'><h2></h2><p><strong>Descripcion: </strong>"+from[4]+"</p><p><strong>Profesor (Periodo: "+ano+"): </strong>"+from[1]+"</p><p><strong>Codigo: </strong>"+datos[0]+datos[1]+"</p><p><strong>Objetivos:</strong></p><ul class='lista_objetivos'></ul></div><div class='col-sm-6'><h2></h2><img src='"+from[2]+"' style='width:423px; height:310px;'></div></div>");
					    		var objet_receb = from[5].split("++");
					    		for (var i = 0; i<objet_receb.length - 1;i++) {
					    			$(".lista_objetivos").append("<li>"+objet_receb[i]+"</li>");
					    		};
					    		$(".modal-footer").html("<a id='button1id' name='button1id' class='btn btn-primary' href='descargas.php'><i class='fa fa-download'></i> Ir a Descargas</a><button type='button' class='btn btn-primary' data-dismiss='modal'><i class='fa fa-close'></i> Cerrar</button>");
					    		$('#myModal_mencion').modal({show:true});
					    	}
					});
				});

	        }
	});

	

});