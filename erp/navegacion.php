<div id="wrapper">
    <!-- La idea que sigue este div es:
        - Parte superior de navegacion
        - Parte lateral de navegacion ( quedando en page-wrapper la parte restante ) -->
    <!--navigation-->
    <!-- NAVEGACION -->
    <nav class="navbar navbar-default navbar-static-top navGlobal" role="navigation" style="margin-bottom: 0">
        <?php include "./navSuperior.php"; ?>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li><a href="index.php"><i class="fa fa-home fa-fw"></i>Home</a></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard fa-fw"></i>Servicios
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="modulos/servicios/main.php?op=defunciones">Defunciones</a></li>
                            <li><a href="modulos/servicios/main.php?op=clientes">Clientes</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard fa-fw"></i>Documentos
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="modulos/documentos/main.php?op=esquelas">Esquelas</a></li>
                            <li><a href="modulos/documentos/main.php?op=recordatorias">Recordatorias</a></li>
                        </ul>
                    </li>
                    <li><a href="modulos/contabilidad/main.php?op=facturas"><i class="fa fa-dashboard fa-fw"></i>Facturas</a></li>
                    <li><a href="modulos/agenda.php"><i class="fa fa-calendar fa-fw"></i>Agenda</a></li>
                    <li><a href="modulos/correo/correo.php"><i class="fa fa-envelope-square fa-fw"></i>Correo</a></li>

                </ul>
            </div>
        </div>
    </nav> <!-- FIN NAVEGACION -->
</div> <!-- FIN WRAPPER -->
