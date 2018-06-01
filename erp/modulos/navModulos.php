<div id="wrapper">
    <!-- NAVEGACION -->
    <nav class="navbar navbar-default navbar-static-top navGlobal" role="navigation" style="margin-bottom: 0">
        <?php include "../navSuperior.php"; ?>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li><a href="../../index.php"><i class="fa fa-home fa-fw"></i>Home</a></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard fa-fw"></i>Servicios
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="../../modulos/servicios/main.php?op=defunciones">Defunciones</a></li>
                            <li><a href="../../modulos/servicios/main.php?op=clientes">Clientes</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard fa-fw"></i>Documentos
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="../../modulos/documentos/main.php?op=esquelas">Esquelas</a></li>
<!--                            <li><a href="#">Misa Funeral</a></li>-->
                            <li><a href="../../modulos/documentos/main.php?op=recordatorias">Recordatorias</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard fa-fw"></i>Contabilidad
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="../../modulos/contabilidad/main.php?op=facturas">Facturas</a></li>
<!--                            <li><a href="#">Proveedores</a></li>-->
<!--                            <li><a href="#">Gastos</a></li>-->
                        </ul>
                    </li>

                    <li><a href="../../modulos/agenda.php"><i class="fa fa-calendar fa-fw"></i>Agenda</a></li>

                    <li>
                        <a href="#">
                            <i class="fa fa-envelope-square fa-fw"></i>Correo
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="../../modulos/correo/nuevoMensaje.php">Nuevo</a></li>
                            <li><a href="#">Bandeja entrada</a></li>
                            <li><a href="#">Bandeja salida</a></li>
                            <li><a href="#">Borradores</a></li>
                        </ul>
                    </li>

<!--                    <li><a href="#"><i class="fa fa-calendar fa-fw"></i>Inteligencia de negocio</a></li>-->

                </ul>
            </div>
        </div> <!-- navbar-default sidebar
    </nav> <!-- navbar -->
</div> <!-- wrapper -->
