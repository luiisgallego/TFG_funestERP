<?php
@session_start();
setlocale(LC_TIME, 'es_ES.utf8') OR setlocale(LC_TIME, 'es_ES');

//define("AFTSFAPI_NO_AUTHENTICATE", 1);
//define("AFTSFAPI_NO_DECODE", 2);
//define("AFTSFAPI_JSON_BODY", 4);
//define("AFTSFAPI_NO_VERSION", 8);
//define("AFTSFAPI_NO_RETURN_HEADERS", 16);

class apiBD {       // Clase provisional

    public $HOST = "localhost";
    public $BD = "funesterp";
    public $USER = "root";
    public $PASS = "";
    public $BD_CONEXION;

    public $loginInfo;
    public $debug;

    public function __construct() {
        $this->BD_CONEXION = mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->BD);
//        mysqli_set_charset($this->BD_CONEXION, "utf8_general_ci");

        $this->initParametros();
    }

    private function initParametros(){
        $this->loginInfo = $_SESSION["ws_login_info"];
    }

    public function login($user, $pass) {
        // Aqui hariamos la llamada a la API
        $query = "SELECT usuarios.* FROM usuarios WHERE nombre = '$user' AND pass = '$pass' ";

        if($res = $this->BD_CONEXION->query($query)){ // Existe
            if($row = $res->fetch_object()){
                $this->loginInfo = $_SESSION["ws_login_info"] = $row;
                return true;
            }
        }
        return false;

//        {  // Para actualizar
//            if (!$usr || !$pwd || !SalesForceAPIClient::checkPassword($usr, $pwd)) {
//                return false;
//            }
//
//            $this->device = $usr;
//            $this->getWSToken(1);
//
//            if ($this->token && $recuerda) {
//                $encoded = $this->encodeUSRPWD($usr, $pwd);
//                setcookie(self::COOKIE_REMEMBER, $encoded, time() + 86400 * 30);
//            } else {
//                setcookie(self::COOKIE_REMEMBER, '', time()-3600);
//            }
//
//            return true;
//        }
    }

    public function logout() {
        $_SESSION["ws_login_info"] = $this->loginInfo = null;
    }

}

//class LoginInfo {
//    // Clase para el recordado del Login, tratado mediante un token en la BBDD
//    public $access_token;
//    public $token_type;
//    public $expires_in;
//
//    public function __construct($propiedades = []) {
//        foreach($propiedades as $key => $value) {
//            $this->{$key} = $value;
//        }
//    }
//}

class APIClient {

    const COOKIE_EXP = 2592000; // 60 * 60 * 24 * 30 = 30 días
//    const AUTH_STR = 'VpY7b6xESuTN';
//    const COOKIE_REMEMBER = 'aftsfws_sfcup';

    // Posibles variables útiles
    public $token;          // token del login
   // public $loginInfo;      // datos del login, para comprobar tambien si estamos logueados o no
    public $settings;

//    private $comercial;
//    private $fechaIni;
//    private $fechaFin;

    // Variables de acceso a Swagger
    public $apibase;
    public $apiversionbase;
    public $version;
    public $device; // Utilizado para guardar el usuario que se loguea. ¿Porque?
    public $idauth;

    public $debug;
//    public $log;
//    public $errorLog;

    /**
     * Construye un cliente APIClient.
     *
     * @param string $apibase La <tt>url</tt> base de acceso a la API.
     * @param string $version Versión de la API (v1, v2, etc.).
     * @param string $device Identificador de dispositivo.
     */
    public function __construct($apibase, $version = null, $device = null)
    {
        // Esto se construye desde swagger.php
        $version AND $version = "$version/";

        $this->apibase = $apibase;
        $this->apiversionbase = preg_replace('/\/$/',"",$apibase) . "/" . preg_replace('/^\//',"",$version);
        $this->version = $version;
        $this->device = $device OR $this->device = $_COOKIE['aftsfws_device'] ?: $_SESSION["aftsfws_device"];

        //$this->initToken();
    }
}
