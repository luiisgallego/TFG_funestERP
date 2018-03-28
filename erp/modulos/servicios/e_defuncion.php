<?php
$ID = $_GET['ref'];
if($ID == 1) $datos = $ApiClient->getDifunto("Luis", "Gallego Quero");
//print("<pre>"); print_r($datos); print("</pre>");
?>

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="../../procesa.php">
        <input type="hidden" name="op" value="nuevoServicio" />

        <div class="row page_header">
            <div class="col-md-2"><h1>Defunción:</h1></div>
            <div class="col-md-10 alinear_nav">
                <div class="row">
                    <div class="col-md-5"><h4>Jose María del Carmen Garcia Ruiz</h4></div>
                    <div class="col-md-2"><input type="submit" class="btn btn-primary btn-block" value="Guardar"></div>
                    <div class="col-md-5">
                        <nav>
                            <ul class="nav nav-tabs">
                                <li class="espaciar_nav" role="presentation" >
                                    <a href="main.php?op=v_defuncion">Ver</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="main.php?op=clientes">Cliente</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../documentos/main.php?op=v_esquela">Esquela</a>
                                </li>
                                <li class="espaciar_nav" role="presentation">
                                    <a href="../contabilidad/main.php?op=v_factura">Factura</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div> <!-- row page_header -->

        <div class="row page_content">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="#datos_basicos" class="info_seccion" data-toggle="collapse">
                            <i class="fa fa-caret-square-o-right"></i>Datos Básicos
                        </a>
                    </div> <!-- panel-heading -->
                    <div id="datos_basicos" class="panel-body collapse in">
                        <ul class="list-group diseño_formulario">
                            <li class="list-group-item">
                                <div class="col-md-3">
                                    <label>Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Apellidos</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="apellidos" value="<?= $datos->apellidos ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>DNI</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="DNI" value="<?= $datos->dni ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Tipo Servicio</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select class="form-control" name="tipo_servicio" title="tipo servicio">
<!--                                                <option value="Particular">Particular</option>-->
<!--                                                <option value="Compañia">Compañia</option>-->
<!--                                                <option value="Recepción">Recepción</option>-->
                                            <?php
                                            $estados = array('Particular', 'Compañia', 'Recepción');
                                            foreach ($estados as $estado){
                                                if($estado == $datos->tipo_servicio) echo '<option selected="selected">' .$estado. '</option>';
                                                else echo '<option>' .$estado. '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-md-3">
                                    <label>Natural de</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="natural_de" value="<?= $datos->poblacion ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Provincia</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="provincia" value="<?= $datos->provincia ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Calle</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="calle" value="<?= $datos->calle ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Número</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" name="numero" value="<?= $datos->numero ?>" />
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-md-3">
                                    <label>Tanatorio</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select class="form-control" name="tanatorio" title="tanatorio">
                                            <?php
                                            $estados = array('No', 'Sala 1', 'Sala 2', 'Sala 3');
                                            foreach ($estados as $estado){
                                                if($estado == $datos->tanatorio) echo '<option selected="selected">' .$estado. '</option>';
                                                else echo '<option>' .$estado. '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Fecha nacimiento</label>
                                    <div class="input-group ">
                                        <div class="input-group-addon"><!--<span class="glyphicon glyphicon-calendar"></span>--></div>
                                        <input type="date" class="form-control" name="fecha_nacimiento" value="<?= $datos->fecha_nacimiento ?>" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Estado civil</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <select class="form-control" name="estado_civil" title="estado civil">
                                            <?php
                                            $estados = array('Casado', 'Viudo', 'Soltero');
                                            foreach ($estados as $estado){
                                                if($estado == $datos->estado_civil) echo '<option selected="selected">' .$estado. '</option>';
                                                else echo '<option>' .$estado. '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- #datos_basicos panel-body -->
                </div> <!-- panel -->

                <div class="row">
                    <div class="col-md-2 col-md-offset-4">
                        <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Guardar">
                    </div>
                </div>

            </div> <!-- col-md-12 -->
        </div> <!-- page_content -->
    </form>
</div> <!-- container-fluid -->
