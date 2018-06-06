<div class="container-fluid">
    <form id="formServicio" class="form-horizontal" method="post">
        <input type="hidden" name="op" value="nuevoServicio" />

        <div class="row page_header">
            <div class="col-md-3"><h1>Nuevo Servicio</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input type="button" class="btn btn-primary btn-lg btn-block btnNuevoServicio" value="Añadir datos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">

                <div class="difunto"> <?php include('../formularios/form_difunto.php'); ?> </div>
                <div class="servicio"> <?php include('../formularios/form_servicio.php'); // S ?> </div>
                <div class="cliente"> <?php include('../formularios/form_cliente.php'); ?> </div>
                <div class="familiares"> <?php include('../formularios/form_familiares.php'); ?> </div>

                <!-- ****************   SUBMIT GENERAL   ************************* -->
                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="button" class="btn btn-primary btn-lg btn-block nuevo_servicio_button btnNuevoServicio" value="Añadir datos">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->

<script>
    function validarForm() {

        var nombre = $("#d_nombre");

        if(nombre.val() == "" ) {
            alertify.error("Faltan datos");
            nombre.focus();
            return false;
        }
        return true;
    }

    $(document).ready(function () {

        $(".btnNuevoServicio").click(function () {

            if(validarForm()) {
                $.ajax({
                    type: "POST",
                    url: "../../procesa.php",
                    data: $("#formServicio").serialize(),
                    success: function (data) {
                        console.log(data);
                        if(data != "error") redirigeJS(data);
                        else alertify.error("La inserción ha fallado.");
                    },
                    error: function (data) { alertify.error("error"); }
                });
            }
        });
    });
</script>
