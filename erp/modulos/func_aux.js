
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
<!-- ******************************************************* -->

function globalDifunto(nombre, mensaje, info) {

    var json = JSON.parse(mensaje);
    var divBusqueda = $("#resBusqueda");
    divBusqueda.html(""); // Limpiamos si hay datos mostrados

    // console.log(json);

    /* Tenemos que diferenciar el "name" que se enviará dependiendo de donde vengamos. */
    var nombre;
    if(info.name === "nuevoCliente") nombre = "c_id_dif";
    else if(info.name === "nuevaEsquela") nombre = "f_id_dif";  // FAMILIARES
    else if(info.name === "nuevaFactura"){
        nombre = "t_id_dif";  // FACTURAS
    }

    // Construimos la estructura para mostrarla
    for(i=0; i<json.length; i++){

        // Para cada difunto, buscar si tiene ya su Esquela o Recordatoria correspondiente
        // Si la tiene no mostrar
        // ¡¡¡pensar!!!

        var estructura = "<div class='row'>" +
                            "<div class='col-md-5 col-md-offset-1' id='nom_dif'>" + json[i]['nombre']+ "</div>" +
                            "<div class='col-md-2'><input id='id_difunto' type='checkbox' name='"+nombre+"' value='"+json[i]['id']+"' /></div>" +
                        "</div>";
        divBusqueda.append(estructura);
    }
}

function globalDifunto2(nombre, mensaje, info) {

    var json = JSON.parse(mensaje);
    var body = $("#tBdodyCliente");
    body.html(""); // Limpiamos si hay datos mostrados

    /* Tenemos que diferenciar el "name" que se enviará dependiendo de donde vengamos. */
    var nombre = "c_id_dif";

    for(i=0; i<json.length; i++){

        var estructura = "<tr>"+
            "<td id='nom_dif'>" + json[i]['nombre']+ "</td>" +
            "<td><input id='id_difunto' class='micheck' type='checkbox' name='"+nombre+"' value='"+json[i]['id']+"' /></td>"+
            "</tr>";
        body.append(estructura);
    }
}

function buscarDifunto(info) {

    var nombre = $(".busqueda input").val();
    // console.log(nombre);
    // console.log(info.name);

    if(nombre !== "") {

        if(info.name == "nuevoCliente") {
            $.post("../../procesa.php", {op: "buscarDifunto_Disponible",nombreDifunto: nombre}, function (mensaje) {

                globalDifunto2(nombre, mensaje, info);

            });
        } else {
            $.post("../../procesa.php", {op: "buscarDifunto",nombreDifunto: nombre}, function (mensaje) {

                globalDifunto(nombre, mensaje, info);

            });
        }

    } else {
        inicliente();
        $("#resBusqueda").html("");
    }
}

function buscarDifuntoLimitado(info) {

    var nombre = $(".busqueda input").val();

    if(nombre !== "") {
        $.post("../../procesa.php", {op: "buscarDifunto_Limitado",nombreDifunto: nombre}, function (mensaje) {

            globalDifunto(nombre, mensaje, info);

        });
    } else {
        $("#resBusqueda").html("");
    }
}

function inicliente() {

    var body = $("#tBdodyCliente");
    body.html("");
    var nombre = "c_id_dif";

    $.post("../../procesa.php", {op: "buscarDifunto_Disponible", nombreDifunto: ""}, function (mensaje) {

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

function redirigeJS(direccion){
    var base = "http://localhost/funerariagallego/erp/";
    window.location = base + direccion;
}

<!-- ******************************************************* -->

/**
 *      VALIDACIONES
 */

function validar_email( dato ) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(dato) ? true : false;
}

function validar_codigoPostal( dato ) {
    var regex = /^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/;
    return regex.test(dato) ? true : false;
}

// function validar_telefono( dato ) {
//     var regex = \+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8};
//     return regex.test(dato) ? true : false;
// }
// function validar_dni( dato ) {
//     var regex = /^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/;
//     return regex.test(dato) ? true : false;
// }

function validarFormCliente() {

    var nombre = $("#c_nombre").val();
    var email = $("#c_email");
    // var dni = $("#c_dni").val();
    // var codigo_postal = $("#c_codigo_postal").val();
    // var telefono = $("#c_telefono").val();

    var cont = 0;
    var res = false;

    $('#tBdodyCliente input[type=checkbox]:checked').each(function () {
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

    // else if(telefono != ""){
    //     if(!validar_email(email)) {
    //         alertify.error("Telefono incorrecto.");
    //         telefono.focus();
    //     }
    // } else if(dni != ""){
    //     if(!validar_email(email)) {
    //         alertify.error("DNI incorrecto.");
    //         dni.focus();
    //     }
    // }
    // else if(codigo_postal != ""){
    //     if(!validar_codigoPostal(email)) {
    //         alertify.error("Codigo postal incorrecto.");
    //         codigo_postal.focus();
    // }

    return res;
}

<!-- ******************************************************* -->
