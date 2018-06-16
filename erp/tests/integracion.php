<?php
require '../../config/API_Global.php';

function anotar($txt) {
    file_put_contents (__DIR__."/TEST_INTEGRACION2.log" , print_r($txt, TRUE).PHP_EOL, FILE_APPEND );
}

$txt = ".............PRUEBAS DE INTEGRACIÓN DEL SISTEMA..........."; anotar($txt);
anotar("");

$txt = ".........Comenzamos añadiendo el DIFUNTO"; anotar($txt);

$datos_difunto = [
    "nombre" => "testNombreDifunto",
    "dni" => "77777777J",
    "sexo" => "Hombre",
    "poblacion" => "testPoblacion",
    "provincia" => "testProvincia",
    "calle" => "testCalle",
    "numero" => "50",
    "codigo_postal" => "23777",
    "fecha_nacimiento" => "1111-11-11",
    "estado_civil" => "Casado",
    "nombre_pareja" => "777777777",
    "hijo_de" => "testHijo1",
    "poblacion2" => "testPoblacion2",
    "hijo_de2" => "testHijo2",
    "poblacion3" => "testPoblacion3",
];

$txt = "Los datos utilizados son los siguientes:"; anotar($txt);
anotar($datos_difunto);

anotar("");
$res = $ApiClient->insert($datos_difunto, "difunto");
$txt = ($res == true) ? "Inserción realizada con exito." : "La inserción ha fallado";
anotar($txt);
anotar("");

$txt = "Realizamos un SELECT para verificar la inserción:"; anotar($txt);
$select_difunto = $ApiClient->select("difunto", "nombre = 'testNombreDifunto'");
$id_dif = $select_difunto[0]->id;
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($select_difunto);
anotar("");
anotar("");


$txt = ".........Añadimos ahora el SERVICIO relacionado"; anotar($txt);

$datos_servicio = [
    "id_dif" => $id_dif,
    "fecha_defuncion" => "1111-11-11",
    "hora_defuncion" => "77777777J",
    "fecha_entierro" => "1111-11-11",
    "hora_entierro" => "testPoblacion",
    "poblacion_entierro" => "77777",
    "fecha_misa" => "1111-11-11",
    "hora_misa" => "test@test.com",
    "tanatorio" => "No",
    "tipo_servicio" => "Particular",
    "compañia" => "No",
];

$txt = "Los datos utilizados son los siguientes:"; anotar($txt);
anotar($datos_servicio);

anotar("");
$res = $ApiClient->insert($datos_servicio, "servicio");
$txt = ($res == true) ? "Inserción realizada con exito." : "La inserción ha fallado";
anotar($txt);
anotar("");

$txt = "Realizamos un SELECT para verificar la inserción:"; anotar($txt);
$select_servicio = $ApiClient->select("servicio", "id_dif = '$id_dif'");
$id_servicio = $select_servicio[0]->id;
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($select_servicio);
anotar("");
anotar("");



$txt = ".........Añadimos ahora el CLIENTE relacionado"; anotar($txt);

$datos_cliente = [
    "nombre" => "testNombreCLIENTE",
    "dni" => "77777777J",
    "direccion" => "testDireccion",
    "poblacion" => "testPoblacion",
    "codigo_postal" => "77777",
    "telefono" => "777777777",
    "email" => "test@test.com",
    "cuenta_bancaria" => "ES6000491500051234567892",
];

$txt = "Los datos utilizados son los siguientes:"; anotar($txt);
anotar($datos_cliente);

anotar("");
$res = $ApiClient->insert($datos_cliente, "cliente");
$txt = ($res == true) ? "Inserción realizada con exito." : "La inserción ha fallado";
anotar($txt);
anotar("");

$txt = "Realizamos un SELECT para verificar la inserción:"; anotar($txt);
$select_cliente = $ApiClient->select("cliente", "nombre = 'testNombreCLIENTE'");
$id_cliente = $select_cliente[0]->id;
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($select_cliente);
anotar("");
anotar("");

$txt = ".........Añadimos ahora la relacion DIFUNTO_CLIENTE"; anotar($txt);

$datos_difunto_cliente = [
    "id_dif" => $id_dif,
    "id_cli" => $id_cliente,
];

$txt = "Los datos utilizados son los siguientes:"; anotar($txt);
anotar($datos_difunto_cliente);

anotar("");
$res = $ApiClient->insert($datos_difunto_cliente, "difunto_cliente");
$txt = ($res == true) ? "Inserción realizada con exito." : "La inserción ha fallado";
anotar($txt);
anotar("");

