$( document ).ready(function() {
	var profesor =  "";
    var ayudante1 = "";
    var ayudante2 = "";
    var comentario = "";
    var numero_asignatura = "";
    var nombre_asignatura = "";

    $(".cuerpo_admin_asignatura").hide();

    $.ajax({
        url: '../../logica/getAsignaturaDescargas.php',
        type: 'POST',
        async: true,
        data: 'malla=comun',
        success: function(datos_recibidos) {
            $("#planComun_select").html(datos_recibidos);
            }
    });
    $.ajax({
        url: '../../logica/getAsignaturaDescargas.php',
        type: 'POST',
        async: true,
        data: 'malla=ICI',
        success: function(datos_recibidos) {
            $("#planICI_select").html(datos_recibidos);
            }
    });
    $.ajax({
        url: '../../logica/getAsignaturaDescargas.php',
        type: 'POST',
        async: true,
        data: 'malla=IIN',
        success: function(datos_recibidos) {
            $("#planIIN_select").html(datos_recibidos);
            }
    });
    $.ajax({
        url: '../../logica/getAsignaturaDescargas.php',
        type: 'POST',
        async: true,
        data: 'malla=IEJ',
        success: function(datos_recibidos) {
            $("#planIEJ_select").html(datos_recibidos);
            }
    });


    $("#boton_modifica_profesor").attr("disabled","disabled");
    $("#boton_modifica_comentario").attr("disabled","disabled");
    $("#boton_modifica_foto").attr("disabled","disabled");
    $("#ver_galeria_fotos").attr("disabled","disabled");

    $("#validar_descarga").hide();
    $("#formObjetivos").hide();
    $("#formAddObjt").hide();
    $("#formObjetivosRemove").hide();

    $("#boton_salir_admin").click(function(){
        /*$(".modal-title").html("Cierre de Sesion");
        $(".modal-body").html("Esta seguro de que desea cerrar la sesion");
        $('#myModal').modal({show:true});
        $("#boton_aprobar_cierre").click(function(){
            
        });*/

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

    var control = false;
    var object = new Array();
    var object2 = new Array();
    var object3 = new Array();
    var object4 = new Array();

    $(".enlace_asig_modificar").change(function(){
        var datos_envio = $(this).val().split("_");
        var valor = $(this).val();
        var select_id = $(this).attr("id");

        $.ajax({
        url: '../../logica/galeriaFotos.php',
        type: 'POST',
        async: true,
        data: 'dat=none',
        success: function(datos_recibidos){
                var fotos = datos_recibidos.split("||");
                var fila = 0;
                var control_row = 1;
                for (var i = 0;i<fotos.length-1;i++) {
                    if(i==0){
                        fila = fila + 1;
                        $("#fotos_galeria").append("<div class='row fila"+fila+"'><div class='col-md-3'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><button type='button' class='btn btn-primary boton_cambia_foto' title='Has click para cambiar la imagen' id='cambia_imagen_"+i+"'><span class='glyphicon glyphicon-ok'></span></button><button title='Has click para ver la imagen' style='margin-left:10%' type='button' class='btn btn-success boton_ver_foto' id='verFoto_"+i+"'><span class='glyphicon glyphicon-eye-open'></span></button></p></div></div></div></div>");
                    }else{
                        if((i/4)!=control_row){
                            $(".fila"+fila).append("<div class='col-md-3'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><button type='button' class='btn btn-primary boton_cambia_foto' title='Has click para cambiar la imagen' id='cambia_imagen_"+i+"'><span class='glyphicon glyphicon-ok'></span></button><button title='Has click para ver la imagen' style='margin-left:10%' type='button' class='btn btn-success boton_ver_foto' id='verFoto_"+i+"'><span class='glyphicon glyphicon-eye-open'></span></button></p></div></div></div>");
                        }else{
                            fila = fila + 1;
                            control_row = control_row + 1;
                            $("#fotos_galeria").append("<div class='row fila"+fila+"'><div class='col-md-3'><div class='thumbnail'><img src='"+fotos[i]+"' id='imagen_"+i+"'><div class='caption'><p align='center'><button type='button' class='btn btn-primary boton_cambia_foto' title='Has click para cambiar la imagen' id='cambia_imagen_"+i+"'><span class='glyphicon glyphicon-ok'></span></button><button title='Has click para ver la imagen' style='margin-left:10%' type='button' class='btn btn-success boton_ver_foto' id='verFoto_"+i+"'><span class='glyphicon glyphicon-eye-open'></span></button></p></div></div></div></div>");
                        }
                    }                    
                }

                $(".boton_ver_foto").click(function(){
                    var data = $(this).attr("id").split("_");
                    $(".modal-body").html("<img src='"+fotos[data[1]]+"' height='464' width='568'>");
                    $('#myModal').modal({show:true});
                });
                
                $(".boton_cambia_foto").click(function(){
                    var dataID = $(this).attr("id").split("_");
                    $("#foto_ramo").attr("src",$("#imagen_"+dataID[2]).attr("src"));
                    $.ajax({
                        url: '../../logica/updateUrlFotos.php',
                        type: 'POST',
                        async: true,
                        data: 'name_change='+nombre_asignatura+'&newUrl='+$("#imagen_"+dataID[2]).attr("src"),
                        success: function(datos_recibidos){
                            }
                    });
                });
        }
    });



        $.ajax({
        url: '../../logica/getAsignaturaInfo.php',
        type: 'POST',
        async: true,
        data: 'asignatura='+datos_envio[1]+'&malla='+datos_envio[0]+"&nombre_obj="+datos_envio[2],
        success: function(datos_recibidos) {
                $("#profesor_asignatura").prop("disabled",false);
                $("#foto_asignatura").prop("disabled",false);
                $("#comentario_asignatura").prop("disabled",false);
                $("#objet_asig").prop("disabled",false);
                $("#objet_asig_remove").prop("disabled",false);
                $("#ver_galeria_fotos").prop("disabled",false);
                $("#formObjetivos").show();
                $("#formAddObjt").show();
                $("#formObjetivosRemove").show();

                $("#presentacion_admin").hide();
                $(".cuerpo_admin_asignatura").show();

                switch(select_id) {
                    case "planComun_select":
                        $("#planICI_select option[value='0']").attr("selected",true);
                        $("#planIIN_select option[value='0']").attr("selected",true);
                        $("#planIEJ_select option[value='0']").attr("selected",true);
                        break;
                    case "planICI_select":
                        $("#planComun_select option[value='0']").attr("selected",true);
                        $("#planIIN_select option[value='0']").attr("selected",true);
                        $("#planIEJ_select option[value='0']").attr("selected",true);
                        break;
                    case "planIIN_select":
                        $("#planComun_select option[value='0']").attr("selected",true);
                        $("#planICI_select option[value='0']").attr("selected",true);
                        $("#planIEJ_select option[value='0']").attr("selected",true);
                        break;
                    case "planIEJ_select":
                        $("#planComun_select option[value='0']").attr("selected",true);
                        $("#planIIN_select option[value='0']").attr("selected",true);
                        $("#planICI_select option[value='0']").attr("selected",true);
                        break;
                }

                var data = datos_recibidos.split("||");
                nombre_asignatura = data[0];
                
                $("#objet_asig").html("");
                $("#objet_asig_remove").html("");
                $("#obj_new_asignatura").val("");

                object.length = 0;
                object2.length = 0;
                object3.length = 0;
                object4.length = 0;
                var object_receb = data[4].split("|+|");
                for (var i = 0; i<object_receb.length - 1;i++) {
                    var tmp = object_receb[i].split("++");
                    if(tmp[1]=="visible"){
                        object.push("checked");
                        object2.push("checked");
                        $("#objet_asig").append("<option value='objetivo_"+tmp[0]+"_"+i+"' selected> "+tmp[2]+"</option>");
                    }else{
                        object.push("unchecked");
                        object2.push("unchecked");
                        $("#objet_asig").append("<option value='objetivo_"+tmp[0]+"_"+i+"'> "+tmp[2]+"</option>");
                    }
                    $("#objet_asig_remove").append("<option value='objetivoBorrar_"+tmp[0]+"_"+i+"'> "+tmp[2]+"</option>");
                    object3.push(tmp[0]);
                    object4.push("unchecked");
                }

                if(control == false){
                    $("#objet_asig").multiselect({
                        position: {
                          my: 'left bottom',
                          at: 'left top'
                        },click: function(event, ui){
                          var x = ui.value.split("_");
                          object2[x[2]] = (ui.checked ? 'checked' : 'unchecked');
                        }
                    });
                    $("#objet_asig_remove").multiselect({
                        position: {
                          my: 'left bottom',
                          at: 'left top'
                        },click: function(event, ui){
                          var x = ui.value.split("_");
                          object4[x[2]] = (ui.checked ? 'checked' : 'unchecked');
                        }
                    });
                    control = true;
                }else{
                    $("#objet_asig").multiselect("refresh");
                    $("#objet_asig_remove").multiselect("refresh");
                }

                $("#profesor_asignatura").val(data[1]);
                profesor = data[1];
                numero_asignatura = valor;
                $("#foto_ramo").attr("src",data[2]);
                $("#comentario_asignatura").val(data[3]);
                comentario = data[3];
            }
        });
    });

    $("#boton_borra_objetivos").click(function(){
        var intel_control = false;
        for (var i = 0; i<object4.length;i++) {
            if(object4[i] == "checked"){
                intel_control = true;
            }
        }
        if(intel_control == true){
            var IDS = "";
            var posiciones = "";
            for (var i = 0; i<object4.length; i++) {
                if(object4[i] == "checked"){
                    IDS = IDS+object3[i]+"||";
                    posiciones = posiciones+i+"||";
                }   
            }

            swal({
                  title: "",
                  text: "Desea eliminar los objetivos seleccionados",
                  type: "info",
                  showCancelButton: true,
                  allowOutsideClick: true,
                  confirmButtonClass: "btn-primary",
                  confirmButtonText: "Ok",
                  cancelButtonText: 'Cancelar',
                  closeOnConfirm: false
            }, function(){

                $.ajax({
                    url: '../../logica/ObjetivosManager.php',
                    type: 'POST',
                    async: true,
                    data: 'tipo=delete&idObj='+IDS,
                    success: function(datos_recibidos) {
                            swal({
                              title: "",
                              text: "Los objetivos han sido eliminados con exito. Haz click para recargar la página",
                              type: "success",
                              showCancelButton: false,
                              allowOutsideClick: false,
                              confirmButtonClass: "btn-success",
                              confirmButtonText: "Ok",
                              closeOnConfirm: false
                            }, function(){
                              location.reload();    
                            });               
                        }
                });    
                    
            });
        }else{
            /*$("#contenido_alert").html("<strong>ADVERTENCIA! - </strong>No se ha seleccionado ningun objetivo para eliminarlo.");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            $('html,body').animate({
                    scrollTop: 0
                }, 500);
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);*/

            swal({
                  title: "",
                  text: "No se ha seleccionado ningun objetivo para eliminarlo",
                  type: "info",
                  showCancelButton: false,
                  allowOutsideClick: true,
                  confirmButtonClass: "btn-primary",
                  confirmButtonText: "Ok",
                  closeOnConfirm: true
            });


        }
    });


    $("#boton_modifica_objetivos").click(function(){
        var intel_control = false;
        for (var i = 0; i<object.length;i++) {
            if(object[i] != object2[i]){
                intel_control = true;
            }
        }
        if(intel_control == true){
            var IDS = "";
            var estados = "";
            for (var i = 0; i<object3.length; i++) {
                IDS = IDS+object3[i]+"||";
                estados = estados+object2[i]+"||";   
            }
            $.ajax({
            url: '../../logica/ObjetivosManager.php',
            type: 'POST',
            async: true,
            data: 'tipo=update&idObj='+IDS+'&state='+estados,
            success: function(datos_recibidos) {
                for (var i = 0; i<object2.length; i++) {
                    object[i] = object2[i];   
                }

                /*$("#contenido_alert").html("<strong>EXITO! - </strong>Los objetivos han sido modificados con exito.");
                $("#validar_descarga").removeClass("alert-danger");
                $("#validar_descarga").addClass("alert-success");
                $("#validar_descarga").show("slow");
                $('html,body').animate({
                    scrollTop: 0
                }, 500);
                setTimeout(function() {
                    $('#validar_descarga').hide('slow');
                }, 5000);*/

                swal({
                  title: "",
                  text: "Los objetivos han sido modificados con exito",
                  type: "success",
                  showCancelButton: false,
                  allowOutsideClick: true,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Ok",
                  closeOnConfirm: true
                });


                }
            });
        }else{
            /*$("#contenido_alert").html("<strong>ADVERTENCIA! - </strong>No se ha detectado cambios en los objetivos de la asignatura");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            $('html,body').animate({
                    scrollTop: 0
                }, 500);
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);*/

            swal({
                  title: "",
                  text: "No se ha detectado cambios en los objetivos de la asignatura",
                  type: "info",
                  showCancelButton: false,
                  allowOutsideClick: true,
                  confirmButtonClass: "btn-primary",
                  confirmButtonText: "Ok",
                  closeOnConfirm: true
            });
        }
    });

    $("#boton_add_objetivo").click(function(){
        if($("#obj_new_asignatura").val()==""){
            /*$("#contenido_alert").html("<strong>ERROR! - </strong>El nuevo objetivo esta vacio. Escriba un nuevo objetivo para posteriormente agregarlo");
            $("#validar_descarga").removeClass("alert-success");
            $("#validar_descarga").addClass("alert-danger");
            $("#validar_descarga").show("slow");
            $('html,body').animate({
                scrollTop: 0
            }, 500);
            setTimeout(function() {
                $('#validar_descarga').hide('slow');
            }, 5000);*/

            swal({
                  title: "",
                  text: "El nuevo objetivo esta vacio. Escriba un nuevo objetivo para posteriormente agregarlo",
                  type: "info",
                  showCancelButton: false,
                  allowOutsideClick: true,
                  confirmButtonClass: "btn-primary",
                  confirmButtonText: "Ok",
                  closeOnConfirm: true
            });


            return false;
        }

        var envios = numero_asignatura.split("_");
        var name_send = envios[2].replace("/-/gi"," ");

        $.ajax({
            url: '../../logica/ObjetivosManager.php',
            type: 'POST',
            async: true,
            data: 'tipo=new&code='+envios[0]+envios[1]+'&name_asig='+name_send+'&content='+$("#obj_new_asignatura").val(),
            success: function(datos_recibidos) {
                $("#objet_asig").append("<option value='objetivo_"+datos_recibidos+"_"+(object3.length+1)+"' selected> "+$("#obj_new_asignatura").val()+"</option>");
                $("#objet_asig_remove").append("<option value='objetivo_"+datos_recibidos+"_"+(object3.length+1)+"'> "+$("#obj_new_asignatura").val()+"</option>");
                object.push("checked");
                object2.push("checked");
                object3.push(datos_recibidos);
                object4.push("unchecked");
                $("#objet_asig").multiselect("refresh");
                $("#objet_asig_remove").multiselect("refresh");
                /*$("#contenido_alert").html("<strong>EXITO! - </strong>El nuevo objetivo ha sido agregado con exito.");
                $("#validar_descarga").removeClass("alert-danger");
                $("#validar_descarga").addClass("alert-success");
                $("#validar_descarga").show("slow");
                $('html,body').animate({
                    scrollTop: 0
                }, 500);
                setTimeout(function() {
                    $('#validar_descarga').hide('slow');
                }, 5000);*/
                $("#obj_new_asignatura").val("");

                swal({
                  title: "",
                  text: "El nuevo objetivo ha sido agregado con exito",
                  type: "success",
                  showCancelButton: false,
                  allowOutsideClick: true,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Ok",
                  closeOnConfirm: true
                });


            }
        });
    });

    $("#profesor_asignatura").keyup(function(){
        if($(this).val() != profesor){
            $("#boton_modifica_profesor").removeAttr("disabled");
        }else{
            $("#boton_modifica_profesor").attr("disabled","disabled");
        }
    });

    $("#comentario_asignatura").keyup(function(){
        if($(this).val() != comentario){
            $("#boton_modifica_comentario").removeAttr("disabled");
        }else{
            $("#boton_modifica_comentario").attr("disabled","disabled");
        }
    });

    $("#foto_asignatura").change(function(){
        if($(this).val() != ''){
            $("#boton_modifica_foto").removeAttr("disabled");
        }else{
            $("#boton_modifica_foto").attr("disabled","disabled");
        }
    });

    //BOTON MODIFICA FOTO ASIGNATURA

    $("#boton_modifica_foto").click(function(){

        var archivos = document.getElementById('foto_asignatura');
        var documento = archivos.files;
        var datta = new FormData();

        for(var i=0;i<documento.length;i++){
            datta.append('archivo'+i,documento[i]);
        }

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

        var urlSend = $("#foto_asignatura").val().split("\\");

        $.ajax({
        url: '../../logica/setDatosAsignatura.php',
        type: 'POST',
        async: true,
        data: 'data='+urlSend[urlSend.length-1]+'&ramo='+nombre_asignatura+'&tipo=foto',
        success: function(datos_recibidos) {
                var recibido = datos_recibidos.split("||");
                if(recibido[0] == "ok"){
                    profesor = $("#profesor_asignatura").val();
                    $("#boton_modifica_foto").attr("disabled","disabled");
                    /*$("#contenido_alert").html("<strong>EXITO! - </strong>La foto de la asignatura ha sido cambiada con exito");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);*/
                    $("#foto_ramo").attr("src",recibido[1]);

                    swal({
                      title: "",
                      text: "La foto de la asignatura ha sido cambiada con exito",
                      type: "success",
                      showCancelButton: false,
                      allowOutsideClick: true,
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                    });


                }else{
                    $("#profesor_asignatura").val(profesor);
                    $("#boton_modifica_foto").attr("disabled","disabled");
                    /*$("#contenido_alert").html("<strong>ERROR! - </strong>La foto de la asignatura no se pudo cambiar. Intente nuevamente");
                    $("#validar_descarga").removeClass("alert-success");
                    $("#validar_descarga").addClass("alert-danger");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);*/

                    swal({
                      title: "",
                      text: "La foto de la asignatura no se pudo cambiar. Intente nuevamente",
                      type: "info",
                      showCancelButton: false,
                      allowOutsideClick: true,
                      confirmButtonClass: "btn-primary",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                    });

                }
            }
        });
    });

   //BOTON MODIFICA NOMBRE PROFESOR

    $("#boton_modifica_profesor").click(function(){
        $.ajax({
        url: '../../logica/setDatosAsignatura.php',
        type: 'POST',
        async: true,
        data: 'data='+$("#profesor_asignatura").val()+'&ramo='+nombre_asignatura+'&tipo=profesor',
        success: function(datos_recibidos) {
                if(datos_recibidos == "ok"){
                    profesor = $("#profesor_asignatura").val();
                    $("#boton_modifica_profesor").attr("disabled","disabled");
                    /*$("#contenido_alert").html("<strong>EXITO! - </strong>El nombre del profesor ha sido modificado con exito");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);*/

                    swal({
                      title: "",
                      text: "El nombre del profesor ha sido modificado con exito",
                      type: "success",
                      showCancelButton: false,
                      allowOutsideClick: true,
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                    });

                }else{
                    $("#profesor_asignatura").val(profesor);
                    $("#boton_modifica_profesor").attr("disabled","disabled");
                    /*$("#contenido_alert").html("<strong>ERROR! - </strong>El nombre del profesor no se pudo cambiar. Intente nuevamente");
                    $("#validar_descarga").removeClass("alert-success");
                    $("#validar_descarga").addClass("alert-danger");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);*/

                    swal({
                      title: "",
                      text: "El nombre del profesor no se pudo cambiar. Intente nuevamente",
                      type: "info",
                      showCancelButton: false,
                      allowOutsideClick: true,
                      confirmButtonClass: "btn-primary",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                    });


                }
            }
        });
   });

    //BOTON MODIFICA COMENTARIOS ASIGNATURA

   $("#boton_modifica_comentario").click(function(){
        $.ajax({
        url: '../../logica/setDatosAsignatura.php',
        type: 'POST',
        async: true,
        data: 'data='+$("#comentario_asignatura").val()+'&ramo='+nombre_asignatura+'&tipo=descrip',
        success: function(datos_recibidos) {
                if(datos_recibidos == "ok"){
                    comentario = $("#comentario_asignatura").val();
                    $("#boton_modifica_comentario").attr("disabled","disabled");
                    /*$("#contenido_alert").html("<strong>EXITO! - </strong>La  de la asignatura ha sido modificado con exito");
                    $("#validar_descarga").removeClass("alert-danger");
                    $("#validar_descarga").addClass("alert-success");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);*/

                    swal({
                      title: "",
                      text: "La descripción de la asignatura ha sido modificado con exito",
                      type: "success",
                      showCancelButton: false,
                      allowOutsideClick: true,
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                    });

                }else{
                    $("#comentario_asignatura").val(comentario);
                    $("#boton_modifica_comentario").attr("disabled","disabled");
                    /*$("#contenido_alert").html("<strong>ERROR! - </strong>El comentario de la asignatura no se pudo cambiar. Intente nuevamente");
                    $("#validar_descarga").removeClass("alert-success");
                    $("#validar_descarga").addClass("alert-danger");
                    $("#validar_descarga").show("slow");
                    setTimeout(function() {
                        $('#validar_descarga').hide('slow');
                    }, 5000);*/

                    swal({
                      title: "",
                      text: "El comentario de la asignatura no se pudo cambiar. Intente nuevamente",
                      type: "info",
                      showCancelButton: false,
                      allowOutsideClick: true,
                      confirmButtonClass: "btn-primary",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                    });

                }
            }
        });
   }); 

});