$( document ).ready(function() {
	var nombre = "";
    var apellido =  "";
    var correo = "";
    var contraseña = "";
    var apodo = "";
    var rut = "";
    
    $("#link_modifica_nombre_usuario").attr("disabled","disabled");
    $("#link_modifica_apellido_usuario").attr("disabled","disabled");
    $("#link_modifica_email_usuario").attr("disabled","disabled");
    $("#link_modifica_contraseña_usuario").attr("disabled","disabled");
    $("#link_modifica_nickname_usuario").attr("disabled","disabled");

    $("#validar_descarga").hide();

       $("#boton_salir_admin").click(function(){
        $(".modal-title").html("Cierre de Sesion");
        $(".modal-body").html("Esta seguro de que desea cerrar la sesion");
        $('#myModal').modal({show:true});
        $("#boton_aprobar_cierre").click(function(){
            $(location).attr('href','../../logica/cierra_sesion.php');
        });
    });

    $.ajax({
        url: '../../logica/getDatosUsuario.php',
        type: 'POST',
        async: true,
        data: 'rut='+$("#datos_ocultos").val(),
        success: function(datos_recibidos) {
                var data = datos_recibidos.split("||");
                $("#nombre_usuario").val(data[0]);
                nombre = data[0];
                $("#apellido_usuario").val(data[1]);
                apellido = data[1];
                $("#email_usuario").val(data[2]);
                correo =data[2]
                contraseña = data[3]
                rut = data[4];
                $("#nickname_usuario").val(data[5]);
                apodo = data[5];
            }
    });

    $("#nombre_usuario").keyup(function(){
        if($(this).val() != nombre){
            $("#link_modifica_nombre_usuario").removeAttr("disabled");
        }else{
            $("#link_modifica_nombre_usuario").attr("disabled","disabled");
        }
    });

    $("#apellido_usuario").keyup(function(){
        if($(this).val() != apellido){
            $("#link_modifica_apellido_usuario").removeAttr("disabled");
        }else{
            $("#link_modifica_apellido_usuario").attr("disabled","disabled");
        }
    });

    $("#email_usuario").keyup(function(){
        if($(this).val() != correo){
            $("#link_modifica_email_usuario").removeAttr("disabled");
        }else{
            $("#link_modifica_email_usuario").attr("disabled","disabled");
        }
    });

    $("#contraseña_usuario_actual").keyup(function(){
        if($(this).val() == contraseña){
            $("#link_modifica_contraseña_usuario").removeAttr("disabled");
        }else{
            $("#link_modifica_contraseña_usuario").attr("disabled","disabled");
        }
    });

    $("#nickname_usuario").keyup(function(){
        if($(this).val() != apodo){
            $("#link_modifica_nickname_usuario").removeAttr("disabled");
        }else{
            $("#link_modifica_nickname_usuario").attr("disabled","disabled");
        }
    });

   //BOTON MODIFICA NOMBRE USUARIO

   $("#link_modifica_nombre_usuario").click(function(){
        $.ajax({
        url: '../../logica/setDatosUsuario.php',
        type: 'POST',
        async: true,
        data: 'data='+$("#nombre_usuario").val()+'&rut='+rut+'&tipo=nombre',
        success: function(datos_recibidos) {
                if(datos_recibidos == 1){
                    nombre = $("#nombre_usuario").val();
                    $("#link_modifica_nombre_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>EXITO! - </strong>El nombre del usuario ha sido modificado con exito");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);
                }else{
                    $("#nombre_usuario").val(nombre);
                    $("#link_modifica_nombre_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>ERROR! - </strong>El nombre del usuario no se pudo cambiar. Intente nuevamente");
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
    
    //BOTON MODIFICA APELLIDO USUARIO

    $("#link_modifica_apellido_usuario").click(function(){
        $.ajax({
        url: '../../logica/setDatosUsuario.php',
        type: 'POST',
        async: true,
        data: 'data='+$("#apellido_usuario").val()+'&rut='+rut+'&tipo=apellido',
        success: function(datos_recibidos) {
                if(datos_recibidos == 1){
                    apellido = $("#apellido_usuario").val();
                    $("#link_modifica_apellido_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>EXITO! - </strong>El apellido del usuario ha sido modificado con exito");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);
                }else{
                    $("#apellido_usuario").val(apellido);
                    $("#link_modifica_apellido_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>ERROR! - </strong>El apellido del usuario no se pudo cambiar. Intente nuevamente");
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

    //BOTON MODIFICA EMAIL USUARIO

   $("#link_modifica_email_usuario").click(function(){
        $.ajax({
        url: '../../logica/setDatosUsuario.php',
        type: 'POST',
        async: true,
        data: 'data='+$("#email_usuario").val()+'&rut='+rut+'&tipo=mail',
        success: function(datos_recibidos) {
                if(datos_recibidos == 1){
                    correo = $("#email_usuario").val();
                    $("#link_modifica_email_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>EXITO! - </strong>El e-mail del usuario ha sido cambiado con exito");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);
                }else{
                    $("#email_usuario").val(correo);
                    $("#link_modifica_email_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>ERROR! - </strong>El e-mail del usuario no se pudo cambiar. Intente nuevamente");
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

   //BOTON MODIFICA NICKNAME USUARIO

   $("#link_modifica_nickname_usuario").click(function(){
        $.ajax({
        url: '../../logica/setDatosUsuario.php',
        type: 'POST',
        async: true,
        data: 'data='+$("#nickname_usuario").val()+'&rut='+rut+'&tipo=nickname',
        success: function(datos_recibidos) {
                if(datos_recibidos == 1){
                    apodo = $("#nickname_usuario").val();
                    $("#link_modifica_nickname_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>EXITO! - </strong>El nickname del usuario ha sido modificado con exito. Su sesion se cerrara para realizar los cambios por seguridad.");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $(location).attr('href','../../logica/cierra_sesion.php');
                    }, 5000);
                }else{
                    $("#nickname_usuario").val(apodo);
                    $("#link_modifica_nickname_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>ERROR! - </strong>El nickname del usuario no se pudo cambiar. Intente nuevamente");
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

    //BOTON MODIFICA CONTRASEÑA USUARIO

   $("#link_modifica_contraseña_usuario").click(function(){
        if($("#contraseña_usuario_nueva").val() == ''){
            $("#contenido_alert").html("<strong>ERROR! - </strong>La nueva contraseña no puede ser vacia. Ingrese nuevamente la contraseña");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }
        if($("#contraseña_usuario_rep").val() == ''){
            $("#contenido_alert").html("<strong>ERROR! - </strong>La repeticion de la contraseña no puede ser vacia. Ingrese nuevamente la contraseña");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }
        if($("#contraseña_usuario_nueva").val() != $("#contraseña_usuario_rep").val() ){
            $("#contenido_alert").html("<strong>ERROR! - </strong>Las contraseñas ingresadas no coinciden. Intente nuevamente");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);
            return false;
        }
        
        var contraseña_nueva = $("#contraseña_usuario_rep").val();
        
        $.ajax({
        url: '../../logica/setDatosUsuario.php',
        type: 'POST',
        async: true,
        data: 'data='+contraseña_nueva+'&rut='+rut+'&tipo=password',
        success: function(datos_recibidos) {
                if(datos_recibidos == 1){
                    contraseña = contraseña_nueva;
                    $("#contraseña_usuario_actual").val("");
                    $("#contraseña_usuario_nueva").val("");
                    $("#contraseña_usuario_rep").val("");
                    $("#link_modifica_contraseña_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>EXITO! - </strong>La contraseña del usuario ha sido modificada con exito. Su sesion se cerrara para realizar los cambios por seguridad.");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $(location).attr('href','../../logica/cierra_sesion.php');
                    }, 5000);
                }else{
                    $("#contraseña_usuario_actual").val("");
                    $("#contraseña_usuario_nueva").val("");
                    $("#contraseña_usuario_rep").val("");
                    $("#link_modifica_contraseña_usuario").attr("disabled","disabled");
                    $("#contenido_alert").html("<strong>ERROR! - </strong>La contraseña del usuario no se pudo cambiar. Intente nuevamente");
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