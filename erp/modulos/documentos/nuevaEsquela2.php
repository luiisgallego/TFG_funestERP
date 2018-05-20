<!--
Contamos con que cada difunto lleva asociado un servicio antes de crear la esquela.
-->

<div class="container-fluid">
    <form id="id_form" class="form-horizontal">
<!--        <input type="hidden" name="op" value="nuevaEsquela" />-->

        <div class="row page_header">
            <div class="col-md-3"><h1>Nueva Esquela</h1></div>
            <div class="col-md-2 col-md-offset-1" style="margin-top: 5px;">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Añadir datoos">
            </div>
        </div>

        <div class="row page_content">
            <div class="col-md-12">

                <!-- *************** BUSCADOR **************** -->
                <div class="row busqueda">
                    <div class="col-md-8 col-md-offset-3">
<!--                        <form class="navbar-form" role="search" method="post">-->
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control" name="nuevaEsquela" onkeyup="buscarDifunto2(this);" placeholder="Buscar difunto">
                            </div>
<!--                        </form>-->
                        <div id="resBusqueda"></div>
                    </div>
                </div> <!-- busqueda -->
                <!-- *************** FIN BUSCADOR **************** -->

                <!-- Indicamos que nueva esquela para la BD ¿¿¿???? -->
                <div class="familiares hidden"> <?php include('../formularios/form_familiares.php'); ?> </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->

<script>

    $("#id_form").on("submit", function () {

        var id_dif = $("#id_dif").val();
        var nom_dif = $("#nom_dif").val();

        console.log(nom_dif);

        $.post('../../procesa.php', {op: "nuevoDocs", id_dif: id_dif, nom_dif: nom_dif}, function (res) {
            console.log(res);
        });

//        $.ajax({
//            url: '../../procesa.php',
//            type: 'POST',
//            data: {
//                op: "nuevoDocs",
//                id_dif: id_dif,
//                nom_dif: nom_dif
//            },
//            cache       : false,
//            async       : false,
//            dataType    : 'json',
//            success: function (response) {
////                alert(response);
////                var json = JSON.parse(response);
//                alert("OK");
//            },
//            error: function (response) {
//                alert("eRReeor");
//            }
//        });
        return false;
    });

</script>
