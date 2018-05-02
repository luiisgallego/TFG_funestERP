<?php
$ref = $_GET['ref'];
$cliente = $ApiClient->select("cliente", "id='$ref'");
$cliente = $cliente[0];
?>

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="updateCliente" />
        <div class="row page_header">
            <div class="col-md-2"><h1>Cliente:</h1></div>
            <div class="col-md-10 alinear_nav">
                <div class="row">
                    <div class="col-md-5"><h4><?= $cliente->nombre ?></h4></div>
                    <div class="col-md-2"><input type="submit" class="btn btn-primary btn-block" value="Guardar"></div>
                    <div class="col-md-5">
                        <nav>
                            <ul class="nav nav-tabs">
                                <li class="espaciar_nav" role="presentation" >
                                    <a href="main.php?op=v_cliente&ref=<?= $cliente->id ?>">Ver</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="main.php?op=defunciones&cliente=1&ref=<?= $cliente->id ?>">Difunto</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../documentos/main.php?op=v_esquela&ref=<?= $cliente->id ?>">Esquela</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../contabilidad/main.php?op=v_factura&ref=<?= $cliente->id ?>">Factura</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- row page_header -->

        <div class="row page_content">
            <div class="col-md-12">

                <div class="difunto"> <?php include('form_cliente.php'); ?> </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Guardar">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->
