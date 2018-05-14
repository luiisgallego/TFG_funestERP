<?php
/* ¡¡ CLIENTE NO ES UNA RELACION 1-1 !! */
/* TENEMOS QUE CONTROLAR DE DONDE VENIMOS. */

$ref = $_GET['ref'];
$miga = $_GET['miga'];
$id_cliente = null;

if($miga == "" || $miga == "cliente") {     // CLIENTE
    $id_cliente = $ref;
} else {
    //$miga = $_GET['miga'];

    if($miga === "difunto") {    // DIFUNTO

        // Consultamos el CLIENTE asociado al DIFUNTO
        $modulo = "difunto_cliente";
        $cond = "id_dif='$ref'";
        $difuntoCliente = $ApiClient->select($modulo, $cond);
        $id_cliente = $difuntoCliente[0]->id_cli;
    }
}

$cliente = $ApiClient->select("cliente", "id='$id_cliente'");
$cliente = $cliente[0];

/* DIFUNTOS del CLIENTE (salida) */
$difuntosCliente = $ApiClient->select("difunto_cliente", "id_cli='$id_cliente'");
?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-2"><h1>Cliente:</h1></div>
        <div class="col-md-10 alinear_nav">
            <div class="col-md-5"><h4><?= $cliente->nombre ?></h4></div>
            <div class="col-md-7">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="espaciar_nav" role="presentation">
                            <a href="main.php?op=e_cliente&ref=<?= $cliente->id ?>">Editar</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <?php if(count($difuntosCliente) > 1) { ?>
                                <a href="main.php?op=defunciones&miga=cliente&ref=<?= $cliente->id ?>">Difuntos</a>
                            <?php } else { ?>
                                <a href="main.php?op=v_defuncion&ref=<?= $difuntosCliente[0]->id_dif ?>">Difunto</a>
                            <?php } ?>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../documentos/main.php?op=esquelas&ref=<?= $cliente->id ?>">Esquela</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../contabilidad/main.php?op=facturas&ref=<?= $cliente->id ?>">Factura</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> <!-- row navegacion -->
    <div class="row page_content">
        <div class="col-md-12">
            <div>
                <div class="panel panel-primary">
                    <div class="panel-heading info_seccion"><i class="fa fa-caret-square-o-right"></i>Datos Cliente</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row diseño_span">
                                    <div class="col-md-6"><span>Nombre: </span><?= $cliente->nombre ?></div>
                                    <div class="col-md-3"><span>DNI: </span><?= $cliente->dni ?></div>
                                    <div class="col-md-3"><span>Dirección: </span><?= $cliente->direccion ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row diseño_span">
                                    <div class="col-md-3"><span>Población: </span><?= $cliente->poblacion ?></div>
                                    <div class="col-md-3"><span>Código Postal:: </span><?= $cliente->codigo_postal ?></div>
                                    <div class="col-md-3"><span>Telefono: </span><?= $cliente->telefono ?></div>
                                    <div class="col-md-3"><span>Email: </span><?= $cliente->email ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row diseño_span">
                                    <div class="col-md-3"><span>Cuenta Bancaria: </span><?= $cliente->cuenta_bancaria ?></div>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- panel-body -->
                </div> <!-- panel panel-primary -->
            </div>
        </div> <!-- col-md-12 -->
    </div> <!-- row page_content -->
</div> <!--  container-fluid -->
