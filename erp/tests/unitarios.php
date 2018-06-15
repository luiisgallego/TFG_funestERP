<?php
require '../../config/API_Global.php';

function anotar($txt) {
    file_put_contents (__DIR__."/TEST_UNITARIOS.log" , print_r($txt, TRUE).PHP_EOL, FILE_APPEND );
}

$txt = "............. PRUEBAS UNITARIAS DE LA API..........."; anotar($txt);
anotar("");
$txt = "Vamos a hacer uso de la tabla CLIENTE"; anotar($txt);

$datos = [
    "nombre" => "testNombre",
    "dni" => "77777777J",
    "direccion" => "testDireccion",
    "poblacion" => "testPoblacion",
    "codigo_postal" => "77777",
    "telefono" => "777777777",
    "email" => "test@test.com",
    "cuenta_bancaria" => "ES6000491500051234567892",
];
$txt = "Los datos utilizados son los siguientes:"; anotar($txt);
anotar($datos);


/**** INSERT ****/
anotar("");
$txt = "....TEST INSERT...."; anotar($txt);
$txt = "La consulta SQL sería la siguiente:"; anotar($txt);
$sql = $ApiClient->insert_getSQL($datos, "cliente");
anotar($sql);
$res = $ApiClient->insert($datos, "cliente");
$txt = ($res == true) ? "Inserción realizada con exito." : "La inserción ha fallado";
anotar($txt);
anotar("");

/**** SELECT ****/
$txt = "....TEST SELECT para validar ambos métodos...."; anotar($txt);
$txt = "La consulta SQL sería la siguiente:"; anotar($txt);
$sql = $ApiClient->preparaSQL([
    "modulo" => "cliente",
    "cond" => "nombre = testNombre",
    "campos" =>  "*",
    "order" => null,
    "limit" => null
]);
anotar($sql);
$res = $ApiClient->select("cliente", "nombre = 'testNombre'");
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($res);
anotar("");
anotar("");
anotar("");

/**** UPDATE ****/
anotar("");
$txt = "....TEST UPDATE...."; anotar($txt);
$datos = [
    "nombre" => "testNombreUPDATE",
    "dni" => "777778888J",
    "direccion" => "testDireccionUPDATE",
    "poblacion" => "testPoblacionUPDATE",
    "codigo_postal" => "77788",
    "telefono" => "777778888",
    "email" => "testUPDATE@test.com",
    "cuenta_bancaria" => "ES60004915000512388888",
];
$res = $ApiClient->update($datos, "cliente", "nombre = 'testNombre'");
$txt = ($res == true) ? "Update realizado con exito." : "La update ha fallado";
$txt = "Realizamos un select para comprobar que dicho cliente se ha actualizado."; anotar($txt);
$res = $ApiClient->select("cliente", "nombre = 'testNombreUPDATE'");
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($res);
anotar("");

/**** DELETE ****/
anotar("");
$txt = "....TEST DELETE....."; anotar($txt);
$res = $ApiClient->delete("cliente", "nombre = 'testNombreUPDATE'");
$txt = ($res == true) ? "DELETE realizado con exito." : "El DELETE ha fallado";
anotar($txt);
anotar("");
$txt = "Realizamos un select para comprobar que dicho cliente ya no existe."; anotar($txt);
$res = $ApiClient->select("cliente", "nombre = 'testNombreUPDATE'");
$txt = "Obteniendo el siguiente resultado:"; anotar($txt);
anotar($res);
$txt = "Por lo que podemos concluir que la API funciona correctamente."; anotar($txt);
anotar("");

