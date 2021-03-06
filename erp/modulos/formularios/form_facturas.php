<!-- ****************       FACTURAS       ************************* -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <a href="#form_facturas" class="info_seccion" data-toggle="collapse">
            <i class="fa fa-caret-square-o-right"></i>Datos Facturas
        </a>
    </div> <!-- panel-heading -->
    <div id="form_facturas" class="panel-body collapse in">
        <?php if($editar === true) { ?>
            <input type="hidden" name="t_id_dif" value="<?= $estructura['difunto']->id ?>" />
            <input type="hidden" name="t_id_fact" value="<?= $estructura['relacion']->id_fact ?>" />
        <?php } ?>
        <ul id="parConceptoImporte" class="list-group diseño_formulario">
            <?php if($editar === true) {
                $cont=0;
                foreach ($estructura['facturas'] as $valor) { ?>
                    <li class="list-group-item">
                        <div class="col-md-8">
                            <label>Concepto</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="t_concepto<?= $cont ?>1" value="<?= $valor->concepto ?>" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Importe</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="t_importe<?= $cont ?>1" value="<?= $valor->importe ?>" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label></label>
                            <div class="input-group">
                                <input type="button" class="btn btn-success" value="+" onclick="addParConceptoImporte()" />
                            </div>
                        </div>
                    </li>
                    <?php $cont++; }
            } else { ?>
                <li class="list-group-item">
                    <div class="col-md-8">
                        <label>Concepto</label>
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input id="t_concepto_1" type="text" class="form-control" name="t_concepto_1" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>Importe</label>
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input id="t_importe_1" type="text" class="form-control" name="t_importe_1" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <div class="input-group">
                            <input type="button" class="btn btn-success" value="+" onclick="addParConceptoImporte()" />
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div> <!-- #form_servicio panel-body collapse -->
</div> <!-- panel panel-primary -->
<!-- ****************     FIN  FAMILIARES       ************************* -->
