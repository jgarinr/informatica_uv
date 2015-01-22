<?php
    session_start();
    if(!isset($_SESSION['nick']) || !isset($_SESSION['nivel'])){
          session_destroy();
          echo '<script type="text/javascript">window.location = "../../index.php"; </script>';
    }else{
      if($_SESSION['nivel'] != "superadmin"){
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
                <a class="navbar-brand" style="color:#FFF;"><img src="../../images/favicon.ico" alt="logo" style="vertical-align: sub;width: 25px;"> Escuela de Ingeniería Civil Informática - Panel de Administración (Super Administrador)</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['nick']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a id="boton_salir_admin" style="cursor:pointer"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="perfil.php"><span class="glyphicon glyphicon-user"></span> Administrar Usuarios</a>
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
                            Administrar Usuarios: <small>Administra las cuentas de los usuarios del sistema.</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                   <div class="col-lg-12">
                        <div class='alert alert-dismissible' role='alert' id='validar_descarga'><div id="contenido_alert"></div></div>
                    </div>
                </div>            
                <div class="row">
                    <div class="col-lg-4">
                        <form class="form-horizontal" id="formulario_add_user">
                            <fieldset>
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="nombre_usuario">Nombre</label>  
                                  <div class="col-md-8">
                                    <input id="nombre_usuario" name="nombre_usuario" type="text" class="form-control input-md" placeholder="Nombre nuevo usuario">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="apellido_usuario">Apellido</label>  
                                  <div class="col-md-8">
                                  <input id="apellido_usuario" name="apellido_usuario" type="text" class="form-control input-md" placeholder="Apellido nuevo usuario"> 
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="rut_usuario">RUT</label>  
                                  <div class="col-md-8">
                                    <input id="rut_usuario" name="rut_usuario" type="text" class="form-control input-md" placeholder="12345678-9">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="email_usuario">Correo</label>  
                                  <div class="col-md-8">
                                  <input id="email_usuario" name="email_usuario" type="text" class="form-control input-md" placeholder="@uv.cl | @alumnos.uv.cl"> 
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="nickname_usuario">Nickname</label>  
                                  <div class="col-md-8">
                                  <input id="nickname_usuario" name="nickname_usuario" type="text" class="form-control input-md" placeholder="Apodo"> 
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="boton_agregar_usuario"></label>
                                  <div class="col-md-8">
                                    <a id="boton_agregar_usuario" name="boton_agregar_usuario" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Agregar</a>
                                    <a id="boton_agregar_usuario_reset" name="boton_agregar_usuario_reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Reset</a>
                                  </div>
                                </div>
                            </fieldset>
                        </form>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-lg-12">
                          <table id="usuarios_tabla" class="display" cellspacing="0" width="100%">
                                    <tbody id='usuarios_tabla_cuerpo'>
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>RUT</th>
                                                <th>Correo</th>
                                                <th>Nickname</th>
                                                <th>Modificar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                    </tbody>
                           </table>
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
            <button type="button" class="btn btn-success" id="boton_aprobar_cierre"><span class="glyphicon glyphicon-ok"></span> Aprobar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>
    <script src="../../js/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
    <script src="js/funcion_admin_admin.js"></script>
    <script src="js/valida_rut/jquery.Rut.js"></script>
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
