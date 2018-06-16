<?php       /* MOSTRAREMOS ESQUELAS ( MISAS ) Y RECORDATORIAS

/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */
$ref = $_GET['ref'];
$miga = $_GET['miga'];

$pagina = null;
$estructura = [];

if($op === "esquelas" || $op === "recordatorias") {     // NAVEGACION - ESQUELA / RECORDATORIAS

    // Para ajustar la pagina en la que estamos y para salir correctamente de ella
    $pagina = ($op === "esquelas") ? "Esquelas" : "Recordatorias";
    $tipo_documento = ($op === "esquelas") ? "ESQUELA - MISA" : "RECORDATORIA";

    $modulo = "difunto_familiares";
    $cond = ($op === "esquelas") ? "esquela=1" : "r_misa=1";
    $identificadores = $ApiClient->select($modulo, $cond);

    // Construimos la estructura a mostrar ( DIFUNTO - SERVICIO )
    foreach ($identificadores as $ids) {

        $modulo = "difunto";
        $cond = "id='$ids->id_dif'";
        $difunto = $ApiClient->select($modulo, $cond);

        $modulo = "servicio";
        $id_dif = $difunto[0]->id;
        $cond = "id_dif='$id_dif'";
        $servicio = $ApiClient->select($modulo, $cond);

        $aux = [
            "id_dif" => $id_dif,
            "id_fam" => $ids->id_fam,
            "nombre" => $difunto[0]->nombre,
            "fecha_defuncion" => $servicio[0]->fecha_defuncion,
            "poblacion_entierro" => $servicio[0]->poblacion_entierro,
            "tipo_servicio" => $servicio[0]->tipo_servicio,
            "tipo_documento" => $tipo_documento
        ];

        array_push($estructura, $aux);
    }

} else if($miga === "difunto" || $miga === "factura") {       // DIFUNTO || FACTURA

    $id_dif = $ref;
    $pagina = "Documentos";

    // Construimos la estructura a mostrar
    $modulo = "difunto";
    $cond = "id='$id_dif'";
    $difunto = $ApiClient->select($modulo, $cond);

    $modulo = "servicio";
    $cond = "id_dif='$id_dif'";
    $servicio = $ApiClient->select($modulo, $cond);

    $modulo = "difunto_familiares";
    $cond = "id_dif='$id_dif'";
    $relacion = $ApiClient->select($modulo, $cond);

    $aux = [
        "id_dif" => $id_dif,
        "id_fam" => $relacion[0]->id_fam,
        "nombre" => $difunto[0]->nombre,
        "fecha_defuncion" => $servicio[0]->fecha_defuncion,
        "poblacion_entierro" => $servicio[0]->poblacion_entierro,
        "tipo_servicio" => $servicio[0]->tipo_servicio,
        "tipo_documento" => ""
    ];

    if($relacion[0]->esquela == "1") {

        $aux['tipo_documento'] = "ESQUELA - MISA";
        array_push($estructura, $aux);

    }
    if($relacion[0]->r_misa == "1") {

        $aux['tipo_documento'] = "RECORDATORIA";
        array_push($estructura, $aux);

    }

} else if($miga === "cliente") {    // CLIENTE

    $id_cli = $ref;
    $pagina = "Documentos";

    // Se puede dar el caso de que el cliente tenga varios
    // DIFUNTOS y por tanto varios DOCUMENTOS

    // Primero buscamos los DIFUNTOS asociados al cliente
    $modulo = "difunto_cliente";
    $cond = "id_cli='$id_cli'";
    $difunto_cliente = $ApiClient->select($modulo, $cond);

    // Para cada difunto construimos la estructura
    foreach ($difunto_cliente as $datos) {

        $id_dif = $datos->id_dif;
        $modulo = "difunto";
        $cond = "id='$id_dif'";
        $difunto = $ApiClient->select($modulo, $cond);

        $modulo = "servicio";
        $cond = "id_dif='$id_dif'";
        $servicio = $ApiClient->select($modulo, $cond);

        $modulo = "difunto_familiares";
        $cond = "id_dif='$id_dif'";
        $relacion = $ApiClient->select($modulo, $cond);

        $aux = [
            "id_dif" => $id_dif,
            "id_fam" => $relacion[0]->id_fam,
            "nombre" => $difunto[0]->nombre,
            "fecha_defuncion" => $servicio[0]->fecha_defuncion,
            "poblacion_entierro" => $servicio[0]->poblacion_entierro,
            "tipo_servicio" => $servicio[0]->tipo_servicio,
            "tipo_documento" => ""
        ];

        if($relacion[0]->esquela == "1") {

            $aux['tipo_documento'] = "ESQUELA - MISA";
            array_push($estructura, $aux);

        }
        if($relacion[0]->r_misa == "1") {

            $aux['tipo_documento'] = "RECORDATORIA";
            array_push($estructura, $aux);

        }
    }
}

