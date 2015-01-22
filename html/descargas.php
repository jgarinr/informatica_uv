<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Escuela de Ingeniería Civil Informática</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../js/DataTables-1.10.3/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="../images/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <?php include("../includes/header_html.php");?>

    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1><i class="fa fa-file-o"></i> Descargas</h1>
                    <p>Contenido descargable de las asignaturas de la carrera de Ingenieria Civil Informatica</p>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="../index.php">Inicio</a></li>
                        <li class="active">Descargas</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->

    <section id="about-us" class="container">
        <div class="row">
            <h2><i class="fa fa-download"></i> Descargar Contenido</h2>
            <p style="text-align : justify;">Descarga todo el material complementario de las asignaturas que se imparten en la carrera</p>
            <legend></legend>
            <div class="col-sm-3">
                <form class="form-horizontal">
                    <fieldset>                    
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="planComun_select" title="Plan Comun de Ingeniería Civil Informática">Comun</label>
                      <div class="col-md-9">
                        <select id="planComun_select" name="planComun_select" class="form-control enlace_descarga">
                        </select>
                      </div>
                    </div>
                    </fieldset>
                </form>
            </div><!--/.col-sm-6-->
            <div class="col-sm-3">
                <form class="form-horizontal">
                    <fieldset>
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="planICI_select" title="Plan de Ingeniería Civil Informática">ICI</label>
                      <div class="col-md-10">
                        <select id="planICI_select" name="planICI_select" class="form-control enlace_descarga">
                        </select>
                      </div>
                    </div>
                    </fieldset>
                </form>
            </div><!--/.col-sm-6-->
            <div class="col-sm-3">
                <form class="form-horizontal">
                    <fieldset>
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="planIIN_select" title="Plan de Ingeniería en Informática">IIN</label>
                      <div class="col-md-10">
                        <select id="planIIN_select" name="planIIN_select" class="form-control enlace_descarga">
                        </select>
                      </div>
                    </div>
                    </fieldset>
                </form>
            </div><!--/.col-sm-6-->
            <div class="col-sm-3">
                <form class="form-horizontal">
                    <fieldset>
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="planIEJ_select" title="Plan Comun de Ingeniería Ejecución en Informática">IEJ</label>
                      <div class="col-md-10">
                        <select id="planIEJ_select" name="planIEJ_select" class="form-control enlace_descarga">
                        </select>
                      </div>
                    </div>
                    </fieldset>
                </form>
            </div><!--/.col-sm-6-->
        </div>
        <div class="row">
            <h2><i class="fa fa-upload"></i> Subir Contenido</h2>
            <p style="text-align : justify;">Si lo deseas, tambien puedes contribuir subiendo tus trabajos y/o material que consideres de ayuda.</p>
            <legend></legend>
            <div class="col-sm-12">
                <div class="center"><a class="btn btn-lg btn-primary" id="subir_documento"><span class="glyphicon glyphicon-upload"></span> Cargar Nuevos Documentos</a></div>
            </div><!--/.col-sm-6-->
        </div><!--/.row-->    
    </section><!--/#about-us-->

    <!-- Modal -->
<div class="modal fade" id="myModal_download" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel"></h3>
      </div>
      <div class="modal-body" id="cuerpoModal">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>

    <?php include("../includes/footer_html.php");?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
    <script src="../js/funcion_descargas.js"></script>
    <script src="../js/bootstrap.file-input.js"></script>
</body>
</html>