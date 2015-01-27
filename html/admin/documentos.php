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
    <link rel="stylesheet" href="../../css/sweet-alert.css">

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
                    <li class="active">
                        <a href="documentos.php"><span class="glyphicon glyphicon-file"></span> Documentos</a>
                    </li>
                    <li>
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
                            Documentos: <small>Administra los documentos que son cargados a la asignaturas</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                  <div class="col-lg-12">
                    <p style="text-align : justify;">Selecciona la asignatura que deseas administrar sus documentos</p>
                  </div>
                  <div class="col-lg-3">
                      <form class="form-horizontal">
                          <fieldset>                    
                          <div class="form-group">
                            <label class="col-md-3 control-label" for="planComun_select" title="Plan Comun de Ingeniería Civil Informática">Común</label>
                            <div class="col-md-9">
                              <select id="planComun_select" name="planComun_select" class="form-control enlace_asig_modificar">
                              </select>
                            </div>
                          </div>
                          </fieldset>
                      </form>
                  </div><!--/.col-sm-6-->
                  <div class="col-lg-3">
                      <form class="form-horizontal">
                          <fieldset>
                          <div class="form-group">
                            <label class="col-md-2 control-label" for="planICI_select" title="Plan de Ingeniería Civil Informática">ICI</label>
                            <div class="col-md-10">
                              <select id="planICI_select" name="planICI_select" class="form-control enlace_asig_modificar">
                              </select>
                            </div>
                          </div>
                          </fieldset>
                      </form>
                  </div><!--/.col-sm-6-->
                  <div class="col-lg-3">
                      <form class="form-horizontal">
                          <fieldset>
                          <div class="form-group">
                            <label class="col-md-2 control-label" for="planIIN_select" title="Plan de Ingeniería en Informática">IIN</label>
                            <div class="col-md-10">
                              <select id="planIIN_select" name="planIIN_select" class="form-control enlace_asig_modificar">
                              </select>
                            </div>
                          </div>
                          </fieldset>
                      </form>
                  </div><!--/.col-sm-6-->
                  <div class="col-lg-3">
                      <form class="form-horizontal">
                          <fieldset>
                          <div class="form-group">
                            <label class="col-md-2 control-label" for="planIEJ_select" title="Plan Comun de Ingeniería Ejecución en Informática">IEJ</label>
                            <div class="col-md-10">
                              <select id="planIEJ_select" name="planIEJ_select" class="form-control enlace_asig_modificar">
                              </select>
                            </div>
                          </div>
                          </fieldset>
                      </form>
                  </div><!--/.col-sm-6-->
                  <div class="col-lg-12">
                    <legend></legend>
                  </div>  
                </div>

                <div class="row">
                   <div class="col-lg-12">
                        <div class='alert alert-dismissible' role='alert' id='validar_descarga'><div id="contenido_alert"></div></div>
                    </div>
                </div>

                <div class="row" id="presentacion_admin">
                    <div class="col-lg-12">
                      <img src="../../images/banner/logo_admin.png" id="conten_img_admin">
                    </div>
                </div>            

                <div class="row cuerpo_admin_docs">
                    <div class="col-lg-12"> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" id='panel_sin_aprobar'><span class="glyphicon glyphicon-time"></span> Documentos sin aprobar</h3>
                            </div>
                            <div class="panel-body">
                                <table id="tablaNoAprobado" class="display" cellspacing="0" width="100%">
                                    <tbody id='tabla_doc_sin_aprobar'>
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Comentario</th>
                                                <th>Autor</th>
                                                <th>Aprobar</th>
                                                <th>Modificar</th>
                                                <th>Visualizar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                    </tbody>
                                </table>
                            </div>
                        </div>                       
                    </div>
                </div>
                <div class="row cuerpo_admin_docs">
                    <div class="col-lg-12">        
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title" id='panel_aprobados'><span class="glyphicon glyphicon-ok"></span> Documentos aprobados</h3>
                            </div>
                            <div class="panel-body">
                                <table id="tablaAprobado" class="display" cellspacing="0" width="100%">
                                    <tbody id='tabla_doc_aprobados'>
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Comentario</th>
                                                <th>Autor</th>
                                                <th>Modificar</th>
                                                <th>Visualizar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                    </tbody>
                                </table>
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel"></h3>
      </div>
      <div class="modal-body" id="cuerpoModal" style="text-align : justify;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>
    <script src="../../js/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
    <script src="../../js/sweet-alert.js"></script>
    <script src="js/funcion_admin_docs.js"></script>
    
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
