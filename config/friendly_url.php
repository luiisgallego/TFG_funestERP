<?php
// Tomamos la URL en la que nos encontramos (posterior a localhost)

list($path) = explode('?', $_SERVER['REQUEST_URI']);
$path = substr($path, strlen(dirname($_SERVER['SCRIPT_NAME'])) + 1 - 1); // Nos quedamos con la ultima parte de la URL (/index.php)

$pinfo = array();
foreach (explode('/', $path) as $dir) {
    // Le quitamos la barra y lo metemos en el array
    if (!empty($dir)) {
        $pinfo[] = urldecode($dir);
    }
}

// Sacamos del array y añadimos a la variable $foo que será enviada como "seccion" en la que nos encontramos.
$foo = $pinfo[count($pinfo) - 1];
$_GET["seccion"] = str_replace("-", "_", $foo);
