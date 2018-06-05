<div class="container-fluid">
<!--    <form class="form-horizontal" method="post" action="../../procesa.php">-->
    <form id="formCliente" class="form-horizontal" method="post">
        <input type="hidden" name="op" value="nuevoCliente2" />

        <div class="row page_header">
            <div class="col-md-3"><h1>Nuevo Cliente</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input id="btnNuevoCliente" type="button" class="btn btn-primary btn-lg btn-block" value="Añadir datos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">

                <!-- *************** BUSCADOR **************** -->
                <div class="row busqueda">
                    <div class="col-md-8 col-md-offset-3">
                        <form class="navbar-form" role="search" method="post">
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control" name="nuevoCliente" onkeyup="buscarDifunto(this);" placeholder="Buscar difunto">
                            </div>
                        </form>
                        <div id="resBusqueda"></div>
                    </div>
                </div> <!-- busqueda -->
                <!-- *************** FIN BUSCADOR **************** -->

                <div class="cliente"> <?php include('../formularios/form_cliente.php'); ?> </div>

            </div> <!-- col-md-12 -->
        </div><!-- page_content -->
    </form>
</div> <!-- container-fluid -->

<script>
    function validarForm() {

        var nombre = $("#c_nombre");

        if(nombre.val() == "") {
            alertify.error("Faltan datos");
            nombre.focus();
            return false;
        }

        return true;
    }


    $(document).ready(function () {

        $("#btnNuevoCliente").click(function () {

            if(validarForm()) {
                $.ajax({
                    type: "POST",
                    url: "../../procesa.php",
                    data: $("#formCliente").serialize(),
                    success: function (data) {
                        redirigeJS(data);
                    },
                    error: function (data) {
                        console.log(data);
                        alertify.error("error");
                    }
                });
            }
        });


    });

</script>