?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-3"><h1><?= $pagina ?></h1></div>
        <div class="col-md-2 col-md-offset-1">
            <?php
                $dir = ($pagina === "Esquelas") ? "nuevaEsquela" : "nuevaRecordatoria";
                $txt = ($pagina === "Esquelas") ? "Nueva Esquela" : "Nueva Recordatoria";
            ?>
            <a href="main.php?op=<?= $dir ?>">
                <button type="button" class="btn btn-primary btn-lg btn-block"><?= $txt ?></button>
            </a>
        </div>
    </div>

    <div class="row page_content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading info_seccion">
                    <i class="fa fa-caret-square-o-right"></i>Listado
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>TIPO</th>
                                <th>Nombre Difunto</th>
                                <th>Fecha Defuncion</th>
                                <th>Población Entierro</th>
                                <th>Tipo Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($estructura as $datos) {
                                if ($datos['tipo_documento'] === "ESQUELA - MISA") {

                                    $tipo = "ESQUELA - MISA";
                                    $ver = "v_esquela";
                                    $plantilla = "plantillaEsquela";
                                    $miga = "esquela";

                                } else if ($datos['tipo_documento'] === "RECORDATORIA") {

                                    $tipo = "RECORDATORIA";
                                    $ver = "v_recordatoria";
                                    $plantilla = "plantillaRecordatoria";
                                    $miga = "recordatoria";

                                } ?>
                                <tr>
                                    <td class="iconos_td">
                                        <a href="./main.php?op=<?= $ver ?>&ref=<?= $datos['id_dif'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <?php if($tipo === "ESQUELA - MISA") { ?>
                                            <a href="./main.php?op=v_esquela&misa_funeral=true&ref=<?= $datos['id_dif'] ?>" title="Ver"><i class="fa fa-eye fa-fw"></i></a>
                                        <?php } ?>
                                        <a href="./main.php?op=e_documentos&ref=<?= $datos['id_dif'] ?>&miga=<?= $miga ?>" title="Editar"><i class="fa fa-edit fa-fw iconos_a"></i></a>
                                        <a href="./<?= $plantilla ?>.php?ref=<?= $datos['id_dif'] ?>" title="Descargar"><i class="fa fa-download fa-fw iconos_a"></i></a>
                                        <a href="#" title="Borrar" name="<?= $datos['id_fam'] ?>" onclick="borrarDocs(this);"><i class="fa fa-trash fa-fw iconos_a"></i></a>
                                    </td>
                                    <td class="id_td"><?= $datos['id_fam']; ?></td>
                                    <td><?= $tipo; ?></td>
                                    <td><?= $datos['nombre']; ?></td>
                                    <td><?= $datos['fecha_defuncion']; ?></td>
                                    <td><?= $datos['poblacion_entierro']; ?></td>
                                    <td><?= $datos['tipo_servicio']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- panel-body-->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->
</div> <!-- container-fluid -->

<script>

    function borrarDocs(info) {

        var id = info.name;
        var confirmar = confirm("¿Realmente desea eliminar el documento con ID = " + id + "?" );

        if(confirmar) {
            $.ajax({
                type: "POST",
                url: "../../procesa.php",
                data: {
                    op: "deleteDocs",
                    id: id
                },
                success: function (data) {

                    if(data == 1) {
                        location.reload();
                    } else alertify.error("Error en el borrado.");

                },
                error: function () {
                    alertify.error("Error en el borrado.");
                }
            });
        }
    }
</script>
