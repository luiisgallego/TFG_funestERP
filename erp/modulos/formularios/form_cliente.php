<?php if($editar_factura === true) $cliente = $estructura['cliente']; ?>

<!-- ****************       CLIENTE       ************************* -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <a href="#form_cliente" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Cliente
        </a>
    </div> <!-- panel-heading -->
    <div id="form_cliente" class="panel-body collapse in">
        <?php if($editar === true) { ?>
            <input type="hidden" name="c_id" value="<?= $cliente->id ?>" />
        <?php } ?>
        <ul class="list-group diseño_formulario">
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Nombre</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input id="c_nombre" type="text" class="form-control" name="c_nombre" value="<?= $cliente->nombre ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>DNI</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="c_dni" value="<?= $cliente->dni ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Dirección</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="c_direccion" value="<?= $cliente->direccion ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Población</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="c_poblacion" value="<?= $cliente->poblacion ?>" placeholder=""/>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="col-md-3">
                    <label>Código Postal</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="number" class="form-control" name="c_codigo_postal" value="<?= $cliente->codigo_postal ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="tel" class="form-control" name="c_telefono" value="<?= $cliente->telefono ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Email</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="email" class="form-control" name="c_email" value="<?= $cliente->email ?>" placeholder=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Cuenta Bancaria</label>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="c_cuenta_bancaria" value="<?= $cliente->cuenta_bancaria ?>" placeholder=""/>
                    </div>
                </div>
            </li>
        </ul>
    </div> <!-- #form_cliente panel-body collapse -->
</div> <!-- panel panel-primary -->
<!-- ****************     FIN  CLIENTE       ************************* -->
