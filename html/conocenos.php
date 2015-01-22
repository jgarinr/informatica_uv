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
                    <h1><i class="fa fa-users"></i> ¿Quienes somos?</h1>
                    <p>Conoce el equipo de la Escuela de Ingeniería Civil en Informática</p>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="../index.php">Inicio</a></li>
                        <li class="active">¿Quienes somos?</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->

    <section id="portfolio" class="container">
        <div class="row">
            <div class="col-sm-6">
                <ul class="portfolio-filter">
                    <li><a class="btn btn-default active" data-filter="*" href="#" id="botonTODOS">Todos</a></li>
                    <li><a class="btn btn-default" data-filter=".academico" href="#" id="botonACA">Académicos</a></li>
                    <li><a class="btn btn-default" data-filter=".adm" href="#" id="botonADM">Administrativos</a></li>
                    <li><a class="btn btn-default" data-filter=".ayudante" href="#" id="botonAYU">Ayudantes de Laboratorio</a></li>
                </ul><!--/#portfolio-filter-->
            </div>
            <div class="col-sm-6">
                <h4 align="right"><span id="cont1">Personal Escuela Ingeniería Civil en Informática</span> - Período: <?php echo date("Y");?></h4>
            </div>
        </div>
        <ul class="portfolio-items col-5">
          <?php include("../logica/getPersonal.php");?>
        </ul>
    </section><!--/#portfolio-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <script src="../js/jquery.isotope.min.js"></script>
    <script src="../js/funciones_conocenos.js"></script>
    <script src="../js/main.js"></script>
    
</body>
</html>