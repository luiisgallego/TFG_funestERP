<?php

$ref = $_GET['ref'];
$miga = $_GET['miga'];
//$misa_funeral = $_GET['misa_funeral'] ? $_GET['misa_funeral'] : false;
/* Habrá que distinguir entre recordatorias con misa funeral o no */
$estructura = null;

if($miga == "") {       // ESQUELA

    $id_dif = $ref;

    // Necesito una estructura con DIFUNTO - SERVICIO - FAMILIARES

    $modulo = "difunto";
    $cond = "id='$id_dif'";
    $difunto = $ApiClient->select($modulo, $cond);

    $modulo = "servicio";
    $cond = "id_dif='$id_dif'";
    $servicio = $ApiClient->select($modulo, $cond);

    $modulo = "difunto_familiares";
    $cond = "id_dif='$id_dif'";
    $relacion = $ApiClient->select($modulo, $cond);

    $modulo = "familiares";
    $id_fam = $relacion[0]->id_fam;
    $cond = "id_fam='$id_fam'";
    $familiares = $ApiClient->select($modulo, $cond);

    $estructura = [
        "difunto" => $difunto[0],
        "servicio" => $servicio[0],
        "familiares" => $familiares
    ];

    // FORMATEMOS LA FECHA
    $estructura['servicio']->fecha_defuncion = format_fecha($estructura['servicio']->fecha_defuncion, "defuncion");
    $estructura['servicio']->fecha_entierro = format_fecha($estructura['servicio']->fecha_entierro, "entierro");
    $estructura['servicio']->fecha_misa = format_fecha($estructura['servicio']->fecha_misa, "entierro");

    // FORMATEMOS LA HORA
    $estructura['servicio']->hora_entierro = format_hora($estructura['servicio']->hora_entierro);
    $estructura['servicio']->hora_misa = format_hora($estructura['servicio']->hora_misa);

    // FORMATEMOS LA EDAD
    $estructura['difunto']->fecha_nacimiento = format_edad($estructura['difunto']->fecha_nacimiento);

}

// Para el boton de estado
$emitida = $relacion[0]->recordatoria_emitida;

//file_put_contents (__DIR__."/SOMELOG.log" , print_r($relacion, TRUE).PHP_EOL, FILE_APPEND );

?>

