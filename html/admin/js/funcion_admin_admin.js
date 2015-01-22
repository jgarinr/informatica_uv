$( document ).ready(function() {
	
    $.ajax({
        url: '../../logica/getUsuarios.php',
        type: 'POST',
        async: true,
        success: function(datos_recibidos) {
            usuarios_recibidos = datos_recibidos.split("||");
            for (var i = 0; i<usuarios_recibidos.length - 1; i++) {
                datos_persona = usuarios_recibidos[i].split("++");
                $("#usuarios_tabla_cuerpo").append("<tr><td id='campo1_"+i+"'>"+datos_persona[1]+"</td><td id='campo2_"+i+"'>"+datos_persona[2]+"</td><td id='campo3_"+i+"'>"+datos_persona[0]+"</td><td id='campo4_"+i+"'>"+datos_persona[3]+"</td><td id='campo5_"+i+"'>"+datos_persona[4]+"</td><td align='center'><button type='button' class='btn btn-primary modificar' id='modUser_"+i+"_"+datos_persona[0]+"'><span class='glyphicon glyphicon-pencil'></span></button></td><td align='center'><button type='button' class='btn btn-primary btn-danger eliminar' id='deleteUser_"+i+"_"+datos_persona[0]+"'><span class='glyphicon glyphicon-remove'></span></button></td></tr>");
            }

            $(".modificar").click(function(){
                var data = $(this).attr("id").split("_");
                $(".modal-title").html("Modificar Usuario: "+$("#campo1_"+data[1]).text()+" "+$("#campo2_"+data[1]).text()+" - "+$("#campo3_"+data[1]).text());
                $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>")
                $(".modal-body").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_mod'></div></div></div><div class='row'><div class='col-lg-12'><form class='form-horizontal' id='formulario_mod_user'><fieldset><div class='form-group'><label class='col-md-3 control-label' for='nombre_usuario_mod'>Nombre</label><div class='col-md-5'><input id='nombre_usuario_mod' name='nombre_usuario_mod' type='text' class='form-control input-md' value='"+$("#campo1_"+data[1]).text()+"'></div></div><div class='form-group'><label class='col-md-3 control-label' for='apellido_usuario_mod'>Apellido</label><div class='col-md-5'><input id='apellido_usuario_mod' name='apellido_usuario_mod' type='text' class='form-control input-md' value='"+$("#campo2_"+data[1]).text()+"'></div></div><div class='form-group'><label class='col-md-3 control-label' for='rut_usuario_mod'>RUT</label><div class='col-md-5'><input id='rut_usuario_mod' name='rut_usuario_mod' type='text' class='form-control input-md' value='"+$("#campo3_"+data[1]).text()+"'></div></div><div class='form-group'><label class='col-md-3 control-label' for='email_usuario_mod'>Correo</label><div class='col-md-5'><input id='email_usuario_mod' name='email_usuario_mod' type='text' class='form-control input-md' value='"+$("#campo4_"+data[1]).text()+"'></div></div><div class='form-group'><label class='col-md-3 control-label' for='nickname_usuario_mod'>Nickname</label><div class='col-md-5'><input id='nickname_usuario_mod' name='nickname_usuario_mod' type='text' class='form-control input-md' value='"+$("#campo5_"+data[1]).text()+"'></div></div><div class='form-group'><label class='col-md-3 control-label' for='boton_usuario_mod'></label><div class='col-md-5'><a id='boton_usuario_mod' name='boton_usuario_mod' class='btn btn-success' style='margin-right:4%;'><span class='glyphicon glyphicon-ok'></span> Modificar</a><a id='boton_usuario_reset_mod' name='boton_usuario_reset_mod' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Reset</a></div></div></fieldset></form></div></div>");
                $("#validar_mod").hide();
                $('#myModal').modal({show:true});

                $("#boton_usuario_mod").click(function(){
                    if($("#nombre_usuario_mod").val() == ""){
                        $("#validar_mod").html("<strong>ERROR!</strong> - El nombre del usuario esta vacio.");
                        $("#validar_mod").removeClass("alert-success");
                        $("#validar_mod").addClass("alert-danger");
                        $("#validar_mod").show("slow");
                        setTimeout(function() {
                            $('#validar_mod').hide('slow');
                        }, 5000);
                        return false;
                    }
                    if($("#apellido_usuario_mod").val() == ""){
                        $("#validar_mod").html("<strong>ERROR!</strong> - El apellido del usuario esta vacio.");
                        $("#validar_mod").removeClass("alert-success");
                        $("#validar_mod").addClass("alert-danger");
                        $("#validar_mod").show("slow");
                        setTimeout(function() {
                            $('#validar_mod').hide('slow');
                        }, 5000);
                        return false;
                    }
                    if($("#rut_usuario_mod").val() == ""){
                        $("#validar_mod").html("<strong>ERROR!</strong> - El RUT del usuario esta vacio.");
                        $("#validar_mod").removeClass("alert-success");
                        $("#validar_mod").addClass("alert-danger");
                        $("#validar_mod").show("slow");
                        setTimeout(function() {
                            $('#validar_mod').hide('slow');
                        }, 5000);
                        return false;
                    }else{
                        if ($.Rut.validar($("#rut_usuario_mod").val()) == false ){
                            $("#validar_mod").html("<strong>ERROR!</strong> - El RUT del es incorrecto. El formato debe ser: 12345678-9.");
                            $("#validar_mod").removeClass("alert-success");
                            $("#validar_mod").addClass("alert-danger");
                            $("#validar_mod").show("slow");
                            setTimeout(function() {
                                $('#validar_mod').hide('slow');
                            }, 5000);
                            return false;
                        }
                    }
                    if($("#email_usuario_mod").val() == ""){
                        $("#validar_mod").html("<strong>ERROR!</strong> - El correo del usuario esta vacio.");
                        $("#validar_mod").removeClass("alert-success");
                        $("#validar_mod").addClass("alert-danger");
                        $("#validar_mod").show("slow");
                        setTimeout(function() {
                            $('#validar_mod').hide('slow');
                        }, 5000);
                        return false;
                    }else{
                        var datos_correo = $("#email_usuario_mod").val().split("@");
                        if(datos_correo.length == 1){
                            $("#validar_mod").html("<strong>ERROR!</strong> - El correo del usuario no tiene el formato correcto. Este debe ser name@domain.cl");
                            $("#validar_mod").removeClass("alert-success");
                            $("#validar_mod").addClass("alert-danger");
                            $("#validar_mod").show("slow");
                            setTimeout(function() {
                                $('#validar_mod').hide('slow');
                            }, 5000);
                            return false;  
                        }else{
                            if(datos_correo[1]!="uv.cl" && datos_correo[1]!="alumnos.uv.cl"){
                                $("#validar_mod").html("<strong>ERROR!</strong> - El correo tiene que ser @uv.cl o @alumnos.uv.cl");
                                $("#validar_mod").removeClass("alert-success");
                                $("#validar_mod").addClass("alert-danger");
                                $("#validar_mod").show("slow");
                                setTimeout(function() {
                                    $('#validar_mod').hide('slow');
                                }, 5000);
                                return false;
                            }
                        }
                    }
                    if($("#nickname_usuario_mod").val() == ""){
                        $("#validar_mod").html("<strong>ERROR!</strong> - El apodo del usuario esta vacio.");
                        $("#validar_mod").removeClass("alert-success");
                        $("#validar_mod").addClass("alert-danger");
                        $("#validar_mod").show("slow");
                        setTimeout(function() {
                            $('#validar_mod').hide('slow');
                        }, 5000);
                        return false;
                    }

                    $.ajax({
                        url: '../../logica/updateUsuarios.php',
                        type: 'POST',
                        async: true,
                        data: 'funcion=update&rut='+$("#rut_usuario_mod").val()+'&nombre='+$("#nombre_usuario_mod").val()+'&apellido='+$("#apellido_usuario_mod").val()+'&correo='+$("#email_usuario_mod").val()+'&nick='+$("#nickname_usuario_mod").val(),
                        success: function(datos_recibidos) {
                                if(datos_recibidos == "ok"){
                                    $(".modal-body").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_mod'></div></div></div>");
                                    $(".modal-footer").html("");
                                    $("#validar_mod").addClass("alert-success");
                                    $("#validar_mod").html("<strong>EXITO!</strong> - El usuario <strong>"+$("#campo1_"+data[1]).text()+" "+$("#campo2_"+data[1]).text()+" - "+$("#campo3_"+data[1]).text()+"</strong> ha sido modificado satisfactoriamente. Al cerrar esta ventana se recargará la página.")
                                    $("#validar_mod").show("slow");
                                    $("#myModal").on('hide.bs.modal', function(e){
                                        location.reload();
                                    });
                                }else{
                                    $(".modal-body").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_mod'></div></div></div>");
                                    $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                                    $("#validar_mod").addClass("alert-danger");
                                    $("#validar_mod").html("<strong>ERROR!</strong> - El usuario <strong>"+$("#campo1_"+data[1]).text()+" "+$("#campo2_"+data[1]).text()+" - "+$("#campo3_"+data[1]).text()+"</strong> no ha sido modificado o no se han encontrado cambios. Intente nuevamente.")
                                    $("#validar_mod").show("slow");
                                }  
                            }
                    });                            


                });

                $("#boton_usuario_reset_mod").click(function(){
                    $("#nombre_usuario_mod").val($("#campo1_"+data[1]).text());
                    $("#apellido_usuario_mod").val($("#campo2_"+data[1]).text());
                    $("#rut_usuario_mod").val($("#campo3_"+data[1]).text());
                    $("#email_usuario_mod").val($("#campo4_"+data[1]).text());
                    $("#nickname_usuario_mod").val($("#campo5_"+data[1]).text());
                });       
            });

            $(".eliminar").click(function(){
                var data = $(this).attr("id").split("_");
                $(".modal-title").html("Borrar Usuario");
                $(".modal-footer").html("<button type='button' class='btn btn-success' id='boton_aprobar_delete'><span class='glyphicon glyphicon-ok'></span> Borrar</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>")
                $(".modal-body").html("<div class='row'><div class='col-lg-12'>Quieres borrar al usuario <strong>"+$("#campo1_"+data[1]).text()+" "+$("#campo2_"+data[1]).text()+" - "+$("#campo3_"+data[1]).text()+"</strong></div></div>");
                $("#validar_mod").hide();
                $('#myModal').modal({show:true});

                $("#boton_aprobar_delete").click(function(){
                    $.ajax({
                        url: '../../logica/updateUsuarios.php',
                        type: 'POST',
                        async: true,
                        data: 'funcion=delete&rut='+$("#campo3_"+data[1]).text(),
                        success: function(datos_recibidos) {
                                if(datos_recibidos == "ok"){
                                    $(".modal-body").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_mod'></div></div></div>");
                                    $(".modal-footer").html("");
                                    $("#validar_mod").addClass("alert-success");
                                    $("#validar_mod").html("<strong>EXITO!</strong> - El usuario <strong>"+$("#campo1_"+data[1]).text()+" "+$("#campo2_"+data[1]).text()+" - "+$("#campo3_"+data[1]).text()+"</strong> ha sido eliminado satisfactoriamente. Al cerrar esta ventana se recargará la página.")
                                    $("#validar_mod").show("slow");
                                    $("#myModal").on('hide.bs.modal', function(e){
                                        location.reload();
                                    });
                                }else{
                                    $(".modal-body").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_mod'></div></div></div>");
                                    $(".modal-footer").html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>");
                                    $("#validar_mod").addClass("alert-danger");
                                    $("#validar_mod").html("<strong>ERROR!</strong> - El usuario <strong>"+$("#campo1_"+data[1]).text()+" "+$("#campo2_"+data[1]).text()+" - "+$("#campo3_"+data[1]).text()+"</strong> no ha sido eliminado satisfactoriamente. Intente nuevamente.")
                                    $("#validar_mod").show("slow");
                                }           
                            }
                    });        
                });

            });


            $('#usuarios_tabla').dataTable({
                "scrollCollapse": true,
                "searching": false,
                "info": false,
                "paging": false
            });
        }
    });


    $("#validar_descarga").hide();

       $("#boton_salir_admin").click(function(){
        $(".modal-title").html("Cierre de Sesion");
        $(".modal-footer").html("<button type='button' class='btn btn-success' id='boton_aprobar_cierre'><span class='glyphicon glyphicon-ok'></span> Aprobar</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>")
        $(".modal-body").html("Esta seguro de que desea cerrar la sesion");
        $('#myModal').modal({show:true});
        $("#boton_aprobar_cierre").click(function(){
            $(location).attr('href','../../logica/cierra_sesion.php');
        });
    });
    
   $("#boton_agregar_usuario_reset").click(function(){
        document.getElementById('formulario_add_user').reset();
   });

   $("#boton_agregar_usuario").click(function(){
        if($("#nombre_usuario").val() == ""){
            $("#validar_descarga").html("<strong>ERROR!</strong> - El nombre del nuevo usuario esta vacio.");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }
        if($("#apellido_usuario").val() == ""){
            $("#validar_descarga").html("<strong>ERROR!</strong> - El apellido del nuevo usuario esta vacio.");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }
        if($("#rut_usuario").val() == ""){
            $("#validar_descarga").html("<strong>ERROR!</strong> - El RUT del nuevo usuario esta vacio.");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }else{
            if ($.Rut.validar($("#rut_usuario").val()) == false ){
                $("#validar_descarga").html("<strong>ERROR!</strong> - El RUT del nuevo es incorrecto. El formato debe ser: 12345678-9.");
                $("#validar_descarga").removeClass("alert-success");
                $("#validar_descarga").addClass("alert-danger");
                $("#validar_descarga").show("slow");
                setTimeout(function() {
                    $('#validar_descarga').hide('slow');
                }, 5000);
                return false;
            }
        }
        if($("#email_usuario").val() == ""){
            $("#validar_descarga").html("<strong>ERROR!</strong> - El correo del nuevo usuario esta vacio.");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }else{
            var datos_correo = $("#email_usuario").val().split("@");
            if(datos_correo.length == 1){
                $("#validar_descarga").html("<strong>ERROR!</strong> - El correo del nuevo usuario no tiene el formato correcto. Este debe ser name@domain.cl");
                $("#validar_descarga").removeClass("alert-success");
                $("#validar_descarga").addClass("alert-danger");
                $("#validar_descarga").show("slow");
                setTimeout(function() {
                    $('#validar_descarga').hide('slow');
                }, 5000);
                return false;  
            }else{
                if(datos_correo[1]!="uv.cl" && datos_correo[1]!="alumnos.uv.cl"){
                    $("#validar_descarga").html("<strong>ERROR!</strong> - El correo tiene que ser @uv.cl o @alumnos.uv.cl");
                    $("#validar_descarga").removeClass("alert-success");
                    $("#validar_descarga").addClass("alert-danger");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);
                    return false;
                }
            }
        }
        if($("#nickname_usuario").val() == ""){
            $("#validar_descarga").html("<strong>ERROR!</strong> - El apodo del nuevo usuario esta vacio.");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }

        $.ajax({
        url: '../../logica/setNewUsuario.php',
        type: 'POST',
        async: true,
        data: 'first='+$("#nombre_usuario").val()+'&last='+$("#apellido_usuario").val()+'&rut='+$("#rut_usuario").val()+'&correo='+$("#email_usuario").val()+'&apodo='+$("#nickname_usuario").val(),
        success: function(datos_recibidos) {
                if(datos_recibidos == "existe"){
                    $("#validar_descarga").html("<strong>ERROR!</strong> - El usuario de rut <strong>"+$("#rut_usuario").val()+"</strong> ya esta registrado en el sistema. Ingrese un usuario distinto.");
                    $("#validar_descarga").removeClass("alert-success");
                    $("#validar_descarga").addClass("alert-danger");
                    document.getElementById('formulario_add_user').reset();
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);
                }
                if(datos_recibidos == "ok"){
                    $("#validar_descarga").html("<strong>EXITO</strong> - El usuario <strong>"+$("#nombre_usuario").val()+" "+$("#apellido_usuario").val()+"</strong> ha sido registrado con exito. Se recargará la página para actualizar la información.");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    document.getElementById('formulario_add_user').reset();
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                }
                if(datos_recibidos == "error"){
                    $("#validar_descarga").html("<strong>ERROR!</strong> - El nuevo usuario no se pudo registrar. Intente nuevamente.");
                    $("#validar_descarga").removeClass("alert-success");
                    $("#validar_descarga").addClass("alert-danger");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);
                }
            }
        });
   });

});