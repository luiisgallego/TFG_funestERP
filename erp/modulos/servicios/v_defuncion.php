<?php
/* DENTRO DE DEFUNCIÓN MOSTRAMOS LOS DATOS DE TODAS LAS TABLAS */

$ref = $_GET['ref'];
$difunto = $ApiClient->select("difunto", "id='$ref'");
$difunto = $difunto[0];

//print("<pre>");
//print_r($difunto);
//print("</pre>");

?>

<div class="container-fluid">
    <div class="row page_header">
        <div class="col-md-2"><h1>Defunción:</h1></div>
        <div class="col-md-10 alinear_nav">
            <div class="col-md-5"><h4><?= $difunto->nombre ?></h4></div>
            <div class="col-md-7">
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="espaciar_nav" role="presentation" >
                            <a href="main.php?op=e_defuncion&ref=<?= $difunto->id ?>">Editar</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="main.php?op=clientes&ref=<?= $difunto->id ?>">Cliente</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../documentos/main.php?op=v_esquela&ref=<?= $difunto->id ?>">Esquela</a>
                        </li>
                        <li class="espaciar_nav" role="presentation">
                            <a href="../contabilidad/main.php?op=v_factura&ref=<?= $difunto->id ?>">Factura</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> <!-- row navegacion -->

    <div class="row page_content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading info_seccion"><i class="fa fa-caret-square-o-right"></i>Datos Básicos</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row diseño_span">
                                <div class="col-md-6"><span>Nombre: </span><?= $difunto->nombre ?></div>
                                <div class="col-md-3"><span>DNI: </span><?= $difunto->dni ?></div>
                                <div class="col-md-3"><span>Sexo: </span><?= $difunto->sexo ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row diseño_span">
                                <div class="col-md-3"><span>Natural de: </span><?= $difunto->poblacion ?></div>
                                <div class="col-md-3"><span>Provincia: </span><?= $difunto->provincia ?></div>
                                <div class="col-md-3"><span>Calle: </span><?= $difunto->calle ?></div>
                                <div class="col-md-3"><span>Número: </span><?= $difunto->numero ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row diseño_span">
                                <div class="col-md-3"><span>Código Postal: </span><?= $difunto->codigo_postal ?></div>
                                <div class="col-md-3"><span>Fecha nacimiento: </span><?= $difunto->fecha_nacimiento ?></div>
                                <div class="col-md-3"><span>Estado civil: </span><?= $difunto->estado_civil ?></div>
                                <div class="col-md-3"><span>Nombre Pareja: </span><?= $difunto->nombre_pareja ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row diseño_span">
                                <div class="col-md-3"><span>Hijo de: </span><?= $difunto->hijo_de ?></div>
                                <div class="col-md-3"><span>Natural de: </span><?= $difunto->poblacion2 ?></div>
                                <div class="col-md-3"><span>Y de: </span><?= $difunto->hijo_de2 ?></div>
                                <div class="col-md-3"><span>Natural de: </span><?= $difunto->poblacion3 ?></div>
                            </div>
                        </li>
                    </ul>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-md-12 -->
    </div> <!-- page_content -->

</div> <!-- container-fluid -->
