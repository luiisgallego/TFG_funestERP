<div class="container-fluid">
    <div class="row page-header"><h1>Nuevo Servicio</h1></div>

    <form id="form_nuevo_servicio" class="form-horizontal" method="post" action="procesa.php">
        <input type="hidden" name="op" value="nuevoServicio">

        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label">Nombre</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="nombre" placeholder="Dale!"/>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label">Apellidos</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="apellidos" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label class=" control-label">Natural de</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="natural_de" placeholder=""/>
                </div>
            </div>
            <div class="col-md-3">
                <label class=" control-label">Provincia</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="provincia" placeholder=""/>
                </div>
            </div>
            <div class="col-md-3">
                <label class=" control-label">Calle</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="calle" placeholder=""/>
                </div>
            </div>
            <div class="col-md-3">
                <label class="control-label">Número</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="numero" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label">Hijo de (simbolo hombre)</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="hijo_de_h" placeholder=""/>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label">Natural de</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="natural_de_hdh" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label">y de</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="hijo_de_m" placeholder=""/>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label">Natural de</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="natural_de_hdm" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label">Fecha nacimiento</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="fecha_nacimiento" placeholder=""/>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label">Estado civil</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="estado_civil" placeholder=""/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-5">
                <label class="control-label">Fecha defunción</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text" class="form-control" name="fecha_defuncion" placeholder=""/>
                </div>
            </div>
            <div class="col-md-5">
                <label class="control-label">Fecha entierro</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text" class="form-control" name="fecha_entierro" placeholder=""/>
                </div>
            </div>
            <div class="col-md-2">
                <label class="control-label">Hora entierro</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text" class="form-control" name="hora_entierro" placeholder=""/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-6">
                <input type="submit" class="btn btn-primary btn-lg btn-block nuevo_servicio_button" value="Añadir datos">
            </div>
        </div>
    </form>

</div>

