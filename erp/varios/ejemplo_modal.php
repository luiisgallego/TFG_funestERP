<!-- Modal desde que añadiremos los datos de un nuevo servicio-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
<!--                <button type="button" class="close" data-dismiss="modal"></button>-->
<!--                <h4 class="modal-title">Nuevo Servicio</h4>-->
            </div>

            <div class="modal-body">
                <!-- Contenido del modal, formularios, avisos, .... -->
                <button type="button" class="btn btn-info btn-lg" id="myBtn">Nuevo Servicio</button>
            </div><!-- Fin Modal Body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(function () { // Poder abrir el modal.
        $("#myBtn").click(function () {
            $("#myModal").modal();
        });
    });
</script>