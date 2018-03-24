<?php
require __DIR__ . "/APIClient.php";

//$apibase = "http://apisf.aftgrupo.com/";
//$apiversion = "v1";
//define("APIBASE", $apibase);

//$ApiClient = new APIClient($apibase, $apiversion);
//$ApiClient->debug = true;

$ApiClient = new apiBD();
$ApiClient->debug = true;