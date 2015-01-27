$( document ).ready(function() {
	
    var descrip_mencion = "";

    $.ajax({
        url: '../../logica/getMencionInfo.php',
        type: 'POST',
        async: true,
        data: 'mencion=RED',
        success: function(datos_recibidos) {
            $("#descripcion_mencion").val(datos_recibidos);
            descrip_mencion = datos_recibidos;
        }
    });

    $("#boton_salir_admin").click(function(){
        swal({
                  title: "Cerrar Sesión",
                  text: "Esta seguro de que desea cerrar la sesión",
                  type: "info",
                  showCancelButton: true,
                  allowOutsideClick: true,
                  confirmButtonClass: "btn-primary",
                  confirmButtonText: "Ok",
                  cancelButtonText: 'Cancelar',
                  closeOnConfirm: false
            }, function(){
                $(location).attr('href','../../logica/cierra_sesion.php');
        });    
    });

    $("#descripcion_mencion").keyup(function(){
        if($(this).val() != descrip_mencion){
            $("#boton_modifica_mencion").removeAttr("disabled");
            $("#boton_deshacer_modifica").removeAttr("disabled");
        }else{
            $("#boton_modifica_mencion").attr("disabled","disabled");
            $("#boton_deshacer_modifica").attr("disabled","disabled");
        }
    });

    $("#boton_deshacer_modifica").click(function(){
        $("#descripcion_mencion").val(descrip_mencion);
        $("#boton_modifica_mencion").attr("disabled","disabled");
        $("#boton_deshacer_modifica").attr("disabled","disabled");
    });

    $("#validar_actualizar").hide();

    $("#boton_modifica_mencion").click(function(){
        $.ajax({
            url: '../../logica/updateInfoMencion.php',
            type: 'POST',
            async: true,
            data: 'mencion=RED&descrip='+$("#descripcion_mencion").val(),
            success: function(datos_recibidos) {
                    if(datos_recibidos == "ok"){
                        swal({
                          title: "",
                          text: "La descripción de la Mencion de Redes ha sido actualizada",
                          type: "success",
                          showCancelButton: false,
                          allowOutsideClick: true,
                          confirmButtonClass: "btn-success",
                          confirmButtonText: "Ok",
                          closeOnConfirm: true
                        });

                        descrip_mencion = $("#descripcion_mencion").val();
                        $("#boton_modifica_mencion").attr("disabled","disabled");
                        $("#boton_deshacer_modifica").attr("disabled","disabled");
                    }else{
                        swal({
                          title: "",
                          text: "La descripción de la Mencion de Redes no ha sido actualizada. Intente nuevamente",
                          type: "error",
                          showCancelButton: false,
                          allowOutsideClick: true,
                          confirmButtonClass: "btn-error",
                          confirmButtonText: "Ok",
                          closeOnConfirm: true
                        });
                    }
                }
        });
    });    

    $("#validar_add_ramo").hide();

    $("#boton_agregar_ramo").click(function(){
        var name = $("#nombre_nuevo");
        var profe = $("#profesor_new");
        var corta = $("#descrip_corta_nueva");
        var larga = $("#descrip_larga_new");
        var foto = $("#foto_new");

        if(name.val()==""){
            $("#validar_add_ramo").removeClass("alert-success");
            $("#validar_add_ramo").addClass("alert-danger");
            $("#validar_add_ramo").html("<strong>ERROR!</strong> - El nombre de la asignatura esta vacio.");
            $("#validar_add_ramo").show("slow");
            setTimeout(function() {
                $('#validar_add_ramo').hide('slow');
            }, 3000);
            return false;            
        }
        if(corta.val()==0){
            $("#validar_add_ramo").removeClass("alert-success");
            $("#validar_add_ramo").addClass("alert-danger");
            $("#validar_add_ramo").html("<strong>ERROR!</strong> - Debe escoger una descripción corta.");
            $("#validar_add_ramo").show("slow");
            setTimeout(function() {
                $('#validar_add_ramo').hide('slow');
            }, 3000);
            return false;            
        }
        if(larga.val()==""){
            $("#validar_add_ramo").removeClass("alert-success");
            $("#validar_add_ramo").addClass("alert-danger");
            $("#validar_add_ramo").html("<strong>ERROR!</strong> - La descripcion larga de la asignatura esta vacia.");
            $("#validar_add_ramo").show("slow");
            setTimeout(function() {
                $('#validar_add_ramo').hide('slow');
            }, 3000);
            return false;            
        }
        if(profe.val()==""){
            $("#validar_add_ramo").removeClass("alert-success");
            $("#validar_add_ramo").addClass("alert-danger");
            $("#validar_add_ramo").html("<strong>ERROR!</strong> - El nombre del profesor esta vacio.");
            $("#validar_add_ramo").show("slow");
            setTimeout(function() {
                $('#validar_add_ramo').hide('slow');
            }, 3000);
            return false;            
        }
        if(foto.val()==""){
            $("#validar_add_ramo").removeClass("alert-success");
            $("#validar_add_ramo").addClass("alert-danger");
            $("#validar_add_ramo").html("<strong>ERROR!</strong> - No ha ingresado una fotografia para la asignatura.");
            $("#validar_add_ramo").show("slow");
            setTimeout(function() {
                $('#validar_add_ramo').hide('slow');
            }, 3000);
            return false;            
        }

        var archivos = document.getElementById('foto_new');
        var documento = archivos.files;
        var datta = new FormData();

        for(var i=0;i<documento.length;i++){
            datta.append('archivo'+i,documento[i]);
        }

        var urlSend = foto.val().split("\\");

        $.ajax({
            url: '../../logica/uploadFotosRamos.php',
            type: 'POST',
            async: true,
            contentType: false,
            processData: false,
            cache: false,
            data: datta,
            success: function(datos_recibidos) {
                }
        });

        $.ajax({
            url: '../../logica/setNuevaAsignaturaMencion.php',
            type: 'POST',
            async: true,
            data: 'name='+name.val()+'&corta='+$("#descrip_corta_nueva option:selected").text()+'&larga='+larga.val()+'&profe='+profe.val()+'&mencion=RED&code='+corta.val()+'&urlEnvio='+urlSend[urlSend.length-1],
            success: function(datos_recibidos) {
                if(datos_recibidos=="ok"){
                    $("#validar_add_ramo").removeClass("alert-danger");
                    $("#validar_add_ramo").addClass("alert-success");
                    $("#validar_add_ramo").html("<strong>EXITO!</strong> - Se ha ingresado la asignatura llamada <strong>"+name.val()+"</strong>. En breve sera redireccionado a la gestion de mencion.");
                    $("#validar_add_ramo").show("slow");
                    setTimeout(function() {
                                    location.reload();
                                }, 3000); 
                }else{
                    $("#validar_add_ramo").removeClass("alert-success");
                    $("#validar_add_ramo").addClass("alert-danger");
                    $("#validar_add_ramo").html("<strong>ERROR!</strong> - No se ha podido ingresar la asignatura. Por favor intente nuevamente.");
                    $("#validar_add_ramo").show("slow");
                    setTimeout(function() {
                        $('#validar_add_ramo').hide('slow');
                    }, 3000);
                }
            }
        });
    });

    $.ajax({
        url: '../../logica/getAsignaturaAdminMencion.php',
        type: 'POST',
        async: true,
        data: 'mencion=RED',
        success: function(datos_recibidos) {
            var datos_obtenidos = datos_recibidos.split("|+|");
            for (var i = 0; i < datos_obtenidos.length-1; i++) {
                var rescate = datos_obtenidos[i].split("||");
                $("#datos_tabla").append("<tr id='fila_"+i+"_"+rescate[4]+"_RED'><td id='nombre_"+i+"'>"+rescate[0]+"</td><td id='infoCorta_"+i+"'>"+rescate[1]+"</td><td id='infoLarga_"+i+"'>"+rescate[2]+"</td><td id='profe_"+i+"'>"+rescate[3]+"</td><td id='estado_"+i+"'>"+rescate[5]+"</td><td id='boton_des_blo_"+i+"'></td><td><button type='button' id='botonModifica_"+i+"_"+rescate[4]+"' class='btn btn-sm btn-primary boton_modifica_asignatura_mencion'><span class='glyphicon glyphicon-pencil'></span> Modificar</button></td><td><button type='button' class='btn btn-sm btn-danger boton_borrar' id='botonBorrar_"+i+"_"+rescate[4]+"'><span class='glyphicon glyphicon-remove'></span> Borrar</button></td></tr>");   
            }
            for (var i = 0; i < datos_obtenidos.length-1; i++) {
                var rescate = datos_obtenidos[i].split("||");
                if(rescate[5]=="Visible"){
                    $("#boton_des_blo_"+i).html("<button class='btn btn-sm btn-success boton_mostrar' id='botonMostrarID_"+i+"_"+rescate[4]+"_DES'><span class='glyphicon glyphicon-eye-close'></span> No Mostrar</button>");    
                }else{
                    $("#boton_des_blo_"+i).html("<button class='btn btn-sm btn-warning boton_mostrar' id='botonMostrarID_"+i+"_"+rescate[4]+"_HAB'><span class='glyphicon glyphicon-eye-open'></span> Mostrar</button>");
                }
            }

            $(".boton_modifica_asignatura_mencion").click(function(){
                var extra = $(this).attr("id").split("_");
                var url = "";
 
                $.ajax({
                    url: '../../logica/getAsignaturaMencion.php',
                    type: 'POST',
                    async: true,
                    data: 'mencion=foto&codigo='+extra[2]+'&linea=RED&nom='+$('#nombre_'+extra[1]).text(),
                    success: function(datos_recibidos) {
                        $(".modal-title").html("Modificar Asignatura: "+$('#nombre_'+extra[1]).text()); 
                        $("#cuerpoModal_other").html("<div class='row'><div class='col-lg-6'><div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Modificar información de la asignatura</h3></div><div class='panel-body' id='panel_cuerpo_act_ramo' style='height:505px;'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-3 control-label' for='nombre_act'>Nombre</label><div class='col-md-9'><input id='nombre_act' name='nombre_act' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='descrip_corta_act'>Descripción Corta</label><div class='col-md-9'><select id='descrip_corta_act' name='descrip_corta_act' class='form-control'><option value='0' style='display:none;'>Seleccione</option><option value='INC502'>Asignatura Electiva de Especialidad I</option><option value='INC512'>Asignatura Electiva de Especialidad II</option><option value='INC600'>Asignatura Electiva de Especialidad III</option><option value='INC501'>Seminario de Especialidad I</option><option value='INC511'>Seminario de Especialidad II</option></select></div></div><div class='form-group'><label class='col-md-3 control-label' for='descrip_larga_act'>Descripción Larga</label><div class='col-md-9'><textarea class='form-control' id='descrip_larga_act' name='descrip_larga_act' style='resize: none; height:189px;'></textarea></div></div><div class='form-group'><label class='col-md-3 control-label' for='profesor_act'>Profesor</label><div class='col-md-9'><input id='profesor_act' name='profesor_act' type='text' class='form-control input-md'></div></div><div class='form-group'><div class='col-md-12' style='margin-top:9%;'><button id='boton_agregar_act' class='btn btn-primary btn-success btn-block' type='button'><span class='glyphicon glyphicon-edit'></span> Modificar Asignatura</button><button id='boton_agregar_act_refresh' class='btn btn-primary btn-danger btn-block' type='button'><span class='glyphicon glyphicon-refresh'></span> Deshacer Cambios</button></div></div></fieldset></form></div></div></div><div class='col-lg-6'><div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Imagen de la asignatura</h3></div><div class='panel-body' id='panel_cuerpo_act_ramo_foto' style='height:505px;'><form class='form-horizontal'><fieldset><div class='form-group'><div class='col-md-12'><div style='border:1px solid;' id='foto_ramo_marco_act'><img src='' id='foto_ramo'></div></div></div><div class='form-group'><div class='col-md-12'><input id='foto_asignatura' name='foto_asignatura' type='file' class='form-control input-md' accept='image/*'></div></div><div class='form-group'><div class='col-md-12'><button type='button' class='btn btn-warning btn-block' id='boton_modifica_foto' name='boton_modifica_foto' disabled><span class='glyphicon glyphicon-picture'></span> Cambiar Imagen</button><button type='button' class='btn btn-warning btn-block' id='boton_galeria' name='boton_galeria'><span class='glyphicon glyphicon-th-large'></span> Galeria de Imagenes</button></div></div></fieldset></form></div></div></div><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_ramo_act'></div></div></div><div class='row fila_galeria'><div class='col-lg-12'><div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Galeria de Imagenes</h3></div><div class='panel-body panel_galeria'></div></div></div></div>");
                        $("#footer_other").html("<button type='button' class='btn btn-primary' data-dismiss='modal' id='cerrar_modal_modifica_ramo'>Cerrar</button>");
                        
                        $(".fila_galeria").hide();

                        $("#nombre_act").val($('#nombre_'+extra[1]).text());
                        $("#foto_ramo").attr("src","../../"+datos_recibidos);
                        var selectOptionText = $('#infoCorta_'+extra[1]).text();
                        $("#descrip_corta_act").find("option").filter(function(index) {
                            return selectOptionText === $(this).text();
                        }).prop("selected", true);
                        $("#descrip_larga_act").val($('#infoLarga_'+extra[1]).text());
                        $("#profesor_act").val($('#profe_'+extra[1]).text());

                        var nombre_mod = $('#nombre_'+extra[1]).text();
                        var corta_mod = $( "#descrip_corta_act option:selected" ).val();
                        var larga_mod = $('#infoLarga_'+extra[1]).text();
                        var profe_mod = $('#profe_'+extra[1]).text();

                        $("#validar_ramo_act").hide();
                        $('#myModal_other').modal({show:true});

                        var control_galeria = false;
                        $("#boton_galeria").click(function(){
                                if(control_galeria == true){
                                    control_galeria = false;
                                    $(".panel_galeria").html("");
                                    $(".fila_galeria").hide();
                                    return false;
                                }
                                control_galeria = true;
                                $.ajax({
                                url: '../../logica/galeriaFotos.php',
                                type: 'POST',
                                async: true,
                                data: 'dat=none',
                                success: function(datos_recibidos){
                                        var fotos = datos_recibidos.split("||");
                                        $(".panel_galeria").html("");
                                        var fila = 0;
                                        var control_row = 1;
                                        for (var i = 0;i<fotos.length-1;i++) {
                                            if(i==0){
                                                fila = fila + 1;
                                                $(".panel_galeria").append("<div class='row fila"+fila+"'><div class='col-md-2'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><div class='btn-group'><button type='button' class='btn btn-primary btn-xs boton_cambia_foto' id='cambia_imagen_"+i+"'>Aplicar</button><button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><img src='"+fotos[i]+"' style='width:423px; height:310px;'></li></ul></div></p></div></div></div></div>");
                                            }else{
                                                if((i/6)!=control_row){
                                                    $(".fila"+fila).append("<div class='col-md-2'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><div class='btn-group'><button type='button' class='btn btn-primary btn-xs boton_cambia_foto' id='cambia_imagen_"+i+"'>Aplicar</button><button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu dropdown-menu-right' role='menu'><li><img src='"+fotos[i]+"' style='width:423px; height:310px;'></li></ul></div></p></div></div></div>");
                                                }else{
                                                    fila = fila + 1;
                                                    control_row = control_row + 1;
                                                    $(".panel_galeria").append("<div class='row fila"+fila+"'><div class='col-md-2'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><div class='btn-group'><button type='button' class='btn btn-primary btn-xs boton_cambia_foto' id='cambia_imagen_"+i+"'>Aplicar</button><button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><img src='"+fotos[i]+"' style='width:423px; height:310px;'></li></ul></div></p></div></div></div></div>");
                                                }
                                            }                    
                                        }

                                        $(".fila_galeria").show();
                                        
                                        $(".boton_cambia_foto").click(function(){
                                            var dataID = $(this).attr("id").split("_");
                                            $("#foto_ramo").attr("src",$("#imagen_"+dataID[2]).attr("src"));
                                            $.ajax({
                                                url: '../../logica/updateUrlFotos.php',
                                                type: 'POST',
                                                async: true,
                                                data: 'name_change='+nombre_mod+'&newUrl='+$("#imagen_"+dataID[2]).attr("src"),
                                                success: function(datos_recibidos){
                                                        $(".fila_galeria").hide();
                                                    }
                                            });
                                        });
                                    }
                                });
                            });

                        $("#boton_agregar_act_refresh").click(function(){
                           $("#nombre_act").val(nombre_mod);
                           $("#descrip_corta_act option[value='"+corta_mod+"']").attr("selected",true);
                           $("#descrip_larga_act").val(larga_mod);
                           $("#profesor_act").val(profe_mod);
                        });

                        $("#foto_asignatura").change(function(){
                            if($(this).val() != ''){
                                $("#boton_modifica_foto").removeAttr("disabled");
                            }else{
                                $("#boton_modifica_foto").attr("disabled","disabled");
                            }
                        });

                        $("#boton_modifica_foto").click(function(){
                            var dataSearchBD = nombre_mod+"||"+corta_mod;
                            var archivos = document.getElementById('foto_asignatura');
                            var documento = archivos.files;
                            var datta = new FormData();

                            for(var i=0;i<documento.length;i++){
                                datta.append('archivo'+i,documento[i]);
                            }
                            var foto = $("#foto_asignatura");
                            var urlSend = foto.val().split("\\");

                            $.ajax({
                                url: '../../logica/uploadFotosRamos.php',
                                type: 'POST',
                                async: true,
                                contentType: false,
                                processData: false,
                                cache: false,
                                data: datta,
                                success: function(datos_recibidos) {
                                    }
                            });
                            $.ajax({
                                    url: '../../logica/setNuevosDatosAsigMencion.php',
                                    type: 'POST',
                                    async: true,
                                    data: 'tipo=FOTO&busqueda='+dataSearchBD+'&fotoname='+urlSend[urlSend.length-1],
                                    success: function(datos_recibidos){
                                        var recibido = datos_recibidos.split("||");
                                        if(recibido[0] == "ok"){
                                            $("#foto_ramo").attr("src","../../"+recibido[1]);
                                            $("#validar_ramo_act").removeClass("alert-danger");
                                            $("#validar_ramo_act").addClass("alert-success");
                                            $("#validar_ramo_act").html("<strong>EXITO</strong> - La imagen de la asignatura ha sido cambiada con exito.");
                                            $("#validar_ramo_act").show("slow");
                                            setTimeout(function() {
                                                $('#validar_ramo_act').hide('slow');
                                            }, 3000);
                                        }else{
                                            $("#validar_ramo_act").removeClass("alert-success");
                                            $("#validar_ramo_act").addClass("alert-danger");
                                            $("#validar_ramo_act").html("<strong>ERROR!</strong> - La imagen de la asignatura no ha sido cambiada. Intente nuevamente");
                                            $("#validar_ramo_act").show("slow");
                                            setTimeout(function() {
                                                $('#validar_ramo_act').hide('slow');
                                            }, 3000);
                                        }
                                    }
                                });
                        });

                        $("#boton_agregar_act").click(function(){
                            var igualdad = 0;
                            if($("#nombre_act").val()!=nombre_mod){
                                if($("#nombre_act").val()==''){
                                    $("#validar_ramo_act").removeClass("alert-success");
                                    $("#validar_ramo_act").addClass("alert-danger");
                                    $("#validar_ramo_act").html("<strong>ERROR!</strong> - El nombre de la asignatura esta vacio.");
                                    $("#validar_ramo_act").show("slow");
                                    setTimeout(function() {
                                        $('#validar_ramo_act').hide('slow');
                                    }, 3000);
                                    return false;
                                }
                            }else{
                                igualdad = igualdad + 1;
                            }
                            if($("#descrip_corta_act option:selected" ).val()==corta_mod){
                                igualdad = igualdad + 1;
                            }
                            if($("#descrip_larga_act").val()!=larga_mod){
                                if($("#descrip_larga_act").val()==''){
                                    $("#validar_ramo_act").removeClass("alert-success");
                                    $("#validar_ramo_act").addClass("alert-danger");
                                    $("#validar_ramo_act").html("<strong>ERROR!</strong> - La descripcion de la asignatura esta vacia.");
                                    $("#validar_ramo_act").show("slow");
                                    setTimeout(function() {
                                        $('#validar_ramo_act').hide('slow');
                                    }, 3000);
                                    return false;
                                }
                            }else{
                                igualdad = igualdad + 1;
                            }
                            if($("#profesor_act").val()!=profe_mod){
                                if($("#profesor_act").val()==''){
                                    $("#validar_ramo_act").removeClass("alert-success");
                                    $("#validar_ramo_act").addClass("alert-danger");
                                    $("#validar_ramo_act").html("<strong>ERROR!</strong> - El nombre del profesor de la asignatura esta vacia.");
                                    $("#validar_ramo_act").show("slow");
                                    setTimeout(function() {
                                        $('#validar_ramo_act').hide('slow');
                                    }, 3000);
                                    return false;
                                }
                            }else{
                                igualdad = igualdad + 1;
                            }
                            if(igualdad == 4){
                                $("#validar_ramo_act").removeClass("alert-success");
                                $("#validar_ramo_act").addClass("alert-danger");
                                $("#validar_ramo_act").html("<strong>ERROR!</strong> - No se han detectado cambios nuevos en la asignatura");
                                $("#validar_ramo_act").show("slow");
                                setTimeout(function() {
                                    $('#validar_ramo_act').hide('slow');
                                }, 3000);
                                return false;
                            }else{
                                var dataSearchBD = nombre_mod+"||"+corta_mod;
                                $.ajax({
                                    url: '../../logica/setNuevosDatosAsigMencion.php',
                                    type: 'POST',
                                    async: true,
                                    data: 'tipo=INFO&nombre='+$("#nombre_act").val()+'&name_esp='+$("#descrip_corta_act option:selected").text()+'&des_corta='+$("#descrip_corta_act option:selected" ).val()+'&des_larga='+$("#descrip_larga_act").val()+'&new_profe='+$("#profesor_act").val()+'&busqueda='+dataSearchBD,
                                    success: function(datos_recibidos){
                                        if(datos_recibidos == "ok"){
                                            nombre_mod = $("#nombre_act").val();
                                            corta_mod = $("#descrip_corta_act option:selected" ).val();
                                            larga_mod = $("#descrip_larga_act").val();
                                            profe_mod = $("#profesor_act").val();
                                            $('#nombre_'+extra[1]).text(nombre_mod);
                                            $('#infoCorta_'+extra[1]).text($("#descrip_corta_act option:selected").text());
                                            $('#infoLarga_'+extra[1]).text(larga_mod);
                                            $('#profe_'+extra[1]).text(profe_mod);
                                            $("#validar_ramo_act").removeClass("alert-danger");
                                            $("#validar_ramo_act").addClass("alert-success");
                                            $("#validar_ramo_act").html("<strong>EXITO</strong> - La nueva informacion ha sido actualizada con exito.");
                                            $("#validar_ramo_act").show("slow");
                                            setTimeout(function() {
                                                $('#validar_ramo_act').hide('slow');
                                            }, 3000);
                                        }else{
                                            $("#validar_ramo_act").removeClass("alert-success");
                                            $("#validar_ramo_act").addClass("alert-danger");
                                            $("#validar_ramo_act").html("<strong>ERROR!</strong> - No se han aplicado los nuevos cambios. Intente nuevamente");
                                            $("#validar_ramo_act").show("slow");
                                            setTimeout(function() {
                                                $('#validar_ramo_act').hide('slow');
                                            }, 3000);
                                        }
                                    }
                                });
                            }            
                        });
                    }
                });
            });

            $(".boton_borrar").click(function(){
                var data = $(this).attr("id").split("_");
                $(".modal-title").html("Borrar Asignatura"); 
                $(".modal-body").html("Desea borrar la asignatura de <strong>"+$('#nombre_'+data[1]).text()+"</strong>");
                $("#footer_other").html("<button type='button' class='btn btn-success' id='boton_aprobar_borrar'><span class='glyphicon glyphicon-ok'></span> Borrar</button><button type='button' class='btn btn-primary' data-dismiss='modal' id='cerrar_modal_borrar'>Cerrar</button>");
                $('#myModal_other').modal({show:true}); 

                $("#boton_aprobar_borrar").click(function(){
                    $.ajax({
                        url: '../../logica/deleteAsignaturaMencion.php',
                        type: 'POST',
                        async: true,
                        data: 'mencion=RED&code='+data[2]+'&nombre_ramo='+$("#nombre_"+data[1]).text(),
                        success: function(datos_recibidos) {
                            if(datos_recibidos == "ok"){
                                $(".modal-body").html("<div class='alert alert-dismissible alert-success' role='alert' id='validar_aprobacion'><strong>EXITO</strong> - La asignatura <strong>"+$('#nombre_'+data[1]).text()+"</strong> ha sido eliminada con exito. En breve sera redirigido a la gestion de mencion.</div>");                                  
                                $("#footer_other").html("");
                                $("#validar_aprobacion").show("slow");
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            }else{
                                $(".modal-body").html("<div class='alert alert-dismissible alert-danger' role='alert' id='validar_aprobacion'><strong>ERROR!</strong> - La asignatura <strong>"+$('#nombre_'+data[1]).text()+"</strong> no ha sido eliminada. Intente nuevamente.</div>");                                  
                                $("#footer_other").html("");
                                $("#validar_aprobacion").show("slow");
                                setTimeout(function() {
                                    $('#validar_aprobacion').hide('slow');
                                    $("#cerrar_modal_borrar").click();
                                }, 3000);
                            }
                        }
                    });
                });
            });

            $(".boton_mostrar").click(function(){
                var data = $(this).attr("id").split("_");
                if($("#estado_"+data[1]).text() == "Visible"){
                    $(".modal-title").html("Deshabilitar Asignatura"); 
                    $(".modal-body").html("Desea deshabilitar la asignatura de <strong>"+$('#nombre_'+data[1]).text()+"</strong>");   
                }else{
                    $(".modal-title").html("Habilitar Asignatura");
                    $(".modal-body").html("Desea habilitar la asignatura de <strong>"+$('#nombre_'+data[1]).text()+"</strong>");  
                }
                $('#myModal_mostrar').modal({show:true});
                $("#boton_aprobar_mostrar").click(function(){
                    $.ajax({
                        url: '../../logica/setAsignaturaAdminMencionInfo.php',
                        type: 'POST',
                        async: true,
                        data: 'mencion=RED&code='+data[2]+'&tipo='+data[3]+'&nombre_ramo='+$("#nombre_"+data[1]).text(),
                        success: function(datos_recibidos) {
                            if(datos_recibidos == "ok"){
                                if($("#estado_"+data[1]).text() == "Visible"){
                                    $(".modal-body").html("<div class='alert alert-dismissible alert-success' role='alert' id='validar_aprobacion'><strong>EXITO</strong> - La asignatura <strong>"+$('#nombre_'+data[1]).text()+"</strong> ha sido deshabilitada con exito. En breve sera redirigido a la gestion de mencion.</div>");
                                }else{
                                    $(".modal-body").html("<div class='alert alert-dismissible alert-success' role='alert' id='validar_aprobacion'><strong>EXITO</strong> - La asignatura <strong>"+$('#nombre_'+data[1]).text()+"</strong> ha sido habilitada con exito. En breve sera redirigido a la gestion de mencion.</div>");                                  
                                }
                                $("#footer_mostrar").html("");
                                $("#validar_aprobacion").show("slow");
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            }else{
                                if($("#estado_"+data[1]).text() == "Visible"){
                                    $(".modal-body").html("<div class='alert alert-dismissible alert-danger' role='alert' id='validar_aprobacion'><strong>ERROR!</strong> - La asignatura <strong>"+$('#nombre_'+data[1]).text()+"</strong> no ha sido deshabilitada. Intente nuevamente.</div>");
                                }else{
                                    $(".modal-body").html("<div class='alert alert-dismissible alert-danger' role='alert' id='validar_aprobacion'><strong>ERROR!</strong> - La asignatura <strong>"+$('#nombre_'+data[1]).text()+"</strong> no ha sido habilitada. Intente nuevamente.</div>");                                  
                                }                                
                                $("#validar_aprobacion").show("slow");
                                setTimeout(function() {
                                    $('#validar_aprobacion').hide('slow');
                                    $("#cerrar_modal_mostrar").click();
                                }, 3000);
                            }
                        }
                    });
                });                
            });

            $('#tablaMencion').dataTable({
                "scrollCollapse": true,
                "searching": false,
                "info": false,
                "paging": false
            });



            }
    });
});