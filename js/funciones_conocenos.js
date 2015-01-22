$( document ).ready(function() {

	$("#botonACA").click(function(){
		$("#cont1").html("Equipo Académico");
	});

	$("#botonAYU").click(function(){
		$("#cont1").html("Ayudantes de Laboratorio");
	});

	$("#botonADM").click(function(){
		$("#cont1").html("Equipo Administrativo");
	});

	$("#botonTODOS").click(function(){
		$("#cont1").html("Personal Escuela Ingeniería Civil en Informática");
	});

	$(".personal_academico").click(function(){
		var tmp = $(this).attr("id").split("_");
		$.ajax({
		url: '../logica/getInfoPersonal.php',
		type: 'POST',
		async: true,
		data: 'idsent='+tmp[1],
		success: function(datos_recibidos) {
				var data_from = datos_recibidos.split("||");

				var personales = data_from[0].split("++");
				var titulos = data_from[1].split("++");
				var areas = data_from[2].split("++");
				var asig = data_from[3].split("++");
				var asigm = data_from[4].split("++");
				$(".modal-title").html(personales[0]);
				$(".modal-body").html("<div class='row'><div class='col-sm-8'><h4 align='center'>"+personales[1]+"</h4><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-list-alt'></span> Títulos</a><br><ul class='listado_titulos'></ul><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-lock'></span> Áreas de Trabajo</a><br><ul class='listado_areas'></ul><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-book'></span> Asignaturas Dictadas</a><br><ul class='listado_asignaturas'></ul><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-earphone'></span> Contacto</a><br><ul><li>Fono: "+personales[4]+"</li><li>Correo: "+personales[2]+"</li><li>Web: <a href='http://"+personales[3]+"' target='_blank'>"+personales[3]+"</a></li></ul></div><div class='col-sm-4'><img src='"+personales[5]+"'></div></div>");
				
				for (var i = 0;i<titulos.length-1;i++) {
					$(".listado_titulos").append("<li>"+titulos[i]+"</li>");
				}

				for (var i = 0;i<areas.length-1;i++) {
					$(".listado_areas").append("<li>"+areas[i]+"</li>");
				}

				for (var i = 0;i<asig.length-1;i++) {
					$(".listado_asignaturas").append("<li>"+asig[i]+"</li>");
				}

				for (var i = 0;i<asigm.length-1;i++) {
					$(".listado_asignaturas").append("<li>"+asigm[i]+"</li>");
				}

				$("#myModal").modal({show:true});



			}
		});
	});

});	

