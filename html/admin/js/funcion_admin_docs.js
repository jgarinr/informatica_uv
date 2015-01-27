$( document ).ready(function() {

    var control_tabla = false;
    var tab_aprob = "";
    var tab_no_aprob = "";
    
    $("#validar_descarga").hide();
    $("#tablaNoAprobado").hide();
    $("#tablaAprobado").hide();

    $(".cuerpo_admin_docs").hide();

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

    $(".enlace_asig_modificar").change(function(){
        var nombre_ramo = $("#"+$(this).attr("id")+" option:selected" ).text();
        var select_id = $(this).attr("id");
        $.ajax({
        url: '../../logica/getDescargasAdmin.php',
        type: 'POST',
        async: true,
        data: 'nombre='+nombre_ramo,
        success: function(datos_recibidos) {
                var documentos = datos_recibidos.split("|-|");
                var aprobados = documentos[0].split("||");
                var no_aprobados = documentos[1].split("||");

                $("#presentacion_admin").hide();
                $(".cuerpo_admin_docs").show();

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

                $("#tabla_doc_sin_aprobar").html("");
                $("#tabla_doc_aprobados").html("");

                $("#panel_sin_aprobar").html("<span class='glyphicon glyphicon-time'></span> Documentos sin Aprobar - "+nombre_ramo);
                $("#panel_aprobados").html("<span class='glyphicon glyphicon-ok'></span> Documentos Aprobados - "+nombre_ramo);
                $("#tablaNoAprobado").show();
                $("#tablaAprobado").show();

                for(var i=0;i<no_aprobados.length-1;i++){
                    var datos = no_aprobados[i].split("++");
                    $("#tabla_doc_sin_aprobar").append("<tr class='template-upload fade in' id='filaNoAprobada_"+i+"'><td class='nombre_archivo' id='nombreNoAprobado_"+i+"'>"+datos[0]+"</td><td class='comentario_archivo' id='comentarioNoAprobado_"+i+"'>"+datos[5]+"</td><td class='autor_archivo' id='autorNoAprobado_"+i+"'>"+datos[2]+"</td><td class='boton_aprobar'><a id='aprobarBoton_"+i+"_"+datos[4]+"' class='btn btn-success botonAprobar' title='Aprobar Documento'><span class='glyphicon glyphicon-ok'></span></a></td><td class='boton_modificar'><a id='modificar_"+datos[4]+"_"+i+"_"+0+"' class='btn btn-primary botonModificar' title='Modificar Documento'><span class='glyphicon glyphicon-pencil'></span></a></td><td class='boton_visualizar'><a href='../"+datos[1]+"' target='_blank' class='btn btn-warning' title='Visualizar Documento'><span class='glyphicon glyphicon-eye-open'></span></a></td><td class='boton_eliminar'><a id='EliminarBoton_"+i+"_"+datos[4]+"' class='btn btn-danger botonEliminar' title='Eliminar Documento'><span class='glyphicon glyphicon-remove'></span></a></td></tr>");
                }

                for(var i=0;i<aprobados.length-1;i++){
                    var datos = aprobados[i].split("++");
                    $("#tabla_doc_aprobados").append("<tr class='template-upload fade in' id='filaAprobada_"+i+"'><td class='nombre_archivo' id='nombreAprobado_"+i+"'>"+datos[0]+"</td><td class='comentario_archivo' id='comentarioAprobado_"+i+"'>"+datos[5]+"</td><td class='autor_archivo' id='autorNoAprobado_"+i+"'>"+datos[2]+"</td><td class='boton_modificar'><a id='modificar_"+datos[4]+"_"+i+"_"+1+"' class='btn btn-primary botonModificar' title='Modificar Documento'><span class='glyphicon glyphicon-pencil'></span></a></td><td class='boton_visualizar'><a href='../"+datos[1]+"' target='_blank' class='btn btn-warning' title='Visualizar Documento'><span class='glyphicon glyphicon-eye-open'></span></a></td><td class='boton_eliminar'><a id='EliminarBoton_"+i+"_"+datos[4]+"' class='btn btn-danger botonEliminar' title='Eliminar Documento'><span class='glyphicon glyphicon-remove'></span></a></td></tr>");
                }
                
                if(control_tabla == false){
                    $('#tablaNoAprobado').dataTable({
                        "scrollY":        "160px",
                        "searching": false,
                        "info": false,
                        "paging": false
                    });

                    $('#tablaAprobado').dataTable({
                        "scrollY":        "160px",
                        "searching": false,
                        "info": false,
                        "paging": false
                    });
                    control_tabla = true;
                }

                $(".botonAprobar").click(function(){
                    var tmp = $(this).attr('id').split("_");
                    var fila = tmp[1];
                    swal({
                        title: "Aprobar Documento",
                        text: "Esta seguro de aprobar el documento ''"+$("#nombreNoAprobado_"+tmp[1]).text()+"''",
                        type: "info",
                        showCancelButton: true,
                        allowOutsideClick: true,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "Ok",
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false
                    }, function(){
                        $.ajax({
                            url: '../../logica/setEstadosDescargas.php',
                            type: 'POST',
                            async: true,
                            data: 'idDownload='+tmp[2],
                            success: function(datos_recibidos) {
                                if(datos_recibidos == 1){
                                    swal({
                                        title: "",
                                        text: "El documento ha sido aprobado con exito. Haz click para recargar la página",
                                        type: "success",
                                        showCancelButton: false,
                                          allowOutsideClick: false,
                                          confirmButtonClass: "btn-success",
                                          confirmButtonText: "Ok",
                                          closeOnConfirm: false
                                        }, function(){
                                          location.reload();    
                                        });                              
                                }else{
                                    swal({
                                      title: "",
                                      text: "El documento no ha sido aprobado con exito. Intente nuevamente",
                                      type: "error",
                                      showCancelButton: false,
                                      allowOutsideClick: true,
                                      confirmButtonClass: "btn-danger",
                                      confirmButtonText: "Ok",
                                      closeOnConfirm: true
                                    });
                                }
                            }
                        });
                    });
                }); 

                $(".botonEliminar").click(function(){
                    var tmp = $(this).attr('id').split("_");
                    swal({
                          title: "Eliminar Documento",
                          text: "Esta seguro de eliminar el documento ''"+$("#nombreNoAprobado_"+tmp[1]).text()+"''",
                          type: "info",
                          showCancelButton: true,
                          allowOutsideClick: true,
                          confirmButtonClass: "btn-primary",
                          confirmButtonText: "Ok",
                          cancelButtonText: 'Cancelar',
                          closeOnConfirm: false
                    }, function(){

                       $.ajax({
                        url: '../../logica/deleteDocumentos.php',
                        type: 'POST',
                        async: true,
                        data: 'idEliminar='+tmp[2],
                        success: function(datos_recibidos) {
                            if(datos_recibidos == 1){
                                swal({
                                  title: "",
                                  text: "El documento ha sido eliminado con exito. Haz click para recargar la página",
                                  type: "success",
                                  showCancelButton: false,
                                  allowOutsideClick: false,
                                  confirmButtonClass: "btn-success",
                                  confirmButtonText: "Ok",
                                  closeOnConfirm: false
                                }, function(){
                                  location.reload();    
                                });                               
                            }else{
                                swal({
                                  title: "",
                                  text: "El documento no ha sido eliminado con exito. Intente nuevamente",
                                  type: "error",
                                  showCancelButton: false,
                                  allowOutsideClick: true,
                                  confirmButtonClass: "btn-danger",
                                  confirmButtonText: "Ok",
                                  closeOnConfirm: true
                                });
                            }
                            }
                        });
                    });
                });

                $(".botonModificar").click(function(){
                    var tmp = $(this).attr('id').split("_");
                    $.ajax({
                        url: '../../logica/getDescargasAdminModificar.php',
                        type: 'POST',
                        async: true,
                        data: 'idDownload='+tmp[1],
                        success: function(datos_recibidos) {
                                var data = datos_recibidos.split("||");
                                $(".modal-title").html("Modificar Documento:  "+data[0]);
                                $(".modal-body").html("<div class='row'><div class='col-lg-12'><div class='alert alert-dismissible' role='alert' id='validar_cambios_doc'></div></div></div><div class='row'><div class='col-sm-12'><form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-4 control-label' for='new_titulo'>Titulo</label><div class='col-md-6'><input id='new_titulo' name='new_titulo' type='text' class='form-control input-md cambios_documento'></div></div><div class='form-group'><label class='col-md-4 control-label' for='new_autor'>Autor</label><div class='col-md-6'><input id='new_autor' name='new_autor' type='text' class='form-control input-md cambios_documento'></div></div><div class='form-group'><label class='col-md-4 control-label' for='new_abstract'>Comentarios</label><div class='col-md-6'><textarea class='form-control cambios_documento' id='new_abstract' name='new_abstract'></textarea></div></div><div class='form-group'><label class='col-md-4 control-label' for='modificarDoc'></label><div class='col-md-8'><a id='modificarDoc' name='modificarDoc' class='btn btn-success'>Modificar</a><a id='resetDoc' name='resetDoc' class='btn btn-danger'>Deshacer Cambios</a></div></div></fieldset></form></div></div>");

                                $("#new_titulo").val(data[0]);
                                $("#new_autor").val(data[1]);
                                $("#new_abstract").val(data[2]);
                                $("#validar_cambios_doc").hide();
                                var titulo_backup = data[0];
                                var autor_backup = data[1];
                                var abstract_backup = data[2];

                                $("#modificarDoc").click(function(){
                                    $.ajax({
                                        url: '../../logica/setNewDatosDescargas.php',
                                        type: 'POST',
                                        async: true,
                                        data: 'idDownload='+tmp[1]+'&title='+$("#new_titulo").val()+'&autor='+$("#new_autor").val()+'&coment='+$("#new_abstract").val(),
                                        success: function(datos_recibidos) {
                                                if(datos_recibidos == 1){
                                                    if(tmp[3] == 0){
                                                        $("#nombreNoAprobado_"+tmp[2]).text($("#new_titulo").val());
                                                        $("#autorNoAprobado_"+tmp[2]).text($("#new_autor").val());
                                                        $("#comentarioNoAprobado_"+tmp[2]).text($("#new_abstract").val());
                                                    }else{
                                                        $("#nombreAprobado_"+tmp[2]).text($("#new_titulo").val());
                                                        $("#autorAprobado_"+tmp[2]).text($("#new_autor").val());
                                                        $("#comentarioAprobado_"+tmp[2]).text($("#new_abstract").val());
                                                    }
                                                    titulo_backup = $("#new_titulo").val();
                                                    autor_backup = $("#new_autor").val();
                                                    abstract_backup = $("#new_abstract").val();
                                                
                                                    $("#validar_cambios_doc").html("<strong>EXITO </strong>- El documento ha sido modificado con exito. Los cambios se visulizaran reiniciando esta ventana");
                                                    $("#validar_cambios_doc").removeClass("alert-danger");
                                                    $("#validar_cambios_doc").addClass("alert-success");
                                                    $("#validar_cambios_doc").show("slow");
                                                    setTimeout(function() {
                                                        $('#validar_cambios_doc').hide('slow');
                                                    }, 5000);
                                                }else{
                                                    $("#validar_cambios_doc").html("<strong>ERROR! </strong>- El documento no ha sido modificado o no se han encontrado cambios. Intente nuevamente");
                                                    $("#validar_cambios_doc").removeClass("alert-success");
                                                    $("#validar_cambios_doc").addClass("alert-danger");
                                                    $("#validar_cambios_doc").show("slow");
                                                    setTimeout(function() {
                                                        $('#validar_cambios_doc').hide('slow');
                                                    }, 5000);
                                                }
                                           }
                                    });
                                });

                                $("#resetDoc").click(function(){
                                    $("#new_titulo").val(titulo_backup);
                                    $("#new_autor").val(autor_backup);
                                    $("#new_abstract").val(abstract_backup);
                                });

                                $('#myModal').modal({show:true});

                            }
                    });
                });

            }
    });
    });

    

    
});