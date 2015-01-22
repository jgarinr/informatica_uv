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
                    <h1><i class="fa fa-database"></i> Especialidad en Base de Datos</h1>
                    <p>Gestión y Diseño de Base de Datos</p>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="../index.php">Inicio</a></li>
                        <li class="active">Especialidad en Base de Datos</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->

    <section id="about-us" class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>Gestión y Diseño de Base de Datos</h2>
                <p style="text-align : justify;" id="campo_descripcion"></p>
            </div><!--/.col-sm-6-->
            <div class="col-sm-6">
                <h2></h2>
                <section id="main-slider" class="no-margin">
                        <div class="carousel slide wet-asphalt">
                            <ol class="carousel-indicators">
                                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                                <li data-target="#main-slider" data-slide-to="1"></li>
                                <li data-target="#main-slider" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active fotos_mencion" style="background-image: url(../images/mencion/data1.png)"></div><!--/.item-->
                                <div class="item fotos_mencion" style="background-image: url(../images/mencion/data2.png)"></div><!--/.item-->
                                <div class="item fotos_mencion" style="background-image: url(../images/mencion/data3.png)"></div><!--/.item-->
                            </div><!--/.carousel-inner-->
                        </div><!--/.carousel-->
                        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a class="next hidden-xs" href="#main-slider" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </section><!--/#main-slider-->
            </div><!--/.col-sm-6-->
        </div><!--/.row-->
    </section><!--/#about-us-->

    <section id="recent-works">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3>Asignaturas de Mención<br>Año <?php echo date("Y");?></h3>
                    <p>Haz click en alguna asignatura, para poder ver su información.</p>
                    <div class="btn-group">
                        <a class="btn btn-danger" href="#scroller" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                        <a class="btn btn-danger" href="#scroller" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                    <p class="gap"></p>
                </div>
                <div class="col-md-9">
                    <div id="scroller" class="carousel slide">
                        <div class="carousel-inner carrusel_asignatura">
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
        </div>
    </section><!--/#recent-works-->

    <!-- Modal -->
<div class="modal fade" id="myModal_mencion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel"></h3>
      </div>
      <div class="modal-body" id="cuerpoModal" style="text-align : justify;">
      </div>
      <div class="modal-footer">
        <a id='button1id' name='button1id' class='btn btn-primary' href='descargas.php'><i class="fa fa-download"></i> Ir a Descargas</a>
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
    <script src="../js/funcion_menciones_bd.js"></script>
</body>
</html>