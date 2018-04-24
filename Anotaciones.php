CUESTIONES

1- ¿Como se construye correctamente ?
public $result = (object) array(
        "body" => [],
        "error" => [],
    );

=============
Inicialmente nos encontramos en la página de contacto base.
Una vez hecho login, accedemos al ERP.


file_put_contents (__DIR__."/SOMELOG.log" , print_r($cliente->PEDIDO, TRUE).PHP_EOL, FILE_APPEND );

=============
redirecciona($aro_config->WWWBASE . "confirmacion");

=============
<? require __DIR__ . "/script.login_registro.php" ?>


=============
<script>
    $("#form-registro").submit(function (evt) {
        var self = this;
        alertify.log(construyeHtmlNotificacion("Realizando petición..."));
        $.post(
            "procesa.php",
            $(this).serialize(),
            function (resultado) {
                if (resultado) {
                    if (resultado.Status === 0 && resultado.no_registro) {
                        alertify.success(construyeHtmlNotificacion("Continuando porceso de compra"));
                        self.reset();
                        location.reload();
                    } else if (resultado.Status === 0) {
                        alertify.success(construyeHtmlNotificacion("Registro realizado con éxito"));
                        self.reset();
                    } else if (resultado.Status === 1) {
                        alertify.error(construyeHtmlNotificacion("Error", "Ya existe un usuario con ese email."));
                    } else if (resultado.Status === 2) {
                        alertify.error(construyeHtmlNotificacion("Error", "Ya existe un usuario con ese NIF."));
                    } else if (resultado.Status === 3) {
                        alertify.error(construyeHtmlNotificacion("Error", "Error DMC.")); // ¿?
                    } else if (resultado.Status === 4) {
                        alertify.error(construyeHtmlNotificacion("Error", "Error en login.")); // ¿?
                    } else if (resultado.Status === -3) {
                        alertify.error(construyeHtmlNotificacion("Error", "Las contraseñas no coinciden."))
                    } else if (resultado.Status === -4) {
                        alertify.error(construyeHtmlNotificacion("Error", "El código postal no es un código postal válido."))
                    } else if (resultado.Status < 0) {
                        alertify.error(construyeHtmlNotificacion("Error", "Faltan campos por rellenar."))
                    } else {
                        alertify.error(construyeHtmlNotificacion("Error", "No se ha podido realizar el registro. Si el problema persiste contacte con ToolPoint."))
                    }
                } else {
                    alertify.error(construyeHtmlNotificacion("Error", "No se ha podido realizar la operación. Si el problema persiste contacte con ToolPoint."))
                }
            }
        ).fail(function (resultado) {
            console.error(resultado);
            alertify.error(construyeHtmlNotificacion("Error", "No se ha podido realizar el registro. Si el problema persiste contacte con ToolPoint."))
        });
        return false;
    });

    $("#form-login").submit(function (evt) {
        alertify.log(construyeHtmlNotificacion("Iniciando sesión..."));
        $.post(
            "procesa.php",
            $(this).serialize(),
            function (resultado) {
                if (resultado) {
                    if (resultado.Status === 0) {
                        alertify.success(construyeHtmlNotificacion("Inicio de sesión correcto", "Bienvenido, " + resultado.Nombre));
                        location.reload();
                    } else if (resultado.Status === 1 || resultado.Status === 2) {
                        alertify.error(construyeHtmlNotificacion("Error al iniciar sesión", "Los datos no son correctos."))
                    } else if (resultado.Status === 3) {
                        alertify.error(construyeHtmlNotificacion("Error al iniciar sesión", "Usuario bloqueado."))
                    }else if (resultado.Status === -1) {
                        alertify.error(construyeHtmlNotificacion("Error al iniciar sesión", "Faltan campos por rellenar."))
                    } else {
                        alertify.error(construyeHtmlNotificacion("Error", "No se ha podido realizar el inicio de sesión. Si el problema persiste contacte con ToolPoint."))
                    }
                } else {
                    alertify.error(construyeHtmlNotificacion("Error", "No se ha podido realizar el inicio de sesión. Si el problema persiste contacte con ToolPoint."))
                }
            }
        ).fail(function (resultado) {
            console.error(resultado);
            alertify.error(construyeHtmlNotificacion("Error", "No se ha podido realizar el inicio de sesión. Si el problema persiste contacte con ToolPoint."))
        });
        return false;
    });
</script>

=============

<div class="col-md-4 leftlogin login_in">
    <h3>INICIO DE SESIÓN</h3>
    <form id="form-login" action="procesa.php" method="post">
        <input name="op" type="hidden" value="iniciar_sesion">
        <input name="email" value="" type="text" class="hide">
        <input name="log_email" type="email" placeholder="EMAIL" required>
        <input name="log_contrasena" type="password" placeholder="CONTRASEÑA" required>

        <div class="row">
            <div class="col-xs-4">
                <input type="submit" value="LOGIN">
            </div>
            <div class="col-xs-8 olvido">
                <a href="restablecimiento-de-contrasena">¿Ha olvidado la contraseña?</a>
            </div>
        </div>
    </form>
</div>