<style>
    .body_recordatoria {
        /*background: #f2f2f2; */
        font-family: Arial;
        font-size: 13px;
        line-height: 1.3;
        color: #444;
    }

    #dina6 {
        width: 148mm;
        height: 105mm;
        border: 1px solid #D2D2D2;
        background: #fff;
        margin: 10px auto;
    }

    .tam_img {
        max-width: 50px;
        max-height: 80px;
        margin-bottom: 10px;
    }

    .contenido_general {
        margin-top:30px;
        text-align: justify;
    }

    .contenido_derecha { margin-top: 70px; }

    .separado_row { margin-bottom: 5px; }
    .separado_row_doble {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>

<div class="container-fluid">
    <div class="row border_nav">
        <div class="col-md-2"><h2>Recordatoria:</h2></div>
        <div class="col-md-10 alinear_nav">
            <div class="col-md-5"><h4><?= $estructura['difunto']->nombre ?></h4></div>
            <div class="col-md-7">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="" role="presentation">
<!--                            --><?php //$plantilla = ($misa_funeral == true) ? "./plantillaMisa.php" : "./plantillaEsquela.php"?>
                            <a href="./plantillaRecordatoria.php?ref=<?= $estructura['difunto']->id ?>"><i class="fa fa-download fa-fw"></i></a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="main.php?op=e_documentos&ref=<?= $estructura['difunto']->id ?>&miga=recordatoria">Editar</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../servicios/main.php?op=v_defuncion&ref=<?= $estructura['difunto']->id ?>">Difunto</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../servicios/main.php?op=v_cliente&miga=docs&ref=<?= $estructura['difunto']->id ?>">Cliente</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../contabilidad/main.php?op=v_factura&miga=docs&ref=<?= $estructura['difunto']->id ?>">Factura</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> <!-- row navegacion -->

    <div class="row">
        <div class="col-md-2 estado">
            <h4>Estado:</h4>
            <button id="btn_emitida_recordatoria" type="button" class="btn btn-danger" onclick="setEstado(this);">Emitir</button>
        </div>
        <div class="col-md-8">
            <div class="row body_recordatoria">
                <div id="dina6">

                    <div class="row contenido_general">
                        <div class="col-md-4 col-md-offset-1">
                            <div class="contenido_izquierda">
                                <div style="text-align: center;">
                                    <img class="tam_img" src="../../img/cruz_recordatoria.png">
                                    <div class="" style="font-size: 70%;">ROGAD A DIOS EN CARIDAD</div>
                                    <div class="separado_row" style="font-size: 70%;">por el alma de</div>
                                    <div class="separado_row" style="font-size: 80%; font-weight: bold;"><?= strtoupper($estructura['difunto']->nombre) ?></div>
                                    <div class="separado_row" style="font-size: 70%;">Que fallecio el<?= $estructura['servicio']->fecha_defuncion ?> a los
                                        <?= $estructura['difunto']->fecha_nacimiento ?> años de edad habiendo recibido los santos Sacramentos.
                                    </div>
                                    <div class="separado_row subrayado" style="font-size: 80%; font-weight: bold;">D.E.P.</div>
                                </div>
                                <div class="separado_row" style="font-size: 70%;">
                                    <?php foreach($estructura['familiares'] as $valor) { ?>
                                        <span><?= $valor->rol ?>: </span> <?= $valor->nombres ?>,
                                    <?php } ?>
                                    Sobrinos, Primos y demás familia.
                                </div>
                                <!--                        <div class="separado_row" style="font-size: 70%;">Tus hermanso: Dolores y Jose Santiago Garrido, Hermanos Politicos:-->
                                <!--                            Antonio Castillo, Cabeza Millan, Francisco, Antonio, Julia, Sacrita y Manuel Casado Delgado,-->
                                <!--                            Sobrinos, Primos y demás familia.-->
                                <!--                        </div>-->
                                <div class="separado_row" style="font-size: 70%;">Ruegan a sus amistades  encomienden su
                                    alma a Dios Nuestro Señor en sus Oraciones  y asistan a la Misa Funeral  que por el
                                    eterno descanso de su alma, se celebrara el <?= $estructura['servicio']->fecha_misa ?> a las
                                    <?= $estructura['servicio']->hora_misa ?> de la tarde en la Parroquia Ntra Sra de la Asunción
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-md-offset-2">
                            <div class="contenido_derecha">
                                <div class="separado_row" style="font-size: 70%;">Oh Dios, siempre dispuesto a la misericordia y al perdón,
                                    escuchas nuestras súplicas por siervo AURELIA que acabas de llamar a tu presencia, y, porque creyó y
                                    esperó en ti, condúcela a la patria verdadera para que goce contigo de la alegría eterna
                                </div>
                                <div class="separado_row_doble" style="font-size: 70%;">Por nuestro Señor Jesucristo</div>
                                <div class="separado_row" style="font-size: 70%;">Señor Dios, perdón de los pecadores y felicidad de los justos,
                                    al cumplir con dolor el deber de dar sepultura al cuerpo de nuestra hermana AURELIA  te pedimos le des
                                    parte en el gozo de tus elegidos.
                                </div>
                                <div class="separado_row_doble" style="font-size: 70%;">Por nuestro Señor Jesucristo</div>
                                <div class="separado_row" style="font-size: 70%;">Porcuna - Junio - 2018</div>
                            </div>
                        </div>
                    </div>  <!-- contenido_general -->
                </div> <!-- dina6 -->
            </div> <!-- row body_recordatoria -->
        </div> <!-- col-md-8 -->
    </div> <!-- row -->
</div>

<script>
    $(document).ready(function () {

        var emitida = '<?php print_r($emitida); ?>';
        var btn_emitida = $("#btn_emitida_recordatoria");

        if(emitida == 1 ) {
            btn_emitida.removeClass('btn-danger');
            btn_emitida.addClass('btn-success');
            btn_emitida.text("Emitida");
        }
    });

    function setEstado(info) {

        var btn_emitida = $("#btn_emitida_recordatoria");
        var id_fam = '<?php print_r($id_fam); ?>';
        var id = info.id;
        var estado = null;

        if(id == "btn_emitida_recordatoria") estado = "emitida";

        $.ajax({
            type: "POST",
            url: "../../procesa.php",
            data: {
                op: "setEstadoRecordatoria",
                id_fam: id_fam,
                estado: estado,
            },
            success: function (data) {

                if(data == 1) {

                    if(estado == "emitida") {
                        btn_emitida.removeClass('btn-danger');
                        btn_emitida.addClass('btn-success');
                        btn_emitida.text("Emitida");

                        alertify.success("Recordatoria actualizada correctamente.");
                    }
                } else alertify.error("Error en la actualización.");

            },
            error: function () {
                alertify.error("Error en la actualización.");
            }
        });
    }
</script>
