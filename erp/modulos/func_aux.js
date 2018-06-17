
/**
 * Añade nueva linea dinámicamente en FORM_FAMILIARES
 */
var cont_parRolNombres = 1;
function addParRolNombres() {

    cont_parRolNombres++;
    var bloqueCompleto = document.createElement('li');
    bloqueCompleto.setAttribute('class', 'list-group-item');

    var bloqueRol =
        '<div class="col-md-2">' +
            '<label>Rol</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="f_rol_'+cont_parRolNombres+'" placeholder=""/>'+
            '</div>'+
        '</div>';
    var bloqueNombres =
        '<div class="col-md-8">' +
            '<label>Nombre</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="f_nombres_'+cont_parRolNombres+'" placeholder=""/>'+
            '</div>'+
        '</div>';

    bloqueCompleto.innerHTML = bloqueRol + bloqueNombres;
    document.getElementById('parRolNombre').appendChild(bloqueCompleto);
}
<!-- ******************************************************* -->

/**
 * Añade nueva linea dinámicamente en FORM_FACTURAS
 */
var cont_parConceptoImporte = 1;
function addParConceptoImporte() {

    cont_parConceptoImporte++;
    var bloqueCompleto = document.createElement('li');
    bloqueCompleto.setAttribute('class', 'list-group-item');

    var bloqueConcepto =
        '<div class="col-md-8">' +
            '<label>Concepto</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="t_concepto_'+cont_parConceptoImporte+'" placeholder=""/>'+
            '</div>'+
        '</div>';
    var bloqueItem =
        '<div class="col-md-2">' +
            '<label>Importe</label>'+
            '<div class="input-group">'+
                '<span class="input-group-addon"></span>'+
                '<input type="text" class="form-control" name="t_importe_'+cont_parConceptoImporte+'" placeholder=""/>'+
            '</div>'+
        '</div>';

    bloqueCompleto.innerHTML = bloqueConcepto + bloqueItem;
    document.getElementById('parConceptoImporte').appendChild(bloqueCompleto);
}
<!-- ******************************************************* -->

/**
 * JQUERY para ajustar los FORM en funcion del sexo
 */
var valor = $(".d_sexo");
valor.change(function () {

    if(valor.val() === "Hombre") $(".d_hijo_de").text("Hijo de");
    else $(".d_hijo_de").text("Hija de");
});

/**
 * Redirección desde JavaScript
 */
function redirigeJS(direccion){
    var base = "http://localhost/funerariagallego/erp/";
    window.location = base + direccion;
}

<!-- ******************************************************* -->

/**
 * Para buscar dinamicamente los difuntos disponibles
 * en función de donde vengamos
 */

function buscarDifunto(info) {

    var nombre = $(".busqueda input").val();

    var modulo;
    if(info.name === "nuevoCliente") modulo = "difunto_cliente";
    else if(info.name === "nuevaEsquela") modulo = "difunto_familiares";  // FAMILIARES
    else if(info.name === "nuevaFactura"){
        modulo = "difunto_facturas";  // FACTURAS
    }

    if(nombre !== "") {

        $.post("../../procesa.php", {op: "buscarDifunto_Disponible", nombreDifunto: nombre, modulo: modulo}, function (mensaje) {

            globalDifunto(nombre, mensaje, info);

        });

    } else {
        iniBuscador(info.name);
        $("#resBusqueda").html("");
    }
}

/**
 * Construye la estructura para mostrar dinamicamente
 * los difuntos disponibles
 */

