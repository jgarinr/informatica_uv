<?php
    session_start();
    if(!isset($_SESSION['nick']) || !isset($_SESSION['nivel'])){
          session_destroy();
          echo '<script type="text/javascript">window.location = "../../index.php"; </script>';
    }else{
      if($_SESSION['nivel'] != "admin"){
          session_destroy();
          echo '<script type="text/javascript">window.location = "../../index.php"; </script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Escuela de Ingeniería Civil Informática</title>
    <link rel="shortcut icon" href="../../images/favicon.ico">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="../../js/DataTables-1.10.3/media/css/jquery.dataTables.min.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:#FFF;"><img src="../../images/favicon.ico" alt="logo" style="vertical-align: sub;width: 25px;"> Escuela de Ingeniería Civil Informática - Panel de Administración</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['nick']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../../index.php" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> Ir al Sitio</a>
                            <a id="boton_salir_admin" style="cursor:pointer"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="asignaturas.php"><i class="fa fa-book"></i> Asignaturas</a>
                    </li>
                    <li>
                        <a href="documentos.php"><span class="glyphicon glyphicon-file"></span> Documentos</a>
                    </li>
                    <li class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-code-fork"></i> Menciones <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="software.php">Software</a>
                            </li>
                            <li>
                                <a href="basededatos.php">Base de Datos</a>
                            </li>
                            <li>
                                <a href="redes.php">Redes</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="personas.php"><i class="fa fa-users"></i> Personas</a>
                    </li>
                    <li>
                        <a href="perfil.php"><span class="glyphicon glyphicon-user"></span> Mi cuenta</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Mención de Software: <small>Edita la información de la mención de Software</small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title"><i class='fa fa-info-circle'></i> Información General</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <fieldset>
                               <div class="form-group">
                                  <label class="col-lg-3 control-label" for="descripcion_mencion">Descripción</label>
                                  <div class="col-lg-6">                     
                                    <textarea class="form-control" id="descripcion_mencion" name="descripcion_mencion" style="height: 150px;"></textarea>
                                  </div>
                                  <div class="col-md-3">  
                                    <button type="button" class="btn btn-primary" id="boton_modifica_mencion" name="boton_modifica_mencion" disabled style="margin-bottom:10%;"><span class="glyphicon glyphicon-pencil"></span> Modificar Descripción</button>
                                    <button type="button" class="btn btn-primary" id="boton_deshacer_modifica" name="boton_deshacer_modifica" disabled><span class="glyphicon glyphicon-refresh"></span> Reset</button> 
                                  </div>
                                </div>
                                <div class='alert alert-dismissible' role='alert' id='validar_actualizar'></div>
                                </fieldset>
                                </form>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title"><i class='fa fa-star'></i> Ingresar una nueva Asignatura</h3>
                        </div>
                        <div class="panel-body">
                            <form class='form-horizontal'><fieldset><div class='form-group'><label class='col-md-3 control-label' for='nombre_nuevo'>Nombre</label><div class='col-md-6'><input id='nombre_nuevo' name='nombre_nuevo' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='descrip_corta_nueva'>Descripción Corta</label><div class='col-md-6'><select id='descrip_corta_nueva' name='descrip_corta_nueva' class='form-control'><option value='0' style='display:none;'>Seleccione</option><option value='INC502'>Asignatura Electiva de Especialidad I</option><option value='INC512'>Asignatura Electiva de Especialidad II</option><option value='INC600'>Asignatura Electiva de Especialidad III</option><option value='INC501'>Seminario de Especialidad I</option><option value='INC511'>Seminario de Especialidad II</option></select></div></div><div class='form-group'><label class='col-md-3 control-label' for='descrip_larga_new'>Descripción Larga</label><div class='col-md-3'><textarea class='form-control' id='descrip_larga_new' name='descrip_larga_new'></textarea></div></div><div class='form-group'><label class='col-md-3 control-label' for='profesor_new'>Profesor</label><div class='col-md-6'><input id='profesor_new' name='profesor_new' type='text' class='form-control input-md'></div></div><div class='form-group'><label class='col-md-3 control-label' for='foto_new'>Foto</label><div class='col-md-3'><input id='foto_new' name='foto_new' class='input-file' type='file' accept="image/*"></div></div><div class='form-group'><label class='col-md-3 control-label' for='boton_agregar_ramo'></label><div class='col-md-4'><button id='boton_agregar_ramo' class="btn btn-primary btn-success" type="button"><span class="glyphicon glyphicon-save"></span> Agregar Asignatura</button></div></div><div class='alert alert-dismissible' role='alert' id='validar_add_ramo'></div></fieldset></form>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title"><i class='fa fa-book'></i> Asignaturas de la Mención</h3>
                        </div>
                        <div class="panel-body" id="contenedor_redes">
                            <table id='tablaMencion' class='display'><tbody id="datos_tabla"><thead><tr><th>Nombre</th><th>Descripción Corta</th><th>Descripción Larga</th><th>Profesor</th><th>Estado</th><th>Mostrar / No Mostrar</th><th>Modificar</th><th>Borrar</th></tr></thead></tbody></table>
                        </div>
                      </div>
                    </div>
                </div>
                           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id="myModal_mostrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel"></h3>
          </div>
          <div class="modal-body" id="cuerpoModal" style="text-align : justify;">
          </div>
          <div class="modal-footer" id="footer_mostrar">
            <button type="button" class="btn btn-success" id="boton_aprobar_mostrar"><span class="glyphicon glyphicon-ok"></span> Ok!</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="cerrar_modal_mostrar">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModal_other" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel"></h3>
          </div>
          <div class="modal-body" id="cuerpoModal_other" style="text-align : justify;">
          </div>
          <div class="modal-footer" id="footer_other">
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="myModalLabel"></h3>
          </div>
          <div class="modal-body" id="cuerpoModal" style="text-align : justify;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="boton_aprobar_cierre"><span class="glyphicon glyphicon-ok"></span> Aprobar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>
    <script src="../../js/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
    <script src="js/funcion_admin_sw.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>
   
</body>

</html>
