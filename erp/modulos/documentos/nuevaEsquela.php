<!--
Contamos con que cada difunto lleva asociado un servicio antes de crear la esquela.
-->

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="nuevaEsquela" />

        <div class="row page_header">
            <div class="col-md-3"><h1>Nueva Esquela</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Añadir datos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">

                <!-- *************** BUSCADOR **************** -->
                <div class="row busqueda">
                    <div class="col-md-8 col-md-offset-3">
                        <form class="navbar-form" role="search" method="post">
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control" name="nuevaEsquela" onkeyup="buscarDifunto(this);" placeholder="Buscar difunto">
                            </div>
                        </form>
                        <div id="resBusqueda"></div>
                    </div>
                </div> <!-- busqueda -->
                <!-- *************** FIN BUSCADOR **************** -->

                <div class="familiares"> <?php include('../formularios/form_familiares.php'); ?> </div>
<!--                <div class="difunto">   --><?php //  $editar = true;
//                    $difunto = $ApiClient->select("difunto", "id=1");
//                    $difunto = $difunto[0];
//                                                include('../formularios/form_difunto.php');
//                                        ?>
<!--                </div>-->
<!--                <div class="servicio"> --><?php //include('../formularios/form_servicio.php'); // S ?><!-- </div>-->

                <!-- ****************   SUBMIT GENERAL   ************************* -->
<!--                <div class="row">-->
<!--                    <div class="col-md-2 col-md-offset-4">-->
<!--                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Añadir datos">-->
<!--                    </div>-->
<!--                </div>-->

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->