function globalDifunto(nombre, mensaje, info) {

    var json = JSON.parse(mensaje);
    var body = $(".tBdody");
    body.html("");          // Limpiamos si hay datos mostrados

    /* Tenemos que diferenciar el "name" que se enviará dependiendo de donde vengamos. */
    var nombre;
    if(info.name === "nuevoCliente") nombre = "c_id_dif";
    else if(info.name === "nuevaEsquela") nombre = "f_id_dif";  // FAMILIARES
    else if(info.name === "nuevaFactura"){
        nombre = "t_id_dif";  // FACTURAS
    }

    for(i=0; i<json.length; i++){

        var estructura = "<tr>"+
            "<td id='nom_dif'>" + json[i]['nombre']+ "</td>" +
            "<td><input id='id_difunto' class='micheck' type='checkbox' name='"+nombre+"' value='"+json[i]['id']+"' /></td>"+
            "</tr>";
        body.append(estructura);
    }
}
/**
 * Para mostrar los difuntos disponibles al acceder
 */

function iniBuscador(name) {

    var body = $(".tBdody");
    body.html("");

    /* Tenemos que diferenciar el "name" que se enviará dependiendo de donde vengamos. */
    var nombre;
    var modulo;
    if(name === "nuevoCliente") {           // CLIENTE
        nombre = "c_id_dif";
        modulo = "difunto_cliente";
    }
    else if(name === "nuevaEsquela") {      // FAMILIARES
        nombre = "f_id_dif";
        modulo = "difunto_familiares";
    }
    else if(name === "nuevaFactura"){       // FACTURAS
        nombre = "t_id_dif";
        modulo = "difunto_facturas";
    }

    $.post("../../procesa.php", {op: "buscarDifunto_Disponible", nombreDifunto: "", modulo: modulo}, function (mensaje) {

        var json = JSON.parse(mensaje);

        for(i=0; i<json.length; i++){

            var estructura = "<tr>"+
                "<td id='nom_dif'>" + json[i]['nombre']+ "</td>" +
                "<td><input id='id_difunto' class='micheck' type='checkbox' name='"+nombre+"' value='"+json[i]['id']+"' /></td>"+
                "</tr>";
            body.append(estructura);
        }
    });
}

<!-- ******************************************************* -->

/**
 *      VALIDACIONES
 */

function validarFormFactura() {

    var concepto = $("#t_concepto_1");
    var importe = $("#t_importe_1");

    var cont = 0;
    var res = false;

    $('.tBdody input[type=checkbox]:checked').each(function () {
        cont++;
    });

    if(cont == 0) alertify.error("No has seleccionado ningun difunto");
    else if(cont > 1) alertify.error("Solo puedes seleccionar un difunto");
    else if(concepto.val() == "") {

        alertify.error("Faltan datos");
        concepto.focus();

    } else if(importe.val() == "") {

        alertify.error("Faltan datos");
        importe.focus();

    } else res = true;

    return res;
}

function validarFormEsquela() {

    var rol = $("#f_rol_1");
    var nombre = $("#f_nombres_1");

    var cont = 0;
    var res = false;

    $('.tBdody input[type=checkbox]:checked').each(function () {
        cont++;
    });

    if(cont == 0) alertify.error("No has seleccionado ningun difunto");
    else if(cont > 1) alertify.error("Solo puedes seleccionar un difunto");
    else if(rol.val() == "") {
        alertify.error("Faltan datos");
        rol.focus();
    } else if(nombre.val() == "") {
        alertify.error("Faltan datos");
        nombre.focus();
    } else res = true;

    return res;
}

function validarFormCliente() {

    var nombre = $("#c_nombre").val();
    var email = $("#c_email");

    var cont = 0;
    var res = false;

    $('.tBdody input[type=checkbox]:checked').each(function () {
        cont++;
    });

    if(cont == 0) alertify.error("No has seleccionado ningun difunto");
    else if(cont > 1) alertify.error("Solo puedes seleccionar un difunto");
    else if(nombre == "") {
        alertify.error("Faltan datos");
        nombre.focus();
    } else res = true;

    if(email.val() != "" && validar_email(email.val()) == false) {
        alertify.error("Email incorrecto.");
        email.focus();
        res = false;
    }

    return res;
}

function validar_email( dato ) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(dato) ? true : false;
}

function validar_codigoPostal( dato ) {
    var regex = /^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/;
    return regex.test(dato) ? true : false;
}

<!-- ******************************************************* -->
