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
                    <?php if($_SESSION["login_info"]->rol != "empleado"){ ?>
                        <li><a href="modulos/contabilidad/main.php?op=facturas"><i class="fa fa-dashboard fa-fw"></i>Facturas</a></li>
                    <?php } ?>
                    <li><a href="modulos/agenda.php"><i class="fa fa-calendar fa-fw"></i>Agenda</a></li>
                    <li><a href="modulos/correo/correo.php"><i class="fa fa-envelope-square fa-fw"></i>Correo</a></li>

                </ul>
            </div>
        </div>
    </nav> <!-- FIN NAVEGACION -->
</div> <!-- FIN WRAPPER -->

<div class="modal fade" id="modalRegistrar" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Registrar Nuevo Usuario</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form id="formRegistrarUser" class="form-horizontal" method="post">
                            <input type="hidden" name="op" value="registrarUser" />
                            <label>Nombre</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="nombre" placeholder=""/>
                            </div>
                            <label>Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="pass" placeholder=""/>
                            </div>
                            <label>Rol</label>
                            <select class="form-control" name="rol" title="sexo">
                                <option>Admin</option>
                                <option>Empleado</option>
                            </select>
                        </form>
                    </div>
                </div>

            </div><!-- Fin Modal Body -->

            <div class="modal-footer">
                <button id="botonRegistrar" type="button" class="btn btn-info" style="float: left;">Registrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function registrarUsuario() {
        $("#modalRegistrar").modal();
    }

    $(document).ready(function () {

       $("#botonRegistrar").click(function () {

           $.ajax({
               type: "POST",
               url: "procesa.php",
               data: $("#formRegistrarUser").serialize(),
               success: function (data) {

                   console.log(data);

                   if(data != "error1") alertify.success("Usuario añadido.");
                   else alertify.error("La inserción ha fallado.");
                   $("#modalRegistrar").modal('hide');

               },
               error: function (data) { alertify.error("error"); }
           });
       });
    });
</script>

