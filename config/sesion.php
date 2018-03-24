<?php
@session_start();

if(!$ApiClient->loginInfo) {
    header("Location: http://localhost/funerariagallego/erp/login.php");
    // header("Location: {$global_config->WWWBASE}login.php");
    // redirecciona("{$aro_config->WWWBASE}login");
}