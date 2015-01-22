$( document ).ready(function() {

	$.ajax({
		url: '../logica/getMencionInfo.php',
		type: 'POST',
		async: true,
		data: 'mencion=BD',
		success: function(datos_recibidos) {
			$("#campo_descripcion").html(datos_recibidos);
		}
	});

	var names = new Array();

	$.ajax({
		url: '../logica/getAsignaturaMencion.php',
		type: 'POST',
		async: true,
		data: 'mencion=database',
		success: function(datos_recibidos) {

			var tmp = datos_recibidos.split("||");

			var fila = 0;
			var control_div = 1;
			for(var i=1;i<=tmp.length-1;i++){
				var data = tmp[i-1].split("++");
				if(i==1){
					fila = fila + 1;
					$(".carrusel_asignatura").append("<div class='item active'><div class='row fila"+fila+"'><div class='col-xs-4'><div class='portfolio-item'><div class='item-inner'><img class='img-responsive' src='"+data[3]+"'><h5>"+data[2]+"</h5><div class='overlay'><button class='btn btn-primary preview btn-danger asignatura' id='"+data[4]+"_"+(i-1)+"' title='"+data[2]+"'><i class='fa fa-eye'></i></button></div></div></div></div></div></div>");				
				}else{
					if((i/4)!=control_div){
						$(".fila"+fila).append("<div class='col-xs-4'><div class='portfolio-item'><div class='item-inner'><img class='img-responsive' src='"+data[3]+"'><h5>"+data[2]+"</h5><div class='overlay'><button class='btn btn-primary preview btn-danger asignatura' id='"+data[4]+"_"+(i-1)+"' title='"+data[2]+"'><i class='fa fa-eye'></i></button></div></div></div></div>");
						//alert(i+"/"+4+" = "+(i/4));
					}else{
						fila = fila + 1;
						control_div = control_div + 1;
						$(".carrusel_asignatura").append("<div class='item'><div class='row fila"+fila+"'><div class='col-xs-4'><div class='portfolio-item'><div class='item-inner'><img class='img-responsive' src='"+data[3]+"'><h5>"+data[2]+"</h5><div class='overlay'><button class='btn btn-primary preview btn-danger asignatura' id='"+data[4]+"_"+(i-1)+"' title='"+data[2]+"'><i class='fa fa-eye'></i></button></div></div></div></div></div></div>");
					}
				}
				names.push(data[2]);
			}
			
			$( ".asignatura" ).click(function() {
				var dat = $(this).attr("id").split("_");
				$.ajax({
				url: '../logica/getAsignaturaMencion.php',
				type: 'POST',
				async: true,
				data: 'mencion=informacion&codigo='+dat[0]+'&linea=BD&nom='+names[dat[1]],
				success: function(datos_recibidos) {
						var dato = datos_recibidos.split("++");
						var sem = "";
						var ano = (new Date).getFullYear();
						switch(dato[4]) {
						    case "INC502":
						       	sem = "9º Semestre";
						        break;
						    case "INC501":
						        sem = "9º Semestre";
						        break;
						    case "INC511":
						        sem = "10º Semestre";
						        break;
						    case "INC512":
						        sem = "10º Semestre";
						        break;
						    case "INC600":
						        sem = "11º Semestre";
						        break;   
						}
						$(".modal-title").html(dato[0]+": "+dato[1]);
						$(".modal-body").html("<div class='row'><div class='col-sm-6'><h2></h2><p><strong>Descripcion: </strong>"+dato[2]+"</p><p><strong>Profesor (Periodo: "+ano+"): </strong>"+dato[3]+"</p><p><strong>Semestre: </strong>"+sem+"</p><p><strong>Codigo: </strong>"+dato[4]+"<p/></div><div class='col-sm-6'><h2></h2><img src='"+dato[5]+"' style='width:423px; height:310px;'></div></div>");
						$('#myModal_mencion').modal({show:true});
					}
				});
			});

		}
	});

});	