<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="nuevoServicio" />

        <div class="row page_header">
            <div class="col-md-3"><h1>Nuevo Servicio</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Añadir datos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">

                <div class="difunto"> <?php include('form_difunto.php'); ?> </div>
                <div class="servicio"> <?php include('form_servicio.php'); // S ?> </div>
                <div class="cliente"> <?php include('form_cliente.php'); ?> </div>
                <div class="familiares"> <?php include('form_familiares.php'); ?> </div>
<!--                <div class="seguros"> --><?php //include('form_seguros.php'); // Z ?><!-- </div>-->
<!--                <div class="floristeria"> --><?php //include('form_floristeria.php'); ?><!-- </div>-->

                <!-- ****************   SUBMIT GENERAL   ************************* -->
                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Añadir datos">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->
