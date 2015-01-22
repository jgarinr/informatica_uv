$( document ).ready(function() {

    $("#boton_salir_admin").click(function(){
        $(".modal-title").html("Cierre de Sesion");
        $(".modal-body").html("Esta seguro de que desea cerrar la sesion");
        $(".modal-footer").html("<button type='button' class='btn btn-success' id='boton_aprobar_cierre'><span class='glyphicon glyphicon-ok'></span> Aprobar</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
        $('#myModal').modal({show:true});
        $("#boton_aprobar_cierre").click(function(){
            $(location).attr('href','../../logica/cierra_sesion.php');
        });
    });
	
    $.ajax({
        url: '../../logica/getPersonalAdmin.php',
        type: 'POST',
        async: true,
        data: 'obtener=tabla',
        success: function(datos_recibidos) {
                var tipos_personas = datos_recibidos.split("|+|");
                var academicos = tipos_personas[0].split("||");
                var ayudantes = tipos_personas[1].split("||");
                var administrativos = tipos_personas[2].split("||");

                for (var i = 0; i<academicos.length-1;i++) {
                    var tmp = academicos[i].split("++");
                    $("#tabla_body_academicos").append("<tr class='template-upload fade in' id='academico_"+tmp[0]+"'><td class='nombre_academico' id='nombreAcademico_"+tmp[0]+"'><a class='mostrarAcademico' id='mostrarAcademico_"+tmp[0]+"' style='cursor:pointer;'>"+tmp[1]+"</a></td><td class='boton_modificar' align='center'><a id='modificarAcademico_"+tmp[0]+"' class='btn btn-primary botonModificarAcademico' title='Modificar Académico'><span class='glyphicon glyphicon-pencil'></span></a></td><td class='boton_eliminar' align='center'><a id='eliminarAcademico_"+tmp[0]+"' class='btn btn-danger botonEliminarAcademico' title='Eliminar Académico'><span class='glyphicon glyphicon-remove'></span></a></td></tr>");
                }

                for (var i = 0; i<ayudantes.length-1;i++) {
                    var tmp = ayudantes[i].split("++");
                    $("#tabla_body_ayudantes").append("<tr class='template-upload fade in' id='ayudante_"+tmp[0]+"'><td class='nombre_ayudante' id='nombreAyudante_"+tmp[0]+"'><a class='mostrarAyudante' id='mostrarAyudante_"+tmp[0]+"' style='cursor:pointer;'>"+tmp[1]+"</a></td><td class='boton_modificar' align='center'><a id='modificarAyudante_"+tmp[0]+"' class='btn btn-primary botonModificarAyudante' title='Modificar Ayudante'><span class='glyphicon glyphicon-pencil'></span></a></td><td class='boton_eliminar' align='center'><a id='eliminarAyudante_"+tmp[0]+"' class='btn btn-danger botonEliminarAyudante' title='Eliminar Ayudante'><span class='glyphicon glyphicon-remove'></span></a></td></tr>");
                }

                for (var i = 0; i<administrativos.length-1;i++) {
                    var tmp = administrativos[i].split("++");
                    $("#tabla_body_administrativos").append("<tr class='template-upload fade in' id='administrativo_"+tmp[0]+"'><td class='nombre_administrativo' id='nombreAdministrativo_"+tmp[0]+"'><a class='mostrarAdministrativo' id='mostrarAdministrativo_"+tmp[0]+"' style='cursor:pointer;'>"+tmp[1]+"</a></td><td class='boton_modificar' align='center'><a id='modificarAdministrativo_"+tmp[0]+"' class='btn btn-primary botonModificarAdministrativo' title='Modificar Administrativo'><span class='glyphicon glyphicon-pencil'></span></a></td><td class='boton_eliminar' align='center'><a id='eliminarAdministrativo_"+tmp[0]+"' class='btn btn-danger botonEliminarAdministrativo' title='Eliminar Administrativo'><span class='glyphicon glyphicon-remove'></span></a></td></tr>");
                }

                $('#tabla_academicos').dataTable({
                        "scrollY":        "400px",
                        "searching": false,
                        "info": false,
                        "paging": false
                    });

                $('#tabla_administrativos').dataTable({
                        "scrollY":        "400px",
                        "searching": false,
                        "info": false,
                        "paging": false
                    });

                $('#tabla_ayudantes').dataTable({
                        "scrollY":        "400px",
                        "searching": false,
                        "info": false,
                        "paging": false
                    });

                // ---------------------- ELIMINAR ACADEMICO
                $(".botonEliminarAcademico").click(function(){
                    var dat = $(this).attr("id").split("_");
                    $("#myModalLabel").html("Borrar un Académico");
                    $(".modal-footer").html("<button type='button' class='btn btn-danger' id='boton_borrar_academico'>Borrar</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                    $("#cuerpoModal").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_descarga'></div></div></div><div class='row campo_borra_academico'><div class='col-lg-12'>Desea eliminar al académico <strong>"+$("#nombreAcademico_"+dat[1]).text()+"</strong></div></div>");
                    $('#myModal').modal({show:true});

                    $("#validar_descarga").hide();

                    $("#boton_borrar_academico").click(function(){
                        $.ajax({
                            url: '../../logica/deletePersonal.php',
                            type: 'POST',
                            async: true,
                            data: 'tipo=Academico&idPer='+dat[1],
                            success: function(datos_recibidos){
                                if(datos_recibidos == "ok"){
                                    $("#validar_descarga").removeClass("alert-danger");
                                    $("#validar_descarga").addClass("alert-success");
                                    $("#validar_descarga").html("<strong>EXITO!</strong> - El académico <strong>"+$("#nombreAcademico_"+dat[1]).text()+"</strong> ha sido eliminado. Al cerrar esta ventana se recargará la página.");
                                    $("#validar_descarga").show("slow");
                                    $(".campo_borra_academico").html("");
                                    $(".modal-footer").html("");
                                    $("#myModal").on('hide.bs.modal', function(e){
                                        location.reload();
                                    }); 
                                }else{
                                    $("#validar_descarga").removeClass("alert-success");
                                    $("#validar_descarga").addClass("alert-danger");
                                    $("#validar_descarga").html("<strong>ERROR!</strong> - El académico <strong>"+$("#nombreAcademico_"+dat[1]).text()+"</strong> no se ha sido eliminado. Intente nuevamente.");
                                    $("#validar_descarga").show("slow");
                                    setTimeout(function() {
                                        $("#validar_descarga").hide("slow");
                                    }, 4000);
                                }
                            }
                        });
                    });
                });
                
                // ---------------------- ELIMINAR AYUDANTE 
                $(".botonEliminarAyudante").click(function(){
                    var dat = $(this).attr("id").split("_");
                    $("#myModalLabel").html("Borrar un Ayudante");
                    $(".modal-footer").html("<button type='button' class='btn btn-danger' id='boton_borrar_ayudante'>Borrar</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                    $("#cuerpoModal").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_descarga'></div></div></div><div class='row campo_borra_ayudante'><div class='col-lg-12'>Desea eliminar al ayudante <strong>"+$("#nombreAyudante_"+dat[1]).text()+"</strong></div></div>");
                    $('#myModal').modal({show:true});

                    $("#validar_descarga").hide();

                    $("#boton_borrar_ayudante").click(function(){
                        $.ajax({
                            url: '../../logica/deletePersonal.php',
                            type: 'POST',
                            async: true,
                            data: 'tipo=Ayudante&idPer='+dat[1],
                            success: function(datos_recibidos){
                                if(datos_recibidos == "ok"){
                                    $("#validar_descarga").removeClass("alert-danger");
                                    $("#validar_descarga").addClass("alert-success");
                                    $("#validar_descarga").html("<strong>EXITO!</strong> - El ayudante <strong>"+$("#nombreAyudante_"+dat[1]).text()+"</strong> ha sido eliminado. Al cerrar esta ventana se recargará la página.");
                                    $("#validar_descarga").show("slow");
                                    $(".campo_borra_ayudante").html("");
                                    $(".modal-footer").html("");
                                    $("#myModal").on('hide.bs.modal', function(e){
                                        location.reload();
                                    }); 
                                }else{
                                    $("#validar_descarga").removeClass("alert-success");
                                    $("#validar_descarga").addClass("alert-danger");
                                    $("#validar_descarga").html("<strong>ERROR!</strong> - El ayudante <strong>"+$("#nombreAyudante_"+dat[1]).text()+"</strong> no se ha sido eliminado. Intente nuevamente.");
                                    $("#validar_descarga").show("slow");
                                    setTimeout(function() {
                                        $("#validar_descarga").hide("slow");
                                    }, 4000);
                                }
                            }
                        }); 
                    });
                });
                
                // ---------------------- ELIMINAR ADMINISTRATIVO
                $(".botonEliminarAdministrativo").click(function(){
                    var dat = $(this).attr("id").split("_");
                    $("#myModalLabel").html("Borrar un Administrativo");
                    $(".modal-footer").html("<button type='button' class='btn btn-danger' id='boton_borrar_adm'>Borrar</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                    $("#cuerpoModal").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_descarga'></div></div></div><div class='row campo_borra_adm'><div class='col-lg-12'>Desea eliminar al administrativo <strong>"+$("#nombreAdministrativo_"+dat[1]).text()+"</strong></div></div>");
                    $('#myModal').modal({show:true});

                    $("#validar_descarga").hide();

                    $("#boton_borrar_adm").click(function(){
                        $.ajax({
                            url: '../../logica/deletePersonal.php',
                            type: 'POST',
                            async: true,
                            data: 'tipo=Adm&idPer='+dat[1],
                            success: function(datos_recibidos){
                                if(datos_recibidos == "ok"){
                                    $("#validar_descarga").removeClass("alert-danger");
                                    $("#validar_descarga").addClass("alert-success");
                                    $("#validar_descarga").html("<strong>EXITO!</strong> - El administrativo <strong>"+$("#nombreAdministrativo_"+dat[1]).text()+"</strong> ha sido eliminado. Al cerrar esta ventana se recargará la página.");
                                    $("#validar_descarga").show("slow");
                                    $(".campo_borra_adm").html("");
                                    $(".modal-footer").html("");
                                    $("#myModal").on('hide.bs.modal', function(e){
                                        location.reload();
                                    }); 
                                }else{
                                    $("#validar_descarga").removeClass("alert-success");
                                    $("#validar_descarga").addClass("alert-danger");
                                    $("#validar_descarga").html("<strong>ERROR!</strong> - El administrativo <strong>"+$("#nombreAdministrativo_"+dat[1]).text()+"</strong> no se ha sido eliminado. Intente nuevamente.");
                                    $("#validar_descarga").show("slow");
                                    setTimeout(function() {
                                        $("#validar_descarga").hide("slow");
                                    }, 4000);
                                }
                            }
                        }); 
                    });
                });

                // ---------------------- MODIFICAR AYUDANTE
                $(".botonModificarAyudante").click(function(){
                    var tmp = $(this).attr("id").split("_");
                    $.ajax({
                        url: '../../logica/getPersonalAdmin.php',
                        type: 'POST',
                        async: true,
                        data: 'obtener=ayudante&idPerson='+tmp[1],
                        success: function(datos_recibidos) {
                            var data_rec = datos_recibidos.split("++");
                            $("#myModalLabel").html("Modificar Ayudante de Laboratorio");
                            $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                            $("#cuerpoModal").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_descarga'></div></div></div><div class='row' id='inputs_agrega_ayudante'><div class='col-lg-6'><div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Datos Personales</h3></div><div class='panel-body'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-3 control-label' for='nombre_ayudante'>Nombre</label><div class='col-md-8'><input id='nombre_ayudante' name='nombre_ayudante' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='correo_ayudante'>Correo UV</label><div class='col-md-8'><input id='correo_ayudante' name='correo_ayudante' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='estado_ayudante'>Estado</label><div class='col-md-8'><select id='estado_ayudante' name='estado_ayudante' class='form-control'><option value='0'>No Activo</option><option value='1'>Activo</option></select></div></div><div class='form-group'><label class='col-md-3 control-label'></label><div class='col-md-8'><a id='modificar_ayudante_boton' name='modificar_ayudante_boton' class='btn btn-success'><span class='glyphicon glyphicon-hand-down'></span> Modificar</a><a style='margin-left:2%;' id='reset_ayudante' name='reset_ayudante' class='btn btn-danger' ><span class='glyphicon glyphicon-remove'></span> Reset</a></div></div></fieldset></form></div></div><div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Galeria de Imagenes</h3></div><div class='panel-body panel_galeria' style='height:210px; overflow-y:scroll;'></div></div></div><div class='col-lg-6'><div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Fotografía</h3></div><div class='panel-body'><img src='"+data_rec[2]+"' id='foto_ramo_per' width=250' style='margin-bottom: 5%; margin-left:15%;'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-2 control-label' for='foto_ayudante'>Foto</label><div class='col-lg-6'><input id='foto_ayudante' name='foto_ayudante' class='input-file' type='file' accept='image/*'></div></div></fieldset></form><button type='button' class='btn btn-warning btn-block' id='boton_modifica_foto' name='boton_modifica_foto' disabled=''><span class='glyphicon glyphicon-picture'></span> Cambiar Imagen</button></div></div></div></div>");
                            
                            $(".fila_galeria").hide();

                            $("#nombre_ayudante").val(data_rec[0]);
                            $("#correo_ayudante").val(data_rec[1]);

                            if(data_rec[3] == 1){
                                $("#estado_ayudante option[value='1']").attr("selected",true);
                            }else{
                                $("#estado_ayudante option[value='0']").attr("selected",true);
                            }

                            $('#myModal').modal({show:true});
                            $("#validar_descarga").hide();

                            $.ajax({
                            url: '../../logica/galeriaFotosQuienesSomos.php',
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
                                               $(".panel_galeria").append("<div class='row fila"+fila+"'><div class='col-md-4'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><div class='btn-group'><button type='button' class='btn btn-primary btn-xs boton_cambia_foto' id='cambia_imagen_"+i+"'>Aplicar</button><button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><img src='"+fotos[i]+"' style='width:300px; height:310px;'></li></ul></div></p></div></div></div></div>");
                                           }else{
                                               if((i/3)!=control_row){
                                                   $(".fila"+fila).append("<div class='col-md-4'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><div class='btn-group'><button type='button' class='btn btn-primary btn-xs boton_cambia_foto' id='cambia_imagen_"+i+"'>Aplicar</button><button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu dropdown-menu-right' role='menu'><li><img src='"+fotos[i]+"' style='width:300px; height:310px;'></li></ul></div></p></div></div></div>");
                                               }else{
                                                    fila = fila + 1;
                                                  control_row = control_row + 1;
                                                    $(".panel_galeria").append("<div class='row fila"+fila+"'><div class='col-md-4'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><div class='btn-group'><button type='button' class='btn btn-primary btn-xs boton_cambia_foto' id='cambia_imagen_"+i+"'>Aplicar</button><button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'><li><img src='"+fotos[i]+"' style='width:300px; height:310px;'></li></ul></div></p></div></div></div></div>");
                                                }
                                            }                    
                                        }

                                        $(".boton_cambia_foto").click(function(){
                                            var dataID = $(this).attr("id").split("_");
                                            $("#foto_ramo_per").attr("src",$("#imagen_"+dataID[2]).attr("src"));
                                            $.ajax({
                                                url: '../../logica/updateUrlFotosPersonas.php',
                                                type: 'POST',
                                                async: true,
                                                data: 'tipopersona=AYU&idAyu='+tmp[1]+'&newUrl='+$("#imagen_"+dataID[2]).attr("src"),
                                                success: function(datos_recibidos){
                                                    alert(datos_recibidos);
                                                    }
                                            });
                                        });
                                    }
                                });
                        }
                    });
                });

                // ---------------------- AGREGAR ACADEMICO
                $("#agregarAcademico").click(function(){
                    $("#myModalLabel").html("Agregar un Académico");
                    $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                    $("#cuerpoModal").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_descarga'></div></div></div><div class='row inputs_agrega_academico'><div class='col-lg-6'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-3 control-label' for='nombre_academico'>Nombre</label><div class='col-md-8'><input id='nombre_academico' name='nombre_academico' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='tipoAcademico'>Tipo</label><div class='col-md-8'><select id='tipoAcademico' name='tipoAcademico' class='form-control'><option value='0' style='display:none;'>Seleccione</option><option value='Académico Jornada Completa'>Académico Jornada Completa</option><option value='Académico Jornada Parcial'>Académico Jornada Parcial</option></select></div></div><div class='form-group'><label class='col-md-3 control-label' for='correo_academico'>Correo UV</label><div class='col-md-8'><input id='correo_academico' name='correo_academico' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='web_academico'>Web</label><div class='col-md-8'><input id='web_academico' name='web_academico' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='fono_academico'>Fono</label><div class='col-md-8'><input id='fono_academico' name='fono_academico' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='sexo'>Sexo</label><div class='col-md-8'><div class='radio'><label for='sexo_academico1'><input type='radio' name='sexo_academico' id='sexo_academico1' value='M'>Masculino</label></div><div class='radio'><label for='sexo_academico2'><input type='radio' name='sexo_academico' id='sexo_academico2' value='F'>Femenino</label></div></div></div><div class='form-group'><label class='col-md-3 control-label' for='foto_academico'>Foto</label><div class='col-lg-8'><input id='foto_academico' name='foto_academico' class='input-file' type='file' accept='image/*'></div></div><div class='form-group'><label class='col-md-3 control-label'></label><div class='col-md-8'><a id='agregar_academico_boton' name='agregar_academico_boton' class='btn btn-success'><span class='glyphicon glyphicon-hand-down'></span> Agregar</a><a style='margin-left:2%;' id='reset_academico' name='reset_academico' class='btn btn-danger' ><span class='glyphicon glyphicon-remove'></span> Reset</a></div></div></fieldset></form></div><div class='col-lg-6'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-3 control-label' for='titulos_academico'>Títulos</label><div class='col-md-8'><select id='titulos_academico' name='titulos_academico' class='form-control' multiple='multiple'></select></div></div><div class='form-group'><label class='col-md-3 control-label' for='agrega_titulo_academico'>Agrega un Título</label><div class='col-md-8'><input id='agrega_titulo_academico' name='agrega_titulo_academico' type='text' class='form-control input-md'><span class='help-block'>Ingrese un título </span></div></div><div class='form-group'><label class='col-md-3 control-label' for='boton_agrega_titulo'></label><div class='col-md-8'><button type='button' id='boton_agrega_titulo' name='boton_agrega_titulo' class='btn btn-sm btn-primary'>Agrega un Título</button><button type='button' style='margin-left:2%;' id='boton_borra_titulo' name='boton_borra_titulo' class='btn btn-sm btn-danger'>Borra un Título</button></div></div><div class='form-group'><label class='col-md-3 control-label' for='areas_academico'>Areas</label><div class='col-md-8'><select id='areas_academico' name='areas_academico' class='form-control' multiple='multiple'></select></div></div><div class='form-group'><label class='col-md-3 control-label' for='agrega_area_academico'>Agrega una Area</label><div class='col-md-8'><input id='agrega_area_academico' name='agrega_area_academico' type='text' class='form-control input-md'><span class='help-block'>Ingrese una Area </span></div></div><div class='form-group'><label class='col-md-3 control-label' for='boton_agrega_area'></label><div class='col-md-8'><button type='button' id='boton_agrega_area' name='boton_agrega_area' class='btn btn-sm btn-primary'>Agrega una Area</button><button type='button' style='margin-left:2%;' id='boton_borra_area' name='boton_borra_area' class='btn btn-sm btn-danger'>Borra una Area</button></div></div><div class='form-group'><label class='col-md-3 control-label' for='asignatura_academico'>Asignaturas</label><div class='col-md-8'><select id='asignatura_academico' name='asignatura_academico' class='form-control' multiple='multiple'></select></div></div><div class='form-group'><label class='col-md-3 control-label' for='asignaturasMEN_academico'>Especialidad</label><div class='col-md-8'><select id='asignaturasMEN_academico' name='asignaturasMEN_academico' class='form-control' multiple='multiple'></select></div></div></fieldset></form></div></div>");
                    $('#myModal').modal({show:true});

                    $.ajax({
                        url: '../../logica/getAsignaturaPersonaAdmin.php',
                        type: 'POST',
                        async: true,
                        success: function(datos_recibidos){
                            var datos = datos_recibidos.split("|+|");
                            var asig = datos[0].split("||");
                            var asig_m = datos[1].split("||");

                            var control_sem = 0;
                            for (var i = 0; i<asig.length-1;i++) {
                                var tmp = asig[i].split("++");
                                if(parseInt(tmp[3]) > control_sem){
                                    $("#asignatura_academico").append("<optgroup class='asig_sem_"+tmp[3]+"' label='Semestre "+tmp[3]+"'></optgroup>");
                                    $(".asig_sem_"+tmp[3]).append("<option>"+tmp[0]+"</option>");
                                    control_sem = tmp[3];
                                }else{
                                    $(".asig_sem_"+tmp[3]).append("<option>"+tmp[0]+"</option>");
                                }
                            }
    
                            control_sem = 0;
                            for (var i = 0; i<asig_m.length-1;i++) {
                                var tmp = asig_m[i].split("++");
                                if(parseInt(tmp[3]) > control_sem){
                                    $("#asignaturasMEN_academico").append("<optgroup class='asigMEN_sem_"+tmp[3]+"' label='Semestre "+tmp[3]+"'></optgroup>");
                                    $(".asigMEN_sem_"+tmp[3]).append("<option>"+tmp[0]+"</option>");
                                    control_sem = tmp[3];
                                }else{
                                    $(".asigMEN_sem_"+tmp[3]).append("<option>"+tmp[0]+"</option>");
                                }
                            }

                            $("#asignatura_academico").multiselect({
                                position: {
                                  my: 'left bottom',
                                  at: 'left top'
                                },click: function(event, ui){
                                  //var x = ui.value.split("_");
                                  //object2[x[2]] = (ui.checked ? 'checked' : 'unchecked');
                                }
                            });

                            $("#asignaturasMEN_academico").multiselect({
                                position: {
                                  my: 'left bottom',
                                  at: 'left top'
                                },click: function(event, ui){
                                  //var x = ui.value.split("_");
                                  //object2[x[2]] = (ui.checked ? 'checked' : 'unchecked');
                                }
                            });
                        }
                    });    


                    $("#validar_descarga").hide();

                    $("#titulos_academico").multiselect({
                        position: {
                          my: 'left bottom',
                          at: 'left top'
                        },click: function(event, ui){
                          //var x = ui.value.split("_");
                          //object2[x[2]] = (ui.checked ? 'checked' : 'unchecked');
                        }
                    });

                    $("#areas_academico").multiselect({
                        position: {
                          my: 'left bottom',
                          at: 'left top'
                        },click: function(event, ui){
                          //var x = ui.value.split("_");
                          //object2[x[2]] = (ui.checked ? 'checked' : 'unchecked');
                        }
                    });

                    var foto = "sin_foto";
                    var areas = new Array();
                    var titulos = new Array();

                    $("#boton_agrega_titulo").click(function(){
                        if($("#agrega_titulo_academico").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El título que se desea ingresar esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }else{
                            if(titulos.indexOf($("#agrega_titulo_academico").val()) != -1){
                                $("#validar_descarga").removeClass("alert-success");
                                $("#validar_descarga").addClass("alert-danger");
                                $("#validar_descarga").html("<strong>ERROR!</strong> - El título que se desea ingresar ya existe.");
                                $("#validar_descarga").show("slow");
                                setTimeout(function() {
                                    $("#validar_descarga").hide("slow");
                                }, 4000);                            
                                return false;
                            }else{
                                $("#titulos_academico").append("<option selected>"+$("#agrega_titulo_academico").val()+"</option>");
                                $("#titulos_academico").multiselect("refresh");
                                titulos.push($("#agrega_titulo_academico").val());
                                $("#agrega_titulo_academico").val("");
                            }
                        }
                    });

                    $("#boton_borra_titulo").click(function(){
                        $("#titulos_academico option:selected").each(function(){
                            titulos.splice($(this).index(),1);
                            $(this).remove();
                        });
                        $("#titulos_academico").multiselect("refresh");
                    });
            
                    $("#boton_agrega_area").click(function(){
                        if($("#agrega_area_academico").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El área de trabajo que se desea ingresar esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }else{
                            if(areas.indexOf($("#agrega_area_academico").val()) != -1){
                                $("#validar_descarga").removeClass("alert-success");
                                $("#validar_descarga").addClass("alert-danger");
                                $("#validar_descarga").html("<strong>ERROR!</strong> - El área de trabajo que se desea ingresar ya existe.");
                                $("#validar_descarga").show("slow");
                                setTimeout(function() {
                                    $("#validar_descarga").hide("slow");
                                }, 4000);                            
                                return false;
                            }else{
                                $("#areas_academico").append("<option selected>"+$("#agrega_area_academico").val()+"</option>");
                                $("#areas_academico").multiselect("refresh");
                                areas.push($("#agrega_area_academico").val());
                                $("#agrega_area_academico").val("");
                            }
                        }
                    });

                    $("#boton_borra_area").click(function(){
                        $("#areas_academico option:selected").each(function(){
                            areas.splice($(this).index(),1);
                            $(this).remove();
                        });
                        $("#areas_academico").multiselect("refresh");
                    }); 
                
                    $("#agregar_academico_boton").click(function(){
                        if($("#nombre_academico").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El nombre del académico esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);
                            return false;
                        }
                        if($("#tipoAcademico").val() == 0){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - Debe seleccionar un tipo de académico.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);
                            return false;
                        }
                        if($("#correo_academico").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El correo del académico esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }else{
                            var correo = $("#correo_academico").val().split("@");
                            if(correo.length == 1){
                                $("#validar_descarga").removeClass("alert-success");
                                $("#validar_descarga").addClass("alert-danger");
                                $("#validar_descarga").html("<strong>ERROR!</strong> - El formato del correo es incorrecto. Debe ser user@domain.cl");
                                $("#validar_descarga").show("slow");
                                setTimeout(function() {
                                    $("#validar_descarga").hide("slow");
                                }, 4000);                            
                                return false;
                            }else{
                                if(correo[1] != "uv.cl" && correo[1] != "alumnos.uv.cl"){
                                    $("#validar_descarga").removeClass("alert-success");
                                    $("#validar_descarga").addClass("alert-danger");
                                    $("#validar_descarga").html("<strong>ERROR!</strong> - El correo debe ser institucional (@uv.cl o @alumnos.uv.cl)");
                                    $("#validar_descarga").show("slow");
                                    setTimeout(function() {
                                        $("#validar_descarga").hide("slow");
                                    }, 4000);                            
                                    return false;
                                }    
                            }      
                        }
                        if($("input:radio[name=sexo_academico]:checked").val() == null){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - Debe seleccionar el sexo del académico.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;    
                        }

                        if(titulos.length == 0){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - No se han ingresado títulos del académico.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);
                            return false;
                        }else{
                            var control_seleccionado = 0;
                            $("#titulos_academico option:selected").each(function(){
                                control_seleccionado++;
                            });
                            if(control_seleccionado == 0){
                                $("#validar_descarga").removeClass("alert-success");
                                $("#validar_descarga").addClass("alert-danger");
                                $("#validar_descarga").html("<strong>ERROR!</strong> - De los títulos ingresados, no se ha seleccionado como minimo uno.");
                                $("#validar_descarga").show("slow");
                                setTimeout(function() {
                                    $("#validar_descarga").hide("slow");
                                }, 4000);
                                return false;
                            }
                        }

                        if(areas.length == 0){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - No se han ingresado áreas de trabajo del académico.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);
                            return false;
                        }else{
                            var control_seleccionado = 0;
                            $("#areas_academico option:selected").each(function(){
                                control_seleccionado++;
                            });
                            if(control_seleccionado == 0){
                                $("#validar_descarga").removeClass("alert-success");
                                $("#validar_descarga").addClass("alert-danger");
                                $("#validar_descarga").html("<strong>ERROR!</strong> - De las áreas de trabajo ingresadas, no se ha seleccionado como minimo una.");
                                $("#validar_descarga").show("slow");
                                setTimeout(function() {
                                    $("#validar_descarga").hide("slow");
                                }, 4000);
                                return false;
                            }
                        }

                        var control_asig = 0;
                        var control_asig_m = 0;
                        $("#asignatura_academico option:selected").each(function(){
                            control_asig++;
                        });
                        $("#asignaturasMEN_academico option:selected").each(function(){
                            control_asig_m++;
                        });

                        if(control_asig == 0 && control_asig_m == 0){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - No se han seleccionado asignaturas o especialidades para el académico.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);
                            return false;
                        }

                        if($("#foto_academico").val() != ""){
                            foto = $("#foto_academico").val();
                            var archivos = document.getElementById('foto_academico');
                            var documento = archivos.files;
                            var datta = new FormData();

                            for(var i=0;i<documento.length;i++){
                                datta.append('archivo'+i,documento[i]);
                            }

                            $.ajax({
                                url: '../../logica/uploadFotosPersonas.php',
                                type: 'POST',
                                async: true,
                                contentType: false,
                                processData: false,
                                cache: false,
                                data: datta,
                                success: function(datos_recibidos) {
                                    }
                            });
                        }

                    var pagina_web = "";
                    var fono = "Sin numero";
                    if($("#web_academico").val() != ""){
                        pagina_web = $("#web_academico").val();
                    }
                    if($("#fono_academico").val() !=""){
                        fono = $("#fono_academico").val();
                    }

                    var envio_titulos = "";
                    var envio_areas = "";
                    var envio_asig = "";
                    var envio_asig_m = "";

                    $("#titulos_academico option:selected").each(function(){
                        envio_titulos = envio_titulos+$(this).val()+"||";
                    });

                    $("#areas_academico option:selected").each(function(){
                        envio_areas = envio_areas+$(this).val()+"||";
                    });

                    $("#asignatura_academico option:selected").each(function(){
                        envio_asig = envio_asig+$(this).val()+"||";
                    });

                    $("#asignaturasMEN_academico option:selected").each(function(){
                        envio_asig_m = envio_asig_m+$(this).val()+"||";
                    }); 


                    $.ajax({
                        url: '../../logica/setNewPersonal.php',
                        type: 'POST',
                        async: true,
                        data: 'tipoPersonal=academico&nombreAca='+$("#nombre_academico").val()+'&tipoAca='+$("#tipoAcademico option:selected").val()+'&correoAca='+$("#correo_academico").val()+'&webAca='+pagina_web+'&fonoAca='+fono+'&sexoAca='+$("input:radio[name=sexo_academico]:checked").val()+'&fotoAca='+foto+'&titulosAca='+envio_titulos+'&areasAca='+envio_areas+'&asigAca='+envio_asig+'&asig_mAca='+envio_asig_m,
                        success: function(datos_recibidos){
                            if(datos_recibidos == "ok"){
                                        $("#validar_descarga").removeClass("alert-danger");
                                        $("#validar_descarga").addClass("alert-success");
                                        $("#validar_descarga").html("<strong>EXITO!</strong> - El académico <strong>"+$("#nombre_academico").val()+"</strong> ha sido ingresado al sistema con exito. Al cerrar esta ventana se recargará la página.");
                                        $("#validar_descarga").show("slow");
                                        $("#inputs_agrega_adm").html("");
                                        $(".modal-footer").html("");
                                        $("#myModal").on('hide.bs.modal', function(e){
                                            location.reload();
                                        });
                                    }
                                    if(datos_recibidos == "error"){
                                        $("#validar_descarga").removeClass("alert-success");
                                        $("#validar_descarga").addClass("alert-danger");
                                        $("#validar_descarga").html("<strong>ERROR!</strong> - El académico no se ha ingresado al sistema. Intente nuevamente.");
                                        $("#validar_descarga").show("slow");
                                        setTimeout(function() {
                                            $("#validar_descarga").hide("slow");
                                        }, 4000);                            
                                        return false;
                                    }
                                    if(datos_recibidos == "existe"){
                                        $("#validar_descarga").removeClass("alert-success");
                                        $("#validar_descarga").addClass("alert-danger");
                                        $("#validar_descarga").html("<strong>ERROR!</strong> - El académico que se quiere ingresar ya existe en el sistema.");
                                        $("#validar_descarga").show("slow");
                                        setTimeout(function() {
                                            $("#validar_descarga").hide("slow");
                                        }, 4000);                            
                                        return false;
                                    }
                        }
                    });


                    });
                });

                // ---------------------- AGREGAR ADMINISTRATIVO
                $("#agregarAdministrativo").click(function(){
                    $("#myModalLabel").html("Agregar un Administrativo");
                    $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                    $("#cuerpoModal").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_descarga'></div></div></div><div class='row' id='inputs_agrega_adm'><div class='col-lg-12'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-4 control-label' for='nombre_adm'>Nombre</label><div class='col-md-4'><input id='nombre_adm' name='nombre_adm' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-4 control-label' for='cargo_adm'>Cargo</label><div class='col-md-4'><input id='cargo_adm' name='cargo_adm' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-4 control-label' for='correo_adm'>Correo UV</label><div class='col-md-4'><input id='correo_adm' name='correo_adm' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-4 control-label' for='sexo'>Sexo</label><div class='col-md-4'><div class='radio'><label for='sexo_adm1'><input type='radio' name='sexo_adm' id='sexo_adm1' value='M'>Masculino</label></div><div class='radio'><label for='sexo_adm2'><input type='radio' name='sexo_adm' id='sexo_adm2' value='F'>Femenino</label></div></div></div><div class='form-group'><label class='col-md-4 control-label' for='foto_adm'>Foto</label><div class='col-lg-4'><input id='foto_adm' name='foto_adm' class='input-file' type='file' accept='image/*'></div></div><div class='form-group'><label class='col-md-4 control-label'></label><div class='col-md-8'><a id='agregar_adm_boton' name='agregar_adm_boton' class='btn btn-success'><span class='glyphicon glyphicon-hand-down'></span> Agregar</a><a style='margin-left:2%;' id='reset_adm' name='reset_adm' class='btn btn-danger' ><span class='glyphicon glyphicon-remove'></span> Reset</a></div></div></fieldset></form></div></div>");
                    $('#myModal').modal({show:true});

                    $("#validar_descarga").hide();

                    var foto = "sin_foto";

                    $("#agregar_adm_boton").click(function(){
                        if($("#nombre_adm").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El nombre del administrativo esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }

                        if($("#cargo_adm").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El cargo del administrativo esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }

                        if($("#correo_adm").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El correo del administrativo esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }else{
                            var correo = $("#correo_adm").val().split("@");
                            if(correo.length == 1){
                                $("#validar_descarga").removeClass("alert-success");
                                $("#validar_descarga").addClass("alert-danger");
                                $("#validar_descarga").html("<strong>ERROR!</strong> - El formato del correo es incorrecto. Debe ser user@domain.cl");
                                $("#validar_descarga").show("slow");
                                setTimeout(function() {
                                    $("#validar_descarga").hide("slow");
                                }, 4000);                            
                                return false;
                            }else{
                                if(correo[1] != "uv.cl" && correo[1] != "alumnos.uv.cl"){
                                    $("#validar_descarga").removeClass("alert-success");
                                    $("#validar_descarga").addClass("alert-danger");
                                    $("#validar_descarga").html("<strong>ERROR!</strong> - El correo debe ser institucional (@uv.cl o @alumnos.uv.cl)");
                                    $("#validar_descarga").show("slow");
                                    setTimeout(function() {
                                        $("#validar_descarga").hide("slow");
                                    }, 4000);                            
                                    return false;
                                }    
                            }      
                        }
                        if($("input:radio[name=sexo_adm]:checked").val() == null){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - Debe seleccionar el sexo del administrativo.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;    
                        }

                        if($("#foto_adm").val() != ""){
                            foto = $("#foto_adm").val();
                            var archivos = document.getElementById('foto_adm');
                            var documento = archivos.files;
                            var datta = new FormData();

                            for(var i=0;i<documento.length;i++){
                                datta.append('archivo'+i,documento[i]);
                            }

                            $.ajax({
                                url: '../../logica/uploadFotosPersonas.php',
                                type: 'POST',
                                async: true,
                                contentType: false,
                                processData: false,
                                cache: false,
                                data: datta,
                                success: function(datos_recibidos) {
                                    }
                            });
                        }

                        $.ajax({
                            url: '../../logica/setNewPersonal.php',
                            type: 'POST',
                            async: true,
                            data: 'tipoPersonal=adm&nombreAdm='+$("#nombre_adm").val()+'&cargoAdm='+$("#cargo_adm").val()+'&correoAdm='+$("#correo_adm").val()+'&sexoAdm='+$("input:radio[name=sexo_adm]:checked").val()+'&fotoAdm='+foto,
                            success: function(datos_recibidos) {
                                    if(datos_recibidos == "ok"){
                                        $("#validar_descarga").removeClass("alert-danger");
                                        $("#validar_descarga").addClass("alert-success");
                                        $("#validar_descarga").html("<strong>EXITO!</strong> - El administrativo <strong>"+$("#nombre_adm").val()+"</strong> ha sido ingresado al sistema con exito. Al cerrar esta ventana se recargará la página.");
                                        $("#validar_descarga").show("slow");
                                        $("#inputs_agrega_adm").html("");
                                        $(".modal-footer").html("");
                                        $("#myModal").on('hide.bs.modal', function(e){
                                            location.reload();
                                        });
                                    }
                                    if(datos_recibidos == "error"){
                                        $("#validar_descarga").removeClass("alert-success");
                                        $("#validar_descarga").addClass("alert-danger");
                                        $("#validar_descarga").html("<strong>ERROR!</strong> - El administrativo no se ha ingresado al sistema. Intente nuevamente.");
                                        $("#validar_descarga").show("slow");
                                        setTimeout(function() {
                                            $("#validar_descarga").hide("slow");
                                        }, 4000);                            
                                        return false;
                                    }
                                    if(datos_recibidos == "existe"){
                                        $("#validar_descarga").removeClass("alert-success");
                                        $("#validar_descarga").addClass("alert-danger");
                                        $("#validar_descarga").html("<strong>ERROR!</strong> - El administrativo que se quiere ingresar ya existe en el sistema.");
                                        $("#validar_descarga").show("slow");
                                        setTimeout(function() {
                                            $("#validar_descarga").hide("slow");
                                        }, 4000);                            
                                        return false;
                                    }
                                }
                        });
                    });
                });
                
                // ---------------------- AGREGAR AYUDANTE
                $("#agregarAyudante").click(function(){
                    $("#myModalLabel").html("Agregar un Ayudante de Laboratorio");
                    $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                    $("#cuerpoModal").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_descarga'></div></div></div><div class='row' id='inputs_agrega_ayudante'><div class='col-lg-12'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-4 control-label' for='nombre_ayudante'>Nombre</label><div class='col-md-4'><input id='nombre_ayudante' name='nombre_ayudante' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-4 control-label' for='correo_ayudante'>Correo UV</label><div class='col-md-4'><input id='correo_ayudante' name='correo_ayudante' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-4 control-label' for='sexo'>Sexo</label><div class='col-md-4'><div class='radio'><label for='sexo_ayudante1'><input type='radio' name='sexo_ayudante' id='sexo_ayudante1' value='M'>Masculino</label></div><div class='radio'><label for='sexo_ayudante2'><input type='radio' name='sexo_ayudante' id='sexo_ayudante2' value='F'>Femenino</label></div></div></div><div class='form-group'><label class='col-md-4 control-label' for='foto_ayudante'>Foto</label><div class='col-lg-4'><input id='foto_ayudante' name='foto_ayudante' class='input-file' type='file' accept='image/*'></div></div><div class='form-group'><label class='col-md-4 control-label'></label><div class='col-md-8'><a id='agregar_ayudante_boton' name='agregar_ayudante_boton' class='btn btn-success'><span class='glyphicon glyphicon-hand-down'></span> Agregar</a><a style='margin-left:2%;' id='reset_ayudante' name='reset_ayudante' class='btn btn-danger' ><span class='glyphicon glyphicon-remove'></span> Reset</a></div></div></fieldset></form></div></div>");
                    $('#myModal').modal({show:true});

                    $("#validar_descarga").hide();

                    var foto = "sin_foto";

                    $("#agregar_ayudante_boton").click(function(){
                        if($("#nombre_ayudante").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El nombre del ayudante esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }
                        if($("#correo_ayudante").val() == ""){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - El correo del ayudante esta vacio.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;
                        }else{
                            var correo = $("#correo_ayudante").val().split("@");
                            if(correo.length == 1){
                                $("#validar_descarga").removeClass("alert-success");
                                $("#validar_descarga").addClass("alert-danger");
                                $("#validar_descarga").html("<strong>ERROR!</strong> - El formato del correo es incorrecto. Debe ser user@domain.cl");
                                $("#validar_descarga").show("slow");
                                setTimeout(function() {
                                    $("#validar_descarga").hide("slow");
                                }, 4000);                            
                                return false;
                            }else{
                                if(correo[1] != "uv.cl" && correo[1] != "alumnos.uv.cl"){
                                    $("#validar_descarga").removeClass("alert-success");
                                    $("#validar_descarga").addClass("alert-danger");
                                    $("#validar_descarga").html("<strong>ERROR!</strong> - El correo debe ser institucional (@uv.cl o @alumnos.uv.cl)");
                                    $("#validar_descarga").show("slow");
                                    setTimeout(function() {
                                        $("#validar_descarga").hide("slow");
                                    }, 4000);                            
                                    return false;
                                }    
                            }      
                        }
                        if($("input:radio[name=sexo_ayudante]:checked").val() == null){
                            $("#validar_descarga").removeClass("alert-success");
                            $("#validar_descarga").addClass("alert-danger");
                            $("#validar_descarga").html("<strong>ERROR!</strong> - Debe seleccionar el sexo del ayudante.");
                            $("#validar_descarga").show("slow");
                            setTimeout(function() {
                                $("#validar_descarga").hide("slow");
                            }, 4000);                            
                            return false;    
                        }

                        if($("#foto_ayudante").val() != ""){
                            foto = $("#foto_ayudante").val();
                            var archivos = document.getElementById('foto_ayudante');
                            var documento = archivos.files;
                            var datta = new FormData();

                            for(var i=0;i<documento.length;i++){
                                datta.append('archivo'+i,documento[i]);
                            }

                            $.ajax({
                                url: '../../logica/uploadFotosPersonas.php',
                                type: 'POST',
                                async: true,
                                contentType: false,
                                processData: false,
                                cache: false,
                                data: datta,
                                success: function(datos_recibidos) {
                                    }
                            });
                        }

                        $.ajax({
                            url: '../../logica/setNewPersonal.php',
                            type: 'POST',
                            async: true,
                            data: 'tipoPersonal=ayudante&nombreAyu='+$("#nombre_ayudante").val()+'&correoAyu='+$("#correo_ayudante").val()+'&sexoAyu='+$("input:radio[name=sexo_ayudante]:checked").val()+'&fotoAyu='+foto,
                            success: function(datos_recibidos) {
                                    if(datos_recibidos == "ok"){
                                        $("#validar_descarga").removeClass("alert-danger");
                                        $("#validar_descarga").addClass("alert-success");
                                        $("#validar_descarga").html("<strong>EXITO!</strong> - El ayudante <strong>"+$("#nombre_ayudante").val()+"</strong> ha sido ingresado al sistema con exito. Al cerrar esta ventana se recargará la página.");
                                        $("#validar_descarga").show("slow");
                                        $("#inputs_agrega_ayudante").html("");
                                        $(".modal-footer").html("");
                                        $("#myModal").on('hide.bs.modal', function(e){
                                            location.reload();
                                        });                           
                                    }
                                    if(datos_recibidos == "error"){
                                        $("#validar_descarga").removeClass("alert-success");
                                        $("#validar_descarga").addClass("alert-danger");
                                        $("#validar_descarga").html("<strong>ERROR!</strong> - El ayudante no se ha ingresado al sistema. Intente nuevamente.");
                                        $("#validar_descarga").show("slow");
                                        setTimeout(function() {
                                            $("#validar_descarga").hide("slow");
                                        }, 4000);                            
                                        return false;
                                    }
                                    if(datos_recibidos == "existe"){
                                        $("#validar_descarga").removeClass("alert-success");
                                        $("#validar_descarga").addClass("alert-danger");
                                        $("#validar_descarga").html("<strong>ERROR!</strong> - El ayudante que se quiere ingresar ya existe en el sistema.");
                                        $("#validar_descarga").show("slow");
                                        setTimeout(function() {
                                            $("#validar_descarga").hide("slow");
                                        }, 4000);                            
                                        return false;
                                    }
                                }
                        });
                    });
                });
    
                // ---------------------- MOSTRAR AYUDANTE
                $(".mostrarAyudante").click(function(){
                    //alert($(this).attr("id"));
                    var tmp = $(this).attr("id").split("_");
                    $.ajax({
                        url: '../../logica/getPersonalAdmin.php',
                        type: 'POST',
                        async: true,
                        data: 'obtener=ayudante&idPerson='+tmp[1],
                        success: function(datos_recibidos) {
                            var data_recived = datos_recibidos.split("++");
                            $("#myModalLabel").html("Ayudante de Laboratorio: "+data_recived[0]);
                            var status = "";
                            if(data_recived[3]==1){
                                status = "Activo";
                            }else{
                                status = "No activo";
                            }
                            $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                            $("#cuerpoModal").html("<div class='row'><div class='col-lg-6'><p><strong>Correo: </strong>"+data_recived[1]+"</p><p><strong>Estado: </strong>"+status+"</p></div><div class='col-lg-6'><img src='"+data_recived[2]+"' width='320' heigth='320'></div></div>");
                            $('#myModal').modal({show:true});
                        }
                    });
                });
                
                // ---------------------- MOSTRAR ADMINISTRATIVO
                $(".mostrarAdministrativo").click(function(){
                    //alert($(this).attr("id"));
                    var tmp = $(this).attr("id").split("_");
                    $.ajax({
                        url: '../../logica/getPersonalAdmin.php',
                        type: 'POST',
                        async: true,
                        data: 'obtener=administrativo&idPerson='+tmp[1],
                        success: function(datos_recibidos) {
                            var data_recived = datos_recibidos.split("++");
                            $("#myModalLabel").html("Administrativo: "+data_recived[0]);
                            var status = "";
                            if(data_recived[4]==1){
                                status = "Activo";
                            }else{
                                status = "No activo";
                            }
                            $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                            $("#cuerpoModal").html("<div class='row'><div class='col-lg-6'><p><strong>Correo: </strong>"+data_recived[2]+"</p><p><strong>Cargo: </strong>"+data_recived[1]+"</p><p><strong>Estado: </strong>"+status+"</p></div><div class='col-lg-6'><img src='"+data_recived[3]+"' width='320' heigth='320'></div></div>");
                            $('#myModal').modal({show:true});
                        }
                    });
                });

                // ---------------------- MOSTRAR ACADEMICO
                $(".mostrarAcademico").click(function(){
                    //alert($(this).attr("id"));
                    var tmp = $(this).attr("id").split("_");
                    $.ajax({
                    url: '../../logica/getInfoPersonal.php',
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
                            $(".modal-title").html("Académico: "+personales[0]);
                             $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                            $(".modal-body").html("<div class='row'><div class='col-sm-7'><h4 align='center'>"+personales[1]+"</h4><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-list-alt'></span> Títulos</a><br><ul class='listado_titulos'></ul><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-lock'></span> Áreas de Trabajo</a><br><ul class='listado_areas'></ul><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-book'></span> Asignaturas Dictadas</a><br><ul class='listado_asignaturas'></ul><a class='btn btn-block btn-xs btn-primary'><span class='glyphicon glyphicon-earphone'></span> Contacto</a><br><ul><li>Fono: "+personales[4]+"</li><li>Correo: "+personales[2]+"</li><li>Web: <a href='http://"+personales[3]+"' target='_blank'>"+personales[3]+"</a></li></ul></div><div class='col-sm-4'><img src='"+personales[5]+"'></div></div>");
                            
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

           }
    });

});