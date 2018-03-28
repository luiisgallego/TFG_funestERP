<?php
@session_start();
setlocale(LC_TIME, 'es_ES.utf8') OR setlocale(LC_TIME, 'es_ES');

class APIClient {

    public $HOST = "localhost";
    public $BD = "funesterp";
    public $USER = "root";
    public $PASS = "";
    public $BD_CONEXION;

    public $loginInfo;
    public $debug;

    public function __construct() {
        $this->BD_CONEXION = mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->BD);
        mysqli_set_charset($this->BD_CONEXION, "utf8");

        $this->initParametros();
    }

    private function initParametros(){
        // Util para cuando cerramos la ventana y la sesion no ha caducado
        // y por tanto hay que reutilizar los datos de la API
        $this->loginInfo = $_SESSION["ws_login_info"];
    }

    public function login($user, $pass) {

        $query = "SELECT usuarios.* FROM usuarios WHERE nombre = '$user' AND pass = '$pass' ";

        if($res = $this->BD_CONEXION->query($query)){ // Existe
            if($row = $res->fetch_object()){
                $this->loginInfo = $_SESSION["ws_login_info"] = $row;
                return true;
            }
        }
        return false;
    }

    public function nuevoServicio($datos) {
        $datos = json_decode($datos);
//        file_put_contents (__DIR__."/SOMELOG.log" , print_r($datos->nombre, TRUE).PHP_EOL, FILE_APPEND );

        $query = "INSERT INTO servicios (nombre, apellidos, dni, tipo_servicio, tanatorio, 
        poblacion, provincia, calle, numero, fecha_nacimiento,estado_civil) 
        VALUES ('$datos->nombre', '$datos->apellidos', '$datos->DNI', '$datos->tipo_servicio', 
        '$datos->tanatorio', '$datos->natural_de', '$datos->provincia', '$datos->calle', 
        '$datos->numero', '$datos->fecha_nacimiento', '$datos->estado_civil')";

        if($this->BD_CONEXION->query($query)) return true;
        return false;
    }

    public function getDifunto($nombre, $apellidos) {

        $query = "SELECT * FROM servicios WHERE nombre = '$nombre' AND apellidos = '$apellidos'";

        if($res = $this->BD_CONEXION->query($query)){ // Existe
            if($row = $res->fetch_object()){
                // Probar el caso en que haya varios difuntos con igual nombre ( while )
                return $row;
            } else return null;
        } else return null;

    }

}
