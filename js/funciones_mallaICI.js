$( document ).ready(function() {

	$.ajax({
	    url: '../logica/getMalla.php',
	    type: 'POST',
	    async: true,
	    data: 'malla=ICI',
	    success: function(datos_recibidos) {

	    		// ----- RECIBE LOS DATOS DE LA BD Y CREA LA MALLA CURRICULAR ----//
	    		var tmp_grande = datos_recibidos.split("|-|");
	    		var asignatura_grande = tmp_grande[0].split("||");
	    		var requisitos_grande = tmp_grande[1].split("|+|");
	    		
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
					
	    			if(number_year == control_year){
	    				if(number == control_sem){
		    				if(control_posicion == 0){
		    					if(!control_primer_sem){
		    						$(".filaramos_1").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_1").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}
		    					$(".filaramos_6").append("<td></td><td></td><td></td>");
			    			}
			    			if(control_posicion == 1){
			    				if(!control_primer_sem){
		    						$(".filaramos_2").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_2").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 2){
			    				if(!control_primer_sem){
		    						$(".filaramos_3").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_3").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 3){
			    				if(!control_primer_sem){
		    						$(".filaramos_4").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_4").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 4){
			    				if(!control_primer_sem){
		    						$(".filaramos_5").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_5").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}
			    			}
			    			if(control_posicion == 5){
			    				if(!control_primer_sem){
		    						$(".filaramos_6").append("<td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||++'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}else{
		    						$(".filaramos_6").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    					}
			    			}	
			    			control_posicion++;
			    			control_requisitos++;
		    			}else{
		    				control_primer_sem = true;
		    				control_posicion = 1;
		    				control_sem++;
		    				conteo_sem++;
		    				$(".filaramos_1").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
		    				control_requisitos++;
		    			}
	    			}else{
	    				control_year++;
	    				conteo_sem++;
	    				control_sem = control_sem + 9;
	    				control_posicion = 1;
	    				$(".filaramos_1").append("<td class='requisito_celda'>R:\n"+result_req+"</td><td><div class='caja_celda caja_no_pintada year_"+control_year+" sem_"+conteo_sem+"' id='celdaSem"+conteo_sem+"_"+asig[0]+"||"+requisitos_grande[control_requisitos]+"'>"+asig[0]+"<br>"+asig[1]+"</div><a class='btn btn-xs btn-primary boton_ver_info_asignatura' id='"+tmp1+"_"+tmp2+"'>Ver Informacion</a></td>");
	    				control_requisitos++;
	    			}	
	    		}

				$("#llevar_malla").val($("#mallaICI").html());
				//--------------------------------------------------------------//

				$("#boton_descargar_simulacion").click(function(){
					$(this).append(" <i class='fa fa-spinner fa-spin'></i>");
				});

				//---- BOTON DE AYUDA (TUTORIAL) MALLA SIMULACION CURRICULAR ----//
				$("#boton_ayuda_malla_ac").click(function(){
					$(".modal-title").html("");
					$(".modal-body").html("<iframe width='890' height='452' class='js-player' src='http://www.powtoon.com/embed/dgkJ3qUKt2N/?player=powtoon' frameborder='0'></iframe>");
					$(".modal-footer").html("<button type='button' class='btn btn-primary' id='closeTuto' data-dismiss='modal'><i class='fa fa-close'></i> Cerrar</button>");
					$('#myModal_mencion').modal({show:true,backdrop: 'static'});
					
					$("#closeTuto").click(function(){
						$(".modal-body").html("");
					});
				});
				//------------------------------------------------------------------//
			
				//----- BOTON REINICIAR SIMULACION: DESPINTA TODOS LOS CAMBIOS REALIZADOS ANTERIORMENTE ---- //
				$("#boton_reiniciar_simulacion").click(function(){

					swal({
				      title: "Simulador de Avance Académico",
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
				//-----------------------------------------------------------------------------------------//

				//----- BOTON VER INFORMACION SOBRE UN RAMO EN ESPECIFICO -----//
				$(".boton_ver_info_asignatura").click(function(){
					var datos = $(this).attr("id").split("_");
					$.ajax({
					    url: '../logica/getAsignaturaInfoMalla.php',
					    type: 'POST',
					    async: true,
					    data: 'malla='+datos[0]+'&asignatura='+datos[1],
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
				//---------------------------------------------------------------//
				


				//----- PINTAR UN RAMO EN ESPECIFICO, CONSIDERANDO SUS REQUISITOS REALES Y PARA QUE ME SIRVE A FUTURO ----- //
				var control_sem_pintado =  new Array();
				for (var i = 0; i<12; i++) {
					control_sem_pintado.push(0);	
				}

				$(".caja_celda").click(function() {
					var tmp = $(this).hasClass("caja_no_pintada");
					var idCaja = $(this).attr("id");
					var extract1 = idCaja.split("||");
					var extract2 = extract1[0].split("_");
					var extract3 = extract2[1].split("INC");

					var sem_celda = extract2[0].split("celdaSem");

					if(extract3[1] == "601"){
						$(this).removeClass("caja_no_pintada");
						$(this).addClass("caja_click");
						$(".caja_celda").each(function(){
							var tmp = $(this).attr("id").split("||");
							var tmp4 = tmp[0].split("_");
							var tmp6 = tmp4[1].split("INC");
							var tmp5 = tmp4[0].split("celdaSem");
							if(parseInt(tmp5[1])<11){
								$(this).removeClass("caja_no_pintada");
								$(this).removeClass("caja_avance");
								$(this).removeClass("caja_click");
								$(this).addClass("caja_pintada");
							}
							if(parseInt(tmp5[1])>=11){
								if(parseInt(tmp6[1])!=601){
									$(this).removeClass("caja_avance");
									$(this).removeClass("caja_click");
									$(this).removeClass("caja_no_pintada");
									$(this).addClass("caja_avance");
								}
							}
						});
					}else if(extract3[1] == "611"){
						$(this).removeClass("caja_no_pintada");
						$(this).addClass("caja_click");
						$(".caja_celda").each(function(){
							var tmp = $(this).attr("id").split("||");
							var tmp4 = tmp[0].split("_");
							var tmp6 = tmp4[1].split("INC");
							var tmp5 = tmp4[0].split("celdaSem");
							if(parseInt(tmp5[1])<12){
								$(this).removeClass("caja_avance");
								$(this).removeClass("caja_click");
								$(this).removeClass("caja_no_pintada");
								$(this).addClass("caja_pintada");
						}
						if(parseInt(tmp5[1])==12){
							if(parseInt(tmp6[1])!=611){
									$(this).removeClass("caja_avance");
									$(this).removeClass("caja_click");
									$(this).removeClass("caja_no_pintada");
									$(this).addClass("caja_avance");
								}
							}
						});
					}else if(tmp == true){
						if(extract3[1] != "205" && extract3[1] != "215"){
							control_sem_pintado[sem_celda[1]-1] = control_sem_pintado[sem_celda[1]-1] + 1;
						}
						pintarRamo(idCaja);
						$(this).removeClass("caja_no_pintada");
						$(this).addClass("caja_click");
						pintarAvance(extract3[1]);
					}else{
						if(extract3[1] != "205" && extract3[1] != "215"){
							if($(this).hasClass("caja_avance") == true){
								control_sem_pintado[sem_celda[1]-1] = control_sem_pintado[sem_celda[1]-1] + 1;
								pintarRamo(idCaja);
								$(this).removeClass("caja_no_pintada");
								$(this).removeClass("caja_avance");
								$(this).removeClass("caja_pintada");
								$(this).addClass("caja_click");
								pintarAvance(extract3[1]);																				
							}
						}
					}
						
				$("#llevar_malla").val($("#mallaICI").html());		
			});
			//---------------------------------------------------------------------------//				


			//----- FUNCION PINTAR AVANCE: pinta el avance los ramos simulados y de los involucrados en dicha simulacion ----- //
			function pintarAvance(numRamo){
				var req_tmp = new Array();
				$(".caja_celda").each(function(){
					var temp1 = $(this).attr("id").split("||");
					var temp2 = temp1[0].split("_");
					var temp3 = temp2[1].split("INC");
					if($(this).hasClass("caja_pintada") == true || $(this).hasClass("caja_click") == true){
						req_tmp.push(temp3[1]);
					}
				});
				$(".caja_celda").each(function(){
					var tmp = $(this).attr("id").split("||");
					var tmp2 = tmp[1].split("++");
					var tmp3 = tmp[0].split("_");
					var tmp4 = tmp3[1].split("INC");
					var control = 0;
					if(tmp4[1] != "205" && tmp4[1] != "215"){
						for (var i = 0; i < req_tmp.length; i++) {
							if(tmp2.indexOf(req_tmp[i]) != -1){
								control = control + 1;
							}
						}
						if($(this).hasClass("caja_no_pintada") == true){
							if(control == tmp2.length-1){
								$(this).removeClass("caja_no_pintada");
								$(this).addClass("caja_avance");
							}
						}
					}
				});
			}
			//-------------------------------------------------------------------------------------------------------//

			//---- FUNCION PINTAR RAMO: pinta los requisitos reales del ramo simulado ---- //
			function pintarRamo(idCaja){
				var id = idCaja.split("||");
				var idtmp = id[0].split("_");
				var idReq = id[1].split("++");
				var idRamo = id[0].split(idtmp[0]+"_INC"); 
				var requisitos = new Array();
				for (var i = 0; i < idReq.length-1; i++) {
				 	requisitos.push(idReq[i]);					 		
				}					
				if (requisitos.indexOf(idRamo[1]) != -1) {	
					return 0;
				}else{
					$(".caja_celda").each(function(){
				 		var tmpIdCaja = $(this).attr("id");
				 		var tmpId = tmpIdCaja.split("||");
				 		var tmpIDtmp = tmpId[0].split("_");
				 		var tmpIdRamo = tmpId[0].split(tmpIDtmp[0]+"_INC"); 
					 	if(requisitos.indexOf(tmpIdRamo[1]) != -1){
					 		if($(this).hasClass("caja_no_pintada")==true){
					 			$(this).removeClass("caja_no_pintada");
								$(this).addClass("caja_pintada");
					 		}else if($(this).hasClass("caja_avance")==true){
					 			$(this).removeClass("caja_avance");
								$(this).addClass("caja_pintada");
					 		}else if($(this).hasClass("caja_click")==true){
					 			$(this).removeClass("caja_click");
								$(this).addClass("caja_pintada");
					 		}
					 		return pintarRamo(tmpIdCaja);
					 	}					 	
					});
				}
			}
			//---------------------------------------------------------------------------//

			//---- BOTON PINTAR UN SEMESTRE COMPLETO: simula la totalidad de un semestre, pintando sus requisitos reales y sus posibles avances a futuro -----//
			$(".boton_semestre").click(function(){
				var aidi = $(this).attr("id");
				var tmp2 = aidi.split("sem_");
				var semestre_found = tmp2[1];
				$(".caja_celda").each(function(){
					$(this).removeClass("caja_pintada");
					$(this).removeClass("caja_click");
					$(this).removeClass("caja_avance");
					$(this).addClass("caja_no_pintada");
				});
				var requisitos = new Array();
				$(".caja_celda").each(function(){
					var tmp = $(this).hasClass("caja_no_pintada");
					var tiene_id = $(this).hasClass(aidi);
					var tmp3 = $(this).attr("id").split("||");
					var tmp4 = tmp3[0].split("_");
					var tmp6 = tmp4[1].split("INC");
					var tmp5 = tmp4[0].split("celdaSem");
					if(tmp == true){
						if(parseInt(tmp5[1]) < parseInt(tmp2[1])){
							$(this).removeClass("caja_no_pintada");
							$(this).addClass("caja_pintada");
						}
						if(tiene_id == true){
							$(this).removeClass("caja_no_pintada");
							$(this).addClass("caja_click");
						}
					}
					if(tmp == false){
						if(parseInt(tmp5[1]) < parseInt(tmp2[1])){
							$(this).removeClass("caja_pintada");
							$(this).addClass("caja_no_pintada");
						}
						if(tiene_id == true){
							$(this).removeClass("caja_click");
							$(this).addClass("caja_no_pintada");
						}
					}
				});
				$(".caja_celda").each(function(){
					var tmp3 = $(this).attr("id").split("||");
					var tmp4 = tmp3[0].split("_");
					var tmp6 = tmp4[1].split("INC");
					var tmp5 = tmp4[0].split("celdaSem");
					if($(this).hasClass("caja_pintada") == true || $(this).hasClass("caja_click") == true){
						requisitos.push(tmp6[1]);
					}
				});
				var excludido = ["601","501","502","503","512","600","501","610","611","602"];
				var excludido2 = ["601","611"];
				$(".caja_celda").each(function(){
					var tmp = $(this).attr("id").split("||");
					var tmp2 = tmp[1].split("++");
					var tmp4 = tmp[0].split("_");
					var tmp6 = tmp4[1].split("INC");
					var control = 0;
					for (var i = 0; i < requisitos.length; i++) {
						if(tmp2.indexOf(requisitos[i]) != -1){
							control = control + 1;
						}
					}
					if($(this).hasClass("caja_no_pintada") == true){
						if(control == tmp2.length-1){
							if(semestre_found < 8){
								if(excludido.indexOf(tmp6[1])==-1){
									$(this).removeClass("caja_no_pintada");
									$(this).addClass("caja_avance");
								}	
							}
							if(semestre_found >= 8){
								if(excludido2.indexOf(tmp6[1])==-1){
									$(this).removeClass("caja_no_pintada");
									$(this).addClass("caja_avance");
								}
							}
						}
					}
				});
				$("#llevar_malla").val($("#mallaICI").html());
			});
			//-------------------------------------------------------------------------------------------------------------------------------//
        }
	});
});