<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Luis Gallego Quero">
        <title>Servicios Funerarios Gallego </title>
        <link rel="icon" href="./img/favicon.ico">

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- CSS -->
        <link href="estilosWEB.css" rel="stylesheet">
        <!-- FontAwesome Icons (http://fontawesome.io) -->
        <link href="bootstrap/fontAwesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Icons -->
        <!-- incluir posteriormente en el CSS para hacer uso de ellas -->
        <link href="https://fonts.googleapis.com/css?family=Graduate|Pacifico" rel="stylesheet">

    </head>
    <body>
        <!-- Estructura general -->
        <!-- HEADER -->
        <header>
            <!-- navbar-fixed-top -> barra fija
            navbar-default -> barra blanca // navbar-inverse -> barra negra -->
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header" >
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                            <!--Button para cuando reducimos el espacio -->
                            <span class="sr-only">Toggle navigation</span> <!-- Para que la pagina sea mas accesible -->
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button> <!-- .navbar-toggle -->
                        <a class="navbar-brand" href="../erp/index.php">Gallego</a> <!-- ToDo añadir logo real (navbar-brand) -->
                    </div> <!-- .navbar-header -->
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#nosotros">Nosotros</a></li>
                            <li class="disabled"><a href="#0">Fotos</a></li>
                            <li><a href="#contacto">Contacto</a></li>
                            <!--<li><a href="./erp/index.php">Login</a></li>-->
                            <li><a href="./erp/login.php">Login</a></li>
                            <!--<li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Dropdown <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Regular link</a></li>
                                    <li class="disabled"><a href="#">Disabled link</a></li>
                                    <li><a href="#">Another link</a></li>
                                </ul>
                            </li>-->
                        </ul>
                    </div> <!-- .collapse -->
                </div> <!-- .container -->
            </nav> <!-- .navbar -->
        </header>
        <!-- END HEADER -->


        <!-- TITLE & ENROLL -->
        <!-- Por lo general utilizamos section para cada apartado que vayamos a construir -->
        <section id="title-enroll">
            <!-- jumbotron -> da mayor importancia a la seccion (visualmente) -->
            <div class="jumbotron">
                <div class="container-fluid">
                    <h1>Servicios Funerarios Gallego</h1>
                    <!-- btn-primary -> color azul
                        btn-danger -> color rojo
                        btn-warning -> color naranja
                        btn-lg -> tamaño grande -->
                    <p><a class="btn btn-primary btn-lg" href="">Contacta</a></p>
                </div> <!-- .container-fluid -->
            </div> <!-- .jumbotron -->
        </section> <!-- #title-enroll ->
        <!-- END TITLE & ENROLL -->

        <!-- NOSOTROS -->
        <section id="nosotros" class="separador">
            <div class="container-fluid">
                <h2>Sobre nosotros</h2>
                <!-- lead -> aumenta el tamaño de letra -->
                <p class="lead">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Ut dapibus tellus id sapien eleifend vehicula.
                    Quisque ultricies eget nisi ac vulputate. <strong>Vivamus</strong> malesuada ligula eget
                    faucibus egestas. Praesent et vulputate neque, sit amet tincidunt mi.
                    In sagittis luctus malesuada. Aenean consequat nibh nec tellus viverra,
                    non luctus tellus venenatis.
                </p>
                <!-- separador -> clase inventada que mete 50px de top y botom -->
                <div class="row">
                    <div class="col-md-4">
                        <!-- img-circle -> crea una imagen circular -->
                        <img src="./img/tanatorios.jpg" alt="" class="img-circle">
                        <h3>Informacion 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Ut dapibus tellus id sapien eleifend vehicula.
                        </p>
                    </div><div class="col-md-4">
                        <!-- img-circle -> crea una imagen circular -->
                        <img src="./img/tanatorios.jpg" alt="" class="img-circle">
                        <h3>Informacion 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Ut dapibus tellus id sapien eleifend vehicula.
                        </p>
                    </div><div class="col-md-4">
                        <!-- img-circle -> crea una imagen circular -->
                        <img src="./img/tanatorios.jpg" alt="" class="img-circle">
                        <h3>Informacion 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Ut dapibus tellus id sapien eleifend vehicula.
                        </p>
                    </div>
                </div>
            </div> <!-- .container-fluid -->
        </section> <!-- #nosotros -->
        <!-- END NOSOTROS -->

        <!-- CONTACTO -->
        <section id="contacto" class="separador">
            <div class="container">
                <h1>¿Donde estamos?</h1>
                <div class="col-md-6">
                    <h2>GOOGLE MAPS</h2>
                </div>
                <div class="col-md-6">
                    <h2>CONTACTANOS</h2>
                </div>
            </div> <!-- .container -->
        </section> <!-- #contacto -->
        <!-- END CONTACTO -->

        <!-- FOOTER -->
        <footer>

        </footer>
        <!-- END FOOTER -->
        <!-- END Estructura general -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>