$txt = "Realizamos un SELECT para verificar la inserción:"; anotar($txt);
$select_difunto_cliente = $ApiClient->select("difunto_cliente", "id_dif = '$id_dif'");
$id_difunto_cliente = $select_difunto_cliente[0]->id;
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($select_difunto_cliente);
anotar("");
anotar("");


$txt = ".........Añadimos ahora la relacion DIFUNTO_FACTURAS"; anotar($txt);

$datos_difunto_factura = [
    "id_dif" => $id_dif,
    "fecha" => "1111-11-11",
    "total" => "100",
    "emitida" => "0",
    "cobrada" => "0",
];

$txt = "Los datos utilizados son los siguientes:"; anotar($txt);
anotar($datos_difunto_factura);

anotar("");
$res = $ApiClient->insert($datos_difunto_factura, "difunto_facturas");
$txt = ($res == true) ? "Inserción realizada con exito." : "La inserción ha fallado";
anotar($txt);
anotar("");

$txt = "Realizamos un SELECT para verificar la inserción:"; anotar($txt);
$select_difunto_facturas = $ApiClient->select("difunto_facturas", "id_dif = '$id_dif'");
$id_difunto_facturas = $select_difunto_facturas[0]->id_fact;
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($select_difunto_facturas);
anotar("");
anotar("");

$txt = ".........Añadimos ahora la FACTURA"; anotar($txt);

$datos_facturas = [
    "id_fact" => $id_difunto_facturas,
    "concepto" => "testConcepto",
    "importe" => "100",
];

$txt = "Los datos utilizados son los siguientes:"; anotar($txt);
anotar($datos_facturas);

anotar("");
$res = $ApiClient->insert($datos_facturas, "facturas");
$txt = ($res == true) ? "Inserción realizada con exito." : "La inserción ha fallado";
anotar($txt);
anotar("");

$txt = "Realizamos un SELECT para verificar la inserción:"; anotar($txt);
$select_factura = $ApiClient->select("facturas", "id_fact = '$id_difunto_facturas'");
$id_factura = $select_factura[0]->id_fact;
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($select_factura);
anotar("");
anotar("");
/******************** ............ BORRADO ............. ***********************/

$txt = ".........BORRADO DE DATOS"; anotar($txt);
$txt = "Tenemos que seguir el proceso inverso al de insercion"; anotar($txt);
anotar("");

$txt = "BORRAMOS la FACTURA"; anotar($txt);
$res = $ApiClient->delete("facturas", "id_fact = '$id_factura'");
$txt = ($res == true) ? "DELETE realizado con exito." : "El DELETE ha fallado";
anotar($txt);
anotar("");

$txt = "BORRAMOS el DIFUNTO_FACTURAS"; anotar($txt);
$res = $ApiClient->delete("difunto_facturas", "id_fact = '$id_difunto_facturas'");
$txt = ($res == true) ? "DELETE realizado con exito." : "El DELETE ha fallado";
anotar($txt);
anotar("");

$txt = "BORRAMOS el DIFUNTO_CLIENTE"; anotar($txt);
$res = $ApiClient->delete("difunto_cliente", "id = '$id_difunto_cliente'");
$txt = ($res == true) ? "DELETE realizado con exito." : "El DELETE ha fallado";
anotar($txt);
anotar("");

$txt = "BORRAMOS el CLIENTE"; anotar($txt);
$res = $ApiClient->delete("cliente", "id = '$id_cliente'");
$txt = ($res == true) ? "DELETE realizado con exito." : "El DELETE ha fallado";
anotar($txt);
anotar("");

$txt = "BORRAMOS el SERVICIO"; anotar($txt);
$res = $ApiClient->delete("servicio", "id = '$id_servicio'");
$txt = ($res == true) ? "DELETE realizado con exito." : "El DELETE ha fallado";
anotar($txt);
anotar("");

$txt = "BORRAMOS el DIFUNTO"; anotar($txt);
$id_difunto = $select_difunto[0]->id;
$res = $ApiClient->delete("difunto", "id = '$id_difunto'");
$txt = ($res == true) ? "DELETE realizado con exito." : "El DELETE ha fallado";
anotar($txt);
anotar("");

anotar("");anotar("");anotar("");
$txt = "De esta manera podríamos constuir una integración de parte del sistema."; anotar($txt);
$txt = "Concluyendo que se realiza correctamente."; anotar($txt);

